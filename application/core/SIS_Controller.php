<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class SIS_Controller extends CI_Controller {
	
    public function __construct() {
        parent::__construct();
        require_once (APPPATH . "/libraries/connector/combo_connector.php");
        require_once (APPPATH . "/libraries/connector/grid_connector.php");
		require_once (APPPATH . "/libraries/connector/treegrid_connector.php");
		require_once(APPPATH . "/3rdparty/tcpdf/tcpdf.php");
		
        
        $this->load->model(array('msistem'));
        
		if($this->session->userdata('sis_user')=="") {
			 redirect('home/logout');	
		}
    }
}

?>
