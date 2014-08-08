<?php 
class company extends SIS_Controller { 
	public function index() {
		$data['hak_toolbar'] = $this->msistem->hak_toolbar('pg2');
		$this->load->view('company/company_index',$data);
	}
	
	function loadMainData($kode="",$nama="") {
		$qr = "";
		if($kode != '0'):
			$qr .= "and outlet_id like '%".$kode."%'";
		endif;
		if($nama != '0'):
			$qr .= "and nm_outlet like '%".$nama."%'";
		endif;
		
		$grid = new GridConnector($this->db->conn_id);
        $grid->render_sql("select id,outlet_id,nm_outlet,concat(alamat,' ',ifnull(alamat_tambahan,'')) as alamat,tlp,fax,npwp,DATE_FORMAT(tgl_pkp,'%d/%m/%Y') as tgl_pkp,DATE_FORMAT(tgl_buka,'%d/%m/%Y') as tgl_buka,type,id_induk,city_code,if(is_active=1,'YES','NO') as is_active from master_company where nm_outlet is not null $qr","id","id,outlet_id,nm_outlet,alamat,tlp,fax,npwp,tgl_pkp,tgl_buka,type,id_induk,city_code,is_active");
	}
	
	function frm_input() {
		$this->load->view('company/company_input'); 
	}
	
	function frm_input_1() {
		$this->load->view('company/company_input1'); 
	}
	
