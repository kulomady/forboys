<?php 
class kirim_data extends SIS_Controller {

	public function __construct() {
        parent::__construct();  
		 $this->load->model('msistem');
		$this->load->library("Nusoap_lib"); 
    }
	
	public function index() {
		$r = $this->db->query("select terakhir from sys_terakhir_kirim")->row();
		$data['tglKirim'] = $r->terakhir;
		$this->load->view('kirim_data/kntr_pusat',$data);
	}
	
	
	
	function hapusData() {
		// Test Koneksi
		//$this->msistem->ulrSoap()
		$ping = $this->msistem->ping();
		if($ping==0):
			echo $ping;
			return;
		endif;
		
		
		$tgl_1 = $this->input->post('tgl_1');
		$baris = $this->input->post('baris');
		$jml = $this->input->post('jml');	
		
		$kondisi = "where created >= '".$tgl_1."' and status = '0'";
		
		if($baris == 0):
			$sql = $this->db->query("select id from log_delete_data $kondisi");
			$jml = count($sql->result());
			if($jml==0):
				echo "0|0";
				return;
			endif;
		endif;
		
		$r = $this->db->query("select * from log_delete_data $kondisi limit $baris,1")->row();
		$tabel = $r->tabel;
		$dimana = $r->kondisi;
		$query = "delete from $tabel $dimana";
		
		$client = new nusoap_client($this->msistem->ulrSoap());
 			
		$array = array('query' => $query);
		$ins  = $client->call('hapusData',$array);
		if($ins) {
			
			$baris = $baris + 1;
			if($baris==$jml):
				$this->db->query("update log_delete_data set status = '1' $kondisi");
			endif;
			echo $baris."|".$jml;	
		}
	}
	
	function size_barang() {
		
		$ping = $this->msistem->ping();
		if($ping==0):
			echo $ping;
			return;
		endif;
		
		$tgl_1 = $this->input->post('tgl_1');
		$baris = $this->input->post('baris');
		$jml = $this->input->post('jml');
		
		$kondisi = "where created >= '".$tgl_1."' or modified >= '".$tgl_1."'";
		
		if($baris == 0):
			$sql = $this->db->query("select id from ref_size_barang $kondisi");
			$jml = count($sql->result());
			if($jml==0):
				echo "0|0";
				return;
			endif;
		endif;
		
		$r = $this->db->query("select * from ref_size_barang $kondisi limit $baris,1")->row();
		
		$client = new nusoap_client($this->msistem->ulrSoap());
 			
		$array = array(
			'idsize' => $r->idsize,
			'nmsize' => $r->nmsize,
			'active' => $r->active,
			'created' => $r->created,
			'modified' => $r->modified,
			'created_by' => $r->created_by,
			'modified_by' => $r->modified_by,
		);
		$ins  = $client->call('size_barang',$array);
		if($ins) {
			$baris = $baris + 1;
			echo $baris."|".$jml;	
		}
	}
	
	function tipe_barang() {
		
		$ping = $this->msistem->ping();
		if($ping==0):
			echo $ping;
			return;
		endif;
		
		$tgl_1 = $this->input->post('tgl_1');
		$baris = $this->input->post('baris');
		$jml = $this->input->post('jml');
		
		$kondisi = "where created >= '".$tgl_1."' or modified >= '".$tgl_1."'";
		
		if($baris == 0):
			$sql = $this->db->query("select id from ref_tipe_barang $kondisi");
			$jml = count($sql->result());
			if($jml==0):
				echo "0|0";
				return;
			endif;
		endif;
		
		$r = $this->db->query("select * from ref_tipe_barang $kondisi limit $baris,1")->row();
		
		$client = new nusoap_client($this->msistem->ulrSoap());
 			
		$array = array(
			'idtipe' => $r->idtipe,
			'nmtipe' => $r->nmtipe,
			'active' => $r->active,
			'created' => $r->created,
			'modified' => $r->modified,
			'created_by' => $r->created_by,
			'modified_by' => $r->modified_by,
		);
		$ins  = $client->call('tipe_barang',$array);
		if($ins) {
			$baris = $baris + 1;
			echo $baris."|".$jml;	
		}	
	}
	
	function kat_barang() {
		
		$ping = $this->msistem->ping();
		if($ping==0):
			echo $ping;
			return;
		endif;
		
		$tgl_1 = $this->input->post('tgl_1');
		$baris = $this->input->post('baris');
		$jml = $this->input->post('jml');
		
		$kondisi = "where created >= '".$tgl_1."' or modified >= '".$tgl_1."'";
		
		if($baris == 0):
			$sql = $this->db->query("select id from ref_kategori_barang $kondisi");
			$jml = count($sql->result());
			if($jml==0):
				echo "0|0";
				return;
			endif;
		endif;
		
		$r = $this->db->query("select * from ref_kategori_barang $kondisi limit $baris,1")->row();
		
		$client = new nusoap_client($this->msistem->ulrSoap());
 			
		$array = array(
			'idkategori' => $r->idkategori,
			'nmkategori' => $r->nmkategori,
			'active' => $r->active,
			'created' => $r->created,
			'modified' => $r->modified,
			'created_by' => $r->created_by,
			'modified_by' => $r->modified_by,
		);
		$ins  = $client->call('kat_barang',$array);
		if($ins) {
			$baris = $baris + 1;
			echo $baris."|".$jml;	
		}	
	}
	
