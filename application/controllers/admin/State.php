<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class State extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('stateCityModel');
	}

	public function index()
	{
		$aId = $this->session->userdata('aId');
		if (!isset($aId)){
			redirect('admin/login');
		}
		$this->load->view('admin/state');
	}

	public function fetchStateList(){
		$rec = $this->stateCityModel->fetchStateList();

		echo json_encode($rec);
	}

	public function addState(){
		$rec = $this->stateCityModel->addState();

		echo json_encode($rec);
	}

	public function fetchState($id){
		$rec = $this->stateCityModel->fetchStateDetail($id);

		echo json_encode($rec);
	}
	public function updateState(){
		$rec = $this->stateCityModel->updateState();

		echo json_encode($rec);
	}


}

/* End of file State.php */