	function frm_input_2() {
		$this->load->model('m_perkiraan');
			$r = $this->db->query("select * from master_company having min(id)")->row();
			$data = array (			
                        'txtidperkiraan1' => $r->la_hpp,
                        'txtidperkiraan2' => $r->la_pend_jual,
                        'txtidperkiraan3' => $r->la_pend_jasa,
                        'txtidperkiraan4' => $r->la_inventory,
						'txtidperkiraan5' => $r->la_biaya_belanja_noninventory,
						'txtidperkiraan6' => $r->la_item_masuk,
						'txtidperkiraan7' => $r->la_item_keluar,
                        'txtidperkiraan8' => $r->la_opname,
                        'txtidperkiraan9' => $r->la_item_sa,
                        'txtidperkiraan10' => $r->la_disc_beli,
                        'txtidperkiraan11' => $r->la_pajak_beli,
                        'txtidperkiraan12' => $r->la_biaya_angkut_beli,
                        'txtidperkiraan13' => $r->la_uang_muka_beli, 
                        'txtidperkiraan14' => $r->la_akun_hd,
                        'txtidperkiraan15' => $r->la_dp_pesen_beli,
                        'txtidperkiraan16' => $r->la_bank_byr_spl,
                        'txtidperkiraan17' => $r->la_beban_akun_tbayar,
                        'txtidperkiraan18' => $r->la_wajib_item_terima,
                        'txtidperkiraan19' => $r->la_retur_pot_beli,
                        'txtidperkiraan20' => $r->la_retur_pajak_beli,
						'txtidperkiraan21' => $r->la_retur_biaya_angkut_beli,
						'txtidperkiraan22' => $r->la_retur_dp_beli,
						'txtidperkiraan23' => $r->la_retur_hd,
						'txtidperkiraan24' => $r->la_titip_dp_pesan_beli,
						'txtidperkiraan25' => $r->la_kas_dp_pesen_beli,
						'txtidperkiraan26' => $r->la_pot_jual,
						'txtidperkiraan27' => $r->la_pajak_jual,
						'txtidperkiraan28' => $r->la_biaya_kirim_jual,
						'txtidperkiraan29' => $r->la_uang_muka_jual,
						'txtidperkiraan30' => $r->la_byr_debit_jual,
						'txtidperkiraan31' => $r->la_byr_cc_jual,
						'txtidperkiraan32' => $r->la_piutang_usaha,
						'txtidperkiraan33' => $r->la_komisi_sales_jual,
						'txtidperkiraan34' => $r->la_dp_pesan_jual,
						'txtidperkiraan35' => $r->la_pendapatan_denda,
						'txtidperkiraan36' => $r->la_akun_bank_terima_plg,
						'txtidperkiraan37' => $r->la_pot_retur_jual,
						'txtidperkiraan38' => $r->la_pajak_retur_jual,
						'txtidperkiraan39' => $r->la_biaya_kirim_retur_jual,
						'txtidperkiraan40' => $r->la_uang_muka_retur_jual,
						'txtidperkiraan41' => $r->la_piutang_usaha_retur,
						'txtidperkiraan42' => $r->la_komisi_sales_retur_jual,
						'txtidperkiraan43' => $r->la_pot_jual_kasir,
						'txtidperkiraan44' => $r->la_pajak_kasir,
						'txtidperkiraan45' => $r->la_biaya_kirim_kasir,
						'txtidperkiraan46' => $r->la_dp_kasir,
						'txtidperkiraan47' => $r->la_byr_debit_kasir,
						'txtidperkiraan48' => $r->la_byr_cc_kasir,
						'txtidperkiraan49' => $r->la_piutang_dagang_kasir,
						'txtidperkiraan50' => $r->la_komisi_sales_kasir,
						'txtidperkiraan51' => $r->la_dp_so,
						'txtidperkiraan52' => $r->la_kas_dp_so,
						'txtidperkiraan53' => $r->la_pajak_ksy,
						'txtidperkiraan54' => $r->la_biaya_kirim_ksy,
						'txtidperkiraan55' => $r->la_hutang_ksy,
						'txtidperkiraan56' => $r->la_pajak_retur_ksy,
						'txtidperkiraan57' => $r->la_biaya_kirim_retur_ksy,
						'txtidperkiraan58' => $r->la_hutang_retur_ksy,
						'txtidperkiraan59' => $r->la_pot_hutang,
						'txtidperkiraan60' => $r->la_pot_piutang,
						'txtidperkiraan61' => $r->la_laba_selisih_kurs,
						'txtidperkiraan62' => $r->la_rugi_selisih_kurs,
						'txtidperkiraan63' => $r->la_prive,
						'txtidperkiraan64' => $r->la_laba_ditahan,
						'txtidperkiraan65' => $r->la_laba_thn_bjalan,
						'txtidperkiraan66' => $r->la_penyeimbang,
						'txtidperkiraan67' => $r->la_biaya_kirim_dari,
						'txtidperkiraan68' => $r->la_terima_giro_blm_jt,
						'txtidperkiraan69' => $r->la_akun_selisih,
						'txtidperkiraan70' => $r->la_laba_rugi,
						'tmpidperkiraan1' => $this->m_perkiraan->nmPerkiraan($r->la_hpp),
                        'tmpidperkiraan2' => $this->m_perkiraan->nmPerkiraan($r->la_pend_jual),
                        'tmpidperkiraan3' => $this->m_perkiraan->nmPerkiraan($r->la_pend_jasa),
                        'tmpidperkiraan4' => $this->m_perkiraan->nmPerkiraan($r->la_inventory),
						'tmpidperkiraan5' => $this->m_perkiraan->nmPerkiraan($r->la_biaya_belanja_noninventory),
						'tmpidperkiraan6' => $this->m_perkiraan->nmPerkiraan($r->la_item_masuk),
						'tmpidperkiraan7' => $this->m_perkiraan->nmPerkiraan($r->la_item_keluar),
                        'tmpidperkiraan8' => $this->m_perkiraan->nmPerkiraan($r->la_opname),
                        'tmpidperkiraan9' => $this->m_perkiraan->nmPerkiraan($r->la_item_sa),
                        'tmpidperkiraan10' => $this->m_perkiraan->nmPerkiraan($r->la_disc_beli),
                        'tmpidperkiraan11' => $this->m_perkiraan->nmPerkiraan($r->la_pajak_beli),
                        'tmpidperkiraan12' => $this->m_perkiraan->nmPerkiraan($r->la_biaya_angkut_beli),
                        'tmpidperkiraan13' => $this->m_perkiraan->nmPerkiraan($r->la_uang_muka_beli), 
                        'tmpidperkiraan14' => $this->m_perkiraan->nmPerkiraan($r->la_akun_hd),
                        'tmpidperkiraan15' => $this->m_perkiraan->nmPerkiraan($r->la_dp_pesen_beli),
                        'tmpidperkiraan16' => $this->m_perkiraan->nmPerkiraan($r->la_bank_byr_spl),
                        'tmpidperkiraan17' => $this->m_perkiraan->nmPerkiraan($r->la_beban_akun_tbayar),
                        'tmpidperkiraan18' => $this->m_perkiraan->nmPerkiraan($r->la_wajib_item_terima),
                        'tmpidperkiraan19' => $this->m_perkiraan->nmPerkiraan($r->la_retur_pot_beli),
                        'tmpidperkiraan20' => $this->m_perkiraan->nmPerkiraan($r->la_retur_pajak_beli),
						'tmpidperkiraan21' => $this->m_perkiraan->nmPerkiraan($r->la_retur_biaya_angkut_beli),
						'tmpidperkiraan22' => $this->m_perkiraan->nmPerkiraan($r->la_retur_dp_beli),
						'tmpidperkiraan23' => $this->m_perkiraan->nmPerkiraan($r->la_retur_hd),
						'tmpidperkiraan24' => $this->m_perkiraan->nmPerkiraan($r->la_titip_dp_pesan_beli),
						'tmpidperkiraan25' => $this->m_perkiraan->nmPerkiraan($r->la_kas_dp_pesen_beli),
						'tmpidperkiraan26' => $this->m_perkiraan->nmPerkiraan($r->la_pot_jual),
						'tmpidperkiraan27' => $this->m_perkiraan->nmPerkiraan($r->la_pajak_jual),
						'tmpidperkiraan28' => $this->m_perkiraan->nmPerkiraan($r->la_biaya_kirim_jual),
						'tmpidperkiraan29' => $this->m_perkiraan->nmPerkiraan($r->la_uang_muka_jual),
						'tmpidperkiraan30' => $this->m_perkiraan->nmPerkiraan($r->la_byr_debit_jual),
						'tmpidperkiraan31' => $this->m_perkiraan->nmPerkiraan($r->la_byr_cc_jual),
						'tmpidperkiraan32' => $this->m_perkiraan->nmPerkiraan($r->la_piutang_usaha),
						'tmpidperkiraan33' => $this->m_perkiraan->nmPerkiraan($r->la_komisi_sales_jual),
						'tmpidperkiraan34' => $this->m_perkiraan->nmPerkiraan($r->la_dp_pesan_jual),
						'tmpidperkiraan35' => $this->m_perkiraan->nmPerkiraan($r->la_pendapatan_denda),
						'tmpidperkiraan36' => $this->m_perkiraan->nmPerkiraan($r->la_akun_bank_terima_plg),
						'tmpidperkiraan37' => $this->m_perkiraan->nmPerkiraan($r->la_pot_retur_jual),
						'tmpidperkiraan38' => $this->m_perkiraan->nmPerkiraan($r->la_pajak_retur_jual),
						'tmpidperkiraan39' => $this->m_perkiraan->nmPerkiraan($r->la_biaya_kirim_retur_jual),
						'tmpidperkiraan40' => $this->m_perkiraan->nmPerkiraan($r->la_uang_muka_retur_jual),
						'tmpidperkiraan41' => $this->m_perkiraan->nmPerkiraan($r->la_piutang_usaha_retur),
						'tmpidperkiraan42' => $this->m_perkiraan->nmPerkiraan($r->la_komisi_sales_retur_jual),
						'tmpidperkiraan43' => $this->m_perkiraan->nmPerkiraan($r->la_pot_jual_kasir),
						'tmpidperkiraan44' => $this->m_perkiraan->nmPerkiraan($r->la_pajak_kasir),
						'tmpidperkiraan45' => $this->m_perkiraan->nmPerkiraan($r->la_biaya_kirim_kasir),
						'tmpidperkiraan46' => $this->m_perkiraan->nmPerkiraan($r->la_dp_kasir),
						'tmpidperkiraan47' => $this->m_perkiraan->nmPerkiraan($r->la_byr_debit_kasir),
						'tmpidperkiraan48' => $this->m_perkiraan->nmPerkiraan($r->la_byr_cc_kasir),
						'tmpidperkiraan49' => $this->m_perkiraan->nmPerkiraan($r->la_piutang_dagang_kasir),
						'tmpidperkiraan50' => $this->m_perkiraan->nmPerkiraan($r->la_komisi_sales_kasir),
						'tmpidperkiraan51' => $this->m_perkiraan->nmPerkiraan($r->la_dp_so),
						'tmpidperkiraan52' => $this->m_perkiraan->nmPerkiraan($r->la_kas_dp_so),
						'tmpidperkiraan53' => $this->m_perkiraan->nmPerkiraan($r->la_pajak_ksy),
						'tmpidperkiraan54' => $this->m_perkiraan->nmPerkiraan($r->la_biaya_kirim_ksy),
						'tmpidperkiraan55' => $this->m_perkiraan->nmPerkiraan($r->la_hutang_ksy),
						'tmpidperkiraan56' => $this->m_perkiraan->nmPerkiraan($r->la_pajak_retur_ksy),
						'tmpidperkiraan57' => $this->m_perkiraan->nmPerkiraan($r->la_biaya_kirim_retur_ksy),
						'tmpidperkiraan58' => $this->m_perkiraan->nmPerkiraan($r->la_hutang_retur_ksy),
						'tmpidperkiraan59' => $this->m_perkiraan->nmPerkiraan($r->la_pot_hutang),
						'tmpidperkiraan60' => $this->m_perkiraan->nmPerkiraan($r->la_pot_piutang),
						'tmpidperkiraan61' => $this->m_perkiraan->nmPerkiraan($r->la_laba_selisih_kurs),
						'tmpidperkiraan62' => $this->m_perkiraan->nmPerkiraan($r->la_rugi_selisih_kurs),
						'tmpidperkiraan63' => $this->m_perkiraan->nmPerkiraan($r->la_prive),
						'tmpidperkiraan64' => $this->m_perkiraan->nmPerkiraan($r->la_laba_ditahan),
						'tmpidperkiraan65' => $this->m_perkiraan->nmPerkiraan($r->la_laba_thn_bjalan),
						'tmpidperkiraan66' => $this->m_perkiraan->nmPerkiraan($r->la_penyeimbang),
						'tmpidperkiraan67' => $this->m_perkiraan->nmPerkiraan($r->la_biaya_kirim_dari),
						'tmpidperkiraan68' => $this->m_perkiraan->nmPerkiraan($r->la_terima_giro_blm_jt),
						'tmpidperkiraan69' => $this->m_perkiraan->nmPerkiraan($r->la_akun_selisih),
						'tmpidperkiraan70' => $this->m_perkiraan->nmPerkiraan($r->la_laba_rugi)
			);
		$this->load->view('company/company_input2',$data); 
	}
        