	function jns_barang() {
		
		$ping = $this->msistem->ping();
		if($ping==0):
			echo $ping;
			return;
		endif;
		
		$tgl_1 = $this->input->post('tgl_1');
		$baris = $this->input->post('baris');
		$jml = $this->input->post('jml');
		
		$kondisi = "where created >= '".$tgl_1."' or modified >= '".$tgl_1."'";
		
		if($baris == 0):
			$sql = $this->db->query("select id from ref_jenis_barang $kondisi");
			$jml = count($sql->result());
			if($jml==0):
				echo "0|0";
				return;
			endif;
		endif;
		
		$r = $this->db->query("select * from ref_jenis_barang $kondisi limit $baris,1")->row();
		
		$client = new nusoap_client($this->msistem->ulrSoap());
 			
		$array = array(
			'idjenis' => $r->idjenis,
			'nmjenis' => $r->nmjenis,
			'active' => $r->active,
			'created' => $r->created,
			'modified' => $r->modified,
			'created_by' => $r->created_by,
			'modified_by' => $r->modified_by,
		);
		$ins  = $client->call('jns_barang',$array);
		if($ins) {
			$baris = $baris + 1;
			echo $baris."|".$jml;	
		}	
	}
	
	function merk_barang() {
		
		$ping = $this->msistem->ping();
		if($ping==0):
			echo $ping;
			return;
		endif;
		
		$tgl_1 = $this->input->post('tgl_1');
		$baris = $this->input->post('baris');
		$jml = $this->input->post('jml');
		
		$kondisi = "where created >= '".$tgl_1."' or modified >= '".$tgl_1."'";
		
		if($baris == 0):
			$sql = $this->db->query("select id from ref_merk_barang $kondisi");
			$jml = count($sql->result());
			if($jml==0):
				echo "0|0";
				return;
			endif;
		endif;
		
		$r = $this->db->query("select * from ref_merk_barang $kondisi limit $baris,1")->row();
		
		$client = new nusoap_client($this->msistem->ulrSoap());
 			
		$array = array(
			'idmerk' => $r->idmerk,
			'nmmerk' => $r->nmmerk,
			'active' => $r->active,
			'created' => $r->created,
			'modified' => $r->modified,
			'created_by' => $r->created_by,
			'modified_by' => $r->modified_by,
		);
		$ins  = $client->call('merk_barang',$array);
		if($ins) {
			$baris = $baris + 1;
			echo $baris."|".$jml;	
		}	
	}
	
	function warna_barang() {
		
		$ping = $this->msistem->ping();
		if($ping==0):
			echo $ping;
			return;
		endif;

		$tgl_1 = $this->input->post('tgl_1');
		$baris = $this->input->post('baris');
		$jml = $this->input->post('jml');
		
		$kondisi = "where created >= '".$tgl_1."' or modified >= '".$tgl_1."'";
		
		if($baris == 0):
			$sql = $this->db->query("select id from ref_warna_barang $kondisi");
			$jml = count($sql->result());
			if($jml==0):
				echo "0|0";
				return;
			endif;
		endif;
		
		$r = $this->db->query("select * from ref_warna_barang $kondisi limit $baris,1")->row();
		
		$client = new nusoap_client($this->msistem->ulrSoap());
 			
		$array = array(
			'idwarna' => $r->idwarna,
			'nmwarna' => $r->nmwarna,
			'active' => $r->active,
			'created' => $r->created,
			'modified' => $r->modified,
			'created_by' => $r->created_by,
			'modified_by' => $r->modified_by,
		);
		$ins  = $client->call('warna_barang',$array);
		if($ins) {
			$baris = $baris + 1;
			echo $baris."|".$jml;	
		}		
	}
	
	function sat_barang() {
		
		$ping = $this->msistem->ping();
		if($ping==0):
			echo $ping;
			return;
		endif;

		$tgl_1 = $this->input->post('tgl_1');
		$baris = $this->input->post('baris');
		$jml = $this->input->post('jml');
		
		$kondisi = "where created >= '".$tgl_1."' or modified >= '".$tgl_1."'";
		
		if($baris == 0):
			$sql = $this->db->query("select id from ref_satuan_barang $kondisi");
			$jml = count($sql->result());
			if($jml==0):
				echo "0|0";
				return;
			endif;
		endif;
		
		$r = $this->db->query("select * from ref_satuan_barang $kondisi limit $baris,1")->row();
		
		$client = new nusoap_client($this->msistem->ulrSoap());
 			
		$array = array(
			'idsatuan' => $r->idsatuan,
			'nmsatuan' => $r->nmsatuan,
			'active' => $r->active,
			'created' => $r->created,
			'modified' => $r->modified,
			'created_by' => $r->created_by,
			'modified_by' => $r->modified_by,
		);
		$ins  = $client->call('satuan_barang',$array);
		if($ins) {
			$baris = $baris + 1;
			echo $baris."|".$jml;	
		}		
	}
	
