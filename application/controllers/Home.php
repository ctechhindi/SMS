<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends My_Controller {

	public function index()
	{
		$data['title'] = "Welcome to SMS";
		$this->load->view('include_files/header',$data);
		$this->load->view('include_files/nav');
		$this->load->view('welcome_message');
		$this->load->view('include_files/footer');
	}
}