        function frm_search_akun() {
		$this->load->view('company/company_search_akun');
	}
	
	function frm_edit($id="") {		
                $data['id'] = $id;
		$this->load->view('company/company_input',$data);                	
	}
        
        function frm_edit_1($id="") {
            $r = $this->db->query("select *,DATE_FORMAT(tgl_pkp,'%d/%m/%Y') as tglpkp,DATE_FORMAT(tgl_buka,'%d/%m/%Y') as tglbuka from master_company where id = '".$id."'")->row();
		$data = array (
		    'id' => $r->id,
			'outlet_id' => $r->outlet_id,
			'nm_outlet' => $r->nm_outlet,
			'alamat' => $r->alamat,
			'alamat_tambahan' => $r->alamat_tambahan,
			'tlp' => $r->tlp,
			'fax' => $r->fax,
			'npwp' => $r->npwp,
			'tgl_pkp' => $r->tglpkp,
			'tgl_buka' => $r->tglbuka,
			'type' => $r->type,
			'id_induk' => $r->id_induk,
			'city_code' => $r->city_code,
			'is_active' => $r->is_active,                                           
		);
                $r = $this->db->query("select file_logo from master_company where id = '".$id."'")->row();
		$data['gambar'] = base_url()."index.php/company/loadFoto/".$r->file_logo;
		$data['nmfile'] = $r->file_logo;
                $this->load->view('company/company_input1',$data);    
        }
		
