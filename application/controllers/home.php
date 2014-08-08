<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class home extends CI_Controller { 
	public function __construct() {
        parent::__construct();   
        $this->load->library('form_validation');
        $this->load->model('msistem');
    }
	
	public function index() {
		$data['sis_user'] = $sis_user = $this->session->userdata('sis_user');
		if(empty($sis_user)) {
                $data['judul'] = 'Shoes Store v.01';
                $data['msg'] = NULL;
                $data['footer'] = $this->config->item('footer');
                $this->load->view('login',$data);
        } else {
			$r = $this->db->query("select a.first_name,a.last_name,a.username,b.nm_outlet from tb_users a inner join master_company b on a.outlet_id = b.outlet_id where username = '".$this->session->userdata('sis_user')."'")->row();
				$data['first_name'] = $r->first_name;
				$data['last_name'] = $r->last_name;
				$data['nm_outlet'] = $r->nm_outlet;
                $this->load->view('home', $data);
        }
	}
	
	 function processlogin() {
            $this->load->model('msistem');
            $m = $this->msistem->loginCheck($this->input->post('user'),md5($this->input->post('passwd')));
            if($this->session->userdata('sis_user') != "")
            {
			 	redirect(site_url().'/home/');
            } else {
                $data['judul'] = 'Shoes Store v.01';
                $data['msg'] = 'Ada kesalahan pada saat login, coba lagi!';
                $this->session->set_flashdata('error', 'Login gagal, silahkan coba kembali');
                $data['footer'] = $this->config->item('footer');
				$this->session->set_userdata(array('sis_user' => ""));
                $this->load->view('login',$data);
            }
	}
	
	function gantiPass() {
		$passwd = md5($this->input->post('passwd'));
		$user = $this->session->userdata('sis_user');
		$result = $this->db->query("update tb_users set password = '".$passwd."' where username = '".$user."'");
		echo $result;
	}
	
	function mainMenu($group_id="") {
		if (stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml")) {
			header("Content-type: application/xhtml+xml"); } else {
			header("Content-type: text/xml");
		}
		echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n"); 	
		echo "<menu>";
			$this->menu(0,$group_id);
		echo "</menu>";
	}
	
	function menu($parent,$group_id) {
		
		$sql=$this->db->query("select concat(a.id,'|',a.controller) as idmenu,a.menu,a.image,a.id from sys_menu a inner join sys_hak_menu b on a.id = b.idmenu where a.parent='".$parent."' and a.display='1' and b.group_id = '".$group_id."' and (b.baru = '1' or cetak = '1' or ubah = '1' or hapus = '1' or kunci_tgl = '1') order by a.posisi asc");
		foreach($sql->result() as $rs) {
			
			$qr=mysql_query("select a.id from sys_menu a inner join sys_hak_menu b on a.id = b.idmenu where a.parent='".$rs->id."' and a.display='1' and b.group_id = '".$group_id."' and (b.baru = '1' or cetak = '1' or ubah = '1' or hapus = '1' or kunci_tgl = '1')");
			$num=mysql_num_rows($qr);
			
			if($num==0) {
				echo "<item id=\"".$rs->idmenu."\" text=\"".ucwords(strtolower($rs->menu))."\" img=\"".$rs->image."\" />";
			} else {
				echo "<item id=\"".$rs->idmenu."\" text=\"".ucwords(strtolower($rs->menu))."\" img=\"".$rs->image."\" >";
				$this->menu($rs->id,$group_id);
				echo "</item>";
			}
			if($parent=='0'):
				echo '<item id="SP'.$rs->id.'" text="Separator" type="separator" />';
			endif;	
		}
	}
	
	function logout()
    {
			
            $this->session->sess_destroy();
			echo "<script>";
			echo 'window.location.href = "'.base_url().'";';
			echo "</script>";
    }
}
?>