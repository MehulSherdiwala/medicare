<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Disease extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/DiseaseModel','DiseaseModel');
	}

	public function index()
	{
		$aId = $this->session->userdata('aId');
		if (!isset($aId)){
			redirect('admin/login');
		}
//		$data['disease'] = $this->DiseaseModel->fetchDisease();
		$this->load->view('admin/disease');
	}

	public function addDisease(){
		$disData = array(
			"disName" => $this->input->post('disName'),
			"description" => $this->input->post('disDesc'),
			"createdAt" => date('Y-m-d H:i:s', now('Asia/Kolkata')),
		);
		$syData = $this->input->post('syDesc');


		return $this->DiseaseModel->addDisease($disData,$syData);
	}

	public function editDisease(){
		$disData = array(
			"disName" => $this->input->post('disName'),
			"description" => $this->input->post('disDesc'),
			"updatedAt" => date('Y-m-d H:i:s', now('Asia/Kolkata')),
		);
		$syData = $this->input->post('syDesc');
		$disId = $this->input->post('disId');


		return $this->DiseaseModel->editDisease($disId,$disData,$syData);
	}

	public function fetchDisease($id=0){
		$data = $this->DiseaseModel->fetchDisease($id);
		echo json_encode($data);
	}

	public function deleteDisease($id){
		$this->DiseaseModel->deleteDisease($id);
	}

}

/* End of file Disease.php */
