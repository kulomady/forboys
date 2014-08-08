<?php 
class permintaan_barang extends SIS_Controller {

	public function __construct() {
        parent::__construct();   
        $this->load->model('m_company');
		$this->load->model('m_perkiraan');
    }
 
	public function index() {
		$data['hak_toolbar'] = $this->msistem->hak_toolbar('pd2');
		$data['gudang'] = $this->m_company->pilihLokasi('0');
		$this->load->view('permintaan_barang/pb_index',$data);
	}	
	
	function frm_input() {
		$data['gudang'] = $this->m_company->pilihLokasi(0);
		$data['tujuan'] = $this->m_company->pilihLokasi(0);
		$this->load->view('permintaan_barang/pb_input',$data);
	}
	
	function loadMainData($tglAwal="",$tglAkhir="",$asal="",$tujuan="",$ket="") {
		if($asal != "0"):
			$qr .= " and a.outlet_id = '".$asal."'";
		endif;
		if($tujuan != "0"):
			$qr .= " and a.outlet_tujuan = '".$tujuan."'";
		endif;
		if($ket != "0"):
			$qr .= " and a.keterangan like '%".$ket."%'";
		endif;
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select a.id, a.kdtrans, b.nm_outlet, DATE_FORMAT(a.tgl,'%d-%m-%Y') as tgl_pesanan, c.nm_outlet as nm_outlet2,a.created,a.created_by,a.modified,a.modified_by,a.status from tr_permintaan_barang a left join master_company b on a.outlet_id=b.outlet_id left join master_company c on a.outlet_tujuan=c.outlet_id where tgl >= '".$tglAwal."' and tgl <= '".$tglAkhir."' $qr","id","id,kdtrans,nm_outlet,tgl_pesanan,nm_outlet2,created,created_by,modified,modified_by,status");
	}
	
	function frm_edit($idrec="") {
		$r = $this->db->query("select id,tgl,tgl_kirim,outlet_id,outlet_tujuan,kdtrans,keterangan,status from tr_permintaan_barang where id = '".$idrec."'")->row();		
		$data = array (
			'id' => $r->id,
			'kdtrans' => $r->kdtrans,
			'tgl' => $this->msistem->conversiTglDB($r->tgl),
			'tgl2' => $this->msistem->conversiTglDB($r->tgl_kirim),
			'keterangan' => $r->keterangan,
			'status' => $r->status
		);
		$data['gudang'] = $this->m_company->pilihLokasi($r->outlet_id);
		$data['tujuan'] = $this->m_company->pilihLokasi($r->outlet_tujuan);
		$this->load->view('permintaan_barang/pb_input',$data);
	}
	
	function loadChild($kdtrans) {
		$img = '<img id="btnTglBerlaku_md41" src="../../assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" onclick="openWinBrg_pb4(0);" />';
		$img_del = '<img id="btnTglBerlaku_md41" src="../../assets/img/icon/tongsampah.png" border="0" style="cursor:pointer;" onclick="delRow_pb4(0);" />';
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select a.id, a.kdtrans, a.idbarang, b.nmbarang, b.nmsatuan, b.nmwarna, b.nmsize, a.harga, a.hargaBeli, a.jml_kirim, a.jml_pesan, a.pcs, a.total, '$img' as img,'$img_del' as img_del from tr_permintaan_barang_detail a left join v_master_barang_detail b on a.idbarang=b.idbarang where a.kdtrans = '".$kdtrans."'","id","idbarang,img,nmbarang,nmwarna,nmsize,nmsatuan,jml_pesan,jml_kirim,pcs,harga,total,img_del,hargaBeli");
	}
	
