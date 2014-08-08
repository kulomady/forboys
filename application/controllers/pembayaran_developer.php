<?php 
class pembayaran_developer extends SIS_Controller {

	public function __construct() {
        parent::__construct();
		$this->load->model('m_company');
		$this->load->model('m_komisi');   
    }
	
	public function index(){
		$data['hak_toolbar'] = $this->msistem->hak_toolbar('mk4');
		$this->load->view('pembayaran_developer/bayar_index',$data);
	}
	
	function loadMainData($kode="",$nama="") {
		$qr = "";
		if($kode != '0'):
			$qr .= "and a.kdtrans like '%".$kode."%'";
		endif;
		if($nama != '0'):
			$qr .= "and c.nama_customer like '%".$nama."%'";
		endif;
		
		$grid = new GridConnector($this->db->conn_id);
        $grid->render_sql("SELECT
a.id,
a.kdtrans,
DATE_FORMAT(a.tgl,'%d/%m/%Y') AS tgl,
a.jumlah,
a.komisi,
a.created,
a.created_by,
a.modified,
a.modified_by,
c.nama_customer
FROM
trans_pembayaran_dev AS a
LEFT JOIN trans_surat_pesanan AS b ON a.surat_pesanan = b.kdtrans
INNER JOIN master_customer AS c ON b.kode_pelanggan = c.kdtrans
WHERE
a.kdtrans IS NOT null $qr","id","id,kdtrans,tgl,nama_customer,jumlah,created,created_by,modified,modified_by");
	}
	
	function frm_input() {
		$this->load->view('pembayaran_developer/bayar_input'); 
	}
	
	function frm_search_sp() {
		$this->load->view('pembayaran_developer/bayar_surat_pesanan'); 
	}
	
	function loadDataSP() {
		if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
 			header("Content-type: application/xhtml+xml"); } else {
 			header("Content-type: text/xml");
		}
		echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");
		echo "<rows>";
		
		$qr = $this->db->query("SELECT a.id, a.kdtrans, a.tgl, a.harga_jual, b.nama_perusahaan, b.nama_member, a.kode_member, c.nama_customer FROM trans_surat_pesanan AS a INNER JOIN master_member AS b ON a.kode_member = b.id_deal INNER JOIN master_customer AS c ON a.kode_pelanggan = c.kdtrans where a.kdtrans not in (select no_surat_pesanan from trans_komisi)");
		$i=1;
		foreach($qr->result() as $rs) {
				echo ("<row id='".$i."'>");
					echo("<cell><![CDATA[".$i."]]></cell>");
					echo("<cell><![CDATA[".$rs->kdtrans."]]></cell>");
					echo("<cell><![CDATA[".$rs->tgl."]]></cell>");
					echo("<cell><![CDATA[".$rs->nama_customer."]]></cell>");
					echo("<cell><![CDATA[".number_format($rs->harga_jual,2,",",".")."]]></cell>");
					echo("<cell><![CDATA[".$rs->kode_member."]]></cell>");
					echo("<cell><![CDATA[".$rs->nama_member."]]></cell>");
				echo("</row>");
			$i++;
		}
		echo "</rows>";
	}
	
