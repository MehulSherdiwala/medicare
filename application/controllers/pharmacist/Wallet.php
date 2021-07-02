<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wallet extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('WalletModel');
	}

	public function index()
	{

		$uId = $this->session->userdata('uId');
		if (!isset($uId)){
			redirect('index');
		}

		$res = $this->WalletModel->fetchTran();
		$data['wallet'] = $res['wallet'];
		$data['tran'] = $res['transaction'];
		$this->load->view('pharmacist/wallet',$data);
	}

	public function paymentGateway(){
		$uId = $this->session->userdata('uId');
		if (!isset($uId)){
			redirect('index');
		}

		$this->load->view('payment-gateway');
	}
	public function transfer(){
		$type = $this->input->post('type');
		$amount = $this->input->post('amount');
		$walletId = $this->input->post('walletId');
		echo $this->WalletModel->transfer($type,$amount,$walletId);

		redirect('pharmacist/wallet');

	}

}

/* End of file Wallet.php */
