<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
*  Login Controller
*/
class Login extends My_Controller
{
	public function __construct() {
        parent::__construct();
		$this->load->model('login_model','LoginModel');
    }


	public function index()
	{
		$this->form_validation->set_rules('user_email', 'User Email ID', 'required|valid_email|max_length[150]');
		$this->form_validation->set_rules('user_pass', 'User Password', 'required|max_length[150]');
		if ($this->form_validation->run() == FALSE)
        {
     		$data['title'] = "Welcome to SMS";
			$this->load->view('include_files/header',$data);
			$this->load->view('include_files/nav');
			$this->load->view('login');
			$this->load->view('include_files/footer');
        }
        else
        {
        	$where = array(
        		'email_id' => $this->input->post('user_email'), 
        		'password' => md5($this->input->post('user_pass')), 
    		  );

           	$result = $this->LoginModel->login_user($where);
           	if($result > 0 AND is_object($result)){
              // User login 
              $session_data = array(
                'EMAIL'       => $where['email_id'],
                'USER_ID'     => $result->id,
                'FULL_NAME'   => $result->name,
                'MOBILE'      => $result->mobile,
                'ADDRESS'     => $result->address,
              );
              $this->session->set_userdata($session_data);
              return redirect('Admin');
           	
            }else{
              // User email and Password not match
           		$this->session->set_flashdata('error_msg', 'User Email Id And Password Not Match!');
           		return redirect('Login');
           		$this->db->close();
           	}
        }
	}

    public function Logout(){
        $session_items = array('EMAIL', 'USER_ID');
        $this->session->unset_userdata($session_items);
        return redirect('Login');
    }
}