	function mata_uang() {
		
		$ping = $this->msistem->ping();
		if($ping==0):
			echo $ping;
			return;
		endif;

		$tgl_1 = $this->input->post('tgl_1');
		$baris = $this->input->post('baris');
		$jml = $this->input->post('jml');
		
		$kondisi = "where created >= '".$tgl_1."' or modified >= '".$tgl_1."'";
		
		if($baris == 0):
			$sql = $this->db->query("select id from ref_mata_uang $kondisi");
			$jml = count($sql->result());
			if($jml==0):
				echo "0|0";
				return;
			endif;
		endif;
		
		$r = $this->db->query("select * from ref_mata_uang $kondisi limit $baris,1")->row();
		
		$client = new nusoap_client($this->msistem->ulrSoap());
 			
		$array = array(
			'idmata_uang' => $r->idmata_uang,
			'nmmata_uang' => $r->nmmata_uang,
			'active' => $r->active,
			'created' => $r->created,
			'modified' => $r->modified,
			'created_by' => $r->created_by,
			'modified_by' => $r->modified_by,
		);
		$ins  = $client->call('mata_uang',$array);
		if($ins) {
			$baris = $baris + 1;
			echo $baris."|".$jml;	
		}		
	}
	
	function jabatan() {
		
		$ping = $this->msistem->ping();
		if($ping==0):
			echo $ping;
			return;
		endif;

		$tgl_1 = $this->input->post('tgl_1');
		$baris = $this->input->post('baris');
		$jml = $this->input->post('jml');
		
		$kondisi = "where created >= '".$tgl_1."' or modified >= '".$tgl_1."'";
		
		if($baris == 0):
			$sql = $this->db->query("select id from ref_jabatan_karyawan $kondisi");
			$jml = count($sql->result());
			if($jml==0):
				echo "0|0";
				return;
			endif;
		endif;
		
		$r = $this->db->query("select * from ref_jabatan_karyawan $kondisi limit $baris,1")->row();
		
		$client = new nusoap_client($this->msistem->ulrSoap());
 			
		$array = array(
			'idjbt' => $r->idjbt,
			'nmjbt' => $r->nmjbt,
			'active' => $r->active,
			'created' => $r->created,
			'modified' => $r->modified,
			'created_by' => $r->created_by,
			'modified_by' => $r->modified_by,
		);
		$ins  = $client->call('jabatan',$array);
		if($ins) {
			$baris = $baris + 1;
			echo $baris."|".$jml;	
		}		
	}
	
	function pajak() {
		
		$ping = $this->msistem->ping();
		if($ping==0):
			echo $ping;
			return;
		endif;

		$tgl_1 = $this->input->post('tgl_1');
		$baris = $this->input->post('baris');
		$jml = $this->input->post('jml');
		
		$kondisi = "where created >= '".$tgl_1."' or modified >= '".$tgl_1."'";
		
		if($baris == 0):
			$sql = $this->db->query("select idpajak from master_pajak $kondisi");
			$jml = count($sql->result());
			if($jml==0):
				echo "0|0";
				return;
			endif;
		endif;
		
		$r = $this->db->query("select * from master_pajak $kondisi limit $baris,1")->row();
		
		$client = new nusoap_client($this->msistem->ulrSoap());
 			
		$array = array(
			'kode_pajak' => $r->kode_pajak,
			'nama_pajak' => $r->nama_pajak,
			'nilai' => $r->nilai,
			'active' => $r->is_active,
			'created' => $r->created,
			'modified' => $r->modified,
			'created_by' => $r->created_by,
			'modified_by' => $r->modified_by,
		);
		$ins  = $client->call('pajak',$array);
		if($ins) {
			$baris = $baris + 1;
			echo $baris."|".$jml;	
		}		
	}
	
	function bank() {
		
		$ping = $this->msistem->ping();
		if($ping==0):
			echo $ping;
			return;
		endif;

		$tgl_1 = $this->input->post('tgl_1');
		$baris = $this->input->post('baris');
		$jml = $this->input->post('jml');
		
		$kondisi = "where created >= '".$tgl_1."' or modified >= '".$tgl_1."'";
		
		if($baris == 0):
			$sql = $this->db->query("select id from ref_bank $kondisi");
			$jml = count($sql->result());
			if($jml==0):
				echo "0|0";
				return;
			endif;
		endif;
		
		$r = $this->db->query("select * from ref_bank $kondisi limit $baris,1")->row();
		
		$client = new nusoap_client($this->msistem->ulrSoap());
 			
		$array = array(
			'idbank' => $r->idbank,
			'nmbank' => $r->nmbank,
			'norek' => $r->norek,
			'atas_nama' => $r->atas_nama,
			'cabang' => $r->cabang,
			'active' => $r->active,
			'created' => $r->created,
			'modified' => $r->modified,
			'created_by' => $r->created_by,
			'modified_by' => $r->modified_by,
		);
		$ins  = $client->call('bank',$array);
		if($ins) {
			$baris = $baris + 1;
			echo $baris."|".$jml;	
		}		
	}
	
