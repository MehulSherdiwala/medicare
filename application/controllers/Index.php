<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$this->load->model('DoctorModel');
		$this->load->model('MedicineModel');
		$data['doctor'] = $this->DoctorModel->homeDoc();
		$data['medicine'] = $this->MedicineModel->fetch_details(10,0,'');
		$this->load->view('index',$data);
	}

}

/* End of file Index.php */
