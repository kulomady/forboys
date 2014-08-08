<?php
class m_komisi extends CI_Model{
	function hitung_komisi($surat=""){
		$sql = $this->db->query("select a.komisi as min_bayar, b.harga_jual from master_developer a left join trans_surat_pesanan b on a.kode_developer=b.kode_dev where b.kdtrans='".$surat."' union select a.komisi as min_bayar, b.harga_jual from master_developer a left join trans_surat_pesanan b on a.kode_developer=b.dev_landed where b.kdtrans='".$surat."'")->row();
		$harga_jual = $sql->harga_jual;
		$min = $sql->min_bayar;
		
		$sql2 = $this->db->query("select sum(komisi) as jumlah from trans_pembayaran_dev where surat_pesanan = '".$surat."'")->row();
		$jumlah = $sql2->jumlah;
		
		$hasil = ($harga_jual*$min)/100;
		if($jumlah <= $hasil){
			$return = $hasil;
		} else {
			$return = 0;
		}
		return $return;
	}
	
	public function komisi_baru($no_trans="",$harga="",$pelanggan="",$dev=""){
		$sql = $this->db->query("select p_marketing_new, p_kantor_new, p_kep_koordinator_new, p_koordinator_new from master_developer where kode_developer = '".$dev."'")->row();
		$marketing = ($sql->p_marketing_new/100)*$harga;
		$kep_marketing = ($sql->p_kep_koordinator_new/100)*$harga;
		$koordinasi = ($sql->p_koordinator_new/100)*$harga;
		$kantor = ($sql->p_kantor_new/100)*$harga;
		
		$data = array(
			'no_surat_pesanan' => $no_trans,
			'komisi' => $harga,
			'marketing' => $marketing,
			'kep_marketing' => $kep_marketing,
			'koordinasi' => $koordinasi,
			'kantor' => $kantor
		);
		$this->db->insert('tb_temp2', $data);
		
		//insentif pelanggan
		$data2 = array(
			'no_surat_pesanan' => $no_trans,
			'kode_member' => $pelanggan,
			'komisi' => $marketing,
			'ket' => 'marketing'
		);
		$this->db->insert('trans_komisi', $data2);
		
		//insentif koordinasi
		$sql = $this->db->query("select koorTim from master_member where id_deal = '".$pelanggan."'")->row();
		if($sql != NULL){
			if($sql->koorTim != NULL || $sql->koorTim != '0'){
				$data3 = array(
					'no_surat_pesanan' => $no_trans,
					'kode_member' => $sql->koorTim,
					'komisi' => $koordinasi,
					'ket' => 'koordinator'
				);
				$this->db->insert('trans_komisi', $data3);
			}
		}
	}
	
