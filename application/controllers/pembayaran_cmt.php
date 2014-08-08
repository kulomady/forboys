<?php 
class pembayaran_cmt extends SIS_Controller {

	public function __construct() {
        parent::__construct();
		$this->load->model('m_company');
		$this->load->model('m_rekan_bisnis');
		$this->load->model('m_produksi');
    }
	
	public function index(){
		$data['hak_toolbar'] = $this->msistem->hak_toolbar('ku3');
		$data['pilihPO'] = $this->m_produksi->pilihPO('0');
		$data['gudang'] = $this->m_company->pilihLokasi('0');
		$this->load->view('pembayaran_cmt/bayar_cmt_index',$data);
	}
	
	function cbPO() {
		$combo = new ComboConnector($this->db->conn_id); 
		$combo->render_sql("select idjo,nmjo from tr_job_order","idjo","nmjo");
	}
	
	public function loadMainData($tgl1="",$tgl2="",$po="",$outlet_id="",$cmt="") {
		
		$qr = "";
		if($po != "0"):
			$qr .= " and a.idjo = '".$po."'";	
		endif;
		if($outlet_id != "0"):
			$qr .= " and b.dari = '".$outlet_id."'";	
		endif;
		if($cmt != "0"):
			$qr .= " and b.idrekan = '".$cmt."'";	
		endif;
		
		if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
 			header("Content-type: application/xhtml+xml"); } else {
 			header("Content-type: text/xml");
		}
		echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");
		echo "<rows>";
		
		$sql = $this->db->query("select a.idjo,c.nmjo,d.nm_outlet,e.nmrekan,sum(f.jml) as lusin,f.harga,b.idrekan,b.kdtrans from tr_terima_po_detail a inner join tr_terima_po b on a.kdtrans = b.kdtrans inner join tr_job_order c on a.idjo = c.idjo inner join master_company d on b.dari = d.outlet_id inner join master_rekan_bisnis e on b.idrekan = e.idrekan inner join v_kirim_po_detail f on a.idjo = f.idjo and b.idrekan = f.idrekan where b.tgl >= '".$tgl1."' and b.tgl <= '".$tgl2."' $qr group by b.idrekan,a.idjo");
		foreach($sql->result() as $rs) {
			$total = $rs->lusin * $rs->harga;
			echo '<row id="'.$rs->kdtrans.'">
					<cell type="sub_row_grid">'.base_url().'index.php/pembayaran_cmt/subGrid/'.$rs->idjo.'/'.$rs->idrekan.'</cell>
					<cell>'.$rs->idjo.'</cell>
					<cell>'.$rs->nmjo.'</cell>
					<cell>'.$rs->nm_outlet.'</cell>
					<cell>'.$rs->nmrekan.'</cell>
					<cell>'.$rs->lusin.'</cell>
					<cell>'.$rs->harga.'</cell>
					<cell>'.$total.'</cell>
					<cell>'.$rs->idrekan.'</cell>
			</row>';
		}
		
