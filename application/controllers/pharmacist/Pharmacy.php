<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pharmacy extends CI_Controller {

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

		$this->load->view('pharmacist/selling');

	}

	public function order()
	{
		$this->load->model('DoctorModel');
		$id = $this->input->post('presId');
		$pharId = $this->input->post('pharId');
		$uId = $this->session->userdata('uId');

		foreach ($id as $presId)
		{
			$this->DoctorModel->pharmacyOrder($presId,$uId,$pharId);
		}

		echo 'Your Order is placed';
	}

	public function queue()
	{
		$this->load->model('PharmacistModel');
		$res = $this->PharmacistModel->queue();

		echo json_encode($res);
	}

	public function fetchPrescriptionDetails($pId)
	{
		$this->load->model('PharmacistModel');
		$res = $this->PharmacistModel->fetchPrescriptionDetails($pId);

		echo json_encode($res);
	}

	public function data()
	{
		$this->load->model('PharmacistModel');
		$res = $this->PharmacistModel->data();

		redirect('pharmacist/pharmacy');
	}

}

/* End of file Pharmacy.php */