	function user() {
		
		$ping = $this->msistem->ping();
		if($ping==0):
			echo $ping;
			return;
		endif;
		
		$tgl_1 = $this->input->post('tgl_1');
		$baris = $this->input->post('baris');
		$jml = $this->input->post('jml');
		
		$kondisi = "where created_on >= '".$tgl_1."' or modified_on >= '".$tgl_1."'";
		
		if($baris == 0):
			$sql = $this->db->query("select id from tb_users $kondisi");
			$jml = count($sql->result());
			if($jml==0):
				echo "0|0";
				return;
			endif;
		endif;
		
		$r = $this->db->query("select * from tb_users $kondisi limit $baris,1")->row();
		
		$client = new nusoap_client($this->msistem->ulrSoap());
 			
		$array = array(
			'username' => $r->username,
			'password' => $r->password,
			'email' => $r->email,
			'created_on' => $r->created_on,
			'last_login' => $r->last_login,
			'first_name' => $r->first_name,
			'last_name' => $r->last_name,
			'outlet_id' => $r->outlet_id,
			'phone' => $r->phone,
			'group_id' => $r->group_id,
			'active' => $r->active,
			'created_by' => $r->created_by,
			'modified_by' => $r->modified_by,
			'modified_on' => $r->modified_on,
		);
		$ins  = $client->call('user',$array);
		if($ins) {
			$baris = $baris + 1;
			echo $baris."|".$jml;	
		}	
		
	}
	
	function company() {
		
		$ping = $this->msistem->ping();
		if($ping==0):
			echo $ping;
			return;
		endif;
		
		$tgl_1 = $this->input->post('tgl_1');
		$baris = $this->input->post('baris');
		$jml = $this->input->post('jml');
		
		$kondisi = "where created >= '".$tgl_1."' or modified >= '".$tgl_1."'";
		
		if($baris == 0):
			$sql = $this->db->query("select id from master_company $kondisi");
			$jml = count($sql->result());
			if($jml==0):
				echo "0|0";
				return;
			endif;
		endif;
		
		$r = $this->db->query("select * from master_company $kondisi limit $baris,1")->row();
		
		$client = new nusoap_client($this->msistem->ulrSoap());
 			
		$array = array(
			'outlet_id' => $r->outlet_id,
			'nm_outlet' => $r->nm_outlet,
			'alamat' => $r->alamat,
			'alamat_tambahan' => $r->alamat_tambahan,
			'tlp' => $r->tlp,
			'fax' => $r->fax,
			'npwp' => $r->npwp,
			'tgl_pkp' => $r->tgl_pkp,
			'tgl_buka' => $r->tgl_buka,
			'type' => $r->type,
			'id_induk' => $r->id_induk,
			'city_code' => $r->city_code,
			'file_logo' => $r->file_logo,
			'created' => $r->created,
			'modified' => $r->modified,
			'author' => $r->author,
			'is_active' => $r->is_active,
			'la_laba_ditahan' => $r->la_laba_ditahan,
			'la_laba_rugi' => $r->la_laba_rugi,
			'la_akun_selisih' => $r->la_akun_selisih,
			'la_terima_giro_blm_jt' => $r->la_terima_giro_blm_jt,
			'la_akun_hd' => $r->la_akun_hd,
			'la_bank_byr_spl' => $r->la_bank_byr_spl,
			'la_biaya_angkut_beli' => $r->la_biaya_angkut_beli,
			'la_uang_muka_beli' => $r->la_uang_muka_beli,
			'la_disc_beli' => $r->la_disc_beli,
			'la_beban_akun_tbayar' => $r->la_beban_akun_tbayar,
			'la_wajib_item_terima' => $r->la_wajib_item_terima,
			'la_piutang_usaha' => $r->la_piutang_usaha,
			'la_akun_bank_terima_plg' => $r->la_akun_bank_terima_plg,
			'la_pend_jual' => $r->la_pend_jual,
			'la_pend_jasa' => $r->la_pend_jasa,
			'la_uang_muka_jual' => $r->la_uang_muka_jual,
			'la_pot_jual' => $r->la_pot_jual,
			'la_pendapatan_denda' => $r->la_pendapatan_denda,
			'la_hpp' => $r->la_hpp,
			'la_inventory' => $r->la_inventory,
			'la_biaya_belanja_noninventory' => $r->la_biaya_belanja_noninventory,
			'la_item_masuk' => $r->la_item_masuk,
			'la_item_keluar' => $r->la_item_keluar,
			'la_opname' => $r->la_opname,
			'la_item_sa' => $r->la_item_sa,
			'la_pajak_beli' => $r->la_pajak_beli,
			'la_dp_pesen_beli' => $r->la_dp_pesen_beli,
			'la_retur_pot_beli' => $r->la_retur_pot_beli,
			'la_retur_pajak_beli' => $r->la_retur_pajak_beli,
			'la_retur_biaya_angkut_beli' => $r->la_retur_biaya_angkut_beli,
			'la_retur_dp_beli' => $r->la_retur_dp_beli,
			'la_retur_hd' => $r->la_retur_hd,
			'la_titip_dp_pesan_beli' => $r->la_titip_dp_pesan_beli,
			'la_kas_dp_pesen_beli' => $r->la_kas_dp_pesen_beli,
			'la_pajak_jual' => $r->la_pajak_jual,
			'la_biaya_kirim_jual' => $r->la_biaya_kirim_jual,
			'la_byr_debit_jual' => $r->la_byr_debit_jual,
			'la_byr_cc_jual' => $r->la_byr_cc_jual,
			'la_komisi_sales_jual' => $r->la_komisi_sales_jual,
			'la_dp_pesan_jual' => $r->la_dp_pesan_jual,
			'la_pot_retur_jual' => $r->la_pot_retur_jual,
			'la_pajak_retur_jual' => $r->la_pajak_retur_jual,
			'la_biaya_kirim_retur_jual' => $r->la_biaya_kirim_retur_jual,
			'la_uang_muka_retur_jual' => $r->la_uang_muka_retur_jual,
			'la_piutang_usaha_retur' => $r->la_piutang_usaha_retur,
			'la_komisi_sales_retur_jual' => $r->la_komisi_sales_retur_jual,
			'la_pot_jual_kasir' => $r->la_pot_jual_kasir,
			'la_pajak_kasir' => $r->la_pajak_kasir,
			'la_biaya_kirim_kasir' => $r->la_biaya_kirim_kasir,
			'la_dp_kasir' => $r->la_dp_kasir,
			'la_byr_debit_kasir' => $r->la_byr_debit_kasir,
			'la_byr_cc_kasir' => $r->la_byr_cc_kasir,
			'la_piutang_dagang_kasir' => $r->la_piutang_dagang_kasir,
			'la_komisi_sales_kasir' => $r->la_komisi_sales_kasir,
			'la_dp_so' => $r->la_dp_so,
			'la_kas_dp_so' => $r->la_kas_dp_so,
			'la_pajak_ksy' => $r->la_pajak_ksy,
			'la_biaya_kirim_ksy' => $r->la_biaya_kirim_ksy,
			'la_hutang_ksy' => $r->la_hutang_ksy,
			'la_pajak_retur_ksy' => $r->la_pajak_retur_ksy,
			'la_biaya_kirim_retur_ksy' => $r->la_biaya_kirim_retur_ksy,
			'la_hutang_retur_ksy' => $r->la_hutang_retur_ksy,
			'la_pot_hutang' => $r->la_pot_hutang,
			'la_pot_piutang' => $r->la_pot_piutang,
			'la_laba_selisih_kurs' => $r->la_laba_selisih_kurs,
			'la_rugi_selisih_kurs' => $r->la_rugi_selisih_kurs,
			'la_prive' => $r->la_prive,
			'la_laba_thn_bjalan' => $r->la_laba_thn_bjalan,
			'la_penyeimbang' => $r->la_penyeimbang,
			'la_biaya_kirim_dari' => $r->la_biaya_kirim_dari
		);
		$ins  = $client->call('company',$array);
		if($ins) {
			$baris = $baris + 1;
			echo $baris."|".$jml;	
		}		
	}
	
