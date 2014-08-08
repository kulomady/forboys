<?php 
class persediaan_awal extends SIS_Controller {

	public function __construct() {
        parent::__construct();   
        $this->load->model('m_company');
		$this->load->model('m_perkiraan');
		$this->load->model('msistem');
    }
 
	public function index() {
		$data['hak_toolbar'] = $this->msistem->hak_toolbar('pd1');
		$data['gudang'] = $this->m_company->pilihLokasi('0');
		$data['bln'] = $this->msistem->bulan();
		$data['thn'] = $this->msistem->tahun();
		
		$this->load->view('persediaan_awal/pa_index',$data);
	}	
	
	function frm_input() {
		$data['gudang'] = $this->m_company->pilihLokasi('0');
		$data['periode'] = $this->m_company->periodeAwal();
		$data['kolomPcs'] = $this->msistem->kolomPcs();
		$data['setBarcode'] = $this->msistem->setBarcode();
		$this->load->view('persediaan_awal/pa_input',$data);
	}
	
	function frm_edit($kdtrans="") {
		$r = $this->db->query("select a.id,a.kdtrans,a.periode,a.outlet_id,a.keterangan,a.idperkiraan,b.nmperkiraan from tr_persediaan_awal a left join ak_master_perkiraan b on a.idperkiraan = b.idperkiraan where a.kdtrans = '".$kdtrans."'")->row();		
		$data = array (
			'id' => $r->id,
			'kdtrans' => $r->kdtrans,
			'periode' => $r->periode,
			'keterangan' => $r->keterangan,
			'idperkiraan' => $r->idperkiraan,
			'gudang' => $this->m_company->pilihLokasi($r->outlet_id),
			'nmperkiraan' => $r->nmperkiraan
		);
		$data['kolomPcs'] = $this->msistem->kolomPcs();
		$data['setBarcode'] = $this->msistem->setBarcode();
		$this->load->view('persediaan_awal/pa_input',$data);
	}
	
	function cetak($kdtrans="") {
		$r = $this->db->query("select a.id,a.kdtrans,a.periode,a.outlet_id,a.keterangan,a.idperkiraan,b.nmperkiraan,c.nm_outlet from tr_persediaan_awal a inner join ak_master_perkiraan b on a.idperkiraan = b.idperkiraan inner join master_company c on a.outlet_id = c.outlet_id where a.kdtrans = '".$kdtrans."'")->row();		
		$data = array (
			'id' => $r->id,
			'kdtrans' => $r->kdtrans,
			'periode' => $r->periode,
			'keterangan' => $r->keterangan,
			'idperkiraan' => $r->idperkiraan,
			'gudang' => $r->nm_outlet,
			'idperkiraan' => $r->idperkiraan,
			'nmperkiraan' => $r->nmperkiraan,
			'dataPA' => $this->db->query("select a.*,b.nmwarna,b.nmsize,b.nmsatuan,b.nmbarang from tr_persediaan_awal_detail a inner join v_master_barang_detail b on a.idbarang = b.idbarang where a.kdtrans = '".$kdtrans."'")
		);
		$this->load->view('persediaan_awal/pa_cetak',$data);
	}
	
	function getIndukPerkiraan() {
		$idKelompok = $this->input->post('idKelompok');
		$sclIndukPerkiraan = $this->m_perkiraan->pilihIndukPerkiraan($idParent,$idKelompok);
		echo $sclIndukPerkiraan;
	}
	
