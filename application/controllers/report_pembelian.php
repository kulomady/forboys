<?php 
class report_pembelian extends SIS_Controller {

	public function __construct() {
        parent::__construct();   
        $this->load->model('msistem');
		$this->load->model('m_company');
		$this->load->model('m_rekan_bisnis');
    }
 
	public function report($kode) {
		$data['kode'] = $kode;
		$data['gudang'] = $this->m_company->pilihLokasi(0);
		$data['supplier'] = $this->m_rekan_bisnis->pilihSupplier(0);
		$this->load->view('report_pembelian/report_index',$data);
	}
	
	//Pesanan
	public function pesanan_pembelian_rekap($type="",$tgl1="",$tgl2="",$gudang="",$supplier=""){
		$data['type'] = $type;
		$data['tgl1'] = $tgl1;
		$data['tgl2'] = $tgl2;
		$data['company'] = $supplier;
		$data['outlet'] = $gudang;
		if($gudang != 0){
			$data['nm_outlet'] = $this->m_company->outlet($gudang);
		} else {
			$data['nm_outlet'] = 'ALL';
		}
		$data['tglPertama'] = $this->msistem->conversiTglDB($tgl1);
		$data['tglKedua'] = $this->msistem->conversiTglDB($tgl2);
		$this->load->view('report_pembelian/pesanan_pembelian_rekap',$data);	
	}
	
	public function pesanan_pembelian_detail($type="",$tgl1="",$tgl2="",$gudang="",$supplier=""){
		$data['type'] = $type;
		$data['tgl1'] = $tgl1;
		$data['tgl2'] = $tgl2;
		$data['company'] = $supplier;
		$data['outlet'] = $gudang;
		if($gudang != 0){
			$data['nm_outlet'] = $this->m_company->outlet($gudang);
		} else {
			$data['nm_outlet'] = 'ALL';
		}
		$data['tglPertama'] = $this->msistem->conversiTglDB($tgl1);
		$data['tglKedua'] = $this->msistem->conversiTglDB($tgl2);
		$this->load->view('report_pembelian/pesanan_pembelian_detail',$data);
	}
	
	//Pembelian
	public function pembelian_rekap($type="",$tgl1="",$tgl2="",$gudang="",$supplier=""){
		$data['type'] = $type;
		$data['tgl1'] = $tgl1;
		$data['tgl2'] = $tgl2;
		$data['company'] = $supplier;
		$data['outlet'] = $gudang;
		if($gudang != 0){
			$data['nm_outlet'] = $this->m_company->outlet($gudang);
		} else {
			$data['nm_outlet'] = 'ALL';
		}
		$data['tglPertama'] = $this->msistem->conversiTglDB($tgl1);
		$data['tglKedua'] = $this->msistem->conversiTglDB($tgl2);
		$this->load->view('report_pembelian/pembelian_rekap',$data);	
	}
	
	public function pembelian_detail($type="",$tgl1="",$tgl2="",$gudang="",$supplier=""){
		$data['type'] = $type;
		$data['tgl1'] = $tgl1;
		$data['tgl2'] = $tgl2;
		$data['company'] = $supplier;
		$data['outlet'] = $gudang;
		if($gudang != 0){
			$data['nm_outlet'] = $this->m_company->outlet($gudang);
		} else {
			$data['nm_outlet'] = 'ALL';
		}
		$data['tglPertama'] = $this->msistem->conversiTglDB($tgl1);
		$data['tglKedua'] = $this->msistem->conversiTglDB($tgl2);
		$this->load->view('report_pembelian/pembelian_detail',$data);
	}
	
	//Retur
	public function retur_pembelian_rekap($type="",$tgl1="",$tgl2="",$gudang="",$supplier=""){
		$data['type'] = $type;
		$data['tgl1'] = $tgl1;
		$data['tgl2'] = $tgl2;
		$data['company'] = $supplier;
		$data['outlet'] = $gudang;
		if($gudang != 0){
			$data['nm_outlet'] = $this->m_company->outlet($gudang);
		} else {
			$data['nm_outlet'] = 'ALL';
		}
		$data['tglPertama'] = $this->msistem->conversiTglDB($tgl1);
		$data['tglKedua'] = $this->msistem->conversiTglDB($tgl2);
		$this->load->view('report_pembelian/retur_pembelian_rekap',$data);	
	}
	
	public function retur_pembelian_detail($type="",$tgl1="",$tgl2="",$gudang="",$supplier=""){
		$data['type'] = $type;
		$data['tgl1'] = $tgl1;
		$data['tgl2'] = $tgl2;
		$data['company'] = $supplier;
		$data['outlet'] = $gudang;
		if($gudang != 0){
			$data['nm_outlet'] = $this->m_company->outlet($gudang);
		} else {
			$data['nm_outlet'] = 'ALL';
		}
		$data['tglPertama'] = $this->msistem->conversiTglDB($tgl1);
		$data['tglKedua'] = $this->msistem->conversiTglDB($tgl2);
		$this->load->view('report_pembelian/retur_pembelian_detail',$data);
	}
}
?>