	/* function buat() {
		$sql = $this->db->query("select tmp from _tmp");
		foreach($sql->result() as $rs) {
			//echo "'".$rs->tmp."' => \$r->".$rs->tmp.",<br />";
			echo $rs->tmp."='\$".$rs->tmp."',";
		}
	} */
	
	function groups_user() {
		
		$ping = $this->msistem->ping();
		if($ping==0):
			echo $ping;
			return;
		endif;
		
		$tgl_1 = $this->input->post('tgl_1');
		$baris = $this->input->post('baris');
		$jml = $this->input->post('jml');
		
		$kondisi = "where created >= '".$tgl_1."' or modified >= '".$tgl_1."'";
		
		if($baris == 0):
			$sql = $this->db->query("select group_id from master_groups $kondisi");
			$jml = count($sql->result());
			if($jml==0):
				echo "0|0";
				return;
			endif;
		endif;
		
		$r = $this->db->query("select * from master_groups $kondisi limit $baris,1")->row();
		
		$client = new nusoap_client($this->msistem->ulrSoap());
 			
		$array = array(
			'group_id' => $r->group_id,
			'name' => $r->name,
			'description' => $r->description,
			'created' => $r->created,
			'created_by' => $r->created_by,
			'modified' => $r->modified,
			'modified_by' => $r->modified_by
		);
		$ins  = $client->call('groups_user',$array);
		if($ins) {
			// Hak Report
			$s = $this->db->query("select * from sys_hak_menu where group_id = '".$r->group_id."'");
			foreach($s->result() as $rs) {
				$arrSHM = array(
					'idmenu' => $rs->idmenu,
					'group_id' => $rs->group_id,
					'baru' => $rs->baru,
					'cetak' => $rs->cetak,
					'ubah' => $rs->ubah,
					'hapus' => $rs->hapus,
					'kunci_tgl' => $rs->kunci_tgl
				);	
				$ins  = $client->call('hak_menu',$arrSHM);
			}
			// Hak Outlet
			$s = $this->db->query("select * from sys_hak_outlet where group_id = '".$r->group_id."'");
			foreach($s->result() as $rs) {
				$arrSHO = array(
					'outlet_id' => $rs->outlet_id,
					'group_id' => $rs->group_id,
					'view' => $rs->view
				);	
				$ins  = $client->call('hak_outlet',$arrSHO);
			}
			$baris = $baris + 1;
			echo $baris."|".$jml;	
		}		
	}
	
