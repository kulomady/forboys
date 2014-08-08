<?php 
class harga_barang extends SIS_Controller {

	public function __construct() {
        parent::__construct();   
        $this->load->model('m_company');
		$this->load->model('m_perkiraan');
    }
 
	public function index() {
		$data['hak_toolbar'] = $this->msistem->hak_toolbar('md41');
		$this->load->view('harga_barang/hb_index',$data);
	}	
	
	function frm_input() {
		$this->load->view('harga_barang/hb_input');
	}
	
	function frm_edit($idrec="") {
		$r = $this->db->query("select id,kdharga,keterangan,tgl_berlaku,is_active from master_harga_barang where id = '".$idrec."'")->row();		
		$data = array (
			'id' => $r->id,
			'kode' => $r->kdharga,
			'ket' => $r->keterangan,
			'tgl_berlaku' => $this->msistem->conversiTglDB($r->tgl_berlaku),
			'active' => $r->is_active
		);
		$this->load->view('harga_barang/hb_input',$data);
	}
	
	function getIndukPerkiraan() {
		$idKelompok = $this->input->post('idKelompok');
		$sclIndukPerkiraan = $this->m_perkiraan->pilihIndukPerkiraan($idParent,$idKelompok);
		echo $sclIndukPerkiraan;
	}
	
