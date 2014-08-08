<?php 
class pembelian_barang extends SIS_Controller {

	public function __construct() {
        parent::__construct();
		$this->load->model('m_company');
		$this->load->model('m_rekan_bisnis');   
		$this->load->model('m_penjualan');
		$this->load->model('msistem');
    }
 
	public function index() {
		$data['hak_toolbar'] = $this->msistem->hak_toolbar('pb1');
		$data['gudang'] = $this->m_company->pilihLokasi('0');
		$data['supplier'] = $this->m_rekan_bisnis->pilihSupplier('0');
		$this->load->view('pembelian_barang/pb_index',$data);
	}
	
	function loadMainData($tglAwal="",$tglAkhir="",$noTrans="",$gudang="",$nopo="",$supplier="") {
		$qr = "";
		$join = "";
		if($noTrans != "0"):
			$qr .= " and a.kdtrans like '%".$noTrans."%'";
		endif;
		
		if($supplier != "0"):
			$qr .= " and c.idrekan = '".$supplier."'";
		endif;
		
		if($nopo != "0"):
			$qr .= " and a.no_po like '%".$nopo."%'";
		endif;
		
		if($gudang != "0") {
			$qr .= " and a.outlet_id = '".$gudang."'";
		} else {
			$join = " inner join sys_hak_outlet e on a.outlet_id = e.outlet_id and group_id = '".$this->session->userdata('group_id')."'";
		}
		
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select a.id, a.kdtrans, a.no_po, b.nm_outlet, DATE_FORMAT(a.tgl,'%d-%m-%Y') as tgl_pembelian, c.nmrekan,a.created,a.created_by,sum(d.qtyBeli) as qty,sum(d.pcs) as pcs,a.sub_total,a.potongan_rupiah,a.pajak_rupiah,a.total_akhir,a.tunai_dp,a.kredit from trans_pembelian_brg a left join master_company b on a.outlet_id=b.outlet_id left join master_rekan_bisnis c on a.company_id=c.idrekan inner join trans_pembelian_brg_child d on a.kdtrans = d.kdtrans $join where a.tgl >= '".$tglAwal."' and a.tgl <= '".$tglAkhir."' $qr group by a.kdtrans","kdtrans","id,kdtrans,no_po,nm_outlet,tgl_pembelian,nmrekan,qty,pcs,sub_total,potongan_rupiah,pajak_rupiah,total_akhir,tunai_dp,kredit,created,created_by");
	}
	
	function loadDataSupplier() {
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select id,idrekan,nmrekan from master_rekan_bisnis where idtipe_rekan = '2'","id","idrekan,nmrekan");
	}
	
	function frm_input() {
		$data['gudang'] = $this->m_company->pilihLokasi('0');
		$data['bln_tempo'] = $this->msistem->bulan();
		$data['thn_tempo'] = $this->msistem->tahun();
		$data['pilihPajak'] = $this->m_company->pilihPajak('0');
		$data['pilihPajakBarcode'] = $this->m_company->pilihPajak('0');
		$data['pajak'] = $this->m_company->pilihPajak('0');
		$data['qPajak'] = $this->db->query("select nilai,kode_pajak from master_pajak order by nilai");
		$data['periodeAwal'] = $this->session->userdata('periodeAwal');
		$data['top'] = $this->m_penjualan->pilihTOP('0');
		$data['kolomPcs'] = $this->msistem->kolomPcs();
		$data['setBarcode'] = $this->msistem->setBarcode();
		$this->load->view('pembelian_barang/pb_input',$data); 
	}
	
	function frm_search_supplier(){
		$this->load->view('pembelian_barang/pb_search_supplier'); 
	}
	
	function frm_search_pesanan(){
		$this->load->view('pembelian_barang/pb_search_pesanan'); 
	}
	
	function loadDataPenesan(){
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select no_lpp,tgl_pesanan,company_id,nmrekan,outlet_id,nm_outlet from v_pesanan_brg","no_lpp","no_lpp,tgl_pesanan,company_id,nmrekan,outlet_id,nm_outlet");
	}
	
	function cariBarang(){
		$sql = $this->db->query("select a.id,a.idbarang,a.nmbarang,a.idsatuan,b.nilai from v_master_barang_detail a left join master_pajak b on a.idpajak=b.kode_pajak where a.idbarang = '".$this->input->post('kodeBarang')."' and a.is_active = '1'");
		if($sql->num_rows()==1){
			$sql = $sql->row();
			if($sql->nilai==NULL){
				$nilai = 0;
			} else {
				$nilai = $sql->nilai;
			}
			$hasil = $sql->idbarang.'|'.$sql->nmbarang.'|'.$sql->idsatuan.'|'.$nilai;			
		} else {
			$hasil = 0;
		}
		echo $hasil;
	}
	
	function detailBarang(){
		$sql = $this->db->query("select a.id,a.idbarang,a.nmbarang,a.idsatuan,b.nilai from v_master_barang_detail a left join master_pajak b on a.idpajak=b.kode_pajak where a.idbarang = '".$this->input->post('kodeBarang')."' and a.is_active = '1'")->row();
		echo $sql->idbarang.'|'.$sql->nmbarang.'|'.$sql->idsatuan.'|'.$sql->nilai;
	}
	
	function frm_search_barang($kode_brg){
		$data['kode_brg'] = $kode_brg;
		$this->load->view('pembelian_barang/pb_search_barang',$data); 
	}
	
	function loadDataBarang($kode_brg) {
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select a.id,a.idbarang,a.nmbarang,a.idsatuan,b.nilai from v_master_barang_detail a left join master_pajak b on a.idpajak=b.kode_pajak where a.idbarang like '%".$kode_brg."%' and a.is_active = '1'","id","idbarang,nmbarang,idsatuan,nilai");
	}
	
