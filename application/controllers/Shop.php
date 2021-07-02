<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shop extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('ShopModel');
	}

	public function index()
	{

	}

	public function addToCart(){
		$id = $this->input->post('id');
		$qty = $this->input->post('qty');
		$uId = $this->session->userdata('uId');
		$data = $this->ShopModel->addToCart($id,$qty,$uId);
		echo $this->ShopModel->countCart();
	}

	public function cart(){
		$data['cartItem'] = $this->ShopModel->show_cart();
		$data['countCart'] = $this->ShopModel->countCart();
		$this->load->view('cart', $data);
	}

	public function removeCart($loc=0){
		$pwmId = $this->input->post('pwmId');
		$id = $this->input->post('id');
		echo $this->ShopModel->delete_cart($pwmId,$id,$loc);
	}

	public function updateCart($loc=0){
		$pwmId = $this->input->post('pwmId');
		$id = $this->input->post('id');
		$qty = $this->input->post('qty');
		echo $this->ShopModel->update_cart($pwmId,$id,$qty,$loc);
	}

	public function checkout($place=''){

		$uId = $this->session->userdata('uId');

		if (!isset($uId)  && $place != ''){
			redirect('login?loc=shop/checkout/'.$place);
		} elseif (!isset($uId) ){
			redirect('login?loc=shop/checkout?'.$_SERVER['QUERY_STRING']);
		}
		$data['address'] = $this->ShopModel->getAddress();
		$data['priceDetail'] = $this->ShopModel->priceDetail();
		$this->load->model('stateCityModel');

		$data['state'] = $this->stateCityModel->fetchState();
		$this->load->model('WalletModel');

		$data['balance'] = $this->WalletModel->fetchBalance();


		if (!empty($place) && $place=='cart'){
			$data['items'] = $this->ShopModel->fetchMedicine();
		} else {
			$this->load->model('MedicineModel');

			$id = $this->input->get('_');
			$qty = $this->input->get('qty');
			$this->load->model('EncDec');
			$pwmId = $this->EncDec->encrypt_decrypt('decrypt',$id);
			$data['medicine'] = $this->MedicineModel->fetchMedicine($pwmId,1);
			$data['medicine']['qty'] = $qty;
		}

		$data['countCart'] = $this->ShopModel->countCart();
		$this->load->view('checkout',$data);
	}

	public function priceDetails(){
		echo json_encode($this->ShopModel->priceDetail());
	}

	public function addAddress(){
		$rec = array(
			'daName' => $this->input->post('daName'),
			'daPhone' => $this->input->post('daPhone'),
			'daPincode' => $this->input->post('daPincode'),
			'daAddress' => $this->input->post('daAddress'),
			'cityId' => $this->input->post('city'),
			'pId' => $this->session->userdata('uId'),
			'createdAt' => date('Y-m-d H:i:s', now('Asia/Kolkata')),
		);

		$res = $this->ShopModel->addAddress($rec);

		echo $res;
	}

	public function order(){
		$payOption = $this->input->post('payOption');
		$amount = $this->input->post('amount');

		$data = $this->ShopModel->order($payOption,$amount);
		redirect('index');
	}

	public function countCart(){
		$cnt = $this->ShopModel->countCart();
		echo json_encode($cnt);
	}

	public function presAddToCart(){
		$id = $this->input->post('presId');
		$uId = $this->session->userdata('uId');
		foreach ($id as $presId)
		{
			$this->ShopModel->presAddToCart($presId,$uId);
		}
		echo 'Your Medicine is added to cart';
	}

	public function orderList()
	{
		$uId = $this->session->userdata('uId');
		if (!isset($uId)){
			redirect('index');
		}

		$this->load->model('SalesModel');

		$data['orderList'] = $this->SalesModel->orderList();

		$this->load->view('order-list', $data, FALSE);
	}

	public function orderDetails($orderId)
	{
		$this->load->model('SalesModel');

		$res = $this->SalesModel->orderDetails($orderId);

		echo json_encode($res);
	}

}

/* End of file Shop.php */
