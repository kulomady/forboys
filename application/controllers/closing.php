<?php

/*
 * closing.php
 * 
 * Copyright (c) 2014 
 * Sepry Haryandi <sepryharyandi@gmail.com>
 * 
 */

class Closing extends SIS_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        $data['bulan'] = $this->msistem->bulan();
        $data['tahun'] = $this->msistem->tahun();
        $this->load->view('closing/closing_bulanan', $data);
    }

    public function tahunan() {
        $data['bulan'] = $this->msistem->bulan();
        $data['tahun'] = $this->msistem->tahun();
        $this->load->view('closing/closing_tahunan', $data);
    }

    function exe_closing_bulanan() {
        $bulan = $this->input->post("txtbln");
        $tahun = $this->input->post("txtthn");
        $periode = $tahun . "-" . $bulan;
        $company = $this->session->userdata('outlet_id');
        $user = $this->session->userdata('sis_user');
        $sqlperiode = $this->db->query("SELECT * FROM sys_periode_akuntansi WHERE sa_bln='" . $bulan . "' AND sa_thn='" . $tahun . "'")->row();
        $sqlakun = $this->db->query("SELECT * FROM ak_master_perkiraan WHERE tipe_perkiraan='D' AND is_active='1'");
        $sqlcompany = $this->db->query("SELECT * FROM master_company WHERE outlet_id='".$company."'")->row();
        foreach ($sqlakun->result() as $akr) {
            $this->db->delete("ak_neraca_saldo", array('periode' => $periode, 'idperkiraan' => $akr->idperkiraan, 'company' => $company));
            $sql = $this->db->query("SELECT jd.*,j.*,DATE_FORMAT(j.tgl_jurnal,'%d-%m-%Y') as tgl_jurnal_
                                    FROM ak_jurnal_detail jd
                                    LEFT JOIN ak_jurnal j ON jd.no_jurnal=j.no_jurnal
                                    WHERE jd.no_akun='$akr->idperkiraan' AND j.periode='" . $periode . "' AND j.company='" . $company . "'");
            $jurnal = $sql->result();

            $saldonya = 0;
            $saldo = $this->db->query("SELECT IFNULL(sum(saldo),0) as saldonya FROM ak_saldo_awal_akun WHERE idperkiraan='" . $akr->idperkiraan . "' AND periode='" . $periode . "' AND company='" . $company . "'")->row();
            $saldonya = ($saldo->saldonya == "0") ? "0" : $saldo->saldonya;
            
            // insert saldo awal ke neraca
//            $this->db->delete("ak_neraca_saldo", array('periode' => $periode, 'idperkiraan' => $akr->idperkiraan, 'company' => $company, 'tgl' => $sqlperiode->bln_thn_mulai, 'dk' => $j->debet_kredit));
            $hasil = $this->db->insert("ak_neraca_saldo", array('periode' => $periode, 'tgl' => $sqlperiode->bln_thn_mulai, 'idperkiraan' => $akr->idperkiraan, 'dk' => $akr->saldo_normal, 'saldo' => $saldonya, 'company' => $company, 'created_by' => $user, 'created' => date('Y-m-d H:i:s')));
                
            $debet = 0;
            $kredit = 0;
            
            // insert jurnal ke neraca
            foreach ($jurnal as $j) {
//                $this->db->delete("ak_neraca_saldo", array('periode' => $periode, 'idperkiraan' => $akr->idperkiraan, 'company' => $company, 'tgl' => $j->tgl_jurnal, 'dk' => $j->debet_kredit));
                $hasil = $this->db->insert("ak_neraca_saldo", array('periode' => $periode, 'tgl' => $j->tgl_jurnal, 'idperkiraan' => $akr->idperkiraan, 'dk' => $j->debet_kredit, 'saldo' => $j->nilai, 'company' => $company, 'created_by' => $user, 'created' => date('Y-m-d H:i:s')));
            }           

        }
        
        
        // buat periode baru
        $sqlcekperiode = $this->db->query("SELECT * FROM sys_periode_akuntansi WHERE sa_bln='" . $bulan . "'+1 AND sa_thn='" . $tahun . "'");
        $periode_baru = "";
        if ($sqlcekperiode->num_rows() == 0) {
            $blnnya = $bulan + 1;
            $blnthn = $tahun . "-" . $blnnya . "-" . "01";
            $this->db->insert("sys_periode_akuntansi", array("sa_bln" => '0' . $blnnya, "sa_thn" => $tahun, "bulan_akhir" => '0' . $blnnya, "bln_thn_mulai" => $blnthn, "active" => "0"));
            $periode_baru = $tahun."-".'0'.$blnnya;
        } else {
            $res_cek_periode = $sqlcekperiode->row();
            $periode_baru = $res_cek_periode->sa_thn."-".$res_cek_periode->sa_bln;
        }
        
        // hitung laba rugi
        $saldonya_laba_rugi = $this->hitung_laba_rugi($company, $periode);
        $this->db->delete("ak_neraca_saldo", array('periode' => $periode_baru, 'idperkiraan' => $sqlcompany->la_laba_ditahan, 'company' => $company, 'tgl' => date("Y-m-t", strtotime($sqlperiode->bln_thn_mulai))));
        $hasil = $this->db->insert("ak_neraca_saldo", array('periode' => $periode_baru, 'tgl' => date("Y-m-t", strtotime($sqlperiode->bln_thn_mulai)), 'idperkiraan' => $sqlcompany->la_laba_ditahan, 'dk' => 'K', 'saldo' => $saldonya_laba_rugi, 'company' => $company, 'created_by' => $user, 'created' => date('Y-m-d H:i:s')));
        
        $this->hitung_saldo_awal_next($company, $periode, $periode_baru);

    }

    function hitung_laba_rugi($company, $periode) {        
        // akun 4
        $query_kelompok_perkiraan = $this->db->query("SELECT * FROM ak_master_kelompok_perkiraan WHERE idkelompok_perkiraan LIKE '%4%'");
        $total_saldo_4 = 0;
        $total_saldo_akun_4 = 0;
        $total_saldo_all_4 = 0;
        foreach ($query_kelompok_perkiraan->result() as $reskp) {
            $query_header_perkiraan = $this->db->query("SELECT * FROM ak_master_perkiraan WHERE induk_perkiraan='" . $reskp->idkelompok_perkiraan . "'");
            foreach ($query_header_perkiraan->result() as $reshp) {
                $query_detail_perkiraan = $this->db->query("SELECT * FROM ak_master_perkiraan WHERE induk_perkiraan='" . $reshp->idperkiraan . "'");
                $query_laba_rugi_detail = $this->db->query("SELECT a.*,IFNULL(SUM(a.nilai),0) as saldo
                                                        FROM view_jurnal a
                                                        LEFT JOIN ak_master_perkiraan b ON a.no_akun=b.idperkiraan
                                                        LEFT JOIN ak_master_kelompok_perkiraan c ON b.idkelompok_perkiraan=c.idkelompok_perkiraan
                                                        WHERE a.periode='" . $periode . "' AND a.company='" . $company . "' AND a.no_akun='" . $reshp->idperkiraan . "'
                                                        GROUP BY a.no_akun    
                                                        ");
                $qlrd_row = $query_laba_rugi_detail->num_rows();
                $qlrd = $query_laba_rugi_detail->row();
                if ($qlrd_row > 0) {
                    if ($qlrd->saldo != 0) {
                        $total_saldo_4 = $qlrd->saldo;                        
                    } else {
                        $total_saldo_4 = '0';                        
                    }
                } else {
                    $total_saldo_4 = '';                   
                }
                $total_saldo_akun_4 += $total_saldo_4;

                foreach ($query_detail_perkiraan->result() as $resdp) {
                        $query_laba_rugi_detail = $this->db->query("SELECT a.*,IFNULL(SUM(a.nilai),0) as saldo
                                                        FROM view_jurnal a
                                                        LEFT JOIN ak_master_perkiraan b ON a.no_akun=b.idperkiraan
                                                        LEFT JOIN ak_master_kelompok_perkiraan c ON b.idkelompok_perkiraan=c.idkelompok_perkiraan
                                                        WHERE a.periode='" . $periode . "' AND a.company='" . $company . "' AND a.no_akun='" . $resdp->idperkiraan . "'
                                                        GROUP BY a.no_akun    
                                                        ");
                        $qlrd_row = $query_laba_rugi_detail->num_rows();
                        $qlrd = $query_laba_rugi_detail->row();
                        if ($qlrd_row > 0) {
                            if ($qlrd->saldo != 0) {
                                $total_saldo_4 = $qlrd->saldo;                                
                            } else {
                                $total_saldo_4 = '0';                                
                            }
                        } else {
                            $total_saldo_4 = '0';                            
                        }
                        $total_saldo_akun_4 += $total_saldo_4; 
                }
            }
        }
        $total_saldo_all_4 += $total_saldo_akun_4;
        
        // akun 5
        $query_kelompok_perkiraan = $this->db->query("SELECT * FROM ak_master_kelompok_perkiraan WHERE idkelompok_perkiraan LIKE '%5%'");
        $total_saldo_5 = 0;
        $total_saldo_akun_5 = 0;
        $total_saldo_all_5 = 0;
        foreach ($query_kelompok_perkiraan->result() as $reskp) {
            $query_header_perkiraan = $this->db->query("SELECT * FROM ak_master_perkiraan WHERE induk_perkiraan='" . $reskp->idkelompok_perkiraan . "'");
            foreach ($query_header_perkiraan->result() as $reshp) {
                $query_detail_perkiraan = $this->db->query("SELECT * FROM ak_master_perkiraan WHERE induk_perkiraan='" . $reshp->idperkiraan . "'");
                $query_laba_rugi_detail = $this->db->query("SELECT a.*,IFNULL(SUM(a.nilai),0) as saldo
                                                        FROM view_jurnal a
                                                        LEFT JOIN ak_master_perkiraan b ON a.no_akun=b.idperkiraan
                                                        LEFT JOIN ak_master_kelompok_perkiraan c ON b.idkelompok_perkiraan=c.idkelompok_perkiraan
                                                        WHERE a.periode='" . $periode . "' AND a.company='" . $company . "' AND a.no_akun='" . $reshp->idperkiraan . "'
                                                        GROUP BY a.no_akun    
                                                        ");
                $qlrd_row = $query_laba_rugi_detail->num_rows();
                $qlrd = $query_laba_rugi_detail->row();
                if ($qlrd_row > 0) {
                    if ($qlrd->saldo != 0) {
                        $total_saldo_5 = $qlrd->saldo;                        
                    } else {
                        $total_saldo_5 = '0';                        
                    }
                } else {
                    $total_saldo_5 = '';                   
                }
                $total_saldo_akun_5 += $total_saldo_5;

                foreach ($query_detail_perkiraan->result() as $resdp) {
                        $query_laba_rugi_detail = $this->db->query("SELECT a.*,IFNULL(SUM(a.nilai),0) as saldo
                                                        FROM view_jurnal a
                                                        LEFT JOIN ak_master_perkiraan b ON a.no_akun=b.idperkiraan
                                                        LEFT JOIN ak_master_kelompok_perkiraan c ON b.idkelompok_perkiraan=c.idkelompok_perkiraan
                                                        WHERE a.periode='" . $periode . "' AND a.company='" . $company . "' AND a.no_akun='" . $resdp->idperkiraan . "'
                                                        GROUP BY a.no_akun    
                                                        ");
                        $qlrd_row = $query_laba_rugi_detail->num_rows();
                        $qlrd = $query_laba_rugi_detail->row();
                        if ($qlrd_row > 0) {
                            if ($qlrd->saldo != 0) {
                                $total_saldo_5 = $qlrd->saldo;                                
                            } else {
                                $total_saldo_5 = '0';                                
                            }
                        } else {
                            $total_saldo_5 = '0';                            
                        }
                        $total_saldo_akun_5 += $total_saldo_5; 
                }
            }
        }
        $total_saldo_all_5 += $total_saldo_akun_5;
        
        
        // akun 6
        $query_kelompok_perkiraan = $this->db->query("SELECT * FROM ak_master_kelompok_perkiraan WHERE idkelompok_perkiraan LIKE '%6%'");
        $total_saldo_6 = 0;
        $total_saldo_akun_6 = 0;
        $total_saldo_all_6 = 0;
        foreach ($query_kelompok_perkiraan->result() as $reskp) {
            $query_header_perkiraan = $this->db->query("SELECT * FROM ak_master_perkiraan WHERE induk_perkiraan='" . $reskp->idkelompok_perkiraan . "'");
            foreach ($query_header_perkiraan->result() as $reshp) {
                $query_detail_perkiraan = $this->db->query("SELECT * FROM ak_master_perkiraan WHERE induk_perkiraan='" . $reshp->idperkiraan . "'");
                $query_laba_rugi_detail = $this->db->query("SELECT a.*,IFNULL(SUM(a.nilai),0) as saldo
                                                        FROM view_jurnal a
                                                        LEFT JOIN ak_master_perkiraan b ON a.no_akun=b.idperkiraan
                                                        LEFT JOIN ak_master_kelompok_perkiraan c ON b.idkelompok_perkiraan=c.idkelompok_perkiraan
                                                        WHERE a.periode='" . $periode . "' AND a.company='" . $company . "' AND a.no_akun='" . $reshp->idperkiraan . "'
                                                        GROUP BY a.no_akun    
                                                        ");
                $qlrd_row = $query_laba_rugi_detail->num_rows();
                $qlrd = $query_laba_rugi_detail->row();
                if ($qlrd_row > 0) {
                    if ($qlrd->saldo != 0) {
                        $total_saldo_6 = $qlrd->saldo;                        
                    } else {
                        $total_saldo_6 = '0';                        
                    }
                } else {
                    $total_saldo_6 = '';                   
                }
                $total_saldo_akun_6 += $total_saldo_6;

                foreach ($query_detail_perkiraan->result() as $resdp) {
                        $query_laba_rugi_detail = $this->db->query("SELECT a.*,IFNULL(SUM(a.nilai),0) as saldo
                                                        FROM view_jurnal a
                                                        LEFT JOIN ak_master_perkiraan b ON a.no_akun=b.idperkiraan
                                                        LEFT JOIN ak_master_kelompok_perkiraan c ON b.idkelompok_perkiraan=c.idkelompok_perkiraan
                                                        WHERE a.periode='" . $periode . "' AND a.company='" . $company . "' AND a.no_akun='" . $resdp->idperkiraan . "'
                                                        GROUP BY a.no_akun    
                                                        ");
                        $qlrd_row = $query_laba_rugi_detail->num_rows();
                        $qlrd = $query_laba_rugi_detail->row();
                        if ($qlrd_row > 0) {
                            if ($qlrd->saldo != 0) {
                                $total_saldo_6 = $qlrd->saldo;                                
                            } else {
                                $total_saldo_6 = '0';                                
                            }
                        } else {
                            $total_saldo_6 = '0';                            
                        }
                        $total_saldo_akun_6 += $total_saldo_6; 
                }
            }
        }
        $total_saldo_all_6 += $total_saldo_akun_6;
        
        // akun 7
        $query_kelompok_perkiraan = $this->db->query("SELECT * FROM ak_master_kelompok_perkiraan WHERE idkelompok_perkiraan LIKE '%7%'");
        $total_saldo_7 = 0;
        $total_saldo_akun_7 = 0;
        $total_saldo_all_7 = 0;
        foreach ($query_kelompok_perkiraan->result() as $reskp) {
            $query_header_perkiraan = $this->db->query("SELECT * FROM ak_master_perkiraan WHERE induk_perkiraan='" . $reskp->idkelompok_perkiraan . "'");
            foreach ($query_header_perkiraan->result() as $reshp) {
                $query_detail_perkiraan = $this->db->query("SELECT * FROM ak_master_perkiraan WHERE induk_perkiraan='" . $reshp->idperkiraan . "'");
                $query_laba_rugi_detail = $this->db->query("SELECT a.*,IFNULL(SUM(a.nilai),0) as saldo
                                                        FROM view_jurnal a
                                                        LEFT JOIN ak_master_perkiraan b ON a.no_akun=b.idperkiraan
                                                        LEFT JOIN ak_master_kelompok_perkiraan c ON b.idkelompok_perkiraan=c.idkelompok_perkiraan
                                                        WHERE a.periode='" . $periode . "' AND a.company='" . $company . "' AND a.no_akun='" . $reshp->idperkiraan . "'
                                                        GROUP BY a.no_akun    
                                                        ");
                $qlrd_row = $query_laba_rugi_detail->num_rows();
                $qlrd = $query_laba_rugi_detail->row();
                if ($qlrd_row > 0) {
                    if ($qlrd->saldo != 0) {
                        $total_saldo_7 = $qlrd->saldo;                        
                    } else {
                        $total_saldo_7 = '0';                        
                    }
                } else {
                    $total_saldo_7 = '';                   
                }
                $total_saldo_akun_7 += $total_saldo_7;

                foreach ($query_detail_perkiraan->result() as $resdp) {
                        $query_laba_rugi_detail = $this->db->query("SELECT a.*,IFNULL(SUM(a.nilai),0) as saldo
                                                        FROM view_jurnal a
                                                        LEFT JOIN ak_master_perkiraan b ON a.no_akun=b.idperkiraan
                                                        LEFT JOIN ak_master_kelompok_perkiraan c ON b.idkelompok_perkiraan=c.idkelompok_perkiraan
                                                        WHERE a.periode='" . $periode . "' AND a.company='" . $company . "' AND a.no_akun='" . $resdp->idperkiraan . "'
                                                        GROUP BY a.no_akun    
                                                        ");
                        $qlrd_row = $query_laba_rugi_detail->num_rows();
                        $qlrd = $query_laba_rugi_detail->row();
                        if ($qlrd_row > 0) {
                            if ($qlrd->saldo != 0) {
                                $total_saldo_7 = $qlrd->saldo;                                
                            } else {
                                $total_saldo_7 = '0';                                
                            }
                        } else {
                            $total_saldo_7 = '0';                            
                        }
                        $total_saldo_akun_7 += $total_saldo_7; 
                }
            }
        }
        $total_saldo_all_7 += $total_saldo_akun_7;
        
        // akun 8
        $query_kelompok_perkiraan = $this->db->query("SELECT * FROM ak_master_kelompok_perkiraan WHERE idkelompok_perkiraan LIKE '%8%'");
        $total_saldo_8 = 0;
        $total_saldo_akun_8 = 0;
        $total_saldo_all_8 = 0;
        foreach ($query_kelompok_perkiraan->result() as $reskp) {
            $query_header_perkiraan = $this->db->query("SELECT * FROM ak_master_perkiraan WHERE induk_perkiraan='" . $reskp->idkelompok_perkiraan . "'");
            foreach ($query_header_perkiraan->result() as $reshp) {
                $query_detail_perkiraan = $this->db->query("SELECT * FROM ak_master_perkiraan WHERE induk_perkiraan='" . $reshp->idperkiraan . "'");
                $query_laba_rugi_detail = $this->db->query("SELECT a.*,IFNULL(SUM(a.nilai),0) as saldo
                                                        FROM view_jurnal a
                                                        LEFT JOIN ak_master_perkiraan b ON a.no_akun=b.idperkiraan
                                                        LEFT JOIN ak_master_kelompok_perkiraan c ON b.idkelompok_perkiraan=c.idkelompok_perkiraan
                                                        WHERE a.periode='" . $periode . "' AND a.company='" . $company . "' AND a.no_akun='" . $reshp->idperkiraan . "'
                                                        GROUP BY a.no_akun    
                                                        ");
                $qlrd_row = $query_laba_rugi_detail->num_rows();
                $qlrd = $query_laba_rugi_detail->row();
                if ($qlrd_row > 0) {
                    if ($qlrd->saldo != 0) {
                        $total_saldo_8 = $qlrd->saldo;                        
                    } else {
                        $total_saldo_8 = '0';                        
                    }
                } else {
                    $total_saldo_8 = '';                   
                }
                $total_saldo_akun_8 += $total_saldo_8;

                foreach ($query_detail_perkiraan->result() as $resdp) {
                        $query_laba_rugi_detail = $this->db->query("SELECT a.*,IFNULL(SUM(a.nilai),0) as saldo
                                                        FROM view_jurnal a
                                                        LEFT JOIN ak_master_perkiraan b ON a.no_akun=b.idperkiraan
                                                        LEFT JOIN ak_master_kelompok_perkiraan c ON b.idkelompok_perkiraan=c.idkelompok_perkiraan
                                                        WHERE a.periode='" . $periode . "' AND a.company='" . $company . "' AND a.no_akun='" . $resdp->idperkiraan . "'
                                                        GROUP BY a.no_akun    
                                                        ");
                        $qlrd_row = $query_laba_rugi_detail->num_rows();
                        $qlrd = $query_laba_rugi_detail->row();
                        if ($qlrd_row > 0) {
                            if ($qlrd->saldo != 0) {
                                $total_saldo_8 = $qlrd->saldo;                                
                            } else {
                                $total_saldo_8 = '0';                                
                            }
                        } else {
                            $total_saldo_8 = '0';                            
                        }
                        $total_saldo_akun_8 += $total_saldo_8; 
                }
            }
        }
        $total_saldo_all_8 += $total_saldo_akun_8;
        
        $saldo_laba_rugi_berjalan = ($total_saldo_all_4-$total_saldo_all_5-$total_saldo_all_6)+$total_saldo_all_7-$total_saldo_all_8;
        return $saldo_laba_rugi_berjalan;
    }

    function hitung_saldo_awal_next($company, $periode_lama, $periode_baru){
        $sqlakun = $this->db->query("SELECT a.* FROM ak_master_perkiraan a WHERE a.tipe_perkiraan='D' AND a.is_active='1'");
        $saldo = 0;
        $debet = 0;
        $kredit = 0;
        foreach($sqlakun->result() as $akun){                
                $sqlneraca = $this->db->query("SELECT a.*,SUM(a.saldo) as saldonya 
                    FROM ak_neraca_saldo a 
                    LEFT JOIN ak_master_perkiraan b ON a.idperkiraan=b.idperkiraan
                    LEFT JOIN ak_master_kelompok_perkiraan c ON b.idkelompok_perkiraan=c.idkelompok_perkiraan
                    WHERE a.idperkiraan='".$akun->idperkiraan."' AND a.periode='" . $periode_lama . "' AND a.company='" . $company . "' AND (b.idkelompok_perkiraan LIKE '%1%' OR b.idkelompok_perkiraan LIKE '%2%' OR b.idkelompok_perkiraan LIKE '%3%') GROUP BY a.idperkiraan,a.dk");
                foreach($sqlneraca->result() as $n){
                    if($akun->saldo_normal=="D"){
                       if($n->dk=="D"){
                           $debet = $n->saldo;
                           $kredit = 0;
                       } else {
                           $debet = 0;
                           $kredit = $n->saldo;
                       }
                       $saldo = $debet - $kredit;
                    } else {
                       if($n->dk=="D"){
                           $debet = $n->saldo;
                           $kredit = 0;
                       } else {
                           $debet = 0;
                           $kredit = $n->saldo;
                       }
                       $saldo = $kredit - $debet; 
                    }
                }
                                
                $this->db->delete("ak_saldo_awal_akun",array("periode"=>$periode_baru,"company"=>$company,"idperkiraan"=>$akun->idperkiraan));                
                $this->db->insert("ak_saldo_awal_akun",array("periode"=>$periode_baru,"idperkiraan"=>$akun->idperkiraan,"saldo"=>$saldo,"company"=>$company));
                $saldo = 0;
        }
        
        
    }

}
