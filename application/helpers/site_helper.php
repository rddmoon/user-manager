<?php

if (!function_exists('cek_aktif_login')){
  function cek_aktif_login(){
    $ci = get_instance();
    if(!$ci->session->sudah_login){
      redirect(base_url());
    }
  }
}

function cek_foto(){
  $ci = get_instance();
  $ada_foto = $ci->db->select('*')
  ->from('user_foto')
  ->where(['id_user' => $ci->session->id_user, 'delete_mark' => '0'])
  ->get()->row();

    return $ada_foto->foto;
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

function menu_now($link){
  $ci = get_instance();
  $query = $ci->db->select('*')
  ->from('menu')
  ->where('menu_link', $link)
  ->get()->row();

  return $query;
}

function activity_create($status, $menu_id, $menu_name){
  $ci = get_instance();
  $params['id_user'] = $ci->session->id_user;
  $params['deskripsi'] = 'Create '.$status.' pada '.$menu_name;
  $params['status'] = $status;
  $params['menu_id'] = $menu_id;
  $params['delete_mark'] = '0';
  $params['create_by'] = $ci->session->id_user;
  $ci->db->insert('user_activity', $params);
}

function activity_update($status, $menu_id, $menu_name){
  $ci = get_instance();
  $params['id_user'] = $ci->session->id_user;
  $params['deskripsi'] = 'Update '.$status.' pada '.$menu_name;
  $params['status'] = $status;
  $params['menu_id'] = $menu_id;
  $params['delete_mark'] = '0';
  $params['create_by'] = $ci->session->id_user;
  $ci->db->insert('user_activity', $params);
}

function activity_read($status, $menu_id, $menu_name){
  $ci = get_instance();
  $params['id_user'] = $ci->session->id_user;
  $params['deskripsi'] = 'Read data '.$status.' pada '.$menu_name;
  $params['status'] = $status;
  $params['menu_id'] = $menu_id;
  $params['delete_mark'] = '0';
  $params['create_by'] = $ci->session->id_user;
  $ci->db->insert('user_activity', $params);
}

function activity_delete($status, $menu_id, $menu_name){
  $ci = get_instance();
  $params['id_user'] = $ci->session->id_user;
  $params['deskripsi'] = 'Delete '.$status.' pada '.$menu_name;
  $params['status'] = $status;
  $params['menu_id'] = $menu_id;
  $params['delete_mark'] = '0';
  $params['create_by'] = $ci->session->id_user;
  $ci->db->insert('user_activity', $params);
}