	function size_run() {
		
		$ping = $this->msistem->ping();
		if($ping==0):
			echo $ping;
			return;
		endif;
		
		$tgl_1 = $this->input->post('tgl_1');
		$baris = $this->input->post('baris');
		$jml = $this->input->post('jml');
		
		$kondisi = "where created >= '".$tgl_1."' or modified >= '".$tgl_1."'";
		
		if($baris == 0):
			$sql = $this->db->query("select id from ref_sizerun $kondisi");
			$jml = count($sql->result());
			if($jml==0):
				echo "0|0";
				return;
			endif;
		endif;
		
		$r = $this->db->query("select * from ref_sizerun $kondisi limit $baris,1")->row();
		
		$client = new nusoap_client($this->msistem->ulrSoap());
 			
		$array = array(
			'kode_sizerun' => $r->kode_sizerun,
			'nama_sizerun' => $r->nama_sizerun,
			'created_by' => $r->created_by,
			'created' => $r->created,
			'modified_by' => $r->modified_by,
			'modified' => $r->modified
		);
		$ins  = $client->call('size_run',$array);
		if($ins) {
			$s = $this->db->query("select * from ref_sizerun_child where kode_sizerun = '".$r->kode_sizerun."'");
			foreach($s->result() as $rs) {
					$arrSZ = array(
						'kode_sizerun' => $rs->kode_sizerun,
						'idsize' => $rs->idsize,
						'qty' => $rs->qty
					);
					$ins  = $client->call('size_run_child',$arrSZ);
			}
			$baris = $baris + 1;
			echo $baris."|".$jml;	
		}		
	}
	
	function perkiraan() {
		
		$ping = $this->msistem->ping();
		if($ping==0):
			echo $ping;
			return;
		endif;
		
		$tgl_1 = $this->input->post('tgl_1');
		$baris = $this->input->post('baris');
		$jml = $this->input->post('jml');
		
		$kondisi = "where created >= '".$tgl_1."' or modified >= '".$tgl_1."'";
		
		if($baris == 0):
			$sql = $this->db->query("select idperkiraan from ak_master_perkiraan $kondisi");
			$jml = count($sql->result());
			if($jml==0):
				echo "0|0";
				return;
			endif;
		endif;
		
		$r = $this->db->query("select * from ak_master_perkiraan $kondisi limit $baris,1")->row();
		
		$client = new nusoap_client($this->msistem->ulrSoap());
 			
		$array = array(
			'idperkiraan' => $r->idperkiraan,
			'nmperkiraan' => $r->nmperkiraan,
			'induk_perkiraan' => $r->induk_perkiraan,
			'tipe_perkiraan' => $r->tipe_perkiraan,
			'idkelompok_perkiraan' => $r->idkelompok_perkiraan,
			'kas_bank' => $r->kas_bank,
			'saldo_awal' => $r->saldo_awal,
			'is_active' => $r->is_active,
			'created' => $r->created,
			'created_by' => $r->created_by,
			'modified' => $r->modified,
			'modified_by' => $r->modified_by
		);
		$ins  = $client->call('perkiraan',$array);
		if($ins) {
			$baris = $baris + 1;
			echo $baris."|".$jml;	
		}		
	}
	
	function barang() {
		
		$ping = $this->msistem->ping();
		if($ping==0):
			echo $ping;
			return;
		endif;
		
		$tgl_1 = $this->input->post('tgl_1');
		$baris = $this->input->post('baris');
		$jml = $this->input->post('jml');
		
		$kondisi = "where created >= '".$tgl_1."' or modified >= '".$tgl_1."'";
		
		if($baris == 0):
			$sql = $this->db->query("select idbarang from master_barang $kondisi");
			$jml = count($sql->result());
			if($jml==0):
				echo "0|0";
				return;
			endif;
		endif;
		
		$r = $this->db->query("select * from master_barang $kondisi limit $baris,1")->row();
		
		$client = new nusoap_client($this->msistem->ulrSoap());
 			
		$array = array(
			'idbarang' => $r->idbarang,
			'nmbarang' => $r->nmbarang,
			'idtipe_item' => $r->idtipe_item,
			'idjns_item' => $r->idjns_item,
			'idmata_uang' => $r->idmata_uang,
			'idrak' => $r->idrak,
			'ket' => $r->ket,
			'sts_jual' => $r->sts_jual,
			'sts_konsinyasi' => $r->sts_konsinyasi,
			'sts_serial' => $r->sts_serial,
			'idsat_dasar' => $r->idsat_dasar,
			'hrg_beli' => $r->hrg_beli,
			'barcode_sama' => $r->barcode_sama,
			'idmerk' => $r->idmerk,
			'idkategori' => $r->idkategori,
			'idwarna' => $r->idwarna,
			'keterangan' => $r->keterangan,
			'stock_minimum' => $r->stock_minimum,
			'idsupplier' => $r->idsupplier,
			'code_sms' => $r->code_sms,
			'idpajak' => $r->idpajak,
			'file_gambar' => $r->file_gambar,
			'is_active' => $r->is_active,
			'created' => $r->created,
			'modified' => $r->modified,
			'created_by' => $r->created_by,
			'modified_by' => $r->modified_by
		);
		$ins = $client->call('barang',$array);
		if($ins) {
			$s = $this->db->query("select * from master_barang_detail where idbarang_induk = '".$r->idbarang."'");
			foreach($s->result() as $rs) {
					$arrSZ = array(
						'idbarang' => $rs->idbarang,
						'idsize' => $rs->idsize,
						'idsatuan' => $rs->idsatuan,
						'konversi' => $rs->konversi,
						'idbarang_induk' => $rs->idbarang_induk,
						'barcode' => $rs->barcode,
						'idgroup_barang' => $rs->idgroup_barang,
						'harga_beli' => $rs->harga_beli
					);
					$ins  = $client->call('barang_detail',$arrSZ);
			}
			$baris = $baris + 1;
			echo $baris."|".$jml;	
		}		
	}
	
