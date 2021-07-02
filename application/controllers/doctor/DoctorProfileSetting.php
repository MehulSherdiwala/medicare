<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DoctorProfileSetting extends CI_Controller {

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
		$this->load->model('DoctorModel');
		$data['doctorDetail'] = $this->DoctorModel->getDetail($id);
		$data['doctorType'] = $this->DoctorModel->doctorType();
		$this->load->view('doctor/doctor-profile-settings',$data);
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
				redirect('doctor/doctor-profile-setting');
			}
		}

//		print_r($_FILES);
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
				print_r($this->upload->display_errors());
			}
		}

		$user_data = array(
			'username' => $this->input->post('username'),
			'email' => $this->input->post('email'),
			'phone' => $this->input->post('phone'),
			'gender' => $this->input->post('gender'),
			'estimatedTime' => $this->input->post('estimatedTime'),
			'experience' => $this->input->post('experience'),
			'pincode' => $this->input->post('pincode'),
			'description' => $this->input->post('description'),
			'address' => $this->input->post('address'),
			'cityId' => $this->input->post('city'),
			'dptId' => $this->input->post('type'),
			'specialization' => $this->input->post('specialization'),
			'price' => $this->input->post('price'),
			'updatedAt' => date('Y-m-d H:i:s', now('Asia/Kolkata')),
			'profileImg' => $profile
		);
		if ($profile == '')
		{
			array_pop($user_data);
		}
		$this->load->model('DoctorModel');

		$dptId = $this->input->post('type');
		$id = $this->session->userdata('uId');

		if ($dptId == 2){
			$this->DoctorModel->setUpIC($id);
		}
		$result = $this->DoctorModel->updateProfile($id,$user_data);
		if ($result == 1){
			$array = array(
				'profile' => 0,
				'dptId' => $dptId
			);
			$this->session->set_userdata($array);
		}
		redirect('doctor/doctor-profile-setting');
	}

	public function updateClinic(){
		$clinic = array(
			'clinicName' => $this->input->post('clinicName'),
			'clinicDescription' => $this->input->post('clinicDescription'),
			'clinicAddress' => $this->input->post('clinicAddress'),
			'clinicPincode' => $this->input->post('clinicPincode'),
			'cityId' => $this->input->post('cityId'),
			'updatedAt' => date('Y-m-d H:i:s', now('Asia/Kolkata')),
		);

		$this->load->model('DoctorModel');
		$id = $this->session->userdata('uId');
		$result = $this->DoctorModel->updateClinic($id,$clinic);

	}

	public function fetchClinic(){
		$this->load->model('DoctorModel');
		$id = $this->session->userdata('uId');
		$result = $this->DoctorModel->fetchClinic($id);

		echo json_encode($result);
	}

}