		echo "</rows>";
	}
	
	function subGrid($idjo="",$idrekan="") {
		if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
 			header("Content-type: application/xhtml+xml"); } else {
 			header("Content-type: text/xml");
		}
		echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");
		echo "<rows>";
			echo '<head>
        <column width="30" type="cntr" align="right" color="#CCE2FE" sort="str">No.</column>
        <column width="80" type="ro" align="left" sort="str">Tanggal</column>
        <column width="100" type="ron" align="right" sort="str" format="0,000">Debit</column>
        <column width="100" type="ron" align="right" sort="str" format="0,000">Kredit</column>
        <column width="100" type="ron" align="right" sort="str" format="0,000">Saldo</column>
        <column width="130" type="ro" align="left" sort="str">Transaksi</column>
		<column width="200" type="ro" align="left" sort="str">Keterangan</column>
        <settings>
            <colwidth>px</colwidth>
        </settings>
		<afterInit>
            <call command="attachFooter"><param>Jumlah,#cspan,{#stat_total},{#stat_total},,</param></call>
        </afterInit>
    </head>';
	
	// biayar CMT
	$sql = $this->db->query("select * from (
select concat('A',b.id) as id, (f.jml * f.harga) as jml,'DEBIT' as trans,b.tgl,'Biaya CMT' as ket,'' as keterangan from tr_terima_po_detail a inner join tr_terima_po b on a.kdtrans = b.kdtrans inner join v_kirim_po_detail f on a.idjo = f.idjo and b.idrekan = f.idrekan where a.idjo = '".$idjo."' and b.idrekan = '".$idrekan."'
UNION 
select concat('B',id) as id,grand_total as jml,'KREDIT' as trans,tgl,'Penjualan Alat-alat' as ket,'' as keterangan from tr_penjualan where idjo = '".$idjo."' and idrekan = '".$idrekan."' group by tgl
UNION
select concat('C',id) as id,jml, 'KREDIT' as trans, tgl,'Pembayaran CMT' as ket,keterangan from prod_pembayaran_cmt where idjo = '".$idjo."' and idrekan = '".$idrekan."'
UNION
select concat('D',a.id) as id,a.grand_total as jml,'DEBIT' as trans,a.tgl,'Retur Penjualan Alat-alat' as ket,'' as keterangan from tr_retur_penjualan a inner join tr_penjualan b on a.kdpenjualan = b.kdtrans where b.idjo =  '".$idjo."' and b.idrekan = '".$idrekan."'
) as cmt order by tgl asc");
	
	$saldo = 0;
	foreach($sql->result() as $rs) {
		
		$debit = "";
		if($rs->trans == 'DEBIT'):
			$debit = $rs->jml;
		endif;
		$kredit = "";
		if($rs->trans == 'KREDIT'):
			$kredit = $rs->jml;
		endif;
	    $saldo = $saldo + ($debit - $kredit);
		echo '<row id="'.$rs->id.'">
			<cell>-1500</cell>
			<cell>'.$rs->tgl.'</cell>
			<cell>'.$debit.'</cell>
			<cell>'.$kredit.'</cell>
			<cell>'.$saldo.'</cell>
			<cell>'.$rs->ket.'</cell>
			<cell>'.$rs->keterangan.'</cell>
		</row>';
	}
	// Pembayaran
	
	// Retur
		echo "</rows>";
	}
	
	function frm_input($kdtrans="",$idjo="") {
		//$data['pilihCMT'] = $this->m_rekan_bisnis->pilihCMT('0');
		$r = $this->db->query("select a.idrekan,b.nmrekan from tr_terima_po a inner join master_rekan_bisnis b on a.idrekan = b.idrekan where a.kdtrans = '".$kdtrans."'")->row();
		$data['cmt'] = $r->idrekan;
		$data['nmcmt'] = $r->nmrekan;
		$data['kdtrans'] = $kdtrans;
		$data['idjo'] = $idjo;
		$this->load->view('pembayaran_cmt/bayar_cmt_input',$data); 
	}
	
	function frm_edit($id="") {
		$r = $this->db->query("select a.*,d.nmperkiraan,b.nmrekan,c.nmjo from prod_pembayaran_cmt a inner join master_rekan_bisnis b on a.idrekan = b.idrekan inner join tr_job_order c on a.idjo = c.idjo inner join ak_master_perkiraan d on a.idperkiraan = d.idperkiraan where a.id = '".$id."'")->row();
		$data = array(
			'kdtrans' => $r->kdtrans,
			'tgl' => $this->msistem->conversiTglDB($r->tgl),
			'cmt' => $r->idrekan,
			'nmcmt' => $r->nmrekan,
			'kdtrans' => $r->kdtrans,
			'idperkiraan' => $r->idperkiraan,
			'nmperkiraan' => $r->nmperkiraan,
			'idjo' => $r->nmjo,
			'jml' => $r->jml,
			'keterangan' => $r->keterangan,
			'id' => $id
		);
		$this->load->view('pembayaran_cmt/bayar_cmt_input',$data); 
	}
	
	function frm_search_akun() {
		$this->load->view('pembayaran_cmt/rb_search_akun');
	}
	
	function simpan() {
		$tgl = $this->msistem->conversiTgl($this->input->post("tgl"));
		$data = array (
			'idjo' => $this->input->post("idjo"),
			'idrekan' => $this->input->post("idrekan"),
			'tgl' => $tgl,
			'jml' => $this->input->post("jml"),
			'idperkiraan' => $this->input->post("idperkiraan"),
			'keterangan' => strtoupper($this->input->post("ket")),
			'kdtrans' => $this->input->post("kdtrans")
		);
		$this->db->trans_begin();
		if($this->input->post("id")=="") {
			$dataIns = array_merge($data,array('created' => date("Y-m-d H:i:s"), 'created_by' => $this->session->userdata('sis_user')));
			$this->db->insert('prod_pembayaran_cmt', $dataIns);
			$this->msistem->log_book('Input data Pembayaran CMT "'.$kdtrans,'ku3',$this->session->userdata('sis_user'));
		} else {
			$id = $this->input->post("id");
			$dataUpdate = array_merge($data,array('modified_by' => $this->session->userdata('sis_user')));
			$this->db->update('prod_pembayaran_cmt',$dataUpdate,array('id' => $id));
			$this->msistem->log_book('Update data Pembayaran CMT "'.$id,'ku3',$this->session->userdata('sis_user'));
		}
		
		if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
			echo "0";
        } else {
            $this->db->trans_commit();
			echo "1";
        }
	}
	
	function hapus() {
		$idrec = $this->input->post('idrec');
		$this->db->trans_begin();
		$this->db->delete("prod_pembayaran_cmt",array('id' => $idrec));
		$this->msistem->log_book('Delete data id "'.$idrec,'ku3',$this->session->userdata('sis_user'));
		if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
			echo "0";
        } else {
            $this->db->trans_commit();
			echo "1";
        }
	}
	
}
?>