		function frm_edit_2($id="") {
			$this->load->model('m_perkiraan');
			$r = $this->db->query("select * from master_company where id = '".$id."'")->row();
			$data = array (			
                        'txtidperkiraan1' => $r->la_hpp,
                        'txtidperkiraan2' => $r->la_pend_jual,
                        'txtidperkiraan3' => $r->la_pend_jasa,
                        'txtidperkiraan4' => $r->la_inventory,
						'txtidperkiraan5' => $r->la_biaya_belanja_noninventory,
						'txtidperkiraan6' => $r->la_item_masuk,
						'txtidperkiraan7' => $r->la_item_keluar,
                        'txtidperkiraan8' => $r->la_opname,
                        'txtidperkiraan9' => $r->la_item_sa,
                        'txtidperkiraan10' => $r->la_disc_beli,
                        'txtidperkiraan11' => $r->la_pajak_beli,
                        'txtidperkiraan12' => $r->la_biaya_angkut_beli,
                        'txtidperkiraan13' => $r->la_uang_muka_beli, 
                        'txtidperkiraan14' => $r->la_akun_hd,
                        'txtidperkiraan15' => $r->la_dp_pesen_beli,
                        'txtidperkiraan16' => $r->la_bank_byr_spl,
                        'txtidperkiraan17' => $r->la_beban_akun_tbayar,
                        'txtidperkiraan18' => $r->la_wajib_item_terima,
                        'txtidperkiraan19' => $r->la_retur_pot_beli,
                        'txtidperkiraan20' => $r->la_retur_pajak_beli,
						'txtidperkiraan21' => $r->la_retur_biaya_angkut_beli,
						'txtidperkiraan22' => $r->la_retur_dp_beli,
						'txtidperkiraan23' => $r->la_retur_hd,
						'txtidperkiraan24' => $r->la_titip_dp_pesan_beli,
						'txtidperkiraan25' => $r->la_kas_dp_pesen_beli,
						'txtidperkiraan26' => $r->la_pot_jual,
						'txtidperkiraan27' => $r->la_pajak_jual,
						'txtidperkiraan28' => $r->la_biaya_kirim_jual,
						'txtidperkiraan29' => $r->la_uang_muka_jual,
						'txtidperkiraan30' => $r->la_byr_debit_jual,
						'txtidperkiraan31' => $r->la_byr_cc_jual,
						'txtidperkiraan32' => $r->la_piutang_usaha,
						'txtidperkiraan33' => $r->la_komisi_sales_jual,
						'txtidperkiraan34' => $r->la_dp_pesan_jual,
						'txtidperkiraan35' => $r->la_pendapatan_denda,
						'txtidperkiraan36' => $r->la_akun_bank_terima_plg,
						'txtidperkiraan37' => $r->la_pot_retur_jual,
						'txtidperkiraan38' => $r->la_pajak_retur_jual,
						'txtidperkiraan39' => $r->la_biaya_kirim_retur_jual,
						'txtidperkiraan40' => $r->la_uang_muka_retur_jual,
						'txtidperkiraan41' => $r->la_piutang_usaha_retur,
						'txtidperkiraan42' => $r->la_komisi_sales_retur_jual,
						'txtidperkiraan43' => $r->la_pot_jual_kasir,
						'txtidperkiraan44' => $r->la_pajak_kasir,
						'txtidperkiraan45' => $r->la_biaya_kirim_kasir,
						'txtidperkiraan46' => $r->la_dp_kasir,
						'txtidperkiraan47' => $r->la_byr_debit_kasir,
						'txtidperkiraan48' => $r->la_byr_cc_kasir,
						'txtidperkiraan49' => $r->la_piutang_dagang_kasir,
						'txtidperkiraan50' => $r->la_komisi_sales_kasir,
						'txtidperkiraan51' => $r->la_dp_so,
						'txtidperkiraan52' => $r->la_kas_dp_so,
						'txtidperkiraan53' => $r->la_pajak_ksy,
						'txtidperkiraan54' => $r->la_biaya_kirim_ksy,
						'txtidperkiraan55' => $r->la_hutang_ksy,
						'txtidperkiraan56' => $r->la_pajak_retur_ksy,
						'txtidperkiraan57' => $r->la_biaya_kirim_retur_ksy,
						'txtidperkiraan58' => $r->la_hutang_retur_ksy,
						'txtidperkiraan59' => $r->la_pot_hutang,
						'txtidperkiraan60' => $r->la_pot_piutang,
						'txtidperkiraan61' => $r->la_laba_selisih_kurs,
						'txtidperkiraan62' => $r->la_rugi_selisih_kurs,
						'txtidperkiraan63' => $r->la_prive,
						'txtidperkiraan64' => $r->la_laba_ditahan,
						'txtidperkiraan65' => $r->la_laba_thn_bjalan,
						'txtidperkiraan66' => $r->la_penyeimbang,
						'txtidperkiraan67' => $r->la_biaya_kirim_dari,
						'txtidperkiraan68' => $r->la_terima_giro_blm_jt,
						'txtidperkiraan69' => $r->la_akun_selisih,
						'txtidperkiraan70' => $r->la_laba_rugi,
						'tmpidperkiraan1' => $this->m_perkiraan->nmPerkiraan($r->la_hpp),
                        'tmpidperkiraan2' => $this->m_perkiraan->nmPerkiraan($r->la_pend_jual),
                        'tmpidperkiraan3' => $this->m_perkiraan->nmPerkiraan($r->la_pend_jasa),
                        'tmpidperkiraan4' => $this->m_perkiraan->nmPerkiraan($r->la_inventory),
						'tmpidperkiraan5' => $this->m_perkiraan->nmPerkiraan($r->la_biaya_belanja_noninventory),
						'tmpidperkiraan6' => $this->m_perkiraan->nmPerkiraan($r->la_item_masuk),
						'tmpidperkiraan7' => $this->m_perkiraan->nmPerkiraan($r->la_item_keluar),
                        'tmpidperkiraan8' => $this->m_perkiraan->nmPerkiraan($r->la_opname),
                        'tmpidperkiraan9' => $this->m_perkiraan->nmPerkiraan($r->la_item_sa),
                        'tmpidperkiraan10' => $this->m_perkiraan->nmPerkiraan($r->la_disc_beli),
                        'tmpidperkiraan11' => $this->m_perkiraan->nmPerkiraan($r->la_pajak_beli),
                        'tmpidperkiraan12' => $this->m_perkiraan->nmPerkiraan($r->la_biaya_angkut_beli),
                        'tmpidperkiraan13' => $this->m_perkiraan->nmPerkiraan($r->la_uang_muka_beli), 
                        'tmpidperkiraan14' => $this->m_perkiraan->nmPerkiraan($r->la_akun_hd),
                        'tmpidperkiraan15' => $this->m_perkiraan->nmPerkiraan($r->la_dp_pesen_beli),
                        'tmpidperkiraan16' => $this->m_perkiraan->nmPerkiraan($r->la_bank_byr_spl),
                        'tmpidperkiraan17' => $this->m_perkiraan->nmPerkiraan($r->la_beban_akun_tbayar),
                        'tmpidperkiraan18' => $this->m_perkiraan->nmPerkiraan($r->la_wajib_item_terima),
                        'tmpidperkiraan19' => $this->m_perkiraan->nmPerkiraan($r->la_retur_pot_beli),
                        'tmpidperkiraan20' => $this->m_perkiraan->nmPerkiraan($r->la_retur_pajak_beli),
						'tmpidperkiraan21' => $this->m_perkiraan->nmPerkiraan($r->la_retur_biaya_angkut_beli),
						'tmpidperkiraan22' => $this->m_perkiraan->nmPerkiraan($r->la_retur_dp_beli),
						'tmpidperkiraan23' => $this->m_perkiraan->nmPerkiraan($r->la_retur_hd),
						'tmpidperkiraan24' => $this->m_perkiraan->nmPerkiraan($r->la_titip_dp_pesan_beli),
						'tmpidperkiraan25' => $this->m_perkiraan->nmPerkiraan($r->la_kas_dp_pesen_beli),
						'tmpidperkiraan26' => $this->m_perkiraan->nmPerkiraan($r->la_pot_jual),
						'tmpidperkiraan27' => $this->m_perkiraan->nmPerkiraan($r->la_pajak_jual),
						'tmpidperkiraan28' => $this->m_perkiraan->nmPerkiraan($r->la_biaya_kirim_jual),
						'tmpidperkiraan29' => $this->m_perkiraan->nmPerkiraan($r->la_uang_muka_jual),
						'tmpidperkiraan30' => $this->m_perkiraan->nmPerkiraan($r->la_byr_debit_jual),
						'tmpidperkiraan31' => $this->m_perkiraan->nmPerkiraan($r->la_byr_cc_jual),
						'tmpidperkiraan32' => $this->m_perkiraan->nmPerkiraan($r->la_piutang_usaha),
						'tmpidperkiraan33' => $this->m_perkiraan->nmPerkiraan($r->la_komisi_sales_jual),
						'tmpidperkiraan34' => $this->m_perkiraan->nmPerkiraan($r->la_dp_pesan_jual),
						'tmpidperkiraan35' => $this->m_perkiraan->nmPerkiraan($r->la_pendapatan_denda),
						'tmpidperkiraan36' => $this->m_perkiraan->nmPerkiraan($r->la_akun_bank_terima_plg),
						'tmpidperkiraan37' => $this->m_perkiraan->nmPerkiraan($r->la_pot_retur_jual),
						'tmpidperkiraan38' => $this->m_perkiraan->nmPerkiraan($r->la_pajak_retur_jual),
						'tmpidperkiraan39' => $this->m_perkiraan->nmPerkiraan($r->la_biaya_kirim_retur_jual),
						'tmpidperkiraan40' => $this->m_perkiraan->nmPerkiraan($r->la_uang_muka_retur_jual),
						'tmpidperkiraan41' => $this->m_perkiraan->nmPerkiraan($r->la_piutang_usaha_retur),
						'tmpidperkiraan42' => $this->m_perkiraan->nmPerkiraan($r->la_komisi_sales_retur_jual),
						'tmpidperkiraan43' => $this->m_perkiraan->nmPerkiraan($r->la_pot_jual_kasir),
						'tmpidperkiraan44' => $this->m_perkiraan->nmPerkiraan($r->la_pajak_kasir),
						'tmpidperkiraan45' => $this->m_perkiraan->nmPerkiraan($r->la_biaya_kirim_kasir),
						'tmpidperkiraan46' => $this->m_perkiraan->nmPerkiraan($r->la_dp_kasir),
						'tmpidperkiraan47' => $this->m_perkiraan->nmPerkiraan($r->la_byr_debit_kasir),
						'tmpidperkiraan48' => $this->m_perkiraan->nmPerkiraan($r->la_byr_cc_kasir),
						'tmpidperkiraan49' => $this->m_perkiraan->nmPerkiraan($r->la_piutang_dagang_kasir),
						'tmpidperkiraan50' => $this->m_perkiraan->nmPerkiraan($r->la_komisi_sales_kasir),
						'tmpidperkiraan51' => $this->m_perkiraan->nmPerkiraan($r->la_dp_so),
						'tmpidperkiraan52' => $this->m_perkiraan->nmPerkiraan($r->la_kas_dp_so),
						'tmpidperkiraan53' => $this->m_perkiraan->nmPerkiraan($r->la_pajak_ksy),
						'tmpidperkiraan54' => $this->m_perkiraan->nmPerkiraan($r->la_biaya_kirim_ksy),
						'tmpidperkiraan55' => $this->m_perkiraan->nmPerkiraan($r->la_hutang_ksy),
						'tmpidperkiraan56' => $this->m_perkiraan->nmPerkiraan($r->la_pajak_retur_ksy),
						'tmpidperkiraan57' => $this->m_perkiraan->nmPerkiraan($r->la_biaya_kirim_retur_ksy),
						'tmpidperkiraan58' => $this->m_perkiraan->nmPerkiraan($r->la_hutang_retur_ksy),
						'tmpidperkiraan59' => $this->m_perkiraan->nmPerkiraan($r->la_pot_hutang),
						'tmpidperkiraan60' => $this->m_perkiraan->nmPerkiraan($r->la_pot_piutang),
						'tmpidperkiraan61' => $this->m_perkiraan->nmPerkiraan($r->la_laba_selisih_kurs),
						'tmpidperkiraan62' => $this->m_perkiraan->nmPerkiraan($r->la_rugi_selisih_kurs),
						'tmpidperkiraan63' => $this->m_perkiraan->nmPerkiraan($r->la_prive),
						'tmpidperkiraan64' => $this->m_perkiraan->nmPerkiraan($r->la_laba_ditahan),
						'tmpidperkiraan65' => $this->m_perkiraan->nmPerkiraan($r->la_laba_thn_bjalan),
						'tmpidperkiraan66' => $this->m_perkiraan->nmPerkiraan($r->la_penyeimbang),
						'tmpidperkiraan67' => $this->m_perkiraan->nmPerkiraan($r->la_biaya_kirim_dari),
						'tmpidperkiraan68' => $this->m_perkiraan->nmPerkiraan($r->la_terima_giro_blm_jt),
						'tmpidperkiraan69' => $this->m_perkiraan->nmPerkiraan($r->la_akun_selisih),
						'tmpidperkiraan70' => $this->m_perkiraan->nmPerkiraan($r->la_laba_rugi)
			);
            $this->load->view('company/company_input2',$data);
		}
        
