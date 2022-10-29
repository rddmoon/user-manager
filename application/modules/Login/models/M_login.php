<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_login extends CI_Model {

  public function auth(){
    $cek_email= $this->db->get_where('user', ['email' => $this->input->post('email-username', true)])->row_array();
    $cek_username= $this->db->get_where('user', ['username' => $this->input->post('email-username', true)])->row_array();
    if($cek_email || $cek_username){
      $cek_password = $this->db->get_where('user', ['password' => $this->input->post('password', true)])->row_array();
      if($cek_password){
        $this->session->sudah_login = true;
        return "login_successful";
      }
      else{
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Password salah</div>');
        return "login_failed";
      }
    }
    else{
      $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Data yang dimasukkan salah</div>');
      return "login_failed";
    }
  }
}
