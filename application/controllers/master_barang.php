<?php 
class master_barang extends SIS_Controller {

	public function __construct() {
        parent::__construct();   
        $this->load->model('m_company');
		$this->load->model('m_group_user');
    }
 
	public function index() {
		$data['hak_toolbar'] = $this->msistem->hak_toolbar('md3');
		$this->load->view('master_barang/mbarang_index',$data);
	}
	
	function loadMainData($nmbarang="",$kditem="",$konsinyasi="",$tipe="",$jns="",$kat="",$merk="",$warna="",$supplier="") {
		$qr = "";
		if($nmbarang != '0'):
			$qr .= "and a.nmbarang like '%".$nmbarang."%'";
		endif;
		if($konsinyasi != '0'):
			$qr .= "and a.sts_konsinyasi = '1'";
		endif;
		if($kditem != '0'):
			$qr .= "and a.idbarang like '%".$kditem."%'";
		endif;
		if($tipe != '0'):
			$qr .= "and a.idtipe_item = '".$tipe."'";
		endif;
		if($jns != '0'):
			$qr .= "and a.idjns_item = '".$jns."'";
		endif;
		if($kat != '0'):
			$qr .= "and a.idkategori = '".$kat."'";
		endif;
		if($merk != '0'):
			$qr .= "and a.idmerk = '".$merk."'";
		endif;
		if($warna != '0'):
			$qr .= "and a.idwarna = '".$warna."'";
		endif;
		if($supplier != '0'):
			$qr .= "and a.idsupplier = '".$supplier."'";
		endif;
		
		$grid = new GridConnector($this->db->conn_id);
         $grid->render_sql("select id,idbarang,nmbarang,nmtipe,nmjenis,nmsatuan,if(sts_jual=1,'YA','TDK') as sts_jual,if(sts_konsinyasi=1,'YA','TDK') as sts_konsinyasi,nmmerk,nmkategori,nmwarna,keterangan,if(is_active=1,'YA','TDK') as is_active from v_master_barang a where a.idbarang is not null $qr","id","id,idbarang,nmbarang,nmtipe,nmjenis,nmsatuan,sts_jual,sts_konsinyasi,nmmerk,nmkategori,nmwarna,keterangan,is_active");
	}
	
	function loadDataSat($idbarang_induk="") {
		$img = '<img id="btnTglBerlaku_md41" src="../../assets/img/icon/tongsampah.png" border="0" style="cursor:pointer;" onclick="hapusSatuan_md3();" />';
		$grid = new GridConnector($this->db->conn_id);
        $grid->render_sql("select distinct idsatuan,konversi,harga_beli,'$img' as img from master_barang_detail where idbarang_induk = '".$idbarang_induk."' and konversi != '1'","idsatuan","idsatuan,konversi,harga_beli,img");	
	}
	
	function loadDataSize($idbarang_induk="") {
		$img = '<img id="btnTglBerlaku_md41" src="../../assets/img/icon/tongsampah.png" border="0" style="cursor:pointer;" onclick="hpsSatSize_md3();" />';
		$grid = new GridConnector($this->db->conn_id);
        $grid->render_sql("select id,idbarang_induk,idsize,idsatuan,barcode,idbarang,konversi,idgroup_barang,harga_beli,'$img' as img from master_barang_detail where idbarang_induk = '".$idbarang_induk."'","id","idbarang_induk,idsize,idsatuan,barcode,idbarang,konversi,idgroup_barang,harga_beli,img");	
	}
	
	function frm_input() {
		$this->load->view('master_barang/mbarang_input'); 
	}
	
	function frm_input_1() {
		$data['pajak'] = $this->m_company->pilihPajak('0');
		$this->load->view('master_barang/mbarang_input_1',$data); 
	}
	
	function frm_input_2() {
		$data['size'] = $this->db->query("select idsize,nmsize from ref_size_barang order by id asc");
		$data['satuan'] = $this->db->query("select idsatuan,nmsatuan from ref_satuan_barang order by id asc");
		$this->load->view('master_barang/mbarang_input_2',$data); 
	}
	
	function frm_input_3() {
		$this->load->view('master_barang/mbarang_input_3'); 
	}
	
	function frm_edit($id="") {
		$data['id'] = $id;
		$this->load->view('master_barang/mbarang_input',$data); 
	}
	
	function frm_edit_1($id="") {
		$r = $this->db->query("select idbarang,nmbarang,code_sms,stock_minimum,keterangan,idrak,is_active,idtipe_item,idjns_item,idkategori,idmerk,idwarna,idmata_uang,idsupplier,sts_jual,sts_konsinyasi,sts_serial,idpajak from master_barang where id = '".$id."'")->row();
		$data = array (
			'id' => $id,
			'idbarang' => $r->idbarang,
			'nmbarang' => $r->nmbarang,
			'code_sms' => $r->code_sms,
			'stock_minimum' => $r->stock_minimum,
			'keterangan' => $r->keterangan,
			'idrak' => $r->idrak,
			'is_active' => $r->is_active,
			'tipeItem' => $r->idtipe_item,
			'jnsItem' => $r->idjns_item,
			'katItem' => $r->idkategori,
			'merkItem' => $r->idmerk,
			'warnaItem' => $r->idwarna,
			'mataUang' => $r->idmata_uang,
			'supplier' => $r->idsupplier,
			'sts_jual' => $r->sts_jual,
			'sts_konsinyasi' => $r->sts_konsinyasi,
			'sts_serial' => $r->sts_serial,
			'pajak' => $this->m_company->pilihPajak($r->idpajak)
		);
		$this->load->view('master_barang/mbarang_input_1',$data); 
	}
	
	function frm_edit_2($id="") {
		$data['id'] = $id;
		$data['size'] = $this->db->query("select idsize,nmsize from ref_size_barang order by id asc");
		$data['satuan'] = $this->db->query("select idsatuan,nmsatuan from ref_satuan_barang order by id asc");
		$r = $this->db->query("select idsat_dasar,idbarang,hrg_beli from master_barang where id = '".$id."'")->row();
		if($r->idsat_dasar=="") {
			$data['satDasar'] = "null";
		} else {
			$data['satDasar'] = $r->idsat_dasar;
		}
		$data['hrgBeli'] = $r->hrg_beli;
		$n = 0;
		$q = $this->db->query("select distinct idsize from master_barang_detail where idbarang_induk = '".$r->idbarang."'");
		$arrUkuran[0] = "";
		foreach($q->result() as $rs) {
			$arrUkuran[$n] = $rs->idsize;
			$n++;
		}
		$data['arrUkuran'] = $arrUkuran;
		$data['idbarang'] = $r->idbarang;
		$this->load->view('master_barang/mbarang_input_2',$data); 
	}
	
	function frm_edit_3($id="") {
		$data['id'] = $id;
		$r = $this->db->query("select file_gambar from master_barang where id = '".$id."'")->row();
		$data['gambar'] = base_url()."index.php/master_barang/loadFoto/".$r->file_gambar;
		$data['nmfile'] = $r->file_gambar;
		$this->load->view('master_barang/mbarang_input_3',$data); 
	}
	
