<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class adminModel extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function adminLogin($user_data){
		$this->db->where($user_data);
		$query = $this->db->get('admin');
		if ($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
			{
				$user_data = array(
					'aId' => $row->aId,
					'username' => $row->username,
					'profileImg' => $row->profileImg,
				);
			}
			return $user_data;
		} else {
			return 0;
		}
	}

	public function fetchAdminList()
	{
		$query = $this->db->get('admin');
		$res = array();

		$res = array();
		foreach ($query->result() as $row)
		{
			$res[] = array(
				'aId' => $row->aId,
				'username' => $row->username,
				'email' => $row->email,
				'status' => $row->status,
				'joindate' => date('d M Y',strtotime($row->datetime)),
			);
		}
		return $res;
	}

	public function fetchAdmin($aId)
	{
		$query = $this->db->where('aId',$aId)->get('admin');
		$res = array();

		$res = array();
		foreach ($query->result() as $row)
		{
			$res = array(
				'aId' => $row->aId,
				'username' => $row->username,
				'email' => $row->email,
				'profileImg' => $row->profileImg,
				'status' => $row->status,
			);
		}
		return $res;
	}

	public function addAdmin($profile)
	{
		$this->load->model('EncDec');
		$username = $this->input->post('username');
		$email = $this->input->post('email');
		$pwd = $this->EncDec->encrypt_decrypt('encrypt',$this->input->post('pwd'));

		$insData =array(
			'username' => $username,
			'email' => $email,
			'pwd' => $pwd,
			'profileImg' => $profile,
			'datetime' => date('Y-m-d H:i:s',now('Asia/Kolkata')),
		);

		$this->db->insert('admin', $insData);

	}

	public function editAdmin($profile)
	{
		$username = $this->input->post('username');
		$email = $this->input->post('email');
		$status = $this->input->post('status');
		$aId = $this->input->post('aId');

		$insData =array(
			'username' => $username,
			'email' => $email,
			'status' => $status,
			'profileImg' => $profile,
		);
		if ($profile == ''){
			array_pop($insData);
		}

		$this->db->where('aId', $aId);
		$this->db->update('admin', $insData);
	}

	public function dashboard()
	{
		$aId = $this->session->userdata('aId');
		$rowPatient = $this->db->query("select count(*) as patient from patient")->row();
		$rowPhar = $this->db->query("select count(*) as phar from pharmacist")->row();
		$rowDoc = $this->db->query("select count(*) as doc from doctor")->row();
		$rowWallet = $this->db->query("select amount from wallet where userTypeId=4 and userId=$aId")->row();

		$query = $this->db->query("select substr(joindate,1,10) as date,count(pId) as cnt from patient  group by substr(joindate,1,10)");
		$newPatientDate = array();
		$newPatientCnt[0] = 0;

		foreach ($query->result() as $k => $row)
		{
			$newPatientDate[] = ''.$row->date.'';
			$newPatientCnt[$k] = (isset($newPatientCnt[$k-1])?$newPatientCnt[$k-1] : 0) + $row->cnt;
		}
		$date = implode("','",$newPatientDate);
		$cnt = implode(',',$newPatientCnt);

		$query = $this->db->query("select substr(joindate,1,10) as date,count(docId) as cnt from doctor  group by substr(joindate,1,10)");
		$newDoctorDate = array();
		$newDoctorCnt[0] = 0;

		foreach ($query->result() as $k => $row)
		{
			$newDoctorDate[] = ''.$row->date.'';
			$newDoctorCnt[$k] = (isset($newDoctorCnt[$k-1])?$newDoctorCnt[$k-1] : 0) + $row->cnt;
		}
		$docDate = implode("','",$newDoctorDate);
		$docCnt = implode(',',$newDoctorCnt);

		$queryPatient = $this->db->select('dob')->get('patient');
		$age = array(
			'0-10' => 1,
			'10-20' => 1,
			'20-30' => 1,
			'30-40' => 1,
		 	'40-100' => 1,
		);

		foreach ($queryPatient->result() as $row)
		{
			$post_date = strtotime($row->dob);
			$now = date('Y-m-d',now('Asia/Kolkata'));
			$a = timespan($post_date, $now, 1);

			if ($a >= 0 && $a <= 10){
				$age['0-10'] += 1;
			} else if ($a > 10 && $a <= 20){
				$age['10-20'] += 1;
			} else if ($a > 20 && $a <= 30){
				$age['20-30'] += 1;
			} else if ($a > 30 && $a <= 40){
				$age['30-40'] += 1;
			} else if ($a > 40 && $a <= 100){
				$age['40-100'] += 1;
			}
		}


		return array(
			'patient' => $rowPatient->patient,
			'phar' => $rowPhar->phar,
			'doc' => $rowDoc->doc,
			'wallet' => $rowWallet->amount,
			'patientDate' => $date,
			'patientCnt' => $cnt,
			'docDate' => $docDate,
			'docCnt' => $docCnt,
			'patientAge' => $age,
		);
	}

}

/* End of file adminModel.php */
