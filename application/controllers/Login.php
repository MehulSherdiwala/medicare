<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('EncDec');
	}

	public function index()
	{
		$uId = $this->session->userdata('uId');
		if (isset($uId)){
			redirect('index');
		}
		$this->load->view('login');
	}

	public function LoginVerify(){
		$this->form_validation->set_rules('email', 'Email', 'trim|required');
		$this->form_validation->set_rules('pwd', 'Password', 'trim|required|min_length[6]',
			array(
				'min_length'     => '%s Contains at least 6 characters.'
			)
		);

		if ($this->form_validation->run() == TRUE or FALSE)
		{
			$user_data = array(
				'email' => $this->input->post('email'),
				'pwd' => $this->EncDec->encrypt_decrypt( 'encrypt',$this->input->post('pwd')),
			);
			$this->load->model('loginModel','login');
			$result = $this->login->userLogin($user_data);
//			print_r($result);
			if ($result == 0){
				$data['error'] ='Invalid Email Or Password';
				$this->load->view('login',$data);
			} else{
				$array = array(
					'uId' => $result['uId'],
					'userType' => $result['userType'],
					'username' => $result['username'],
					'profile' => $result['emptyRow'],
					'profileImg' => $result['profileImg'],
					'dptId' => $result['dptId'],
				);

				$this->session->set_userdata($array);
				$loc = $this->input->get('loc');
				if (isset($loc) && !empty($loc)){
					redirect($loc.((isset($_GET['qty']) && !empty($_GET['qty'])) ? '&qty='.$_GET['qty'] : ''));
				} else
				{
					redirect('index');
				}
			}
		} else
		{
			$this->load->view('login');
		}

	}


	public function Logout(){
		$this->session->sess_destroy();
		redirect('index');
	}

	public function forgetPassword(){
		$err = $this->uri->segment(4);
		if (isset($err)){
			$this->load->view('setup-password');
		} else
		{
			$this->load->view('forget-password');
		}
	}

	public function otp(){
		$this->load->model('LoginModel');
		$res = $this->LoginModel->forgetPassword();
		echo $_SESSION['otp'];
		if ($res == 0){
			redirect(base_url().'login/forgetPassword?error=1');
		} else {
			$this->load->view('setup-password');
		}
	}

	public function verifyOTP(){
		$this->form_validation->set_rules('pwd', 'Password', 'trim|required|min_length[6]',
			array(
				'min_length'     => '%s Contains at least 6 characters.'
			)
		);
		$this->form_validation->set_rules('repwd', 'Conf Password', 'trim|required|min_length[6]|matches[pwd]',
			array(
				'matches'     => 'Both Passwords are not equal.'
			)
		);

		if ($this->form_validation->run() == TRUE or FALSE)
		{
			$rotp = $this->input->post('otp');
			$sotp = $_SESSION['otp'];
			if ($rotp == $sotp){
				$this->load->model('LoginModel');
				$this->LoginModel->changePWD($this->EncDec->encrypt_decrypt( 'encrypt',$this->input->post('pwd')));
				redirect(base_url('login'));
			} else {
				redirect(base_url().'login/forgetPassword/otp/1');
			}
		} else {
			$this->load->view('setup-password');
		}
	}

}

/* End of file Login.php */