	function cbTipeItem() {
		$combo = new ComboConnector($this->db->conn_id); 
		$combo->render_sql("select idtipe,nmtipe from ref_tipe_barang","idtipe","nmtipe");
	}
	
	function cbJenis() {
		$combo = new ComboConnector($this->db->conn_id); 
		$combo->render_sql("select idjenis,nmjenis from ref_jenis_barang","idjenis","nmjenis");
	}
	
	function cbKategori() {
		$combo = new ComboConnector($this->db->conn_id); 
		$combo->render_sql("select idkategori,nmkategori from ref_kategori_barang","idkategori","nmkategori");
	}
	
	function cbMerk() {
		$combo = new ComboConnector($this->db->conn_id); 
		$combo->render_sql("select idmerk,nmmerk from ref_merk_barang","idmerk","nmmerk");
	}
	
	function cbWarna() {
		$combo = new ComboConnector($this->db->conn_id); 
		$combo->render_sql("select idwarna,nmwarna from ref_warna_barang","idwarna","nmwarna");
	}
	
	function cbMataUang() {
		$combo = new ComboConnector($this->db->conn_id); 
		$combo->render_sql("select idmata_uang,nmmata_uang from ref_mata_uang","idmata_uang","nmmata_uang");
	}
	
	function cbSupplier() {
		$combo = new ComboConnector($this->db->conn_id); 
		$combo->render_sql("select idrekan,nmrekan from master_rekan_bisnis where idtipe_rekan = '2'","idrekan","nmrekan");
	}
	
	function cbSatDasar() {
		$combo = new ComboConnector($this->db->conn_id); 
		$combo->render_sql("select idsatuan,nmsatuan from ref_satuan_barang","idsatuan","nmsatuan");
	}	
	
