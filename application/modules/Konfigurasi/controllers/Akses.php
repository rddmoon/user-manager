<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akses extends CI_Controller {
	function __construct()
	{
			parent::__construct();
			$this->load->model('m_akses');
			cek_aktif_login();
			cek_akses_user('konfigurasi/akses');
	}

	public function index()
	{
		$data['menu_lv1'] = menu_lv1();
		$data['menu_lv2'] = menu_lv2();

    $this->load->view('templates/header');
    $this->load->view('templates/side_bar', $data);
    $this->load->view('templates/navbar');
    $this->load->view('templates/content');
    $this->load->view('templates/footer');
	}
}
