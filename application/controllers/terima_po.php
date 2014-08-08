<?php 
class terima_po extends SIS_Controller {

	public function __construct() {
        parent::__construct();
		$this->load->model('msistem'); 
		$this->load->model('m_company');
		$this->load->model('m_produksi'); 
    }
	
	public function index() {
		$data['hak_toolbar'] = $this->msistem->hak_toolbar('pr7');
		$data['tujuan'] = $this->m_company->pilihLokasi('0');
		$data['pilihPO'] = $this->m_produksi->pilihPO('0');
		$this->load->view('terima_po/tp_index',$data);
	}
	
	
	function loadMainData($tglAwal="",$tglAkhir="",$po="",$tujuan="",$cmt="") {
	
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
		$grid->render_sql("select a.kdtrans,a.tgl,a.jns_kirim,sum(f.jmlbrg) as jml_lusin,b.nm_outlet as tujuan,c.nmrekan,a.created,a.created_by,e.nm_outlet from tr_terima_po a inner join master_company b on a.outlet_id = b.outlet_id left join master_rekan_bisnis c on a.idrekan = c.idrekan  inner join master_company e on a.dari = e.outlet_id inner join tr_terima_po_detail f on a.kdtrans = f.kdtrans where tgl >= '".$tglAwal."' and tgl <= '".$tglAkhir."' $qr group by a.kdtrans","kdtrans","id,kdtrans,tgl,tujuan,jns_kirim,nm_outlet,nmrekan,jml_lusin,created_by,created");
	}
	
	function loadDataBrgDetail($kdtrans) {
		$img = '<img id="btnTglBerlaku_md41" src="../../assets/img/icon/calendar.gif" border="0" style="cursor:pointer;" onclick="show_win_po_pr7(0);" />';
		$img_del = '<img id="btnTglBerlaku_md41" src="../../assets/img/icon/tongsampah.png" border="0" style="cursor:pointer;" onclick="hapusDetail(0);" />';
		$grid = new GridConnector($this->db->conn_id);
	    $grid->render_sql("select a.id,a.idjo,b.nmjo,a.jmlpcs,a.rusak,a.jmlbrg,a.total_biaya,a.keterangan,'$img' as img,'$img_del' as img_del from tr_terima_po_detail a left join tr_job_order b on a.idjo = b.idjo where a.kdtrans = '".$kdtrans."'","idjo","idjo,img,nmjo,jmlpcs,rusak,jmlbrg,total_biaya,keterangan,img_del");	
	}
	
	function frm_input() {
		$data['tujuan'] = $this->m_company->pilihLokasi('0');
		$data['dari'] = $this->m_company->pilihLokasi('0');
		$data['pilihPO'] = $this->m_produksi->pilihPO('0');
		$this->load->view('terima_po/tp_input',$data); 
	}
	
	function frm_edit($id="") {
		$r = $this->db->query("select * from tr_terima_po where kdtrans = '".$id."'")->row();
		$data = array(
			'kdtrans' => $r->kdtrans,
			'tgl' => $this->msistem->conversiTglDB($r->tgl),
			'tujuan' => $this->m_company->pilihLokasi($r->dari),
			'dari' => $this->m_company->pilihLokasi($r->outlet_id),
			'jns_kirim' => $r->jns_kirim,
			'cmt' => $this->m_produksi->pilihCMT($r->idrekan,$r->dari)
		);
		$this->load->view('terima_po/tp_input',$data); 
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
			'jns_kirim' => $this->input->post('jnsKirim'),
			'outlet_id' => strtoupper($this->input->post('dari')),
			'dari' => $this->input->post('tujuan'),
			'idrekan' => strtoupper($this->input->post('cmt'))
		);
		
		$this->db->trans_begin();
		if($this->input->post('kdtrans')=="") {
			$kdtrans = $this->msistem->noTrans('TP','tr_terima_po','',$this->input->post('tujuan'),$tgl);
			$dataIns = array (
				'kdtrans' => $kdtrans,
				'created' => date("Y-m-d H:i:s"),
				'created_by' => strtoupper($this->session->userdata('sis_user'))
			);
			$data = array_merge($data,$dataIns);
			$this->db->insert('tr_terima_po', $data);
			$this->msistem->log_book('Input data baru kirim po "'.$kdtrans,'pr7',$this->session->userdata('sis_user'));
		} else {
			$kdtrans = $this->input->post('kdtrans');
			$dataUpdate = array('modified_by' => strtoupper($this->session->userdata('sis_user')));
			$data = array_merge($data,$dataUpdate);
			$this->db->update('tr_terima_po', $data,array('kdtrans' => $kdtrans));
			$this->msistem->log_book('Edit data kirim po "'.$kdtrans,'pr7',$this->session->userdata('sis_user'));
		}
		
		// input barang detail
		$dataBrg = $this->input->post('dataPO');
		$table = 'tr_terima_po_detail';
		$dataIns = array('idjo','jmlpcs','rusak','jmlbrg','total_biaya','keterangan');
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
		$this->db->delete("tr_terima_po",array('kdtrans' => $idrec));
		$this->msistem->log_book('Delete data id "'.$idrec,'pr7',$this->session->userdata('sis_user'));
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