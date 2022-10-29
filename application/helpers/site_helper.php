<?php

if (!function_exists('cek_aktif_login')){
  function cek_aktif_login(){
    $ci = get_instance();
    if(!$ci->session->sudah_login){
      redirect(base_url());
    }
  }
}

function menu_lv1(){
  $ci = get_instance();
  $menu_lv1 = $ci->db->select('m.*')
  ->from('menu m')
  ->join('menu_user mu', 'mu.menu_id = m.menu_id', 'left')
  ->where(['mu.id_user' => $ci->session->id_user, 'mu.delete_mark' => '0', 'm.delete_mark' => '0', 'm.id_level' => 'lv1'])
  ->get()->result_array();

  return $menu_lv1;
}

function menu_lv2(){
  $ci = get_instance();
  $menu_lv2 = $ci->db->select('m.*')
  ->from('menu m')
  ->join('menu_user mu', 'mu.menu_id = m.menu_id', 'left')
  ->where(['mu.id_user' => $ci->session->id_user, 'mu.delete_mark' => '0', 'm.delete_mark' => '0', 'm.id_level' => 'lv2'])
  ->get()->result_array();

  return $menu_lv2;
}

if (!function_exists('cek_akses_user')){
  function cek_akses_user($link){
    $ci = get_instance();
    $akses = $ci->db->select('m.*')
    ->from('menu m')
    ->join('menu_user mu', 'mu.menu_id = m.menu_id', 'left')
    ->where(['mu.id_user' => $ci->session->id_user, 'mu.delete_mark' => '0', 'm.delete_mark' => '0', 'm.menu_link' => $link])
    ->get()->row_array();

    if(!$akses){
      redirect(base_url('unauthorized'));
    }
  }
}