	public function komisi_bekas($no_trans="",$harga="",$pelanggan="",$dev=""){
		$sql = $this->db->query("select p_listing_second, p_listing2_second, p_kantor_second, p_selling_second, p_selling2_second, p_upline1, p_upline2, p_upline3, p_upline4, p_upline5 from master_developer where kode_developer = '".$dev."'")->row();
		$marketing = ($sql->p_listing_second/100)*$harga;
		$koordinasi = ($sql->p_selling_second/100)*$harga;
		$kantor = ($sql->p_kantor_second/100)*$harga;
		$selling = ($sql->p_selling_second/100)*$harga;
		$listing = ($sql->p_listing_second/100)*$harga; 
		$koorselling = ($sql->p_selling2_second/100)*$harga;
		$koorlisting = ($sql->p_listing2_second/100)*$harga;
		
		$parent1 = ($sql->p_upline1/100)*$harga;
		$parent2 = ($sql->p_upline2/100)*$harga;
		$parent3 = ($sql->p_upline3/100)*$harga;
		$parent4 = ($sql->p_upline4/100)*$harga;
		$parent5 = ($sql->p_upline5/100)*$harga;
		/*$min_15 = (1/100)*$harga;
		$min_5 = (1/100)*$harga;
		$min_35 = (1/100)*$harga;*/
		
		$data = array(
			'no_surat_pesanan' => $no_trans,
			'komisi' => $harga,
			'marketing' => $marketing,
			'koordinasi' => $koordinasi,
			'kantor' => $kantor,
			'parent_induk' => $parent1,
			'parent_induk2' => $parent2,
			'parent_induk3' => $parent3,
			'parent_induk4' => $parent4,
			'parent_induk5' => $parent5
			/*'min_15org' => $min_15,
			'min_5org_mil' => $min_5,
			'min_35org' => $min_35*/
		);
		$this->db->insert('tb_temp2', $data);
		
		//insentif pelanggan
		$data2 = array(
			'no_surat_pesanan' => $no_trans,
			'kode_member' => $pelanggan,
			'komisi' => $marketing,
			'ket' => 'marketing'
		);
		$this->db->insert('trans_komisi', $data2);
		
		//insentif koordinasi
		$sql1 = $this->db->query("select koorTim from master_member where id_deal = '".$pelanggan."'")->row();
		if($sql1 != NULL){
			if($sql1->koorTim != NULL || $sql1->koorTim != '0'){
				$data3 = array(
					'no_surat_pesanan' => $no_trans,
					'kode_member' => $sql1->koorTim,
					'komisi' => $koordinasi,
					'ket' => 'koordinator'
				);
				$this->db->insert('trans_komisi', $data3);
			}
		}
		
		//insentif selling
		$sql2 = $this->db->query("select selling from trans_surat_pesanan where kdtrans = '".$no_trans."'")->row();
		if($sql2 != NULL){
			if($sql2->selling != NULL || $sql2->selling != '0'){
				$data21 = array(
					'no_surat_pesanan' => $no_trans,
					'kode_member' => $sql2->selling,
					'komisi' => $selling,
					'ket' => 'selling'
				);
				$this->db->insert('trans_komisi', $data21);
			}
		}
		
		//insentif koordinasi
		$sql3 = $this->db->query("select koorselling from trans_surat_pesanan where kdtrans = '".$no_trans."'")->row();
		if($sql3 != NULL){
			if($sql3->koorselling != NULL || $sql3->koorselling != '0'){
				$data31 = array(
					'no_surat_pesanan' => $no_trans,
					'kode_member' => $sql3->koorselling,
					'komisi' => $koorselling,
					'ket' => 'koor selling'
				);
				$this->db->insert('trans_komisi', $data31);
			}
		}
		
		//insentif koordinasi
		$sql4 = $this->db->query("select listing from trans_surat_pesanan where kdtrans = '".$no_trans."'")->row();
		if($sql4 != NULL){
			if($sql4->listing != NULL || $sql4->listing != '0'){
				$data41 = array(
					'no_surat_pesanan' => $no_trans,
					'kode_member' => $sql4->listing,
					'komisi' => $listing,
					'ket' => 'listing'
				);
				$this->db->insert('trans_komisi', $data41);
			}
		}
		
		//insentif koordinasi
		$sql5 = $this->db->query("select koorlisting from trans_surat_pesanan where kdtrans = '".$no_trans."'")->row();
		if($sql5 != NULL){
			if($sql5->koorlisting != NULL || $sql5->koorlisting != '0'){
				$data51 = array(
					'no_surat_pesanan' => $no_trans,
					'kode_member' => $sql5->koorlisting,
					'komisi' => $koorlisting,
					'ket' => 'koor listing'
				);
				$this->db->insert('trans_komisi', $data51);
			}
		}
		
		//insentif parent1
		$sql_1 = $this->db->query("select referensi from master_member where id_deal = '".$pelanggan."'")->row();
		if($sql_1 != NULL){
			if($sql_1->referensi != NULL || $sql_1->referensi != '0'){
				$data4 = array(
					'no_surat_pesanan' => $no_trans,
					'kode_member' => $sql_1->referensi,
					'komisi' => $parent1,
					'ket' => 'upline 1'
				);
				$this->db->insert('trans_komisi', $data4);
			}
		}
		
		//insentif parent2
		$sql_2 = $this->db->query("select upline2 from master_member where id_deal = '".$pelanggan."'")->row();
		if($sql_2 != NULL){
			$sql_2upline2 = $sql_2->upline2;
			if($sql_2->upline2 != NULL || $sql_2->upline2 != '0'){
				$data5 = array(
					'no_surat_pesanan' => $no_trans,
					'kode_member' => $sql_2->upline2,
					'komisi' => $parent2,
					'ket' => 'upline 2'
				);
				$this->db->insert('trans_komisi', $data5);
			}
		} else {
			$sql_2upline2 = 0;
		}
		
		//insentif parent3
		$sql_3 = $this->db->query("select referensi from master_member where id_deal = '".$sql_2upline2."'")->row();
		if($sql_3 != NULL){
			$sql_3referensi = $sql_3->referensi;
			if($sql_3->referensi != NULL || $sql_3->referensi != '0'){
				$data6 = array(
					'no_surat_pesanan' => $no_trans,
					'kode_member' => $sql_3->referensi,
					'komisi' => $parent3,
					'ket' => 'upline 3'
				);
				$this->db->insert('trans_komisi', $data6);
			}
		} else {
			$sql_3referensi = 0;
		}
		
		//insentif parent4
		$sql_4 = $this->db->query("select upline2 from master_member where id_deal = '".$sql_2upline2."'")->row();
		if($sql_4 != NULL){
			$sql_4upline2 = $sql_4->upline2;
			if($sql_4->upline2 != NULL || $sql_4->upline2 != '0'){
				$data7 = array(
					'no_surat_pesanan' => $no_trans,
					'kode_member' => $sql_4->upline2,
					'komisi' => $parent4,
					'ket' => 'upline 4'
				);
				$this->db->insert('trans_komisi', $data7);
			}
		} else {
			$sql_4upline2 = 0;
		}
		
		//insentif parent5
		$sql_5 = $this->db->query("select referensi from master_member where id_deal = '".$sql_4upline2."'")->row();
		if($sql_5 != NULL){
			if($sql_5->referensi != NULL || $sql_5->referensi != '0'){
				$data8 = array(
					'no_surat_pesanan' => $no_trans,
					'kode_member' => $sql_5->referensi,
					'komisi' => $parent5,
					'ket' => 'upline 5'
				);
				$this->db->insert('trans_komisi', $data8);
			}
		}
		
		//insentif 15org jual
		/*$sql_6 = $this->db->query("select count(b.referensi) as jml from tb_surat_pesanan a left join master_member b on a.kode_pelanggan=b.id_deal where b.referensi = '".$sql_1->referensi."'")->row();
		if($sql_6->jml >= '15'){
			$data9 = array(
				'no_surat_pesanan' => $no_trans,
				'kode_member' => $sql_1->referensi,
				'komisi' => $min_15,
					'ket' => '15 Org Jual'
			);
			$this->db->insert('trans_komisi', $data9);
		}
		
		//insentif 5org jual 5miliar
		$limaOrg = 0;
		$sql_7 = $this->db->query("SELECT referensi, no_surat_pesanan, id_deal, SUM(harga_jual) as jual from (SELECT
master_member.referensi,
tb_surat_pesanan.no_surat_pesanan,
master_member.id_deal,
tb_surat_pesanan.harga_jual
FROM
master_member
INNER JOIN tb_surat_pesanan ON master_member.id_deal = tb_surat_pesanan.kode_pelanggan) as tb_a where referensi = '".$sql_1->referensi."' GROUP BY id_deal");
		foreach($sql_7->result() as $rs_7){
			if($rs_7->jual >= '5000000000'){
				$limaOrg = $limaOrg + 1;
			}
		}
		
		if($limaOrg >= '5'){
			$data10 = array(
				'no_surat_pesanan' => $no_trans,
				'kode_member' => $sql_1->referensi,
				'komisi' => $min_5,
				'ket' => '5 Org Jual s.d 5 Miliar'
			);
			$this->db->insert('trans_komisi', $data10);
		}
		
		//insentif 35org jual
		$sql_8 = $this->db->query("select count(b.referensi) as jml from tb_surat_pesanan a left join master_member b on a.kode_pelanggan=b.id_deal where b.referensi = '".$sql_1->referensi."'")->row();
		if($sql_8->jml >= '35'){
			$data11 = array(
				'no_surat_pesanan' => $no_trans,
				'kode_member' => $sql_1->referensi,
				'komisi' => $min_35,
				'ket' => '35 Org Jual'
			);
			$this->db->insert('trans_komisi', $data11);
		}*/
	}
}
?>