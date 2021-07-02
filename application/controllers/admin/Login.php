<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$aId = $this->session->userdata('aId');
		if (isset($aId)){
			redirect('admin');
		}
		$this->load->view('admin/login');
	}

	private function encrypt_decrypt($action, $string)
	{
		$output = false;
		$encrypt_method = "AES-256-CBC";
		$secret_key = 'This is my secret key';
		$secret_iv = 'This is my secret iv';
		// hash
		$key = hash('sha256', $secret_key);
		// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
		$iv = substr(hash('sha256', $secret_iv), 0, 16);
		if( $action == 'encrypt' ) {
			$output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
			$output = base64_encode($output);
		}
		else if( $action == 'decrypt' ){
			$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
		}
		return $output;
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
				'status' => 0,
				'pwd' => $this->encrypt_decrypt( 'encrypt',$this->input->post('pwd')),
			);
			$this->load->model('admin/adminModel','admin');
			$result = $this->admin->adminLogin($user_data);
//			print_r($result);
			if ($result == 0){
				$data['error'] ='Invalid Email Or Password';
				$this->load->view('admin/login',$data);
			} else{
				$array = array(
					'aId' => $result['aId'],
					'username' => $result['username'],
					'profileImg' => $result['profileImg'],
				);

				$this->session->set_userdata($array);
				redirect('admin');
			}
		} else
		{
			$this->load->view('admin/login');
		}

	}

	public function Logout(){
		$this->session->sess_destroy();
		redirect('admin/login');
	}

}

/* End of file Login.php */
