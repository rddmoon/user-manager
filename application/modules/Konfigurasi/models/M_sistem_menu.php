<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_sistem_menu extends CI_Model {

  public function menu_lv1(){
    $menu_lv1 = $this->db->select('m.*')
    ->from('menu m')
    ->join('menu_user mu', 'mu.menu_id = m.menu_id', 'left')
    ->where(['mu.id_user' => $this->session->id_user, 'mu.delete_mark' => '0', 'm.delete_mark' => '0', 'm.id_level' => 'lv1'])
    ->get()->result_array();

    return $menu_lv1;
  }

  public function menu_lv2(){
    $menu_lv2 = $this->db->select('m.*')
    ->from('menu m')
    ->join('menu_user mu', 'mu.menu_id = m.menu_id', 'left')
    ->where(['mu.id_user' => $this->session->id_user, 'mu.delete_mark' => '0', 'm.delete_mark' => '0', 'm.id_level' => 'lv2'])
    ->get()->result_array();

    return $menu_lv2;
  }
}
