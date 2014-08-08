<?php 
class group_user extends SIS_Controller { 
	public function index() {
		$data['hak_toolbar'] = $this->msistem->hak_toolbar('pg11');
		$this->load->view('group_user/group_user_index',$data);
	}
	
	function loadMainData($nmGroup="",$ket="") {
		$qr = "";
		if($nmGroup != "0"):
			$qr .= " and name like '%".$nmGroup."%'";
		endif;
		if($ket != "0"):
			$qr .= " and description like '%".$ket."%'";
		endif;
		$grid = new GridConnector($this->db->conn_id);
		$grid->render_sql("select * from master_groups where group_id != '0' $qr","group_id","group_id,name,description,created,created_by");
	}
	
	function frm_input() {
		$this->load->view('group_user/group_user_input'); 
	}
	
	function frm_edit($id="") {
		$data['id'] = $id;
		$r = $this->db->query("select name,description from master_groups where group_id = '".$id."'")->row();
		$data['name'] = $r->name;
		$data['description'] = $r->description;
		$this->load->view('group_user/group_user_input',$data); 
	}
	
	function dataMenu($id="") {
		$tree = new TreeGridConnector($this->db->conn_id);
		if($id=="") {
   			$tree->render_sql("select id,parent,menu,null as nilai from sys_menu where type = 'TRANS' and display = '1'","id","menu,nilai,nilai,nilai,nilai,nilai,parent,id","","parent");
		} else {
			$tree->render_sql("select a.id,a.parent,a.menu,b.baru,b.cetak,b.ubah,b.hapus,b.kunci_tgl from sys_menu a left join sys_hak_menu b on a.id = b.idmenu and b.group_id = '".$id."' where type = 'TRANS' and display = '1'","id","menu,baru,ubah,hapus,cetak,kunci_tgl,parent,id","","parent");
		}
	}
	
	/*function dataReport($id="") {
		$tree = new TreeGridConnector($this->db->conn_id);
		if($id=="") {
   			$tree->render_sql("select id,idparent,nmreport,null as nilai from sys_daftar_report","id","nmreport,nilai,idparent,id","","idparent");
		} else {
			$tree->render_sql("select a.id,a.idparent,a.nmreport,b.view from sys_daftar_report a inner join sys_hak_report b on a.id = b.idreport where b.group_id = '".$id."'","id","nmreport,view,idparent,id","","idparent");
		}
	} */
	
	function dataReport($id="") {
		$tree = new TreeGridConnector($this->db->conn_id);
		if($id=="") {
   			$tree->render_sql("select id,parent,menu,null as nilai from sys_menu where type = 'REPORT' and display = '1'","id","menu,nilai,parent,id","","parent");
		} else {
			$tree->render_sql("select a.id,a.parent,a.menu,b.cetak from sys_menu a left join sys_hak_menu b on a.id = b.idmenu and b.group_id = '".$id."' where type = 'REPORT' and display = '1'","id","menu,cetak,parent,id","","parent");
		}
	}
	
	function dataOutlet($id="") {
		$tree = new TreeGridConnector($this->db->conn_id);
		if($id=="") {
   			$tree->render_sql("select outlet_id,id_induk,nm_outlet,null as nilai from master_company where is_active = '1'","outlet_id","nm_outlet,nilai,id_induk,outlet_id","","id_induk");
		} else {
			$tree->render_sql("select a.outlet_id,a.id_induk,a.nm_outlet,b.view from master_company a left join sys_hak_outlet b on a.outlet_id = b.outlet_id and b.group_id = '".$id."'","outlet_id","nm_outlet,view,id_induk,outlet_id","","id_induk");
		}
	}
	
	function simpan() {
		$data = array(
			'name' => strtoupper($this->input->post('nmGroup')),
			'description' => strtoupper($this->input->post('nmKet'))
		);
		$this->db->trans_begin();
		if($this->input->post('idgroup')=="") {
			$dataIns = array (
				'created' => date("Y-m-d H:i:s"),
				'created_by' => $this->session->userdata('sis_user')
			);
			$data = array_merge($data,$dataIns);
			$this->db->insert('master_groups', $data);
			$idgroup = $this->db->insert_id();
			$this->msistem->log_book('Input data baru Group "'.$this->input->post('nmGroup'),'PG11',$this->session->userdata('sis_user'));
		} else {
			$dataUpdate = array ('modified_by' => $this->session->userdata('sis_user'));
			$data = array_merge($data,$dataUpdate);
			$this->db->update('master_groups', $data,array('group_id' => $this->input->post('idgroup')));
			$this->msistem->log_book('Edit data baru Group "'.$this->input->post('nmGroup'),'PG11',$this->session->userdata('sis_user'));
			$idgroup = $this->input->post('idgroup');
		}
		
		$table = 'sys_hak_menu';
		$fk = array('group_id' => $idgroup);
		$this->db->delete($table,$fk);
		// input menu
		$dataMenu = $this->input->post('dataMenu');
		$dataIns = array('baru','ubah','hapus','cetak','kunci_tgl','idmenu');
		$this->msistem->insertDBnotDelete($dataMenu,$table,$dataIns,$fk);
		
		// Input Report
		$dataReport = $this->input->post('dataReport');
		$dataIns = array('cetak','idmenu');
		$this->msistem->insertDBnotDelete($dataReport,$table,$dataIns,$fk);
		
		// Input Outlet
		$dataOutlet = $this->input->post('dataOutlet');
		$dataIns = array('view','outlet_id');
		$table = 'sys_hak_outlet';
		$this->msistem->insertDB($dataOutlet,$table,$dataIns,$fk);
		
		if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
	}
	
	function hapus() {
		$idrec = $this->input->post('idrec');
		$this->db->trans_begin();
		// log delete
		$this->msistem->log_delete("master_groups","where group_id = '$idrec'");
		$this->db->delete("master_groups",array('group_id' => $idrec));
		
		$this->msistem->log_delete("sys_hak_menu","where group_id = '$idrec'");
		$this->db->delete("sys_hak_menu",array('group_id' => $idrec));
		
		$this->msistem->log_book('Delete data id "'.$idrec,'PG11',$this->session->userdata('sis_user'));
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