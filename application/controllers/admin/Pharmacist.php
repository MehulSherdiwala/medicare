<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pharmacist extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('PharmacistModel');
	}

	public function index()
	{
		$aId = $this->session->userdata('aId');
		if (!isset($aId)){
			redirect('admin/login');
		}
		$this->load->view('admin/pharmacist-list');
	}

	public function fetchPharmacistList(){
		$rec = $this->PharmacistModel->fetchPharmacistList();

		echo json_encode($rec);
	}

	public function pharmacistDetail($id){
		$rec = $this->PharmacistModel->pharmacistDetail($id);

		echo json_encode($rec);
	}

	public function fetchPhar($id){
		$rec = $this->PharmacistModel->fetchPhar($id);

		echo json_encode($rec);
	}
	public function updateStatus(){
		$rec = $this->PharmacistModel->updateStatus();

		echo json_encode($rec);
	}

}

/* End of file Doctors.php */
