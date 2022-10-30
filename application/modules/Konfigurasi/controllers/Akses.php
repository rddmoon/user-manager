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
		$content['user'] = $this->m_akses->list_user();

    $this->load->view('templates/header');
    $this->load->view('templates/side_bar', $data);
    $this->load->view('templates/navbar');
    $this->load->view('v_akses', $content);
    $this->load->view('templates/footer');
	}

	public function edit($id)
	{
		$data['menu_lv1'] = menu_lv1();
		$data['menu_lv2'] = menu_lv2();
		// $content['list_akses'] = $this->m_akses->list_akses($id);
		$content['user'] = $this->m_akses->get_user($id)->row();
		$content['list_menu'] = $this->m_akses->list_menu($id);

		$this->load->view('templates/header');
		$this->load->view('templates/side_bar', $data);
		$this->load->view('templates/navbar');
		$this->load->view('v_edit_akses', $content);
		$this->load->view('templates/footer');
	}

	public function simpan()
	{
		$this->m_akses->simpan_akses();

		if($this->db->affected_rows() > 0)
		{
			echo "<script>alert('Data berhasil disimpan');</script>";
		}
		else {
			echo "<script>alert('Data gagal disimpan');</script>";
		}
		echo "<script>window.location='".site_url('konfigurasi/akses')."';</script>";
	}
}
