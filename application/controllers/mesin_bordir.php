<?php 
class mesin_bordir extends SIS_Controller {

	public function __construct() {
        parent::__construct();   
		$this->load->model('m_company');
		$this->load->model('m_produksi');
    }
 
	public function index() {
		$data['hak_toolbar'] = $this->msistem->hak_toolbar('pr4');
		$this->load->view('mesin_bordir/mb_index',$data);
	}
	
	function loadMainData() {
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select a.id,a.kdtrans,a.tgl,b.nm_outlet,c.jml,c.nmjo,concat(a.idperkiraan,' ',d.nmperkiraan) as nmperkiraan,sum(e.s_l) as s_l,sum(e.3_5) as 3_5,sum(e.6_8) as 6_8,sum(e.10_12) as 10_12,sum(e.jml_stick) as jml_stick,sum(e.total) as total,a.created_by,a.created,f.nmmesin,g.nmshift from prod_mesin_bordir a inner join master_company b on a.outlet_id = b.outlet_id inner join tr_job_order c on a.idjo = c.idjo inner join ak_master_perkiraan d on a.idperkiraan = d.idperkiraan inner join prod_mesin_bordir_detail e on a.kdtrans = e.kdtrans left join ref_mesin_bordir f on a.mesin = f.idmesin left join ref_shift g on a.shift = g.kdshift group by a.kdtrans","id","id,kdtrans,tgl,nm_outlet,nmjo,jml,nmmesin,nmshift,s_l,3_5,6_8,10_12,jml_stick,total,created,created_by");
	}
	
	function loadDataBrgDetail($kdtrans) {
		$img_del = '<img id="btnTglBerlaku_md41" src="../../assets/img/icon/tongsampah.png" border="0" style="cursor:pointer;" onclick="hapusDetail();" />';
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select *,'$img_del' as img_del from prod_mesin_bordir_detail where kdtrans = '".$kdtrans."'","id","keterangan,posisi,s_l,3_5,6_8,10_12,jml_stick,tarif,total,img_del");	
	}
	
	function frm_input() {
		$data['gudang'] = $this->m_company->pilihLokasi('0');
		$data['pilihPO'] = $this->m_produksi->pilihPO('0');
		$data['pilihMesin'] = $this->m_produksi->pilihMesin('0');
		$data['pilihShift'] = $this->m_produksi->pilihShift('0');
		$this->load->view('mesin_bordir/mb_input',$data); 
	}
	
	function frm_search_akun() {
		$this->load->view('mesin_bordir/rb_search_akun');
	}
	
	function frm_edit($id="") {
		$r = $this->db->query("select a.*,b.nmperkiraan from prod_mesin_bordir a inner join ak_master_perkiraan b on a.idperkiraan = b.idperkiraan where a.id = '".$id."'")->row();
		$data = array(
			'kdtrans' => $r->kdtrans,
			'tgl' => $this->msistem->conversiTglDB($r->tgl),
			'gudang' => $this->m_company->pilihLokasi($r->outlet_id),
			'pilihPO' => $this->m_produksi->pilihPO($r->idjo),
			'idperkiraan' => $r->idperkiraan,
			'nmperkiraan' => $r->nmperkiraan,
			'pilihMesin' => $this->m_produksi->pilihMesin($r->mesin),
			'pilihShift' => $this->m_produksi->pilihShift($r->shift)
		);
		$this->load->view('mesin_bordir/mb_input',$data); 
	}
	
	function simpan() {
		$tgl = $this->msistem->conversiTgl($this->input->post("tgl"));
		$data = array (
			'tgl' => $tgl,
			'outlet_id' => $this->input->post("gudang"),
			'idjo' => $this->input->post("nopo"),
			'idperkiraan' => $this->input->post("kdakun"),
			'mesin' => $this->input->post("mesin"),
			'shift' => $this->input->post("shift"),
		);
		$this->db->trans_begin();
		if($this->input->post("kdtrans")=="") {
			$kdtrans = $this->msistem->noTrans('MB','prod_mesin_bordir','',$this->input->post('gudang'),$tgl);
			$dataIns = array_merge($data,array('kdtrans' => $kdtrans,'created' => date("Y-m-d H:i:s"), 'created_by' => $this->session->userdata('sis_user')));
			$this->db->insert('prod_mesin_bordir', $dataIns);
			$this->msistem->log_book('Input data Mesin Bordir Baku Kode "'.$kdtrans,'pr4',$this->session->userdata('sis_user'));
		} else {
			$kdtrans = $this->input->post("kdtrans");
			$dataUpdate = array_merge($data,array('modified_by' => $this->session->userdata('sis_user')));
			$this->db->update('prod_mesin_bordir',$dataUpdate,array('kdtrans' => $kdtrans));
			$this->msistem->log_book('Update data Mesin Bordir Kode "'.$kdtrans,'pr4',$this->session->userdata('sis_user'));
		}
		
		// input barang detail
		$data = $this->input->post('data');
		$table = 'prod_mesin_bordir_detail';
		$dataIns = array('keterangan','posisi','s_l','3_5','6_8','10_12','jml_stick','tarif','total');
		$fk = array('kdtrans' => $kdtrans);
		$this->msistem->insertDB($data,$table,$dataIns,$fk);
		
		if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
			echo "0";
        } else {
            $this->db->trans_commit();
			echo $kdtrans;
        }
	}
	
	function hapus() {
		$idrec = $this->input->post('idrec');
		$this->db->trans_begin();
		$this->db->delete("prod_mesin_bordir",array('id' => $idrec));
		$this->msistem->log_book('Delete data id "'.$idrec,'pr4',$this->session->userdata('sis_user'));
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