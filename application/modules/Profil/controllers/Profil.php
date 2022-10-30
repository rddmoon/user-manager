<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends CI_Controller {
	function __construct()
	{
			parent::__construct();
			$this->load->model('m_profil');
			cek_aktif_login();
			$this->load->library('form_validation');
	}

	public function index()
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
		$this->form_validation->set_message('required', '%s masih kosong.');
		$this->form_validation->set_message('min_length', '{field} minimal 5 karakter.');

		if ($this->form_validation->run() == FALSE)
		{
			$query = $this->m_profil->get($this->session->id_user);
			if($query->num_rows() > 0)
			{
				$data['user'] = $query->row();
				$menu['menu_lv1'] = menu_lv1();
				$menu['menu_lv2'] = menu_lv2();
				$nav['ada_foto'] = cek_foto();

		    $this->load->view('templates/header');
		    $this->load->view('templates/side_bar', $menu);
		    $this->load->view('templates/navbar', $nav);
		    $this->load->view('v_profil', $data);
		    $this->load->view('templates/footer');
			}
			else
			{
				// $id_m = menu_now($this->uri->segment(1,0).'/'.$this->uri->segment(2,0));
				// activity_update('gagal', $id_m->menu_id, $id_m->menu_name);
				echo "<script>alert('Data tidak ditemukan.');";
				echo "window.location='".site_url('dashboard')."';</script>";
			}
		}
		else
		{
			$post = $this->input->post(null,TRUE);
			$stat = $this->m_profil->edit($post);
			if($stat == true)
			{
				// $id_m = menu_now($this->uri->segment(1,0).'/'.$this->uri->segment(2,0));
				// activity_update('berhasil', $id_m->menu_id, $id_m->menu_name);
				$this->upload_avatar($this->session->id_user);
				echo "<script>alert('Data berhasil disimpan');</script>";
			}
			else{
				// $id_m = menu_now($this->uri->segment(1,0).'/'.$this->uri->segment(2,0));
				// activity_update('gagal', $id_m->menu_id, $id_m->menu_name);
				echo "<script>alert('Data gagal disimpan');</script>";
			}
			echo "<script>window.location='".site_url('dashboard')."';</script>";
		}
	}

	function username_check()
  {
		$post = $this->input->post(null, TRUE);
		$id = $this->session->id_user;
		$query = $this->db->query("SELECT * FROM user WHERE username = '$post[username]' AND id_user != '$id'");
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

	public function upload_avatar($user)
	{
			$config['upload_path']          = FCPATH.'/assets/assets/img/uploads/';
			$config['allowed_types']        = 'gif|jpg|jpeg|png';
			$config['file_name']            = $user;
			$config['overwrite']            = true;
			$config['max_size']             = 1024; // 1MB
			$config['max_width']            = 1080;
			$config['max_height']           = 1080;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('foto')) {
				$data['error'] = $this->upload->display_errors();
			}
			else {
				$uploaded_data = $this->upload->data();

				$new_data = [
					'id_user' => $this->session->id_user,
					'foto' => $uploaded_data['file_name']
				];

				if ($this->m_profil->update_foto($new_data, cek_foto())) {
					echo "<script>alert('Foto Profil telah diupdate.');</script>";
					redirect(site_url('profil'));
				}
			}
		// $this->load->view('v_profil', $data);
	}

	public function remove_avatar()
	{
		$file_name = $this->session->id_user;
		array_map('unlink', glob(FCPATH."/assets/assets/img/uploads/$file_name.*"));

		$new_data = [
			'id_user' => $this->session->id_user,
			'foto' => null
		];
		if ($this->m_profil->update_foto($new_data,cek_foto())) {
			echo "<script>alert('Foto Profil telah dihapus.');</script>";
			redirect(site_url('profil'));
		}
	}
}
