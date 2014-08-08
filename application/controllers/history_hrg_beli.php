<?php 
class history_hrg_beli extends SIS_Controller {

	public function __construct() {
        parent::__construct();
		$this->load->model('m_company');   
    }
 
	public function index() {
		$data['hak_toolbar'] = $this->msistem->hak_toolbar('pb5');
		$this->load->view('history_hrg_beli/hhb_index',$data);
	}
	
	public function preview($type="",$awal="",$akhir="") {
		$data['type'] = $type;
		$data['tgl_awal'] = $this->msistem->conversiTglDB($awal);
		$data['tgl_akhir'] = $this->msistem->conversiTglDB($akhir);
		$data['awal'] = $awal;
		$data['akhir'] = $akhir;
		$this->load->view('history_hrg_beli/hhb_excel',$data);
	}
}
?>