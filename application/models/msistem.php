<?php
class msistem extends CI_Model
{
    function loginCheck($username,$pass)
    {
        $sql = "SELECT a.id,a.group_id,a.username,a.outlet_id,a.first_name,a.last_name,c.nm_outlet,c.type
                FROM tb_users a
                JOIN master_groups b ON a.group_id = b.group_id
				LEFT JOIN master_company c ON a.outlet_id=c.outlet_id where a.active='1' and a.username = '".$username."' and a.password = '".$pass."'";
		// Periode Akun
		$pa = $this->db->query("select concat(sa_thn,'-',sa_bln) as periode,concat('01/',sa_bln,'/',sa_thn) as periodeAwal from sys_periode_akuntansi where active = '1'")->row();
		
        $q = $this->db->query($sql);
        if($q->num_rows()==1)
        {
            $r = $q->row();
            $sessiondata = array(
                'user_id' => $r->id,
                'sis_user' => $r->username,
                'group_id' => $r->group_id,
                'outlet_id' => $r->outlet_id,
				'type' => $r->type,
				'namauser' => $r->first_name.' '.$r->last_name,
				'periode' => $pa->periode,
				'periodeAwal' => $pa->periodeAwal,
            );
            $this->session->set_userdata($sessiondata);
            return true;
        } else {
			$this->session->sess_destroy();
            return false;
        }
    }

    	
	function bulan() {
		$arr = explode("-",$this->session->userdata('periode'));
		
		$bln = "";
		for($i=1;$i<=12;$i++) {
			if(strlen($i)=='1') { 
				$n = '0'.$i;
			} else {
				$n = $i;
			}
			$arrBln = array ("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
			if($n==$arr[1]) { $select = "selected=\"selected\""; } else { $select = ''; }
			$bln .= '<option value="'.$n.'" '.$select.'>'.$arrBln[$i-1].'</option>';
		}
		return $bln;
	}
	
	function tahun() {
		$arr = explode("-",$this->session->userdata('periode'));
		$thn = "";
		for($i=date("Y")-5;$i<=date("Y");$i++) {
			if($i==$arr[0]) { $select = "selected=\"selected\""; } else { $select = ''; }
			$thn .= '<option value="'.$i.'" '.$select.'>'.$i.'</option>';
		}
		return $thn;
	}
	
	function view_tanggal() {
		$tgl = date('d');
		$bln = date('n') - 1;
		$thn = date('Y');
		
		return $tgl." ".$this->view_bln($bln)." ".$thn;
			
	}
	
	function view_bln($id) {
		$arrBln = array ("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
		return $arrBln[$id];	
	}
	
	function bulannya($id) {
		$arrBln = array ("01"=>"Januari","02"=>"Februari","03"=>"Maret","04"=>"April","05"=>"Mei","06"=>"Juni","07"=>"Juli","08"=>"Agustus","09"=>"September","10"=>"Oktober","11"=>"November","12"=>"Desember","1"=>"Januari","2"=>"Februari","3"=>"Maret","4"=>"April","5"=>"Mei","6"=>"Juni","7"=>"Juli","8"=>"Agustus","9"=>"September");
		return $arrBln[$id];	
	}
	
	function conversiTgl($tgl) {
		if($tgl=="") {
			return '0000-00-00';	
		} else {
			$arr = preg_split('[/]',$tgl);
			return $arr[2].'-'.$arr[1].'-'.$arr[0];	
		}
	}
	
	function conversiTglDB($tgl) {
		if($tgl=="") {
			return '';
		} else {
			$arr = preg_split('[-]',$tgl);
			return $arr[2].'/'.$arr[1].'/'.$arr[0];	
		}
	}
	
	function hak_toolbar($idmenu) {
		$group_id = $this->session->userdata('group_id');
		$r = $this->db->query("select baru,cetak,ubah,hapus,kunci_tgl from sys_hak_menu where idmenu = '".$idmenu."' and group_id = '".$group_id."'")->row();
		$txtTb = "";
		if($r->baru==1):
			$txtTb .= "tb_".$idmenu.".enableItem('new');";
		endif;
		if($r->cetak==1):
			$txtTb .= "tb_".$idmenu.".enableItem('print');";
			$txtTb .= "tb_".$idmenu.".enableItem('cari');";
			$txtTb .= "tb_".$idmenu.".enableItem('refresh');";
		endif;
		if($r->ubah==1):
			$txtTb .= "tb_".$idmenu.".enableItem('edit');";
		endif;
		if($r->hapus==1):
			$txtTb .= "tb_".$idmenu.".enableItem('del');";
		endif;
		return $txtTb;
	}
	
	function log_book($ket,$idmenu,$author) {
		$this->db->query("insert into sys_log_book (keterangan,idmenu,author) values ('$ket','$idmenu','$author')");
	}
	
	function log_delete($table,$kondisi) {	
		$data = array(
			'tabel' => $table,
			'kondisi' => $kondisi
		);
		$this->db->insert('log_delete_data', $data);
	}
	
	function insertDB($data,$table,$dataIns,$fk) {
		if($fk != 0):
			$this->db->delete($table,$fk);
			if($table=='rpt_stock'):
				$this->msistem->log_delete("rpt_stock","where notrans = '".$fk['notrans']."' and outlet_id = '".$fk['outlet_id']."' and tgl = '".$fk['tgl']."'");
			endif;
		endif;
		$arrBaris = preg_split("[~]",$data);
		foreach($arrBaris as $baris) {
			$i = 0;
			$arrData = preg_split("[`]",$baris);
			foreach($dataIns as $cols) {
				// update by Ari Karniawan 2/5/2014
				if($cols != ""):
					$rec[$cols] = $arrData[$i];
				endif;
				$i++;
			}
			if($fk != 0):
				$rec = array_merge($rec,$fk);
			endif;
			$this->db->insert($table,$rec);
		}
	}
	
	function insertDBnotDelete($data,$table,$dataIns,$fk) {
		$arrBaris = preg_split("[~]",$data);
		foreach($arrBaris as $baris) {
			$i = 0;
			$arrData = preg_split("[`]",$baris);
			foreach($dataIns as $cols) {
				// update by Ari Karniawan 2/5/2014
				if($cols != ""):
					$rec[$cols] = $arrData[$i];
				endif;
				$i++;
			}
			if($fk != 0):
				$rec = array_merge($rec,$fk);
			endif;
			$this->db->insert($table,$rec);
		}
	}
	
	/*function insertDB2($data,$table,$dataIns,$fk,$cekKolom) {
		if($fk != 0):
			$this->db->delete($table,$fk);
		endif;
		$arrBaris = preg_split("[~]",$data);
		foreach($arrBaris as $baris) {
			$i = 0;
			$arrData = preg_split("[`]",$baris);
			foreach($dataIns as $cols) {
				if($i != $cekKolom && $arrData[$i] != ""):
					$rec[$cols] = $arrData[$i];
					$i++;
				endif;
			}
			if($fk != 0):
				$rec = array_merge($rec,$fk);
			endif;
			$this->db->insert($table,$rec);
		}
	}*/	
	
	function arrayMerge($data,$field,$dataInput) {
		if($dataInput != "" && $dataInput != "null"):
			$data = array_merge($data,array($field => $dataInput));
		endif;
		return $data;
	}
	
	// update Ari Karniawan 17/4/2014 2:35pm
	function periode() {
		$r = $this->db->query("select concat(sa_thn,'-',sa_bln) as periode from sys_periode_akuntansi where active = '1'")->row();
		return $r->periode;
	}
	
	// update Ari Karniawan 17/4/2014 2:35pm
	function noTrans($kode,$table,$txtQr,$outlet_id,$tgl) {
		//$r = $this->db->query("select concat(sa_thn,'-',sa_bln) as periode from sys_periode_akuntansi where active = '1'")->row();
		$arr = explode("-",$tgl);
		$bln = $arr[1];
		$thn = $arr[0];
		$periode = $thn."-".$bln;
		$r = $this->db->query("select ifnull(max(substring_index(kdtrans,'.',1)) + 1,1) as no from $table where substring_index(tgl,'-',2) = '".$periode."' $txtQr")->row();
		$jml = $r->no;
		
		if(strlen($jml)==1) {
			$no_urut = '000'.$jml;	
		} else if(strlen($jml)==2) {
			$no_urut = '00'.$jml;
		} else if(strlen($jml)==3) {
			$no_urut = '0'.$jml;	
		} else if(strlen($jml)==4) {
			$no_urut = $jml;	
		}
		$notrans = $no_urut.'.'.$outlet_id.'-'.$kode.'.'.$bln.substr($thn,-2);
		return $notrans;
	}
	
	function noTransLabel($kode,$table,$txtQr,$outlet_id,$tgl,$tujuan) {
		//$r = $this->db->query("select concat(sa_thn,'-',sa_bln) as periode from sys_periode_akuntansi where active = '1'")->row();
		$arr = explode("-",$tgl);
		$bln = $arr[1];
		$thn = $arr[0];
		$periode = $thn."-".$bln;
		$r = $this->db->query("select ifnull(max(substring_index(kdtrans,'.',1)) + 1,1) as no from $table where substring_index(tgl,'-',2) = '".$periode."' $txtQr")->row();
		$jml = $r->no;
		
		if(strlen($jml)==1) {
			$no_urut = '000'.$jml;	
		} else if(strlen($jml)==2) {
			$no_urut = '00'.$jml;
		} else if(strlen($jml)==3) {
			$no_urut = '0'.$jml;	
		} else if(strlen($jml)==4) {
			$no_urut = $jml;	
		}
		$notrans = $no_urut.'.'.$tujuan.'-'.$kode.'.'.$bln.substr($thn,-2);
		return $notrans;
	}
	
	//Update Wawan Kurniawan 19/04/2014 (Update flag pembelian)
	function updateBeli($data,$table,$dataIns) {
		$arrBaris = preg_split("[~]",$data);
		foreach($arrBaris as $baris) {
			$i = 0;
			$arrData = preg_split("[`]",$baris);
			foreach($dataIns as $cols) {
				if($cols=='no_lpb'){
					$fk[$cols] = $arrData[$i];
				} else {
					if($arrData[$i]=='0'){
						$rec[$cols] = 0;
					} else {
						$rec[$cols] = 1;
					}
				}
				$i++;
			}
			$this->db->update($table,$rec,$fk);
		}
	}
	
	//Update Wawan Kurniawan 18/04/2014 (Insert rpt_stock)
	function insertRPT($data,$table,$dataIns,$fk,$fk2) {
		if($fk != 0):
			$this->db->delete($table,$fk);
		endif;
		$arrBaris = preg_split("[~]",$data);
		foreach($arrBaris as $baris) {
			$i = 0;
			$arrData = preg_split("[`]",$baris);
			foreach($dataIns as $cols) {
				$rec[$cols] = $arrData[$i];
				$i++;
			}
			if($fk != 0):
				$rec = array_merge($rec,$fk2,$fk);
			endif;
			$this->db->insert($table,$rec);
		}
	}
	
	// update ari 3//4/2014
	function format_angka($nilai) {
		if($nilai==0) {
			$angka = "";
		} else if($nilai < 0) {
			$nilai = trim($nilai);
			$nilai = $nilai * -1;
			$angka = '('.number_format($nilai,0,'.',',').')';
		} else {
			$nilai = trim($nilai);
			$angka = number_format($nilai,0,'.',',');
		}
		return $angka;
	}
	
	function format_uang($nilai) {
		if($nilai==0) {
			$angka = "";
		} else if($nilai < 0) {
			$nilai = trim($nilai);
			$nilai = $nilai * -1;
			$angka = '('.number_format($nilai,2,'.',',').')';
		} else {
			$nilai = trim($nilai);
			$angka = number_format($nilai,2,'.',',');
		}
		return $angka;
	}
	
	function pecahString($str) {
		$arr = str_split($str);	
		$txt = "";
		foreach($arr as $r) {
			$txt .= $r." ";	
		}
		return substr($txt,0,23);
	}
	
	 // update sepryharyandi@gmail.com 24/05/2014
    function post_header($data_post,$fk_post) {         
        $table = 'ak_jurnal';
        if ($fk_post != ""):
            $this->db->delete($table, array('no_jurnal'=>$fk_post));
        endif;
        $arec = array('tipe' => '1');
        $field = array('no_jurnal', 'tgl_jurnal', 'keterangan', 'no_ref', 'periode', 'company', 'created_by', 'created');
        $i = 0;
        foreach ($field as $f) {
            $rec[$f] = $data_post[$i];
            $i++;
        }
        $rec = array_merge($rec, $arec);
        $this->db->insert($table, $rec);
    }
    
    // update sepryharyandi@gmail.com 24/05/2014
    function post_detail($data_post,$fk_post) {
        $table = 'ak_jurnal_detail';
        if ($fk_post != ""):
            $this->db->delete($table, array('no_jurnal'=>$fk_post,'no_akun'=>$data_post[1]));
        endif;
        $field = array('no_jurnal', 'no_akun', 'debet_kredit', 'nilai');
        $i = 0;
        foreach ($field as $f) {
            $rec[$f] = $data_post[$i];
            $i++;
        }               
        if($data_post[2]=="D"){
            $arec = array('debet' => $data_post[3], 'kredit' => '0');
        } else {
            $arec = array('debet' => '0', 'kredit' => $data_post[3]);
        }
        $rec = array_merge($rec,$arec);
        $this->db->insert($table, $rec);
    }
    
    // update sepryharyandi@gmail.com 25/05/2014
    function post_details($data, $data_post,$fk_post) {
//        if($fk != 0):
//			$this->db->delete($table,$fk);
//		endif;
//		$arrBaris = preg_split("[~]",$data);
//		foreach($arrBaris as $baris) {
//			$i = 0;
//			$arrData = preg_split("[`]",$baris);
//			foreach($dataIns as $cols) {
//				// update by Ari Karniawan 2/5/2014
//				if($cols != ""):
//					$rec[$cols] = $arrData[$i];
//				endif;
//				$i++;
//			}
//			if($fk != 0):
//				$rec = array_merge($rec,$fk);
//			endif;
//			$this->db->insert($table,$rec);
//		}
        $table = 'ak_jurnal_detail';
        if ($fk_post != ""):
            $this->db->delete($table, array('no_jurnal'=>$fk_post,'no_akun'=>$data_post[1]));
        endif;
        $field = array('no_jurnal', 'no_akun', 'debet_kredit', 'nilai');
        $i = 0;
        foreach ($field as $f) {
            $rec[$f] = $data_post[$i];
            $i++;
        }               
        if($data_post[2]=="D"){
            $arec = array('debet' => $data_post[3], 'kredit' => '0');
        } else {
            $arec = array('debet' => '0', 'kredit' => $data_post[3]);
        }
        $rec = array_merge($rec,$arec);
        $this->db->insert($table, $rec);
    }
	
	function validasi_periode($tgl) {
		$arr = explode("-",$tgl);
		$now = $arr[0]."-".$arr[1];
		$periode = $this->session->userdata('periode');	
		if($now == $periode) {
			$err = "0";	
		} else {
			$err = "1";
		}
		return $err;
	}
	
	function ping() {
		$r = $this->db->query("select nilai from sys_pengaturan where id =  '4'")->row();
		$ip = $r->nilai;
		
		if (!$socket = @fsockopen($ip, 80, $errno, $errstr, 30))
		{
		  $online = 0;
		}
		else 
		{
		   $online = 1;	
		  fclose($socket);
		}	
		return $online;
	}
	
	function ulrSoap() {
		$r = $this->db->query("select nilai from sys_pengaturan where id =  '3'")->row();
		return $r->nilai;
	}
	
	function setBarcode() {
		$r = $this->db->query("select nilai from sys_pengaturan where id = '5'")->row();	
		return $r->nilai;
	}
	
	function kolomPcs() {
		$r = $this->db->query("select nilai from sys_pengaturan where id = '1'")->row();	
		return $r->nilai;
	}
	
}

?>