	function harga_jual() {
		
		$ping = $this->msistem->ping();
		if($ping==0):
			echo $ping;
			return;
		endif;
		
		$tgl_1 = $this->input->post('tgl_1');
		$baris = $this->input->post('baris');
		$jml = $this->input->post('jml');
		
		$kondisi = "where created >= '".$tgl_1."' or modified >= '".$tgl_1."'";
		
		if($baris == 0):
			$sql = $this->db->query("select kdharga from master_harga_barang $kondisi");
			$jml = count($sql->result());
			if($jml==0):
				echo "0|0";
				return;
			endif;
		endif;
		
		$r = $this->db->query("select * from master_harga_barang $kondisi limit $baris,1")->row();
		
		$client = new nusoap_client($this->msistem->ulrSoap());
 			
		$array = array(
			'kdharga' => $r->kdharga,
			'keterangan' => $r->keterangan,
			'tgl_berlaku' => $r->tgl_berlaku,
			'is_active' => $r->is_active,
			'created' => $r->created,
			'created_by' => $r->created_by,
			'modified' => $r->modified,
			'modified_by' => $r->modified_by
		);
		$ins  = $client->call('harga_jual',$array);
		if($ins) {
			$s = $this->db->query("select * from master_harga_barang_detail where kdharga = '".$r->kdharga."'");
			foreach($s->result() as $rs) {
					$arrSZ = array(
						'kdharga' => $rs->kdharga,
						'idbarang' => $rs->idbarang,
						'harga' => $rs->harga,
						'disc_1' => $rs->disc_1,
						'disc_2' => $rs->disc_2,
						'disc_3' => $rs->disc_3,
						'disc_4' => $rs->disc_4
					);
					$ins  = $client->call('harga_jual_detail',$arrSZ);
			}
			$t = $this->db->query("select * from master_harga_outlet where kdharga = '".$r->kdharga."'");
			foreach($t->result() as $rs) {
					$arrST = array(
						'kdharga' => $rs->kdharga,
						'outlet_id' => $rs->outlet_id,
						'is_active' => $rs->is_active
					);
					$ins  = $client->call('harga_outlet',$arrST);
			}
			$baris = $baris + 1;
			echo $baris."|".$jml;	
		}		
	}
	
	function report_stock() {
		
		$ping = $this->msistem->ping();
		if($ping==0):
			echo $ping;
			return;
		endif;
		
		$tgl_1 = $this->input->post('tgl_1');
		$baris = $this->input->post('baris');
		$jml = $this->input->post('jml');
		
		$kondisi = "where created >= '".$tgl_1."'";
		
		if($baris == 0):
			$sql = $this->db->query("select notrans from rpt_stock $kondisi");
			$jml = count($sql->result());
			if($jml==0):
				echo "0|0";
				return;
			endif;
		endif;
		
		$r = $this->db->query("select * from rpt_stock $kondisi limit $baris,1")->row();
		$client = new nusoap_client($this->msistem->ulrSoap());
		
		$array = array(
			'notrans' => $r->notrans,
			'idbarang' => $r->idbarang,
			'outlet_id' => $r->outlet_id,
			'tgl' => $r->tgl,
			'qty_sa' => $r->qty_sa,
			'pcs_sa' => $r->pcs_sa,
			'jml_sa' => $r->jml_sa,
			'hrgjual_sa' => $r->hrgjual_sa,
			'qty_beli_in' => $r->qty_beli_in,
			'jml_beli_in' => $r->jml_beli_in,
			'pcs_beli_in' => $r->pcs_beli_in,
			'hrgjual_beli_in' => $r->hrgjual_beli_in,
			'qty_transfer_in' => $r->qty_transfer_in,
			'jml_transfer_in' => $r->jml_transfer_in,
			'pcs_transfer_in' => $r->pcs_transfer_in,
			'hrgbeli_transfer_in' => $r->hrgbeli_transfer_in,
			'qty_retur_in' => $r->qty_retur_in,
			'jml_retur_in' => $r->jml_retur_in,
			'hrgbeli_retur_in' => $r->hrgbeli_retur_in,
			'qty_transfer_out' => $r->qty_transfer_out,
			'jml_transfer_out' => $r->jml_transfer_out,
			'pcs_transfer_out' => $r->pcs_transfer_out,
			'hrgbeli_transfer_out' => $r->hrgbeli_transfer_out,
			'qty_jual_out' => $r->qty_jual_out,
			'jml_jual_out' => $r->jml_jual_out,
			'hrgbeli_jual_out' => $r->hrgbeli_jual_out,
			'qty_pakai_out' => $r->qty_pakai_out, 
			'jml_pakai_out' => $r->jml_pakai_out,
			'pcs_pakai_out' => $r->pcs_pakai_out,
			'hrgbeli_pakai_out' => $r->hrgbeli_pakai_out,
			'qty_retur_out' => $r->qty_retur_out,
			'jml_retur_out' => $r->jml_retur_out,
			'pcs_retur_out' => $r->pcs_retur_out,
			'hrgjual_retur_out' => $r->hrgjual_retur_out,
			'qty_opname' => $r->qty_opname,
			'pcs_opname' => $r->pcs_opname,
			'hrgbeli_opname' => $r->hrgbeli_opname,
			'hrgjual_opname' => $r->hrgjual_opname,
			'qty_adj_opname' => $r->qty_adj_opname,
			'pcs_adj_opname' => $r->pcs_adj_opname,
		);
		$ins  = $client->call('report_stock',$array);
		if($ins) {
			$baris = $baris + 1;
			echo $baris."|".$jml;	
		}		
	}
	
