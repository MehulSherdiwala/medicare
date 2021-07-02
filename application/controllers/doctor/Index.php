<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {

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
		$data['data'] = $this->DoctorModel->dashboard();

		$this->load->view('doctor/index',$data);
	}



}

/* End of file Index.php */
