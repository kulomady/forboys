<?php 
class report_produksi extends SIS_Controller {

	public function __construct() {
        parent::__construct();
    }
	
	public function index()
	{
		//$this->load->view('welcome_message');
		echo "Report Produksi";
	}
}
?>