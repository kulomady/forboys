<?php 
class tutup_persediaan extends SIS_Controller {

	public function __construct() {
        parent::__construct();  
		$this->load->model('m_company'); 
		$this->load->model('msistem');
    }
 
	public function index() {
		$r = $this->db->query("select sa_bln,sa_thn from sys_periode_akuntansi where active = '1'")->row();
		$data['bln'] = $r->sa_bln; //$this->msistem->bulan();
		$data['thn'] = $r->sa_thn; //$this->msistem->tahun();
		$this->load->view('tutup_persediaan/tp_index',$data);
	}
	
	function tutupStock() {
		$bln = $this->input->post('bln');
		$thn = $this->input->post('thn');
		
		$periode = $thn."-".$bln;
		
		$periodeAwal = date("Y-m-d",mktime(0,0,0,$bln+1,1,$thn));
		$arrPawal = explode("-",$periodeAwal);
		$blnAwal = $arrPawal[1];
		$thnAwal = $arrPawal[0];
		
		$this->db->trans_begin();
		
		// Hitung HPP Periodik
		$h = $this->db->query("select idbarang,sum(qty_sa) as qty_sa,sum(pcs_sa) as pcs_sa,sum(jml_sa) as jml_sa,sum(qty_beli_in) as qty_beli_in, sum(pcs_beli_in) as pcs_beli_in,sum(jml_beli_in) as jml_beli_in,sum(pcs_retur_out) as pcs_retur_out,sum(qty_retur_out) as qty_retur_out,sum(jml_retur_out) as jml_retur_out from rpt_stock where DATE_FORMAT(tgl,'%Y-%m') = '".$periode."' group by idbarang");
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
			$arrHPP[$rc->idbarang] = $hpp; 
		}
		
