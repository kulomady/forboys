<?php 
class surat_pesanan extends SIS_Controller {
	
	public function __construct() {
        parent::__construct();
		$this->load->model('m_member');
		$this->load->model('m_komisi');
	}
	
	public function index() {
		$data['hak_toolbar'] = $this->msistem->hak_toolbar('mk3');
		$this->load->view('surat_pesanan/sp_index',$data);
	}
	
	function frm_search_customer(){
		$this->load->view('surat_pesanan/sp_search_customer'); 
	}
	
	function loadDataCustomer() {
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select id,kdtrans,nama_customer,agama,alamat,DATE_FORMAT(tgl_lahir,'%d/%m/%Y') as tgl,kodepos,telp_rumah,telp_hp,telp_kantor,fax,no_identitas,email,no_npwp from master_customer order by kdtrans asc","id","id,kdtrans,nama_customer,agama,alamat,tgl,kodepos,telp_rumah,telp_hp,telp_kantor,fax,no_identitas,email,no_npwp");
	}
	
	function frm_search_member(){
		$this->load->view('surat_pesanan/sp_search_member'); 
	}
	
	function frm_search_KOSL(){
		$this->load->view('surat_pesanan/sp_search_KOSL'); 
	}
	
	function frm_search_SL(){
		$this->load->view('surat_pesanan/sp_search_SL'); 
	}
	
	function frm_search_KOLS(){
		$this->load->view('surat_pesanan/sp_search_KOLS'); 
	}
	
	function frm_search_LS(){
		$this->load->view('surat_pesanan/sp_search_LS'); 
	}
	
	function loadDataMember() {
		if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
 			header("Content-type: application/xhtml+xml"); } else {
 			header("Content-type: text/xml");
		}
		echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");
		echo "<rows>";
		
		$sql = $this->db->query("select id, id_deal, jns, nama_member, nama_perusahaan, telp_hp from master_member order by id_deal asc");
		$i = 1;
		foreach($sql->result() as $rs){
			if($rs->jns=='1'){
				$member = $rs->nama_member;
			} else {
				$member = $rs->nama_perusahaan;
			}
			
			echo ("<row id='".$i."'>");
				echo("<cell><![CDATA[".$rs->id."]]></cell>");
				echo("<cell><![CDATA[".$rs->id_deal."]]></cell>");
				echo("<cell><![CDATA[".$member."]]></cell>");
				echo("<cell><![CDATA[".$rs->telp_hp."]]></cell>");
			echo("</row>");
			$i++;
		}
		
