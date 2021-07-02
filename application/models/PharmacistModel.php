<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PharmacistModel extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function getDetail($id){
		$this->db->where('pharId', $id);
		$query = $this->db->get('pharmacist');
		$row = $query->row();
		if($row->cityId != 0){
			$this->db->where('cityId', $row->cityId);
			$queryCity = $this->db->get('city');
			$rowCity = $queryCity->row();
		}

		return array(
			"pharId" => $row->pharId,
			"profileImg" => $row->profileImg,
			"username" => $row->username,
			"email" => $row->email,
			"phone" => $row->phone,
			"description" => $row->description,
			"address" => $row->address,
			"pincode" => $row->pincode,
			"cityId" => $row->cityId,
			"stateId" => (isset($rowCity))? $rowCity->stateId : 0,
			"dptId" => $row->dptId,
		);
	}

	public function updateProfile($id,$data){

		$this->db->where('pharId', $id);
		$val = $this->db->update('pharmacist', $data);
		return $val;
	}

	public function pharmacistType(){
		$query = $this->db->query("select * from doctor_pharmacist_type ORDER BY dptId DESC limit 2");

		foreach ($query->result() as $row)
		{
			$type[] = array(
				'dptId' => $row->dptId,
				'type' => $row->type
			);
		}
		return $type;
	}

	public function fetchPharmacistList(){
		$query = $this->db->get('pharmacist');

		$rec = array();
		foreach ($query->result() as $row)
		{
			$emptyRow = $this->db->query("
				SELECT SUM(CASE
				   WHEN address is null or COALESCE(TRIM(address), '') = '' THEN 1
				   WHEN description is null or COALESCE(TRIM(description), '') = '' THEN 1
				   ELSE 0 END
			   	) as empty_fields FROM pharmacist WHERE pharId = $row->pharId;");

			$emptyRow = $emptyRow->row()->empty_fields;

			$rec[] = array(
				'pharId' => $row->pharId,
				'username' => $row->username,
				'email' => $row->email,
				'joindate' => date('d M Y', strtotime($row->joindate)),
				'address' => $row->address,
				'totalMed' => $this->countMed($row->pharId),
				'status' => $row->status,
				'profile' => $emptyRow,
			);
		}

		return $rec;
	}

	public function pharmacistDetail($id){
		$this->db->where('pharId', $id);
		$query = $this->db->get('pharmacist');
		$row = $query->row();
		if($row->cityId != 0){
			$this->db->where('cityId', $row->cityId);
			$this->db->join('state s', 'c.stateId = c.stateId');
			$queryCity = $this->db->get('city c');
			$rowCity = $queryCity->row();
		}

		if ($row->dptId != 0){
			$this->db->where('dptId', $row->dptId);
			$rowDP = $this->db->get('doctor_pharmacist_type')->row();
			$dpType = $rowDP->type;
		}

		return array(
			"pharId" => $row->pharId,
			"username" => $row->username,
			"email" => $row->email,
			"phone" => $row->phone,
			"description" => $row->description,
			"address" => $row->address,
			"pincode" => $row->pincode,
			"cityName" => (isset($rowCity))? $rowCity->cityName : '',
			"stateName" => (isset($rowCity))? $rowCity->stateName : '',
			'status' => (($row->status == 1) ? 'Verified' : (($row->status == 2)? 'Preferred' : 'Not Verified')),
			'joindate' => date('d M Y', strtotime($row->joindate)),
			'dpType' => (isset($dpType)) ? $dpType: '',
		);
	}

	public function fetchPhar($id)
	{
		$this->db->where('pharId', $id);
		$row = $this->db->get('pharmacist')->row();

		$pharmacist = array(
			'pharId' => $row->pharId,
			'username' => $row->username,
			'status' => $row->status,
		);
		return $pharmacist;
	}

	public function updateStatus(){
		$pharId = $this->input->post('pharId');
		$pharStatus = $this->input->post('pharStatus');

		$this->db->set('status', $pharStatus);
		$this->db->set('updatedAt', date('Y-m-d H:i:s', now('Asia/Kolkata')));
		$this->db->where('pharId', $pharId);
		$this->db->update('pharmacist');

	}

	public function queue()
	{
		$pharId = $this->session->userdata('uId');
		$query  =  $this->db
						->select('p.username,op.pId,p.profileImg')
						->where('op.pharId', $pharId)
						->where('op.status', 0)
						->join('patient p','p.pId=op.pId')
						->order_by('op.buyDatetime')
						->group_by('op.pId')
						->get('order_pharmacy op');

		$res = array();
		foreach ($query->result() as $row)
		{
			$res[] = array(
				'pId' => $row->pId,
				'profileImg' => $row->profileImg,
				'username' => $row->username,
			);
		}

		return $res;
	}

	public function fetchPrescriptionDetails($pId)
	{
		$this->load->model('MedicineModel');
		$pharId	= $this->session->userdata('uId');
		$rowP = $this->db->select('username')->where('pId', $pId)->get('patient')->row();
		$query  =  $this->db
						->select('op.opId,p2.pwmId,p2.dineSuggestion,p2.timesPerDay,p2.qty')
						->where('pId', $pId)
						->where('op.status', 0)
						->where('pharId', $pharId)
						->join('prescription p2','op.presId = p2.presId')
						->get('order_pharmacy op');

		$res = array();
		foreach ($query->result() as $row)
		{
			if ($row->timesPerDay == 7)
			{
				$times = 'morning - noon - night';
			} elseif ($row->timesPerDay == 6)
			{
				$times = 'noon - night';
			} elseif ($row->timesPerDay == 3)
			{
				$times = 'morning - noon';
			} elseif ($row->timesPerDay == 1)
			{
				$times = 'morning';
			} elseif ($row->timesPerDay == 5)
			{
				$times = 'morning - night';
			} elseif ($row->timesPerDay == 2)
			{
				$times = 'noon';
			} elseif ($row->timesPerDay == 4)
			{
				$times = 'night';
			}

			$med = $this->MedicineModel->fetchMedicine($row->pwmId, 1);

			$res[] = array(
				'opId' => $row->opId,
				'dineSuggestion' => $row->dineSuggestion,
				'qty' => $row->qty,
				'times' => $times,
				'medName' => $med['medName'] . ' ' . $med['dose'],
			);
		}

		return array(
			'patient' => $rowP->username,
			'pres' => $res
		);
	}

	public function data()
	{
		$opIds = $this->input->post('opId');

		foreach ($opIds as $op_id)
		{
			$this->db->where('opId', $op_id)
					->set('status', 1)
					->update('order_pharmacy');
		}
	}

	function checkReview($pharId,$pId){
		if ($_SESSION['userType']==3)
		{
			if ($pId != 0)
			{
				$rowDPT = $this->db->select("dptId")->where('pharId', $pharId)->get('pharmacist')->row();
				if ($rowDPT->dptId == 4)
				{
					$query = $this->db->select('om.pId')
						->where('om.pId', $pId)
						->where('pwm.pharId', $pharId)
						->join('order_item oi', 'om.orderId=oi.orderId')
						->join('pharmacist_wise_medicine pwm', 'pwm.pwmId=oi.pwmId')
						->get('order_medicine om');

				} elseif ($rowDPT->dptId == 3)
				{
					$query = $this->db->select("op.pId")
						->where('op.pId', $pId)
						->where('op.pharId', $pharId)
						->get('order_pharmacy op');
				}
				if ($query->num_rows() > 0)
				{
					return 1;
				} else
				{
					return 0;
				}
			} else
			{
				return 0;
			}
		} return 0;
	}

	function saveReview(){
		$pharId = $this->input->post('pharId');
		$pId = $this->session->userdata('uId');

		$insData = array(
			'description' => $this->input->post('description'),
			'rates' => $this->input->post('rating'),
			'pId' => $pId,
			'userId' => $pharId,
			'userType' => 2,
			'datetime' => date('Y-m-d H:i:s',now('Asia/Kolkata')),
		);

		$this->db->insert('rating', $insData );
	}

	function fetchReview($pharId){
		$queryCnt = $this->db->where('userId', $pharId)
			->where('userType', 2)
			->order_by('datetime', 'desc')
			->get('rating');
		$cnt = $queryCnt->num_rows();

		$query = $this->db
			->select('rates,r.description,r.datetime,p.username,p.profileImg')
			->where('userId', $pharId)
			->where('userType', 2)
			->order_by('datetime', 'desc')
			->join('patient p', 'p.pId=r.pId')
			->get('rating r');

		$res = array();
		foreach ($query->result() as $row)
		{
			$post_date = strtotime($row->datetime);
			$now = date('Y-m-d',now('Asia/Kolkata'));

			$res[] = array(
				'rates' => $row->rates,
				'profileImg' => $row->profileImg,
				'description' => $row->description,
				'username' => $row->username,
				'datetime' => timespan($post_date, $now, 1),
			);
		}

		return array(
			'count' => $cnt,
			'rate' => $res,
		);
	}

	function avgRating($pharId){
		$row = $this->db->select_avg('rates','rates')
			->where('userType', 2)
			->where('userId', $pharId)
			->get('rating')->row();

		return floor($row->rates);
	}

	function countMed($pharId){
		$row = $this->db->query("select count(*) as totalMed from pharmacist_wise_medicine where pharId = $pharId and deleted = 0")->row();

		return $row->totalMed;
	}

	function fetchPatient(){
		$pharId = $this->session->userdata('uId');
		$dpt = $_SESSION['dptId'];
		if ($dpt==4 || $dpt==0)
		{
			$query = $this->db->query("select om.orderId,p.username,om.datetime,p.email from  order_medicine om join order_item oi on om.orderId = oi.orderId join pharmacist_wise_medicine pwm on oi.pwmId = pwm.pwmId join patient p on om.pId = p.pId where pwm.pharId=$pharId group by p.pId");
		} elseif ($dpt == 3){
			$query = $this->db->query("select distinct(op.pId), opId as orderId,username,phone as email,buyDatetime as datetime  from order_pharmacy op join prescription p on op.presId = p.presId join patient p2 on op.pId = p2.pId where pharId=$pharId group by pId");
		}

		$res = array();
		foreach ($query->result() as $row)
		{
			$res[] = array(
				'orderId' => $row->orderId,
				'username' => $row->username,
				'datetime' => date('d M Y',strtotime($row->datetime)),
				'email' => $row->email,
			);
		}

		return $res;
	}

	public function dashboard()
	{
		$uId = $this->session->userdata('uId');
		$rowMedicine = $this->db->query("select count(*) as med from pharmacist_wise_medicine where pharId=$uId and deleted=0")->row();
		$rowWallet = $this->db->query("select amount from wallet where userTypeId=2 and userId=$uId")->row();
		$rowPhar = $this->db->select('dptId')->where('pharId',$uId)->get('pharmacist')->row();
		if ($rowPhar->dptId == 4)
		{
			$query = $this->db->query("select distinct (pId),sum(qty) as sold from order_medicine join order_item oi on order_medicine.orderId = oi.orderId join pharmacist_wise_medicine pwm on oi.pwmId = pwm.pwmId where pwm.pharId=$uId group by pId");
			$queryGraph = $this->db->query("select sum(qty) as cnt,substr(datetime,1,10) as date from order_medicine join order_item oi on order_medicine.orderId = oi.orderId join pharmacist_wise_medicine pwm on oi.pwmId = pwm.pwmId where pwm.pharId=$uId group by substr(datetime,1,10)");
		} elseif ($rowPhar->dptId == 3){
			$query = $this->db->query("select distinct(pId),sum(qty) as sold from order_pharmacy op join prescription p on op.presId = p.presId where pharId=$uId group by pId");
			$queryGraph = $this->db->query("select sum(qty) as cnt,substr(buyDatetime,1,10) as date from order_pharmacy op join prescription p on op.presId = p.presId where pharId=$uId group by substr(buyDatetime,1,10)");

		}

		$sold = 0;
		$patient = 0;

		foreach ($query->result() as $row)
		{
			$sold += $row->sold;
			$patient++;
		}

		$newPatientDate = array();
		$newPatientCnt[0] = 0;

		foreach ($queryGraph->result() as $k => $row)
		{
			$newPatientDate[] = ''.$row->date.'';
			$newPatientCnt[$k] = (isset($newPatientCnt[$k-1])?$newPatientCnt[$k-1] : 0) + $row->cnt;
		}
		$date = implode("','",$newPatientDate);
		$cnt = implode(',',$newPatientCnt);


		return array(
			'patient' => $patient,
			'sold' => $sold,
			'med' => $rowMedicine->med,
			'wallet' => $rowWallet->amount,
			'medicineDate' => $date,
			'medicineCnt' => $cnt,
		);
	}

	public function fetchPharAdminPdf()
	{
		$time = $this->input->post('time_period');
		if ($time != ''&&isset($time))
		{
			$dates = explode('/', $time);

			$query = $this->db->query("select * from pharmacist where substr(joindate,1,10) between '". date('Y-m-d',strtotime($dates[0])) ."' and '". date('Y-m-d',strtotime($dates[1])) ."'");
		} else
		{
			$query = $this->db->get('pharmacist');
		}

		$rec = array();
		foreach ($query->result() as $row)
		{
			$emptyRow = $this->db->query("
				SELECT SUM(CASE
				   WHEN address is null or COALESCE(TRIM(address), '') = '' THEN 1
				   WHEN description is null or COALESCE(TRIM(description), '') = '' THEN 1
				   ELSE 0 END
			   	) as empty_fields FROM pharmacist WHERE pharId = $row->pharId;");

			$emptyRow = $emptyRow->row()->empty_fields;

			$rec[] = array(
				'pharId' => $row->pharId,
				'username' => $row->username,
				'email' => $row->email,
				'joindate' => date('d M Y', strtotime($row->joindate)),
				'address' => $row->address,
				'totalMed' => $this->countMed($row->pharId),
				'status' => (($row->status == 0) ? 'Not Verified' : (($row->status == 1) ? 'Verified' : 'Preferred' ) ),
				'profile' => (($emptyRow == 0) ? 'Completed' : 'Pending'),
			);
		}

		return $rec;
	}

	function fetchPharPatinetAdminPdf($pharId,$dpt){
		$time = $this->input->post('time_period');
		$dates = explode('/', $time);

		if ($dpt==4 || $dpt==0)
		{
			$query = $this->db->query("select om.orderId,p.username,om.datetime,p.email,om.pId from  order_medicine om join order_item oi on om.orderId = oi.orderId join pharmacist_wise_medicine pwm on oi.pwmId = pwm.pwmId join patient p on om.pId = p.pId where pwm.pharId=$pharId and  substr(om.datetime,1,10) between '". date('Y-m-d',strtotime($dates[0])) ."' and '". date('Y-m-d',strtotime($dates[1])) ."' group by p.pId");
		} elseif ($dpt == 3){
			$query = $this->db->query("select distinct(op.pId), opId as orderId,username,phone,op.pId as email,buyDatetime as datetime  from order_pharmacy op join prescription p on op.presId = p.presId join patient p2 on op.pId = p2.pId where pharId=$pharId  and  substr(op.buyDatetime,1,10) between '". date('Y-m-d',strtotime($dates[0])) ."' and '". date('Y-m-d',strtotime($dates[1])) ."' group by op.pId");
		}

		$res = array();
		foreach ($query->result() as $row)
		{
			$res[] = array(
				'pId' => $row->pId,
				'orderId' => $row->orderId,
				'username' => $row->username,
				'datetime' => date('d M Y',strtotime($row->datetime)),
				'email' => $row->email,
			);
		}

		return $res;
	}

	public function offlinePhar()
	{
		$query = $this->db->where('dptId', 3)->get('pharmacist');

		$res = array();
		foreach ($query->result() as $row)
		{
			$res[] = array(
				'pharId' => $row->pharId,
				'pharName' => $row->username,
			);
		}
		return $res;
	}

	public function addPhar()
	{
		$pharId = $this->input->post('pharId');
		$docId = $this->session->userdata('uId');
		$insData = array(
			'docId' => $docId,
			'pharId' => $pharId,
			'createdAt' => date('Y-m-d H:i:s',now('Asia/Kolkata'))
		);
		$this->db->insert('doctor_pharmacist', $insData);
	}

	public function fetchOfflinePhar($docId)
	{
		$query = $this->db->where('docId', $docId)->where('deleted', 0)->join('pharmacist p','p.pharId=dp.pharId')->get('doctor_pharmacist dp');
		$res = array();

		foreach ($query->result() as $row)
		{
			$res[] = array(
				'dophId' => $row->dophId,
				'pharId' => $row->pharId,
				'username' => $row->username,
			);
		}
		return $res;
	}

	public function deletePhar($dophId)
	{
		$this->db->where('dophId', $dophId)->set('deleted',1)->set('deletedAt',date('Y-m-d H:i:s',now('Asia/Kolkata')))->update('doctor_pharmacist');
	}

}

/* End of file PharmacistModel.php */
