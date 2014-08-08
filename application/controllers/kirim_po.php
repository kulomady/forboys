<?php 
class kirim_po extends SIS_Controller {

	public function __construct() {
        parent::__construct();
		$this->load->model('msistem'); 
		$this->load->model('m_company');
		$this->load->model('m_produksi'); 
    }
	
	public function index() {
		$data['hak_toolbar'] = $this->msistem->hak_toolbar('pr6');
		$data['tujuan'] = $this->m_company->pilihLokasi('0');
		$data['pilihPO'] = $this->m_produksi->pilihPO('0');
		$this->load->view('kirim_po/kp_index',$data);
	}
	
	
	function loadMainData($tglAwal="",$tglAkhir="",$po="",$tujuan="",$cmt="") {
	
		$qr = "";	
		if($po != "0"):
			$qr .= " and a.idjo = '".$po."'";
		endif;
		if($tujuan != "0"):
			$qr .= " and a.outlet_id = '".$tujuan."'";
		endif;
		if($cmt != "0"):
			$qr .= " and a.idrekan = '".$cmt."'";
		endif;
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select a.kdtrans,a.tgl,a.jns_kirim,'' as jml_lusin,b.nm_outlet,c.nmrekan,a.created,a.created_by,e.nm_outlet as dari,sum(f.jml) as jml from tr_kirim_po a inner join master_company b on a.outlet_id = b.outlet_id left join master_rekan_bisnis c on a.idrekan = c.idrekan  inner join master_company e on a.tujuan = e.outlet_id inner join tr_kirim_po_detail f on a.kdtrans = f.kdtrans where tgl >= '".$tglAwal."' and tgl <= '".$tglAkhir."' $qr group by a.kdtrans","kdtrans","id,kdtrans,tgl,jns_kirim,dari,nm_outlet,nmrekan,jml,created_by,created");
	}
	
	function loadDataBrgDetail($kdtrans) {
		$img = '<img id="btnTglBerlaku_md41" src="../../assets/img/icon/calendar.gif" border="0" style="cursor:pointer;" onclick="show_win_po(0);" />';
		$img_del = '<img id="btnTglBerlaku_md41" src="../../assets/img/icon/tongsampah.png" border="0" style="cursor:pointer;" onclick="hapusDetail(0);" />';
		$grid = new GridConnector($this->db->conn_id);
	    $grid->render_sql("select a.id,a.idjo,a.nmbarang,a.satuan,a.jml,a.keterangan,'$img' as img,'$img_del' as img_del from tr_kirim_po_detail a where a.kdtrans = '".$kdtrans."'","idjo","idjo,img,nmbarang,satuan,jml,keterangan,img_del");	
	}
	
	function frm_input() {
		$data['dari'] = $this->m_company->pilihLokasi('0');
		$data['tujuan'] = $this->m_company->pilihLokasi('0');
		$data['pilihPO'] = $this->m_produksi->pilihPO('0');
		$this->load->view('kirim_po/kp_input',$data); 
	}
	
	function frm_edit($id="") {
		$r = $this->db->query("select * from tr_kirim_po where kdtrans = '".$id."'")->row();
		$data = array(
			'kdtrans' => $r->kdtrans,
			'tgl' => $this->msistem->conversiTglDB($r->tgl),
			'dari' => $this->m_company->pilihLokasi($r->outlet_id),
			'tujuan' => $this->m_company->pilihLokasi($r->tujuan),
			'jns_kirim' => $r->jns_kirim,
			'cmt' => $this->m_produksi->pilihCMT($r->idrekan,$r->tujuan),
			'dikirim_dgn' => $r->dikirim_dgn,
			'no_pol' => $r->no_pol,
			'supir' => $r->supir,
			'keterangan' => $r->keterangan
		);
		$this->load->view('kirim_po/kp_input',$data); 
	}
	
	function dataCMT() {
		 $outlet_id = $this->input->post('cabang');
		 $opt = '';
		 $sql = $this->db->query("select idrekan,nmrekan from master_rekan_bisnis where outlet_id = '".$outlet_id."' and idtipe_rekan = '4'  order by nmrekan asc");
         foreach($sql->result() as $rs){
		 		if($rs->idrekan==$pilih) { $select = 'selected="selected"'; } else { $select = ""; }
				$opt .= "<option value='".$rs->idrekan."' $select>".$rs->nmrekan."</option>";
        }	
		echo $opt;
	}
	
	function simpan() {
		$tgl = $this->msistem->conversiTgl($this->input->post("tgl"));
		$data = array(
			'tgl' => $tgl,
			'outlet_id' => $this->input->post('dari'),
			'jns_kirim' => $this->input->post('jnsKirim'),
			'tujuan' => strtoupper($this->input->post('tujuan')),
			'idrekan' => strtoupper($this->input->post('cmt')),
			'dikirim_dgn' => strtoupper($this->input->post('dikirim_dgn')),
			'no_pol' => strtoupper($this->input->post('nopol')),
			'supir' => strtoupper($this->input->post('supir')),
			'keterangan' => strtoupper($this->input->post('keterangan')),
		);
		
		$this->db->trans_begin();
		if($this->input->post('kdtrans')=="") {
			$kdtrans = $this->msistem->noTrans('KP','tr_kirim_po','',$this->input->post('tujuan'),$tgl);
			$dataIns = array (
				'kdtrans' => $kdtrans,
				'created' => date("Y-m-d H:i:s"),
				'created_by' => strtoupper($this->session->userdata('sis_user'))
			);
			$data = array_merge($data,$dataIns);
			$this->db->insert('tr_kirim_po', $data);
			$this->msistem->log_book('Input data baru kirim po "'.$kdtrans,'pr6',$this->session->userdata('sis_user'));
		} else {
			$kdtrans = $this->input->post('kdtrans');
			$dataUpdate = array('modified_by' => strtoupper($this->session->userdata('sis_user')));
			$data = array_merge($data,$dataUpdate);
			$this->db->update('tr_kirim_po', $data,array('kdtrans' => $kdtrans));
			$this->msistem->log_book('Edit data kirim po "'.$kdtrans,'pr6',$this->session->userdata('sis_user'));
		}
		
		// input barang detail
		$dataBrg = $this->input->post('dataPO');
		$table = 'tr_kirim_po_detail';
		$dataIns = array('idjo','nmbarang','harga','jml','keterangan');
		$fk = array('kdtrans' => $kdtrans);
		$this->msistem->insertDB($dataBrg,$table,$dataIns,$fk);
		
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
		$this->db->delete("tr_kirim_po",array('kdtrans' => $idrec));
		$this->msistem->log_book('Delete data id "'.$idrec,'pr6',$this->session->userdata('sis_user'));
		if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
			echo "Hapus Data Gagal";
        } else {
            $this->db->trans_commit();
			echo "Hapus Data Berhasil";
        }
	}
	
	function dataPO() {
		$grid = new GridConnector($this->db->conn_id);	
		$grid->render_sql("select idjo,nmjo from tr_job_order where status = 'OPEN'","idjo","idjo,nmjo");
	}
}

?>