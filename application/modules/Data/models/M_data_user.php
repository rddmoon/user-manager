<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_data_user extends CI_Model {

  public function get($id = null)
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

  // public function search($key)
  //   {
  //       $this->db->from('user');
  //       $this->db->like('username', $key);
  //       $this->db->or_like('nama_user', $key);
  //       $this->db->or_like('email', $key);
  //       $this->db->where('delete_mark', '0');
  //       $this->db->order_by('nama_user');
  //       $query = $this->db->get();
  //       return $query;
  //   }

  public function count_user()
  {
      $this->db->from('user');
      $this->db->where('delete_mark', '0');
      $query = $this->db->count_all_results();
      return $query;
  }

  public function add($post)
  {
    $date = date('Y-m-d-H-i-s');
    $id = sha1($date);
    $params['id_user'] = $id;
    $params['nama_user'] = $post['nama_user'];
    $params['username'] = $post['username'];
    $params['password'] = sha1($post['password']);
    $params['email'] = $post['email'];
    $params['no_hp'] = $post['no_hp'];
    $params['wa'] = $post['wa'];
    $params['pin'] = $post['pin'];
    $params['id_jenis_user'] = $post['id_jenis_user'];
    $params['status_user'] = $post['status_user'];
    $params['delete_mark'] = '0';
    $params['create_by'] = $this->session->id_user;
    $params['update_by'] = $this->session->id_user;
    $this->db->insert('user', $params);

    $this->db->select('a.menu_id AS menu_id, a.id_level AS id_level, a.menu_name AS menu_name,
    a.menu_link AS menu_link, a.menu_icon AS menu_icon, a.parent_id AS parent_id,
    b.menu_name AS parent_name');
    $this->db->from('menu a');
    $this->db->join('menu b', 'a.parent_id=b.menu_id', 'left');
    $this->db->where('a.delete_mark', '0');
    $this->db->order_by('a.menu_id', 'asc');
    $query = $this->db->get();

    foreach ($query->result() as $key => $m) {
      $data[] = [
        'id_user' => $id,
        'menu_id' => $m->menu_id,
        'create_by' => $this->session->id_user,
        'delete_mark' => '1',
        'update_by' => $this->session->id_user
      ];
    }
    if(isset($data)){
      $this->db->insert_batch('menu_user', $data);
    }

    return true;
  }

  public function edit($post)
  {
    $params['nama_user'] = $post['nama_user'];
    $params['username'] = $post['username'];
    if (!empty($post['password']))
    {
      $params['password'] = sha1($post['password']);
    }
    $params['email'] = $post['email'];
    $params['no_hp'] = $post['no_hp'];
    $params['wa'] = $post['wa'];
    $params['pin'] = $post['pin'];
    $params['id_jenis_user'] = $post['id_jenis_user'];
    $params['status_user'] = $post['status_user'];
    $params['update_by'] = $this->session->id_user;
    $this->db->where('id_user', $post['id_user']);
    $this->db->update('user', $params);
  }

  public function edit_profil($post)
  {
    $params['nama_user'] = $post['nama_user'];
    $params['username'] = $post['username'];
    if (!empty($post['password']))
    {
      $params['password'] = sha1($post['password']);
    }
    $params['email'] = $post['email'];
    $params['no_hp'] = $post['no_hp'];
    $params['wa'] = $post['wa'];
    $params['pin'] = $post['pin'];
    $params['update_by'] = $this->session->id_user;
    $this->db->where('id_user', $post['id_user']);
    $this->db->update('user', $params);
  }

  public function delete($id)
	{
    $params['delete_mark'] = '1';
    $params['update_by'] = $this->session->id_user;
    $this->db->where('id_user', $id);
    $this->db->update('user', $params);
	}
}