	function simpan(){
		$tgl = $this->msistem->conversiTgl($this->input->post("tgl"));
		//hitung_komisi
		$komisi = $this->m_komisi->hitung_komisi($this->input->post('sp'));
		
		$data = array(
			'tgl' => $tgl,
			'surat_pesanan' => strtoupper($this->input->post('sp')),
			'kode_member' => strtoupper($this->input->post('kd_member')),
			'jumlah' => $this->input->post('jml'),
			'komisi' => $komisi
		);
		
		$this->db->trans_begin();
		if($this->input->post('id')=="") {
			$kdtrans = $this->msistem->noTranss('PD','trans_pembayaran_dev');
			$dataIns = array (
				'kdtrans' => $kdtrans,
				'created' => date("Y-m-d H:i:s"),
				'created_by' => strtoupper($this->session->userdata('sis_user'))
			);
			$data = array_merge($data,$dataIns);
			$this->db->insert('trans_pembayaran_dev', $data);
			$this->msistem->log_book('Input data baru pembayaran_dev Developer "'.$kdtrans,'mk4',$this->session->userdata('sis_user'));
		} else {
			$kdtrans = strtoupper($this->input->post('no_bayar'));
			$dataUpdate = array('modified_by' => strtoupper($this->session->userdata('sis_user')));
			$data = array_merge($data,$dataUpdate);
			$this->db->update('trans_pembayaran_dev', $data,array('id' => $this->input->post('id')));
			$this->msistem->log_book('Edit data pembayaran_dev Developer "'.$kdtrans,'mk4',$this->session->userdata('sis_user'));
		}
		
		if($komisi!=0){
			$cek = $this->db->query("select count(id) as jml from trans_pembayaran_komisi where no_sp = '".$this->input->post('sp')."'")->row();
			if($cek->jml==0){
				$this->db->query("delete from tb_temp2 where no_surat_pesanan = '".$this->input->post('sp')."'");
				$this->db->query("delete from trans_komisi where no_surat_pesanan = '".$this->input->post('sp')."'");
			}
			
			//pembagian komisi
			$sts = $this->db->query("select unit_pesanan from trans_surat_pesanan where kdtrans = '".$this->input->post('sp')."'")->row();
			if($sts->unit_pesanan == '1'){
				$rs = $this->db->query("select kode_member,sts,kode_dev from trans_surat_pesanan where kdtrans = '".$this->input->post('sp')."'")->row();
			} else {
				$rs = $this->db->query("select kode_member,sts_landed as sts,dev_landed as kode_dev from trans_surat_pesanan where kdtrans = '".$this->input->post('sp')."'")->row();
			}
			
			$status = $rs->sts;
			if($status=='1'){
				$this->m_komisi->komisi_baru($this->input->post('sp'),$komisi,$rs->kode_member,$rs->kode_dev);
			} else {
				$this->m_komisi->komisi_bekas($this->input->post('sp'),$komisi,$rs->kode_member,$rs->kode_dev);
			}
			
			$this->db->query("delete from trans_komisi where kode_member = '0'");
			$this->db->query("delete from trans_komisi where kode_member is NULL");
			$this->db->query("delete from trans_komisi where kode_member = ''");
		}
		
		if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
			echo "0";
        } else {
            $this->db->trans_commit();
			echo $kdtrans;
        }
	}
	
	function frm_edit($id="") {
		$data['id'] = $id;
		$r = $this->db->query("select a.id, a.kdtrans, a.surat_pesanan, DATE_FORMAT(a.tgl,'%d/%m/%Y') as tgl, d.nama_customer, a.kode_member, c.nama_member, a.jumlah, a.created, a.created_by, a.modified, a.modified_by from trans_pembayaran_dev a left join trans_surat_pesanan b on a.surat_pesanan=b.kdtrans left join master_member c on a.kode_member=c.id_deal left join master_customer d on b.kode_pelanggan=d.kdtrans where a.id = '".$id."'")->row();
		$data['no_bayar'] = $r->kdtrans;
		$data['tgl'] = $r->tgl;
		$data['sp'] = $r->surat_pesanan;
		$data['nm_pemesan'] = $r->nama_customer;
		$data['kd_member'] = $r->kode_member;
		$data['nm_member'] = $r->nama_member;
		$data['jml'] = $r->jumlah;
		$this->load->view('pembayaran_developer/bayar_input',$data);
	}
	
	function hapus() {
		$idrec = $this->input->post('idrec');
		$this->db->trans_begin();
		$sql = $this->db->query("select surat_pesanan from trans_pembayaran_dev where id = '".$idrec."'")->row();
		$this->db->query("delete from trans_komisi where no_surat_pesanan = '".$sql->surat_pesanan."'");		
		$this->db->delete("trans_pembayaran_dev",array('id' => $idrec));
		$this->msistem->log_book('Delete data id "'.$idrec,'mk4',$this->session->userdata('sis_user'));
		if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
			echo "Hapus Data Gagal";
        } else {
            $this->db->trans_commit();
			echo "Hapus Data Berhasil";
        }
	}
}
?>