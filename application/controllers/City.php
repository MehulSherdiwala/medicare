<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class city extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{

	}

	public function fetchCity($id){
		$this->load->model('stateCityModel');
		$city = $this->stateCityModel->fetchCity($id);

		echo json_encode($city);
	}

}

/* End of file city.php */