	function simpan() {
		if($this->input->post('tgl') != "") {
			$tglPesan = $this->msistem->conversiTgl($this->input->post('tgl'));
		} else {
			$tglPesan = "";
		}
		
		if($this->input->post('tgl2') != "") {
			$tglKirim = $this->msistem->conversiTgl($this->input->post('tgl2'));
		} else {
			$tglKirim = "";
		}
		$this->db->trans_begin();
		
		$data = array (
			'tgl' => $tglPesan,
			'outlet_id' => strtoupper($this->input->post("outlet_id")),
			'outlet_tujuan' => strtoupper($this->input->post("tujuan")),
			'tgl_kirim' => $tglKirim,
			'status' => strtoupper($this->input->post("status"))
		);
		$this->db->trans_begin();
		if($this->input->post("id")=="") {
			$kdtrans = $this->msistem->noTrans('PO','tr_permintaan_barang','',$this->input->post('tujuan'));
			$dataIns = array (
				'kdtrans' => $kdtrans,
				'created' => date("Y-m-d H:i:s"),
				'created_by' => strtoupper($this->session->userdata('sis_user'))
			);
			$data = array_merge($data,$dataIns);
			$this->db->insert('tr_permintaan_barang', $data);
			$this->msistem->log_book('Input data baru Permintaan Brg "'.$kdtrans,'pd2',$this->session->userdata('sis_user'));
		} else {
			$kdtrans = $this->input->post('kdtrans');
			$dataUpdate = array('modified_by' => strtoupper($this->session->userdata('sis_user')));
			$data = array_merge($data,$dataUpdate);
			$this->db->update('tr_permintaan_barang', $data,array('id' => $this->input->post('id')));
			$this->msistem->log_book('Edit data Permintaan Brg "'.$kdtrans,'pd2',$this->session->userdata('sis_user'));
		}
		
		// input dataBeli
		if($this->input->post('dataBrg') != ""):
			$dataBeli = $this->input->post('dataBrg');
			$table = 'tr_permintaan_barang_detail';
			$dataIns = array('idbarang','jml_pesan','jml_kirim','pcs','harga','total','hargaBeli');
			$fk = array('kdtrans' => $kdtrans);
			$this->msistem->insertDB($dataBeli,$table,$dataIns,$fk);
		endif;
		
		if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
			echo "[AUTO]";
        } else {
            $this->db->trans_commit();
            echo $kdtrans;
        }
	}
	
	function hapus() {
		$idrec = $this->input->post('idrec');
		$this->db->trans_begin();
		$this->db->delete("tr_permintaan_barang",array('kdtrans' => $idrec));
		$this->msistem->log_book('Delete data id "'.$idrec,'pd2',$this->session->userdata('sis_user'));
		if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
			echo "Hapus Data Gagal";
        } else {
            $this->db->trans_commit();
			echo "Hapus Data Berhasil";
        }
	}
	
	function cariBarang() {
		$idgroup_barang = $this->input->post('idbarang');
		$sql = $this->db->query("select nmbarang,idsatuan from v_master_barang_detail where idgroup_barang = '".$idgroup_barang."'");
		if(count($sql->result())==0) {
			echo "0";
		} else {
			$r = $sql->row();
			echo $r->nmbarang.'|'.$r->idsatuan;
		}
	}
	
	function dataHarga_outlet($kodeHrg="") {
		$grid = new GridConnector($this->db->conn_id);
        $grid->render_sql("select b.id,if(ifnull(b.kdharga,'0')='0','0','1') as status,a.nm_outlet,a.outlet_id from master_company a left join master_harga_outlet b on a.outlet_id = b.outlet_id and b.kdharga = '".$kodeHrg."' where a.is_active = '1'","id","status,nm_outlet,outlet_id");
	}
	
	function loadDataBrg_harga($kodeHrg="") {
		$img = '<img id="btnTglBerlaku_pd2" src="../../assets/img/icon/calendar.gif" border="0" style="cursor:pointer;" onclick="show_w4_pd2(0);" />';
		$img_del = '<img id="btnTglBerlaku_pd2" src="../../assets/img/icon/tongsampah.png" border="0" style="cursor:pointer;" onclick="hapusDetail_pd2(0);" />';
		$grid = new GridConnector($this->db->conn_id);
	    $grid->render_sql("select a.id,a.idbarang,a.harga,a.disc_1,a.disc_2,a.disc_3,a.disc_4,b.nmbarang,a.kdharga,c.nmsatuan,'$img' as img,'$img_del' as img_del from master_harga_barang_detail a INNER JOIN v_master_barang_detail b on a.idbarang = b.idgroup_barang left join ref_satuan_barang c on b.idsatuan = c.idsatuan where kdharga = '".$kodeHrg."' GROUP BY b.idgroup_barang,a.kdharga","id","idbarang,img,nmbarang,nmsatuan,harga,disc_1,disc_2,disc_3,disc_4,img_del");
		
	}
	
	function frm_search_akun() {
		$this->load->view('permintaan_barang/rb_search_akun');
	}
}
?>