        /* function frm_edit_2($id="") {
            $r = $this->db->query("select 
                a.*,DATE_FORMAT(a.tgl_pkp,'%d/%m/%Y') as tglpkp,DATE_FORMAT(a.tgl_buka,'%d/%m/%Y') as tglbuka 
                ,b.nmperkiraan as tmp_la_laba_ditahan
                ,c.nmperkiraan as tmp_la_laba_rugi
                ,d.nmperkiraan as tmp_la_akun_selisih
                ,e.nmperkiraan as tmp_la_terima_giro_blm_jt
                ,f.nmperkiraan as tmp_la_akun_hd
                ,g.nmperkiraan as tmp_la_bank_byr_spl
                ,h.nmperkiraan as tmp_la_biaya_angkut_beli
                ,i.nmperkiraan as tmp_la_uang_muka_beli
                ,j.nmperkiraan as tmp_la_disc_beli
                ,k.nmperkiraan as tmp_la_beban_akun_tbayar
                ,l.nmperkiraan as tmp_la_wajib_item_terima
                ,m.nmperkiraan as tmp_la_piutang_usaha
                ,n.nmperkiraan as tmp_la_akun_bank_terima_plg
                ,o.nmperkiraan as tmp_la_pend_jasa
                ,p.nmperkiraan as tmp_la_uang_muka_jual
                ,q.nmperkiraan as tmp_la_pot_jual
                ,r.nmperkiraan as tmp_la_pendapatan_denda
                ,s.nmperkiraan as tmp_la_hpp
                ,t.nmperkiraan as tmp_la_inventory
                ,u.nmperkiraan as tmp_la_biaya_belanja_noninventory
                from master_company a 
                left join ak_master_perkiraan b on a.la_laba_ditahan=b.idperkiraan
                left join ak_master_perkiraan c on a.la_laba_rugi=c.idperkiraan
                left join ak_master_perkiraan d on a.la_akun_selisih=d.idperkiraan
                left join ak_master_perkiraan e on a.la_terima_giro_blm_jt=e.idperkiraan
                left join ak_master_perkiraan f on a.la_akun_hd=f.idperkiraan
                left join ak_master_perkiraan g on a.la_bank_byr_spl=g.idperkiraan
                left join ak_master_perkiraan h on a.la_biaya_angkut_beli=h.idperkiraan
                left join ak_master_perkiraan i on a.la_uang_muka_beli=i.idperkiraan
                left join ak_master_perkiraan j on a.la_disc_beli=j.idperkiraan
                left join ak_master_perkiraan k on a.la_beban_akun_tbayar=k.idperkiraan
                left join ak_master_perkiraan l on a.la_wajib_item_terima=l.idperkiraan
                left join ak_master_perkiraan m on a.la_piutang_usaha=m.idperkiraan
                left join ak_master_perkiraan n on a.la_akun_bank_terima_plg=n.idperkiraan
                left join ak_master_perkiraan o on a.la_pend_jasa=o.idperkiraan
                left join ak_master_perkiraan p on a.la_uang_muka_jual=p.idperkiraan
                left join ak_master_perkiraan q on a.la_pot_jual=q.idperkiraan
                left join ak_master_perkiraan r on a.la_pendapatan_denda=r.idperkiraan
                left join ak_master_perkiraan s on a.la_hpp=s.idperkiraan
                left join ak_master_perkiraan t on a.la_inventory=t.idperkiraan
                left join ak_master_perkiraan u on a.la_biaya_belanja_noninventory=u.idperkiraan
                where a.id = '".$id."'")->row();
		$data = array (			
                        'txtidperkiraan1' => $r->la_laba_ditahan,
                        'txtidperkiraan2' => $r->la_laba_rugi,
                        'txtidperkiraan3' => $r->la_akun_selisih,
                        'txtidperkiraan4' => $r->la_terima_giro_blm_jt,
                        'txtidperkiraan14' => $r->la_akun_hd,
                        'txtidperkiraan15' => $r->la_bank_byr_spl,
                        'txtidperkiraan16' => $r->la_biaya_angkut_beli,
                        'txtidperkiraan17' => $r->la_uang_muka_beli,
                        'txtidperkiraan18' => $r->la_disc_beli,
                        'txtidperkiraan19' => $r->la_beban_akun_tbayar,
                        'txtidperkiraan20' => $r->la_wajib_item_terima,
                        'txtidperkiraan5' => $r->la_piutang_usaha,
                        'txtidperkiraan6' => $r->la_akun_bank_terima_plg,
                        'txtidperkiraan7' => $r->la_pend_jasa,
                        'txtidperkiraan8' => $r->la_uang_muka_jual,
                        'txtidperkiraan9' => $r->la_pot_jual,
                        'txtidperkiraan10' => $r->la_pendapatan_denda,
                        'txtidperkiraan11' => $r->la_hpp,
                        'txtidperkiraan12' => $r->la_inventory,
                        'txtidperkiraan13' => $r->la_biaya_belanja_noninventory,                        
                    
                        'tmpidperkiraan1' => $r->tmp_la_laba_ditahan,
                        'tmpidperkiraan2' => $r->tmp_la_laba_rugi,
                        'tmpidperkiraan3' => $r->tmp_la_akun_selisih,
                        'tmpidperkiraan4' => $r->tmp_la_terima_giro_blm_jt,
                        'tmpidperkiraan14' => $r->tmp_la_akun_hd,
                        'tmpidperkiraan15' => $r->tmp_la_bank_byr_spl,
                        'tmpidperkiraan16' => $r->tmp_la_biaya_angkut_beli,
                        'tmpidperkiraan17' => $r->tmp_la_uang_muka_beli,
                        'tmpidperkiraan18' => $r->tmp_la_disc_beli,
                        'tmpidperkiraan19' => $r->tmp_la_beban_akun_tbayar,
                        'tmpidperkiraan20' => $r->tmp_la_wajib_item_terima,
                        'tmpidperkiraan5' => $r->tmp_la_piutang_usaha,
                        'tmpidperkiraan6' => $r->tmp_la_akun_bank_terima_plg,
                        'tmpidperkiraan7' => $r->tmp_la_pend_jasa,
                        'tmpidperkiraan8' => $r->tmp_la_uang_muka_jual,
                        'tmpidperkiraan9' => $r->tmp_la_pot_jual,
                        'tmpidperkiraan10' => $r->tmp_la_pendapatan_denda,
                        'tmpidperkiraan11' => $r->tmp_la_hpp,
                        'tmpidperkiraan12' => $r->tmp_la_inventory,
                        'tmpidperkiraan13' => $r->tmp_la_biaya_belanja_noninventory,
		);
                $this->load->view('company/company_input2',$data); 
        } */
	
