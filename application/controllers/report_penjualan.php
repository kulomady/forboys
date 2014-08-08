<?php 
class report_penjualan extends SIS_Controller {

	public function __construct() {
        parent::__construct();   
        $this->load->model('m_company');
		$this->load->model('m_rekan_bisnis');
    }
	
	function frm_pesanan() {
		$data['gudang'] = $this->m_company->pilihLokasi('0');
		$data['pelanggan'] = $this->m_rekan_bisnis->pilihPelanggan('0');
		$data['sales'] = $this->m_rekan_bisnis->pilihKaryawan('0');
		$this->load->view('report_penjualan/pesanan_index',$data);
	}
	
	function pesanan($tgl1="",$tgl2="",$pelanggan="",$sales="",$gudang="",$tmpUkuran="",$type="",$jnsLap="") {
		$data['tgl1'] = $tgl1;
		$data['tgl2'] = $tgl2;
		$data['pelanggan'] = $pelanggan;
		$data['nmPelanggan'] = $this->m_rekan_bisnis->nmRekan($pelanggan);
		$data['sales'] = $sales;
		$data['nmSales'] = $this->m_rekan_bisnis->nmRekan($sales);
		$data['gudang'] = $gudang;
		$data['nmGudang'] = $this->m_company->nmCompany($gudang);
		$data['tmpUkuran'] = $tmpUkuran;
		$data['type'] = $type;
		if($jnsLap=='REKAP') {
			$this->load->view('report_penjualan/pesanan_rekap',$data);
		} else {
			$this->load->view('report_penjualan/pesanan_detail',$data);
		}
	}
	
	function frm_penjualan() {
		$data['gudang'] = $this->m_company->pilihLokasi('0');
		$data['pelanggan'] = $this->m_rekan_bisnis->pilihPelanggan('0');
		$data['sales'] = $this->m_rekan_bisnis->pilihKaryawan('0');
		$this->load->view('report_penjualan/penjualan_index',$data);
	}
	
	function penjualan($tgl1="",$tgl2="",$pelanggan="",$sales="",$gudang="",$tmpUkuran="",$type="",$jnsLap="") {
		$data['tgl1'] = $tgl1;
		$data['tgl2'] = $tgl2;
		$data['pelanggan'] = $pelanggan;
		$data['nmPelanggan'] = $this->m_rekan_bisnis->nmRekan($pelanggan);
		$data['sales'] = $sales;
		$data['nmSales'] = $this->m_rekan_bisnis->nmRekan($sales);
		$data['gudang'] = $gudang;
		$data['nmGudang'] = $this->m_company->nmCompany($gudang);
		$data['tmpUkuran'] = $tmpUkuran;
		$data['type'] = $type;
		if($jnsLap=='REKAP') {
			$this->load->view('report_penjualan/penjualan_rekap',$data);
		} else {
			$this->load->view('report_penjualan/penjualan_detail',$data);
		}
	}
	
	function frm_retur() {
		$data['gudang'] = $this->m_company->pilihLokasi('0');
		$data['pelanggan'] = $this->m_rekan_bisnis->pilihPelanggan('0');
		$data['sales'] = $this->m_rekan_bisnis->pilihKaryawan('0');
		$this->load->view('report_penjualan/retur_index',$data);
	}
	
	function retur($tgl1="",$tgl2="",$pelanggan="",$sales="",$gudang="",$tmpUkuran="",$type="",$jnsLap="") {
		$data['tgl1'] = $tgl1;
		$data['tgl2'] = $tgl2;
		$data['pelanggan'] = $pelanggan;
		$data['nmPelanggan'] = $this->m_rekan_bisnis->nmRekan($pelanggan);
		$data['sales'] = $sales;
		$data['nmSales'] = $this->m_rekan_bisnis->nmRekan($sales);
		$data['gudang'] = $gudang;
		$data['nmGudang'] = $this->m_company->nmCompany($gudang);
		$data['tmpUkuran'] = $tmpUkuran;
		$data['type'] = $type;
		if($jnsLap=='REKAP') {
			$this->load->view('report_penjualan/retur_rekap',$data);
		} else {
			$this->load->view('report_penjualan/retur_detail',$data);
		}
	}
	
	function frm_penj_item() {
		$data['gudang'] = $this->m_company->pilihLokasi('0');
		$this->load->view('report_penjualan/penj_item_index',$data);
	}
	
	function penj_item($tglAwal="",$tglAkhir="",$gudang="",$tipe="",$jns="",$kat="",$merk="",$warna="",$tmpUkuran="",$grup="") {
		$data['tgl1'] = $tglAwal;
		$data['tgl2'] = $tglAkhir;
		$data['gudangAsal'] = $gudang;
		$data['nmGudang'] = $this->m_company->nmCompany($gudang);
		$data['tipe'] = $tipe;
		$data['jns'] = $jns;
		$data['kat'] = $kat;
		$data['merk'] = $merk;
		$data['warna'] = $warna;
		$data['tmpUkuran'] = $tmpUkuran;
		$data['grup'] = $grup;
		$this->load->view('report_penjualan/penj_item',$data);
	}
	
	function frm_retur_item() {
		$data['gudang'] = $this->m_company->pilihLokasi('0');
		$this->load->view('report_penjualan/retur_item_index',$data);
	}
	
	function retur_item($tglAwal="",$tglAkhir="",$gudang="",$tipe="",$jns="",$kat="",$merk="",$warna="",$tmpUkuran="",$grup="") {
		$data['tgl1'] = $tglAwal;
		$data['tgl2'] = $tglAkhir;
		$data['gudangAsal'] = $gudang;
		$data['nmGudang'] = $this->m_company->nmCompany($gudang);
		$data['tipe'] = $tipe;
		$data['jns'] = $jns;
		$data['kat'] = $kat;
		$data['merk'] = $merk;
		$data['warna'] = $warna;
		$data['tmpUkuran'] = $tmpUkuran;
		$data['grup'] = $grup;
		$this->load->view('report_penjualan/retur_item',$data);
	}
	
}
?>