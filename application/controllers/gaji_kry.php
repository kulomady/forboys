<?php 
class gaji_kry extends SIS_Controller {

	public function __construct() {
        parent::__construct();   
		$this->load->model('m_company');
		$this->load->model('msistem');
    }
 
	public function index() {
		$data['hak_toolbar'] = $this->msistem->hak_toolbar('ku2');
		$data['gudang'] = $this->m_company->pilihLokasi('0');
		$data['bln'] = $this->msistem->bulan();
		$data['thn'] = $this->msistem->tahun();
		$this->load->view('gaji_kry/gk_index',$data);
	}
	
	function loadMainData($bln="",$thn="",$outlet_id="") {
		$qr = "";
		if($bln != '0'):
			$qr .= "and substring_index(periode,'-',-1) = '".$bln."'";
		endif;
		if($thn != '0'):
			$qr .= "and substring_index(periode,'-',1) = '".$thn."'";
		endif;
		if($outlet_id != '0'):
			$qr .= "and a.outlet_id = '".$outlet_id."'";
		endif;
		
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select a.periode,a.created,a.created_by,b.nm_outlet from tr_gaji_kry a inner join master_company b on a.outlet_id = b.outlet_id where a.id != '0' $qr group by a.periode","periode","id,periode,nm_outlet,created,created_by");
	}
	
	function loadDataGaji() {
		$outlet_id = $this->session->userdata('outlet_id');
		$user = $this->session->userdata('sis_user');
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select tb1.*,(tb1.jmlPinjaman - sum(ifnull(gk.byr_pinjaman,0))) as sisaPinjaman,'$outlet_id' as outlet_id,'$user' as user from (select a.idrekan,a.nmrekan,a.tgl_masuk,FLOOR(DATEDIFF(now(),a.tgl_masuk) /30) as masa_kerja,a.gaji_rate,a.gaji_jam, (gaji_rate /5) as max_kasbon,'' as jml_tdk_hadir,'' as pot_absen, '' as late_charge,'' as kasbon,'' as byrPinjaman,'' as gaji_thp,'' as ket,sum(b.pinjaman) as jmlPinjaman from master_rekan_bisnis a left join tr_pinjaman_kry b on a.idrekan = b.idrekan inner join sys_hak_outlet c on a.outlet_id = c.outlet_id where a.idtipe_rekan = '3' and c.view = '1' and c.group_id = '".$this->session->userdata('group_id')."' group by a.idrekan) as tb1 left join tr_gaji_kry gk on tb1.idrekan = gk.idrekan group by tb1.idrekan","id","id,idrekan,nmrekan,tgl_masuk,masa_kerja,gaji_rate,gaji_jam,max_kasbon,jml_tdk_hadir,pot_absen,late_charge,kasbon,sisaPinjaman,byrPinjaman,gaji_rate,ket,outlet_id,user");	
	}
	
	function loadDataDetail($periode="") {
		$outlet_id = $this->session->userdata('outlet_id');
		$user = $this->session->userdata('sis_user');
		
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select a.idrekan,a.nmrekan,a.tgl_masuk,FLOOR(DATEDIFF(now(),a.tgl_masuk) /30) as masa_kerja,a.gaji_rate,a.gaji_jam, (gaji_rate /5) as max_kasbon,jml_hari_absen as jml_tdk_hadir,pot_absen as pot_absen, late_charge as late_charge,kasbon as kasbon,sisa_pinjaman as sisaPinjaman,byr_pinjaman as byrPinjaman,gaji_thp as gaji_thp,keterangan as ket,'$outlet_id' as outlet_id,'$user' as user from master_rekan_bisnis a inner join tr_gaji_kry b on a.idrekan = b.idrekan where a.idtipe_rekan = '3' and b.periode = '".$periode."' and a.outlet_id = '".$outlet_id."'","id","id,idrekan,nmrekan,tgl_masuk,masa_kerja,gaji_rate,gaji_jam,max_kasbon,jml_tdk_hadir,pot_absen,late_charge,kasbon,sisaPinjaman,byrPinjaman,gaji_thp,ket,outlet_id,user");	
	}
	
	function frm_input() {
		$data['bln'] = $this->msistem->bulan();
		$data['thn'] = $this->msistem->tahun();
		// Periode
		$q = $this->db->query("select periode from tr_gaji_kry where periode = '".$this->session->userdata('periode')."'");
		$data['dataGaji'] = count($q->result());
		$this->load->view('gaji_kry/gk_input',$data); 
	}
	
	function frm_edit($periode="") {
		$arr = explode("-",$periode);
		$data['periode'] = $periode;
		$data['setthn'] = $arr[0];
		$data['setbln'] = $arr[1];
		$data['bln'] = $this->msistem->bulan();
		$data['thn'] = $this->msistem->tahun();
		$this->load->view('gaji_kry/gk_input',$data); 
	}
	
	function simpan() {
		
		// input barang detail
		$bln = $this->input->post('bln');
		$thn = $this->input->post('thn');
		$periode = $thn."-".$bln;
		$dataBrg = $this->input->post('data');
		$table = 'tr_gaji_kry';
		$dataIns = array('idrekan','gaji_bln','gaji_hari','max_kasbon','jml_hari_absen','pot_absen','late_charge','kasbon','sisa_pinjaman','byr_pinjaman','gaji_thp','keterangan','created_by');
		$fk = array('periode' => $periode,'outlet_id' => $this->session->userdata('outlet_id'));
		$this->msistem->insertDB($dataBrg,$table,$dataIns,$fk);
		
		if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
			echo "0";
        } else {
            $this->db->trans_commit();
			echo "1";
        }
	}
	
	function hapus() {
		$idrec = $this->input->post('idrec');
		$this->db->trans_begin();
		$this->db->delete("tr_gaji_kry",array('periode' => $idrec));
		$this->msistem->log_book('Delete data id "'.$idrec,'ku2',$this->session->userdata('sis_user'));
		if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
			echo "0";
        } else {
            $this->db->trans_commit();
			echo "1";
        }
	}
	
	function cbKaryawan() {
		$combo = new ComboConnector($this->db->conn_id); 
		$combo->render_sql("select idrekan,nmrekan from master_rekan_bisnis a inner join sys_hak_outlet b on a.outlet_id = b.outlet_id where idtipe_rekan = '3' and b.view = '1' and b.group_id = '".$this->session->userdata('group_id')."'","idrekan","nmrekan");
	}
}
?>