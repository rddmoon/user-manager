<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	function __construct()
	{
			parent::__construct();
			$this->load->model('m_dashboard');
			cek_aktif_login();
	}

	public function index()
	{
		$data['menu_lv1'] = menu_lv1();
		$data['menu_lv2'] = menu_lv2();
		$nav['ada_foto'] = cek_foto();

    $this->load->view('templates/header');
    $this->load->view('templates/side_bar', $data);
    $this->load->view('templates/navbar', $nav);
    $this->load->view('v_dashboard');
    $this->load->view('templates/footer');
	}
}
