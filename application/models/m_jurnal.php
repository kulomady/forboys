<?php

/*
 * m_jurnal.php
 * 
 * Copyright (c) 2014 
 * Sepry Haryandi <sepryharyandi@gmail.com>
 * 
 */

class m_jurnal extends CI_model{
    
    function post_header($data){
        $table = 'ak_jurnal';
        $arec = array('tipe' => '1');
        $field = array('no_jurnal','tgl_jurnal','keterangan','no_ref','periode','company','created_by','created');
        $i = 0;
        foreach($field as $f){
            $rec[$f] = $data[$i];
            $i++;
        }
        $rec = array_merge($rec,$arec);
        $this->db->insert($table,$rec);
    }
    
}