	function simpan() {
		
		// Cek Barcode
		$arrBarcode = preg_split("[~]",$this->input->post('code_barcode'));
		foreach($arrBarcode as $baris) {
			$sql = $this->db->query("select barcode from master_barang_detail where barcode = '".$baris."' and idbarang_induk != '".$this->input->post('txtKdItem')."'");
			if(count($sql->result()) != 0):
				echo "Barcode $baris Sudah Ada, Ganti Lebih Dahulu";
				return;
			endif;
		}
		
		$tglBuat = date("Y-m-d H:i:s");
		if($this->input->post('gambar') != "") {
			$tempGambar = explode(".",$this->input->post('gambar'));
			$fileName = $this->input->post('txtKdItem').".".$tempGambar[1];
		} else {
			$fileName = "";
		}
		$data = array (
			'idtipe_item' => $this->input->post('cbTI_md3')
		);
		$data = $this->msistem->arrayMerge($data,'idbarang',$this->input->post('txtKdItem'));
		$data = $this->msistem->arrayMerge($data,'nmbarang',strtoupper($this->input->post('txtNmItem')));
		$data = $this->msistem->arrayMerge($data,'idjns_item',$this->input->post('cbJns_md3'));
		$data = $this->msistem->arrayMerge($data,'idkategori',$this->input->post('cbKat_md3'));
		$data = $this->msistem->arrayMerge($data,'idmerk',$this->input->post('cbMerk_md3'));
		$data = $this->msistem->arrayMerge($data,'idwarna',$this->input->post('cbWarna_md3'));
		$data = $this->msistem->arrayMerge($data,'idmata_uang',$this->input->post('cbMU_md3'));
		$data = $this->msistem->arrayMerge($data,'code_sms',strtoupper($this->input->post('txtCodeSms')));
		$data = $this->msistem->arrayMerge($data,'idrak',strtoupper($this->input->post('txtRak')));
		$data = $this->msistem->arrayMerge($data,'stock_minimum',$this->input->post('txtStockMin'));
		$data = $this->msistem->arrayMerge($data,'idsupplier',$this->input->post('cbSupplier_md3'));
		$data = $this->msistem->arrayMerge($data,'keterangan',strtoupper($this->input->post('txtKet')));
		$data = $this->msistem->arrayMerge($data,'sts_jual',$this->input->post('rdStsJual'));
		$data = $this->msistem->arrayMerge($data,'sts_serial',$this->input->post('cbSerial'));
		$data = $this->msistem->arrayMerge($data,'sts_konsinyasi',$this->input->post('cbKonsinyasi'));
		$data = $this->msistem->arrayMerge($data,'idpajak',$this->input->post('slcPajak'));
		$data = $this->msistem->arrayMerge($data,'barcode_sama',$this->input->post('cbBarcode'));
		$data = $this->msistem->arrayMerge($data,'idsat_dasar',$this->input->post('cbSatDasar_md3'));
		$data = $this->msistem->arrayMerge($data,'hrg_beli',$this->input->post('txtHrg_beli'));
		$data = $this->msistem->arrayMerge($data,'created',$tglBuat);
		$data = $this->msistem->arrayMerge($data,'created_by',$this->session->userdata('sis_user'));
		$data = $this->msistem->arrayMerge($data,'is_active',$this->input->post('slcaktif'));

		if($this->input->post('gambar') != ""):
				$data = array_merge($data,array('file_gambar' => $fileName));
		endif;
		$this->db->trans_begin();
		if($this->input->post('id')=='') {
			$this->db->insert('master_barang', $data);
			$this->msistem->log_book('Input data baru id "'.$this->input->post('txtKdItem'),'MD3',$this->session->userdata('sis_user'));
			
			// input barang detail
			$item_detail = $this->input->post('item_detail');
			$table = 'master_barang_detail';
			$dataIns = array('idsize','idsatuan','barcode','idbarang','konversi','idgroup_barang','harga_beli');
			$fk = array('idbarang_induk' => $this->input->post('txtKdItem'));
			$this->msistem->insertDB($item_detail,$table,$dataIns,$fk);
		} else {
			$idbarang = $this->input->post('txtKdItem');
			// Hapus Gambar
			echo $this->input->post('hpsFoto');
			if($this->input->post('hpsFoto') != ""):
					$data = array_merge($data,array('file_gambar' => ''));
			endif;
			$this->db->update('master_barang',$data,array('id' => $this->input->post('id')));
			$this->msistem->log_book('Update data id "'.$idbarang,'MD3',$this->session->userdata('sis_user'));
			// update barang detail
			
			$item_detail = $this->input->post('item_detail');
			$fk = array('idbarang_induk' => $this->input->post('txtKdItem'));
			$dataIns = array('idsize','idsatuan','barcode','idbarang','konversi','idgroup_barang','harga_beli');
			
			$arrBaris = preg_split("[~]",$item_detail);
			foreach($arrBaris as $baris) {
				$i = 0;
				$arrData = preg_split("[`]",$baris);
				foreach($dataIns as $cols) {
					$rec[$cols] = $arrData[$i];
					$i++;
				}
				$rec = array_merge($rec,$fk);
				$idbarang = $arrData[3];
				$sql = $this->db->query("select idbarang from master_barang_detail where idbarang = '".$idbarang."'");
				if(count($sql->result())==0) {
					$this->db->insert('master_barang_detail',$rec);
				} else {
					$this->db->update('master_barang_detail',$rec,array('idbarang' => $idbarang));
				}
			}
			
			// hapus
			if($this->input->post('idHapus') != "") {
				$arrIdHps = preg_split('[,]',$this->input->post('idHapus'));
				foreach($arrIdHps as $baris) {
					if($baris != ""):
						$this->db->delete("master_barang_detail",array('idbarang' => $baris));
					endif;		
				}
			}			
		}
		
		// simpan gambar
		if($this->input->post('gambar') != ""):
			copy("gambar/tmp/".$this->input->post('gambar'),"gambar/".$fileName);
			unlink("gambar/tmp/".$this->input->post('gambar'));
		endif;
		
		if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
			echo "0";
        } else {
            $this->db->trans_commit();
			// Hapus Gambar
			if($this->input->post('hpsFoto') != ""):
					unlink("gambar/".$this->input->post('hpsFoto'));
			endif;
            echo "1";
        }
	}
	
	function loadFoto($gambar="") {
		if($gambar != ""):
			echo '<img src="../../../gambar/'.$gambar.'" width="280" height="130" />';
		endif;
	}
	
	function uploadFoto() {
		$allowedExts = array("gif", "jpeg", "jpg", "png");
		$temp = explode(".", $_FILES["gambar"]["name"]);
		$extension = end($temp);
		if ((($_FILES["gambar"]["type"] == "image/gif") || ($_FILES["gambar"]["type"] == "image/jpeg") || ($_FILES["gambar"]["type"] == "image/jpg") || ($_FILES["gambar"]["type"] == "image/pjpeg") || ($_FILES["gambar"]["type"] == "image/x-png") || ($_FILES["gambar"]["type"] == "image/png")) && ($_FILES["gambar"]["size"] < 1000000) && in_array($extension, $allowedExts))
  		{
  				if ($_FILES["gambar"]["error"] > 0)
				{
					echo "Return Code: " . $_FILES["gambar"]["error"] . "<br>";
				}
			  else
    			{
					if (file_exists("gambar/tmp/" . $_FILES["gambar"]["name"]))
					{
					  echo $_FILES["gambar"]["name"] . " already exists. ";
					}
					else
					{
					  move_uploaded_file($_FILES["gambar"]["tmp_name"],"gambar/tmp/" . $_FILES["gambar"]["name"]);
					  echo '<img src="../../gambar/tmp/'.$_FILES["gambar"]["name"].'" width="280" height="130" />';
					  //echo '<script language="javascript">window.parent.setNamaGambar("COBA");</javascript>';
					}
					
   				 }
  		} else {
  			echo "Invalid file";
  		}
	}
	
	function hapusFoto() {
		if($this->input->post('gambar') != "") {
			unlink("gambar/tmp/".$this->input->post('gambar'));
		} else {
			//txtKdItem
		}
		echo "";
	}
	
	function hapus() {
		$idrec = $this->input->post('idrec');
		$idbarang = $this->input->post('idbarang');
		$this->db->trans_begin();
		// log delete
		$r = $this->db->query("select idbarang from master_barang where id = '".$idrec."'")->row();
		$idbarang = $r->idbarang;
		$this->msistem->log_delete("master_barang","where idbarang = '$idbarang'");
		// Hapus
		$this->db->delete("master_barang",array('id' => $idrec));
		//$this->db->delete("master_barang_detail",array('idbarang_induk' => $idbarang));
		$this->msistem->log_book('Delete data id "'.$idrec,'md3',$this->session->userdata('sis_user'));
		if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
			echo "0";
        } else {
            $this->db->trans_commit();
			echo "1";
        }
	}
	
	// load barang untuk harga jual
	function loadDataBarang_md41($idgroup_barang="") {
		$grid = new GridConnector($this->db->conn_id);
        $grid->render_sql("select id,idgroup_barang,nmbarang,idsatuan from v_master_barang_detail where is_active = '1' and sts_jual = '1' and idgroup_barang like '%".$idgroup_barang."%' group by idgroup_barang","id","idgroup_barang,nmbarang,idsatuan");
	}
	
	// cari barang untuk harga jual
	function cariDataBarang_md41($nmbarang="") {
		$grid = new GridConnector($this->db->conn_id);
        $grid->render_sql("select id,idgroup_barang,concat(nmbarang, ' ',nmwarna) as nmbarang,idsatuan from v_master_barang_detail where is_active = '1' and sts_jual = '1' and nmbarang like '%".$nmbarang."%' group by idgroup_barang","id","idgroup_barang,nmbarang,idsatuan");
	}
	
	// load barang untuk job order
	function loadDataBarang_pr1($idgroup_barang="") {
		$grid = new GridConnector($this->db->conn_id);
        $grid->render_sql("select a.id,a.idgroup_barang,a.nmbarang,b.nmjenis from v_master_barang_detail a inner join ref_jenis_barang b on a.idjns_item = b.idjenis where a.is_active = '1' and a.sts_jual = '1' and a.idgroup_barang like '%".$idgroup_barang."%' group by a.idgroup_barang","id","idgroup_barang,nmbarang,nmjenis");
	}
	
	// cari barang untuk job order
	function cariDataBarang_pr1($nmbarang="") {
		$grid = new GridConnector($this->db->conn_id);
        $grid->render_sql("select a.id,a.idgroup_barang,a.nmbarang,b.nmjenis from v_master_barang_detail a left join ref_jenis_barang b on a.idjns_item = b.idjenis where a.is_active = '1' and a.sts_jual = '1' and a.nmbarang like '%".$nmbarang."%' group by a.idgroup_barang","id","idgroup_barang,nmbarang,nmjenis");
	}
	
	function loadDataBarang($outlet_id="",$idbarang="") {
		$grid = new GridConnector($this->db->conn_id);
        $grid->render_sql("select a.id,a.idbarang,a.nmbarang,a.nmwarna,a.nmsize,a.nmsatuan,'0' as jml,b.harga,disc_1,disc_2,disc_3,disc_4,'0' as total,harga_beli,nmtipe,nmjenis,nmkategori,a.barcode from v_master_barang_detail a INNER JOIN v_harga_barang b on a.idgroup_barang = b.idbarang and b.outlet_id = '".$outlet_id."' and tgl_berlaku <= now() where a.is_active = '1' and a.idbarang like '%".$idbarang."%'","idbarang","idbarang,nmbarang,nmwarna,nmsize,nmsatuan,jml,harga,disc_1,disc_2,disc_3,disc_4,total,harga_beli,nmtipe,nmjenis,nmkategori,barcode");
	}
	
	function cariDataBahan_pr1($nmbarang="") {
		$grid = new GridConnector($this->db->conn_id);
        $grid->render_sql("select a.id,a.idgroup_barang,a.nmbarang,b.nmjenis from v_master_barang_detail a left join ref_jenis_barang b on a.idjns_item = b.idjenis where a.is_active = '1' and a.sts_jual != '1' and a.nmbarang like '%".$nmbarang."%' group by a.idgroup_barang","id","idgroup_barang,nmbarang,nmjenis");
	}
	
	/* function loadDataBarang($outlet_id="",$idbarang="") {
		$grid = new GridConnector($this->db->conn_id);
        $grid->render_sql("select a.id,a.idbarang,a.nmbarang,a.nmwarna,a.nmsize,a.nmsatuan,'0' as jml,b.harga,disc_1,disc_2,disc_3,disc_4,'0' as total,harga_beli,nmtipe,nmjenis,nmkategori,a.barcode from v_master_barang_detail a LEFT JOIN v_harga_barang b on a.idgroup_barang = b.idbarang and b.outlet_id = '".$outlet_id."' and tgl_berlaku <= now() where a.is_active = '1' and a.idbarang like '%".$idbarang."%'","idbarang","idbarang,nmbarang,nmwarna,nmsize,nmsatuan,jml,harga,disc_1,disc_2,disc_3,disc_4,total,harga_beli,nmtipe,nmjenis,nmkategori,barcode");
	} */
	
	function cariBarang() {
		$idbarang = $this->input->post('idbarang');
		$outlet_id = $this->input->post('outlet_id');
		$sql = $this->db->query("select a.id,a.idbarang,a.nmbarang,a.nmwarna,a.nmsize,a.nmsatuan,'0' as jml,b.harga,disc_1,disc_2,disc_3,disc_4,'0' as total,harga_beli,nmtipe,nmjenis,nmkategori,a.barcode from v_master_barang_detail a INNER JOIN v_harga_barang b on a.idgroup_barang = b.idbarang and b.outlet_id = '".$outlet_id."' and tgl_berlaku <= now() where a.idbarang = '".$idbarang."'");
		if(count($sql->result())==0) {
			echo "0";
		} else {
			$r = $sql->row();
			echo $r->nmbarang.'|'.$r->nmwarna.'|'.$r->nmsize.'|'.$r->nmsatuan.'|'.$r->jml.'|'.$r->harga.'|'.$r->disc_1.'|'.$r->disc_2.'|'.$r->disc_3.'|'.$r->disc_4.'|'.$r->total.'|'.$r->harga_beli.'|'.$r->barcode;
		}
	}
	
	function muatUlang($outlet_id="",$nmbarang="",$kditem="",$konsinyasi="",$tipe="",$jns="",$kat="",$merk="",$warna="",$supplier="") {
		$qr = "";
		if($nmbarang != '0'):
			$qr .= "and nmbarang like '%".$nmbarang."%'";
		endif;
		if($konsinyasi != '0'):
			$qr .= "and sts_konsinyasi = '1'";
		endif;
		if($kditem != '0'):
			$qr .= "and a.idbarang like '%".$kditem."%'";
		endif;
		if($tipe != 'null'):
			$qr .= "and idtipe_item = '".$tipe."'";
		endif;
		if($jns != 'null'):
			$qr .= "and idjns_item = '".$jns."'";
		endif;
		if($kat != 'null'):
			$qr .= "and idkategori = '".$kat."'";
		endif;
		if($merk != 'null'):
			$qr .= "and idmerk = '".$merk."'";
		endif;
		if($warna != 'null'):
			$qr .= "and idwarna = '".$warna."'";
		endif;
		if($supplier != 'null'):
			$qr .= "and idsupplier = '".$supplier."'";
		endif;
		
		$grid = new GridConnector($this->db->conn_id);
        $grid->render_sql("select a.id,a.idbarang,a.nmbarang,a.nmwarna,a.nmsize,a.nmsatuan,'0' as jml,b.harga,disc_1,disc_2,disc_3,disc_4,'0' as total,harga_beli,nmtipe,nmjenis,nmkategori,a.barcode from v_master_barang_detail a LEFT JOIN v_harga_barang b on a.idgroup_barang = b.idbarang and b.outlet_id = '".$outlet_id."' and tgl_berlaku <= now() where a.is_active = '1' $qr","idbarang","idbarang,nmbarang,nmwarna,nmsize,nmsatuan,jml,harga,disc_1,disc_2,disc_3,disc_4,total,harga_beli,nmtipe,nmjenis,nmkategori,barcode");
	}
	
	function scanBarcode() {
		$barcode = $this->input->post('barcode');
		$outlet_id = $this->input->post('outlet_id');
		$sql = $this->db->query("select a.id,a.idbarang,a.nmbarang,a.nmwarna,a.nmsize,a.nmsatuan,b.harga,a.harga_beli from v_master_barang_detail a INNER JOIN v_harga_barang b on a.idgroup_barang = b.idbarang and b.outlet_id = '".$outlet_id."' and tgl_berlaku <= now() where barcode = '".$barcode."'");
		if(count($sql->result())==0) {
			echo "0";
		} else {
			$r = $sql->row();
			echo $r->idbarang.'|'.$r->nmbarang.'|'.$r->nmwarna.'|'.$r->nmsize.'|'.$r->nmsatuan.'|'.$r->harga.'|'.$r->harga_beli;
		}
	}
	
	function scanBarcodeJual() {
		$barcode = $this->input->post('barcode');
		$outlet_id = $this->input->post('outlet_id');
		$sql = $this->db->query("select a.id,a.idbarang,a.nmbarang,a.nmwarna,a.nmsize,a.nmsatuan,b.harga,b.disc_1,b.disc_2,b.disc_3,b.disc_4,a.harga_beli from v_master_barang_detail a INNER JOIN v_harga_barang b on a.idgroup_barang = b.idbarang and b.outlet_id = '".$outlet_id."' and tgl_berlaku <= now() where barcode = '".$barcode."'");
		if(count($sql->result())==0) {
			echo "0";
		} else {
			$r = $sql->row();
			echo $r->idbarang.'|'.$r->nmbarang.'|'.$r->nmwarna.'|'.$r->nmsize.'|'.$r->nmsatuan.'|'.$r->harga.'|'.$r->disc_1.'|'.$r->disc_2.'|'.$r->disc_3.'|'.$r->disc_4.'|'.$r->harga_beli;
		}
	}
	
	function sizeRun() {
		$sizeRun = $this->input->post('sizeRun');
		$outlet_id = $this->input->post('outlet_id');
		
		$separator = ".";
		$arr = explode($separator,$sizeRun);
		$jmlArray = count($arr);
		$sizeRun = $arr[$jmlArray - 1];
		$txt = "";
		for($i=0;$i<$jmlArray -1;$i++) {
			if($i != $jmlArray - 2) {
				$spt = ".";
			} else {
				$spt = "";
			}
			$txt .= $arr[$i].$spt;
		}
		$sql = $this->db->query("select idsize,qty from ref_sizerun_child where kode_sizerun = '".$sizeRun."'");
		$jmlRec = count($sql->result());
		$i = 1;
		$baris = "";
		foreach($sql->result() as $rs) {
			$kdbarang = $txt.$separator.$rs->idsize;
			$qty = $rs->qty;
			$sql = $this->db->query("select a.id,a.idbarang,a.nmbarang,a.nmwarna,a.nmsize,a.nmsatuan,b.harga,a.harga_beli from v_master_barang_detail a INNER JOIN v_harga_barang b on a.idgroup_barang = b.idbarang and b.outlet_id = '".$outlet_id."' and tgl_berlaku <= now() where a.idbarang = '".$kdbarang."'");
			if(count($sql->result())==0) {
				$baris = "";
			} else {
				$r = $sql->row();
				$baris .= $r->idbarang.'|'.$r->nmbarang.'|'.$r->nmwarna.'|'.$r->nmsize.'|'.$r->nmsatuan.'|'.$qty.'|'.$r->harga.'|'.$r->harga_beli;
				if($i != $jmlRec): $baris = $baris.'~'; endif;
			}
			$i++;
		}
		echo $baris;
	}
	
	function sizeRunJual() {
		$sizeRun = $this->input->post('sizeRun');
		$outlet_id = $this->input->post('outlet_id');
		
		$separator = ".";
		$arr = explode($separator,$sizeRun);
		$jmlArray = count($arr);
		$sizeRun = $arr[$jmlArray - 1];
		$txt = "";
		for($i=0;$i<$jmlArray -1;$i++) {
			if($i != $jmlArray - 2) {
				$spt = ".";
			} else {
				$spt = "";
			}
			$txt .= $arr[$i].$spt;
		}
		$sql = $this->db->query("select idsize,qty from ref_sizerun_child where kode_sizerun = '".$sizeRun."'");
		$jmlRec = count($sql->result());
		$i = 1;
		$baris = "";
		foreach($sql->result() as $rs) {
			$kdbarang = $txt.$separator.$rs->idsize;
			$qty = $rs->qty;
			$sql = $this->db->query("select a.id,a.idbarang,a.nmbarang,a.nmwarna,a.nmsize,a.nmsatuan,b.harga,b.disc_1,b.disc_2,b.disc_3,b.disc_4,a.harga_beli from v_master_barang_detail a INNER JOIN v_harga_barang b on a.idgroup_barang = b.idbarang and b.outlet_id = '".$outlet_id."' and tgl_berlaku <= now() where a.idbarang = '".$kdbarang."'");
			if(count($sql->result())==0) {
				$baris = "0";
			} else {
				$r = $sql->row();
				$baris .= $r->idbarang.'|'.$r->nmbarang.'|'.$r->nmwarna.'|'.$r->nmsize.'|'.$r->nmsatuan.'|'.$qty.'|'.$r->harga.'|'.$r->disc_1.'|'.$r->disc_2.'|'.$r->disc_3.'|'.$r->disc_4.'|'.$r->harga_beli;
				if($i != $jmlRec): $baris = $baris.'~'; endif;
			}
			$i++;
		}
		echo $baris;
	}
	
	function generateBrg() {
		$sql = $this->db->query("select idbarang,size from _dms_barang where idbarang != 'AA1001-551' group by idbarang");
		foreach($sql->result() as $rs) {
			$arr = explode(",",$rs->size);
			foreach ($arr as $value) {
				$idbarang = $rs->idbarang.".".$value;
				$idsize = $value;
				$konversi = "1";
				$idinduk_brg = $rs->idbarang;
				$barcode = $idbarang;
				$idgroup_barang = $idinduk_brg;
				echo $idbarang."<br />";
				$this->db->query("insert into master_barang_detail (idbarang,idsize,konversi,idbarang_induk,barcode,idgroup_barang) values ('$idbarang','$idsize','$konversi','$idinduk_brg','$barcode','$idgroup_barang')");
			}
		}
	}
	
	function barcode($size="",$text="") {
	
			//$text = (isset($_GET["text"])?$_GET["text"]:"0");
			//$size = (isset($_GET["size"])?$_GET["size"]:"20");
			$orientation = "horizontal"; //(isset($_GET["orientation"])?$_GET["orientation"]:"horizontal");
			$code_type = "code25"; // (isset($_GET["codetype"])?$_GET["codetype"]:"code128");
			$code_string = "";
			
			// Translate the $text into barcode the correct $code_type
			if ( strtolower($code_type) == "code128" ) {
			$chksum = 104;
			// Must not change order of array elements as the checksum depends on the array's key to validate final code
			$code_array = array(" "=>"212222","!"=>"222122","\""=>"222221","#"=>"121223","$"=>"121322","%"=>"131222","&"=>"122213","'"=>"122312","("=>"132212",")"=>"221213","*"=>"221312","+"=>"231212",","=>"112232","-"=>"122132","."=>"122231","/"=>"113222","0"=>"123122","1"=>"123221","2"=>"223211","3"=>"221132","4"=>"221231","5"=>"213212","6"=>"223112","7"=>"312131","8"=>"311222","9"=>"321122",":"=>"321221",";"=>"312212","<"=>"322112","="=>"322211",">"=>"212123","?"=>"212321","@"=>"232121","A"=>"111323","B"=>"131123","C"=>"131321","D"=>"112313","E"=>"132113","F"=>"132311","G"=>"211313","H"=>"231113","I"=>"231311","J"=>"112133","K"=>"112331","L"=>"132131","M"=>"113123","N"=>"113321","O"=>"133121","P"=>"313121","Q"=>"211331","R"=>"231131","S"=>"213113","T"=>"213311","U"=>"213131","V"=>"311123","W"=>"311321","X"=>"331121","Y"=>"312113","Z"=>"312311","["=>"332111","\\"=>"314111","]"=>"221411","^"=>"431111","_"=>"111224","\`"=>"111422","a"=>"121124","b"=>"121421","c"=>"141122","d"=>"141221","e"=>"112214","f"=>"112412","g"=>"122114","h"=>"122411","i"=>"142112","j"=>"142211","k"=>"241211","l"=>"221114","m"=>"413111","n"=>"241112","o"=>"134111","p"=>"111242","q"=>"121142","r"=>"121241","s"=>"114212","t"=>"124112","u"=>"124211","v"=>"411212","w"=>"421112","x"=>"421211","y"=>"212141","z"=>"214121","{"=>"412121","|"=>"111143","}"=>"111341","~"=>"131141","DEL"=>"114113","FNC 3"=>"114311","FNC 2"=>"411113","SHIFT"=>"411311","CODE C"=>"113141","FNC 4"=>"114131","CODE A"=>"311141","FNC 1"=>"411131","Start A"=>"211412","Start B"=>"211214","Start C"=>"211232","Stop"=>"2331112");
			$code_keys = array_keys($code_array);
			$code_values = array_flip($code_keys);
			for ( $X = 1; $X <= strlen($text); $X++ ) {
			$activeKey = substr( $text, ($X-1), 1);
			$code_string .= $code_array[$activeKey];
			$chksum=($chksum + ($code_values[$activeKey] * $X));
			}
			$code_string .= $code_array[$code_keys[($chksum - (intval($chksum / 103) * 103))]];
			
			$code_string = "211214" . $code_string . "2331112";
			} elseif ( strtolower($code_type) == "code39" ) {
			$code_array = array("0"=>"111221211","1"=>"211211112","2"=>"112211112","3"=>"212211111","4"=>"111221112","5"=>"211221111","6"=>"112221111","7"=>"111211212","8"=>"211211211","9"=>"112211211","A"=>"211112112","B"=>"112112112","C"=>"212112111","D"=>"111122112","E"=>"211122111","F"=>"112122111","G"=>"111112212","H"=>"211112211","I"=>"112112211","J"=>"111122211","K"=>"211111122","L"=>"112111122","M"=>"212111121","N"=>"111121122","O"=>"211121121","P"=>"112121121","Q"=>"111111222","R"=>"211111221","S"=>"112111221","T"=>"111121221","U"=>"221111112","V"=>"122111112","W"=>"222111111","X"=>"121121112","Y"=>"221121111","Z"=>"122121111","-"=>"121111212","."=>"221111211"," "=>"122111211","$"=>"121212111","/"=>"121211121","+"=>"121112121","%"=>"111212121","*"=>"121121211");
			
			// Convert to uppercase
			$upper_text = strtoupper($text);
			
			for ( $X = 1; $X<=strlen($upper_text); $X++ ) {
			$code_string .= $code_array[substr( $upper_text, ($X-1), 1)] . "1";
			}
			
			$code_string = "1211212111" . $code_string . "121121211";
			} elseif ( strtolower($code_type) == "code25" ) {
			$code_array1 = array("1","2","3","4","5","6","7","8","9","0");
			$code_array2 = array("3-1-1-1-3","1-3-1-1-3","3-3-1-1-1","1-1-3-1-3","3-1-3-1-1","1-3-3-1-1","1-1-1-3-3","3-1-1-3-1","1-3-1-3-1","1-1-3-3-1");
			
			for ( $X = 1; $X <= strlen($text); $X++ ) {
			for ( $Y = 0; $Y < count($code_array1); $Y++ ) {
			if ( substr($text, ($X-1), 1) == $code_array1[$Y] )
			$temp[$X] = $code_array2[$Y];
			}
			}
			
			for ( $X=1; $X<=strlen($text); $X+=2 ) {
			if ( isset($temp[$X]) && isset($temp[($X + 1)]) ) {
			$temp1 = explode( "-", $temp[$X] );
			$temp2 = explode( "-", $temp[($X + 1)] );
			for ( $Y = 0; $Y < count($temp1); $Y++ )
			$code_string .= $temp1[$Y] . $temp2[$Y];
			}
			}
			
			$code_string = "1111" . $code_string . "311";
			} elseif ( strtolower($code_type) == "codabar" ) {
			$code_array1 = array("1","2","3","4","5","6","7","8","9","0","-","$",":","/",".","+","A","B","C","D");
			$code_array2 = array("1111221","1112112","2211111","1121121","2111121","1211112","1211211","1221111","2112111","1111122","1112211","1122111","2111212","2121112","2121211","1121212","1122121","1212112","1112122","1112221");
			
			// Convert to uppercase
			$upper_text = strtoupper($text);
			
			for ( $X = 1; $X<=strlen($upper_text); $X++ ) {
			for ( $Y = 0; $Y<count($code_array1); $Y++ ) {
			if ( substr($upper_text, ($X-1), 1) == $code_array1[$Y] )
			$code_string .= $code_array2[$Y] . "1";
			}
			}
			$code_string = "11221211" . $code_string . "1122121";
			}
			
			// Pad the edges of the barcode
			$code_length = 20;
			for ( $i=1; $i <= strlen($code_string); $i++ )
			$code_length = $code_length + (integer)(substr($code_string,($i-1),1));
			
			if ( strtolower($orientation) == "horizontal" ) {
			$img_width = $code_length;
			$img_height = $size;
			} else {
			$img_width = $size;
			$img_height = $code_length;
			}
			
			$image = imagecreate($img_width, $img_height);
			$black = imagecolorallocate ($image, 0, 0, 0);
			$white = imagecolorallocate ($image, 255, 255, 255);
			
			imagefill( $image, 0, 0, $white );
			
			$location = 10;
			for ( $position = 1 ; $position <= strlen($code_string); $position++ ) {
			$cur_size = $location + ( substr($code_string, ($position-1), 1) );
			if ( strtolower($orientation) == "horizontal" )
			imagefilledrectangle( $image, $location, 0, $cur_size, $img_height, ($position % 2 == 0 ? $white : $black) );
			else
			imagefilledrectangle( $image, 0, $location, $img_width, $cur_size, ($position % 2 == 0 ? $white : $black) );
			$location = $cur_size;
			}
			// Draw barcode to the screen
			header ('Content-type: image/png');
			imagepng($image);
			imagedestroy($image);
	}
	
	function importData() {
		error_reporting(0);
		$this->load->library('Spreadsheet_Excel_Reader');
		$file =  $_FILES['userfile']['tmp_name'];
		
		$dataExcel = new Spreadsheet_Excel_Reader($file);
		$baris = $dataExcel->rowcount($sheet_index=0);
		
		$jmlInput = 0;
		$jmlUpdate = 0;
		$jmlError = 0;
		$jmlData = $baris -1;
		for ($i=2; $i<=$baris; $i++)
		{
			$idbarang = trim($dataExcel->val($i,1));
			$nmbarang = trim($dataExcel->val($i,2));
			$idtipe_item = trim($dataExcel->val($i,3));
			$idjns_item = trim($dataExcel->val($i,4));
			$idkategori = trim($dataExcel->val($i,5));
			$idmerk = trim($dataExcel->val($i,6));
			$idwarna = trim($dataExcel->val($i,7));
			$idmata_uang = trim($dataExcel->val($i,8));
			$code_sms = trim($dataExcel->val($i,9));
			$idrak = trim($dataExcel->val($i,10));
			$stock_minimum = trim($dataExcel->val($i,11));
			$idsupplier = trim($dataExcel->val($i,12));
			$keterangan = trim($dataExcel->val($i,13));
			$sts_jual = trim($dataExcel->val($i,14));
			$sts_serial = trim($dataExcel->val($i,15));
			$sts_konsinyasi = trim($dataExcel->val($i,16));
			$idpajak = trim($dataExcel->val($i,17));
			$barcode_sama = trim($dataExcel->val($i,18));
			$idsat_dasar = trim($dataExcel->val($i,19));
			$hrg_beli = trim($dataExcel->val($i,20));
			$ukuran = trim($dataExcel->val($i,21));
			$setBarcode = trim($dataExcel->val($i,22));
			
			$error = 0;
			$msg = "";
			// Cek Tipe Item
			if($idtipe_item != ""):
				$q = $this->db->query("select idtipe from ref_tipe_barang where idtipe = '".$idtipe_item."'");
				if(count($q->result())==0):
					$error = 1;
					$msg .= "*Kode Tipe Item [C] Tidak Terdaftar<br />";
				endif;
			endif;
			// Cek Jenis Item
			if($idjns_item != ""):
				$q = $this->db->query("select idjenis from ref_jenis_barang where idjenis = '".$idjns_item."'");
				if(count($q->result())==0):
					$error = 1;
					$msg .= "*Kode Jenis Item [D] Tidak Terdaftar<br />";
				endif;
			endif;
			// Cek Mata Uang
			if($idmata_uang != ""):
				$q = $this->db->query("select idmata_uang from ref_mata_uang where idmata_uang = '".$idmata_uang."'");
				if(count($q->result())==0):
					$error = 1;
					$msg .= "*Kode Mata Uang [H] Tidak Terdaftar<br />";
				endif;
			endif;
			// Cek Satuan Dasar
			if($idsat_dasar != ""):
				$q = $this->db->query("select idsatuan from ref_satuan_barang where idsatuan = '".$idsat_dasar."'");
				if(count($q->result())==0):
					$error = 1;
					$msg .= "*Kode Satuan [S] Tidak Terdaftar<br />";
				endif;
			endif;
			// Cek Merk Barang
			if($idmerk != ""):
				$q = $this->db->query("select idmerk from ref_merk_barang where idmerk = '".$idmerk."'");
				if(count($q->result())==0):
					$error = 1;
					$msg .= "*Kode Merk [F] Tidak Terdaftar<br />";
				endif;
			endif;
			// Cek Kategori Barang
			if($idkategori != ""):
				$q = $this->db->query("select idkategori from ref_kategori_barang where idkategori = '".$idkategori."'");
				if(count($q->result())==0):
					$error = 1;
					$msg .= "*Kode Kategori [E] Tidak Terdaftar<br />";
				endif;
			endif;
			// Cek Warna Barang
			if($idwarna != ""):
				$q = $this->db->query("select idwarna from ref_warna_barang where idwarna = '".$idwarna."'");
				if(count($q->result())==0):
					$error = 1;
					$msg .= "*Kode Warna [G] Tidak Terdaftar<br />";
				endif;
			endif;
			// Cek Supplier
			if($idsupplier != ""):
				$q = $this->db->query("select idrekan from master_rekan_bisnis where idrekan = '".$idsupplier."' and idtipe_rekan = '2'");
				if(count($q->result())==0):
					$error = 1;
					$msg .= "*Kode Supplier [L] Tidak Terdaftar<br />";
				endif;
			endif;
			// Cek Pajak
			if($idpajak != ""):
				$q = $this->db->query("select kode_pajak from master_pajak where kode_pajak = '".$idpajak."'");
				if(count($q->result())==0):
					$error = 1;
					$msg .= "*Kode Pajak [Q] Tidak Terdaftar<br />";
				endif;
			endif;
			
			if($error==1):
				echo "<span style=color:#FFFFFF>- Item : ".$idbarang." Tidak Dapat Diproses, Dikarenakan</span><br />";
				echo "<span style=color:#FFFFFF>".$msg."</span>";
				$jmlError++;
			endif;
			
			// imput data
			$data = array (
				'idtipe_item' => $idtipe_item
			);
			$tglBuat = date("Y-m-d H:i:s");
			$data = $this->msistem->arrayMerge($data,'idbarang',$idbarang);
			$data = $this->msistem->arrayMerge($data,'nmbarang',strtoupper($nmbarang));
			$data = $this->msistem->arrayMerge($data,'idjns_item',$idjns_item);
			$data = $this->msistem->arrayMerge($data,'idkategori',$idkategori);
			$data = $this->msistem->arrayMerge($data,'idmerk',$idmerk);
			$data = $this->msistem->arrayMerge($data,'idwarna',$idwarna);
			$data = $this->msistem->arrayMerge($data,'idmata_uang',$idmata_uang);
			$data = $this->msistem->arrayMerge($data,'code_sms',strtoupper($code_sms));
			$data = $this->msistem->arrayMerge($data,'idrak',strtoupper($idrak));
			$data = $this->msistem->arrayMerge($data,'stock_minimum',$stock_minimum);
			$data = $this->msistem->arrayMerge($data,'idsupplier',$idsupplier);
			$data = $this->msistem->arrayMerge($data,'keterangan',$keterangan);
			$data = $this->msistem->arrayMerge($data,'sts_jual',$sts_jual);
			$data = $this->msistem->arrayMerge($data,'sts_serial',$sts_serial);
			$data = $this->msistem->arrayMerge($data,'sts_konsinyasi',$sts_konsinyasi);
			$data = $this->msistem->arrayMerge($data,'idpajak',$idpajak);
			$data = $this->msistem->arrayMerge($data,'barcode_sama',$barcode_sama);
			$data = $this->msistem->arrayMerge($data,'idsat_dasar',$idsat_dasar);
			$data = $this->msistem->arrayMerge($data,'hrg_beli',$hrg_beli);
			$data = $this->msistem->arrayMerge($data,'created',$tglBuat);
			$data = $this->msistem->arrayMerge($data,'created_by',$this->session->userdata('sis_user'));
			$data = $this->msistem->arrayMerge($data,'is_active','1');
			
			$q = $this->db->query("select idbarang from master_barang where idbarang = '".$idbarang."'");
			if(count($q->result())==0) {
				$this->db->insert('master_barang', $data);
				$this->msistem->log_book('Import data baru id "'.$this->input->post('txtKdItem'),'MD3',$this->session->userdata('sis_user'));
			
				// input barang detail
				if($ukuran != "") {
					// Multi Size Start
					$arrUkuran = explode(",",$ukuran);
					foreach($arrUkuran as $size) {
						$idbarangDetail = $idbarang.".".$size;
						$idsize = $size;
						$idsatuan = $idsat_dasar;
						$konversi = 1;
						$idbarang_induk = $idbarang;
						if($barcode_sama=='1') {
							$barcode = $idbarangDetail;
						} else {
							$barcode = $setBarcode.".".$size;
						}
						$idgroup_barang = $idbarang;
						$harga_beli = $hrg_beli;
						
						$dataDetail = array (
							'idbarang' => $idbarangDetail,
							'idsize' => $idsize,
							'idsatuan' => $idsatuan,
							'konversi' => $konversi,
							'idbarang_induk' => $idbarang_induk,
							'barcode' => $barcode,
							'idgroup_barang' => $idgroup_barang,
							'harga_beli' => $harga_beli
						);
						$this->db->insert('master_barang_detail', $dataDetail);
					}
					// Multi Size End
				} else {
					if($barcode_sama=='1') {
						$barcode = $idbarang;
					} else {
						$barcode = $setBarcode;
					}
					$dataDetail = array (
							'idbarang' => $idbarang,
							'idsatuan' => $idsatuan,
							'konversi' => '1',
							'idbarang_induk' => $idbarang,
							'barcode' => $barcode,
							'idgroup_barang' => $idbarang,
							'harga_beli' => $harga_beli
					);
						$this->db->insert('master_barang_detail', $dataDetail);
				}
				$jmlInput++;
			} else {
			
				// update start
				if(isset($_POST['cekupdate'])):
					$data = array('idbarang' => $idbarang);
					if(isset($_POST['idtipe_item'])): $data = $this->msistem->arrayMerge($data,'idtipe_item',$idtipe_item); endif;
					if(isset($_POST['nmbarang'])): $data = $this->msistem->arrayMerge($data,'nmbarang',strtoupper($nmbarang)); endif;
					if(isset($_POST['idjns_item'])): $data = $this->msistem->arrayMerge($data,'idjns_item',$idjns_item); endif;
					if(isset($_POST['idkategori'])): $data = $this->msistem->arrayMerge($data,'idkategori',$idkategori); endif;
					if(isset($_POST['idmerk'])): $data = $this->msistem->arrayMerge($data,'idmerk',$idmerk); endif;
					if(isset($_POST['idwarna'])): $data = $this->msistem->arrayMerge($data,'idwarna',$idwarna); endif;
					if(isset($_POST['idmata_uang'])): $data = $this->msistem->arrayMerge($data,'idmata_uang',$idmata_uang); endif;
					if(isset($_POST['code_sms'])): $data = $this->msistem->arrayMerge($data,'code_sms',strtoupper($code_sms)); endif;
					if(isset($_POST['idrak'])): $data = $this->msistem->arrayMerge($data,'idrak',strtoupper($idrak)); endif;
					if(isset($_POST['stock_minimum'])): $data = $this->msistem->arrayMerge($data,'stock_minimum',$stock_minimum); endif;
					if(isset($_POST['idsupplier'])): $data = $this->msistem->arrayMerge($data,'idsupplier',$idsupplier); endif;
					if(isset($_POST['keterangan'])): $data = $this->msistem->arrayMerge($data,'keterangan',$keterangan); endif;
					if(isset($_POST['sts_jual'])): $data = $this->msistem->arrayMerge($data,'sts_jual',$sts_jual); endif;
					if(isset($_POST['sts_serial'])): $data = $this->msistem->arrayMerge($data,'sts_serial',$sts_serial); endif;
					if(isset($_POST['sts_konsinyasi'])): $data = $this->msistem->arrayMerge($data,'sts_konsinyasi',$sts_konsinyasi); endif;
					if(isset($_POST['idpajak'])): $data = $this->msistem->arrayMerge($data,'idpajak',$idpajak); endif;
					if(isset($_POST['idsat_dasar'])): $data = $this->msistem->arrayMerge($data,'idsat_dasar',$idsat_dasar); endif;
					if(isset($_POST['hrg_beli'])): $data = $this->msistem->arrayMerge($data,'hrg_beli',$hrg_beli); endif;
					
					$this->db->update('master_barang', $data,array('idbarang' => $idbarang));
					$this->msistem->log_book('Import Update data baru id "'.$this->input->post('txtKdItem'),'MD3',$this->session->userdata('sis_user'));
				endif;
				
				// input barang detail
				if($ukuran != "") {
					// Multi Size Start
					$arrUkuran = explode(",",$ukuran);
					foreach($arrUkuran as $size) {
						$idbarangDetail = $idbarang.".".$size;
						$idsize = $size;
						$idsatuan = $idsat_dasar;
						$konversi = 1;
						$idbarang_induk = $idbarang;
						if($barcode_sama=='1') {
							$barcode = $idbarangDetail;
						} else {
							$barcode = $setBarcode.".".$size;
						}
						$idgroup_barang = $idbarang;
						$harga_beli = $hrg_beli;
						
						$dataDetail = array (
							'idsize' => $idsize,
							'konversi' => $konversi,
							'idbarang_induk' => $idbarang_induk,
							'idgroup_barang' => $idgroup_barang,
						);
						if(isset($_POST['idsat_dasar'])): $dataDetail = $this->msistem->arrayMerge($dataDetail,'idsatuan',$idsatuan); endif;
						if(isset($_POST['barcode'])): $dataDetail = $this->msistem->arrayMerge($dataDetail,'barcode',$barcode); endif;
						if(isset($_POST['hrg_beli'])): $dataDetail = $this->msistem->arrayMerge($dataDetail,'harga_beli',$harga_beli); endif;
						
						$this->db->update('master_barang_detail', $dataDetail,array('idbarang' => $idbarangDetail));
					}
					// Multi Size End
				} else {
					if($barcode_sama=='1') {
						$barcode = $idbarang;
					} else {
						$barcode = $setBarcode;
					}
					$dataDetail = array (
						'konversi' => '1',
						'idbarang_induk' => $idbarang,
						'idgroup_barang' => $idbarang,
					);
					if(isset($_POST['idsat_dasar'])): $dataDetail = $this->msistem->arrayMerge($dataDetail,'idsatuan',$idsat_dasar); endif;
					if(isset($_POST['barcode'])): $dataDetail = $this->msistem->arrayMerge($dataDetail,'barcode',$barcode); endif;
					if(isset($_POST['hrg_beli'])): $dataDetail = $this->msistem->arrayMerge($dataDetail,'harga_beli',$hrg_beli); endif;
						
					$this->db->update('master_barang_detail', $dataDetail,array('idbarang' => $idbarang));
				}
				// End Update
				$jmlUpdate++;
			} // Insert or Update
		} // Looping
		echo "<br /><span style=color:#FFFFFF>Jumlah Data Diproses : ".$jmlData."</span><br />";
		echo "<span style=color:#FFFFFF>Jumlah Terinput : ".$jmlInput."</span><br />";
		echo "<span style=color:#FFFFFF>Jumlah Terupdate : ".$jmlUpdate."</span><br />";
		echo "<span style=color:#FFFFFF>Jumlah Error : ".$jmlError."</span><br />";
	}
	
	function exportExcel() {
		$data['query'] = $this->db->query("select id,idbarang,nmbarang,nmtipe,nmjenis,nmsatuan,if(sts_jual=1,'YA','TDK') as sts_jual,if(sts_konsinyasi=1,'YA','TDK') as sts_konsinyasi,nmmerk,nmkategori,nmwarna,keterangan,if(is_active=1,'YA','TDK') as is_active from v_master_barang a");	
		$this->load->view('master_barang/mbarang_export',$data); 
	}
	
}
?>