<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_profil extends CI_Model {

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
    $params['update_by'] = $this->session->id_user;
    $this->db->where('id_user', $this->session->id_user);
    $this->db->update('user', $params);

    return true;
  }

  public function update_foto($post, $ada_foto)
  {
    if($ada_foto == null || $ada_foto != null){
      $params['id_user'] = $post['id_user'];
      $params['foto'] = $post['foto'];
      $params['update_by'] = $this->session->id_user;
      $this->db->where('id_user', $this->session->id_user);
      $this->db->update('user_foto', $params);
    }
    else{
      $params['id_user'] = $post['id_user'];
      $params['foto'] = $post['foto'];
      $params['create_by'] = $this->session->id_user;
      $params['delete_mark'] = '0';
      $params['update_by'] = $this->session->id_user;
      $this->db->insert('user_foto', $params);
    }

    return true;
  }

}
