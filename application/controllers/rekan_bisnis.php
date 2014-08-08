<?php
class rekan_bisnis extends SIS_Controller { 
	
	public function __construct() {
        parent::__construct();   
        $this->load->model('msistem');
		$this->load->model('m_rekan_bisnis');
		$this->load->model('m_company');
    }
	
	public function index() {
		$data['hak_toolbar'] = $this->msistem->hak_toolbar('md1');
		$data['typeRekan'] = $this->m_rekan_bisnis->pilihTypeRekan('0');
		$data['pelanggan'] = $this->m_rekan_bisnis->pilihGrupPelanggan('0');
		$this->load->view('rekan_bisnis/rb_index',$data);
	}
	
	function frm_input() {
		$data['pilihTypeRekan'] = $this->m_rekan_bisnis->pilihTypeRekan('0');
		$data['pilihMewakili'] = $this->m_rekan_bisnis->pilihMewakili('0');
		$data['pilihPanggilan'] = $this->m_rekan_bisnis->pilihPanggilan('0');
		$data['pilihPramuniaga'] = $this->m_rekan_bisnis->pilihPramuniaga('0');
		$data['pilihTerminPembayaran'] = $this->m_rekan_bisnis->pilihTerminPembayaran('0');
		$data['pilihGrupPelanggan'] = $this->m_rekan_bisnis->pilihGrupPelanggan('0');
		$data['pilihTipePotongan'] = $this->m_rekan_bisnis->pilihTipePotongan('0');
		$data['pilihMtdPembayaran'] = $this->m_rekan_bisnis->pilihMtdPembayaran('0');
		$data['pilihKaryawan'] = $this->m_rekan_bisnis->pilihKaryawan('0');
		$data['cabang'] = $this->m_company->pilihLokasiAll('0');
		$this->load->view('rekan_bisnis/rb_input',$data);
	}
	
	function frm_edit($idrec="") {
		
		$rs = $this->db->query("select a.*,DATE_FORMAT(a.tgl_kadaluarsa,'%d/%m/%Y') as tglExpired,b.nmperkiraan,DATE_FORMAT(a.tgl_masuk,'%d/%m/%Y') as tglMasuk from master_rekan_bisnis a left join ak_master_perkiraan b on a.idperkiraan = b.idperkiraan where a.id = '".$idrec."'")->row();
		
		$nmpramuniaga = "";
		if($rs->idpramuniaga != ""):
			$q = $this->db->query("select nmrekan as nmpramuniaga from master_rekan_bisnis where idrekan = '".$rs->idpramuniaga."'");
			if(count($q->result()) != 0):
				$r = $q->row();
				$nmpramuniaga = $r->nmpramuniaga;
			endif;
		endif;
		
		$dataDb = array (
			'idrec' => $idrec,
			'idrekan' => $rs->idrekan,
			'nmrekan' => $rs->nmrekan,
			'telp_1' => $rs->telp_1,
			'telp_2' => $rs->telp_2,
			'telp_3' => $rs->telp_3,
			'fax' => $rs->fax,
			'email' => $rs->email,
			'website' => $rs->website,
			'kotak_orang' => $rs->kotak_orang,
			'idperkiraan' => $rs->idperkiraan,
			'nmperkiraan' => $rs->nmperkiraan,
			'cat_transaksi' => $rs->cat_transaksi,
			'limit_hutang_piutang' => $rs->limit_hutang_piutang,
			'idpramuniaga' => $rs->idpramuniaga,
			'nmpramuniaga' => $nmpramuniaga,
			'siup' => $rs->siup,
			'npwp' => $rs->npwp,
			'diskon_hari' => $rs->diskon_hari,
			'jth_tempo_hari' => $rs->jth_tempo_hari,
			'diskon_pemb_lbh_awal' => $rs->diskon_pemb_lbh_awal,
			'denda_terlambat_byr' => $rs->denda_terlambat_byr,
			'disc_volume' => $rs->disc_volume,
			'volume_beli' => $rs->volume_beli,
			'no_kartu' => $rs->no_kartu,
			'tgl_kadaluarsa' => $rs->tglExpired,
			'nama_pdkartu' => $rs->nama_pdkartu,
			'cat_pembayaran' => $rs->cat_pembayaran,
			'gaji_rate' => $rs->gaji_rate,
			'gaji_jam' => $rs->gaji_jam,
			'tglMasuk' => $rs->tglMasuk
		);
		$data['pilihTypeRekan'] = $this->m_rekan_bisnis->pilihTypeRekan($rs->idtipe_rekan);
		$data['pilihMewakili'] = $this->m_rekan_bisnis->pilihMewakili($rs->idmewakili);
		$data['pilihPanggilan'] = $this->m_rekan_bisnis->pilihPanggilan($rs->idpanggilan);
		$data['pilihPramuniaga'] = $this->m_rekan_bisnis->pilihPramuniaga($rs->idpramuniaga);
		$data['pilihTerminPembayaran'] = $this->m_rekan_bisnis->pilihTerminPembayaran($rs->idtermin);
		$data['pilihGrupPelanggan'] = $this->m_rekan_bisnis->pilihGrupPelanggan($rs->idgrup);
		$data['pilihTipePotongan'] = $this->m_rekan_bisnis->pilihTipePotongan($rs->idtipepot);
		$data['pilihMtdPembayaran'] = $this->m_rekan_bisnis->pilihMtdPembayaran($rs->idmp);
		$data['pilihKaryawan'] = $this->m_rekan_bisnis->pilihKaryawan($rs->upline);
		$data['cabang'] = $this->m_company->pilihLokasiAll($rs->outlet_id);
		$data = array_merge($data,$dataDb);
		$this->load->view('rekan_bisnis/rb_input',$data);
	}
	
