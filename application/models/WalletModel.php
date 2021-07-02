<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class WalletModel extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function fetchTran(){

		$userId = $this->session->userdata('uId');
		$userType = $this->session->userdata('userType');

		$this->db->where('userId', $userId);
		$this->db->where('userTypeId', $userType);
		$wallet = $this->db->get('wallet')->row();

//		print_r($wallet);
		$this->db->where('walletId', $wallet->walletId);
		$query = $this->db->get('bank_transaction');
		$tran = array();

		foreach ($query->result() as $row)
		{
			$tran[] = array(
				'amount' => $row->amount,
				'status' => $row->status,
				'date' => $row->datetime,
				'desc' => ($row->tranType == 0) ? 'Added to Wallet' : 'Withdraw from Wallet',
				'type' => $row->tranType,
			);
		}

		if ($userType == 3)
		{

			$this->db->where('pId', $userId);
			$query = $this->db->get('payment_pharmacist');
			foreach ($query->result() as $row)
			{
				$tran[] = array(
					'amount' => $row->amount,
					'status' => $row->status,
					'date' => $row->datetime,
					'desc' => 'Purchase Medicine',
					'type' => 1,
				);
			}

			$this->db->where('pId', $userId);
			$query = $this->db->get('payment_doctor');
			foreach ($query->result() as $row)
			{
				$tran[] = array(
					'amount' => $row->amount,
					'status' => $row->status,
					'date' => $row->datetime,
					'desc' => 'Pay to Doctors',
					'type' => 1,
				);
			}
		} elseif ($userType == 2)
		{
			$rowRate = $this->db->where('userType', $userType)->get('commission_rate')->row();

			$query = $this->db->query("select *, (select sum(oi.price * qty) from order_item oi join pharmacist_wise_medicine pwm on oi.pwmId = pwm.pwmId where pharId = 1 and oi.orderId = order_medicine.orderId) as sum from order_medicine where orderId  in (select orderId from order_item oi join pharmacist_wise_medicine pwm on oi.pwmId = pwm.pwmId where pharId = $userId and payMethod != 'COD');");
			foreach ($query->result() as $row)
			{
				$tran[] = array(
					'amount' => floor($row->sum - (($row->sum * $rowRate->rate) / 100)),
					'status' => 0,
					'date' => $row->datetime,
					'desc' => 'Sales Medicine',
					'type' => 0,
				);
			}
		} elseif ($userType == 1)
		{
			$rowDPT = $this->db->select('dptId')->where('docId', $userId)->get('doctor')->row();
			$rowRate = $this->db->where('userType', $userType)->get('commission_rate')->row();

			if ($rowDPT->dptId == 1)
			{
				$query = $this->db->query("select amount,payment_doctor.datetime  from payment_doctor join doctor_appointment da on payment_doctor.appId = da.appId where appType=0 and da.docId=$userId");
			} else
			{
				$query = $this->db->query("select amount,payment_doctor.datetime from payment_doctor join instant_cure_appointment da on payment_doctor.appId = da.icappId where appType=1 and da.icappId= (select chat.icappId from chat where docId = $userId limit 1)");
			}
			foreach ($query->result() as $row)
			{
				$tran[] = array(
					'amount' => floor($row->amount - (($row->amount * $rowRate->rate) / 100)),
					'status' => 0,
					'date' => $row->datetime,
					'desc' => 'Consult Patient',
					'type' => 0,
				);
			}
		}

		if (!empty($tran))
		{

			function date_sort($a, $b)
			{
				return strtotime($b['date']) - strtotime($a['date']);
			}

			usort($tran, "date_sort");
		}
		return  array(
			'wallet' => $wallet,
			'transaction' => $tran
		);

	}

	public function fetchAdminTran()
	{

		$userId = $this->session->userdata('aId');
		$userType = 4;

		$this->db->where('userId', $userId);
		$this->db->where('userTypeId', $userType);
		$wallet = $this->db->get('wallet')->row();

//		print_r($wallet);
		$this->db->where('walletId', $wallet->walletId);
		$query = $this->db->get('bank_transaction');
		$tran = array();

		foreach ($query->result() as $row)
		{
			$tran[] = array(
				'amount' => $row->amount,
				'status' => $row->status,
				'date' => $row->datetime,
				'desc' => ($row->tranType == 0) ? 'Added to Wallet' : 'Withdraw from Wallet',
				'type' => $row->tranType,
			);
		}
		$query = $this->db->get("commission_transaction");
		foreach ($query->result() as $row)
		{
			$tran[] = array(
				'amount' => $row->amount,
				'status' => 0,
				'date' => $row->datetime,
				'desc' => ($row->crId == 1) ? 'Commission Received from Doctors' : 'Commission Received from Pharmacist',
				'type' => 0,
			);
		}

		function date_sort($a, $b) {
			return strtotime($b['date']) - strtotime($a['date']);
		}
		usort($tran, 'date_sort');
		return  array(
			'wallet' => $wallet,
			'transaction' => $tran
		);
	}

	public function transfer($type,$amount,$walletId){

		if ($type == 0){
			$this->db->set('amount', "amount+$amount", FALSE);
			$this->db->where('walletId', $walletId);
			$this->db->update('wallet');
		} else {
			$this->db->select('amount');
			$this->db->where('walletId', $walletId);
			$row = $this->db->get('wallet')->row();
			if ($row->amount < $amount){
				redirect('wallet?err=You do not have enough Balance');
			} else{
				$this->db->set('amount', "amount-$amount", FALSE);
				$this->db->where('walletId', $walletId);
				$this->db->update('wallet');
			}
		}
		$rec = array(
			'amount' => $amount,
			'tranType' => $type,
			'walletId' => $walletId,
			'datetime' => date('Y-m-d H:i:s', now('Asia/Kolkata')),
		);

		$this->db->insert('bank_transaction', $rec);

	}

	public function fetchBalance(){
		$pId = $this->session->userdata('uId');
		$userType = $this->session->userdata('userType');

		$this->db->select('amount');
		$this->db->where('userId', $pId);
		$this->db->where('userTypeId', $userType);
		$wallet = $this->db->get('wallet')->row();
		return $wallet->amount;
	}

}

/* End of file WalletModel.php */
