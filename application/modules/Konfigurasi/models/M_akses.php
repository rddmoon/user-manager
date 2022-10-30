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
    $this->db->select('a.menu_id AS menu_id, a.id_level AS id_level, a.menu_name AS menu_name,
    a.menu_link AS menu_link, a.menu_icon AS menu_icon, a.parent_id AS parent_id,
    b.menu_name AS parent_name');
    $this->db->from('menu a');
    $this->db->join('menu b', 'a.parent_id=b.menu_id', 'left');
    $this->db->where('a.delete_mark', '0');
    $this->db->order_by('a.menu_id', 'asc');
    $query = $this->db->get();

    foreach ($query->result() as $key => $m) {
      $ada = false;
      foreach ($this->list_akses()->result() as $key => $a) {
        if($m->menu_id == $a->menu_id){
          $ada = true;
        }
      }
      if(!$ada){
        $params['id_user'] = $id;
        $params['menu_id'] = $m->menu_id;
        $params['create_by'] = $this->session->id_user;
        $params['delete_mark'] = '1';
        $params['update_by'] = $this->session->id_user;
        $this->db->insert('menu_user', $params);
      }
    }

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
    $this->db->where('id_user', $this->input->post('id_user'));
    $this->db->update_batch('menu_user', $data, 'no_seting');
  }
}