	function loadMainData($idRekan="",$nmRekan="",$typeRekan="",$golPelanggan="") {
		$qr = "";
		if($idRekan != '0'):
			$qr .= "and a.idrekan like '%".$idRekan."%'";
		endif;
		if($nmRekan != '0'):
			$qr .= "and a.nmrekan like '%".$nmRekan."%'";
		endif;
		if($typeRekan != '0'):
			$qr .= "and a.idtipe_rekan = '".$typeRekan."'";
		endif;
		if($golPelanggan != '0'):
			$qr .= "and a.idgrup = '".$golPelanggan."'";
		endif;
		
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select a.id,a.idrekan,a.nmrekan,a.telp_1,a.telp_2,a.telp_3,a.fax,a.email,a.website,b.nmtipe_rekan,c.nm_outlet as nm_outlet from master_rekan_bisnis a inner join sys_tipe_rekan b on a.idtipe_rekan = b.idtipe_rekan left join master_company c on a.outlet_id = c.outlet_id where a.nmrekan is not null $qr order by a.nmrekan asc","id","id,idrekan,nmrekan,telp_1,telp_2,telp_3,fax,email,website,nmtipe_rekan,nm_outlet");
	}
	
	function frm_search_akun() {
		$this->load->view('rekan_bisnis/rb_search_akun');
	}
	
	function frm_search_sales() {
		$this->load->view('rekan_bisnis/rb_search_sales');
	}
	
	function loadDataPerkiraan() {
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select a.idperkiraan,a.nmperkiraan,b.nmkelompok from ak_master_perkiraan a inner join ak_master_kelompok_perkiraan b on a.idkelompok_perkiraan = b.idkelompok_perkiraan where tipe_perkiraan = 'D' and kas_bank = '0' order by idperkiraan asc","idperkiraan","idperkiraan,nmperkiraan,nmkelompok");
	}
	
	function loadDataPerkiraanKas() {
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select a.idperkiraan,a.nmperkiraan,b.nmkelompok from ak_master_perkiraan a inner join ak_master_kelompok_perkiraan b on a.idkelompok_perkiraan = b.idkelompok_perkiraan where tipe_perkiraan = 'D' and kas_bank = '1' order by idperkiraan asc","idperkiraan","idperkiraan,nmperkiraan,nmkelompok");
	}
	
	function loadDataSales() {
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select id,idrekan,nmrekan from master_rekan_bisnis where idtipe_rekan = '3'","id","idrekan,nmrekan");
	}
	
