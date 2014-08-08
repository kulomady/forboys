<?php

/*
 * saldo_awal.php
 * 
 * Copyright (c) 2014 
 * Sepry Haryandi <sepryharyandi@gmail.com>
 * 
 */

class saldo_awal extends SIS_Controller {
    
 function __construct() {
     parent::__construct();
 }   
 
 function index(){
     $data['hak_toolbar'] = "";
     $this->load->view("saldo_awal/akun_index",$data);
 }
 
 function kas(){
     $data['hak_toolbar'] = $this->msistem->hak_toolbar('ak72');
     $this->load->view("saldo_awal/kas_index",$data);
 }
 
 function form_kasbank(){     
     $this->load->view("saldo_awal/kas_input");
 }
 
 function form_kasbank_edit($id){
     $r = $this->db->query("select a.*,DATE_FORMAT(a.tanggal,'%d/%m/%Y') as tgl_transaksi
                    from ak_saldo_awal_kas a where a.no_transaksi = '" . $id . "'")->row();
                $data = array(
                    'txtno_transaksi' => $id,
                    'txttgl' => $r->tgl_transaksi,
                    'bank_ak72' => $r->kode_kas,
                    'txtjumlah' => $r->saldo,                  
                    'txtketerangan' => $r->keterangan,                    
                    'cbCabang_ak72' => $r->company,
                    'id' => $r->id
                );
     $this->load->view("saldo_awal/kas_input",$data);
 }
 
 function loadData_kasbank($tgl1="",$tgl2="",$no="",$ket=""){
                $tgl1_ = date('Y-m-d',strtotime($tgl1));
                $tgl2_ = date('Y-m-d',strtotime($tgl2));
                $qr = "";
		if($tgl1 != '0' && $tgl2 != '0'):
			$qr .= " and a.tanggal BETWEEN '".$tgl1_."' and '".$tgl2_."'";
		endif;
		if($no != '0'):
			$qr .= " and a.no_transaksi like '%".$no."%'";
		endif;
                if($ket != '0'):
			$qr .= " and a.keterangan like '%".$ket."%'";
		endif;
     $grid = new GridConnector($this->db->conn_id);
                $grid->render_sql("select a.*,DATE_FORMAT(a.tanggal,'%d/%m/%Y') as tgltransaksi,b.nmbank
                    from ak_saldo_awal_kas a 
                    left join ref_bank b ON a.kode_kas=b.idbank
                    WHERE a.periode='".$this->msistem->periode()."' $qr
                    "
                        ,"no_transaksi","'',no_transaksi,tgltransaksi,nmbank,saldo,keterangan");
//                &nbsp;,No Transaksi,Tgl,Kas/Bank,Jumlah,Keterangan
 }
 
 function hapus_kas(){
        $idrec = $this->input->post('id');
        $this->db->trans_begin();
        $this->db->delete("ak_saldo_awal_kas", array('no_transaksi' => $idrec));
        $this->msistem->log_book('Delete data id "' . $idrec, 'AK72', $this->session->userdata('sis_user'));
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            echo "Hapus Data Gagal";
        } else {
            $this->db->trans_commit();
            echo "Hapus Data Berhasil";
        }
 } 
 
 function cb_bank(){
     $combo = new ComboConnector($this->db->conn_id);
     $combo->render_sql("select idbank,nmbank from ref_bank order by nmbank asc", "idbank", "nmbank");
 }
 
 function cb_cabang(){
     $combo = new ComboConnector($this->db->conn_id);
     $combo->render_sql("select outlet_id,nm_outlet from master_company order by nm_outlet asc", "outlet_id", "nm_outlet");
 }
 
