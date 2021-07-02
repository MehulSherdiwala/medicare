<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class City extends CI_Controller {

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
		$data['state'] = $this->stateCityModel->fetchState();
		$this->load->view('admin/city',$data);

	}

	public function fetchCityList(){
		$rec = $this->stateCityModel->fetchCityList();

		echo json_encode($rec);
	}

	public function addCity(){
		$rec = $this->stateCityModel->addCity();

		echo json_encode($rec);
	}

	public function fetchCity($id){
		$rec = $this->stateCityModel->fetchCityDetail($id);

		echo json_encode($rec);
	}
	public function updateCity(){
		$rec = $this->stateCityModel->updateCity();

		echo json_encode($rec);
	}

}

/* End of file City.php */
