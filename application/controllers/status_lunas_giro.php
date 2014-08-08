<?php
class status_lunas_giro extends SIS_Controller { 

	public function __construct() {
        parent::__construct();   
        $this->load->model('msistem');
		$this->load->model('m_rekan_bisnis');
		$this->load->model('m_company');
    }
	
	public function index() {
		$data['hak_toolbar'] = $this->msistem->hak_toolbar('pb6');
		$this->load->view('status_lunas_giro/giro_index',$data);
	}
	
	function loadMainDataHutang($idRekan="",$noBg="") {
		$qr = "";
		if($noBg != '0'):
			$qr .= "and a.nod_metode = '".$noBg."'";
		endif;
		
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select a.id,a.kdtrans,a.tgl,b.nmrekan,a.total_bayar,a.nod_metode,a.flag,DATE_FORMAT(a.tgl_lunas,'%d/%m/%Y') as tgl_lunas from trans_pemby_supplier a inner join master_rekan_bisnis b on a.kd_supplier = b.idrekan where a.kd_supplier = '".$idRekan."' and idmetode = '2' $qr order by a.tgl asc","id","id,kdtrans,tgl,nmrekan,total_bayar,nod_metode,flag,tgl_lunas");
		
	}
	
	function loadMainDataPiutang($idRekan="",$noBg="") {
		$qr = "";
		if($noBg != '0'):
			$qr .= "and a.nod_metode = '".$noBg."'";
		endif;
		
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select a.id,a.kdtrans,a.tgl,b.nmrekan,a.total_bayar,a.nod_metode,a.flag,DATE_FORMAT(a.tgl_lunas,'%d/%m/%Y') as tgl_lunas from trans_pemby_piutang a inner join master_rekan_bisnis b on a.idrekan = b.idrekan where a.idrekan = '".$idRekan."' and idmetode = '2' $qr order by a.tgl asc","id","id,kdtrans,tgl,nmrekan,total_bayar,nod_metode,flag,tgl_lunas");
		
	}
	
	function simpan() {
		$data = $this->input->post('data');
		$pembayaran = $this->input->post('pembayaran');
		
		if($pembayaran == 'HUTANG') {
			$table = "trans_pemby_supplier";	
		} else {
			$table = "trans_pemby_piutang";	
		}
		
		$arrBaris = preg_split("[~]",$data);
		foreach($arrBaris as $baris) {
			$arrData = preg_split("[`]",$baris);
			$arrTgl = explode("/",$arrData[2]);
			$tgl_lunas = $arrTgl[2]."-".$arrTgl[1]."-".$arrTgl[0];
			$dataUpd = array (
				'flag' => $arrData[1],
				'tgl_lunas' => $tgl_lunas
			);
			
			$this->db->update($table,$dataUpd,array('kdtrans' => $arrData[0]));
		}
	}
	
	function dataSupplier() {
		echo $this->m_rekan_bisnis->pilihSupplier('0');	
	}
	
	function dataPelanggan() {
		echo $this->m_rekan_bisnis->pilihPelanggan('0');	
	}
}
?>