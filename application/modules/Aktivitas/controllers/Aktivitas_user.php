<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aktivitas_user extends CI_Controller {
	function __construct()
	{
			parent::__construct();
			$this->load->model('m_aktivitas_user');
			cek_aktif_login();
			cek_akses_user($this->uri->segment(1,0).'/'.$this->uri->segment(2,0));
	}

	public function index()
	{
		$data['menu_lv1'] = menu_lv1();
		$data['menu_lv2'] = menu_lv2();
		$nav['ada_foto'] = cek_foto();
		$content['user'] = $this->m_aktivitas_user->get_user();

    $this->load->view('templates/header');
    $this->load->view('templates/side_bar', $data);
    $this->load->view('templates/navbar', $nav);
    $this->load->view('v_aktivitas_user', $content);
    $this->load->view('templates/footer');

		$id_m = menu_now($this->uri->segment(1,0).'/'.$this->uri->segment(2,0));
		activity_read('berhasil', $id_m->menu_id, $id_m->menu_name);
	}

	public function detail($id)
	{
		$data['menu_lv1'] = menu_lv1();
		$data['menu_lv2'] = menu_lv2();
		$nav['ada_foto'] = cek_foto();
		$content['aktivitas'] = $this->m_aktivitas_user->get($id);
		$content['user'] = $this->m_aktivitas_user->get_user($id)->row();

    $this->load->view('templates/header');
    $this->load->view('templates/side_bar', $data);
    $this->load->view('templates/navbar', $nav);
    $this->load->view('v_aktivitas_detail', $content);
    $this->load->view('templates/footer');
	}

}
