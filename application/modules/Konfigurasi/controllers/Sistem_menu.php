<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sistem_menu extends CI_Controller {
	function __construct()
	{
			parent::__construct();
			$this->load->model('m_sistem_menu');
			cek_aktif_login();
			cek_akses_user('konfigurasi/sistem_menu');
			$this->load->library('form_validation');
	}

	public function index()
	{
		$data['menu_lv1'] = menu_lv1();
		$data['menu_lv2'] = menu_lv2();
		$content['sistem_menu'] = $this->m_sistem_menu->get();

    $this->load->view('templates/header');
    $this->load->view('templates/side_bar', $data);
    $this->load->view('templates/navbar');
    $this->load->view('v_sistem_menu', $content);
    $this->load->view('templates/footer');
	}

	public function add()
	{
		$this->form_validation->set_rules('menu_name', 'Nama Menu', 'required');
		$this->form_validation->set_rules('menu_link', 'Link Menu', 'required|is_unique[menu.menu_link]',
				array('is_unique' => '%s sudah terpakai, ganti link menu lain.')
		);
    $this->form_validation->set_rules('menu_icon', 'Icon', 'required');
		$this->form_validation->set_rules('id_level', 'Level', 'required');
		$this->form_validation->set_message('required', '%s masih kosong.');

		if ($this->form_validation->run() == FALSE)
		{
			$menu['menu_lv1'] = menu_lv1();
			$menu['menu_lv2'] = menu_lv2();
			$content['level'] = $this->m_sistem_menu->get_level();
			$content['parent'] = $this->m_sistem_menu->get_parents();

	    $this->load->view('templates/header');
	    $this->load->view('templates/side_bar', $menu);
	    $this->load->view('templates/navbar');
	    $this->load->view('v_add_menu', $content);
	    $this->load->view('templates/footer');
		}
		else
		{
			$post = $this->input->post(null, TRUE);
			if($post['parent_id']){
				$arr_id = str_split($post['parent_id']);
				$child = $this->m_sistem_menu->count_childmenu($post['parent_id']);
				$post['menu_id'] = 'm'.strval($arr_id[1]).strval($child+1);
			}
			else{
				$count = $this->m_sistem_menu->count_parents();
				$post['menu_id'] = 'm'.strval($count+1).'0';
			}
			$this->m_sistem_menu->add($post);

			if($this->db->affected_rows() > 0)
			{
				echo "<script>alert('Data berhasil disimpan');</script>";
			}
			else{
				echo "<script>alert('Data gagal disimpan');</script>";
			}
			echo "<script>window.location='".site_url('konfigurasi/sistem_menu')."';</script>";
		}
	}

	public function edit($id)
	{
		$this->form_validation->set_rules('menu_name', 'Nama Menu', 'required');
		$this->form_validation->set_rules('menu_link', 'Link Menu', 'required|callback_menulink_check',
				array('is_unique' => '%s sudah terpakai, gunakan menu link yang lain.')
		);
    $this->form_validation->set_rules('menu_icon', 'Icon', 'required');
		$this->form_validation->set_rules('id_level', 'Level', 'required');
		$this->form_validation->set_message('required', '%s masih kosong.');

		if ($this->form_validation->run() == FALSE)
		{
			$query = $this->m_sistem_menu->get($id);
			if($query->num_rows() > 0)
			{
				$data['menu'] = $query->row();
				$menu['menu_lv1'] = menu_lv1();
				$menu['menu_lv2'] = menu_lv2();
				$data['level'] = $this->m_sistem_menu->get_level();
				$data['parent'] = $this->m_sistem_menu->get_parents($id);

		    $this->load->view('templates/header');
		    $this->load->view('templates/side_bar', $menu);
		    $this->load->view('templates/navbar');
		    $this->load->view('v_edit_menu', $data);
		    $this->load->view('templates/footer');
			}
			else
			{
				echo "<script>alert('Data tidak ditemukan.');";
				echo "window.location='".site_url('konfigurasi/sistem_menu')."';</script>";
			}
		}
		else
		{
			$post = $this->input->post(null, TRUE);
			if($post['parent_id']){
				$arr_id = str_split($post['parent_id']);
				$child = $this->m_sistem_menu->count_childmenu($post['parent_id']);
				$post['menu_id2'] = 'm'.strval($arr_id[1]).strval($child+1);
			}
			else{
				$count = $this->m_sistem_menu->count_parents();
				$post['menu_id2'] = 'm'.strval($count+1).'0';
			}

			$this->m_sistem_menu->edit($post);
			if($this->db->affected_rows() > 0)
			{
				echo "<script>alert('Data berhasil disimpan');</script>";
			}
			else{
				echo "<script>alert('Data gagal disimpan');</script>";
			}
			echo "<script>window.location='".site_url('konfigurasi/sistem_menu')."';</script>";
		}
	}

	function menulink_check()
  {
		$post = $this->input->post(null, TRUE);
		$query = $this->db->query("SELECT * FROM menu WHERE menu_link = '$post[menu_link]' AND menu_id != '$post[menu_id]'");
		if($query->num_rows() > 0)
		{
			$this->form_validation->set_message('menulink_check', '{field} sudah terpakai, gunakan menu link yang lain.');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
  }

	public function delete($id)
	{
		$this->m_sistem_menu->delete($id);

		if($this->db->affected_rows() > 0)
		{
			echo "<script>alert('Data berhasil dihapus');</script>";
		}
		else{
			echo "<script>alert('Data gagal dihapus');</script>";
		}
		echo "<script>window.location='".site_url('konfigurasi/sistem_menu')."';</script>";
	}
}