	function rekan_bisnis() {
		$ping = $this->msistem->ping();
		if($ping==0):
			echo $ping;
			return;
		endif;
		
		$tgl_1 = $this->input->post('tgl_1');
		$baris = $this->input->post('baris');
		$jml = $this->input->post('jml');
		
		$kondisi = "where created >= '".$tgl_1."' or modified >= '".$tgl_1."'";
		
		if($baris == 0):
			$sql = $this->db->query("select idrekan from master_rekan_bisnis $kondisi");
			$jml = count($sql->result());
			if($jml==0):
				echo "0|0";
				return;
			endif;
		endif;
		
		$r = $this->db->query("select * from master_rekan_bisnis $kondisi limit $baris,1")->row();
		
		$client = new nusoap_client($this->msistem->ulrSoap());
 			
		$array = array(
			'idrekan' => $r->idrekan,
			'idtipe_rekan' => $r->idtipe_rekan,
			'idjbt' => $r->idjbt,
			'outlet_id' => $r->outlet_id,
			'nmrekan' => $r->nmrekan,
			'idmewakili' => $r->idmewakili,
			'telp_1' => $r->telp_1,
			'telp_2' => $r->telp_2,
			'telp_3' => $r->telp_3,
			'fax' => $r->fax,
			'email' => $r->email,
			'website' => $r->website,
			'idpanggilan' => $r->idpanggilan,
			'kotak_orang' => $r->kotak_orang,
			'idperkiraan' => $r->idperkiraan,
			'cat_transaksi' => $r->cat_transaksi,
			'limit_hutang_piutang' => $r->limit_hutang_piutang,
			'idpramuniaga' => $r->idpramuniaga,
			'siup' => $r->siup,
			'npwp' => $r->npwp,
			'idtermin' => $r->idtermin,
			'diskon_hari' => $r->diskon_hari,
			'jth_tempo_hari' => $r->jth_tempo_hari,
			'diskon_pemb_lbh_awal' => $r->diskon_pemb_lbh_awal,
			'denda_terlambat_byr' => $r->denda_terlambat_byr,
			'idgrup' => $r->idgrup,
			'idtipepot' => $r->idtipepot,
			'disc_volume' => $r->disc_volume,
			'volume_beli' => $r->volume_beli,
			'idmp' => $r->idmp,
			'no_kartu' => $r->no_kartu,
			'tgl_kadaluarsa' => $r->tgl_kadaluarsa,
			'nama_pdkartu' => $r->nama_pdkartu,
			'cat_pembayaran' => $r->cat_pembayaran,
			'gaji_rate' => $r->gaji_rate,
			'gaji_jam' => $r->gaji_jam,
			'upline' => $r->upline,
			'tgl_masuk' => $r->tgl_masuk,
			'created' => $r->created,
			'created_by' => $r->created_by,
			'modified' => $r->modified,
			'modified_by' => $r->modified_by
		);
		$ins = $client->call('mrekan_bisnis',$array);
		if($ins) {
			$s = $this->db->query("select * from master_alamat_rekan where idrekan = '".$r->idrekan."'");
			foreach($s->result() as $rs) {
					$arrSZ = array(
						'idrekan' => $rs->idrekan,
						'idjnsalamat' => $rs->idjnsalamat,
						'alamat' => $rs->alamat,
						'city_code' => $rs->city_code,
						'kode_pos' => $rs->kode_pos
					);
					$ins  = $client->call('alamat_rekan',$arrSZ);
			}
			$baris = $baris + 1;
			echo $baris."|".$jml;	
		}
	}
	
	function updateTglKirim() {
		$tgl = date("Y-m-d");
		$result = $this->db->query("update sys_terakhir_kirim set terakhir = '$tgl'");
		echo $tgl;
	}
}
?>