    function simpan_kas() {
        $tglBerlaku = $this->msistem->conversiTgl($this->input->post("txttgl"));
        $outlet = $this->session->userdata('outlet_id');
        $user = $this->session->userdata('sis_user');
        $created = date("Y-m-d H:i:s");
        $periode = $this->msistem->periode();
        $tipe = "SAK";
        $data = array(
            'tanggal' => $tglBerlaku,            
            'kode_kas' => $this->input->post('txtkasbank'),
            'saldo' => $this->input->post('txtjumlah'),
            'keterangan' => $this->input->post('txtketerangan'),
            'company' => $this->input->post('cbCabang_ak72'),
        );

        $this->db->trans_begin();
        if ($this->input->post('txtno_transaksi') == '') {
            $no_transaksi = $this->generateCode_trx($tipe);
            $data = array_merge($data, array('no_transaksi' => $no_transaksi, 'periode' => $periode, "created_by" => $user, "created" => $created));
            $this->db->insert('ak_saldo_awal_kas', $data);
            $this->msistem->log_book('Input data baru id "' . $no_transaksi, 'AK72', $user);
        } else {
            $no_transaksi = $this->input->post('txtno_transaksi');
            $data = array_merge($data, array('modified_by' => $user, "modified" => $created));
            $this->db->update('ak_saldo_awal_kas', $data, array('no_transaksi' => $no_transaksi));
            $this->msistem->log_book('Update data id "' . $no_transaksi, 'AK72', $user);
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            echo "0";
        } else {
            $this->db->trans_commit();
            echo $no_transaksi;
        }
    }
    
    function generateCode_trx($type) {
        $r = $this->db->query("select MAX(SUBSTRING(no_transaksi,-3)) as codemax from ak_saldo_awal_kas WHERE SUBSTR(no_transaksi,1,3)='" . $type . "'")->row();
        $no = $r->codemax + 1;
        if (strlen($no) == 1) {
            $txtNo = '00' . $no;
        } elseif (strlen($no) == 2) {
            $txtNo = '00' . $no;
        } elseif (strlen($no) == 3) {
            $txtNo = $no;
        }
        return $type . $txtNo;
    }
    
    
    function hutang() {
        $data['hak_toolbar'] = $this->msistem->hak_toolbar('ak73');
        $this->load->view("saldo_awal/hutang_index", $data);
    }
    
     function form_hutang() {
        $this->load->view("saldo_awal/hutang_input");
    }

