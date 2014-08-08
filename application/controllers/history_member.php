<?php 
class history_member extends SIS_Controller {

	public function __construct() {
        parent::__construct();
		$this->load->model('m_company');   
    }
 
	public function index() {
		$this->load->view('history_member/hm_index');
	}
	
	public function preview($type="",$awal="",$akhir="") {
		$data['type'] = $type;
		$data['tgl_awal'] = $this->msistem->conversiTglDB($awal);
		$data['tgl_akhir'] = $this->msistem->conversiTglDB($akhir);
		//delete temp
		$this->db->query("delete from tb_temp");
		
		$sql_treshold = $this->db->query("select status_treshold, treshold from ref_binary")->row();
		$status = $sql_treshold->status_treshold;
				
		//Cek upto
		$sql_upto = $this->db->query("select count(level) as upto from ref_binary_child")->row();
		$upto = $sql_upto->upto;
		
		//ambil data transaksi
		$sql = $this->db->query("select kode_member, nilai, no_trans from sp_trans where tgl >= '".$awal."' and tgl <= '".$akhir."' and nilai >= '".$sql_treshold->treshold."'");
		foreach($sql->result() as $rs){
			$kode = $rs->kode_member;
			$nilai = $rs->nilai;
			$no_trans = $rs->no_trans;
			if($status=='1'){
				$sql2 = $this->metode($upto,$kode,$nilai,$no_trans);
			} else {
				$sql2 = $this->metode_persen($upto,$kode,$nilai,$no_trans);
			}
		}		
		
		$data['awal'] = $awal;
		$data['akhir'] = $akhir;
		$data['status'] = $status;
		$this->load->view('history_member/hm_excel',$data);
	}
	
	function metode($upto="",$kode="",$nilai="",$no_trans=""){
		if($upto>=1){
			
			$sql = $this->db->query("select treshold from ref_binary_child where level = '".$upto."'")->row();
			$hasil = $sql->treshold;
			
			//hitung
			if($kode!='0'){
				$data = array(
					'no_trans' => $no_trans,
					'kode_member' => $kode,
					'nilai' => $nilai,
					'persen' => $hasil,
					'hasil' => $hasil
				);
				$this->db->insert('tb_temp', $data);
			}
			
			if($upto!=1){
				$upto = $upto-1;
				$sql = $this->db->query("select referensi from tb_member where kode_member = '".$kode."'")->row();
				if($sql!=NULL){
					$parent = $sql->referensi;
					$this->metode($upto,$parent,$nilai,$no_trans);
				}
			}
		}
	}
	
	function metode_persen($upto="",$kode="",$nilai="",$no_trans=""){
		if($upto>=1){
			
			$sql = $this->db->query("select persen from ref_binary_child where level = '".$upto."'")->row();
			$persen = $sql->persen;
			
			//hitung
			$hasil = ($persen*$nilai)/100;
			if($kode!='0'){
				$data = array(
					'no_trans' => $no_trans,
					'kode_member' => $kode,
					'nilai' => $nilai,
					'persen' => $persen,
					'hasil' => $hasil
				);
				$this->db->insert('tb_temp', $data);
			}
			
			if($upto!=1){
				$upto = $upto-1;
				$sql = $this->db->query("select referensi from tb_member where kode_member = '".$kode."'")->row();
				if($sql!=NULL){
					$parent = $sql->referensi;
					$this->metode_persen($upto,$parent,$nilai,$no_trans);
				}
			}
		}
	}
}
?>