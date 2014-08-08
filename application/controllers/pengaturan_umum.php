<?php 
class pengaturan_umum extends SIS_Controller {

	public function __construct() {
        parent::__construct();  
	}
	
	public function index() {
		$r = $this->db->query("select terakhir from sys_terakhir_ambil")->row();
		$data['tglKirim'] = $r->terakhir;
		$this->load->view('pengaturan_umum/pu_index',$data);
	}
	
	function tanda_tangan() {
		//$grid = new GridConnector($this->db->conn_id);
		//$grid->render_sql("select * from sys_label","id","label,isi");
		
		$grid = new GridConnector($this->db->conn_id);
		/* $grid->enable_log("temp.log",true);
		$grid->dynamic_loading(100);
		$grid->render_table("sys_label","id","label,isi"); */
		
		//$grid->enable_log("temp.log",true);
		$grid->dynamic_loading(100);
		$grid->render_table("sys_label","id","id,label,isi");
	}
}
?>