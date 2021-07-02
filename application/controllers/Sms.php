<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sms extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
//		$to = "msherdiwala16@gmail.com";
//		$from = "xxxx@medicare.sparkingstars.club";
//		$message = "This is a text message\nNew line...";
//		$headers = "From: $from\n";
//		mail($to, '', $message, $headers);
//		https://www.pay2all.in/web-api/send_sms?api_token=JE7RxAOS2CiT44iMBeqe0BdyCvccl76WUqj9CAcsjd7j78Q3WShE5KNx4SBL&number=8849365331&senderid=mcare&message=Hey%20Babs%20Thats%20me%20If%20u%20are%20there%20then%20msg%20me&route=4
//		$api = 'JE7RxAOS2CiT44iMBeqe0BdyCvccl76WUqj9CAcsjd7j78Q3WShE5KNx4SBL';
//		$senderid = 'MEDICA';
//		$number = '6353418823';
//		$message = 'Hello Sir, Welcome to Medicare.';
//		$route = 4;
//		echo $url = "https://www.pay2all.in/web-api/send_sms?api_token=$api&number=".urlencode($number)."&senderid=$senderid&message=".urlencode($message)."&route=$route";
//		$ch = curl_init();
//		curl_setopt($ch, CURLOPT_URL, $url);
//		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
//		$output = curl_exec($ch);
//		echo curl_error($ch) ;
//		curl_close($ch);
//		echo $output;
		$this->load->library('pdf');
		$this->load->view('pdf');
	}

}

/* End of file Sms.php */
