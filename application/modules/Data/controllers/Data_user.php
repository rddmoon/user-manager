<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_user extends CI_Controller {
	function __construct()
	{
			parent::__construct();
			$this->load->model('m_data_user');
			cek_aktif_login();
			cek_akses_user($this->uri->segment(1,0).'/'.$this->uri->segment(2,0));
			$this->load->library('form_validation');
	}

	public function index()
	{
		$data['menu_lv1'] = menu_lv1();
		$data['menu_lv2'] = menu_lv2();
		$nav['ada_foto'] = cek_foto();
		$content['user'] = $this->m_data_user->get();

    $this->load->view('templates/header');
    $this->load->view('templates/side_bar', $data);
    $this->load->view('templates/navbar', $nav);
    $this->load->view('v_data_user', $content);
    $this->load->view('templates/footer');

		$id_m = menu_now($this->uri->segment(1,0).'/'.$this->uri->segment(2,0));
		activity_read('berhasil', $id_m->menu_id, $id_m->menu_name);
	}

	public function add()
	{
		$this->form_validation->set_rules('nama_user', 'Nama', 'required');
		$this->form_validation->set_rules('username', 'Username', 'required|is_unique[user.username]',
				array('is_unique' => '%s sudah terpakai, gunakan username yang lain.')
		);
    $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
    $this->form_validation->set_rules('passconf', 'Konfirmasi Password', 'required|matches[password]',
				array('matches' => '%s tidak sesuai.')
		);
    $this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('no_hp', 'No HP', 'required');
		$this->form_validation->set_rules('wa', 'WA', 'required');
		$this->form_validation->set_rules('pin', 'Pin', 'required');
		$this->form_validation->set_rules('id_jenis_user', 'Jenis User', 'required');
		$this->form_validation->set_rules('status_user', 'Status User', 'required');
		$this->form_validation->set_message('required', '%s masih kosong.');
		$this->form_validation->set_message('min_length', '{field} minimal 5 karakter.');

		if ($this->form_validation->run() == FALSE)
		{
			$menu['menu_lv1'] = menu_lv1();
			$menu['menu_lv2'] = menu_lv2();
			$nav['ada_foto'] = cek_foto();

	    $this->load->view('templates/header');
	    $this->load->view('templates/side_bar', $menu);
	    $this->load->view('templates/navbar', $nav);
	    $this->load->view('v_add_user');
	    $this->load->view('templates/footer');
		}
		else
		{
			$post = $this->input->post(null, TRUE);
			$this->m_data_user->add($post);

			if($this->db->affected_rows() > 0)
			{
				$id_m = menu_now($this->uri->segment(1,0).'/'.$this->uri->segment(2,0));
				activity_create('berhasil', $id_m->menu_id, $id_m->menu_name);
				echo "<script>alert('Data berhasil disimpan');</script>";
			}
			else{
				$id_m = menu_now($this->uri->segment(1,0).'/'.$this->uri->segment(2,0));
				activity_create('gagal', $id_m->menu_id, $id_m->menu_name);
				echo "<script>alert('Data gagal disimpan');</script>";
			}
			echo "<script>window.location='".site_url('data/data_user')."';</script>";
		}
	}

	public function edit($id)
	{
		$this->form_validation->set_rules('nama_user', 'Nama', 'required');
		$this->form_validation->set_rules('username', 'Username', 'required|callback_username_check',
				array('is_unique' => '%s sudah terpakai, gunakan username yang lain.')
		);
		if ($this->input->post('password'))
		{
			$this->form_validation->set_rules('password', 'Password', 'min_length[5]');
			$this->form_validation->set_rules('passconf', 'Konfirmasi Password', 'matches[password]',
			array('matches' => '%s tidak sesuai.')
			);
		}
		if ($this->input->post('passconf'))
		{
			$this->form_validation->set_rules('passconf', 'Konfirmasi Password', 'matches[password]',
			array('matches' => '%s tidak sesuai.')
			);
		}
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('no_hp', 'No HP', 'required');
		$this->form_validation->set_rules('wa', 'WA', 'required');
		$this->form_validation->set_rules('pin', 'Pin', 'required');
		$this->form_validation->set_rules('id_jenis_user', 'Jenis User', 'required');
		$this->form_validation->set_rules('status_user', 'Status User', 'required');
		$this->form_validation->set_message('required', '%s masih kosong.');
		$this->form_validation->set_message('min_length', '{field} minimal 5 karakter.');

		if ($this->form_validation->run() == FALSE)
		{
			$query = $this->m_data_user->get($id);
			if($query->num_rows() > 0)
			{
				$data['user'] = $query->row();
				$menu['menu_lv1'] = menu_lv1();
				$menu['menu_lv2'] = menu_lv2();
				$nav['ada_foto'] = cek_foto();

		    $this->load->view('templates/header');
		    $this->load->view('templates/side_bar', $menu);
		    $this->load->view('templates/navbar', $nav);
		    $this->load->view('v_edit_user', $data);
		    $this->load->view('templates/footer');
			}
			else
			{
				$id_m = menu_now($this->uri->segment(1,0).'/'.$this->uri->segment(2,0));
				activity_update('gagal', $id_m->menu_id, $id_m->menu_name);
				echo "<script>alert('Data tidak ditemukan.');";
				echo "window.location='".site_url('data/data_user')."';</script>";
			}
		}
		else
		{
			$post = $this->input->post(null,TRUE);
			$this->m_data_user->edit($post);
			if($this->db->affected_rows() > 0)
			{
				$id_m = menu_now($this->uri->segment(1,0).'/'.$this->uri->segment(2,0));
				activity_update('berhasil', $id_m->menu_id, $id_m->menu_name);
				echo "<script>alert('Data berhasil disimpan');</script>";
			}
			else{
				$id_m = menu_now($this->uri->segment(1,0).'/'.$this->uri->segment(2,0));
				activity_update('gagal', $id_m->menu_id, $id_m->menu_name);
				echo "<script>alert('Data gagal disimpan');</script>";
			}
			echo "<script>window.location='".site_url('data/data_user')."';</script>";
		}
	}

	function username_check()
  {
		$post = $this->input->post(null, TRUE);
		$query = $this->db->query("SELECT * FROM user WHERE username = '$post[username]' AND id_user != '$post[id_user]'");
		if($query->num_rows() > 0)
		{
			$this->form_validation->set_message('username_check', '{field} sudah terpakai, gunakan username yang lain.');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
  }

	public function delete($id)
	{
		$this->m_data_user->delete($id);

		if($this->db->affected_rows() > 0)
		{
			$id_m = menu_now($this->uri->segment(1,0).'/'.$this->uri->segment(2,0));
			activity_delete('berhasil', $id_m->menu_id, $id_m->menu_name);
			echo "<script>alert('Data berhasil dihapus');</script>";
		}
		else{
			$id_m = menu_now($this->uri->segment(1,0).'/'.$this->uri->segment(2,0));
			activity_delete('gagal', $id_m->menu_id, $id_m->menu_name);
			echo "<script>alert('Data gagal dihapus');</script>";
		}
		echo "<script>window.location='".site_url('data/data_user')."';</script>";
	}
}
