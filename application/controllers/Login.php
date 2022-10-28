<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

  function __construct()
	{
			parent::__construct();
			$this->load->model('m_login');
	}

	public function index()
	{
    if($this->session->sudah_login){
      redirect(base_url().'dashboard');
      return false;
    }
    $this->load->view('v_login');
	}

  public function auth()
  {
    $auth = $this->m_login->auth();
    if($auth == 'login_successful'){
      redirect(base_url().'dashboard');
    }
    else{
      redirect(base_url());
    }
  }

  public function logout()
  {
    $this->session->sess_destroy();
    redirect(base_url());
  }
}
