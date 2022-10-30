<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_aktivitas_user extends CI_Model {

  public function get($id = null)
  {
    $this->db->select('a.*, m.menu_name');
    $this->db->from('user_activity a');
    $this->db->join('menu m', 'a.menu_id=m.menu_id', 'left');
    if($id != null)
    {
      $this->db->where('a.id_user', $id);
    }
    $this->db->where('a.delete_mark', '0');
    $query = $this->db->get();
    return $query;
  }

  public function get_user($id = null)
  {
    $this->db->from('user');
    if($id != null)
    {
      $this->db->where('id_user', $id);
    }
    $this->db->where('delete_mark', '0');
    $this->db->order_by('id_jenis_user', 'nama_user', 'asc');
    $query = $this->db->get();
    return $query;
  }

}
