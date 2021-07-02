<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('SalesModel');
	}

	public function index()
	{
		$uId = $this->session->userdata('uId');
		if (!isset($uId)){
			redirect('index');
		}
		$data['sales'] = $this->SalesModel->fetchSales();
		$this->load->view('pharmacist/sales', $data);
	}

	public function details($id){
		$res = $this->SalesModel->getDetails($id,0);

		echo json_encode($res);
	}

}

/* End of file Sales.php */
