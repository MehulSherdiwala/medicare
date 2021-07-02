<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InstantCure extends CI_Controller {

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
		$this->load->model('DoctorModel');
		$data['record'] = $this->DoctorModel->instant_cure();
		$this->load->view('doctor/instant-cure', $data);
	}

	public function start()
	{
		$this->load->model('ChatModel');
		$this->ChatModel->startIC();
	}

}

/* End of file InstantCure.php */
