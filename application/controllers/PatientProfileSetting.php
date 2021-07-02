<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class patientProfileSetting extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$uId = $this->session->userdata('uId');
		if (!isset($uId)){
			redirect('index');
		}
		$this->load->model('stateCityModel');
		$data['state'] = $this->stateCityModel->fetchState();
		$id = $this->session->userdata('uId');
		$this->load->model('PatientModel');
		$data['patientDetail'] = $this->PatientModel->getDetail($id);
		$this->load->view('patient-profile-settings',$data);
	}

	public function updateData(){
		$oldEmail = $this->input->post('oldEmail');
		$email = $this->input->post('email');

		if ($oldEmail != $email){
			$this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[patient.email]|is_unique[pharmacist.email]|is_unique[doctor.email]',
				array('is_unique' => 'This %s already exists.')
			);
			if ($this->form_validation->run() == FALSE)
			{
				redirect('patient-profile-setting');
			}
		}

		$profile = '';
		if (isset($_FILES['profileImg'])){

			$ran = rand(1000,9999);
			$config['upload_path']= './profile';
			$config['allowed_types']='gif|jpg|png';
			$config['file_name']= $ran. '_' .$_FILES['profileImg']['name'];
			$this->load->library('upload',$config);
			if($this->upload->do_upload('profileImg')){
				$data = array('upload_data' => $this->upload->data());
				echo $profile = $data['upload_data']['file_name'];
				$_SESSION['profileImg'] = $profile;
			} else {
//				print_r($this->upload->display_errors());
			}
		}
		$user_data = array(
			'username' => $this->input->post('username'),
			'email' => $this->input->post('email'),
			'phone' => $this->input->post('phone'),
			'gender' => $this->input->post('gender'),
			'dob' => date('Y-m-d H:i:s', strtotime($this->input->post('dob'))),
			'description' => $this->input->post('description'),
			'address' => $this->input->post('address'),
			'cityId' => $this->input->post('city'),
			'pincode' => $this->input->post('pincode'),
			'updatedAt' => date('Y-m-d H:i:s', now('Asia/Kolkata')),
			'profileImg' => $profile
		);
		if ($profile == '')
		{
			array_pop($user_data);
		}
		$this->load->model('PatientModel');
		$id = $this->session->userdata('uId');
		$result = $this->PatientModel->updateProfile($id,$user_data);
		if ($result == 1){
			$array = array(
				'profile' => 0
			);
			$this->session->set_userdata($array);
		}
		redirect(base_url().'patient-profile-setting');
	}
}

/* End of file patientProfileSetting.php */
