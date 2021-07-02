<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class register extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('EncDec');
	}

	public function index()
	{
		$this->load->view('register');
	}

	public function patient(){
		$this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[patient.email]',
			array('is_unique' => 'This %s already exists.')
		);
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('pwd', 'Password', 'trim|required|min_length[6]',
			array('min_length'     => '%s Contains at least 6 characters.')
		);
		if ($this->form_validation->run() == TRUE or FALSE)
		{
			$user_data = array(
				'username' => $this->input->post('username'),
				'email' => $this->input->post('email'),
				'pwd' => $this->EncDec->encrypt_decrypt('encrypt',$this->input->post('pwd')),
				'joindate' => date('Y-m-d H:i:s', now('Asia/Kolkata')),
				'datetime' => date('Y-m-d H:i:s', now('Asia/Kolkata')),
			);
			$this->load->model('registerModel','patient');
			$result = $this->patient->addPatient($user_data);
			if ($result != 0){
				$array = array(
					'uId' => $result,
					'profile' => 1,
					'userType' => '3',
					'username' => $user_data['username'],
					'profileImg' => '',
					'dptId' => 0,
				);
				$this->session->set_userdata($array);
				redirect('index');
			} else{
				$data['error'] ='Invalid Details';
				$this->load->view('register',$data);
			}
		} else
		{
			$this->load->view('register');
		}
	}
	public function doctorPharmacist(){
		if (!isset($_POST['username'])){
			$this->load->view('doctor-pharmacist-register');
			return;
		}
		$this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[patient.email]|is_unique[pharmacist.email]|is_unique[doctor.email]',
			array('is_unique' => 'This %s already exists.')
		);
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('pwd', 'Password', 'trim|required|min_length[6]',
			array('min_length'     => '%s Contains at least 6 characters.')
		);
		if ($this->form_validation->run() == TRUE or FALSE)
		{
			$user_data = array(
				'username' => $this->input->post('username'),
				'email' => $this->input->post('email'),
				'pwd' => $this->EncDec->encrypt_decrypt('encrypt',$this->input->post('pwd')),
				'joindate' => date('Y-m-d H:i:s', now('Asia/Kolkata')),
				'datetime' => date('Y-m-d H:i:s', now('Asia/Kolkata')),
			);
			$type = $this->input->post('type');
			if ($type==1)
			{
				$this->load->model('registerModel', 'doctor');
				$result = $this->doctor->addDoctor($user_data);
				if ($result != 0)
				{
					$array = array(
						'uId' => $result,
						'profile' => 1,
						'userType' => '1',
						'username' => $user_data['username'],
						'profileImg' => '',
						'dptId' => 0,
					);
					$this->session->set_userdata($array);
					redirect('index');
				} else
				{
					$data['error'] = 'Invalid Details';
					$this->load->view('doctor-pharmacist-register', $data);
				}
			} else {

				$this->load->model('registerModel', 'pharmacist');
				$result = $this->pharmacist->addPharmacist($user_data);
				if ($result != 0)
				{
					$array = array(
						'uId' => $result,
						'profile' => 1,
						'userType' => '2',
						'username' => $user_data['username'],
						'profileImg' => '',
						'dptId' => 0,
					);
					$this->session->set_userdata($array);
					redirect('index');
				} else
				{
					$data['error'] = 'Invalid Details';
					$this->load->view('doctor-pharmacist-register', $data);
				}
			}
		} else
		{
			$this->load->view('register');
		}
	}

}

/* End of file register.php */
