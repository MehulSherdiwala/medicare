<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ViewProfile extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{

	}

	public function doctorProfile($id){
		$this->load->model('EncDec');
		$this->load->model('DoctorModel');
		$this->load->model('stateCityModel');
//		echo $id;
		$docId = $this->EncDec->encrypt_decrypt('decrypt',$id);

		$data['docData'] = $this->DoctorModel->getDetail($docId);
		$data['clinicData'] = $this->DoctorModel->fetchClinic($docId);
		$data['schedule'] = $this->DoctorModel->displaySchedule($docId);
		$data['stateCity'] = $this->stateCityModel->fetchStateCity($data['docData']['cityId']);

		$userType = $this->session->userdata('userType');
		if ($userType == 3){
			$pId = $this->session->userdata('uId');
		} else {
			$pId = 0;
		}
		$data['review'] = $this->DoctorModel->checkReview($docId,$pId);
		$data['rating'] = $this->DoctorModel->fetchReview($docId);
		$data['avgRate'] = $this->DoctorModel->avgRating($docId);

		$this->load->view('doctor-profile', $data, FALSE);

	}

	public function doctorReview(){
		$this->load->model('DoctorModel');
		$this->DoctorModel->saveReview();
		redirect($this->input->post('url'));
	}

	public function pharmacistProfile($id){
		$this->load->model('EncDec');
		$this->load->model('PharmacistModel');
		$this->load->model('stateCityModel');
//		echo $id;
		$pharId = $this->EncDec->encrypt_decrypt('decrypt',$id);

		$data['pharData'] = $this->PharmacistModel->getDetail($pharId);
		$data['totalMed'] = $this->PharmacistModel->countMed($pharId);
		$data['stateCity'] = $this->stateCityModel->fetchStateCity($data['pharData']['cityId']);

		$userType = $this->session->userdata('userType');
		if ($userType == 3){
			$pId = $this->session->userdata('uId');
		} else {
			$pId = 0;
		}
		$data['review'] = $this->PharmacistModel->checkReview($pharId,$pId);
		$data['rating'] = $this->PharmacistModel->fetchReview($pharId);
		$data['avgRate'] = $this->PharmacistModel->avgRating($pharId);

		$this->load->view('pharmacist-profile', $data, FALSE);

	}

	public function pharmacistReview(){
		$this->load->model('PharmacistModel');
		$this->PharmacistModel->saveReview();
		redirect($this->input->post('url'));
	}

}

/* End of file ViewProfile.php */
