<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_sistem_menu extends CI_Model {

  public function get($id = null)
  {
    $this->db->select('a.menu_id AS menu_id, a.id_level AS id_level, a.menu_name AS menu_name,
    a.menu_link AS menu_link, a.menu_icon AS menu_icon, a.parent_id AS parent_id,
    b.menu_name AS parent_name');
    $this->db->from('menu a');
    $this->db->join('menu b', 'a.parent_id=b.menu_id', 'left');
    if($id != null)
    {
      $this->db->where('a.menu_id', $id);
    }
    $this->db->where('a.delete_mark', '0');
    $this->db->order_by('a.menu_id', 'asc');
    $query = $this->db->get();
    return $query;
  }

  public function get_level($id = null)
  {
    $this->db->from('menu_level');
    if($id != null)
    {
      $this->db->where('id_level', $id);
    }
    $query = $this->db->get();
    return $query;
  }

  public function get_parents($id = null)
  {
    $this->db->from('menu');
    $this->db->where('parent_id', '');
    $this->db->where('delete_mark', '0');
    if($id != null)
    {
      $this->db->where('menu_id !=', $id);
    }
    $query = $this->db->get();
    return $query;
  }

  public function count_parents($id_m = null)
  {
    $this->db->from('menu');
    $this->db->where('parent_id', '');
    $this->db->where('delete_mark', '0');
    if($id_m != null)
    {
      $this->db->where('menu_id !=', $id_m);
    }
    $query = $this->db->count_all_results();
    return $query;
  }

  public function count_childmenu($id, $id_m = null)
  {
    $this->db->from('menu');
    $this->db->where('parent_id', $id);
    $this->db->where('delete_mark', '0');
    if($id_m != null)
    {
      $this->db->where('menu_id !=', $id_m);
    }
    $query = $this->db->count_all_results();
    return $query;
  }

  public function count_sistem_menu()
  {
      $this->db->from('menu');
      $this->db->where('delete_mark', '0');
      $query = $this->db->count_all_results();
      return $query;
  }

  public function add($post)
  {
    $params['menu_id'] = $post['menu_id'];
    $params['id_level'] = $post['id_level'];
    $params['menu_name'] = $post['menu_name'];
    $params['menu_link'] = $post['menu_link'];
    $params['menu_icon'] = $post['menu_icon'];
    $params['parent_id'] = $post['parent_id'];
    $params['delete_mark'] = '0';
    $params['create_by'] = $this->session->id_user;
    $params['create_date'] = date('Y-m-d');
    $params['update_by'] = $this->session->id_user;
    $params['update_date'] = date('Y-m-d');
    $this->db->insert('menu', $params);
  }

  public function edit($post)
  {
    $params['menu_id'] = $post['menu_id2'];
    $params['id_level'] = $post['id_level'];
    $params['menu_name'] = $post['menu_name'];
    $params['menu_link'] = $post['menu_link'];
    $params['menu_icon'] = $post['menu_icon'];
    $params['parent_id'] = $post['parent_id'];
    $params['update_by'] = $this->session->id_user;
    $params['update_date'] = date('Y-m-d');
    $this->db->where('menu_id', $post['menu_id']);
    $this->db->update('menu', $params);

    $this->db->from('menu_user');
    $this->db->where('menu_id', $post['menu_id']);
    $query = $this->db->get();

    foreach ($query->result() as $key => $a) {
      $params2['menu_id'] = $post['menu_id2'];
      $this->db->where('menu_id', $post['menu_id']);
      $this->db->update('menu_user', $params2);
    }

    return 'success';
  }

  public function delete($id)
	{
    $params['delete_mark'] = '1';
    $params['update_by'] = $this->session->id_user;
    $params['update_date'] = date('Y-m-d');
    $this->db->where('menu_id', $id);
    $this->db->update('menu', $params);
	}
}