	function loadChild($no_lpb) {
		$img = '<img id="btnTglBerlaku_md41" src="../../assets/img/icon/calendar.gif" border="0" style="cursor:pointer;" onclick="show_win_brg(0);" />';
		$img_del = '<img id="btnTglBerlaku_md41" src="../../assets/img/icon/tongsampah.png" border="0" style="cursor:pointer;" onclick="hapusDetail(0);" />';
		$grid = new GridConnector($this->db->conn_id);
		
		$cb = new OptionsConnector($this->db->conn_id);
    	$cb->render_table("master_pajak","nilai","nilai(value),kode_pajak(label)");
   	 	$grid->set_options("pajak",$cb); 
	
		$grid->render_sql("select a.id, a.kdtrans, a.idbarang, concat(b.nmbarang,' ',b.nmwarna,' ',b.nmsize) as nmbarang, b.nmsatuan, a.qtyBeli, a.pcs, a.harga, a.disc,a.discrp, a.pajak, a.jumlah,'$img' as img,'$img_del' as img_del from trans_pembelian_brg_child a left join v_master_barang_detail b on a.idbarang=b.idbarang where a.kdtrans = '".$no_lpb."'","idbarang","idbarang,img,nmbarang,nmsatuan,qtyBeli,pcs,harga,disc,discrp,pajak,jumlah,img_del");
	}
	
	function loadPesan($no_po) {
		$img = '<img id="btnTglBerlaku_md41" src="../../assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" onclick="show_win_brg(0);" />';
		$img_del = '<img id="btnTglBerlaku_md41" src="../../assets/codebase_toolbar/icon/tongsampah.png" border="0" style="cursor:pointer;" onclick="hapusDetail(0);" />';
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select a.id, a.no_lpp, a.idbarang, b.nmbarang, a.satuan, a.qty, a.harga, a.disc, a.pajak, a.jumlah, a.pajak_jumlah, a.ket,'$img' as img,'$img_del' as img_del from trans_pesanan_brg_child a left join v_master_barang_detail b on a.idbarang=b.idbarang where a.no_lpp = '".$no_po."'","id","idbarang,img,nmbarang,satuan,qty,harga,disc,pajak,jumlah,pajak_jumlah,ket,img_del");
	}
	
	function frm_edit($kdtrans="") {
		$r = $this->db->query("select a.*, b.nmrekan from trans_pembelian_brg a left join master_rekan_bisnis b on a.company_id=b.idrekan where a.kdtrans = '".$kdtrans."'")->row();
		$data = array(
			'id' => $r->id,
			'kdtrans' => $r->kdtrans,
			'tglBeli' => $this->msistem->conversiTglDB($r->tgl),
			'no_po' => $r->no_po,
			'txtidSupplier' => $r->company_id,
			'nmSupplier' => $r->nmrekan,
			'sub_total_item' => $r->sub_total_item,
			'sub_total_terima' => $r->sub_total_terima,
			'sub_total' => $r->sub_total,
			'potongan' => $r->potongan_persen,
			'potongan2' => $r->potongan_rupiah,
			'pajak' => $this->m_company->pilihPajak($r->pajak_persen),
			'pajak2' => $r->pajak_rupiah,
			'total_akhir' => $r->total_akhir,
			'tunai' => $r->dp_so,
			'tunai2' => $r->tunai_dp,
			'kredit' => $r->kredit,
			'ket' => $r->keterangan,
			'pilihPajak' => $this->m_company->pilihPajak('0'),
			'pilihPajakBarcode' => $this->m_company->pilihPajak($r->pajak_bk),
			'biaya_kirim' => $r->biaya_kirim,
			'qPajak' => $this->db->query("select nilai,kode_pajak from master_pajak order by nilai"),
			'la_disc_beli' => $r->la_disc_beli,
			'la_pajak_beli' => $r->la_pajak_beli,
			'la_pajak_bk' => $r->la_pajak_bk,
			'la_biaya_angkut_beli' => $r->la_biaya_angkut_beli,
			'la_dp_pesen_beli' => $r->la_dp_pesen_beli,
			'la_uang_muka_beli' => $r->la_uang_muka_beli,
			'la_akun_hd' => $r->la_akun_hd
			
		);
		$data['gudang'] = $this->m_company->pilihLokasi($r->outlet_id);
		$data['periodeAwal'] = $this->session->userdata('periodeAwal');
		$data['top'] = $this->m_penjualan->pilihTOP($r->idtermin);
		$data['kolomPcs'] = $this->msistem->kolomPcs();
		$data['setBarcode'] = $this->msistem->setBarcode();
		$this->load->view('pembelian_barang/pb_input',$data); 
	}
	
