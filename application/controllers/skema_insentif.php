<?php 
class skema_insentif extends SIS_Controller {

	public function __construct() {
        parent::__construct();
		$this->load->model('m_company');   
    }
 
	public function index() {
		$query = $this->db->query("select upline, status_treshold, treshold, max_child, id from ref_binary")->row();
		$data['id'] = $query->id;
		$data['upline'] = $query->upline;
		$data['status'] = $query->status_treshold;
		$data['treshold'] = $query->treshold;
		$data['child'] = $query->max_child;
		$this->load->view('skema_insentif/si_index',$data);
	}
	
	public function loadSkema(){
		$img_del = '<img id="btnDel_cs3" src="../../assets/codebase_toolbar/icon/dis_delete.png" style="cursor:pointer;" onclick="delRow_cs3(0);" />';
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select id,persen,treshold,'$img_del' as img_del, level from ref_binary_child","id","id,level,treshold,persen,img_del,id");
	}
	
	function simpan(){
		$data = array(
			'upline' => $this->input->post('upline'),
			'max_child' => $this->input->post('child'),
			'status_treshold' => $this->input->post('status'),
			'treshold' => $this->input->post('treshold')
		);
		
		$this->db->update('ref_binary', $data,array('id' => $this->input->post('id')));
		$this->msistem->log_book('Update data Skema Insentif ','cs3',$this->session->userdata('sis_user'));
				
		// input dataBeli
		if($this->input->post('gridData') != ""):
			$gridData = $this->input->post('gridData');
			$table = 'ref_binary_child';
			$dataIns = array('level','treshold','persen');
			$this->msistem->insertSkema($gridData,$table,$dataIns);
		endif;
		
		if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
			echo "0";
        } else {
            $this->db->trans_commit();
            echo "1";
        }
	}
}
?>