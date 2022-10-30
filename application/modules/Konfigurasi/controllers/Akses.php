<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akses extends CI_Controller {
	function __construct()
	{
			parent::__construct();
			$this->load->model('m_akses');
			cek_aktif_login();
			cek_akses_user($this->uri->segment(1,0).'/'.$this->uri->segment(2,0));
	}

	public function index()
	{
		$data['menu_lv1'] = menu_lv1();
		$data['menu_lv2'] = menu_lv2();
		$nav['ada_foto'] = cek_foto();
		$content['user'] = $this->m_akses->list_user();

    $this->load->view('templates/header');
    $this->load->view('templates/side_bar', $data);
    $this->load->view('templates/navbar', $nav);
    $this->load->view('v_akses', $content);
    $this->load->view('templates/footer');

		$id_m = menu_now($this->uri->segment(1,0).'/'.$this->uri->segment(2,0));
		activity_read('berhasil', $id_m->menu_id, $id_m->menu_name);
	}

	public function edit($id)
	{
		$data['menu_lv1'] = menu_lv1();
		$data['menu_lv2'] = menu_lv2();
		$nav['ada_foto'] = cek_foto();
		$content['user'] = $this->m_akses->get_user($id)->row();
		$content['list_menu'] = $this->m_akses->list_menu($id);

		$this->load->view('templates/header');
		$this->load->view('templates/side_bar', $data);
		$this->load->view('templates/navbar', $nav);
		$this->load->view('v_edit_akses', $content);
		$this->load->view('templates/footer');
	}

	public function simpan()
	{
		$this->m_akses->simpan_akses();

		if($this->db->affected_rows() > 0)
		{
			$id_m = menu_now($this->uri->segment(1,0).'/'.$this->uri->segment(2,0));
			activity_update('berhasil', $id_m->menu_id, $id_m->menu_name);
			echo "<script>alert('Data berhasil disimpan');</script>";
		}
		else {
			$id_m = menu_now($this->uri->segment(1,0).'/'.$this->uri->segment(2,0));
			activity_update('gagal', $id_m->menu_id, $id_m->menu_name);
			echo "<script>alert('Data gagal disimpan');</script>";
		}
		echo "<script>window.location='".site_url('konfigurasi/akses')."';</script>";
	}
}
