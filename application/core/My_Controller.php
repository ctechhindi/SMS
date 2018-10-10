<?php

class My_Controller extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
		$this->form_validation->set_error_delimiters('<strong><div class="text-danger">', '</div></strong>');
        date_default_timezone_set('Asia/Kolkata');
    }

    /* 
		Admin Login Session Check
    */
    public function check_admin_login(){

    	if(empty($this->session->userdata('EMAIL')) AND empty($this->session->userdata('USER_ID')))
			return redirect('Login');
    }
}

?>