<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Medicine extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('MedicineModel','MedicineModel');
		$uId = $this->session->userdata('uId');
		if (!isset($uId)){
			redirect('index');
		}
	}

	public function index()
	{
		$data['disease'] = $this->MedicineModel->fetchDisease();
		$data['mst'] = $this->MedicineModel->fetchMST();
		$data['dose'] = $this->MedicineModel->fetchDose();
		$this->load->view('pharmacist/medicine', $data);
	}

	public function addMedicine(){
		$medData = array(
			'image' => '',
			"medName" => $this->input->post('medName'),
			"medDescription" => $this->input->post('medDesc'),
			"disId" => $this->input->post('disId'),
			"createdBy" => $this->session->userdata('uId'),
			"createdAt" => date('Y-m-d H:i:s', now('Asia/Kolkata')),
		);
		$pharMedData = array(
			"price" => $this->input->post('price'),
			"capacity" => $this->input->post('capacity'),
			"dose" => $this->input->post('dose'),
			"doseId" => $this->input->post('doseId'),
			"msuId" => $this->input->post('msuId'),
			"medId" => '',
			"pharId" => $this->session->userdata('uId'),
			"createdAt" => date('Y-m-d H:i:s', now('Asia/Kolkata')),
		);

		$result = $this->MedicineModel->addMedicine($medData,$pharMedData);
		if ($result == 1){
			echo "Medicine Already Exist";
		} else{
			return;
		}
	}

	public function editMedicine(){
		$medData = array(
			"price" => $this->input->post('price'),
			"msuId" => $this->input->post('msuId'),
			"doseId" => $this->input->post('doseId'),
			"dose" => $this->input->post('dose'),
			"capacity" => $this->input->post('capacity'),
			"updatedAt" => date('Y-m-d H:i:s', now('Asia/Kolkata')),
		);
		$pwmId = $this->input->post('pwmId');


		return $this->MedicineModel->editMedicine($pwmId,$medData);
	}

	public function fetchMedicine($id=0){
		$data = $this->MedicineModel->fetchMedicine($id);
		echo json_encode($data);
	}

	public function fetchMed(){
		$query = $this->input->post('query');
		$flag = 0;
		if (!isset($query)){
			$query = $this->input->post('item');
			$flag=1;
		}
		$data = $this->MedicineModel->fetchMed($query,$flag);
		echo json_encode($data);
	}

	public function deleteMedicine($id){
		$this->MedicineModel->deleteMedicine($id);
	}
	public function fetchUnit($id){
		$res = $this->MedicineModel->fetchUnit($id);
		echo json_encode($res);
	}

	public function fetchMedName(){
		$medId = $this->input->post('medId');
		if (isset($medId) && $medId != ''){
			$res = $this->MedicineModel->fetchMedName($medId);
		} else{
			$res = $this->MedicineModel->fetchMedName(0);
		}
		echo json_encode($res);
	}

	public function updateMedDetails(){
		$hideMedName = $this->input->post('hideMedName');
		$hideMedDesc = $this->input->post('hideMedDesc');
		$hideDisId = $this->input->post('hideDisId');
		$newMedName = $this->input->post('newMedName');
		$newMedDesc = $this->input->post('newMedDesc');
		$newDisId = $this->input->post('newDisId');
		$medId = $this->input->post('medId');
		if ($hideMedName == $newMedName){
			$newMedName = '';
		}
		if ($hideMedDesc == $newMedDesc){
			$newMedDesc = '';
		}
		if ($hideDisId == $newDisId){
			$newDisId = 0;
		}

		$data = array(
			'updatedMedName' => $newMedName,
			'updatedMedDescription' => $newMedDesc,
			'updatedDisId' => $newDisId,
			'medId' => $medId,
			'type' => 1,
			'status' => 0,
			'updatedBy' => $this->session->userdata('uId'),
			'createdAt' => date('Y-m-d H:i:s', now('Asia/Kolkata'))
		);
//		print_r($data);

		$res = $this->MedicineModel->updateMedDetails($data);
		echo json_encode($res);
	}

	public function change($id=0){
		$permission = $this->input->post('permission');
		if (isset($permission)){
			echo $this->MedicineModel->permission(0,$id);
//			redirect('pharmacist');

			die();
		}

		$data['details'] = $this->MedicineModel->permission(1,$id);
		$data['disease'] = $this->MedicineModel->fetchDisease();

//		print_r($data['details']->medName);

		$this->load->view('pharmacist/change-details', $data);
	}

}

/* End of file Medicine.php */