		echo "</rows>";
	}
	
	public function frm_input_1(){
		$data['hak_toolbar'] = $this->msistem->hak_toolbar('mk3');
		$data['dev'] = $this->m_member->pilihDev(0);
		$data['landed'] = $this->m_member->pilihLanded(0);
		$this->load->view('surat_pesanan/sp_input',$data);
	}
	
	public function frm_input_2(){
		$data['hak_toolbar'] = $this->msistem->hak_toolbar('mk3');
		$this->load->view('surat_pesanan/sp_input_2',$data);
	}
	
	public function frm_input_3(){
		$data['hak_toolbar'] = $this->msistem->hak_toolbar('mk3');
		$this->load->view('surat_pesanan/sp_input_3',$data);
	}
	
	function loadMainData() {
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select id,kdtrans,DATE_FORMAT(tgl,'%d-%m-%Y') as tgl,harga_jual,komisi,created,created_by,modified,modified_by from trans_surat_pesanan order by kdtrans asc","id","id,kdtrans,tgl,harga_jual,komisi,created,created_by,modified,modified_by");
	}
	
	function frm_input() {
		$this->load->view('surat_pesanan/sp_utama'); 
	}
	
	function frm_edit($id="") {
		$data['id'] = $id;
		$this->load->view('surat_pesanan/sp_utama',$data); 
	}
	
	function frm_edit_1($id="") {
		$data['id'] = $id;
		$r = $this->db->query("select a.kdtrans, a.kode_member, a.kode_pelanggan, c.nama_customer, DATE_FORMAT(c.tgl_lahir,'%d/%m/%Y') as tgl, c.alamat, c.agama, c.kodepos, c.telp_rumah, c.telp_hp, c.telp_kantor, c.fax, c.no_identitas, c.email, c.no_npwp, a.alamat_surat, a.kode_pos_surat, a.unit_pesanan, a.kode_dev, a.tipe_bedroom, a.marketing_floor_no, a.no_unit, a.sts, a.luas_unit, a.tower, a.spesifikasi, b.nama_member, b.telp_hp as no_hp, a.sts, a.kode_dev,  a.dev_landed, a.tipe_landed, a.no_unit_landed, a.sts_landed, a.ltlb, a.spek_landed, a.dev_landed from trans_surat_pesanan a left join master_member b on a.kode_member=b.id_deal left join master_customer c on a.kode_pelanggan=c.kdtrans where a.id = '".$id."'")->row();
		$data['dev'] = $this->m_member->pilihDev($r->kode_dev);
		$data['no'] = $r->kdtrans;
		$data['kode_pelanggan'] = $r->kode_pelanggan;
		$data['kode_member'] = $r->kode_member;
		$data['nama_member'] = $r->nama_member;
		$data['no_hp'] = $r->no_hp;
		$data['tlp_hp'] = $r->telp_hp;
		$data['nama_pemesan'] = $r->nama_customer;
		$data['tgl_lahir'] = $r->tgl;
		$data['alamat'] = $r->alamat;
		$data['agama'] = $r->agama;
		$data['pos'] = $r->kodepos;
		$data['tlp_rumah'] = $r->telp_rumah;
		$data['tlp_hp'] = $r->telp_hp;
		$data['tlp_kantor'] = $r->telp_kantor;
		$data['fax'] = $r->fax;
		$data['identitas'] = $r->no_identitas;
		$data['email'] = $r->email;
		$data['npwp'] = $r->no_npwp;
		$data['alamat_surat'] = $r->alamat_surat;
		$data['pos_surat'] = $r->kode_pos_surat;
		$data['unit_pesan'] = $r->unit_pesanan;
		$data['type_badroom'] = $r->tipe_bedroom;
		$data['floor_no'] = $r->marketing_floor_no;
		$data['no_unit'] = $r->no_unit;
		$data['sts'] = $r->sts;
		$data['luas'] = $r->luas_unit;
		$data['tower'] = $r->tower;
		$data['spek'] = $r->spesifikasi;
		$data['landed'] = $this->m_member->pilihLanded($r->dev_landed);
		$data['type_landed'] = $r->tipe_landed;
		$data['ltlb'] = $r->ltlb;
		$data['no_unit_landed'] = $r->no_unit_landed;
		$data['sts_landed'] = $r->sts_landed;
		$data['spek2'] = $r->spek_landed;
		$this->load->view('surat_pesanan/sp_input',$data);
	}
	
	function frm_edit_2($id="") {
		$r = $this->db->query("select cara_bayar, harga_jual, harga_jual_ppn, tanda_jadi, txt_tanda_jadi, cicilan_uang_muka, txt_cicilan, DATE_FORMAT(uang_muka_tgl_1,'%d/%m/%Y') as uang_muka_tgl_1, uang_muka_1, DATE_FORMAT(uang_muka_tgl_2,'%d/%m/%Y') as uang_muka_tgl_2, uang_muka_2, DATE_FORMAT(uang_muka_tgl_3,'%d/%m/%Y') as uang_muka_tgl_3, uang_muka_3, DATE_FORMAT(uang_muka_tgl_4,'%d/%m/%Y') as uang_muka_tgl_4, uang_muka_4, loan, jml_cair, nm_lembaga, promosi, txt_promosi, pos as poss, txt_pos, txt_pos, pos2, txt_exhibition, txt_event from trans_surat_pesanan where id = '".$id."'")->row();
		$data['cara'] = $r->cara_bayar;
		$data['harga_jual'] = $r->harga_jual;
		$data['harga_jual2'] = $r->harga_jual_ppn;
		$data['booking'] = $r->tanda_jadi;
		$data['txt_lain_booking'] = $r->txt_tanda_jadi;
		$data['uang_muka'] = $r->cicilan_uang_muka;
		$data['txt_uang_muka'] = $r->txt_cicilan;
		$data['tgl1'] = $r->uang_muka_tgl_1;
		$data['uang1'] = $r->uang_muka_1;
		$data['tgl2'] = $r->uang_muka_tgl_2;
		$data['uang2'] = $r->uang_muka_2;
		$data['tgl3'] = $r->uang_muka_tgl_3;
		$data['uang3'] = $r->uang_muka_3;
		$data['tgl4'] = $r->uang_muka_tgl_4;
		$data['uang4'] = $r->uang_muka_4;
		$data['check_loan'] = $r->loan;
		$data['lunas_cair'] = $r->jml_cair;
		$data['nm_lembaga'] = $r->nm_lembaga;
		$prom = explode('|',$r->promosi);
		$data['koran'] = $prom[0];
		$data['billboard'] = $prom[1];
		$data['undangan'] = $prom[2];
		$data['majalah'] = $prom[3];
		$data['tv_radio'] = $prom[4];
		$data['pager_grafis'] = $prom[5];
		$data['lisan'] = $prom[6];
		$data['lain'] = $prom[7];
		$data['lain_promosi'] = $r->txt_promosi;
		
		$poss = explode('|',$r->poss);
		$data['kantor_pusat'] = $poss[0];
		$data['exhibition'] = $poss[1];
		$data['sales'] = $poss[2];
		$data['events'] = $poss[3];
		$data['daily'] = $poss[4];
		$data['lain_pos'] = $poss[5];
		$data['txt_lain_pos'] = $r->txt_pos;
	
		$pos2 = explode('|',$r->pos2);
		$data['ftb'] = $pos2[0];
		$data['eb'] = $pos2[1];
		$data['eu'] = $pos2[2];
		$data['invest'] = $pos2[3];
		$data['txt_exhibition'] = $r->txt_exhibition;
		$data['txt_event'] = $r->txt_event;
		
		$this->load->view('surat_pesanan/sp_input_2',$data);
	}
	
	function frm_edit_3($id="") {
		$r = $this->db->query("select sts, sts_landed, tanda_terima, jns_tanda_terima, setor_bank, DATE_FORMAT(setor_tgl,'%d/%m/%Y') as setor_tgl, setor_noslip, no_credit, txt_tanda_terima, koorselling, selling, koorlisting, listing from trans_surat_pesanan where id = '".$id."'")->row();
		$data['sts'] = $r->sts;
		$data['sts_landed'] = $r->sts_landed;
		$data['tanda_terima'] = $r->tanda_terima;
		$data['chec_tt'] = $r->jns_tanda_terima;
		$data['setor_bank'] = $r->setor_bank;
		$data['setor_tgl'] = $r->setor_tgl;
		$data['setor_no'] = $r->setor_noslip;
		$data['txt_lain_tt'] = $r->txt_tanda_terima;
		
		$data['koor_selling'] = $r->koorselling;
		$data['nmkoor_selling'] = $this->m_member->nm_member($r->koorselling);
		$data['selling'] = $r->selling;
		$data['nm_selling'] = $this->m_member->nm_member($r->selling);
		$data['koor_listing'] = $r->koorlisting;
		$data['nmkoor_listing'] = $this->m_member->nm_member($r->koorlisting);
		$data['listing'] = $r->listing;
		$data['nm_listing'] = $this->m_member->nm_member($r->listing);
		$this->load->view('surat_pesanan/sp_input_3',$data);
	}
	
	function simpan(){
		$tgl1 = $this->msistem->conversiTgl($this->input->post("tgl1"));
		$tgl2 = $this->msistem->conversiTgl($this->input->post("tgl2"));
		$tgl3 = $this->msistem->conversiTgl($this->input->post("tgl3"));
		$tgl4 = $this->msistem->conversiTgl($this->input->post("tgl4"));
		$setor_tgl = $this->msistem->conversiTgl($this->input->post("setor_tgl"));
		
		$data = array(
			'tgl' => date('Y-m-d'),
			'kode_pelanggan' => $this->input->post('kode_pelanggan'),
			'kode_member' => $this->input->post('kode_member'),
			'alamat_surat' => $this->input->post('alamat_surat'),
			'kode_pos_surat' => $this->input->post('pos_surat'),
			'unit_pesanan' => $this->input->post('unit_pesan'),
			'kode_dev' => $this->input->post('develop'),
			'tipe_bedroom' => $this->input->post('type_badroom'),
			'marketing_floor_no' => $this->input->post('floor_no'),
			'no_unit' => $this->input->post('no_unit'),
			'sts' => $this->input->post('status_unit'),
			'luas_unit' => $this->input->post('luas'),
			'tower' => $this->input->post('tower'),
			'spesifikasi' => $this->input->post('spek'),
			'dev_landed' => $this->input->post('develop_landed'),
			'tipe_landed' => $this->input->post('type_landed'),
			'no_unit_landed' => $this->input->post('no_unit_landed'),
			'sts_landed' => $this->input->post('status_landed'),
			'ltlb' => $this->input->post('ltlb'),
			'spek_landed' => $this->input->post('spek2'),
			'harga_jual' => $this->input->post('harga_jual'),
			'harga_jual_ppn' => $this->input->post('harga_jual2'),
			'cara_bayar' => $this->input->post('cara'),
			'tanda_jadi' => $this->input->post('booking'),
			'txt_tanda_jadi' => $this->input->post('txt_lain_booking'),
			'cicilan_uang_muka' => $this->input->post('uangmuka'),
			'txt_cicilan' => $this->input->post('txt_uang_muka'),
			'uang_muka_tgl_1' => $tgl1,
			'uang_muka_1' => $this->input->post('uang1'),
			'uang_muka_tgl_2' => $tgl2,
			'uang_muka_2' => $this->input->post('uang2'),
			'uang_muka_tgl_3' => $tgl3,
			'uang_muka_3' => $this->input->post('uang3'),
			'uang_muka_tgl_4' => $tgl4,
			'uang_muka_4' => $this->input->post('uang4'),
			'loan' => $this->input->post('check_loan'),
			'jml_cair' => $this->input->post('lunas_cair'),
			'nm_lembaga' => $this->input->post('nm_lembaga'),
			'promosi' => $this->input->post('promosi'),
			'txt_promosi' => $this->input->post('txt_promosi'),
			'pos' => $this->input->post('pos'),
			'txt_pos' => $this->input->post('txt_pos'),
			'txt_exhibition' => $this->input->post('txt_exhibition'),
			'txt_event' => $this->input->post('txt_event'),
			'pos2' => $this->input->post('pos2'),
			'tanda_terima' => $this->input->post('tanda_terima'),
			'jns_tanda_terima' => $this->input->post('jns_tanda_terima'),
			'no_credit' => $this->input->post('no_credit'),
			'setor_bank' => $this->input->post('setor_bank'),
			'setor_tgl' => $setor_tgl,
			'setor_noslip' => $this->input->post('setor_noslip'),
			'txt_tanda_terima' => $this->input->post('txt_tanda_terima'),
			'koorselling' => $this->input->post('koor_selling'),
			'selling' => $this->input->post('selling'),
			'koorlisting' => $this->input->post('koor_listing'),
			'listing' => $this->input->post('listing')
		);
		
		$this->db->trans_begin();
		$kdtrans = $this->nos(date('mY'));
		if($this->input->post('id')=="") {
			$dataIns = array (
				'kdtrans' => $kdtrans,
				'created' => date("Y-m-d H:i:s"),
				'created_by' => strtoupper($this->session->userdata('sis_user'))
			);
			$data = array_merge($data,$dataIns);
			$this->db->insert('trans_surat_pesanan', $data);
			$this->msistem->log_book('Input data baru Surat Pesanan "'.$this->input->post('nos'),'mk3',$this->session->userdata('sis_user'));
		} else {
			$kdtrans = $this->input->post('sp');
			$dataUpdate = array('modified_by' => strtoupper($this->session->userdata('sis_user')));
			$data = array_merge($data,$dataUpdate);
			$this->db->update('trans_surat_pesanan', $data,array('id' => $this->input->post('id')));
			$this->msistem->log_book('Edit data Surat Pesanan "'.$this->input->post('sp'),'mk3',$this->session->userdata('sis_user'));
		}
		
		//hitung_komisi
		$komisi = $this->m_komisi->hitung_komisi($kdtrans);
		$upd = array( 'komisi' => $komisi );
		$this->db->update('trans_surat_pesanan', $upd,array('kdtrans' => $kdtrans));
		
		if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
			echo "0";
        } else {
            $this->db->trans_commit();
			echo $kdtrans;
        }
	}
	
	function nos($periode=""){
		$tgl = date('Y-m-d');
		$arrTgl = preg_split("[-]",$tgl);
		$bln = $arrTgl[1];
		$thn = substr($arrTgl[0],-2);
		$periode = $arrTgl[0]."-".$arrTgl[1];
		
		$sql = $this->db->query("select MAX(SUBSTRING_INDEX(kdtrans,'.',1)) as jml from trans_surat_pesanan where DATE_FORMAT(tgl,'%Y') = '".date('Y')."'");
		if($sql==NULL){
			$no_member = '0000001.SP'.$bln.$thn;
		} else {
			$rs = $sql->row();
			$jml = $rs->jml + 1;
			
			if(strlen($jml)==1) {
				$no_urut = '000000'.$jml;	
			} else if(strlen($jml)==2) {
				$no_urut = '00000'.$jml;
			} else if(strlen($jml)==3) {
				$no_urut = '0000'.$jml;
			} else if(strlen($jml)==4) {
				$no_urut = '000'.$jml;
			} else if(strlen($jml)==5) {
				$no_urut = '00'.$jml;	
			} else if(strlen($jml)==6) {
				$no_urut = '0'.$jml;	
			} else if(strlen($jml)==7) {
				$no_urut = $jml;	
			}
			$no_member = $no_urut.'.SP.'.$bln.$thn;
		}
		return $no_member;
	}
	
	function hapus() {
		$idrec = $this->input->post('idrec');
		$this->db->trans_begin();
		$this->db->delete("trans_surat_pesanan",array('id' => $idrec));
		$this->msistem->log_book('Delete data id "'.$idrec,'mk3',$this->session->userdata('sis_user'));
		if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
			echo "Hapus Data Gagal";
        } else {
            $this->db->trans_commit();
			echo "Hapus Data Berhasil";
        }
	}
}
?>