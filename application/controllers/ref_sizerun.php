<?php 
class ref_sizerun extends SIS_Controller {

	public function __construct() {
        parent::__construct();   
        $this->load->model('m_company');
		$this->load->model('m_ref_sizerun');
    }
 
	public function index() {
		$data['hak_toolbar'] = $this->msistem->hak_toolbar('md31');
		$this->load->view('sizerun/sr_index',$data);
	}
	
	function loadMainData($kode="",$nama="") {
		$qr = "";
		if($kode != '0'):
			$qr .= "and kode_sizerun like '%".$kode."%'";
		endif;
		if($nama != '0'):
			$qr .= "and nama_sizerun like '%".$nama."%'";
		endif;
		
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select id,kode_sizerun,nama_sizerun,created,modified,created_by,modified_by from ref_sizerun where nama_sizerun is not null $qr","id","id,kode_sizerun,nama_sizerun,created,modified,created_by,modified_by");
	}
	
	function frm_input() {
		$this->load->view('sizerun/sr_input'); 
	}
	
	function frm_edit($id="") {
		$r = $this->db->query("select * from ref_sizerun where id = '".$id."'")->row();
		$data = array(
			'id' => $id,
			'kdSize' => $r->kode_sizerun,
			'nmSize' => $r->nama_sizerun
		);
		$this->load->view('sizerun/sr_input',$data); 
	}
	
	function frm_search_size($kode_size){
		$data['kode_size'] = $kode_size;
		$this->load->view('sizerun/sr_search_size',$data); 
	}
	
	function loadDataSize($kode_size){
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select id,idsize,nmsize from ref_size_barang where idsize like '%".$kode_size."%' and active = '1'","id","idsize,nmsize");	
	}
	
	function cariBarang(){
		$sql = $this->db->query("select * from ref_size_barang where nmsize = '".$this->input->post('nmSize')."'");
		if($sql->num_rows()==1){
			$sql = $sql->row();
			$hasil = $sql->idsize.'|'.$sql->nmsize;			
		} else {
			$hasil = 0;
		}
		echo $hasil;
	}
	
	function cekKode(){
		$sql = $this->m_ref_sizerun->cekKode($this->input->post('kdSize'));
		echo $sql;
	}
	
	function simpan() {
		$data = array(
			'kode_sizerun' => strtoupper($this->input->post('kdSize')),
			'nama_sizerun' => strtoupper($this->input->post('nmSize'))
		);
		
		$this->db->trans_begin();
		if($this->input->post('id')=="") {
			$dataIns = array (
				'created' => date("Y-m-d H:i:s"),
				'created_by' => strtoupper($this->session->userdata('sis_user'))
			);
			$data = array_merge($data,$dataIns);
			$this->db->insert('ref_sizerun', $data);
			$this->msistem->log_book('Input data baru Size Run "'.$this->input->post('nmSize'),'MD30',$this->session->userdata('sis_user'));
		} else {
			$dataUpdate = array('modified_by' => strtoupper($this->session->userdata('sis_user')));
			$data = array_merge($data,$dataUpdate);
			$this->db->update('ref_sizerun', $data,array('id' => $this->input->post('id')));
			$this->msistem->log_book('Edit data Size Run "'.$this->input->post('nmSize'),'MD30',$this->session->userdata('sis_user'));
		}
		
		// input dataSize
		if($this->input->post('dataSize') != ""):
			$dataSize = $this->input->post('dataSize');
			$table = 'ref_sizerun_child';
			$dataIns = array('idsize','qty');
			$fk = array('kode_sizerun' => strtoupper($this->input->post('kdSize')));
			$this->msistem->insertDB($dataSize,$table,$dataIns,$fk);
		endif;
		
		if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
			echo "0";
        } else {
            $this->db->trans_commit();
			echo "1";
        }
	}
	
	function loadChild($kdSize) {
		$img = '<img id="btnTglBerlaku_md41" src="../../assets/codebase_calendar/imgs/calendar.gif" border="0" style="cursor:pointer;" onclick="openWinBrg_pb1(0);" />';
		$img_del = '<img id="btnTglBerlaku_md41" src="../../assets/codebase_toolbar/icon/dis_delete.png" border="0" style="cursor:pointer;" onclick="delRow_md30(0);" />';
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select a.id, a.idsize, a.qty, b.nmsize,'$img' as img,'$img_del' as img_del from ref_sizerun_child a left join ref_size_barang b on a.idsize=b.idsize where a.kode_sizerun = '".$kdSize."'","id","nmsize,img,idsize,qty,img_del");
	}
	
	function hapus() {
		$idrec = $this->input->post('idrec');
		$this->db->trans_begin();
		// log delete
		$r = $this->db->query("select kode_sizerun from ref_sizerun where id = '".$idrec."'")->row();
		$kode_sizerun = $r->kode_sizerun;
		$this->msistem->log_delete("ref_sizerun","where kode_sizerun = '$kode_sizerun'");
		// Hapus
		$this->db->delete("ref_sizerun",array('id' => $idrec));
		$this->msistem->log_book('Delete data id "'.$idrec,'MD30',$this->session->userdata('sis_user'));
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