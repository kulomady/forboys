<?php 
class pemby_piutang extends SIS_Controller {

	public function __construct() {
        parent::__construct();   
		$this->load->model('m_rekan_bisnis');
    }
 
	public function index() {
		$data['hak_toolbar'] = $this->msistem->hak_toolbar('pj2');
		$data['pilihPelanggan'] = $this->m_rekan_bisnis->pilihPelanggan('0');
		$data['pilihCaraBayar'] = $this->m_rekan_bisnis->pilihCaraBayar('0');
		$this->load->view('pemby_piutang/pemby_piutang_index',$data);
	}
	
	function loadMainData($tglAwal="",$tglAkhir="",$noTrans="",$pelanggan="",$bayar="") {
		
		$qr = "";
		if($noTrans != "0"):
			$qr .= " and trans_pemby_piutang.kdtrans like '%".$noTrans."%'";
		endif;
		if($pelanggan != "0"):
			$qr .= " and trans_pemby_piutang.idrekan = '".$pelanggan."'";
		endif;
		if($bayar != "0"):
			$qr .= " and trans_pemby_piutang.idmetode = '".$bayar."'";
		endif;
		
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("SELECT
trans_pemby_piutang.kdtrans,
DATE_FORMAT(trans_pemby_piutang.tgl,'%d-%m-%Y') as tgl_pemby,
trans_pemby_piutang.total_bayar,
sys_metode_pembayaran.nmmetode,
master_rekan_bisnis.nmrekan,
trans_pemby_piutang.created_by,
trans_pemby_piutang.created,
trans_pemby_piutang.modified_by,
trans_pemby_piutang.modified,
trans_pemby_piutang.ket,
trans_pemby_piutang.id,
trans_pemby_piutang.idrekan
FROM
trans_pemby_piutang
INNER JOIN master_rekan_bisnis ON trans_pemby_piutang.idrekan = master_rekan_bisnis.idrekan
INNER JOIN sys_metode_pembayaran ON trans_pemby_piutang.idmetode = sys_metode_pembayaran.idmetode where trans_pemby_piutang.tgl >= '".$tglAwal."' and trans_pemby_piutang.tgl <= '".$tglAkhir."' $qr","id","id,kdtrans,tgl_pemby,nmmetode,idrekan,nmrekan,ket,total_bayar,created_by,created");
	}
	
	function frm_input() {
		$data['pilihPelanggan'] = $this->m_rekan_bisnis->pilihPelanggan('0');
		$data['pilihCaraBayar'] = $this->m_rekan_bisnis->pilihCaraBayar('0');
		$this->load->view('pemby_piutang/pemby_piutang_input',$data); 
	}
	
	function loadChild($pelanggan){
		if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
 			header("Content-type: application/xhtml+xml"); } else {
 			header("Content-type: text/xml");
		}
		echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");
		echo "<rows>";
		
		$sql = $this->db->query("select kdtrans,tgl,grand_total,kurang as kredit from tr_penjualan where idrekan = '".$pelanggan."' and jnstransaksi != 'KASIR'");
		$i = 1;
		foreach($sql->result() as $rs) {
			//ngecek diskon
			$diskon = ""; //$this->m_rekan_bisnis->diskon($pelanggan,$rs->tgl);
			
			//tgl_jt_tempo
			$tgl_jt_tempo = $this->m_rekan_bisnis->tgl_jt_tempo($pelanggan,$rs->tgl);

			
			//sisa
			$bayar = $this->db->query("select sum(jumlah_bayar + potongan) as jumlah_bayar from trans_pemby_piutang_child where no_pembelian = '".$rs->kdtrans."'")->row();
			if($bayar==NULL){
				$jml_bayar = 0;
			} else {
				$jml_bayar = $bayar->jumlah_bayar;
			}
			
			if($diskon==0){
				$sisa = (abs($rs->kredit)-$jml_bayar);
			} else {
				$sisa = (abs($rs->kredit) * $diskon)-$jml_bayar;
			}
			//$sisa = $rs->kredit;
			$pot = 0;
			$total = $sisa+$pot;
			if($total!=0){
				echo ("<row id='".$i."'>");
					echo("<cell><![CDATA[".$rs->kdtrans."]]></cell>");
					echo("<cell><![CDATA[".$rs->tgl."]]></cell>");
					echo("<cell><![CDATA[".$tgl_jt_tempo."]]></cell>");
					echo("<cell><![CDATA[".$sisa."]]></cell>");
					echo("<cell><![CDATA[".$pot."]]></cell>");
					echo("<cell><![CDATA[".$total."]]></cell>");
					echo("<cell><![CDATA[]]></cell>");
				echo("</row>");
				$i++;
			}
  		}
		echo "</rows>";
	}
	
	function frm_edit($id="") {
		$r = $this->db->query("select a.tgl,a.kdtrans,a.nod_metode,a.total_bayar,a.idperkiraan,b.nmperkiraan,a.idrekan,a.idmetode from trans_pemby_piutang a inner join ak_master_perkiraan b on a.idperkiraan = b.idperkiraan where a.id = '".$id."'")->row();
		$data = array(
			'id' => $id,
			'txttgl' => $this->msistem->conversiTglDB($r->tgl),
			'txtNoTrans' => $r->kdtrans,
			'txtNomor' => $r->nod_metode,
			'txtTotalByr' => $r->total_bayar,
			'idperkiraan' => $r->idperkiraan,
			'nmperkiraan' => $r->nmperkiraan
		);
		$data['pilihPelanggan'] = $this->m_rekan_bisnis->pilihPelanggan($r->idrekan);
		$data['pilihCaraBayar'] = $this->m_rekan_bisnis->pilihCaraBayar($r->idmetode);
		$this->load->view('pemby_piutang/pemby_piutang_input',$data); 
	}
	
