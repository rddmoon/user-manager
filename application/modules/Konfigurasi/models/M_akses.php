<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_akses extends CI_Model {

  public function list_user()
  {
    $this->db->from('user');
    $this->db->where('delete_mark', '0');
    $this->db->order_by('id_jenis_user', 'nama_user', 'ASC');
    $query = $this->db->get();
    return $query;
  }
  public function list_akses($id = null)
  {
    $this->db->from('menu_user');
    if($id != null)
    {
      $this->db->where('id_user', $id);
    }
    $query = $this->db->get();
    return $query;
  }

  public function get_user($id)
  {
    $this->db->from('user');
    $this->db->where('id_user', $id);
    $query = $this->db->get();
    return $query;
  }

  public function list_menu($id)
  {
    return $this->db->select('menu_user.*, menu.id_level,
    menu.menu_name, menu.parent_id')
    ->from('menu')
    ->join('menu_user', 'menu.menu_id=menu_user.menu_id', 'left')
    ->where('menu.delete_mark', '0')
    ->where('menu_user.id_user', $id)
    ->get();
  }



  public function simpan_akses()
  {
    $menu_user = $this->list_akses($this->input->post('id_user'));
    $no = 0;
    foreach ($menu_user->result() as $key => $mu) {
      $data[] = [
        'no_seting' => $mu->no_seting,
        'delete_mark' => ($this->input->post('akses/'.$no) ? '0' : '1')
      ];
    $no++;
    }
    if($data != null){
      $this->db->where('id_user', $this->input->post('id_user'));
      $this->db->update_batch('menu_user', $data, 'no_seting');
    }

    return true;
  }
}