	function cbKantorPusat() {
		$combo = new ComboConnector($this->db->conn_id); 
		$combo->render_sql("select outlet_id,nm_outlet from master_company where type='PUSAT'","outlet_id","nm_outlet");
	}
	
	function cbKota() {
		$combo = new ComboConnector($this->db->conn_id); 
		$combo->render_sql("select city_code,city_name from master_city order by city_name asc","city_code","city_name");
	}
	
	function simpan() {		
		$tglBuat = date("Y-m-d H:i:s");
		$tgl_pkp = $this->msistem->conversiTgl($this->input->post('txttgl_pkp'));
		$tgl_buka = $this->msistem->conversiTgl($this->input->post('txttgl_buka'));
                if($this->input->post('gambar') != "") {
			$tempGambar = explode(".",$this->input->post('gambar'));
			$fileName = $this->input->post('txtkode').".".$tempGambar[1];
		} else {
			$fileName = "";
		}
		//$this->input->post('slcKantorPusat'),
		$data = array (
			'nm_outlet' => strtoupper($this->input->post('txtnmperusahaan')),
			'alamat' => strtoupper($this->input->post('txtalamat1')),
			'alamat_tambahan' => strtoupper($this->input->post('txtalamat2')),
			'tlp' => $this->input->post('txttlp'),
			'fax' => $this->input->post('txtfax'),
			'npwp' => $this->input->post('txtnpwp'),
			'tgl_pkp' => $tgl_pkp,
			'tgl_buka' => $tgl_buka,
			'type' => $this->input->post('slctype'),
			'id_induk' => '0',
			'city_code' => $this->input->post('slcKota'),
			'created' => $tglBuat,
			'author' => $this->session->userdata('sis_user'),
			'is_active' => $this->input->post('slcaktif'),
                        'la_hpp' => $this->input->post('txtidperkiraan1'),
                        'la_pend_jual' => $this->input->post('txtidperkiraan2'),
                        'la_pend_jasa' => $this->input->post('txtidperkiraan3'),
                        'la_inventory' => $this->input->post('txtidperkiraan4'),
						'la_biaya_belanja_noninventory' => $this->input->post('txtidperkiraan5'),
						'la_item_masuk' => $this->input->post('txtidperkiraan6'),
						'la_item_keluar' => $this->input->post('txtidperkiraan7'),
						'la_opname' => $this->input->post('txtidperkiraan8'),
						'la_item_sa' => $this->input->post('txtidperkiraan9'),
                        'la_disc_beli' => $this->input->post('txtidperkiraan10'),
                        'la_pajak_beli' => $this->input->post('txtidperkiraan11'),
                        'la_biaya_angkut_beli' => $this->input->post('txtidperkiraan12'),
                        'la_uang_muka_beli' => $this->input->post('txtidperkiraan13'),
                        'la_akun_hd' => $this->input->post('txtidperkiraan14'),
                        'la_dp_pesen_beli' => $this->input->post('txtidperkiraan15'),
                        'la_bank_byr_spl' => $this->input->post('txtidperkiraan16'),
                        'la_beban_akun_tbayar' => $this->input->post('txtidperkiraan17'),
                        'la_wajib_item_terima' => $this->input->post('txtidperkiraan18'),
                        'la_retur_pot_beli' => $this->input->post('txtidperkiraan19'),
                        'la_retur_pajak_beli' => $this->input->post('txtidperkiraan20'),
						'la_retur_biaya_angkut_beli' => $this->input->post('txtidperkiraan21'),
						'la_retur_dp_beli' => $this->input->post('txtidperkiraan22'),
						'la_retur_hd' => $this->input->post('txtidperkiraan23'),
						'la_titip_dp_pesan_beli' => $this->input->post('txtidperkiraan24'),
						'la_kas_dp_pesen_beli' => $this->input->post('txtidperkiraan25'),
						'la_pot_jual' => $this->input->post('txtidperkiraan26'),
						'la_pajak_jual' => $this->input->post('txtidperkiraan27'),
						'la_biaya_kirim_jual' => $this->input->post('txtidperkiraan28'),
						'la_uang_muka_jual' => $this->input->post('txtidperkiraan29'),
						'la_byr_debit_jual' => $this->input->post('txtidperkiraan30'),
						'la_byr_cc_jual' => $this->input->post('txtidperkiraan31'),
						'la_piutang_usaha' => $this->input->post('txtidperkiraan32'),
						'la_komisi_sales_jual' => $this->input->post('txtidperkiraan33'),
						'la_dp_pesan_jual' => $this->input->post('txtidperkiraan34'),
						'la_pendapatan_denda' => $this->input->post('txtidperkiraan35'),
						'la_akun_bank_terima_plg' => $this->input->post('txtidperkiraan36'),
						'la_pot_retur_jual' => $this->input->post('txtidperkiraan37'),
						'la_pajak_retur_jual' => $this->input->post('txtidperkiraan38'),
						'la_biaya_kirim_retur_jual' => $this->input->post('txtidperkiraan39'),
						'la_uang_muka_retur_jual' => $this->input->post('txtidperkiraan40'),
						'la_piutang_usaha_retur' => $this->input->post('txtidperkiraan41'),
						'la_komisi_sales_retur_jual' => $this->input->post('txtidperkiraan42'),
						'la_pot_jual_kasir' => $this->input->post('txtidperkiraan43'),
						'la_pajak_kasir' => $this->input->post('txtidperkiraan44'),
						'la_biaya_kirim_kasir' => $this->input->post('txtidperkiraan45'),
						'la_dp_kasir' => $this->input->post('txtidperkiraan46'),
						'la_byr_debit_kasir' => $this->input->post('txtidperkiraan47'),
						'la_byr_cc_kasir' => $this->input->post('txtidperkiraan48'),
						'la_piutang_dagang_kasir' => $this->input->post('txtidperkiraan49'),
						'la_komisi_sales_kasir' => $this->input->post('txtidperkiraan50'),
						'la_dp_so' => $this->input->post('txtidperkiraan51'),
						'la_kas_dp_so' => $this->input->post('txtidperkiraan52'),
						'la_pajak_ksy' => $this->input->post('txtidperkiraan53'),
						'la_biaya_kirim_ksy' => $this->input->post('txtidperkiraan54'),
						'la_hutang_ksy' => $this->input->post('txtidperkiraan55'),
						'la_pajak_retur_ksy' => $this->input->post('txtidperkiraan56'),
						'la_biaya_kirim_retur_ksy' => $this->input->post('txtidperkiraan57'),
						'la_hutang_retur_ksy' => $this->input->post('txtidperkiraan58'),
						'la_pot_hutang' => $this->input->post('txtidperkiraan59'),
						'la_pot_piutang' => $this->input->post('txtidperkiraan60'),
						'la_laba_selisih_kurs' => $this->input->post('txtidperkiraan61'),
						'la_rugi_selisih_kurs' => $this->input->post('txtidperkiraan62'),
						'la_prive' => $this->input->post('txtidperkiraan63'),
						'la_laba_ditahan' => $this->input->post('txtidperkiraan64'),
						'la_laba_thn_bjalan' => $this->input->post('txtidperkiraan65'),
						'la_penyeimbang' => $this->input->post('txtidperkiraan66'),
						'la_biaya_kirim_dari' => $this->input->post('txtidperkiraan67'),
						'la_terima_giro_blm_jt' => $this->input->post('txtidperkiraan68'),
						'la_akun_selisih' => $this->input->post('txtidperkiraan69'),
						'la_laba_rugi' => $this->input->post('txtidperkiraan70')
		);
                if($this->input->post('gambar') != ""):
				$data = array_merge($data,array('file_logo' => $fileName));
		endif;
		$this->db->trans_begin();
		if($this->input->post('id')=='') {
			if($this->input->post('txtkode')=="") {
				$outlet_id = $this->generateCode($this->input->post('slctype'));
			} else {
				$outlet_id = $this->input->post('txtkode');	
			}
			$data = array_merge($data,array('outlet_id' => $outlet_id));
			$this->db->insert('master_company', $data);
			$this->msistem->log_book('Input data baru id "'.$outlet_id,'PG2',$this->session->userdata('sis_user'));
		} else {
			$outlet_id = $this->input->post('txtkode');
                        echo $this->input->post('hpsFoto');
			if($this->input->post('hpsFoto') != ""):
					$data = array_merge($data,array('file_logo' => ''));
			endif;
			$this->db->update('master_company',$data,array('outlet_id' => $outlet_id));
			$this->msistem->log_book('Update data id "'.$outlet_id,'PG2',$this->session->userdata('sis_user'));
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
                    echo $outlet_id;
                }
	}
	
