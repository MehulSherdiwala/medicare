<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CommissionModel extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function fetchCommission($crId)
	{
		if ($crId==0){
			$query = $this->db->join('user_type ut', 'ut.userTypeId=userType')->get('commission_rate c');
		} else {
			$query = $this->db->where('crId',$crId)->join('user_type ut', 'ut.userTypeId=userType')->get('commission_rate c');
		}

		$res = array();
		foreach ($query->result() as $row)
		{
			$res[] = array(
				'crId' => $row->crId,
				'rate' => $row->rate,
				'userType' => $row->user,
			);
		}
		return $res;
	}

	public function editCommission($crId)
	{
		$rate = $this->input->post('rate');

		$this->db->where('crId', $crId)
				->set('rate',$rate)
				->update('commission_rate');
	}

	public function commissionList($ctId)
	{
		if ($ctId == 0)
		{
			$query = $this->db->query('select *,(select sum(amount) from commission_transaction where crId=cr.crId and userId=cr.userId) as total from commission_transaction cr group by userId,crId');

			$res = array();
			foreach ($query->result() as $row)
			{
				if ($row->crId == 1)
				{
					$rowUser = $this->db->select('username')->where('docId', $row->userId)->get('doctor')->row();
				} elseif ($row->crId == 2)
				{
					$rowUser = $this->db->select('username')->where('pharId', $row->userId)->get('pharmacist')->row();
				}
				$res[] = array(
					'ctId' => $row->ctId,
					'userType' => (($row->crId == 2) ? 'Pharmacist' : 'Doctor'),
					'username' => $rowUser->username,
					'total' => $row->total,
				);
			}
			return $res;
		} else {
			$rowCom = $this->db->where('ctId', $ctId)->get('commission_transaction')->row();

			$query = $this->db->query("select * from commission_transaction where crId=$rowCom->crId and userId=$rowCom->userId");

			$type='';
			if ($rowCom->crId == 1)
			{
				$type = 'Doctors';
				$rowUser = $this->db->select('username')->where('docId', $rowCom->userId)->get('doctor')->row();
			} elseif ($rowCom->crId == 2)
			{
				$type = 'Pharmacist';
				$rowUser = $this->db->select('username')->where('pharId', $rowCom->userId)->get('pharmacist')->row();
			}

			$res = array();
			foreach ($query->result() as $row)
			{
				$res[] = array(
					'ctId' => $row->ctId,
					'datetime' => date('d M Y',strtotime($row->datetime)),
					'amount' => $row->amount,
				);
			}
			return array(
				'username' => $rowUser->username,
				'type' => $type,
				'list' => $res
			);
		}
	}

	public function fetchCommissionUser($userType)
	{
		if ($userType==1)
		{
			$query = $this->db->query("select d.username, ct.userId from commission_transaction ct join doctor d on ct.userId=d.docId where crId=$userType group by userId");
		} elseif ($userType == 2){
			$query = $this->db->query("select p.username, ct.userId from commission_transaction ct join pharmacist p on ct.userId=p.pharId where crId=$userType group by userId");
		}

		$res = array();
		foreach ($query->result() as $row)
		{
			$res[] = array(
				'userId' => $row->userId,
				'username' => $row->username
			);
		}
		return $res;
	}

	public function fetchCommissionListAdminPdf()
	{
		$time = $this->input->post('time_period');
		if ($time != '' && isset($time))
		{
			$dates = explode('/', $time);
			$query = $this->db->query("select *,(select sum(amount) from commission_transaction where crId=cr.crId and userId=cr.userId) as total from commission_transaction cr where substr(datetime,1,10) between '". date('Y-m-d',strtotime($dates[0])) ."' and '". date('Y-m-d',strtotime($dates[1])) ."' group by userId,crId");
		} else
		{
			$query = $this->db->query('select *,(select sum(amount) from commission_transaction where crId=cr.crId and userId=cr.userId) as total from commission_transaction cr group by userId,crId');
		}

		$res = array();
		foreach ($query->result() as $row)
		{
			if ($row->crId == 1)
			{
				$rowUser = $this->db->select('username')->where('docId', $row->userId)->get('doctor')->row();
			} elseif ($row->crId == 2)
			{
				$rowUser = $this->db->select('username')->where('pharId', $row->userId)->get('pharmacist')->row();
			}
			$res[] = array(
				'ctId' => $row->ctId,
				'userType' => (($row->crId == 2) ? 'Pharmacist' : 'Doctor'),
				'username' => $rowUser->username,
				'total' => $row->total,
			);
		}
		return $res;
	}

	public function fetchCommissionListUserAdminPdf($usertype)
	{
		$time = $this->input->post('time_period');
		if ($time != '' && isset($time))
		{
			$dates = explode('/', $time);
			$query = $this->db->query("select *,(select sum(amount) from commission_transaction where crId=cr.crId and userId=cr.userId) as total from commission_transaction cr where cr.crId=$usertype and substr(datetime,1,10) between '". date('Y-m-d',strtotime($dates[0])) ."' and '". date('Y-m-d',strtotime($dates[1])) ."' group by userId,crId");
		} else
		{
			$query = $this->db->query('select *,(select sum(amount) from commission_transaction where crId=cr.crId and userId=cr.userId) as total from commission_transaction cr where cr.crId=$usertype group by userId,crId');
		}

		$res = array();
		foreach ($query->result() as $row)
		{
			if ($row->crId == 1)
			{
				$rowUser = $this->db->select('username')->where('docId', $row->userId)->get('doctor')->row();
			} elseif ($row->crId == 2)
			{
				$rowUser = $this->db->select('username')->where('pharId', $row->userId)->get('pharmacist')->row();
			}
			$res[] = array(
				'ctId' => $row->ctId,
				'userType' => (($row->crId == 2) ? 'Pharmacist' : 'Doctor'),
				'username' => $rowUser->username,
				'total' => $row->total,
			);
		}
		return $res;
	}

	public function fetchCommissionListUserWiseAdminPdf($userType,$userId)
	{

		$query = $this->db->query("select * from commission_transaction where crId=$userType and userId=$userId");

		$type='';
		if ($userType == 1)
		{
			$type = 'Doctor';
			$rowUser = $this->db->select('username')->where('docId', $userId)->get('doctor')->row();
		} elseif ($userType == 2)
		{
			$type = 'Pharmacist';
			$rowUser = $this->db->select('username')->where('pharId', $userId)->get('pharmacist')->row();
		}

		$res = array();
		foreach ($query->result() as $row)
		{
			$res[] = array(
				'ctId' => $row->ctId,
				'datetime' => date('d M Y',strtotime($row->datetime)),
				'amount' => $row->amount,
			);
		}
		return array(
			'username' => $rowUser->username,
			'type' => $type,
			'list' => $res
		);
	}

}

/* End of file CommissionModel.php */