    function form_hutang_edit($id) {
        $r = $this->db->query("select a.*,DATE_FORMAT(a.tanggal,'%d/%m/%Y') as tgl_transaksi,DATE_FORMAT(a.tgl_jatuh_tempo,'%d/%m/%Y') as tgljt,b.nmrekan,c.nmperkiraan
                    from ak_saldo_awal_hutang a 
                    left join master_rekan_bisnis b on a.supplier=b.idrekan
                    left join ak_master_perkiraan c on a.kode_akun=c.idperkiraan
                    where a.no_transaksi = '" . $id . "'")->row();
        $data = array(
            'txtno_transaksi' => $id,
            'txtsupplier' => $r->supplier,
            'tmpsupplier' => $r->nmrekan,
            'txttgl' => $r->tgl_transaksi,
            'txtnopembelian' => $r->no_pembelian,
            'txtjatuhtempo' => $r->tgljt,
            'txtjumlah' => $r->saldo,
            'txtketerangan' => $r->keterangan,
            'txtnoakun' => $r->kode_akun,
            'tmpakun' => $r->nmperkiraan,
            'cbCabang_ak73' => $r->company,
            'id' => $r->id
        );
        $this->load->view("saldo_awal/hutang_input", $data);
    }
    
    function loadData_supplier(){
        $grid = new GridConnector($this->db->conn_id);
        $grid->render_sql("select a.idrekan,a.nmrekan,a.idperkiraan,b.nmperkiraan
            from master_rekan_bisnis a
            left join ak_master_perkiraan b on a.idperkiraan=b.idperkiraan
            where idtipe_rekan = '2'","id","idrekan,nmrekan,idperkiraan,nmperkiraan");	
    }
    
     function simpan_hutang() {
        $tgl = $this->msistem->conversiTgl($this->input->post("txttgl"));
        $tgljt = $this->msistem->conversiTgl($this->input->post("txtjatuhtempo"));
        $outlet = $this->input->post('cbCabang_ak73');
        $user = $this->session->userdata('sis_user');
        $created = date("Y-m-d H:i:s");
        $periode = $this->msistem->periode();
        $tipe = "SAH";
        $data = array(
            'no_pembelian' => $this->input->post('txtnopembelian'),            
            'supplier' => $this->input->post('txtsupplier'),
            'tanggal' => $tgl,
            'tgl_jatuh_tempo' => $tgljt,
            'saldo' => $this->input->post('txtjumlah'),
            'keterangan' => $this->input->post('txtketerangan'),
            'kode_akun' => $this->input->post('txtnoakun'),           
            'company' => $outlet
        );

        $this->db->trans_begin();
        if ($this->input->post('txtno_transaksi') == '') { 
            $no_transaksi = $this->generateCode_hutang($tipe);
            $data = array_merge($data, array('no_transaksi' => $no_transaksi, 'periode' => $periode, "created_by" => $user, "created" => $created));
            $this->db->insert('ak_saldo_awal_hutang', $data);
            $this->msistem->log_book('Input data baru id "' . $no_transaksi, 'AK73', $user);
        } else {
            $no_transaksi = $this->input->post('txtno_transaksi');
            $data = array_merge($data, array('modified_by' => $user, "modified" => $created));
            $this->db->update('ak_saldo_awal_hutang', $data, array('no_transaksi' => $no_transaksi));
            $this->msistem->log_book('Update data id "' . $no_transaksi, 'AK73', $user);
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            echo "0";
        } else {
            $this->db->trans_commit();
            echo $no_transaksi;
        }
    }
    
     function generateCode_hutang($type) {		
		$r = $this->db->query("select MAX(SUBSTRING(no_transaksi,-3)) as codemax from ak_saldo_awal_hutang WHERE SUBSTR(no_transaksi,1,3)='".$type."'")->row();
		$no = $r->codemax + 1;
		if(strlen($no)==1) {
			$txtNo = '00'.$no;
		} elseif(strlen($no)==2) {
			$txtNo = '00'.$no;
		} elseif(strlen($no)==3) {
			$txtNo = $no;
		}
		return $type.$txtNo;
	}
        
    function loadData_hutang($tgl1="",$tgl2="",$no="",$sup="",$ket="") {
         $tgl1_ = date('Y-m-d',strtotime($tgl1));
                $tgl2_ = date('Y-m-d',strtotime($tgl2));
                $qr = "";
		if($tgl1 != '0' && $tgl2 != '0'):
			$qr .= " and a.tanggal BETWEEN '".$tgl1_."' and '".$tgl2_."'";
		endif;
		if($no != '0'):
			$qr .= " and a.no_transaksi like '%".$no."%'";
		endif;
                if($ket != '0'):
			$qr .= " and a.keterangan like '%".$ket."%'";
		endif;
                if($sup != '0'):
			$qr .= " and b.nmrekan like '%".$sup."%'";
		endif;
        $grid = new GridConnector($this->db->conn_id);
                $grid->render_sql("select a.*,DATE_FORMAT(a.tanggal,'%d/%m/%Y') as tgl,DATE_FORMAT(a.tgl_jatuh_tempo,'%d/%m/%Y') as tgljt,b.nmrekan
                    from ak_saldo_awal_hutang a 
                    left join master_rekan_bisnis b ON a.supplier=b.idrekan
                    WHERE a.no_transaksi IS NOT NULL $qr
                    "
                        ,"id","'',no_transaksi,nmrekan,tgl,no_pembelian,tgljt,saldo,keterangan");
//&nbsp;,No Transaksi,Supplier,Tgl,No Pembelian,Jatuh Tempo,Saldo,Keterangan
    }
    
    function hapus_hutang(){
        $idrec = $this->input->post('id');
        $this->db->trans_begin();
        $this->db->delete("ak_saldo_awal_hutang", array('no_transaksi' => $idrec));
        $this->msistem->log_book('Delete data id "' . $idrec, 'AK73', $this->session->userdata('sis_user'));
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            echo "Hapus Data Gagal";
        } else {
            $this->db->trans_commit();
            echo "Hapus Data Berhasil";
        }
 }
 
 
 function piutang() {
        $data['hak_toolbar'] = $this->msistem->hak_toolbar('ak74');
        $this->load->view("saldo_awal/piutang_index", $data);
    }
    
  function form_piutang() {
        $this->load->view("saldo_awal/piutang_input");
  }
  
  function form_piutang_edit($id) {
    $r = $this->db->query("select a.*,DATE_FORMAT(a.tanggal,'%d/%m/%Y') as tgl_transaksi,DATE_FORMAT(a.tgl_jatuh_tempo,'%d/%m/%Y') as tgljt,b.nmrekan,c.nmperkiraan
                from ak_saldo_awal_piutang a 
                left join master_rekan_bisnis b on a.customer=b.idrekan
                left join ak_master_perkiraan c on a.kode_akun=c.idperkiraan
                where a.no_transaksi = '" . $id . "'")->row();
    $data = array(
        'txtno_transaksi' => $id,
        'txtcustomer' => $r->customer,
        'tmpcustomer' => $r->nmrekan,
        'txttgl' => $r->tgl_transaksi,
        'txtnopenjualan' => $r->no_penjualan,
        'txtjatuhtempo' => $r->tgljt,
        'txtjumlah' => $r->saldo,
        'txtketerangan' => $r->keterangan,
        'txtnoakun' => $r->kode_akun,
        'tmpakun' => $r->nmperkiraan,
        'cbCabang_ak74' => $r->company,
        'id' => $r->id
    );
    $this->load->view("saldo_awal/piutang_input", $data);
  }
  
  function loadData_customer(){
        $grid = new GridConnector($this->db->conn_id);
        $grid->render_sql("select a.idrekan,a.nmrekan,a.idperkiraan,b.nmperkiraan
            from master_rekan_bisnis a
            left join ak_master_perkiraan b on a.idperkiraan=b.idperkiraan
            where idtipe_rekan = '1'","id","idrekan,nmrekan,idperkiraan,nmperkiraan");	
    }
    
    function loadData_piutang($tgl1="",$tgl2="",$no="",$cus="",$ket="") {
        $tgl1_ = date('Y-m-d',strtotime($tgl1));
                $tgl2_ = date('Y-m-d',strtotime($tgl2));
                $qr = "";
		if($tgl1 != '0' && $tgl2 != '0'):
			$qr .= " and a.tanggal BETWEEN '".$tgl1_."' and '".$tgl2_."'";
		endif;
		if($no != '0'):
			$qr .= " and a.no_transaksi like '%".$no."%'";
		endif;
                if($ket != '0'):
			$qr .= " and a.keterangan like '%".$ket."%'";
		endif;
                if($cus != '0'):
			$qr .= " and b.nmrekan like '%".$cus."%'";
		endif;
        $grid = new GridConnector($this->db->conn_id);
                $grid->render_sql("select a.*,DATE_FORMAT(a.tanggal,'%d/%m/%Y') as tgl,DATE_FORMAT(a.tgl_jatuh_tempo,'%d/%m/%Y') as tgljt,b.nmrekan
                    from ak_saldo_awal_piutang a 
                    left join master_rekan_bisnis b ON a.customer=b.idrekan
                    WHERE a.no_transaksi IS NOT NULL $qr
                    "
                        ,"id","'',no_transaksi,nmrekan,tgl,no_penjualan,tgljt,saldo,keterangan");
    }
    
    
    function simpan_piutang() {
        $tgl = $this->msistem->conversiTgl($this->input->post("txttgl"));
        $tgljt = $this->msistem->conversiTgl($this->input->post("txtjatuhtempo"));
        $outlet = $this->input->post('cbCabang_ak74');
        $user = $this->session->userdata('sis_user');
        $created = date("Y-m-d H:i:s");
        $periode = $this->msistem->periode();
        $tipe = "SAP";
        $data = array(
            'no_penjualan' => $this->input->post('txtnopenjualan'),            
            'customer' => $this->input->post('txtcustomer'),
            'tanggal' => $tgl,
            'tgl_jatuh_tempo' => $tgljt,
            'saldo' => $this->input->post('txtjumlah'),
            'keterangan' => $this->input->post('txtketerangan'),
            'kode_akun' => $this->input->post('txtnoakun'),
            'company' => $outlet
        );

        $this->db->trans_begin();
        if ($this->input->post('txtno_transaksi') == '') { 
            $no_transaksi = $this->generateCode_piutang($tipe);
            $data = array_merge($data, array('no_transaksi' => $no_transaksi, 'periode' => $periode, "created_by" => $user, "created" => $created));
            $this->db->insert('ak_saldo_awal_piutang', $data);
            $this->msistem->log_book('Input data baru id "' . $no_transaksi, 'AK74', $user);
        } else {
            $no_transaksi = $this->input->post('txtno_transaksi');
            $data = array_merge($data, array('modified_by' => $user, "modified" => $created));
            $this->db->update('ak_saldo_awal_piutang', $data, array('no_transaksi' => $no_transaksi));
            $this->msistem->log_book('Update data id "' . $no_transaksi, 'AK74', $user);
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            echo "0";
        } else {
            $this->db->trans_commit();
            echo $no_transaksi;
        }
    }
    
    
    function generateCode_piutang($type) {		
		$r = $this->db->query("select MAX(SUBSTRING(no_transaksi,-3)) as codemax from ak_saldo_awal_piutang WHERE SUBSTR(no_transaksi,1,3)='".$type."'")->row();
		$no = $r->codemax + 1;
		if(strlen($no)==1) {
			$txtNo = '00'.$no;
		} elseif(strlen($no)==2) {
			$txtNo = '00'.$no;
		} elseif(strlen($no)==3) {
			$txtNo = $no;
		}
		return $type.$txtNo;
	}
        
    function hapus_piutang(){
        $idrec = $this->input->post('id');
        $this->db->trans_begin();
        $this->db->delete("ak_saldo_awal_piutang", array('no_transaksi' => $idrec));
        $this->msistem->log_book('Delete data id "' . $idrec, 'AK74', $this->session->userdata('sis_user'));
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            echo "Hapus Data Gagal";
        } else {
            $this->db->trans_commit();
            echo "Hapus Data Berhasil";
        }
 }
 
 function loadData_akun_aktiva(){
     $grid = new GridConnector($this->db->conn_id);
                $grid->render_sql("select a.id,a.idperkiraan,a.nmperkiraan,IFNULL(b.saldo,0) as saldonya
                    from ak_master_perkiraan a 
                    left join ak_saldo_awal_akun b ON a.idperkiraan=b.idperkiraan
                    left join ak_master_kelompok_perkiraan c ON a.idkelompok_perkiraan=c.idkelompok_perkiraan
                    left join ak_saldo_awal_piutang d on a.idperkiraan=d.kode_akun										
                    left join view_akun_bank e on a.idperkiraan=e.idperkiraan										
                    where a.tipe_perkiraan='D' AND a.induk_perkiraan!='0' AND (a.idkelompok_perkiraan='1-0000')
                    group by a.idperkiraan
                    order by a.idperkiraan ASC
                    ","id","idperkiraan,nmperkiraan,'',saldonya");
//    $grid->render_sql("select a.id,a.idperkiraan,a.nmperkiraan,IF(b.saldo=0,IFNULL(sum(d.saldo),ifnull(sum(e.saldo),0)),b.saldo) as saldonya
//                    from ak_master_perkiraan a 
//                    left join ak_saldo_awal_akun b ON a.idperkiraan=b.idperkiraan
//                    left join ak_master_kelompok_perkiraan c ON a.idkelompok_perkiraan=c.idkelompok_perkiraan
//                    left join ak_saldo_awal_piutang d on a.idperkiraan=d.kode_akun										
//                    left join view_akun_bank e on a.idperkiraan=e.idperkiraan										
//                    where a.tipe_perkiraan='D' AND a.induk_perkiraan!='0' AND (a.idkelompok_perkiraan='1-0000')
//                    group by a.idperkiraan
//                    order by a.idperkiraan ASC
//                    ","id","idperkiraan,nmperkiraan,'',saldonya");
 }
 
 function loadData_akun_modal_kewajiban(){
    $grid = new GridConnector($this->db->conn_id);
    $grid->render_sql("select a.id,a.idperkiraan,a.nmperkiraan,IFNULL(b.saldo,0) as saldonya
        from ak_master_perkiraan a 
        left join ak_saldo_awal_akun b ON a.idperkiraan=b.idperkiraan
        left join ak_master_kelompok_perkiraan c ON a.idkelompok_perkiraan=c.idkelompok_perkiraan
        left join ak_saldo_awal_hutang d ON a.idperkiraan=d.kode_akun
        where a.tipe_perkiraan='D' AND a.induk_perkiraan!='0' AND (a.idkelompok_perkiraan='2-0000' OR a.idkelompok_perkiraan='3-0000') AND a.is_active='1'
        GROUP BY a.idperkiraan
        order by a.idperkiraan ASC
        ","id","idperkiraan,nmperkiraan,'',saldonya");
//      $grid->render_sql("select a.id,a.idperkiraan,a.nmperkiraan,IF(b.saldo=0,IFNULL(sum(d.saldo),0),b.saldo) as saldonya
//                    from ak_master_perkiraan a 
//                    left join ak_saldo_awal_akun b ON a.idperkiraan=b.idperkiraan
//                    left join ak_master_kelompok_perkiraan c ON a.idkelompok_perkiraan=c.idkelompok_perkiraan
//                    left join ak_saldo_awal_hutang d ON a.idperkiraan=d.kode_akun
//                    where a.tipe_perkiraan='D' AND a.induk_perkiraan!='0' AND (a.idkelompok_perkiraan='2-0000' OR a.idkelompok_perkiraan='3-0000')
//                    GROUP BY a.idperkiraan
//                    order by a.idperkiraan ASC
//                    ","id","idperkiraan,nmperkiraan,'',saldonya");
 }
 
 function simpan_akun(){    
        $periode = $this->msistem->periode();
        $company = $this->session->userdata('outlet_id');
        $dataaktiva = $this->input->post('dataaktiva');
        $datakm = $this->input->post('datakm');
        $table = 'ak_saldo_awal_akun';
        $dataIns = array('idperkiraan', 'mata_uang', 'saldo');
        $fk = array('periode'=>$periode,'company'=>$company);
        //$tk = array('periode'=>$periode,'company'=>$company);
        $this->msistem->insertDB($dataaktiva, $table, $dataIns, $fk);
//        $thisistem->insertDB($datakm, $table, $dataIns, $fk, $tk);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            echo "0";
        } else {
            $this->db->trans_commit();
            echo "1";
        }
 }
 
 function insertDB($data, $table, $dataIns, $fk, $tk) {
        $arrBaris = preg_split("[~]", $data);
        foreach ($arrBaris as $baris) {
            $i = 0;
            $arrData = preg_split("[`]", $baris);
            foreach ($dataIns as $cols) {                
                if ($cols != ""):
                    $rec[$cols] = $arrData[$i];
                    
                    $rec1[$cols][0] = $arrData[0];
                    $rec1 = array_merge($rec1, $tk);    
                    $this->db->delete($table, $rec1);
                endif;
                $i++;
            }
            if ($tk != 0):                
                $rec = array_merge($rec, $tk);
            endif;
            $this->db->insert($table, $rec);
        }
    }
    
}