		$sql = $this->db->query("select a.outlet_id,b.la_inventory from rpt_stock a inner join master_company b on a.outlet_id = b.outlet_id where DATE_FORMAT(a.tgl,'%Y-%m') = '".$periode."' group by a.outlet_id");
		foreach($sql->result() as $rs) {
			$outlet_id = $rs->outlet_id;
			$akun = $rs->la_inventory;
			$kdtrans = $thnAwal.$blnAwal."_".$outlet_id;
			// hapus stock
			$this->db->query("delete from rpt_stock where notrans = '".$kdtrans."'");
			$this->db->query("delete from tr_persediaan_awal where periode = '".$periodeAwal."' and outlet_id = '".$outlet_id."'");
			$data = array (
				'periode' => $periodeAwal,
				'outlet_id' => $outlet_id,
				'keterangan' => "Persediaan Awal Generate",
				'idperkiraan' => $akun,
				'kdtrans' => $kdtrans,
				'created' => date("Y-m-d H:i:s"), 
				'created_by' => $this->session->userdata('sis_user')
			);
			$this->db->insert('tr_persediaan_awal', $data);
			$q = $this->db->query("select
				idbarang,
				ifnull(sum(qty_sa),0) as qty_sa,
				ifnull(sum(pcs_sa),0) as pcs_sa,
				ifnull(sum(qty_beli_in),0) as qty_beli_in,
				ifnull(sum(pcs_beli_in),0) as pcs_beli_in,
				ifnull(sum(qty_transfer_in),0) as qty_transfer_in,
				ifnull(sum(pcs_transfer_in),0) as pcs_transfer_in,
				ifnull(sum(qty_retur_in),0) as qty_retur_in,
				ifnull(sum(qty_transfer_out),0) as qty_transfer_out,
				ifnull(sum(pcs_transfer_out),0) as pcs_transfer_out,
				ifnull(sum(qty_jual_out),0) as qty_jual_out,
				ifnull(sum(qty_pakai_out),0) as qty_pakai_out,
				ifnull(sum(pcs_pakai_out),0) as pcs_pakai_out,
				ifnull(sum(qty_retur_out),0) as qty_retur_out,
				ifnull(sum(pcs_retur_out),0) as pcs_retur_out,
				ifnull(sum(qty_adj_opname),0) as qty_adj_opname,
				ifnull(sum(pcs_adj_opname),0) as pcs_adj_opname,
				ifnull(sum(outstanding),0) as outstanding
				from rpt_stock where DATE_FORMAT(tgl,'%Y-%m') = '".$periode."' and outlet_id = '".$outlet_id."' group by idbarang");
			
			foreach($q->result() as $r) {
				// Persediaan Awal
				$qty_sa = $r->qty_sa;
				if($r->pcs_sa == "0") {
					$pcs_sa = 1;
				} else {
					$pcs_sa = $r->pcs_sa;
				}
				$qty_sa = $qty_sa * $pcs_sa;
				// Pembelian
				$qty_beli_in = $r->qty_beli_in;
				if($r->pcs_beli_in == "0") {
					$pcs_beli_in = 1;
				} else {
					$pcs_beli_in = $r->pcs_beli_in;
				}
				$qty_beli_in = $qty_beli_in * $pcs_beli_in;
				// Transfer In
				$qty_transfer_in = $r->qty_transfer_in;
				if($r->pcs_transfer_in == "0") {
					$pcs_transfer_in = 1;
				} else {
					$pcs_transfer_in = $r->pcs_transfer_in;
				}
				$qty_transfer_in = $qty_transfer_in * $pcs_transfer_in;
				// Retur In
				$qty_retur_in = $r->qty_retur_in;
				
				// Transfer out
				$qty_transfer_out = $r->qty_transfer_out;
				if($r->pcs_transfer_out == "0") {
					$pcs_transfer_out = 1;
				} else {
					$pcs_transfer_out = $r->pcs_transfer_out;
				}
				$qty_transfer_out = $qty_transfer_out * $pcs_transfer_out;
				
				// Jual out
				$qty_jual_out = $r->qty_jual_out;
				$jml_jual_out = $hpp * $qty_jual_out;
				
				// Pakai out
				$qty_pakai_out = $r->qty_pakai_out;
				if($r->pcs_pakai_out == "0") {
					$pcs_pakai_out = 1;
				} else {
					$pcs_pakai_out = $r->pcs_pakai_out;
				}
				$qty_pakai_out = $qty_pakai_out * $pcs_pakai_out;
				
				// retur Pembelian
				$qty_retur_out = $r->qty_retur_out;
				if($r->pcs_retur_out == "0") {
					$pcs_retur_out = 1;
				} else {
					$pcs_retur_out = $r->pcs_retur_out;
				}
				$qty_retur_out = $qty_retur_out * $pcs_retur_out;
				
				
				// Adjustment Opname
				$qty_adj_opname = $r->qty_adj_opname;
				if($r->pcs_adj_opname == "0") {
					$pcs_adj_opname = 1;
				} else {
					$pcs_adj_opname = $r->pcs_adj_opname;
				}
				$qty_adj_opname = $qty_adj_opname * $pcs_adj_opname;
				
				$stock_masuk = $qty_beli_in + $qty_transfer_in + $qty_retur_in;
				$stock_masuk_pcs = $r->pcs_beli_in + $r->pcs_transfer_in;
				
				$stock_keluar = $qty_transfer_out + $qty_jual_out + $qty_pakai_out + $qty_retur_out;
				$stock_keluar_pcs = $r->pcs_transfer_out + $r->pcs_retur_out + $r->pcs_pakai_out;
				
				$qty_stock_akhir = ($qty_sa + $stock_masuk) - $stock_keluar + $qty_adj_opname;
				$pcs_stock_ahir = $r->pcs_sa + $stock_masuk_pcs - $stock_keluar_pcs + $r->pcs_adj_opname;
				
				$jml_stock_akhir = $qty_stock_akhir * $arrHPP[$r->idbarang];
				
				// harga jual
				$hj = $this->db->query("select a.harga from v_harga_barang a inner join v_master_barang_detail b on a.idbarang = b.idgroup_barang where b.idbarang = '".$r->idbarang."' and a.outlet_id = '".$outlet_id."' and tgl_berlaku <= now()");
				if(count($hj->result())==0) {
					$harga = 0;	
				} else {
					$rhj = $hj->row();
					$harga = $rhj->harga;
				}
				
				/* if($qty_stock_akhir != 0) {
					$hrgBeli = $jml_stock_akhir / $qty_stock_akhir;
					$hrgBeli = round($hrgBeli,2);
				} else {
					$hrgBeli = 0;	
				} */
				$dataDetail = array(
					'kdtrans' => $kdtrans,
					'idbarang' => $r->idbarang,
					'harga' => $arrHPP[$r->idbarang],
					'jml' => $qty_stock_akhir,
					'pcs' => $pcs_stock_ahir,
					'total' => $jml_stock_akhir,
					'hrgjual' => $harga
				);
				$this->db->insert('tr_persediaan_awal_detail', $dataDetail);
				// report stock
				$jmlOst = $r->outstanding * $harga;
				$dataRpt = array(
					'notrans' => $kdtrans,
					'idbarang' => $r->idbarang,
					'outlet_id' => $outlet_id,
					'tgl' => $periodeAwal,
					'qty_sa' => $qty_stock_akhir,
					'pcs_sa' => $pcs_stock_ahir,
					'jml_sa' => $jml_stock_akhir,
					'hrgjual_sa' => $harga,
					'outstanding' => $r->outstanding,
					'jml_outstanding' => $jmlOst
				);
				$this->db->insert('rpt_stock', $dataRpt);
				
			}
			
		}
		if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
			echo "0";
        } else {
            $this->db->trans_commit();
			echo $kdtrans;
        }
		
	}
	
	
}
?>