	function generateCode($type) {
		$hrfAwal = substr($type,0,1);
		$r = $this->db->query("select MAX(id) as codemax from master_company")->row();
		$no = $r->codemax + 1;
		if(strlen($no)==1) {
			$txtNo = '00'.$no;
		} elseif(strlen($no)==2) {
			$txtNo = '00'.$no;
		} elseif(strlen($no)==3) {
			$txtNo = $no;
		}
		return $hrfAwal.$txtNo;
	}
	
	function hapus() {
		$idrec = $this->input->post('idrec');
		$this->db->trans_begin();
		// log delete
		$r = $this->db->query("select outlet_id from master_company where id = '".$idrec."'")->row();
		$outlet_id = $r->outlet_id;
		$this->msistem->log_delete("master_company","where outlet_id = '$outlet_id'");
		// hapus
		$this->db->delete("master_company",array('id' => $idrec));
		$this->msistem->log_book('Delete data id "'.$idrec,'PG2',$this->session->userdata('sis_user'));
		if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
			//echo "Hapus Data Gagal";
			echo "0";
        } else {
            $this->db->trans_commit();
			echo "1";
        }
	}
        
        function loadDataPerkiraan() {
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select a.idperkiraan,a.nmperkiraan,b.nmkelompok from ak_master_perkiraan a inner join ak_master_kelompok_perkiraan b on a.idkelompok_perkiraan = b.idkelompok_perkiraan order by idperkiraan asc","idperkiraan","idperkiraan,nmperkiraan,nmkelompok");
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
        
        function loadFoto($gambar="") {
		if($gambar != ""):
			echo '<img src="../../../gambar/'.$gambar.'" width="280" height="130" />';
		endif;
	}
}

?>