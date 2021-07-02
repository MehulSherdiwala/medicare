<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AppointmentModel extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	function fetchType($type){
		$res = array();
		if ($type==0){
			$this->db->select('docId,username');
			$this->db->where('status >', 0);
			$this->db->where('dptId', 1);
			$query = $this->db->get('doctor');

			foreach ($query->result() as $row)
			{
				$res[] = array(
					'id' => $row->docId,
					'name' => $row->username,
				);
			}
		} else{
			$this->db->select('dcId,clinicName,username');
			$this->db->where('doctor.dptId', 1);
			$this->db->join('doctor', 'doctor.docId = doctor_clinic.docId');
			$query = $this->db->get('doctor_clinic');

			foreach ($query->result() as $row)
			{
				$res[] = array(
					'id' => $row->dcId,
					'name' => $row->clinicName
				);
			}
		}
		return $res;
	}

	function fetchSchedule($type,$id){
		if ($type==1){
			$this->db->select('docId');
			$this->db->where('docId', $id);
			$rowClinic = $this->db->get('doctor_clinic')->row();
			$id = $rowClinic->docId;

		}
		$this->db->select('price');
		$this->db->where('docId', $id);
		$rowDoc = $this->db->get('doctor')->row();

		$this->db->distinct();
		$this->db->select('doctor_active_time.wdId,day');
		$this->db->where('docId', $id);
		$this->db->where('deleted', 0);
		$this->db->order_by('doctor_active_time.wdId', 'asc');
		$this->db->join('doctor_working_day', 'doctor_working_day.wdId = doctor_active_time.wdId');
		$query = $this->db->get('doctor_active_time');

		$sch = array();
		foreach ($query->result() as $row)
		{
			$time = '';
			$this->db->select('startTime,endTime');
			$this->db->where('wdId', $row->wdId);
			$this->db->where('deleted', 0);
			$queryTime = $this->db->get('doctor_active_time');
			foreach ($queryTime->result() as $rowTime)
			{
				if ($time != ''){
					$time .= ' <br> ';
				}
				$time .= date('h:i A',strtotime($rowTime->startTime)) . ' - ' . date('h:i A',strtotime($rowTime->endTime));
			}
			$sch[] = array(
				'day' => $row->day,
				'time' => $time,
				'price' => $rowDoc->price
			);
		}
		return $sch;
	}

	function fetchTimeSlot(){
		$id = $this->input->post('id');
		$type = $this->input->post('type');
		$date = $this->input->post('date');

		$day = date('w',strtotime($date));
//		echo date('w',strtotime($date));

		$set = array(
			(($day == 0)? 7 : $day),
			(($day >= 1 && $day <= 5)? 8 : 0),
			(($day >= 1 && $day <= 6)? 9 : 0),
			(($day >= 0 && $day <= 6)? 10 : 0),
		);
		$wdId = implode(',',$set);

		if ($type == 1){
			$this->db->select('docId');
			$this->db->where('docId', $id);
			$rowClinic = $this->db->get('doctor_clinic')->row();
			$id = $rowClinic->docId;
		}

		$query = $this->db->query("select * from doctor_active_time where docId = $id and wdId in ($wdId) and deleted = 0");

		$res = array();
		foreach ($query->result() as $row)
		{
			$res[] = array(
				'time' => date('h:i A',strtotime($row->startTime)) . ' - ' . date('h:i A',strtotime($row->endTime)),
				'acId' => $row->acId
			);
		}
		return $res;

	}

	function checkAvailability(){
		$id = $this->input->post('id');
		$type = $this->input->post('type');
		$date = date('Y-m-d H:i:s',strtotime($this->input->post('date')));
		$timeSlot = $this->input->post('timeSlot');

		if ($type == 1){
			$this->db->select('docId');
			$this->db->where('docId', $id);
			$rowClinic = $this->db->get('doctor_clinic')->row();
			$id = $rowClinic->docId;
		}

		$row = $this->db->query("select (select count(appId) as cnt from doctor_appointment where acId=$timeSlot and docId = $id and datetime='$date')*estimatedTime as totalTime from doctor where docId=$id")->row();

		$this->db->where('acId', $timeSlot);
		$time = $this->db->get('doctor_active_time')->row();

		$timeSpan = (strtotime($time->endTime) - strtotime($time->startTime)) / 60;

		if ($timeSpan > $row->totalTime){
			return "At ".date('h:i A',strtotime('+'.$row->totalTime.' minutes',strtotime($time->startTime)))." *";
		} else {
			return 0;
		}

	}

	function book(){
		$id = $this->input->post('id');
		$type = $this->input->post('type');
		$date = date('Y-m-d H:i:s',strtotime($this->input->post('date')));
		$timeSlot = $this->input->post('timeSlot');
		$desc = $this->input->post('desc');
		$price = $this->input->post('price');
		$paytype = $this->input->post('paytype');
		$pId = $this->session->userdata('uId');

		if ($type == 1){
			$this->db->select('docId');
			$this->db->where('docId', $id);
			$rowClinic = $this->db->get('doctor_clinic')->row();
			$id = $rowClinic->docId;
		}

		$insData = array(
			'description' => $desc,
			'datetime' => $date,
			'status' => 0,
			'acId' => $timeSlot,
			'docId' => $id,
			'pId' => $pId,
			'dptId' => 1,
			'createdAt' => date('Y-m-d H:i:s', now('Asia/Kolkata')),
		);

		 $appId = $this->db->insert('doctor_appointment', $insData);

		$pId = $this->session->userdata('uId');
		$userType = $this->session->userdata('userType');

		$this->db->select('walletId');
		$this->db->where('userId', $pId);
		$this->db->where('userTypeId', $userType);
		$wallet = $this->db->get('wallet')->row();

		if($paytype != 'wallet')
		{
			$rec = array(
				'amount' => $price,
				'tranType' => 0,
				'walletId' => $wallet->walletId,
				'datetime' => date('Y-m-d H:i:s', now('Asia/Kolkata')),
			);

			$this->db->insert('bank_transaction', $rec);
			$this->db->set('amount', "amount+$price", FALSE);
			$this->db->where('walletId', $wallet->walletId);
			$this->db->update('wallet');
		}

		$this->db->set('amount', "amount-$price", FALSE);
		$this->db->where('walletId', $wallet->walletId);
		$this->db->update('wallet');

		$pay = array(
			'amount' => $price,
			'appId' => $appId,
			'pId' => $pId,
			'appType' => 0,
			'datetime' => date('Y-m-d H:i:s', now('Asia/Kolkata')),
		);
		$this->db->insert('payment_doctor', $pay);

		$rowRate = $this->db->where('userType', 1)->get('commission_rate')->row();

		$commission = floor(($price * $rowRate->rate)/100);
		$finalAmount = $price - $commission;
		$insData = array(
			'amount' => $commission,
			'crId' => $rowRate->crId,
			'userId' => $id,
			'datetime' => date('Y-m-d H:i:s',now('Asia/Kolkata')),
		);
		$this->db->insert('commission_transaction', $insData);


		$this->db->select('walletId');
		$this->db->where('userId', $id);
		$this->db->where('userTypeId', 1);
		$wallet = $this->db->get('wallet')->row();


		$this->db->set('amount', "amount+$finalAmount", FALSE);
		$this->db->where('walletId', $wallet->walletId);
		$this->db->update('wallet');

		$this->db->set('amount', "amount+$commission", FALSE);
		$this->db->where('userTypeId', 4);
		$this->db->where('userId', 1);
		$this->db->update('wallet');
	}

	function icBook(){
		$pId = $this->session->userdata('uId');
		$paytype = $this->input->post('paytype');
		$price = $this->input->post('icprice');
		$insData = array(
			'datetime' => date('Y-m-d H:i:s', now('Asia/Kolkata')),
			'status' => 0,
			'dptId' => 2,
			'pId' => $pId
		);

		$this->db->insert('instant_cure_appointment', $insData);

		$userType = $this->session->userdata('userType');

		$this->db->select('walletId');
		$this->db->where('userId', $pId);
		$this->db->where('userTypeId', $userType);
		$wallet = $this->db->get('wallet')->row();

		if($paytype != 'wallet')
		{
			$rec = array(
				'amount' => $price,
				'tranType' => 0,
				'walletId' => $wallet->walletId,
				'datetime' => date('Y-m-d H:i:s', now('Asia/Kolkata')),
			);

			$this->db->insert('bank_transaction', $rec);
			$this->db->set('amount', "amount+$price", FALSE);
			$this->db->where('walletId', $wallet->walletId);
			$this->db->update('wallet');
		}

		$this->db->set('amount', "amount-$price", FALSE);
		$this->db->where('walletId', $wallet->walletId);
		$this->db->update('wallet');

		$this->db->set('amount', "amount+$price", FALSE);
		$this->db->where('userTypeId', 4);
		$this->db->where('userId', 1);
		$this->db->update('wallet');
	}

	function view(){
		$pId = $this->session->userdata('uId');
		$query = $this->db
			->select('da.datetime,d.username,d.description,da.appId, d.docId,da.acId,da.status')
			->where('da.pId', $pId)
			->order_by('da.datetime', 'desc')
			->join('doctor d','d.docId=da.docId')
//			->join('patient p','p.pId=da.pId')
			->get("doctor_appointment da");

		$res = array();
		foreach ($query->result() as $row)
		{
			$row_time = $this->db->query("select (select count(appId) as cnt from doctor_appointment where acId=$row->acId and docId = $row->docId and datetime='$row->datetime')*estimatedTime as totalTime from doctor where docId=$row->docId")->row();

			$this->db->where('acId', $row->acId);
			$time = $this->db->get('doctor_active_time')->row();

			$res[] = array(
				'docId' => $row->docId,
				'username' => $row->username,
				'description' => $row->description,
				'status' => $row->status,
				'time' => "At ".date('h:i A',strtotime('+'.$row_time->totalTime.' minutes',strtotime($time->startTime)))." *",
				'datetime' => date('d M Y', strtotime($row->datetime)),
				'enable' => ((date('d M Y', strtotime($row->datetime)) == date('d M Y', now('Asia/Kolkata')))? (date('H:i',strtotime($time->endTime)) > date('H:i', now('Asia/Kolkata')) && date('H:i',strtotime($time->startTime)) < date('H:i', now('Asia/Kolkata')))? 1:0 : 0)
			);
		}
		return $res;
	}

	function checkIC(){
		$pId = $this->session->userdata('uId');
		$userType = $this->session->userdata('userType');

		if ($userType == 3)
		{
			$query = $this->db->where('pId', $pId)
				->order_by('datetime', 'desc')
				->limit('1')
				->get('instant_cure_appointment');

			if ($query->num_rows() > 0)
			{
				if ($query->row()->status == 2)
				{
					$row = 0;
				} else
				{
					$row = $query->row()->icappId;
				}
			} else
			{
				$row = 0;
			}

			return $row;
		} else{
			return 0;
		}
	}

	function fetchAppList(){
		$docId = $this->session->userdata('uId');

		$query = $this->db->select('p.username,da.status,da.datetime,da.description,da.appId')
							->where('docId', $docId)
							->join('patient p','p.pId=da.pId')
							->order_by('datetime','desc')
							->get('doctor_appointment da');

		$res = array();
		foreach ($query->result() as $row)
		{
			$res[] = array(
				'appId' => $row->appId,
				'description' => $row->description,
				'username' => $row->username,
				'status' => $row->status,
				'datetime' => date('d M Y',strtotime($row->datetime)),
			);
		}
		return $res;
	}

	function fetchAppointmentPdf($docId){
		$time = $this->input->post('time_period');
		if(isset($time) && $time != '')
		{
			$dates = explode('/', $time);
			$query = $this->db->query("select p.username,da.status,da.datetime,da.description,da.appId from doctor_appointment da join patient p on p.pId=da.pId where docId=$docId  and substr(da.datetime,1,10) between '". date('Y-m-d',strtotime($dates[0])) ."' and '". date('Y-m-d',strtotime($dates[1])) ."' order by da.datetime desc");
		}else
		{
			$query = $this->db->select('p.username,da.status,da.datetime,da.description,da.appId')
				->where('docId', $docId)
				->join('patient p', 'p.pId=da.pId')
				->order_by('datetime', 'desc')
				->get('doctor_appointment da');
		}
		$res = array();
		foreach ($query->result() as $row)
		{
			$res[] = array(
				'appId' => $row->appId,
				'description' => $row->description,
				'username' => $row->username,
				'status' => (($row->status==0)? 'Pending' : 'Completed'),
				'datetime' => date('d M Y',strtotime($row->datetime)),
			);
		}

		return $res;
	}

	function fetchAppStatusWisePdf($docId,$status){
		if ($status==2)
			$status=0;
		elseif ($status==3)
			$status=1;
		$time = $this->input->post('time_period');
		if(isset($time) && $time != '')
		{
			$dates = explode('/', $time);
			$query = $this->db->query("select p.username,da.status,da.datetime,da.description,da.appId from doctor_appointment da join patient p on p.pId=da.pId where docId=$docId  and substr(da.datetime,1,10) between '". date('Y-m-d',strtotime($dates[0])) ."' and '". date('Y-m-d',strtotime($dates[1])) ."' and da.status=$status order by da.datetime desc");
		}else
		{
			$query = $this->db->select('p.username,da.status,da.datetime,da.description,da.appId')
				->where('docId', $docId)
				->where('da.status', $status)
				->join('patient p', 'p.pId=da.pId')
				->order_by('datetime', 'desc')
				->get('doctor_appointment da');
		}
		$res = array();
		foreach ($query->result() as $row)
		{
			$res[] = array(
				'appId' => $row->appId,
				'description' => $row->description,
				'username' => $row->username,
				'status' => (($row->status==0)? 'Pending' : 'Completed'),
				'datetime' => date('d M Y',strtotime($row->datetime)),
			);
		}

		return $res;
	}
}

/* End of file AppointmentModel.php */