	function simpan() {
		$tglBerlaku = $this->msistem->conversiTgl($this->input->post("txtTglBerlaku"));
		$kdharga = strtoupper($this->input->post("txtKode"));
		$data = array (
			'kdharga' => $kdharga,
			'keterangan' => strtoupper($this->input->post("txtKet")),
			'tgl_berlaku' => $tglBerlaku,
			'is_active' => $this->input->post("aktif")
		);
		$this->db->trans_begin();
		if($this->input->post("id")=="") {
			$dataIns = array_merge($data,array('created' => date("Y-m-d H:i:s"), 'created_by' => $this->session->userdata('sis_user')));
			$this->db->insert('master_harga_barang', $dataIns);
			$this->msistem->log_book('Input data Harga Kode "'.$kdharga,'md41',$this->session->userdata('sis_user'));
		} else {
			$dataUpdate = array_merge($data,array('modified_by' => $this->session->userdata('sis_user')));
			$this->db->update('master_harga_barang',$dataUpdate,array('id' => $this->input->post("id")));
			$this->msistem->log_book('Update data Harga Kode "'.$kdharga,'md41',$this->session->userdata('sis_user'));
		}
		
		// input barang detail
		$item_detail = $this->input->post('detailBrg');
		$table = 'master_harga_barang_detail';
		$dataIns = array('idbarang','harga','disc_1','disc_2','disc_3','disc_4');
		$fk = array('kdharga' => $kdharga);
		$this->msistem->insertDB($item_detail,$table,$dataIns,$fk);
		
		// input outlet
		$dataOulet = $this->input->post('dataOulet');
		$table = 'master_harga_outlet';
		$dataIns = array('is_active','outlet_id');
		$fk = array('kdharga' => $kdharga);
		$this->msistem->insertDB($dataOulet,$table,$dataIns,$fk);
		$this->db->query("delete from master_harga_outlet where is_active = '0' and kdharga = '".$kdharga."'");
		
		if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
			echo "0";
        } else {
            $this->db->trans_commit();
			echo "1";
        }
	}
	
	function loadMainData($kode="",$nama="") {
		$qr = "";
		if($kode != '0'):
			$qr .= "and kdharga like '%".$kode."%'";
		endif;
		if($nama != '0'):
			$qr .= "and keterangan like '%".$nama."%'";
		endif;
		
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select id,kdharga,keterangan,tgl_berlaku,created,created_by,if(is_active=1,'YES','NO') as is_active from master_harga_barang where keterangan is not null $qr","id","id,kdharga,keterangan,tgl_berlaku,created,created_by,is_active");
	}
	
	function hapus() {
		$idrec = $this->input->post('idrec');
		$this->db->trans_begin();
		// log delete
		$r = $this->db->query("select kdharga from master_harga_barang where id = '".$idrec."'")->row();
		$kdharga = $r->kdharga;
		$this->msistem->log_delete("master_harga_barang","where kdharga = '$kdharga'");
		// Hapus
		$this->db->delete("master_harga_barang",array('id' => $idrec));
		$this->msistem->log_book('Delete data id "'.$idrec,'md41',$this->session->userdata('sis_user'));
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
		$img = '<img id="btnTglBerlaku_md41" src="../../assets/img/icon/calendar.gif" border="0" style="cursor:pointer;" onclick="show_w4_md41(0);" />';
		$img_del = '<img id="btnTglBerlaku_md41" src="../../assets/img/icon/tongsampah.png" border="0" style="cursor:pointer;" onclick="hapusDetail_md41(0);" />';
		$grid = new GridConnector($this->db->conn_id);
	    $grid->render_sql("select a.id,a.idbarang,a.harga,a.disc_1,a.disc_2,a.disc_3,a.disc_4,b.nmbarang,a.kdharga,c.nmsatuan,'$img' as img,'$img_del' as img_del from master_harga_barang_detail a INNER JOIN v_master_barang_detail b on a.idbarang = b.idgroup_barang left join ref_satuan_barang c on b.idsatuan = c.idsatuan where kdharga = '".$kodeHrg."' GROUP BY b.idgroup_barang,a.kdharga","id","id,idbarang,img,nmbarang,nmsatuan,harga,disc_1,disc_2,disc_3,disc_4,img_del");
		
	}
	
	
	function importData() {
		error_reporting(0);
		$this->load->library('Spreadsheet_Excel_Reader');
		$file =  $_FILES['userfile']['tmp_name'];
		if($file == ''):
			return;
		endif;
		
		$dataExcel = new Spreadsheet_Excel_Reader($file);
		$baris = $dataExcel->rowcount($sheet_index=0);
		$jsData = "";
		$jmlInput = 0;
		$jmlError = 0;
		$jmlData = $baris -1;
		for ($i=2; $i<=$baris; $i++)
		{
			$idbarang = trim($dataExcel->val($i,1));
			$harga = trim($dataExcel->val($i,3));
			$disc_1 = trim($dataExcel->val($i,4));
			$disc_2 = trim($dataExcel->val($i,5));
			$disc_3 = trim($dataExcel->val($i,6));
			$disc_4 = trim($dataExcel->val($i,7));
			
			if($idbarang != ""):
				$q = $this->db->query("select a.nmwarna,a.nmsatuan,a.nmbarang from v_master_barang a where a.idbarang = '".$idbarang."'");
				if(count($q->result()) != '0') {
					$r = $q->row();
					$warna = $r->nmwarna;
					$satuan = $r->nmsatuan;
					$nmbarang = $r->nmbarang." ".$warna;
					$data = $idbarang."|".$nmbarang."|".$satuan."|".$harga."|".$disc_1."|".$disc_2."|".$disc_3."|".$disc_4;
					$jsData .= $data."~";
					$jmlInput++;
				} else {
					echo "<span style=color:#FFFFFF>".$idbarang." Tidak Terdaftar Di Master Barang</span><br />";
					$jmlError++;
				}
			endif;
		}
		echo "<br /><span style=color:#FFFFFF>Jumlah Data Diproses : ".$jmlData."</span><br />";
		echo "<span style=color:#FFFFFF>Jumlah Terinput : ".$jmlInput."</span><br />";
		echo "<span style=color:#FFFFFF>Jumlah Error : ".$jmlError."</span><br />";
		echo '<script>parent.actionUpload_md41("'.$jsData.'");</script>';
	}
	
	function exportExcel($kdharga) {
		$data['query'] = $this->db->query("select a.id,a.idbarang,a.harga,a.disc_1,a.disc_2,a.disc_3,a.disc_4,b.nmbarang,a.kdharga,c.nmsatuan from master_harga_barang_detail a INNER JOIN v_master_barang_detail b on a.idbarang = b.idgroup_barang left join ref_satuan_barang c on b.idsatuan = c.idsatuan where kdharga = '".$kdharga."' GROUP BY b.idgroup_barang,a.kdharga");
		$data['kode'] = $kdharga;
		$this->load->view('harga_barang/hb_export',$data);
	}
	
}
?>