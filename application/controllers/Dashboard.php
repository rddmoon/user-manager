<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function index()
	{
    $this->load->view('templates/header');
    $this->load->view('templates/side_bar');
    $this->load->view('templates/navbar');
    $this->load->view('templates/content');
    $this->load->view('templates/footer');
	}
}