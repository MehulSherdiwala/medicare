<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SalesModel extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function fetchSales(){
		$pharId = $this->session->userdata('uId');
		$this->db->distinct();
		$this->db->select(' om.*,p.username');
		$this->db->from('pharmacist_wise_medicine pwm');
		$this->db->join('order_item oi ',' pwm.pwmId = oi.pwmId');
		$this->db->join('order_medicine om ',' oi.orderId = om.orderId');
		$this->db->join('patient p ',' p.pId = om.pId');
		$this->db->where('pharId', $pharId);
		$query = $this->db->get();

		$rec = array();
		foreach ($query->result() as $row)
		{
			$rec[] = array(
				'orderId' => $row->orderId,
				'daAddress' => $this->getAddress($row->daId,$row->pId),
				'totalAmount' => $this->getTotal($row->orderId,$pharId),
				'date' => date('d M Y', strtotime($row->datetime)),
				'payMethod' => $row->payMethod,
				'name' => $row->username,
				'status' => $row->status,
				'totalItems' => $this->countItem($row->orderId,$pharId).' Medicines',
			);
		}
		return $rec;

	}

	private function countItem($orderId,$pharId){
		if ($pharId != 0)
		{
			$row = $this->db->query("select count(oiId) as count from order_item  join pharmacist_wise_medicine pwm on order_item.pwmId = pwm.pwmId where orderId = $orderId and pharId=" . $pharId)->row();
		} else {
			$row = $this->db->query("select count(oiId) as count from order_item  join pharmacist_wise_medicine pwm on order_item.pwmId = pwm.pwmId where orderId = $orderId")->row();
		}
		return $row->count;
	}

	private function getAddress($daId,$pId){
		if ($daId != 0){
			$this->db->where('daId', $daId);
			$row = $this->db->get('delivery_address')->row();
			return $row->daAddress.' - '.$row->daPincode;
		} else {
			$this->db->select('address,pincode');
			$this->db->where('pId', $pId);
			$row = $this->db->get('patient')->row();
			return $row->address.' - '.$row->pincode;
		}
	}

	private function getTotal($orderId,$pharId){
		$row = $this->db->query("select sum(order_item.price*qty) as total from order_item join pharmacist_wise_medicine pwm on order_item.pwmId = pwm.pwmId where orderId = $orderId and pharId=".$pharId)->row();
		return $row->total;
	}

	public function getDetails($orderId,$flag){
		$pharId = $this->session->userdata('uId');

		$this->db->where('orderId', $orderId);
		$rowOrder = $this->db->get('order_medicine')->row();

		$this->db->where('pId', $rowOrder->pId);
		$rowPatient = $this->db->get('patient')->row();

		if ($flag == 0)
		{
			$this->db->where('pharId', $pharId);
			$this->db->where('orderId', $orderId);
			$this->db->select('oi.qty,oi.price,oi.pwmId');
			$this->db->from('order_item oi');
			$this->db->join('pharmacist_wise_medicine pwm', 'pwm.pwmId = oi.pwmId');
			$query = $this->db->get();
		} else {
			$this->db->where('orderId', $orderId);
			$this->db->select('oi.qty,oi.price,oi.pwmId');
			$this->db->from('order_item oi');
			$this->db->join('pharmacist_wise_medicine pwm', 'pwm.pwmId = oi.pwmId');
			$query = $this->db->get();
		}

		$this->load->model('MedicineModel');
		$item = array();
		foreach ( $query->result() as $row)
		{
			$med = $this->MedicineModel->fetchMedicine($row->pwmId , 1);

			$item[] = array(
				'medName' => $med['medName'],
				'medId' => $med['medId'],
				'medDescription' => $med['medDescription'],
				'dose' => $med['dose'],
				'capacity' => $med['capacity'],
				'price' => $row->price,
				'qty' => $row->qty,
			);
		}

		if ($rowOrder->daId == 0){
			if ($rowPatient->cityId != 0){
				$rowState = $this->db->query("select * from city join state on city.stateId=state.stateId where cityId=".$rowPatient->cityId)->row();
			}
			$patient = array(
				'name' => $rowPatient->username,
				'phone' => $rowPatient->phone,
				'address' => $rowPatient->address,
				'pincode' => $rowPatient->pincode,
				'city' => $rowState->cityName,
				'state' => $rowState->stateName,
			);
		} else {
			$rowda = $this->db->query("select * from delivery_address where daId=".$rowOrder->daId)->row();
			$rowState = $this->db->query("select * from city join state on city.stateId=state.stateId where cityId=".$rowda->cityId)->row();
			$patient = array(
				'name' => $rowPatient->username,
				'phone' => $rowPatient->phone,
				'address' => $rowda->daAddress,
				'pincode' => $rowda->daPincode,
				'city' => $rowState->cityName,
				'state' => $rowState->stateName,
			);
		}

		return array(
			array(
				'orderId' => $rowOrder->orderId,
				'payMethod' => $rowOrder->payMethod,
				'status' => $rowOrder->status,
				'totalAmount' => ($flag==0)? $this->getTotal($orderId,$pharId) : $rowOrder->totalAmount,
				'date' => date('d M Y' ,strtotime($rowOrder->datetime)),
			),
			$patient,
			$item
		);

	}

	public function fetchSalesAdmin(){
		$this->db->distinct();
		$this->db->select(' om.*,p.username');
		$this->db->from('pharmacist_wise_medicine pwm');
		$this->db->join('order_item oi ',' pwm.pwmId = oi.pwmId');
		$this->db->join('order_medicine om ',' oi.orderId = om.orderId');
		$this->db->join('patient p ',' p.pId = om.pId');
		$query = $this->db->get();

		$rec = array();
		foreach ($query->result() as $row)
		{
			$rec[] = array(
				'orderId' => $row->orderId,
				'daAddress' => $this->getAddress($row->daId,$row->pId),
				'totalAmount' => $row->totalAmount,
				'date' => date('d M Y', strtotime($row->datetime)),
				'payMethod' => $row->payMethod,
				'name' => $row->username,
				'status' => $row->status,
				'totalItems' => $this->countItem($row->orderId,0).' Medicines',
			);
		}
		return $rec;

	}

	public function getStatus($id){
		$this->db->select(' orderId, status');
		$this->db->from('order_medicine');
		$this->db->where('orderId', $id);
		$query = $this->db->get()->row();

		return array(
			'orderId' => $query->orderId,
			'status' => $query->status,
		);
	}

	public function updateStatus(){
		$status = $this->input->post('status');
		$orderId = $this->input->post('orderId');

		$this->db->set('status',$status);
		$this->db->where('orderId', $orderId);
		$this->db->update('order_medicine');
	}

	public function orderList()
	{
		$pId = $this->session->userdata('uId');

		$this->db->distinct();
		$this->db->select(' om.*,p.username');
		$this->db->from('pharmacist_wise_medicine pwm');
		$this->db->join('order_item oi ',' pwm.pwmId = oi.pwmId');
		$this->db->join('order_medicine om ',' oi.orderId = om.orderId');
		$this->db->join('patient p ',' p.pId = om.pId');
		$this->db->order_by('om.datetime','desc');
		$this->db->where('p.pId ',$pId);
		$query = $this->db->get();

		$rec = array();
		foreach ($query->result() as $row)
		{
			$rec[] = array(
				'orderId' => $row->orderId,
				'daAddress' => $this->getAddress($row->daId,$row->pId),
				'totalAmount' => $row->totalAmount,
				'date' => date('d M Y', strtotime($row->datetime)),
				'payMethod' => $row->payMethod,
				'name' => $row->username,
				'status' => $row->status,
				'totalItems' => $this->countItem($row->orderId,0).' Medicines',
			);
		}
		return $rec;
	}

	public function orderDetails($orderId)
	{
		$this->db->where('orderId', $orderId);
		$this->db->select('oi.qty,oi.price,oi.pwmId');
		$this->db->from('order_item oi');
		$this->db->join('pharmacist_wise_medicine pwm', 'pwm.pwmId = oi.pwmId');
		$query = $this->db->get();

		$this->load->model('MedicineModel');
		$item = array();
		foreach ( $query->result() as $row)
		{
			$med = $this->MedicineModel->fetchMedicine($row->pwmId , 1);

			$item[] = array(
				'medName' => $med['medName'],
				'medId' => $med['medId'],
				'medDescription' => $med['medDescription'],
				'dose' => $med['dose'],
				'capacity' => $med['capacity'],
				'price' => $row->price,
				'qty' => $row->qty,
			);
		}

		return $item;
	}

	public function fetchUserList($type)
	{
		if ($type == 2){
			$query = $this->db->where('status >',0)->get('pharmacist');

			$rec = array();
			foreach ($query->result() as $row)
			{
				$rec[] = array(
					'userId' => $row->pharId,
					'username' => $row->username
				);
			}
		} else {
			$query = $this->db->where('status',0)->get('patient');

			$rec = array();
			foreach ($query->result() as $row)
			{
				$rec[] = array(
					'userId' => $row->pId,
					'username' => $row->username
				);
			}
		}
		return $rec;
	}

	public function fetchSalesAdminPdf()
	{
		$time = $this->input->post('time_period');
		if ($time != '' && isset($time))
		{
			$dates = explode('/', $time);
			$query = $this->db->query("select distinct  om.*,p.username from pharmacist_wise_medicine pwm join order_item oi on  pwm.pwmId = oi.pwmId join order_medicine om on  oi.orderId = om.orderId join patient p on p.pId = om.pId where substr(om.datetime,1,10) between '". date('Y-m-d',strtotime($dates[0])) ."' and '". date('Y-m-d',strtotime($dates[1])) ."'");
		} else
		{
			$this->db->distinct();
			$this->db->select(' om.*,p.username');
			$this->db->from('pharmacist_wise_medicine pwm');
			$this->db->join('order_item oi ', ' pwm.pwmId = oi.pwmId');
			$this->db->join('order_medicine om ', ' oi.orderId = om.orderId');
			$this->db->join('patient p ', ' p.pId = om.pId');
			$query = $this->db->get();
		}
		$rec = array();

		foreach ($query->result() as $row)
		{
			$rec[] = array(
				'orderId' => $row->orderId,
				'totalAmount' => $row->totalAmount,
				'date' => date('d M Y', strtotime($row->datetime)),
				'payMethod' => $row->payMethod,
				'name' => $row->username,
				'status' => $row->status,
				'totalItems' => $this->countItem($row->orderId,0).' Medicines',
			);
		}
		return $rec;

	}

	public function fetchPharSalesAdminPdf($pharId)
	{
		$time = $this->input->post('time_period');
		if ($time != '' && isset($time))
		{
			$dates = explode('/', $time);
			$query = $this->db->query("select distinct om.*,p.username from pharmacist_wise_medicine pwm join order_item oi on  pwm.pwmId = oi.pwmId join order_medicine om on  oi.orderId = om.orderId join patient p on p.pId = om.pId where pharId=$pharId and substr(om.datetime,1,10) between '". date('Y-m-d',strtotime($dates[0])) ."' and '". date('Y-m-d',strtotime($dates[1])) ."'");
		} else
		{
			$this->db->distinct();
			$this->db->select(' om.*,p.username');
			$this->db->from('pharmacist_wise_medicine pwm');
			$this->db->join('order_item oi ', ' pwm.pwmId = oi.pwmId');
			$this->db->join('order_medicine om ', ' oi.orderId = om.orderId');
			$this->db->join('patient p ', ' p.pId = om.pId');
			$this->db->where('pharId', $pharId);
			$query = $this->db->get();
		}

		foreach ($query->result() as $row)
		{
			$rec[] = array(
				'orderId' => $row->orderId,
				'totalAmount' => $this->getTotal($row->orderId,$pharId),
				'date' => date('d M Y', strtotime($row->datetime)),
				'payMethod' => $row->payMethod,
				'name' => $row->username,
				'status' => $row->status,
				'totalItems' => $this->countItem($row->orderId,$pharId).' Medicines',
			);
		}
		return $rec;
	}

	public function fetchPatientSalesAdminPdf($pId)
	{
		$time = $this->input->post('time_period');
		if ($time != '' && isset($time))
		{
			$dates = explode('/', $time);
			$query = $this->db->query("select distinct om.*,p.username from pharmacist_wise_medicine pwm join order_item oi on  pwm.pwmId = oi.pwmId join order_medicine om on  oi.orderId = om.orderId join patient p on p.pId = om.pId where om.pId=$pId and substr(om.datetime,1,10) between '". date('Y-m-d',strtotime($dates[0])) ."' and '". date('Y-m-d',strtotime($dates[1])) ."'");
		} else
		{
			$this->db->distinct();
			$this->db->select(' om.*,p.username');
			$this->db->from('pharmacist_wise_medicine pwm');
			$this->db->join('order_item oi ', ' pwm.pwmId = oi.pwmId');
			$this->db->join('order_medicine om ', ' oi.orderId = om.orderId');
			$this->db->join('patient p ', ' p.pId = om.pId');
			$this->db->where('om.pId', $pId);
			$query = $this->db->get();
		}
		$rec = array();
		foreach ($query->result() as $row)
		{
			$rec[] = array(
				'orderId' => $row->orderId,
				'totalAmount' => $row->totalAmount,
				'date' => date('d M Y', strtotime($row->datetime)),
				'payMethod' => $row->payMethod,
				'name' => $row->username,
				'status' => $row->status,
				'totalItems' => $this->countItem($row->orderId,0).' Medicines',
			);
		}
		return $rec;
	}

	public function fetchPhar($pharId)
	{
		$row = $this->db->select('username')->where('pharId', $pharId)->get('pharmacist')->row();
		return $row->username;
	}

}

/* End of file SalesModel.php */
