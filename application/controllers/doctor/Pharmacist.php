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
		$uId = $this->session->userdata('uId');
		if (!isset($uId)){
			redirect('login');
		}
		$data['phar'] = $this->PharmacistModel->offlinePhar();
		$this->load->view('doctor/pharmacist',$data);
	}

	public function addPhar()
	{
		$res = $this->PharmacistModel->addPhar();
		echo json_encode($res);
	}

	public function deletePhar($dophId)
	{
		$this->PharmacistModel->deletePhar($dophId);
	}

	public function fetchPhar()
	{
		$docId = $this->session->userdata('uId');
		$res = $this->PharmacistModel->fetchOfflinePhar($docId);
		echo json_encode($res);
	}

}

/* End of file Pharmacist.php */
