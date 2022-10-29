<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sistem_menu extends CI_Controller {
	function __construct()
	{
			parent::__construct();
			$this->load->model('m_sistem_menu');
			cek_aktif_login();
			cek_akses_user('konfigurasi/sistem_menu');
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
