<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Appointment extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('AppointmentModel');
	}

	public function index()
	{
		$uId = $this->session->userdata('uId');
		if (!isset($uId)){
			redirect('login');
		}

		if ($_SESSION['userType']!=3)
		{
			redirect(base_url());
		}
		$this->load->view('appointment');
	}

	public function fetchType($type){
		$res = $this->AppointmentModel->fetchType($type);

		echo json_encode($res);
	}

	public function fetchSchedule($type,$id){
		$res = $this->AppointmentModel->fetchSchedule($type,$id);

		echo json_encode($res);
	}

	public function fetchTimeSlot(){
		$res = $this->AppointmentModel->fetchTimeSlot();

		echo json_encode($res);
	}

	public function checkAvailability(){
		$res = $this->AppointmentModel->checkAvailability();

		echo $res;
	}

	public function book(){
		$appType = $this->input->post('appType');
		if ($appType == 0){
			$this->AppointmentModel->book();
		} else {
			$this->AppointmentModel->icBook();
		}

		redirect('index');
	}

	public  function pay(){
		$this->load->model('WalletModel');
		$data['balance'] = $this->WalletModel->fetchBalance();
		$this->load->view('payAppointment',$data);
	}

	public function view(){

		$uId = $this->session->userdata('uId');
		if (!isset($uId)){
			redirect('login');
		}

		$data['res'] = $this->AppointmentModel->view();

		$this->load->view('view-appointment', $data);
	}

	public function checkupQueue($docId){
		$this->load->model('DoctorModel');
		$data['doc'] = $this->DoctorModel->getDetail($docId);
		$data['clinic'] = $this->DoctorModel->fetchClinic($docId);
//		print_r($data['res']);
		$this->load->view('checkup-queue',$data);
	}

	public function checkIC()
	{
		$res = $this->AppointmentModel->checkIC();

		echo json_encode($res);
	}

}

/* End of file Appointment.php */
