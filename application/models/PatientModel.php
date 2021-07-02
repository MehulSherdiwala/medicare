<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PatientModel extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function getDetail($id){
		$this->db->where('pId', $id);
		$query = $this->db->get('patient');
		$row = $query->row();
		if($row->cityId != 0){
			$this->db->where('cityId', $row->cityId);
			$queryCity = $this->db->get('city');
			$rowCity = $queryCity->row();
		}

		return array(
			'pId' => $row->pId,
			'profileImg' => $row->profileImg,
			'username' => $row->username,
			'email' => $row->email,
			'phone' => $row->phone,
			'gender' => $row->gender,
			'dob' => date('d-m-Y', strtotime($row->dob)),
			'description' => $row->description,
			'address' => $row->address,
			'pincode' => $row->pincode,
			'cityId' => $row->cityId,
			'stateId' => (isset($rowCity))? $rowCity->stateId : 0,
		);
	}

	public function updateProfile($id,$data){

		$this->db->where('pId', $id);
		$val = $this->db->update('patient', $data);
		return $val;
	}

	public function fetchPatientList()
	{
		$query = $this->db->get('patient');

		$rec = array();
		foreach ($query->result() as $row)
		{
			$emptyRow = $this->db->query("
				SELECT SUM(CASE
				   WHEN address is null or COALESCE(TRIM(address), '') = '' THEN 1
				   WHEN description is null or COALESCE(TRIM(description), '') = '' THEN 1
				   ELSE 0 END
			   	) as empty_fields FROM patient WHERE pId = $row->pId;");

			$emptyRow = $emptyRow->row()->empty_fields;

			$rec[] = array(
				'pId' => $row->pId,
				'username' => $row->username,
				'email' => $row->email,
				'joindate' => date('d M Y', strtotime($row->joindate)),
				'address' => $row->address,
				'status' => $row->status,
				'profile' => $emptyRow,
			);
		}

		return $rec;
	}

	public function fetchPatientDetails($pId)
	{
		$this->db->where('pId', $pId);
		$row = $this->db->get('patient')->row();

		$patient = array(
			'pId' => $row->pId,
			'username' => $row->username,
			'status' => $row->status,
		);
		return $patient;
	}

	public function viewPatientDetail($id){
		$this->db->where('pId', $id);
		$query = $this->db->get('patient');
		$row = $query->row();
		if($row->cityId != 0){
			$this->db->where('cityId', $row->cityId);
			$this->db->join('state s', 'c.stateId = c.stateId');
			$queryCity = $this->db->get('city c');
			$rowCity = $queryCity->row();
		}

		return array(
			"pId" => $row->pId,
			"username" => $row->username,
			"email" => $row->email,
			"phone" => $row->phone,
			"description" => $row->description,
			"address" => $row->address,
			"pincode" => $row->pincode,
			"cityName" => (isset($rowCity))? $rowCity->cityName : '',
			"stateName" => (isset($rowCity))? $rowCity->stateName : '',
			'status' => (($row->status == 1) ? 'Blocked' : 'Allowed' ),
			'joindate' => date('d M Y', strtotime($row->joindate)),
		);
	}

	public function updateStatus(){
		$pId = $this->input->post('pId');
		$pStatus = $this->input->post('pStatus');

		$this->db->set('status', $pStatus);
		$this->db->set('updatedAt', date('Y-m-d H:i:s', now('Asia/Kolkata')));
		$this->db->where('pId', $pId);
		$this->db->update('patient');

	}

	function fetchPatientAdminPdf(){
		$time = $this->input->post('time_period');
		if ($time != ''&&isset($time))
		{
			$dates = explode('/', $time);

			$query = $this->db->query("select * from patient where substr(joindate,1,10) between '". date('Y-m-d',strtotime($dates[0])) ."' and '". date('Y-m-d',strtotime($dates[1])) ."'");
		} else{
			$query = $this->db->get('patient');
		}
		$res= array();
		foreach ($query->result() as $row)
		{
			$emptyRow = $this->db->query("
						SELECT SUM(CASE
						   WHEN address is null or COALESCE(TRIM(address), '') = '' THEN 1
						   WHEN description is null or COALESCE(TRIM(description), '') = '' THEN 1
						   ELSE 0 END
						) as empty_fields FROM patient WHERE pId = $row->pId;");

			$emptyRow = $emptyRow->row()->empty_fields;

			$res[] = array(
				'pId' => $row->pId,
				'username' => $row->username,
				'email' => $row->email,
				'joindate' => date('d M Y', strtotime($row->joindate)),
				'address' => $row->address,
				'status' => (($row->status == 1) ? 'Blocked' : 'Active'),
				'profile' => (($emptyRow == 0) ? 'Completed' : 'Pending'),
			);
		}

		return $res;
	}


}

/* End of file patient.php */