	function simpan() {
		$tglBeli = $this->msistem->conversiTgl($this->input->post('tglBeli'));
		
		// validasi periode
		$invalid = $this->msistem->validasi_periode($tglBeli);
		if($invalid=='1'):
			echo "ERR";
			return;
		endif;
		
		$this->db->trans_begin();
		
		$ak = $this->db->query("select la_inventory,la_disc_beli,la_pajak_beli,la_biaya_angkut_beli,la_dp_pesen_beli,la_uang_muka_beli,la_akun_hd from master_company where outlet_id = '".$this->input->post('gudang')."'")->row();
		$akun_inventory = $ak->la_inventory;
		if($this->input->post('akun_pot')=="") {
			$akun_pot = $ak->la_disc_beli;
		} else {
			$akun_pot = $this->input->post('akun_pot');	
		}
		if($this->input->post('akun_pajak')=="") {
			$akun_pajak = $ak->la_pajak_beli;
		} else {
			$akun_pajak = $this->input->post('akun_pajak');	
		}
		if($this->input->post('akun_biayakirim')=="") {
			$akun_biayakirim = $ak->la_biaya_angkut_beli;
		} else {
			$akun_biayakirim = $this->input->post('akun_biayakirim');	
		}
		if($this->input->post('akun_pajakBk')=="") {
			$akun_pajakBk = $ak->la_pajak_beli;
		} else {
			$akun_pajakBk = $this->input->post('akun_pajakBk');	
		}
		if($this->input->post('akun_dp_so')=="") {
			$akun_dp_so = $ak->la_dp_pesen_beli;
		} else {
			$akun_dp_so = $this->input->post('akun_dp_so');	
		}
		if($this->input->post('akun_dp')=="") {
			$akun_dp = $ak->la_uang_muka_beli;
		} else {
			$akun_dp = $this->input->post('akun_dp');	
		} 
		if($this->input->post('akun_kredit')=="") {
			$akun_kredit = $ak->la_akun_hd;
		} else {
			$akun_kredit = $this->input->post('akun_kredit');	
		}
		
		
		$data = array (
			'tgl' => $tglBeli,
			'no_po' =>$this->input->post('no_po'),
			'company_id' => $this->input->post('supplier'),
			'outlet_id' => $this->input->post('gudang'),
			'sub_total_item' => $this->input->post('sub_total_item'),
			'sub_total_terima' => $this->input->post('sub_total_terima'),
			'sub_total' => $this->input->post('sub_total'),
			'potongan_persen' => $this->input->post('potongan'),
			'potongan_rupiah' => $this->input->post('potongan2'),
			'pajak_persen' => $this->input->post('pajak'),
			'pajak_rupiah' => $this->input->post('pajak2'),
			'biaya_kirim' => $this->input->post('biaya_kirim'),
			'pajak_bk' => $this->input->post('slcPajak'),
			'total_akhir' => $this->input->post('total_akhir'),
			'dp_so' => $this->input->post('tunai'),
			'tunai_dp' => $this->input->post('tunai2'),
			'kredit' => $this->input->post('kredit'),
			'keterangan' => $this->input->post('ket'),
			'idtermin' => $this->input->post('termin'),
			'flag' => 0,
			'la_disc_beli' => $akun_pot,
			'la_pajak_beli' => $akun_pajak,
			'la_biaya_angkut_beli' => $akun_biayakirim,
			'la_pajak_bk' =>  $akun_pajakBk,
			'la_dp_pesen_beli' => $akun_dp_so,
			'la_uang_muka_beli' => $akun_dp,
			'la_akun_hd' => $akun_kredit
		);
		if($this->input->post('no_lpb')=="") {
			$no_lpb = $this->msistem->noTrans('PB','trans_pembelian_brg','',$this->input->post('gudang'),$tglBeli);
			$dataIns = array (
				'kdtrans' => $no_lpb,
				'created' => date("Y-m-d H:i:s"),
				'created_by' => strtoupper($this->session->userdata('sis_user'))
			);
			$data = array_merge($data,$dataIns);
			$this->db->insert('trans_pembelian_brg', $data);
			$this->msistem->log_book('Input data baru Beli Brg "'.$no_lpb,'pb1',$this->session->userdata('sis_user'));
		} else {
			$no_lpb = $this->input->post('no_lpb');
			$dataUpdate = array('modified_by' => strtoupper($this->session->userdata('sis_user')));
			$data = array_merge($data,$dataUpdate);
			$this->db->update('trans_pembelian_brg', $data,array('kdtrans' => $no_lpb));
			$this->msistem->log_book('Edit data Beli Brg "'.$no_lpb,'pb1',$this->session->userdata('sis_user'));
		}
		
		// input dataBeli
		if($this->input->post('dataBeli') != ""):
			$dataBeli = $this->input->post('dataBeli');
			$table = 'trans_pembelian_brg_child';
			$dataIns = array('idbarang','qtyBeli','pcs','harga','disc','discrp','pajak','jumlah','hrgjual');
			$fk = array('kdtrans' => $no_lpb);
			$this->msistem->insertDB($dataBeli,$table,$dataIns,$fk);
			
			$table = 'rpt_stock';
			$dataIns = array('idbarang','qty_beli_in','pcs_beli_in','','','','','jml_beli_in','hrgjual_beli_in');
			$fk = array('notrans' => $no_lpb,'outlet_id' => $this->input->post('gudang'),'tgl' => $tglBeli);
			$this->msistem->insertDB($dataBeli,$table,$dataIns,$fk);
		endif;
		
		// input jurnal
		$kdtrans = $no_lpb;
		$this->db->delete("ak_jurnal",array('no_jurnal' => $kdtrans));
		$sub_total = $this->input->post('sub_total');
		if($sub_total  >= 1):
			// Jurnal Otomatis
			$hJurnal = array(
				'no_jurnal' => $kdtrans,
				'periode' => $this->session->userdata('periode'),
				'tgl_jurnal' => $tglBeli,
				'keterangan' => 'PEMBELIAN BARANG :'.$kdtrans,
				'created_by' => $this->session->userdata('sis_user'),
				'created' => date("Y-m-d"),
				'company' => $this->input->post('gudang'),
				'tipe' => '1'
			);
			$this->db->insert('ak_jurnal', $hJurnal);
			// Persediaan Barang
			$iJurnal = array(
				'no_jurnal' => $kdtrans,
				'no_akun' => $akun_inventory,
				'debet' => $sub_total,
				'kredit' => '0',
				'debet_kredit' => 'D',
				'nilai' => $sub_total
			);
			$this->db->insert('ak_jurnal_detail', $iJurnal);
			// Potongan Beli
			if($this->input->post('potongan2') != "0"):
				$pJurnal = array(
					'no_jurnal' => $kdtrans,
					'no_akun' => $akun_pot,
					'debet' => '0',
					'kredit' => $this->input->post('potongan2'),
					'debet_kredit' => 'K',
					'nilai' => $this->input->post('potongan2')
				);
				$this->db->insert('ak_jurnal_detail', $pJurnal);
			endif;
			// Pajak Beli
			if($this->input->post('pajak2') != "0"):
				$pJurnal = array(
					'no_jurnal' => $kdtrans,
					'no_akun' => $akun_pajak,
					'debet' => $this->input->post('pajak2'),
					'kredit' => '0',
					'debet_kredit' => 'D',
					'nilai' => $this->input->post('pajak2')
				);
				$this->db->insert('ak_jurnal_detail', $pJurnal);
			endif;
			// biaya kirim
			if($this->input->post('biaya_kirim') != "0"):
				$pJurnal = array(
					'no_jurnal' => $kdtrans,
					'no_akun' => $akun_biayakirim,
					'debet' => '0',
					'kredit' => $this->input->post('biaya_kirim'),
					'debet_kredit' => 'K',
					'nilai' => $this->input->post('biaya_kirim')
				);
				$this->db->insert('ak_jurnal_detail', $pJurnal);
			endif;
			// Pajak Biaya Kirim
			$pajak_bk = $this->input->post('biaya_kirim') * ($this->input->post('slcPajak') / 100);
			if($this->input->post('slcPajak') != "0"):
				$pJurnal = array(
					'no_jurnal' => $kdtrans,
					'no_akun' => $akun_pajakBk,
					'debet' => round($pajak_bk,2),
					'kredit' => '0',
					'debet_kredit' => 'D',
					'nilai' =>  round($pajak_bk,2)
				);
				$this->db->insert('ak_jurnal_detail', $pJurnal);
			endif;
			// Dp SO
			if($this->input->post('tunai') != "0"):
				$pJurnal = array(
					'no_jurnal' => $kdtrans,
					'no_akun' => $akun_dp_so,
					'debet' => '0',
					'kredit' => $this->input->post('tunai'),
					'debet_kredit' => 'K',
					'nilai' => $this->input->post('tunai')
				);
				$this->db->insert('ak_jurnal_detail', $pJurnal);
			endif;
			// DP
			if($this->input->post('tunai2') != "0"):
				$pJurnal = array(
					'no_jurnal' => $kdtrans,
					'no_akun' => $akun_dp,
					'debet' => '0',
					'kredit' => $this->input->post('tunai2'),
					'debet_kredit' => 'K',
					'nilai' => $this->input->post('tunai2')
				);
				$this->db->insert('ak_jurnal_detail', $pJurnal);
			endif;
			// Hutang Dagang
			if($this->input->post('kredit') != "0"):
				$pJurnal = array(
					'no_jurnal' => $kdtrans,
					'no_akun' => $akun_kredit,
					'debet' => '0',
					'kredit' => $this->input->post('kredit'),
					'debet_kredit' => 'K',
					'nilai' => $this->input->post('kredit')
				);
				$this->db->insert('ak_jurnal_detail', $pJurnal);
			endif;
			
		endif;
		
		if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
			echo "0";
        } else {
            $this->db->trans_commit();
            echo $no_lpb;
        }
	}
	
	function generateCode($tgl,$outlet_id) {
		$arrTgl = preg_split("[-]",$tgl);
		$bln = $arrTgl[1];
		$thn = substr($arrTgl[0],-2);
		$periode = $arrTgl[0]."-".$arrTgl[1];
		//$kd_unit = $this->session->userdata('kd_unit');
		$this->db->query("delete from trans_pembelian_brg where outlet_id='".$outlet_id."' and no_lpb not in (select no_lpb from trans_pembelian_brg_child)");
		$sql = $this->db->query("select MAX(SUBSTRING_INDEX(no_lpb,'.',1)) as jml from trans_pembelian_brg where DATE_FORMAT(tgl_pembelian,'%Y-%m') = '".$periode."'");
		if($sql==NULL){
			$no_bukti = '0001.'.$outlet_id.'-LPB.'.$bln.$thn;
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
			$no_bukti = $no_urut.'.'.$outlet_id.'-LPB.'.$bln.$thn;
		}
		return $no_bukti;
	}
	
	function hapus() {
		$no_lpb = $this->input->post('idrec');
		
		$this->db->trans_begin();
		$this->db->delete("trans_pembelian_brg",array('kdtrans' => $no_lpb));
		$this->db->delete("rpt_stock",array('notrans' => $no_lpb));
		$this->msistem->log_book('Delete data No Transaksi "'.$no_lpb,'pb1',$this->session->userdata('sis_user'));
		if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
			echo "0";
        } else {
            $this->db->trans_commit();
			echo "1";
        }
	}
	
	function loadDataPesanan($outlet_id="",$field="",$kunci="",$tglAwal="",$tglAkhir="") {
		$qr = "";
		if($kunci != "0"):
			$qr = " and $field like '%".$kunci."%'";
		endif;
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select tb1.*,sum(tb2.qtyBeli) as qtyBeli from (select a.company_id,a.outlet_id,a.id,a.kdtrans,a.tgl,a.tgl_kirim,a.keterangan,a.total_akhir,a.tunai_dp,sum(b.qtyPesan) as jml_pesanan,c.nmrekan as supplier,a.pajak_persen,a.pajak_rupiah,a.idtermin from trans_pesenan_beli a inner join trans_pesenan_beli_child b on a.kdtrans = b.kdtrans left join master_rekan_bisnis c on a.company_id = c.idrekan where a.outlet_id = '".$outlet_id."' and a.tgl >= '".$tglAwal."' and a.tgl <= '".$tglAkhir."' and tutup = '0' $qr group by a.kdtrans) as tb1 left join v_pembelian_brg tb2 on tb1.kdtrans = tb2.no_po group by tb1.kdtrans having jml_pesanan != sum(ifnull(tb2.qtyBeli,0))","id","id,kdtrans,tgl,supplier,tgl_kirim,jml_pesanan,total_akhir,tunai_dp,outlet_id,company_id,pajak_persen,pajak_rupiah,idtermin");
		
		//left join trans_pembelian_brg d on a.kdtrans = d.no_po inner join trans_pembelian_brg_child e on d.kdtrans = e.kdtrans
	}
	
	function brgPesanan($noPesanan="") {
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select a.id,a.idbarang,b.nmbarang,b.nmwarna,b.nmsize,b.nmsatuan,sum(ifnull(a.qtyPesan,0) - ifnull(c.qtyBeli,0)) as qtyPesan,e.harga,a.disc,a.pajak,'0' as ksg,a.jumlah,b.harga_beli,b.nmtipe,b.nmjenis,b.nmkategori,a.discrp,a.pajak from trans_pesenan_beli_child a inner join v_master_barang_detail b on a.idbarang = b.idbarang left join v_pembelian_brg c on a.kdtrans = c.no_po and a.idbarang = c.idbarang INNER JOIN trans_pesenan_beli d on a.kdtrans = d.kdtrans LEFT JOIN v_harga_barang e on b.idgroup_barang = e.idbarang and e.outlet_id = d.outlet_id and tgl_berlaku <= now() where a.kdtrans = '".$noPesanan."' group by a.idbarang having sum(ifnull(a.qtyPesan,0)) > sum(ifnull(c.qtyBeli,0))","id","idbarang,nmbarang,nmwarna,nmsize,nmsatuan,qtyPesan,harga,disc,pajak,ksg,ksg,jumlah,harga_beli,nmtipe,nmjenis,nmkategori,ksg,discrp,pajak");
	}
	
	function barcodeLine2($kdtrans="") {
		
		$x = 0;
		$sql = $this->db->query("select b.barcode,a.qtyBeli,b.nmbarang,c.harga from trans_pembelian_brg_child a inner join trans_pembelian_brg f on a.kdtrans = f.kdtrans inner join v_master_barang_detail b on a.idbarang = b.idbarang left JOIN v_harga_barang c on b.idgroup_barang = c.idbarang and c.outlet_id = f.outlet_id and tgl_berlaku <= now() where a.kdtrans = '".$kdtrans."'");
		foreach($sql->result() as $rs) {
			for($i=1;$i<=$rs->qtyBeli;$i++) {
				$arrBarcode[$x] = $rs->barcode;
				$arrNmBarang[$x] = $rs->nmbarang;
				$arrHrg[$x] = $rs->harga;
				$x++;
			}
		}
		echo '<table width="377" border="0" cellpadding="0" cellspacing="0">';
		 /*  <tr>
			<td width="40" height="75">&nbsp;</td>
			<td width="162">&nbsp;</td>
			<td width="175">&nbsp;</td>
		  </tr>'; */
		  
	   $i = 0;
	   while($i<$x) {
	   	  $index_1 = $i;
		  $index_2 = $i + 1;
		  
		  if(isset($arrBarcode[$index_1])) {
			  $text_1 = $arrBarcode[$index_1];
			  $harga_1 = $this->msistem->format_angka($arrHrg[$index_1]);
			  $nmbarang_1 = $this->msistem->pecahString($arrNmBarang[$index_1]);
			  $barcode_harga_1 = $this->msistem->pecahString($text_1); //."Rp.".$harga_1;
			  $cetakBarcode_1 = '&nbsp;&nbsp;'.$nmbarang_1.'<br /><img alt="testing" src="'.base_url().'index.php/master_barang/barcode/40/'.$text_1.'" style="padding-top:0; margin-top:0px;" align="bottom" /><br />&nbsp;&nbsp;'.$barcode_harga_1.'<div style="width:auto; height:25.5px;">&nbsp;</div>';
		  } else {
		  	  $cetakBarcode_1 = "";
		  }
		  
		  if(isset($arrBarcode[$index_2])) {
			  $text_2 = $arrBarcode[$index_2];
			  $harga_2 = $this->msistem->format_angka($arrHrg[$index_2]);
			  $nmbarang_2 = $this->msistem->pecahString($arrNmBarang[$index_2]);
			  $barcode_harga_2 = $this->msistem->pecahString($text_2); //."Rp.".$harga_2;
			  $cetakBarcode_2 = '&nbsp;&nbsp;'.$nmbarang_2.'<br /><img alt="testing" src="'.base_url().'index.php/master_barang/barcode/40/'.$text_2.'" style="padding-top:0; margin-top:0px;" align="bottom" /><br />&nbsp;&nbsp;'.$barcode_harga_2.'<div style="width:auto; height:25.5px;">&nbsp;</div>';
		  } else {
		  	   $cetakBarcode_2 = "";
		  }
  
		  
			echo '<tr style="font-family:Arial, Helvetica, sans-serif; font-size:10px;">';
			 echo '<td width="40" height="30">&nbsp;</td>';
			 echo '<td width="162">'.$cetakBarcode_1.'</td>';
			 echo '<td width="175">'.$cetakBarcode_2.'</td>';
			 echo '</tr>';
		   $i = $i+2;
		}
			 echo '</table>';

	}
	
	/* function barcodeLine3($kdtrans="") {
		
		$x = 0;
		$sql = $this->db->query("select b.barcode,a.qtyBeli,concat(b.nmbarang,' u',b.nmsize) as nmbarang,c.harga from trans_pembelian_brg_child a inner join trans_pembelian_brg f on a.kdtrans = f.kdtrans inner join v_master_barang_detail b on a.idbarang = b.idbarang inner JOIN v_harga_barang c on b.idgroup_barang = c.idbarang and c.outlet_id = f.outlet_id and tgl_berlaku <= now() where a.kdtrans = '".$kdtrans."'");
		foreach($sql->result() as $rs) {
			for($i=1;$i<=$rs->qtyBeli;$i++) {
				$arrBarcode[$x] = $rs->barcode;
				$arrNmBarang[$x] = $rs->nmbarang;
				$arrHrg[$x] = $rs->harga;
				$x++;
			}
		}
		echo '<table width="377" border="0" cellpadding="0" cellspacing="0">';
  		echo '<tr>';
		echo '<td width="11" height="51">&nbsp;</td>';
    	echo '<td width="117">&nbsp;</td>';
    	echo '<td width="122">&nbsp;</td>';
    	echo '<td width="127">&nbsp;</td>';
  		echo '</tr>';
		  
	   $i = 0;
	   while($i<$x) {
	   	  $index_1 = $i;
		  $index_2 = $i + 1;
		  $index_3 = $i + 2;
		  
		  if(isset($arrBarcode[$index_1])) {
			  $text_1 = $arrBarcode[$index_1];
			  $harga_1 = $this->msistem->format_angka($arrHrg[$index_1]);
			  $nmbarang_1 = $arrNmBarang[$index_1];
			  $barcode_harga_1 = $text_1; //."Rp.".$harga_1;
			  $cetakBarcode_1 = '&nbsp;&nbsp;'.$nmbarang_1.'<br /><img alt="testing" src="'.base_url().'index.php/master_barang/barcode/30/'.$text_1.'" style="padding-top:0; margin-top:0px;" align="bottom" /><br />&nbsp;&nbsp;'.$barcode_harga_1.'<br />&nbsp;';
		  } else {
		  	  $cetakBarcode_1 = "";
		  }
		  
		  if(isset($arrBarcode[$index_2])) {
			  $text_2 = $arrBarcode[$index_2];
			  $harga_2 = $this->msistem->format_angka($arrHrg[$index_2]);
			  $nmbarang_2 = $arrNmBarang[$index_2];
			  $barcode_harga_2 = $text_2; //."Rp.".$harga_2;
			  $cetakBarcode_2 = '&nbsp;&nbsp;'.$nmbarang_2.'<br /><img alt="testing" src="'.base_url().'index.php/master_barang/barcode/30/'.$text_2.'" style="padding-top:0; margin-top:0px;" align="bottom" /><br />&nbsp;&nbsp;'.$barcode_harga_2.'<br />&nbsp;';
		  } else {
		  	  $cetakBarcode_2 = "";
		  }
		  
		  if(isset($arrBarcode[$index_3])) {
			  $text_3 = $arrBarcode[$index_3];
			  $harga_3 = $this->msistem->format_angka($arrHrg[$index_3]);
			  $nmbarang_3 = $arrNmBarang[$index_3];
			  $barcode_harga_3 = $text_3; //."Rp.".$harga_3;
			  $cetakBarcode_3 = '&nbsp;&nbsp;'.$nmbarang_3.'<br /><img alt="testing" src="'.base_url().'index.php/master_barang/barcode/30/'.$text_3.'" style="padding-top:0; margin-top:0px;" align="bottom" /><br />&nbsp;&nbsp;'.$barcode_harga_3.'<br />&nbsp;';
		  } else {
		  	  $cetakBarcode_3 = "";
		  }
  
		  
			 echo '<tr style="font-family:Arial, Helvetica, sans-serif; font-size:9px;">';
			 echo '<td height="30">&nbsp;</td>';
			 echo '<td>'.$cetakBarcode_1.'</td>';
			 echo '<td>'.$cetakBarcode_2.'</td>';
			 echo '<td>'.$cetakBarcode_3.'</td>';
			 echo '</tr>';	
		   $i = $i+3;
		}
			 echo '</table>';

	} */
	
	function cetak_lpb($kode=""){
		//$kode = '0005.P1010-PB.0714';
		//setting pdf
		//require_once APPPATH.'3rdparty/tcpdf/config/lang/eng'.EXT;
		//sql
		error_reporting(0);
		$sql = $this->db->query("SELECT
			trans_pembelian_brg.id,
			trans_pembelian_brg.kdtrans,
			trans_pembelian_brg.tgl,
			trans_pembelian_brg.no_po,
			trans_pembelian_brg.sub_total_item,
			trans_pembelian_brg.sub_total_terima,
			trans_pembelian_brg.sub_total,
			trans_pembelian_brg.potongan_persen,
			trans_pembelian_brg.potongan_rupiah,
			trans_pembelian_brg.pajak_persen,
			trans_pembelian_brg.pajak_rupiah,
			trans_pembelian_brg.total_akhir,
			trans_pembelian_brg.tunai_dp,
			trans_pembelian_brg.kredit,
			trans_pembelian_brg.keterangan,
			trans_pembelian_brg.flag,
			trans_pembelian_brg.created_by,
			trans_pembelian_brg.created,
			trans_pembelian_brg.modified_by,
			trans_pembelian_brg.modified,
			master_rekan_bisnis.nmrekan,
			master_rekan_bisnis.telp_1,
			master_rekan_bisnis.telp_2,
			master_rekan_bisnis.fax,
			master_alamat_rekan.alamat as alamat_supl,
			b.city_name as city_name_supl,
			sys_termin_pembayaran.jml_hari,
			master_company.nm_outlet,
			master_company.alamat,
			master_company.tlp,
			master_company.fax as fax_company,
			a.city_name,
			c.nmtermin
			FROM
			trans_pembelian_brg
			LEFT JOIN trans_pesenan_beli ON trans_pembelian_brg.no_po = trans_pesenan_beli.kdtrans
			LEFT JOIN master_rekan_bisnis ON trans_pesenan_beli.company_id = master_rekan_bisnis.idrekan
			LEFT JOIN master_alamat_rekan ON master_alamat_rekan.idrekan = master_rekan_bisnis.idrekan and master_alamat_rekan.idjnsalamat = '1'
			LEFT JOIN sys_termin_pembayaran ON master_rekan_bisnis.idtermin = sys_termin_pembayaran.idtermin
			LEFT JOIN master_company ON trans_pembelian_brg.outlet_id = master_company.outlet_id 
			LEFT JOIN master_city a on a.city_code = master_company.city_code
			LEFT JOIN master_city b on b.city_code = master_alamat_rekan.city_code
			LEFT JOIN sys_termin_pembayaran c on c.idtermin = trans_pesenan_beli.idtermin
			WHERE trans_pembelian_brg.kdtrans = '".$kode."'")->row(); 
		
		// Data Kantor Pusat
		$qPst = $this->db->query("select a.nm_outlet,a.alamat,a.alamat_tambahan,a.tlp,a.fax,b.city_name from master_company a left join master_city b on a.city_code = b.city_code where a.outlet_id = '".$this->session->userdata('outlet_id')."'")->row();
		
		// Data Detail
		$sqlDetail = $this->db->query("select b.idbarang_induk,b.nmbarang,b.nmwarna,b.idsize,b.file_gambar,a.qtyBeli,a.harga,a.disc,a.discrp,a.pajak,a.jumlah,b.idbarang_induk from trans_pembelian_brg_child a left join v_master_barang_detail b on a.idbarang = b.idbarang where kdtrans = '".$kode."' order by b.idbarang");
foreach($sqlDetail->result() as $rs) {
	$nmbarang[$rs->idbarang_induk] = $rs->nmbarang;	
	$gambar[$rs->idbarang_induk] = $rs->file_gambar;
	$warna[$rs->idbarang_induk] = $rs->nmwarna;
	$arrSize[$rs->idsize] = $rs->idsize;
	$qty[$rs->idbarang_induk][$rs->idsize] = $rs->qtyBeli;
	$harga[$rs->idbarang_induk] = $rs->harga;
	$discRp[$rs->idbarang_induk] = $rs->discrp;
	$pajak[$rs->idbarang_induk] = $rs->pajak;
	$jumlah[$rs->idbarang_induk] = $jumlah[$rs->idbarang_induk] + $rs->jumlah;
	$jmlSize[$rs->idsize] = $jmlSize[$rs->idsize] + $rs->qtyBeli; 
}
$lbr = 25;
asort($arrSize);
			
		$this->load->library('header/header_pembelian');
		
		// create new PDF document
		$pdf = new header_pembelian("P", PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Ari Karniawan');
		$pdf->SetTitle('Pesanan Pembelian');
		$pdf->SetSubject('Pesanan Pembelian');
		$pdf->SetKeywords('Pesanan Pembelian, sis');
		 
		// set default header data
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
		$pdf->setPrintHeader(true);
		$pdf->setPrintFooter(true);

		// set header and footer fonts
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		
		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		
		$pdf->kode($kode);
		$pdf->nmrekan($sql->nmrekan);
		$pdf->nm_outlet($sql->nm_outlet);
		$pdf->alamat_supl($sql->alamat_supl);
		$pdf->alamat($sql->alamat);
		$pdf->city_name_supl($sql->city_name_supl);
		$pdf->city_name($sql->city_name);
		$pdf->telp_1($sql->telp_1);
		$pdf->fax($sql->fax);
		$pdf->tlp($sql->tlp);
		$pdf->fax_company($sql->fax_company);
		$pdf->jml_hari($sql->nmtermin);
		$pdf->tgl($this->msistem->conversiTglDB($sql->tgl));
		$pdf->keterangan($sql->keterangan);
		$pdf->po_no($sql->no_po);
		
		$pdf->kantorPst($qPst->nm_outlet);
		$pdf->alamatPst($qPst->alamat);
		$pdf->alamatTambahanPst($qPst->alamat_tambahan);
		$pdf->cityPst($qPst->city_name);
		$pdf->tlpPst($qPst->tlp);
		$pdf->faxPst($qPst->fax);
		
		// Data Detail
		$pdf->lbr($lbr);
		$pdf->arrSize($arrSize);
		
		//set margins
		$pdf->SetMargins(11,74,10);
		$pdf->SetHeaderMargin(10);
		
		//set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		
		//set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		 
		// set font
		$pdf->SetFont('times', '', 10);
		 
		// add a page
		$pdf->setPrintFooter(true);
		$pdf->AddPage();
		 
		

$report = '<table width="701" border="1">';

$no = 1; $tDisc = 0; $tTotal = 0;
foreach($nmbarang as $idbarang => $nmbarang) {
	$gbr = '<img src="gambar/'.$gambar[$idbarang].'" width="100" height="40" style="padding-top:50px;" />';
	//$GT = $total[$idbarang];
	$report .=  '<tr>
		<td width="20" align="center">'.$no.'</td>
		<td width="110" align="center"><br />&nbsp;'.$gbr.'</td>
		<td width="120">&nbsp;'.$nmbarang.'<br />&nbsp;Article : '.$idbarang.'<br />&nbsp;Color :'.$warna[$idbarang].'</td>';
		
	 $total = 0;
			foreach($arrSize as $s) {
				if(isset($qty[$idbarang][$s])) {
					$jml = $qty[$idbarang][$s];
				} else {
					$jml = "";
				}
				$report .= '<td width="'.$lbr.'" align="center">'.$jml.'</td>';
				$total = $total + $jml;
			}
		
	$report .= '<td width="30" align="center">'.$total.'</td>
		<td width="50" align="right">'.$this->msistem->format_angka($harga[$idbarang]).'&nbsp;&nbsp;</td>
		<td width="45" align="right">'.$this->msistem->format_angka($discRp[$idbarang]).'&nbsp;&nbsp;</td>
		<td width="30" align="center">'.$pajak[$idbarang].'</td>
		<td width="70" align="right">'.$this->msistem->format_angka($jumlah[$idbarang]).'&nbsp;&nbsp;</td>
	  </tr>';
	  $no++;
	  $tDisc = $tDisc + $discRp[$idbarang];
	  $tTotal = $tTotal + $jumlah[$idbarang];
}
  
  
  $report .= '<tr>
   <td colspan="3">&nbsp;JUMLAH</td>';
   
  			$GT = 0;
			foreach($arrSize as $s) {	
				$tSize = $jmlSize[$s];
				$report .= '<td align="center">'.$tSize.'</td>';
				$GT = $GT + $tSize;
			}
  
    $report .= '<td align="center">'.$GT.'</td>
	 <td colspan="3">&nbsp;</td>
	  <td align="right">'.$this->msistem->format_angka($tTotal).'&nbsp;&nbsp;</td>
  </tr>';
  
  $width = count($arrSize) * $lbr;
  $colspan = 4 + count($arrSize);
  $report .= '
  	<tr>
		<td colspan="'.$colspan.'" rowspan="4" align="left">&nbsp;Keterangan : <br />&nbsp;'.$sql->keterangan.'</td>
		<td align="right" colspan="3"><strong>SUB TOTAL :&nbsp;&nbsp;</strong></td>
		<td align="right"><strong>'.$this->msistem->format_angka($sql->sub_total).'&nbsp;&nbsp;</strong></td>
	</tr>
	<tr>
		<td align="right" colspan="3"><strong>POTONGAN :&nbsp;&nbsp;</strong></td>
		<td align="right"><strong>'.$this->msistem->format_angka($sql->potongan_rupiah).'&nbsp;&nbsp;</strong></td>
	</tr>
	<tr>
		<td align="right" colspan="3"><strong>PAJAK :&nbsp;&nbsp;</strong></td>
		<td align="right"><strong>'.$this->msistem->format_angka($sql->pajak_rupiah).'&nbsp;&nbsp;</strong></td>
	</tr>
	<tr>
		<td align="right" colspan="3"><strong>TOTAL :&nbsp;&nbsp;</strong></td>
		<td align="right"><strong>'.$this->msistem->format_angka($sql->total_akhir).'&nbsp;&nbsp;</strong></td>
	</tr>
	</table>';
	
  $q = $this->db->query("select * from sys_label where id in (5,6,7)");
  foreach($q->result() as $r) {
		$arrLabel[$r->id] = $r->isi;	  
  }
  $report .= '<table width="712" border="0">
  <tr>
    <td width="100" height="30" align="center"></td>
    <td width="200" colspan="2" align="center"></td>
    <td width="120" align="center"></td>
    <td width="80" align="center"></td>
    <td width="80" align="center"></td>
  </tr>
  <tr>
    <td align="center">Dibuat Oleh</td>
    <td colspan="2" align="center">Diketahui</td>
    <td align="center">Disetujui</td>
    <td align="center"></td>
    <td align="center"></td>
  </tr>
  <tr>
    <td height="65"></td>
    <td width="100">&nbsp;</td>
    <td width="100">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
   <tr>
    <td align="center">('.$this->session->userdata('namauser').')</td>
    <td align="center">('.$arrLabel[5].')</td>
    <td align="center">('.$arrLabel[6].')</td>
    <td align="center">('.$arrLabel[7].')</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
';
 
		$pdf->writeHTML($report, true, false, true, false);
		//$pdf->setPrintFooter(true);
		$pdf->lastPage();
		$pdf->Output('IR_'.$kode.'.pdf', 'I');	
	}
	
	function upload() {
		echo '<script>parent.actionUpload_pb1();</script>';
		//echo "OK"; parent.actionUpload_pb1();
	}
	
	function akunPotBeli($outlet_id="",$kdtrans="") {
		if($kdtrans=="") {
			$rs = $this->db->query("select la_disc_beli from master_company where outlet_id = '".$outlet_id."'")->row();
			$data['la_disc_beli'] = $rs->la_disc_beli;
		} else {
			$rs = $this->db->query("select la_disc_beli from trans_pembelian_brg where kdtrans = '".$kdtrans."'")->row();
			$data['la_disc_beli'] = $rs->la_disc_beli;	
		}
		$this->load->view('pembelian_barang/pb_akunpotbeli',$data);
	}
	
	function akunPajak($outlet_id="",$kdtrans="") {
		if($kdtrans=="") {
			$rs = $this->db->query("select la_pajak_beli from master_company where outlet_id = '".$outlet_id."'")->row();
			$data['la_pajak_beli'] = $rs->la_pajak_beli;
		} else {
			$rs = $this->db->query("select la_pajak_beli from trans_pembelian_brg where kdtrans = '".$kdtrans."'")->row();
			$data['la_pajak_beli'] = $rs->la_pajak_beli;	
		}
		$this->load->view('pembelian_barang/pb_akunpajak',$data);
	}
	
	function akunBiayaKirim($outlet_id="",$kdtrans="") {
		if($kdtrans=="") {
			$rs = $this->db->query("select la_pajak_beli,la_biaya_angkut_beli from master_company where outlet_id = '".$outlet_id."'")->row();
			$data['la_pajak_bk'] = $rs->la_pajak_beli;
			$data['la_biaya_angkut_beli'] = $rs->la_biaya_angkut_beli;
		} else {
			$rs = $this->db->query("select la_pajak_bk,la_biaya_angkut_beli from trans_pembelian_brg where kdtrans = '".$kdtrans."'")->row();
			$data['la_pajak_bk'] = $rs->la_pajak_bk;
			$data['la_biaya_angkut_beli'] = $rs->la_biaya_angkut_beli;	
		}
		$this->load->view('pembelian_barang/pb_akunbk',$data);
	}
	
	function akunDpSo($outlet_id="",$kdtrans="") {
		if($kdtrans=="") {
			$rs = $this->db->query("select la_dp_pesen_beli from master_company where outlet_id = '".$outlet_id."'")->row();
			$data['la_dp_pesen_beli'] = $rs->la_dp_pesen_beli;
		} else {
			$rs = $this->db->query("select la_dp_pesen_beli from trans_pembelian_brg where kdtrans = '".$kdtrans."'")->row();
			$data['la_dp_pesen_beli'] = $rs->la_dp_pesen_beli;	
		}
		$this->load->view('pembelian_barang/pb_akundpso',$data);
	}
	
	function akunDp($outlet_id="",$kdtrans="") {
		if($kdtrans=="") {
			$rs = $this->db->query("select la_uang_muka_beli from master_company where outlet_id = '".$outlet_id."'")->row();
			$data['la_uang_muka_beli'] = $rs->la_uang_muka_beli;
		} else {
			$rs = $this->db->query("select la_uang_muka_beli from trans_pembelian_brg where kdtrans = '".$kdtrans."'")->row();
			$data['la_uang_muka_beli'] = $rs->la_uang_muka_beli;	
		}
		$this->load->view('pembelian_barang/pb_akundp',$data);
	}
	
	function akunHd($outlet_id="",$kdtrans="") {
		if($kdtrans=="") {
			$rs = $this->db->query("select la_akun_hd from master_company where outlet_id = '".$outlet_id."'")->row();
			$data['la_akun_hd'] = $rs->la_akun_hd;
		} else {
			$rs = $this->db->query("select la_akun_hd from trans_pembelian_brg where kdtrans = '".$kdtrans."'")->row();
			$data['la_akun_hd'] = $rs->la_akun_hd;	
		}
		$this->load->view('pembelian_barang/pb_akunhd',$data);
	}
	
}
?>