<?php 
class report_stock extends SIS_Controller {

	public function __construct() {
        parent::__construct();   
        $this->load->model('m_company');
		$this->load->model('m_rekan_bisnis');
    }
	
	function frm_stock_awal() {
		$data['gudang'] = $this->m_company->pilihLokasi('0');
		$data['bln'] = $this->msistem->bulan();
		$data['thn'] = $this->msistem->tahun();
		$this->load->view('report_stock/stock_awal_index',$data);
	}
	
	function stock_awal($bln="",$thn="",$gudang="",$tmpUkuran="") {
		$data['bln'] = $bln;
		$data['thn'] = $thn;
		$data['gudang'] = $gudang;
		$data['nmGudang'] = $this->m_company->nmCompany($gudang);
		$data['tmpUkuran'] = $tmpUkuran;
		$this->load->view('report_stock/stock_awal',$data);
	}
	
	function frm_transfer_brg() {
		$data['gudang'] = $this->m_company->pilihLokasi('0');
		$data['tujuan'] = $this->m_company->pilihLokasiAll('0');
		$this->load->view('report_stock/transfer_barang_index',$data);
	}
	
	function transfer_brg($tglAwal="",$tglAkhir="",$gudang="",$tujuan="",$tipe="",$jns="",$kat="",$merk="",$warna="",$tmpUkuran="") {
		$data['tglAwal'] = $tglAwal;
		$data['tglAkhir'] = $tglAkhir;
		$data['gudangAsal'] = $gudang;
		$data['nmGudang'] = $this->m_company->nmCompany($gudang);
		$data['gudangTujuan'] = $tujuan;
		$data['nmTujuan'] = $this->m_company->nmCompany($tujuan);
		$data['tipe'] = $tipe;
		$data['jns'] = $jns;
		$data['kat'] = $kat;
		$data['merk'] = $merk;
		$data['warna'] = $warna;
		$data['tmpUkuran'] = $tmpUkuran;
		$this->load->view('report_stock/transfer_barang',$data);
	}
	
	function frm_opname() {
		$data['gudang'] = $this->m_company->pilihLokasi('0');
		$this->load->view('report_stock/opname_index',$data);
	}
	
	
	
	function opname($tglOpname="",$gudang="",$tipe="",$jns="",$kat="",$merk="",$warna="",$tmpUkuran="",$type="") {
		$data['tglOpname'] = $tglOpname;
		$data['gudangAsal'] = $gudang;
		$data['nmGudang'] = $this->m_company->nmCompany($gudang);
		$data['tipe'] = $tipe;
		$data['jns'] = $jns;
		$data['kat'] = $kat;
		$data['merk'] = $merk;
		$data['warna'] = $warna;
		$data['tmpUkuran'] = $tmpUkuran;
		$data['type'] = $type;
		$this->load->view('report_stock/opname',$data);
	}
	
	function frm_mutasi_stock_gudang() {
		$data['gudang'] = $this->m_company->pilihLokasiGudang('0');
		$this->load->view('report_stock/mutasi_stock_gudang_index',$data);
	}
	
	function mutasi_stock($tglStock="",$gudang="",$tipe="",$jns="",$kat="",$merk="",$warna="",$tmpUkuran="",$type="",$jnsHrg="",$hpp="") {
		$data['tglStock'] = $tglStock;
		$data['gudangAsal'] = $gudang;
		$data['nmGudang'] = $this->m_company->nmCompany($gudang);
		$data['tipe'] = $tipe;
		$data['jns'] = $jns;
		$data['kat'] = $kat;
		$data['merk'] = $merk;
		$data['warna'] = $warna;
		$data['tmpUkuran'] = $tmpUkuran;
		$data['type'] = $type;
		$data['jnsHrg'] = $jnsHrg;
		if($hpp==1):
			$this->hitungHPP($tglStock);
		endif;
		$this->load->view('report_stock/mutasi_stock_gudang',$data);
	}
	
	function frm_mutasi_stock_toko() {
		$data['gudang'] = $this->m_company->pilihLokasiToko('0');
		$this->load->view('report_stock/mutasi_stock_toko_index',$data);
	}
	
	function mutasi_stock_toko($tglStock="",$gudang="",$tipe="",$jns="",$kat="",$merk="",$warna="",$tmpUkuran="",$type="",$jnsHrg="",$hpp="") {
		$data['tglStock'] = $tglStock;
		$data['gudangAsal'] = $gudang;
		$data['nmGudang'] = $this->m_company->nmCompany($gudang);
		$data['tipe'] = $tipe;
		$data['jns'] = $jns;
		$data['kat'] = $kat;
		$data['merk'] = $merk;
		$data['warna'] = $warna;
		$data['tmpUkuran'] = $tmpUkuran;
		$data['type'] = $type;
		$data['jnsHrg'] = $jnsHrg;
		if($hpp==1):
			$this->hitungHPP($tglStock);
		endif;
		$this->load->view('report_stock/mutasi_stock_toko',$data);
	}
	
