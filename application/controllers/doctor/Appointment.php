<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Appointment extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$uId = $this->session->userdata('uId');
		if (!isset($uId)){
			redirect('login');
		}
		$this->load->model('AppointmentModel');
		$data['appointment'] = $this->AppointmentModel->fetchAppList();

		$this->load->view('doctor/appointment', $data, FALSE);

	}

}

/* End of file Appointment.php */
