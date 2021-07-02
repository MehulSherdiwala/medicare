<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class loginModel extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}


	public function userLogin($user_data){
//		echo $this->db->get("doctor)->num_rows();
//		$this->db->where($user_data);
		if ($this->db->get("patient where email='".$user_data['email']."' and pwd='".$user_data['pwd']."'")->num_rows() > 0)
		{
			$this->db->where($user_data);
			$query = $this->db->get('patient');

			$row = $query->row();
			$user_data = array(
				'uId' => $row->pId,
				'userType' => '3',
				'username' => $row->username,
				'profileImg' => $row->profileImg,
				'emptyRow' => 0,
				'dptId' => 0,
			);
			$this->cart($row->pId);

			$emptyRow = $this->db->query("
				SELECT SUM(CASE
				   WHEN address is null or COALESCE(TRIM(address), '') = '' THEN 1
				   WHEN description is null or COALESCE(TRIM(description), '') = '' THEN 1
				   ELSE 0 END
			   	) as empty_fields FROM patient WHERE pId = $row->pId;");

			$user_data['emptyRow'] = $emptyRow->row()->empty_fields;

			return $user_data;
		} elseif ($this->db->get("doctor where email='".$user_data['email']."' and pwd='".$user_data['pwd']."'")->num_rows() > 0) {
			$this->db->where($user_data);
			$query = $this->db->get('doctor');
			foreach ($query->result() as $row)
			{
				$user_data = array(
					'uId' => $row->docId,
					'dptId' => $row->dptId,
					'userType' => '1',
					'username' => $row->username,
					'profileImg' => $row->profileImg,
				);
			}

			$emptyRow = $this->db->query("
				SELECT SUM(CASE
				   WHEN address is null or COALESCE(TRIM(address), '') = '' THEN 1
				   WHEN description is null or COALESCE(TRIM(description), '') = '' THEN 1
				   ELSE 0 END
			   	) as empty_fields FROM doctor WHERE docId = $row->docId;");

			$user_data['emptyRow'] = $emptyRow->row()->empty_fields;

			return $user_data;
		} elseif ($this->db->get("pharmacist where email='".$user_data['email']."' and pwd='".$user_data['pwd']."'")->num_rows() > 0){

			$this->db->where($user_data);
			$query = $this->db->get('pharmacist');
			foreach ($query->result() as $row)
			{
				$user_data = array(
					'uId' => $row->pharId,
					'dptId' => $row->dptId,
					'userType' => '2',
					'username' => $row->username,
					'profileImg' => $row->profileImg,
				);
			}
			$emptyRow = $this->db->query("
				SELECT SUM(CASE
				   WHEN address is null or COALESCE(TRIM(address), '') = '' THEN 1
				   WHEN description is null or COALESCE(TRIM(description), '') = '' THEN 1
				   ELSE 0 END
			   	) as empty_fields FROM pharmacist WHERE pharId = $row->pharId;");

			$user_data['emptyRow'] = $emptyRow->row()->empty_fields;

			return $user_data;
		} else {
			return 0;
		}
	}

	private function cart($id){
		$this->load->library('cart');

//		$this->cart->destroy();

		$cnt = $this->countCart();

		if ($cnt > 0){
			$pwmIds = array();
			$qty = array();
			foreach ($this->cart->contents() as $items) {
				array_push($pwmIds,$items['id']);
				$qty[$items['id']] = $items['qty'];
			}
			print_r($pwmIds);
			print_r($qty);

			$this->db->where('pId', $id);
			$this->db->where_in('pwmId', implode(',',$pwmIds),FALSE);
			$query = $this->db->get('cart');
			foreach ($query->result() as $row)
			{
//				echo $row->pwmId;
				if ($row->qty != $qty[$row->pwmId]){
					$this->db->set('qty',$qty[$row->pwmId]);
					$this->db->where('cartId', $row->cartId);
					$this->db->update('cart');
				}
			}

			$this->db->select('medName, cart.pwmId,price,qty');
			$this->db->from('cart');
			$this->db->join('pharmacist_wise_medicine', 'pharmacist_wise_medicine.pwmId = cart.pwmId');
			$this->db->join('medicine', 'pharmacist_wise_medicine.medId = medicine.medId');
			$this->db->where('cart.pId', $id);
			$this->db->where_not_in('cart.cartId', implode(',',$pwmIds), FALSE);
			$query = $this->db->get();
			$cartData = array();
			foreach ($query->result() as $row)
			{
				$cartData[] = array(
					'id' => $row->pwmId,
					'name' => $row->medName,
					'price' => $row->price,
					'qty' => $row->qty,
				);
			}
			$this->cart->insert($cartData);

			foreach ($pwmIds as $pwm_id)
			{
				$this->db->where('pwmId', $pwm_id);
				$num = $this->db->get('cart')->num_rows();
				if ($num == 0){
					$cartInsert = array(
						'qty' => $qty[$pwm_id],
						'pwmId' => $pwm_id,
						'pId' => $id,
					);
					$this->db->insert('cart', $cartInsert);
				}
			}

		} else {
			$this->db->select('medName, cart.pwmId,price,qty');
			$this->db->from('cart');
			$this->db->join('pharmacist_wise_medicine', 'pharmacist_wise_medicine.pwmId = cart.pwmId');
			$this->db->join('medicine', 'pharmacist_wise_medicine.medId = medicine.medId');
			$this->db->where('pId', $id);
			$query = $this->db->get();

			$cartData = array();
			foreach ($query->result() as $row)
			{
				$cartData[] = array(
					'id' => $row->pwmId,
					'name' => $row->medName,
					'price' => $row->price,
					'qty' => $row->qty,
				);
			}

			$this->cart->insert($cartData);
		}
//		return $this->show_cart();
	}

	private function countCart(){
		$cnt = 0;
		foreach ($this->cart->contents() as $items) {
			$cnt++;
		}
		return $cnt;
	}

	public function forgetPassword()
	{
		$email = $this->input->post('email');
		if ($this->db->get("patient where email='".$email."'")->num_rows() > 0)
		{
			$this->db->where('email',$email);
			$query = $this->db->get('patient');

			$row = $query->row();
			$_SESSION['fg-uid'] = $row->pId;
			$_SESSION['fg-userType'] = 3;
			$number = $row->phone;
			if (!isset($_SESSION['otp']))
			{
				$otp = mt_rand('100000', '999999');
				$_SESSION['otp'] = $otp;
			} else {
				$otp = $_SESSION['otp'];
			}
			if ($email == 'm@g.com')
			{
				$email = 'msherdiwala16@gmail.com';
			}

			$this->load->library('email');
			$this->email->from('medicare@medicare.sparkingstars.club', 'MediCare');
			$this->email->to($email);
			$this->email->subject('OTP');
			$this->email->message($otp.' is the OTP for your mobile verification on MediCare.This OTP will be valid for 10 minutes.');
			$this->email->send();
//			echo $this->email->print_debugger();

			if ($number != ''){
				$api = 'JE7RxAOS2CiT44iMBeqe0BdyCvccl76WUqj9CAcsjd7j78Q3WShE5KNx4SBL';
				$senderid = 'MEDICA';
				$message = $otp.' is the OTP for your mobile verification on MediCare.This OTP will be valid for 10 minutes.';
				$route = 4;
				$url = "https://www.pay2all.in/web-api/send_sms?api_token=$api&number=".urlencode($number)."&senderid=$senderid&message=".urlencode($message)."&route=$route";
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
				$output = curl_exec($ch);
				curl_close($ch);
//				echo curl_error($ch) ;
//				echo $output;
			}
			return 1;
		} elseif ($this->db->get("doctor where email='".$email."'")->num_rows() > 0) {
			$this->db->where('email',$email);
			$row = $this->db->get('doctor')->row();
			$_SESSION['fg-uid'] = $row->docId;
			$_SESSION['fg-userType'] = 1;
			$number = $row->phone;
			if (!isset($_SESSION['otp']))
			{
				$otp = mt_rand('100000', '999999');
				$_SESSION['otp'] = $otp;
			} else {
				$otp = $_SESSION['otp'];
			}
			if ($email == 'dm@g.com')
			{
				$email = 'msherdiwala16@gmail.com';
			}

			$this->load->library('email');
			$this->email->from('medicare@medicare.sparkingstars.club', 'MediCare');
			$this->email->to($email);
			$this->email->subject('OTP');
			$this->email->message($otp.' is the OTP for your mobile verification on MediCare.This OTP will be valid for 10 minutes.');
			$this->email->send();
//			echo $this->email->print_debugger();

			if ($number != ''){
				$api = 'JE7RxAOS2CiT44iMBeqe0BdyCvccl76WUqj9CAcsjd7j78Q3WShE5KNx4SBL';
				$senderid = 'MEDICA';
				$message = $otp.' is the OTP for your mobile verification on MediCare.This OTP will be valid for 10 minutes.';
				$route = 4;
				$url = "https://www.pay2all.in/web-api/send_sms?api_token=$api&number=".urlencode($number)."&senderid=$senderid&message=".urlencode($message)."&route=$route";
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
				$output = curl_exec($ch);
//				echo curl_error($ch) ;
				curl_close($ch);
//				echo $output;
			}
			return 1;
		} elseif ($this->db->get("pharmacist where email='".$email."'")->num_rows() > 0){

			$this->db->where('email',$email);
			$row = $this->db->get('pharmacist')->row();
			$_SESSION['fg-uid'] = $row->pharId;
			$_SESSION['fg-userType'] = 2;
			$number = $row->phone;
			if (!isset($_SESSION['otp']))
			{
				$otp = mt_rand('100000', '999999');
				$_SESSION['otp'] = $otp;
			} else {
				$otp = $_SESSION['otp'];
			}
			if ($email == 'm@g.com')
			{
				$email = 'msherdiwala16@gmail.com';
			}

			$this->load->library('email');
			$this->email->from('medicare@medicare.sparkingstars.club', 'MediCare');
			$this->email->to($email);
			$this->email->subject('OTP');
			$this->email->message($otp.' is the OTP for your mobile verification on MediCare.This OTP will be valid for 10 minutes.');
			$this->email->send();
//			echo $this->email->print_debugger();

			if ($number != ''){
				$api = 'JE7RxAOS2CiT44iMBeqe0BdyCvccl76WUqj9CAcsjd7j78Q3WShE5KNx4SBL';
				$senderid = 'MEDICA';
				$message = $otp.' is the OTP for your mobile verification on MediCare.This OTP will be valid for 10 minutes.';
				$route = 4;
				$url = "https://www.pay2all.in/web-api/send_sms?api_token=$api&number=".urlencode($number)."&senderid=$senderid&message=".urlencode($message)."&route=$route";
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
				$output = curl_exec($ch);
//				echo curl_error($ch) ;
				curl_close($ch);
//				echo $output;
			}
			return 1;
		} else {
			return 0;
		}
	}

	public function changePWD($pwd)
	{
		$userType = $_SESSION['fg-userType'];
		$userId = $_SESSION['fg-uid'];
		if ($userType==3){
			$this->db->set('pwd', $pwd)->where('pId', $userId)->update('patient');
		} elseif ($userType==1){
			$this->db->set('pwd', $pwd)->where('docId', $userId)->update('doctor');
		} elseif ($userType==2){
			$this->db->set('pwd', $pwd)->where('pharId', $userId)->update('pharmacist');
		}
	}

}

/* End of file loginModel.php */