	function frm_mutasi_stock_konsolidasi() {
		//$data['gudang'] = $this->m_company->pilihLokasiToko('0');
		$this->load->view('report_stock/mutasi_stock_konsolidasi_index');
	}
	
	function mutasi_stock_konsolidasi($tglStock="",$tipe="",$jns="",$kat="",$merk="",$warna="",$tmpUkuran="",$type="",$jnsHrg="",$hpp="") {
		$data['tglStock'] = $tglStock;
		//$data['gudangAsal'] = $gudang;
		//$data['nmGudang'] = $this->m_company->nmCompany($gudang);
		$data['tipe'] = $tipe;
		$data['jns'] = $jns;
		$data['kat'] = $kat;
		$data['merk'] = $merk;
		$data['warna'] = $warna;
		$data['tmpUkuran'] = $tmpUkuran;
		$data['type'] = $type;
		$data['jnsHrg'] = $jnsHrg;
		if($hpp==1):
			$this->hitungHPP($tglStock);
		endif;
		$this->load->view('report_stock/mutasi_stock_konsolidasi',$data);
	}
	
	function frm_kartu_stock() {
		$data['gudang'] = $this->m_company->pilihLokasi('0');
		$this->load->view('report_stock/kartu_stock_index',$data);
	}
	
	function pilihSize() {
		 $idbarang = $this->input->post('idbarang');
		 $opt = '<option value=""></option>';
		 $sql = $this->db->query("select idsize from master_barang_detail where idbarang_induk = '".$idbarang."'");
         foreach($sql->result() as $rs){
				$opt .= "<option value='".$rs->idsize."'>".$rs->idsize."</option>";
        }
		echo $opt; 
	}
	
	function kartu_stock($tglAwal="",$tglAkhir="",$gudang="",$tmpUkuran="",$type="",$idbarang="",$nmbarang="",$size="") {
		$data['tglAwal'] = $tglAwal;
		$data['tglAkhir'] = $tglAkhir;
		$data['gudang'] = $gudang;
		$data['nmGudang'] = $this->m_company->nmCompany($gudang);
		$data['tmpUkuran'] = $tmpUkuran;
		$data['idbarang'] = $idbarang;
		$data['nmbarang'] = $nmbarang;
		$data['size'] = $size;
		$data['type'] = $type;
		$this->load->view('report_stock/kartu_stock',$data);
	}
	
	function hitungHPP($tgl) {
		//$tgl = $this->input->post('tgl');
		$arr = explode("-",$tgl);
		$tglAwal = $arr[0]."-".$arr[1]."-01";
		$tglAkhir = $tgl;
		
		$h = $this->db->query("select b.idbarang_induk as idbarang,sum(qty_sa) as qty_sa,sum(pcs_sa) as pcs_sa,sum(jml_sa) as jml_sa,sum(qty_beli_in) as qty_beli_in, sum(pcs_beli_in) as pcs_beli_in,sum(jml_beli_in) as jml_beli_in,sum(pcs_retur_out) as pcs_retur_out,sum(qty_retur_out) as qty_retur_out,sum(jml_retur_out) as jml_retur_out from rpt_stock a inner join v_master_barang_detail b on a.idbarang = b.idbarang where tgl >= '".$tglAwal."' and tgl <= '".$tglAkhir."' group by b.idbarang_induk");
		foreach($h->result() as $rc) {
			if($rc->pcs_sa == "0") {
				$qty_sa = $rc->qty_sa;	
			} else {
				$qty_sa = $rc->qty_sa * $rc->pcs_sa;
			}
			if($rc->pcs_beli_in == "0") {
				$qty_beli_in = $rc->qty_beli_in;	
			} else {
				$qty_beli_in = $rc->qty_beli_in * $rc->pcs_beli_in;
			}
			if($rc->pcs_retur_out == "0") {
				$qty_retur_out = $rc->qty_retur_out;	
			} else {
				$qty_retur_out = $rc->qty_retur_out * $rc->pcs_retur_out;
			}
			$qtyHpp = $qty_sa + $qty_beli_in - $qty_retur_out;
			$jmlHpp = $rc->jml_sa + $rc->jml_beli_in - $rc->jml_retur_out;
			if($qtyHpp != 0) {
				$hpp = $jmlHpp / $qtyHpp;
				$hpp = round($hpp,2);
			} else {
				$hpp = 0;
			}
			//$arrHPP[$rc->idbarang] = $hpp; 
			$data = array(
				"tgl" => $tgl,
				"idbarang" => $rc->idbarang,
				"hpp" => $hpp
			);
			$this->db->query("delete from sys_hpp where tgl = '".$tgl."' and idbarang = '".$rc->idbarang."'");
			$this->db->insert("sys_hpp",$data);
		}	
		//echo $this->input->post("type");
	}
}
?>