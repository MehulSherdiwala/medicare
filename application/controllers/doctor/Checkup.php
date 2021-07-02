<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkup extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('DoctorModel');
	}

	public function index()
	{
		$uId = $this->session->userdata('uId');
		if (!isset($uId)){
			redirect('index');
		}
		$this->load->model('MedicineModel');
		$data['med'] = $this->MedicineModel->fetchMedList();

		$this->load->view('doctor/checkup', $data);
//		$this->load->view('doctor/checkup_old', $data);
	}

	public function old(){
		$this->load->view('doctor/checkup_old');
	}

	public function queue($docId = NULL){
		if ($docId == NULL){
			$docId = $this->session->userdata('uId');
		}
		$res = $this->DoctorModel->queue($docId);

		echo json_encode($res);
	}

	public function fetchCheckupDetails($id){
		$res = $this->DoctorModel->fetchCheckupDetails($id);

		echo json_encode($res);
	}

	function data(){

		$res = $this->DoctorModel->saveData();

		redirect('doctor/checkup');

//		echo json_encode($res);
	}

	function pmrDesc($pmrId){
		if (!isset($pmrId)){
			$pmrId = 0;
		}
		$res = $this->DoctorModel->pmrDesc($pmrId);

		echo $res;
	}

	function attachReport(){

		$ran = rand(1000,9999);
		$config['upload_path']="./reports";
		$config['allowed_types']='gif|jpg|png|pdf';
		$config['file_name']= $ran."_".$_FILES['file']['name'];
		$this->load->library('upload',$config);
		if($this->upload->do_upload("file")){
			$data = array('upload_data' => $this->upload->data());
//			$file = $data['upload_data']['file_name'];
			$dataSet = array(
				'datetime' => date('Y-m-d H:i:s', now('Asia/Kolkata')),
				'src' => $data['upload_data']['file_name'],
				'pmdId' => $this->input->post('pmdId')
			);

			$result= $this->DoctorModel->saveReport($dataSet);
			$res = $this->DoctorModel->fetchReport($this->input->post('pmdId'));

			echo json_encode($res);
		}

	}

	function fetchReport($pmdId){
		$res = $this->DoctorModel->fetchReport($pmdId);

		echo json_encode($res);
	}

}

/* End of file Checkup.php */