	function frm_input_alamat() {
		$data['pilihJnsAlamat'] = $this->m_rekan_bisnis->pilihJnsAlamat(0);
		$this->load->view('rekan_bisnis/rb_input_alamat',$data);
	}
	
	function loadDataAlamat($idrekan="") {
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select a.alamat,a.kode_pos,a.idjnsalamat,a.city_code,b.nmjnsalamat,c.city_name from master_alamat_rekan a left join sys_jenis_alamat b on a.idjnsalamat = b.idjnsalamat left join master_city c on a.city_code = c.city_code where idrekan = '".$idrekan."'","idjnsalamat","nmjnsalamat,alamat,city_name,kode_pos,idjnsalamat,city_code");
	}
	
	function cbKota() {
		$combo = new ComboConnector($this->db->conn_id); 
		$combo->render_sql("select city_code,city_name from master_city order by city_name asc","city_code","city_name");
	}
	
	function simpan() {
		if($this->input->post('txtKadaluarsa') != "") {
			$tgl_kadaluarsa = $this->msistem->conversiTgl($this->input->post('txtKadaluarsa'));
		} else {
			$tgl_kadaluarsa = "";
		}
		
		if($this->input->post('tglMasuk') != "") {
			$tglMasuk = $this->msistem->conversiTgl($this->input->post('tglMasuk'));
		} else {
			$tglMasuk = "";
		}
		$this->db->trans_begin();
		
		$data = array (
			'idtipe_rekan' => $this->input->post('txtTypeRekan'),
			'nmrekan' => strtoupper($this->input->post('txtNmRekan'))
		);
		$data = $this->msistem->arrayMerge($data,'idmewakili',$this->input->post('slcMewakili'));
		$data = $this->msistem->arrayMerge($data,'telp_1',$this->input->post('txtTlp_1'));
		$data = $this->msistem->arrayMerge($data,'telp_2',$this->input->post('txtTlp_2'));
		$data = $this->msistem->arrayMerge($data,'telp_3',$this->input->post('txtTlp_3'));
		$data = $this->msistem->arrayMerge($data,'fax',$this->input->post('txtFax'));
		$data = $this->msistem->arrayMerge($data,'email',$this->input->post('txtEmail'));
		$data = $this->msistem->arrayMerge($data,'website',$this->input->post('txtWebsite'));
		$data = $this->msistem->arrayMerge($data,'idpanggilan',$this->input->post('slcPanggilan'));
		$data = $this->msistem->arrayMerge($data,'kotak_orang',strtoupper($this->input->post('txtNamaKontak')));
		$data = $this->msistem->arrayMerge($data,'idperkiraan',$this->input->post('txtidperkiraan'));
		$data = $this->msistem->arrayMerge($data,'cat_transaksi',$this->input->post('txtCatatan'));
		$data = $this->msistem->arrayMerge($data,'limit_hutang_piutang',$this->input->post('txtBatasPiutang'));
		$data = $this->msistem->arrayMerge($data,'idpramuniaga',$this->input->post('txtidPramuniaga'));
		$data = $this->msistem->arrayMerge($data,'siup',$this->input->post('txtSiup'));
		$data = $this->msistem->arrayMerge($data,'npwp',$this->input->post('txtNpwp'));
		$data = $this->msistem->arrayMerge($data,'idtermin',$this->input->post('slcTermin'));
		$data = $this->msistem->arrayMerge($data,'diskon_hari',$this->input->post('txtDiscSampai'));
		$data = $this->msistem->arrayMerge($data,'jth_tempo_hari',$this->input->post('txtJatuhTempo'));
		$data = $this->msistem->arrayMerge($data,'diskon_pemb_lbh_awal',$this->input->post('txtDiscByrLbhAwal'));
		$data = $this->msistem->arrayMerge($data,'denda_terlambat_byr',$this->input->post('txtDendaKeterlambatan'));
		$data = $this->msistem->arrayMerge($data,'idgrup',$this->input->post('slcGrupPelanggan'));
		$data = $this->msistem->arrayMerge($data,'idtipepot',$this->input->post('slcTipePotongan'));
		$data = $this->msistem->arrayMerge($data,'disc_volume',$this->input->post('txtDiscVol'));
		$data = $this->msistem->arrayMerge($data,'volume_beli',$this->input->post('txtVol'));
		$data = $this->msistem->arrayMerge($data,'idmp',$this->input->post('slcMetodePembayaran'));
		$data = $this->msistem->arrayMerge($data,'no_kartu',$this->input->post('txtNoKartu'));
		$data = $this->msistem->arrayMerge($data,'tgl_kadaluarsa',$tgl_kadaluarsa);
		$data = $this->msistem->arrayMerge($data,'nama_pdkartu',strtoupper($this->input->post('txtNmKartu')));
		$data = $this->msistem->arrayMerge($data,'cat_pembayaran',strtoupper($this->input->post('txtCatPembayaran')));
		// update by ari karniawan 22/4/2014
		$data = $this->msistem->arrayMerge($data,'gaji_rate',$this->input->post('txtGajiKry'));
		$data = $this->msistem->arrayMerge($data,'gaji_jam',$this->input->post('txtOngkosJam'));
		$data = $this->msistem->arrayMerge($data,'upline',$this->input->post('slcUpline'));
		$data = $this->msistem->arrayMerge($data,'tgl_masuk',$tglMasuk);
		$data = $this->msistem->arrayMerge($data,'outlet_id',$this->input->post('cabang'));
		
		if($this->input->post('idrec')=="") {
			$idrekan = $this->generateCode($this->input->post('txtTypeRekan'));
			$data = array_merge($data,array(
				'idRekan' => $idrekan,
				'created' => date("Y-m-d H:i:s"),
				'created_by' => $this->session->userdata('sis_user')
			));
			$this->db->insert('master_rekan_bisnis', $data);
			$this->msistem->log_book('Input data baru id "'.$idrekan,'MD1',$this->session->userdata('sis_user'));
		} else {
			$idrekan = $this->input->post('txtIdRekan');
			$data = array_merge($data,array(
				'modified_by' => $this->session->userdata('sis_user')
			));
			$this->db->update('master_rekan_bisnis',$data,array('id' => $this->input->post('idrec')));
			$this->msistem->log_book('Update data baru id "'.$idrekan,'MD1',$this->session->userdata('sis_user'));
		}
		
		// input alamat
		if($this->input->post('dataAlamat') != ""):
			$dataAlamat = $this->input->post('dataAlamat');
			$table = 'master_alamat_rekan';
			$dataIns = array('alamat','kode_pos','idjnsalamat','city_code');
			$fk = array('idrekan' => $idrekan);
			$this->msistem->insertDB($dataAlamat,$table,$dataIns,$fk);
		endif;
		
		// Commit
		if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
			echo "0|[AUTO]";
        } else {
            $this->db->trans_commit();
            echo "1|".$idrekan;
        }
	}
	
	function generateCode($type) {
		$r = $this->db->query("select idmax from tmp_idrekan_bisnis where idtipe_rekan = '".$type."'")->row();
		$no = $r->idmax + 1;
		$this->db->query("update tmp_idrekan_bisnis set idmax = '$no' where idtipe_rekan = '".$type."'");
		return $no;
	}
	
	function hapus() {
		$idrec = $this->input->post('idrec');
		$idrekan = $this->input->post('idrekan');
		$this->db->trans_begin();
		$this->msistem->log_delete("master_alamat_rekan","where idrekan = '$idrekan'");
		$this->db->delete("master_alamat_rekan",array('idrekan' => $idrekan));
		$this->db->delete("master_rekan_bisnis",array('id' => $idrec));
		$this->msistem->log_book('Delete data id "'.$idrec,'MD1',$this->session->userdata('sis_user'));
		if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
			echo "Hapus Data Gagal";
        } else {
            $this->db->trans_commit();
			echo "1";
        }
	}
	
	function reloadDataKry() {
		echo $this->m_rekan_bisnis->pilihKaryawan('0');
	}
}
?>