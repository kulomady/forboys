<?php

/*
 * m_report_ak.php
 * 
 * Copyright (c) 2014 
 * Sepry Haryandi <sepryharyandi@gmail.com>
 * 
 */

class m_report_ak extends CI_model{
    function view_jurnal($periode, $company, $idperkiraan){
        return "SELECT a.*,IFNULL(SUM(a.nilai),0) as saldo
                            FROM view_jurnal a
                            LEFT JOIN ak_master_perkiraan b ON a.no_akun=b.idperkiraan
                            LEFT JOIN ak_master_kelompok_perkiraan c ON b.idkelompok_perkiraan=c.idkelompok_perkiraan
                            WHERE a.periode='" . $periode . "' AND a.company='" . $company . "' AND a.no_akun='" . $idperkiraan . "'
                            GROUP BY a.no_akun    
                        ";
    }
}