	function simpan() {
		//$tglBerlaku = $this->msistem->conversiTgl($this->input->post("txtTglBerlaku"));
		//$kdharga = strtoupper($this->input->post("txtKode"));
		$sql = $this->db->query("select outlet_id,periode from tr_persediaan_awal where outlet_id = '".$this->input->post("slcOutlet_id")."' and periode = '".$this->input->post("txtPeriode")."'");
		if(count($sql->result()) != 0 && $this->input->post("kdtrans")==""):
			echo "ADA";
			return;
		endif;
		$data = array (
			'periode' => $this->input->post("txtPeriode"),
			'outlet_id' => $this->input->post("slcOutlet_id"),
			'keterangan' => strtoupper($this->input->post("txtKet")),
			'idperkiraan' => $this->input->post("kdakun")
		);
		$this->db->trans_begin();
		if($this->input->post("kdtrans")=="") {
			$kdtrans = mktime();
			$dataIns = array_merge($data,array('kdtrans' => $kdtrans,'created' => date("Y-m-d H:i:s"), 'created_by' => $this->session->userdata('sis_user')));
			$this->db->insert('tr_persediaan_awal', $dataIns);
			$this->msistem->log_book('Input data Persediaan Awal "'.$kdtrans,'pd1',$this->session->userdata('sis_user'));
		} else {
			$kdtrans = $this->input->post("kdtrans");
			$dataUpdate = array_merge($data,array('modified_by' => $this->session->userdata('sis_user')));
			$this->db->update('tr_persediaan_awal',$dataUpdate,array('kdtrans' => $this->input->post("kdtrans")));
			$this->msistem->log_book('Update data Harga Kode "'.$kdtrans,'pd1',$this->session->userdata('sis_user'));
		}
		
		// input barang detail
		$dataBrg = $this->input->post('dataBrg');
		$table = 'tr_persediaan_awal_detail';
		$dataIns = array('idbarang','jml','pcs','harga','total','hrgjual');
		$fk = array('kdtrans' => $kdtrans);
		$this->msistem->insertDB($dataBrg,$table,$dataIns,$fk);
		
		// input report stock
		$table = 'rpt_stock';
		$dataIns = array('idbarang','qty_sa','pcs_sa','','jml_sa','hrgjual_sa');
		$fk = array('notrans' => $kdtrans,'outlet_id' => $this->input->post("slcOutlet_id"),'tgl' => $this->input->post("txtPeriode"));
		$this->msistem->insertDB($dataBrg,$table,$dataIns,$fk);
		
		if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
			echo "0";
        } else {
            $this->db->trans_commit();
			echo $kdtrans;
        }
	}
	
	function loadMainData($periode="",$outlet_id="",$ket="") {
		$qr = "";
		if($outlet_id != '0'):
			$qr .= "and a.outlet_id = '".$outlet_id."'";
		endif;
		if($ket != '0'):
			$qr .= "and a.keterangan like '%".$ket."%'";
		endif;
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select a.*,b.nm_outlet from tr_persediaan_awal a inner join master_company b on a.outlet_id = b.outlet_id where DATE_FORMAT(a.periode,'%Y-%m') = '".$periode."' $qr","kdtrans","id,periode,outlet_id,nm_outlet,keterangan,created,created_by");
	}
	
	function loadDataBrgDetail($kdtrans="") {
		$img = '<img id="btnTglBerlaku_md41" src="../../assets/img/icon/calendar.gif" border="0" style="cursor:pointer;" onclick="show_win_brg(0);" />';
		$img_del = '<img id="btnTglBerlaku_md41" src="../../assets/img/icon/tongsampah.png" border="0" style="cursor:pointer;" onclick="hapusDetail(0);" />';
		$grid = new GridConnector($this->db->conn_id);
	    $grid->render_sql("select a.id,a.idbarang,a.harga,a.jml,a.pcs,a.total,a.hrgjual,b.nmbarang,b.nmwarna,b.nmsatuan,b.nmsize,'$img' as img,'$img_del' as img_del from tr_persediaan_awal_detail a INNER JOIN v_master_barang_detail b on a.idbarang = b.idbarang where a.kdtrans = '".$kdtrans."'","idbarang","idbarang,img,nmbarang,nmwarna,nmsize,nmsatuan,jml,pcs,harga,total,img_del,hrgjual");
	}
	
	function hapus() {
		$kdtrans = $this->input->post('kdtrans');
		$this->db->trans_begin();
		$this->db->delete("tr_persediaan_awal",array('kdtrans' => $kdtrans));
		$this->db->delete("rpt_stock",array('notrans' => $kdtrans));
		$this->msistem->log_book('Delete data id "'.$kdtrans,'pd1',$this->session->userdata('sis_user'));
		if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
			echo "0";
        } else {
            $this->db->trans_commit();
			echo "1";
        }
	}
	
	function frm_search_akun() {
		$this->load->view('persediaan_awal/rb_search_akun');
	}
	
	function importData() {
		error_reporting(0);
		$this->load->library('Spreadsheet_Excel_Reader');
		$file =  $_FILES['userfile']['tmp_name'];
		$outlet_id = $_POST['outlet_id'];
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
			$kode = trim($dataExcel->val($i,1));
			$size = trim($dataExcel->val($i,3));
			$qty = trim($dataExcel->val($i,4));
			$pcs = trim($dataExcel->val($i,5));
			$hrg = trim($dataExcel->val($i,6));
			
			$idbarang = $kode.".".$size;
			
			$q = $this->db->query("select a.nmwarna,a.nmsize,a.nmsatuan,a.nmbarang,b.harga from v_master_barang_detail a INNER JOIN v_harga_barang b on a.idgroup_barang = b.idbarang and b.outlet_id = '".$outlet_id."' and tgl_berlaku <= now() where a.idbarang = '".$idbarang."'");
			if(count($q->result()) != 0) {
				$r = $q->row();
				$warna = $r->nmwarna;
				$ukuran = $r->nmsize;
				$satuan = $r->nmsatuan;
				$nmbarang = $r->nmbarang;
				$hrgJual = $r->harga;
				$data = $idbarang."|".$nmbarang."|".$warna."|".$ukuran."|".$satuan."|".$qty."|".$pcs."|".$hrg."|".$hrgJual;
				$jsData .= $data."~";
				$jmlInput++;
			} else {
				echo "<span style=color:#FFFFFF>".$idbarang." Tidak Terdaftar Di Master Barang</span><br />";
				$jmlError++;
			}
		}
		echo "<br /><span style=color:#FFFFFF>Jumlah Data Diproses : ".$jmlData."</span><br />";
		echo "<span style=color:#FFFFFF>Jumlah Terinput : ".$jmlInput."</span><br />";
		echo "<span style=color:#FFFFFF>Jumlah Error : ".$jmlError."</span><br />";
		echo '<script>parent.actionUpload_pd1("'.$jsData.'");</script>';
	}
	
	function barcodeLine2($kdtrans="") {
		
		$x = 0;
		$sql = $this->db->query("select b.barcode,a.jml as qtyPesan,b.nmbarang from tr_persediaan_awal_detail a inner join tr_persediaan_awal f on a.kdtrans = f.kdtrans inner join v_master_barang_detail b on a.idbarang = b.idbarang where f.periode = '".$kdtrans."'");
		foreach($sql->result() as $rs) {
			for($i=1;$i<=$rs->qtyPesan;$i++) {
				$arrBarcode[$x] = $rs->barcode;
				$arrNmBarang[$x] = $rs->nmbarang;
				$arrHrg[$x] = ""; //$rs->harga;
				$x++;
			}
		}
		echo '<table width="377" border="0" cellpadding="0" cellspacing="0">';
		 /* <tr>
			<td width="40" height="83">&nbsp;</td>
			<td width="162">&nbsp;</td>
			<td width="175">&nbsp;</td>
		  </tr>';*/
		  
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
		$sql = $this->db->query("select b.barcode,a.jml as qtyPesan,concat(b.nmbarang,' u',b.nmsize) as nmbarang from tr_persediaan_awal_detail a inner join tr_persediaan_awal f on a.kdtrans = f.kdtrans inner join v_master_barang_detail b on a.idbarang = b.idbarang where f.periode = '".$kdtrans."'");
		foreach($sql->result() as $rs) {
			for($i=1;$i<=$rs->qtyPesan;$i++) {
				$arrBarcode[$x] = $rs->barcode;
				$arrNmBarang[$x] = $rs->nmbarang;
				$arrHrg[$x] = ""; //$rs->harga;
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
	
}
?>