<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DoctorModel extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function getDetail($id){
		$this->db->where('docId', $id);
		$query = $this->db->get('doctor');
		$row = $query->row();
		if($row->cityId != 0){
			$this->db->where('cityId', $row->cityId);
			$queryCity = $this->db->get('city');
			$rowCity = $queryCity->row();
		}

		$this->db->where('docId', $id);
		$query = $this->db->get('doctor_qualification');

		$qualification = array();
		foreach ($query->result() as $rowQF)
		{
			$qualification[] = array(
				'degree' => $rowQF->degree,
				'university' => $rowQF->university,
				'year' => $rowQF->year
			);
		}


		return array(
			'docId' => $row->docId,
			'profileImg' => $row->profileImg,
			"username" => $row->username,
			"email" => $row->email,
			"phone" => $row->phone,
			"gender" => $row->gender,
			"estimatedTime" => $row->estimatedTime,
			"experience" => $row->experience,
			"description" => $row->description,
			"address" => $row->address,
			"pincode" => $row->pincode,
			"cityId" => $row->cityId,
			"price" => $row->price,
			'stateId' => (isset($rowCity))? $rowCity->stateId : 0,
			"dptId" => $row->dptId,
			"qualification" => $qualification,
			"specialization" => $row->specialization,
		);
	}

	public function updateProfile($id,$data){
		$degree = $this->input->post('degree');
		$university = $this->input->post('university');
		$year = $this->input->post('year');

		$this->db->where('docId', $id);
		$this->db->delete('doctor_qualification');

		for ($i = 0; $i < sizeof($degree);$i++){
			if ($degree[$i] != '')
			{
				$insData = array(
					'degree' => $degree[$i],
					'university' => $university[$i],
					'year' => $year[$i],
					'docId' => $id,
				);
				$this->db->insert('doctor_qualification', $insData);
			}
		}

		$this->db->where('docId', $id);
		$val = $this->db->update('doctor', $data);
		return $val;
	}

	public function setUpIC($docId)
	{
		$query = $this->db->where('docId', $docId)->get('instant_cure_doctor');
		if($query->num_rows() == 0){
			$insData = array(
				'docId' => $docId
			);
			$this->db->insert('instant_cure_doctor', $insData);
		}
	}

	public function doctorType(){
		$query = $this->db->query("select * from doctor_pharmacist_type ORDER BY dptId limit 2");
		$type = array();
		foreach ($query->result() as $row)
		{
			$type[] = array(
				'dptId' => $row->dptId,
				'type' => $row->type
			);
		}
		return $type;
	}

	public function updateClinic($id,$clinic){
		$this->db->where('docId', $id);
		$num = $this->db->get('doctor_clinic')->num_rows();

		if ($num > 0){
			$this->db->where('docId', $id);
			$this->db->update('doctor_clinic', $clinic);
		} else {
			$data = array(
				'joindate' => date('Y-m-d H:i:s', now('Asia/Kolkata')),
				'status' => 0,
				'docId' => $id
			);
			$new = array_merge($clinic,$data);
			$this->db->insert('doctor_clinic', $new);
		}
	}

	public function fetchClinic($id){
		$this->db->where('docId', $id);
		$num = $this->db->get('doctor_clinic')->num_rows();

		if ($num > 0){
			$this->db->select('clinic.*,city.stateId');
			$this->db->from('doctor_clinic clinic');
			$this->db->join('city', 'clinic.cityId = city.cityId');
			$this->db->where('docId', $id);
			return $this->db->get()->row();
		} else {
			return '';
		}
	}

	public function fetchDoctorList(){
		$query = $this->db->get('doctor');

		$rec = array();
		foreach ($query->result() as $row)
		{
			$emptyRow = $this->db->query("
				SELECT SUM(CASE
				   WHEN address is null or COALESCE(TRIM(address), '') = '' THEN 1
				   WHEN description is null or COALESCE(TRIM(description), '') = '' THEN 1
				   ELSE 0 END
			   	) as empty_fields FROM doctor WHERE docId = $row->docId;");

			$emptyRow = $emptyRow->row()->empty_fields;

			$this->db->select('clinicName');
			$this->db->where('docId', $row->docId);
			$cquery = $this->db->get('doctor_clinic');
			$clinic = $cquery->row();

			$rec[] = array(
				'docId' => $row->docId,
				'username' => $row->username,
				'email' => $row->email,
				'joindate' => date('d M Y', strtotime($row->joindate)),
				'address' => $row->address,
				'clinicName' => (($cquery->num_rows() > 0) ? $clinic->clinicName : ''),
				'status' => $row->status,
				'profile' => $emptyRow,
			);
		}

		return $rec;
	}

	function doctorDetail($id){
		$this->db->where('docId', $id);
		$row = $this->db->get('doctor')->row();
		$cityName = '';
		$stateName = '';
		$dpType = '';
		if ($row->cityId != 0){
			$this->db->where('cityId' ,$row->cityId);
			$this->db->join('city', 'city.stateId = state.stateId');
			$rowState = $this->db->get('state')->row();
			$cityName = $rowState->cityName;
			$stateName = $rowState->stateName;
		}

		if ($row->dptId != 0){
			$this->db->where('dptId', $row->dptId);
			$rowDP = $this->db->get('doctor_pharmacist_type')->row();
			$dpType = $rowDP->type;
		}

		$doctor = array(
			'docId' => $row->docId,
			'profileImg' => $row->profileImg,
			'username' => $row->username,
			'email' => $row->email,
			'phone' => $row->phone,
			'specialization' => $row->specialization,
			'gender' => (($row->gender == 1) ? 'Male' : (($row->gender == 2)? 'Female' : '')),
			'description' => $row->description,
			'address' => $row->address,
			'pincode' => (($row->pincode==0)? '' : $row->pincode),
			'estimatedTime' => (($row->estimatedTime==0)? '' : $row->estimatedTime),
			'status' => (($row->status == 1) ? 'Verified' : (($row->status == 2)? 'Preferred' : 'Not Verified')),
			'experience' => $row->experience,
			'joindate' => date('d M Y', strtotime($row->joindate)),
			'dpType' => $dpType,
			'cityName' => $cityName,
			'stateName' => $stateName,
		);

		$this->db->where('docId', $id);
		$query = $this->db->get('doctor_qualification');
		$qualification = array();

		foreach ($query->result() as $rowQF)
		{
			$qualification[] = array(
				'university' => $rowQF->university,
				'degree' => $rowQF->degree,
				'year' => $rowQF->year,
			);
		}

		$this->db->where('docId', $id);
		$query = $this->db->get('doctor_clinic');
		$clinic = array();
		if ($query->num_rows() > 0)
		{
			$rowClinic = $query->row();
			if ($rowClinic->cityId != 0){
				$this->db->where('cityId' ,$rowClinic->cityId);
				$this->db->join('city', 'city.stateId = state.stateId');
				$rowState = $this->db->get('state')->row();
				$cityName = $rowState->cityName;
				$stateName = $rowState->stateName;
			}
			$clinic = array(
				'clinicId' => $rowClinic->dcId,
				'clinicName' => $rowClinic->clinicName,
				'clinicDescription' => $rowClinic->clinicDescription,
				'clinicAddress' => $rowClinic->clinicAddress,
				'clinicPincode' => $rowClinic->clinicPincode,
				'joindate' => date('d M Y', strtotime($rowClinic->joindate)),
				'status' => (($rowClinic->status == 1) ? 'Approved' : (($rowClinic->status == 2)? 'Rejected' : 'Pending')),
				'clinicCity' => $cityName,
				'clinicState' => $stateName,
			);
		}

		return array(
			'doctor' => $doctor,
			'qualification' => $qualification,
			'clinic' => $clinic,
		);

	}

	public function fetchDoc($id)
	{
		$this->db->where('docId', $id);
		$row = $this->db->get('doctor')->row();

		$doctor = array(
			'docId' => $row->docId,
			'username' => $row->username,
			'status' => $row->status,
		);

		$this->db->where('docId', $id);
		$query = $this->db->get('doctor_clinic');
		$clinic = array();
		if ($query->num_rows() > 0)
		{
			$rowClinic = $query->row();
			$clinic = array(
				'clinicId' => $rowClinic->dcId,
				'clinicName' => $rowClinic->clinicName,
				'status' => $rowClinic->status,
			);
		}
		return array(
			'doctor' => $doctor,
			'clinic' => $clinic,
		);
	}

	public function updateStatus(){
		$docId = $this->input->post('docId');
		$docStatus = $this->input->post('docStatus');
		$clinicId = $this->input->post('clinicId');
		$clinicStatus = $this->input->post('clinicStatus');

		$this->db->set('status', $docStatus);
		$this->db->set('updatedAt', date('Y-m-d H:i:s', now('Asia/Kolkata')));
		$this->db->where('docId', $docId);
		$this->db->update('doctor');

		if ($clinicId != '' || $clinicId != 0){

			$this->db->set('status', $clinicStatus);
			$this->db->set('updatedAt', date('Y-m-d H:i:s', now('Asia/Kolkata')));
			$this->db->where('dcId', $clinicId);
			$this->db->update('doctor_clinic');
		}
	}

	function fetchScheduleDay(){
		$this->db->order_by('wdId', 'asc');
		$query = $this->db->get('doctor_working_day');

		$day = array();
		foreach ($query->result() as $row)
		{
			$day[] = array(
				'wdId' => $row->wdId,
				'day' => $row->day,
			);
		}

		return $day;
	}

	function saveSchedule(){
		$cnt = 0;
		$days = $this->input->post('day');
		$items = $this->input->post('items');
		$startTime = $this->input->post('startTime');
		$endTime = $this->input->post('endTime');
		$docId = $this->session->userdata('uId');
		$acId = $this->input->post('acId');
		echo $acId;


		$this->db->set('deleted', 1);
		$this->db->where('docId', $docId);
		$this->db->where_not_in('acId', $acId);
		$this->db->update('doctor_active_time');
//		echo $query->num_rows();

		foreach ($days as $k=>$day)
		{
			for ($i=$cnt;$i < $cnt+$items[$k]; $i++){
				if (isset($acId[$i]) && $acId[$i] != 0){
					$upData = array(
						'startTime' => date("H:i:s", strtotime($startTime[$i])),
						'endTime' => date("H:i:s", strtotime($endTime[$i])),
						'wdId' => $day,
						'updatedAt' => date('Y-m-d H:i:s', now('Asia/Kolkata')),
					);
					$this->db->where('acId', $acId[$i]);
					$this->db->update('doctor_active_time', $upData);
				}
				else
				{
					$insData = array(
						'startTime' => date("H:i:s", strtotime($startTime[$i])),
						'endTime' => date("H:i:s", strtotime($endTime[$i])),
						'wdId' => $day,
						'docId' => $docId,
						'createdAt' => date('Y-m-d H:i:s', now('Asia/Kolkata')),
					);
					$this->db->insert('doctor_active_time', $insData);
				}
			}
			$cnt += $items[$k];
		}
	}

	function displaySchedule($docId){
		$this->db->distinct();
		$this->db->select('doctor_active_time.wdId,day');
		$this->db->where('docId', $docId);
		$this->db->where('deleted', 0);
		$this->db->order_by('doctor_active_time.wdId');
		$this->db->join('doctor_working_day', 'doctor_working_day.wdId = doctor_active_time.wdId');
		$query = $this->db->get('doctor_active_time');

		$sch = array();
		foreach ($query->result() as $row)
		{
			$time = '';
			$this->db->select('startTime,endTime');
			$this->db->where('wdId', $row->wdId);
			$this->db->where('docId', $docId);
			$this->db->where('deleted', 0);
			$this->db->order_by('startTime');
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
				'time' => $time
			);
		}

		return $sch;
	}

	function fetchSchedule($docId){
		$this->db->distinct();
		$this->db->select('doctor_active_time.wdId');
		$this->db->where('deleted', 0);
		$this->db->where('docId', $docId);
		$query = $this->db->get('doctor_active_time');

		$sch = array();
		foreach ($query->result() as $row)
		{
			$time = array();
			$this->db->select('startTime,endTime,acId');
			$this->db->where('wdId', $row->wdId);
			$this->db->where('deleted', 0);
			$this->db->where('docId', $docId);
			$queryTime = $this->db->get('doctor_active_time');
			foreach ($queryTime->result() as $rowTime)
			{
				$time[] = array(
					'startTime' => date('h:i A',strtotime($rowTime->startTime)),
					'endTime' => date('h:i A',strtotime($rowTime->endTime)),
					'acId' => $rowTime->acId
				);
			}
			$sch[] = array(
				'day' => $row->wdId,
				'time' => $time
			);
		}

		return $sch;
	}

	function queue($docId){

		$day = date('w',now('Asia/Kolkata'));

		$set = array(
			(($day == 0)? 7 : $day),
			(($day >= 1 && $day <= 5)? 8 : 0),
			(($day >= 1 && $day <= 6)? 9 : 0),
			(($day >= 0 && $day <= 6)? 10 : 0),
		);
		$wdId = implode(',',$set);
		$time = date('H:i:s',now('Asia/Kolkata'));
//		$time = date('H:i:s',strtotime("+1 hour", now('Asia/Kolkata')));
//		$query = $this->db->query("select acId from doctor_active_time where docId = $docId and wdId in ($wdId) and deleted = 0 and  '$time' between startTime and endTime ");
		$query = $this->db->query("select acId from doctor_active_time where docId = $docId and deleted = 0");

		$queue = array();
		if ($query->num_rows() > 0 ){
			$row = $query->row();
			$this->db->select('dp.appId,p.pId,p.username,p.profileImg,dp.description');
			$this->db->where('dp.datetime', date('Y-m-d',now('Asia/Kolkata')).'  00:00:00');
			$this->db->where('acId', $row->acId);
			$this->db->where('dp.status', 0);
			$this->db->order_by('dp.appId', 'asc');
			$this->db->join('patient p', 'dp.pId = p.pId');
			$query = $this->db->get('doctor_appointment dp');

			foreach ($query->result() as $row)
			{
				$queue[] = $row;
			}
		}
		return $queue;

	}

	function fetchCheckupDetails($appId){
		$this->load->model('MedicineModel');
		$this->db->where('appId', $appId);
		$rowApp = $this->db->get('doctor_appointment')->row();

		$this->db->select('dob,username,gender,profileImg');
		$this->db->where('pId', $rowApp->pId);
		$rowPatient = $this->db->get('patient')->row();

		$post_date = strtotime($rowPatient->dob);
		$now = date('Y-m-d',now('Asia/Kolkata'));
		$patient = array(
			'age' => timespan($post_date, $now, 1),
			'name' => $rowPatient->username,
			'profileImg' => $rowPatient->profileImg,
			'gender' => ($rowPatient->gender == 1)? 'Male' : 'Female',
		);

		$PMR = array();
		$PMD = array();
		$Pre = array();
		$this->db->where('docId', $rowApp->docId);
		$this->db->where('pId', $rowApp->pId);
		$queryPMR = $this->db->get('patient_medical_record');

		if	($queryPMR->num_rows() > 0){
			$rowPMR = $queryPMR->row();

			$PMR = array(
				'pmrId' => $rowPMR->pmrId,
				'pmrDescription' => $rowPMR->pmrDescription,
				'datetime' => date('d-m-Y',strtotime($rowPMR->datetime)),
			);

			$this->db->where('pmrId', $rowPMR->pmrId);
			$queryPMD = $this->db->get('patient_medical_record_details');
			if	($queryPMD->num_rows() > 0)
			{

				foreach ($queryPMD->result() as $rowPMD)
				{
					$PMD[] = array(
						'pmdId' => $rowPMD->pmdId,
						'description' => $rowPMD->description,
						'datetime' => date('d-m-Y', strtotime($rowPMD->datetime)),
					);

					$pmdId = $rowPMD->pmdId;

					$this->db->where('pmdId', $rowPMD->pmdId);
					$this->db->order_by('datetime');
					$queryPre = $this->db->get('prescription');

					foreach ($queryPre->result() as $rowPre)
					{
						if ($rowPre->timesPerDay == 7)
						{
							$times = array(
								'morning' => 1,
								'noon' => 1,
								'night' => 1,
							);
						} elseif ($rowPre->timesPerDay == 6)
						{
							$times = array(
								'morning' => 0,
								'noon' => 1,
								'night' => 1,
							);
						} elseif ($rowPre->timesPerDay == 3)
						{
							$times = array(
								'morning' => 1,
								'noon' => 1,
								'night' => 0,
							);
						} elseif ($rowPre->timesPerDay == 1)
						{
							$times = array(
								'morning' => 1,
								'noon' => 0,
								'night' => 0,
							);
						} elseif ($rowPre->timesPerDay == 5)
						{
							$times = array(
								'morning' => 1,
								'noon' => 0,
								'night' => 1,
							);
						} elseif ($rowPre->timesPerDay == 2)
						{
							$times = array(
								'morning' => 0,
								'noon' => 1,
								'night' => 0,
							);
						} elseif ($rowPre->timesPerDay == 4)
						{
							$times = array(
								'morning' => 0,
								'noon' => 0,
								'night' => 1,
							);
						}

						$med = $this->MedicineModel->fetchMedicine($rowPre->pwmId, 1);

						$date = date('d-m-Y', strtotime($rowPre->datetime));

						$Pre[$rowPre->pmdId][$date][] = array(
							'qty' => $rowPre->qty,
							'pwmId' => $rowPre->pwmId,
							'pmdId' => $rowPre->pmdId,
							'medName' => $med['medName'] . ' ' . $med['dose'],
							'dineSuggestion' => $rowPre->dineSuggestion,
							'timesPerDay' => $times,
						);
					}

				}
				$val = $Pre[$pmdId];
				$date = date('d-m-Y', now('Asia/Kolkata'));
				if ( ! array_key_exists($date, $val))
				{
					$Pre[$rowPre->pmdId][$date] = array();
				}
			}
		}

		return array(
			'patient' => $patient,
			'pmr' => $PMR,
			'pmd' => $PMD,
			'pre' => $Pre
		);
	}

	function saveData(){
		$desc = $this->input->post('desc');
		$pmdId = $this->input->post('pmdId');
		$totalMed = $this->input->post('totalMed');
		$pwmId = $this->input->post('pwmId');
		$eat = $this->input->post('eat');
		$times = $this->input->post('times');
		$qty = $this->input->post('qty');
		$appId = $this->input->post('appId');

		$this->db->set('status', 1);
		$this->db->where('appId', $appId);
		$this->db->update('doctor_appointment');
		echo "<pre>";
		print_r ($_POST);
		echo "</pre>";


		echo '<br>';
		$id = array();
		foreach ($pwmId as $k => $i)
		{
			array_push($id,$k);
		}
		$mCnt = 0;
		foreach ($desc as $k => $d)
		{
			$newPmdId = $pmdId[$k];

			if ($newPmdId != 0){
				$this->db->set('description', $d);
				$this->db->where('pmdId', $newPmdId);
				$this->db->update('patient_medical_record_details');
			} else {
				$dataSet = array(
					'datetime' => date('Y-m-d H:i:s', now('Asia/Kolkata')),
					'description' => $d,
					'pmrId'	=> $this->input->post('pmrId')
				);
				$this->db->insert('patient_medical_record_details', $dataSet);
				$newPmdId = $this->db->insert_id();
			}
			echo $d;
			echo $pmdId[$k];
			echo '<br>';
			echo $totalMed[$pmdId[$k]];
			echo '<br>';
			for ($i = $mCnt;$i < $mCnt+$totalMed[$pmdId[$k]];$i++){

				$query = $this->db->select('presId')
							->where('pmdId',$newPmdId)
							->like('datetime',date('Y-m-d',now('Asia/Kolkata')))
							->where('pwmId',$pwmId[$id[$i]])
							->from('prescription')
							->get();
//							->get_compiled_select();

				echo "Row". $query->num_rows();
				if ($query->num_rows() > 0){
					$row = $query->row();
					$dataSet = array(
						'qty' => $qty[$id[$i]],
						'dineSuggestion' => $eat[$id[$i]],
						'timesPerDay' => array_sum($times[$id[$i]]),
					);

					$this->db->where('presId', $row->presId);
					echo "kdxvbkb ".$this->db->update('prescription', $dataSet);
				} else {
					$dataSet = array(
						'qty' => $qty[$id[$i]],
						'dineSuggestion' => $eat[$id[$i]],
						'timesPerDay' => array_sum($times[$id[$i]]),
						'datetime' => date('Y-m-d H:i:s', now('Asia/Kolkata')),
						'pwmId' => $pwmId[$id[$i]],
						'pmdId' => $newPmdId,
					);

					$this->db->insert('prescription', $dataSet);
				}
//				echo "Row". $query;

				echo $qty[$id[$i]];
				echo '<br>';
				echo 'id=='.$id[$i];
				echo '<br>';
				echo 'eat=='.$eat[$id[$i]];
				echo '<br>';
				print_r($times[$id[$i]]);
				echo '<br>';
				echo 'times=='.array_sum($times[$id[$i]]);
				echo '<br>';

			}
			$mCnt += $totalMed[$pmdId[$k]];
		}
	}

	function pmrDesc($pmrId){
		$desc = $this->input->post('desc');
		$flag = $pmrId;
		if (isset($desc) && $pmrId == 0){
			$row = $this->db->select('pId')
							->where('appId', $this->input->post('appId'))
							->get('doctor_appointment')
							->row();
			$data = array(
				'pmrDescription' => $desc,
				'datetime' => date('Y-m-d H:i:s', now('Asia/Kolkata')),
				'docId' => $this->session->userdata('uId'),
				'pId' => $row->pId,
			);
			$this->db->insert('patient_medical_record',$data);
			$pmrId = $this->db->insert_id();
		}
		elseif (isset($desc)){
			$this->db
				->set('pmrDescription',$desc)
				->where('pmrId',$pmrId)
				->update('patient_medical_record');
		} elseif ($pmrId == 0){
			return FALSE;
		}

		$row = $this->db->select('pmrDescription')
					->where('pmrId', $pmrId)
					->get('patient_medical_record')
					->row();

		if ($flag==0){
			$data = json_encode(array('pmrId' => $pmrId, 'desc' => $row->pmrDescription));
			return $data;
		} else {
			return $row->pmrDescription;
		}
	}
	
	function saveReport($dataSet){
		return $this->db->insert('patient_report', $dataSet);
	}

	function fetchReport($pmdId){
		$query = $this->db
			->where('pmdId', $pmdId)
			->order_by('datetime','desc')
			->get('patient_report');

		$res = array();
		foreach ($query->result() as $row)
		{
			$res[] = array(
				'reportId' => $row->reportId,
				'src' => $row->src,
				'datetime' => date('d-m-Y', strtotime($row->datetime)),
			);
		}
		return $res;
	}

	function fetchRecord(){
		$pId = $this->session->userdata('uId');

		$query = $this->db
			->select('d.username,pmr.*')
			->where('pId', $pId)
			->where('deleted', 0)
			->join('doctor d', 'd.docId=pmr.docId')
			->get('patient_medical_record pmr');

		$res = array();
		foreach ($query->result() as $row)
		{
			$rowFile = $this->db->query('select count(pmdId) as files from patient_medical_record_details where pmrId='.$row->pmrId)->row();
			$res[] = array(
				'pmrId' => $row->pmrId,
				'username' => $row->username,
				'pmrDescription' => $row->pmrDescription,
				'files' => $rowFile->files,
				'datetime' => date('d M Y', strtotime($row->datetime)),
			);
		}
		return $res;
	}

	function fetchFile($id){
		$this->load->model('MedicineModel');
		$this->db->where('pmrId', $id);
		$rowPMR = $this->db->get('patient_medical_record')->row();

		$this->db->select('dob,username,gender,profileImg');
		$this->db->where('pId', $rowPMR->pId);
		$rowPatient = $this->db->get('patient')->row();

		$post_date = strtotime($rowPatient->dob);
		$now = date('Y-m-d',now('Asia/Kolkata'));
		$patient = array(
			'age' => timespan($post_date, $now, 1),
			'name' => $rowPatient->username,
			'profileImg' => $rowPatient->profileImg,
			'gender' => ($rowPatient->gender == 1)? 'Male' : 'Female',
		);
		$PMD = array();
		$Pre = array();

		$PMR = array(
			'pmrId' => $rowPMR->pmrId,
			'pmrDescription' => $rowPMR->pmrDescription,
			'datetime' => date('d-m-Y',strtotime($rowPMR->datetime)),
		);

		$this->db->where('pmrId', $rowPMR->pmrId);
		$queryPMD = $this->db->get('patient_medical_record_details');
		if	($queryPMD->num_rows() > 0)
		{

			foreach ($queryPMD->result() as $rowPMD)
			{
				$PMD[] = array(
					'pmdId' => $rowPMD->pmdId,
					'description' => $rowPMD->description,
					'datetime' => date('d-m-Y', strtotime($rowPMD->datetime)),
				);

				$pmdId = $rowPMD->pmdId;

				$this->db->where('pmdId', $rowPMD->pmdId);
				$this->db->order_by('datetime');
				$queryPre = $this->db->get('prescription');

				foreach ($queryPre->result() as $rowPre)
				{
					if ($rowPre->timesPerDay == 7)
					{
						$times = 'morning - noon - night';
					} elseif ($rowPre->timesPerDay == 6)
					{
						$times = 'noon - night';
					} elseif ($rowPre->timesPerDay == 3)
					{
						$times = 'morning - noon';
					} elseif ($rowPre->timesPerDay == 1)
					{
						$times = 'morning';
					} elseif ($rowPre->timesPerDay == 5)
					{
						$times = 'morning - night';
					} elseif ($rowPre->timesPerDay == 2)
					{
						$times = 'noon';
					} elseif ($rowPre->timesPerDay == 4)
					{
						$times = 'night';
					}

					$med = $this->MedicineModel->fetchMedicine($rowPre->pwmId, 1);

					$date = date('d-m-Y', strtotime($rowPre->datetime));

					$Pre[$rowPre->pmdId][$date][] = array(
						'qty' => $rowPre->qty,
						'pwmId' => $rowPre->pwmId,
						'pmdId' => $rowPre->pmdId,
						'medName' => $med['medName'] . ' ' . $med['dose'],
						'dineSuggestion' => $rowPre->dineSuggestion,
						'timesPerDay' => $times,
					);
				}

			}
		}

		return array(
			'patient' => $patient,
			'pmr' => $PMR,
			'pmd' => $PMD,
			'pre' => $Pre
		);
	}

	function fetchCase($pmrId){
		$query = $this->db
				->where('pmrId', $pmrId)
				->order_by('datetime','desc')
				->get('patient_medical_record_details');

		$cnt = $query->num_rows();
		foreach ($query->result() as $row)
		{
			$res[] = array(
				'pmdId' => $row->pmdId,
				'datetime' => date('d M Y',strtotime($row->datetime)),
				'no' => $cnt
			);
			$cnt--;
		}

		return $res;
	}

	function fetchDates($pmdId){
		$query = $this->db
				->select('presId, datetime, count(pwmId) as med')
				->where('pmdId', $pmdId)
				->group_by('substr(datetime,1,10)')
				->order_by('datetime','desc')
				->get('prescription');

		$cnt = $query->num_rows();
		foreach ($query->result() as $row)
		{
			$res[] = array(
				'presId' => $row->presId,
				'med' => $row->med,
				'datetime' => date('d M Y',strtotime($row->datetime)),
				'no' => $cnt
			);
			$cnt--;
		}

		return $res;
	}

	function checkMedicine($presId){
		$this->load->model('MedicineModel');
		$rowPres = $this->db->where('presId', $presId)->get('prescription')->row();
		$query = $this->db
					->where('substr(datetime,1,10)', date('Y-m-d',strtotime(substr($rowPres->datetime,1,10))))
					->where('pmdId',$rowPres->pmdId)
					->get('prescription');

		foreach ($query->result() as $row)
		{
			$queryMed = $this->db
						->select('pwm.pwmId')
						->where('pwm.pwmId', $row->pwmId)
						->where('p.dptId', 4)
						->join('pharmacist p','p.pharId=pwm.pharId')
						->get('pharmacist_wise_medicine pwm');

			$med = $this->MedicineModel->fetchMedicine($row->pwmId, 1);

			$res[] = array(
				'presId' => $row->presId,
				'medName' => $med['medName'] . ' ' . $med['dose'],
				'qty' => $row->qty,
				'status' => $rowPres->status,
				'av' => $queryMed->num_rows()
			);
		}
		return $res;
	}

	function fetchPharmacy($pmrId){
		$rowDoc  = $this->db
						->where('pmrId', $pmrId)
						->get('patient_medical_record')->row();

		$query  =  $this->db
						->where('docId', $rowDoc->docId)
						->join('pharmacist p','p.pharId=dp.pharId')
						->get('doctor_pharmacist dp');

		$res = array();
		foreach ($query->result() as $row)
		{
			$res[] = array(
				'dophId' => $row->dophId,
				'pharId' => $row->pharId,
				'username' => $row->username,
				'address' => $row->address
			);
		}
		return $res;
	}

	function fetchCurrentPrescription($pmrId){
		$this->load->model('MedicineModel');

		$pmr = $this->fetchCase($pmrId);

		$rowPre = $this->db
						->select('datetime')
						->where('pmdId', $pmr[0]['pmdId'])
						->order_by('datetime','desc')
						->group_by('datetime')
						->limit(1)
						->get('prescription')
						->row();
		$query = $this->db
			->where('substr(datetime,1,10)', date('Y-m-d',strtotime(substr($rowPre->datetime,1,10))))
			->where('pmdId',$pmr[0]['pmdId'])
			->get('prescription');

		$res = array();
		foreach ($query->result() as $row)
		{
			$med = $this->MedicineModel->fetchMedicine($row->pwmId, 1);

			$res[] = array(
				'presId' => $row->presId,
				'datetime' => date('d M Y', strtotime($rowPre->datetime)),
				'medName' => $med['medName'] . ' ' . $med['dose'],
				'qty' => $row->qty,
			);
		}

		return array(
			'phar' => $this->fetchPharmacy($pmrId),
			'pres' => $res
		);
	}

	function pharmacyOrder($presId,$uId,$pharId){
		$rowPres = $this->db
					->where('presId', $presId)
					->get('prescription')->row();

		$this->db->where('presId', $presId)
				->set('status', 1)
				->update('prescription');

		$data = array(
			'buyDatetime' => date('Y-m-d H:i:s', now('Asia/Kolkata')),
			'presDatetime' => $rowPres->datetime,
			'presId' => $presId,
			'pId' => $uId,
			'pharId' => $pharId,
		);

		$this->db->insert('order_pharmacy', $data);
	}

	function instant_cure(){
		$docId = $this->session->userdata('uId');

		$query = $this->db->distinct('c.pId')
							->select('p.username,c.icappId,c.timestamp')
							->where('docId', $docId)
							->order_by('timestamp')
							->group_by('icappId')
							->join('patient p','p.pId=c.pId')
							->get('chat c');
		$res = array();
		foreach ($query->result() as $row)
		{
			$res[] = array(
				'icappId' => $row->icappId,
				'username' => $row->username,
				'timestamp' => date('d M Y', strtotime($row->timestamp)),
			);
		}
		return $res;
	}

	function checkReview($docId,$pId){
		if (isset($_SESSION['userType']) && $_SESSION['userType']==3)
		{
			if ($pId != 0)
			{
				$rowDPT = $this->db->select("dptId")->where('docId', $docId)->get('doctor')->row();
				if ($rowDPT->dptId == 1)
				{
					$query = $this->db->where('pId', $pId)
						->where('docId', $docId)
						->where('status !=', 0)
						->get('doctor_appointment');
				} elseif ($rowDPT->dptId == 2)
				{
					$query = $this->db->select("ica.icappId")
						->where('ica.pId', $pId)
						->where('c.docId', $docId)
						->where('ica.status !=', 0)
						->join('chat c', 'c.icappId=ica.icappId')
						->get('instant_cure_appointment ica');
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
		$docId = $this->input->post('docId');
		$pId = $this->session->userdata('uId');

		$insData = array(
			'description' => $this->input->post('description'),
			'rates' => $this->input->post('rating'),
			'pId' => $pId,
			'userId' => $docId,
			'userType' => 1,
			'datetime' => date('Y-m-d H:i:s',now('Asia/Kolkata')),
		);

		$this->db->insert('rating', $insData );
	}

	function fetchReview($docId){
		$queryCnt = $this->db->where('userId', $docId)
					->where('userType', 1)
					->order_by('datetime', 'desc')
					->get('rating');
		$cnt = $queryCnt->num_rows();

		$query = $this->db
			->select('rates,r.description,r.datetime,p.username,p.profileImg')
			->where('userId', $docId)
			->where('userType', 1)
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

	function avgRating($docId){
		$row = $this->db->select_avg('rates','rates')
					->where('userType', 1)
					->where('userId', $docId)
					->get('rating')->row();

		return floor($row->rates);
	}

	function homeDoc(){
		$this->load->helper('text');
		$this->load->model('EncDec');

		$query = $this->db->where('status >',0)->limit(10)->get('doctor');

		$res = array();
		foreach ($query->result() as $row)
		{
			if($row->cityId != 0){
				$this->db->where('cityId', $row->cityId);
				$this->db->join('state s', 'c.stateId = s.stateId');
				$queryCity = $this->db->get('city c');
				$rowCity = $queryCity->row();
			}

			$queryCnt = $this->db->where('userId', $row->docId)
				->where('userType', 1)
				->order_by('datetime', 'desc')
				->get('rating');
			$specialization = $row->specialization;
			$len = strlen($specialization);
			if ($len > 40)
			{
				$pos = strpos($specialization, ',', 40);
				if ($pos != '')
				{
					$specialization = substr($specialization, 0, $pos) . '...';
				}
				$len = strlen($specialization);

				if ($len > 43){
					$word = str_word_count($specialization) - 1;
					$specialization = word_limiter($specialization, (($word==0)? 1 : $word), '...');
				}
			}
			$res[] = array(
				'docId' => $this->EncDec->encrypt_decrypt('encrypt', $row->docId),
				'username' => $row->username,
				'profileImg' => (($row->profileImg=='')?'profile.png' : $row->profileImg),
				'specialization' => $specialization,
				'cityName' => (isset($rowCity))? $rowCity->cityName : '',
				'stateName' => (isset($rowCity))? $rowCity->stateName : '',
				'rating' => $this->avgRating($row->docId),
				'cnt' => $queryCnt->num_rows(),
			);
		}

		return $res;
	}

	function fetchPatient(){
		$docId = $this->session->userdata('uId');
		if	($_SESSION['dptId'] != 2)
		{
			$query = $this->db
				->select('p.pId,p.username,p.email,p.phone,p.gender,da.docId')
				->where('docId', $docId)
				->join('patient p', 'p.pId=da.pId')
				->group_by('p.pId')
				->get('doctor_appointment da');
		} else {
			$query = $this->db
				->select('p.pId,p.username,p.email,p.phone,p.gender,c.docId')
				->where('c.docId', $docId)
				->join('patient p', 'p.pId=c.pId')
				->group_by('p.pId')
				->get('chat c');
		}
		$res = array();
		foreach ($query->result() as $row)
		{
			$rowPMR = $this->db->where('docId', $row->docId)
								->where('pId', $row->pId)
								->get('patient_medical_record')->row();
			$res[] = array(
				'pmrId' => ((isset($rowPMR->pmrId))? $rowPMR->pmrId : 0),
				'username' => $row->username,
				'email' => $row->email,
				'phone' => $row->phone,
				'gender' => (($row->gender==1)? 'Male': (($row->gender==2)? 'Female' : '')),
			);
		}
		return $res;
	}

	function count_all($str)
	{
		$query = $this->db->where('status >',0)->like('username',$str)->get('doctor');
		return $query->num_rows();
	}

	function fetch_details($limit, $start,$string)
	{
		$this->load->helper('text');
		$this->load->model('EncDec');
		$this->load->model('StateCityModel');
		$output = '';
		$this->db->select('username,profileImg,specialization,cityId,docId');
		$this->db->from('doctor');
		$this->db->where('status >', 0);
		$this->db->like('username', $string);
		$this->db->order_by('username', 'ASC');
		$this->db->limit($limit, $start);
		$query = $this->db->get();

		foreach ($query->result() as $row)
		{
			$cityName = '';
			$stateName = '';
			if ($row->cityId != 0){
				$res = $this->StateCityModel->fetchStateCity($row->cityId);
				$cityName = $res['cityName'];
				$stateName = $res['stateName'];
			}
			$rating = $this->avgRating($row->docId);
			$rate = '';
			for ($i=1;$i<=5;$i++){
				if ($i <= $rating){
					$rate .= "<i class='fas fa-star filled'></i>";
				} else {
					$rate .=  "<i class='fas fa-star'></i>";
				}
			}
			$queryCnt = $this->db->where('userId', $row->docId)
				->where('userType', 1)
				->order_by('datetime', 'desc')
				->get('rating');

			$username = $row->username;
			$len = strlen($username);
			if ($len > 14)
			{
				$word = str_word_count($username) - 1;
				$username = word_limiter($username, (($word==0)? 1 : $word), '...');
			}
			$specialization = $row->specialization;
			$len = strlen($specialization);
			if ($len > 20)
			{
				$pos = strpos($specialization, ',', 20);
				if ($pos != '')
				{
					$specialization = substr($specialization, 0, $pos) . '...';
				}
				$len = strlen($specialization);
				if ($len > 23){
					$word = str_word_count($specialization) - 1;
					$specialization = word_limiter($specialization, (($word==0)? 1 : $word), '...');
				}
			}
			$output .= '
					<div class=" col col-md-4 mt-4">
						<div class="disease-sy">
							<a href="'. base_url() .'doctor/view-profile/'. $this->EncDec->encrypt_decrypt('encrypt', $row->docId) .'">
								<div class="doctor-widget">
									<div class="doc-info-left">
										<div class="doctor-img">
											<img src="'. base_url() .'profile/'. (($row->profileImg=='')? 'profile.png':$row->profileImg) .'" class="img-fluid" alt="User Image">
										</div>
										<div class="doc-info-cont">
											<a href="'. base_url() .'doctor/view-profile/'. $this->EncDec->encrypt_decrypt('encrypt', $row->docId) .'" title="'. $row->username .'" data-toggle="tooltip" data-placement="bottom" ><h4 class="doc-name">'. $username .'</h4></a>
											<p class="doc-speciality" title="'. $row->specialization.'" data-toggle="tooltip" data-placement="bottom" >'. $specialization .'</p>
											<div class="rating">
												'. $rate .'
												<span class="d-inline-block average-rating">('. $queryCnt->num_rows() .')</span>
											</div>
											<div class="clinic-details">
												<p class="doc-location"><i class="fas fa-map-marker-alt"></i> '. $cityName .', '. $stateName .'</p>
											</div>
										</div>
									</div>
								</div>
							</a>
						</div>
					</div>
					';
		}
		return $output;
	}

	public function dashboard()
	{
		$uId = $this->session->userdata('uId');
		$rowWallet = $this->db->query("select amount from wallet where userTypeId=1 and userId=$uId")->row();
		$rowDoc = $this->db->select('dptId')->where('docId',$uId)->get('doctor')->row();
		if ($rowDoc->dptId == 1)
		{
			$rowTotalApp = $this->db->query("select count(*) as app from doctor_appointment where docId = $uId")->row();

			$rowTotalPatient = $this->db->query("select count(distinct pId) as patient from doctor_appointment where docId = $uId")->row();

			$cur = date('Y-m-d',now('Asia/Kolkata'));
			$rowToday = $this->db->query("select count(*) as today from doctor_appointment where docId=$uId and substr(datetime,1,10) ='$cur'");

			$queryGraph = $this->db->query("select count(appId) as cnt,substr(datetime,1,10) as date from doctor_appointment where docId=$uId group by substr(datetime,1,10)");
		} elseif ($rowDoc->dptId == 2){
			$rowTotalApp = $this->db->query("select count(distinct(icappId)) as app from chat c where docId = $uId")->row();
			$rowTotalPatient = $this->db->query("select count(distinct(pId)) as patient from chat c where docId = $uId")->row();
			$query = $this->db->query("select distinct(pId),sum(qty) as sold from order_pharmacy op join prescription p on op.presId = p.presId where pharId=$uId group by pId");
			$queryGraph = $this->db->query("select count(distinct icappId) as cnt,substr(timestamp,1,10) as date from chat where docId=$uId group by substr(timestamp,1,10)");

		}

		$newDocDate = array();
		$newDocCnt[0] = 0;

		foreach ($queryGraph->result() as $k => $row)
		{
			$newDocDate[] = ''.$row->date.'';
			$newDocCnt[$k] = (isset($newDocCnt[$k-1])?$newDocCnt[$k-1] : 0) + $row->cnt;
		}
		$date = implode("','",$newDocDate);
		$cnt = implode(',',$newDocCnt);


		return array(
			'today' => ((isset($rowToday->today))? $rowToday->today:'0'),
			'totalApp' => $rowTotalApp->app,
			'patient' => $rowTotalPatient->patient,
			'wallet' => $rowWallet->amount,
			'appDate' => $date,
			'appCnt' => $cnt,
		);
	}

	public function fetchICDoctorList()
	{
		$query = $this->db->where('dptId', 2)->get('doctor');
		$res = array();
		foreach ($query->result() as $row)
		{
			$res[] = array(
				'docId' => $row->docId,
				'username' => $row->username,
			);
		}
		return $res;
	}

	public function fetchDocAdminPdf(){

		$time = $this->input->post('time_period');
		if ($time != ''&&isset($time))
		{
			$dates = explode('/', $time);

			$query = $this->db->query("select * from doctor where substr(joindate,1,10) between '". date('Y-m-d',strtotime($dates[0])) ."' and '". date('Y-m-d',strtotime($dates[1])) ."'");
		} else
		{
			$query = $this->db->get('doctor');
		}
		$rec = array();

		foreach ($query->result() as $row)
		{
			$emptyRow = $this->db->query("
				SELECT SUM(CASE
				   WHEN address is null or COALESCE(TRIM(address), '') = '' THEN 1
				   WHEN description is null or COALESCE(TRIM(description), '') = '' THEN 1
				   ELSE 0 END
			   	) as empty_fields FROM doctor WHERE docId = $row->docId;");

			$emptyRow = $emptyRow->row()->empty_fields;

			$this->db->select('clinicName');
			$this->db->where('docId', $row->docId);
			$cquery = $this->db->get('doctor_clinic');
			$clinic = $cquery->row();

			$rec[] = array(
				'docId' => $row->docId,
				'username' => $row->username,
				'email' => $row->email,
				'joindate' => date('d M Y', strtotime($row->joindate)),
				'address' => $row->address,
				'clinicName' => (($cquery->num_rows() > 0) ? $clinic->clinicName : ''),
				'status' => (($row->status == 0) ? 'Not Verified' : (($row->status == 1) ? 'Verified' : 'Preferred' ) ),
				'profile' => (($emptyRow == 0) ? 'Completed' : 'Pending'),
			);
		}

		return $rec;
	}

	public function fetchICDocAdminPdf(){

		$time = $this->input->post('time_period');
		if ($time != ''&&isset($time))
		{
			$dates = explode('/', $time);

			$query = $this->db->query("select p.pId,p.username,p.email,p.phone,p.gender,c.timestamp from chat c join patient p on p.pId=c.pId where substr(c.timestamp,1,10) between '". date('Y-m-d',strtotime($dates[0])) ."' and '". date('Y-m-d',strtotime($dates[1])) ."' group by c.icappId");
		} else
		{
			$query = $this->db
				->select('p.pId,p.email,p.phone,p.gender,p.username,c.timestamp')
				->order_by('timestamp')
				->group_by('icappId')
				->join('patient p','p.pId=c.pId')
				->get('chat c');

		}
		$rec = array();

		foreach ($query->result() as $row)
		{
			$rec[] = array(
				'pId' => $row->pId,
				'username' => $row->username,
				'email' => $row->email,
				'phone' => $row->phone,
				'timestamp' => date('d M Y',strtotime($row->timestamp)),
				'gender' => (($row->gender==1)? 'Male': (($row->gender==2)? 'Female' : '')),
			);
		}

		return $rec;
	}

	function fetchDocPatinetAdminPdf($docId,$dpt){
		$time = $this->input->post('time_period');
		$dates = explode('/', $time);
		if	($dpt != 2)
		{
			$query = $this->db->query("select p.pId,p.username,p.email,p.phone,p.gender,da.docId from doctor_appointment da join patient p on p.pId=da.pId where da.docId=".$docId." and substr(da.datetime,1,10) between '". date('Y-m-d',strtotime($dates[0])) ."' and '". date('Y-m-d',strtotime($dates[1])) ."' group by pId");
		} else {
			$query = $this->db->query("select p.pId,p.username,p.email,p.phone,p.gender,c.docId from chat c join patient p on p.pId=c.pId where c.docId=$docId and substr(c.timestamp,1,10) between '". date('Y-m-d',strtotime($dates[0])) ."' and '". date('Y-m-d',strtotime($dates[1])) ."' group by p.pId");
		}
		$res = array();
		foreach ($query->result() as $row)
		{
			$res[] = array(
				'pId' => $row->pId,
				'username' => $row->username,
				'email' => $row->email,
				'phone' => $row->phone,
				'gender' => (($row->gender==1)? 'Male': (($row->gender==2)? 'Female' : '')),
			);
		}
		return $res;
	}

	function fetchICDocPatinetAdminPdf($docId){
		$time = $this->input->post('time_period');
		$dates = explode('/', $time);
		$query = $this->db->query("select p.pId,p.username,p.email,p.phone,p.gender,c.timestamp from chat c join patient p on p.pId=c.pId where c.docId=$docId and substr(c.timestamp,1,10) between '". date('Y-m-d',strtotime($dates[0])) ."' and '". date('Y-m-d',strtotime($dates[1])) ."' group by c.icappId");

		$res = array();
		foreach ($query->result() as $row)
		{
			$res[] = array(
				'pId' => $row->pId,
				'username' => $row->username,
				'email' => $row->email,
				'phone' => $row->phone,
				'timestamp' => date('d M Y',strtotime($row->timestamp)),
				'gender' => (($row->gender==1)? 'Male': (($row->gender==2)? 'Female' : '')),
			);
		}
		return $res;
	}

	public function getPatient($pmrId)
	{
		$row = $this->db
					->select('pmr.docId,pmr.datetime,pmr.pmrDescription,p.username as pName,d.username as dName, p.gender,p.address as pAddress,p.phone as pPhone,p.email as pEmail,d.email as dEmail,d.phone as dPhone,d.address as dAddress,p.dob')
					->where('pmrId', $pmrId)
					->join('patient p', 'p.pId=pmr.pId')
					->join('doctor d', 'd.docId=pmr.docId')
					->get('patient_medical_record pmr')->row();
		$queryClinic = $this->db->where('docId', $row->docId)->get('doctor_clinic');
		$c = $queryClinic->num_rows();
		$rowClinic = $queryClinic->row();

		$post_date = strtotime($row->dob);
		$now = date('Y-m-d',now('Asia/Kolkata'));
		$res = array(
			'dName' => $row->dName,
			'dAddress' => $row->dAddress,
			'dEmail' => $row->dEmail,
			'dPhone' => $row->dPhone,
			'pName' => $row->pName,
			'pEmail' => $row->pEmail,
			'pAddress' => $row->pAddress,
			'pPhone' => $row->pPhone,
			'gender' => (($row->gender==1)? 'Male' : (($row->gender==2) ? 'Female':'')),
			'datetime' => date('d M Y',strtotime($row->datetime)),
			'pmrDescription' => $row->pmrDescription,
			'clinicName' => (($c>0)? $rowClinic->clinicName:''),
			'clinicAddress' => (($c>0)? $rowClinic->clinicAddress:''),
			'age' => timespan($post_date, $now, 1),
		);
		return $res;
	}

	function fetchPrescription($pmdId, $date){
		$this->load->model('MedicineModel');
		$Pre = array();
		$patient = array();

		$row = $this->db
						->select('p.username as pName,d.username as dName')
						->where('pmdId', $pmdId)
						->join('patient p','p.pId=pmr.pId')
						->join('doctor d','d.docId=pmr.docId')
						->join('patient_medical_record_details pmd','pmd.pmrId=pmr.pmrId')
						->get('patient_medical_record pmr')->row();

		$patient = array(
			'pName' => $row->pName,
			'dName' => $row->dName,
		);

		$this->db->where('pmdId', $pmdId);
		$this->db->where('substr(datetime,1,10)', $date);
		$this->db->order_by('datetime');
		$queryPre = $this->db->get('prescription');

		foreach ($queryPre->result() as $rowPre)
		{
			if ($rowPre->timesPerDay == 7)
			{
				$times = 'morning - noon - night';
			} elseif ($rowPre->timesPerDay == 6)
			{
				$times = 'noon - night';
			} elseif ($rowPre->timesPerDay == 3)
			{
				$times = 'morning - noon';
			} elseif ($rowPre->timesPerDay == 1)
			{
				$times = 'morning';
			} elseif ($rowPre->timesPerDay == 5)
			{
				$times = 'morning - night';
			} elseif ($rowPre->timesPerDay == 2)
			{
				$times = 'noon';
			} elseif ($rowPre->timesPerDay == 4)
			{
				$times = 'night';
			}

			$med = $this->MedicineModel->fetchMedicine($rowPre->pwmId, 1);
			$Pre[] = array(
				'qty' => $rowPre->qty,
				'medName' => $med['medName'] . ' ' . $med['dose'],
				'dineSuggestion' => $rowPre->dineSuggestion,
				'timesPerDay' => $times,
			);
		}

		return array(
			'pre' => $Pre,
			'patient' => $patient
		);
	}


}

/* End of file PharmacistModel.php */