	function simpan() {
		if($this->input->post('tgl') != "") {
			$tglBayar = $this->msistem->conversiTgl($this->input->post('tgl'));
		} else {
			$tglBayar = "";
		}
		$this->db->trans_begin();
		
		$data = array (
			'tgl' => $tglBayar,
			'idrekan' => $this->input->post('pelanggan'),
			'idmetode' => $this->input->post('caraBayar'),
			'nod_metode' => $this->input->post('no'),
			'total_bayar' => $this->input->post('total'),
			'idperkiraan' => $this->input->post('kdakun')
		);
		if($this->input->post('id')=="") {
			$no_pbs = $this->msistem->noTrans('BP','trans_pemby_piutang','',$this->input->post('pelanggan'),$tglBayar);
			$dataIns = array (
				'kdtrans' => $no_pbs,
				'created' => date("Y-m-d H:i:s"),
				'created_by' => strtoupper($this->session->userdata('sis_user'))
			);
			$data = array_merge($data,$dataIns);
			$this->db->insert('trans_pemby_piutang', $data);
			$this->msistem->log_book('Input data baru Bayar Brg "'.$no_pbs,'pj2',$this->session->userdata('sis_user'));
		} else {
			$no_pbs = $this->input->post('no_bayar');
			$dataUpdate = array('modified_by' => strtoupper($this->session->userdata('sis_user')));
			$data = array_merge($data,$dataUpdate);
			$this->db->update('trans_pemby_piutang', $data,array('id' => $this->input->post('id')));
			$this->msistem->log_book('Edit data Bayar Piutang "'.$no_pbs,'pj2',$this->session->userdata('sis_user'));
		}
		
		// input dataSupplier Child
		if($this->input->post('dataBayar') != ""):
			$dataBayar = $this->input->post('dataBayar');
			$table = 'trans_pemby_piutang_child';
			$dataIns = array('no_pembelian','tgl_beli','tgl_jt_tempo','sisa','potongan','total','jumlah_bayar');
			$fk = array('kdtrans' => $no_pbs);
			$this->msistem->insertDB($dataBayar,$table,$dataIns,$fk);
		endif;
		
		// update dataBeli
		/*if($this->input->post('dataBeli') != ""):
			$dataBeli = $this->input->post('dataBeli');
			$table = 'trans_pembelian_brg';
			$dataIns = array('kdtrans','flag');
			$this->msistem->updateBeli($dataBeli,$table,$dataIns);
		endif;*/
		
		if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
			echo "0|[AUTO]";
        } else {
            $this->db->trans_commit();
            echo "1|".$no_pbs;
        }
	}
	
	function loadChild2($no_pbs) {
		$grid = new GridConnector($this->db->conn_id);
		//$grid->render_sql("select a.id, a.kdtrans, a.kd_barang, a.satuan, a.qty, a.harga, a.disc, a.jumlah, a.ket from tb_pembelian_brg_child a where a.kdtrans = '".$kdtrans."'","id","kd_barang,kd_barang,satuan,qty,harga,disc,jumlah,ket");
		$grid->render_sql("select id,no_pembelian,tgl_beli,tgl_jt_tempo,sisa,potongan,total,jumlah_bayar from trans_pemby_piutang_child where kdtrans = '".$no_pbs."'","id","no_pembelian,tgl_beli,tgl_jt_tempo,sisa,potongan,total,jumlah_bayar");
	}
	
	function generateCode($tgl,$supplier) {
		$arrTgl = preg_split("[-]",$tgl);
		$bln = $arrTgl[1];
		$thn = substr($arrTgl[0],-2);
		$periode = $arrTgl[0]."-".$arrTgl[1];
		//$kd_unit = $this->session->userdata('kd_unit');
		$this->db->query("delete from trans_pemby_supplier where kd_supplier='".$supplier."' and kdtrans not in (select kdtrans from trans_pemby_supplier_child)");
		$sql = $this->db->query("select MAX(SUBSTRING_INDEX(kdtrans,'.',1)) as jml from trans_pemby_supplier where DATE_FORMAT(tgl,'%Y-%m') = '".$periode."'");
		if($sql==NULL){
			$no_bukti = '0001.'.$supplier.'-PBS.'.$bln.$thn;
		} else {
			$rs = $sql->row();
			$jml = $rs->jml + 1;
			
			if(strlen($jml)==1) {
				$no_urut = '000'.$jml;	
			} else if(strlen($jml)==2) {
				$no_urut = '00'.$jml;
			} else if(strlen($jml)==3) {
				$no_urut = '0'.$jml;	
			} else if(strlen($jml)==4) {
				$no_urut = $jml;	
			}
			$no_bukti = $no_urut.'.'.$supplier.'-PBS.'.$bln.$thn;
		}
		return $no_bukti;
	}
	
	function hapus() {
		$idrec = $this->input->post('idrec');
		$this->db->trans_begin();
		$sql = $this->db->query("select no_pembelian from v_trans_pemby_supplier where id = '".$idrec."'")->row();
		$this->db->update("trans_pembelian_brg",array('flag' => 0),array('kdtrans' => $sql->no_pembelian));
		$this->db->delete("trans_pemby_supplier",array('id' => $idrec));
		
		$this->msistem->log_book('Delete data id "'.$idrec,'md28',$this->session->userdata('sis_user'));
		if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
			echo "Hapus Data Gagal";
        } else {
            $this->db->trans_commit();
			echo "Hapus Data Berhasil";
        }
	}
	
	function frm_search_akun() {
		$this->load->view('pemby_piutang/rb_search_akun');
	}
}
?>