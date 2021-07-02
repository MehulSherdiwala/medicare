<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ShopModel extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('cart');
	}

	public function getMedicine($id,$flag=0){
		if ($flag==0)
		{
			$this->load->model('EncDec');
			$pwmId = $this->EncDec->encrypt_decrypt('decrypt', $id);
		} else {
			$pwmId = $id;
		}
		$this->db->select('medName, pwmId,price');
		$this->db->from('medicine');
		$this->db->join('pharmacist_wise_medicine', 'pharmacist_wise_medicine.medId = medicine.medId');
		$this->db->where('pwmId', $pwmId);
		return $this->db->get()->row();

	}

	public function addToCart($id,$qty,$uId){
		$row = $this->getMedicine($id);

		if(!empty($uId)){
			$this->db->select('cartId');
			$this->db->where('pwmId', $row->pwmId);
			$this->db->where('pId', $uId);
			$query = $this->db->get('cart');
			$row2 = $query->row();
			if ($query->num_rows() > 0){
				$this->db->set('qty',"qty+$qty",FALSE);
				$this->db->where('cartId', $row2->cartId);
				$this->db->update('cart');
			} else {
				$cartData = array(
					'qty' => $qty,
					'pwmId' => $row->pwmId,
					'pId' => $uId,
				);
				$this->db->insert('cart', $cartData);
			}

		}
		$data = array(
			'id' => $row->pwmId,
			'name' => $row->medName,
			'price' => $row->price,
			'qty' => $qty,
		);
		$this->cart->insert($data);
//			return $this->show_cart();
	}

	public function show_cart(){
		$output = '
				<thead>
					<tr>
						<th>Medicine Name</th>
						<th>Price</th>
						<th width="15%">Quantity</th>
						<th>Total</th>
						<th>Action</th>
					</tr>
					</thead>
					<tbody  class="cartItem">';
		foreach ($this->cart->contents() as $items) {
			$output .='
                <tr>
                    <td>'.$items['name'].'</td>
                    <td>'.number_format($items['price']).'</td>
                    <td><input type="number" value="'.$items['qty'].'" class="qty form-control" data-rowid="'.$items['rowid'].'" data-pwmid="'.$items['id'].'"></td>
                    <td>'.number_format($items['subtotal']).'</td>
                    <td><button type="button" id="'.$items['rowid'].'" data-pwmid="'.$items['id'].'" class="remove_cart btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button></td>
                </tr>
            ';
		}
		$output .= '
			</tbody>
			<tfoot>
            <tr>
                <th colspan="3">Total</th>
                <th colspan="2">'.'<i class="fas fa-rupee-sign"></i> '.number_format($this->cart->total()).'</th>
            </tr>
            </tfoot>
        ';
		return $output;
	}

	public function countCart(){
		$cnt = 0;
		foreach ($this->cart->contents() as $items) {
			$cnt++;
		}
		return $cnt;
	}

	public function delete_cart($pwmId,$id,$loc){
		$pId = $this->session->userdata('uId');
		if (isset($pId))
		{
			$this->db->query("delete from cart where pId = $pId and pwmId = $pwmId");
		}
		$data = array(
			'rowid' => $id,
			'qty' => 0,
		);
		$this->cart->update($data);
		if ($loc == 1){
			$med = $this->fetchMedicine();
			$html = '';
			foreach ($med as $medData)
			{
				$html .= '
				<div class="row">
					<div class="col-md-5 offset-1 img-wrapper">
						<img src="'. base_url() .'assets/img/medicine.jpg"
							 class="img-fluid" alt="">
					</div>
					<div class="col-md-5 med-details text-left">
						<h3>' . $medData['medName'] . ' ' . $medData['dose'] . '</h3>
						<h6>By ' . $medData['pharName'] . '</h6>
						<h4>' . $medData['capacity'] . '</h4>
						<h3><i class="fas fa-rupee-sign"></i> ' . $medData['price'] . '</h3>
						<div>
							<input type="number" class="form-control qty float-left" value="' . $medData['qty'] . '" data-rowid="' . $medData['rowid'] . '" data-pwmid="' . $medData['pwmId'] . '">
							<button type="button" id="' . $medData['rowid'] . '" data-pwmid="' . $medData['pwmId'] . '" class="remove_cart btn btn-danger btn-sm" style="margin-left: 25px; margin-top: 10px;"><i class="far fa-trash-alt"></i></button>
						</div>
					</div>

				</div>
				<br>';
			}
			return $html;
		}else{
			return $this->show_cart();
		}
	}

	public function update_cart($pwmId,$id,$qty,$loc){
		$pId = $this->session->userdata('uId');
		$this->db->set('qty',$qty);
		$this->db->where('pwmId', $pwmId);
		$this->db->where('pId', $pId);
		$this->db->update('cart');
		$data = array(
			'rowid' => $id,
			'qty' => $qty,
		);
		$this->cart->update($data);
		if ($loc == 1){
			$med = $this->fetchMedicine();
			$html = '';
			foreach ($med as $medData)
			{
				$html .= '
				<div class="row">
					<div class="col-md-5 offset-1 img-wrapper">
						<img src="'. base_url() .'assets/img/medicine.jpg"
							 class="img-fluid" alt="">
					</div>
					<div class="col-md-5 med-details text-left">
						<h3>' . $medData['medName'] . ' ' . $medData['dose'] . '</h3>
						<h6>By ' . $medData['pharName'] . '</h6>
						<h4>' . $medData['capacity'] . '</h4>
						<h3><i class="fas fa-rupee-sign"></i> ' . $medData['price'] . '</h3>
						<div>
							<input type="number" class="form-control qty float-left" value="' . $medData['qty'] . '" data-rowid="' . $medData['rowid'] . '" data-pwmid="' . $medData['pwmId'] . '">
							<button type="button" id="' . $medData['rowid'] . '" data-pwmid="' . $medData['pwmId'] . '" class="remove_cart btn btn-danger btn-sm" style="margin-left: 25px; margin-top: 10px;"><i class="far fa-trash-alt"></i></button>
						</div>
					</div>

				</div>
				<br>';
			}
			return $html;
		}else
		{
			return $this->show_cart();
		}
	}

	public function getAddress(){
		$pId = $this->session->userdata('uId');
		$this->db->select('username,phone,address,pincode');
		$this->db->where('pId', $pId);
		$row = $this->db->get('patient')->row();
		$data = array();
		$data[] = array(
			'daId' => 0,
			'address' => $row->address,
			'name' => $row->username,
			'phone' => $row->phone,
			'pincode' => $row->pincode,
		);

		$this->db->where('pId', $pId);
		$query = $this->db->get('delivery_address');

		foreach ($query->result() as $row2)
		{
			$data [] = array(
				'daId' => $row2->daId,
				'address' => $row2->daAddress,
				'name' => $row2->daName,
				'phone' => $row2->daPhone,
				'pincode' => $row2->daPincode,
			);
		}

		return $data;
	}
	
	public function addAddress($data){
		$this->db->insert('delivery_address', $data);
		$id	= $this->db->insert_id();
		
		$this->db->where('daId', $id);
		$row = $this->db->get('delivery_address')->row();
		$rid=rand(10,100);
		$html = '
		<div class="custom-control custom-radio p-3">
			<input type="radio" class="custom-control-input" id="i'. $rid.'" name="address" required value="'.$row->daId.'">
			<label class="custom-control-label" for="i'. $rid.'">
				<b class="text-capitalize">'.
					$row->daName.'  '.$row->daPhone
					.'</b>
				<br>'.
				$row->daAddress.' - '.$row->daPincode
				.'
			</label>
		</div>';
		return $html;
	}

	public function fetchMedicine(){
		$this->load->model('MedicineModel');

		$this->db->select('pwmId,qty');
		$pId = $this->session->userdata('uId');
		$this->db->where('pId', $pId);
		$query = $this->db->get('cart');

		foreach ($this->cart->contents() as $items) {
			$arr[$items['id']] = $items['rowid'];
		}


		$data = array();
		foreach ($query->result() as $key=>$row)
		{
			$data[$key] = $this->MedicineModel->fetchMedicine($row->pwmId,1);
			$data[$key]['qty'] = $row->qty;
			$data[$key]['rowid'] = $arr[$row->pwmId];
		}

		return $data;
	}

	public function priceDetail(){
		$cnt = $this->countCart();
		$html = '
			<table class="table no-border table-striped">
				<tr>
					<td>Price ('.$cnt.' items)</td>
					<td><i class="fas fa-rupee-sign"></i> '.number_format($this->cart->total()).'</td>
				</tr
				<tr>
					<td>Delivery Charges</td>
					<td>Free</td>
				</tr>
				<tr>
					<td><b>Total Payable</b></td>
					<td><i class="fas fa-rupee-sign"></i> <span id="totalAmt">'.number_format($this->cart->total()).'</span> <input type="hidden"  id="totalAmt" value="'.$this->cart->total().'"></td>
				</tr>
			</table>
		';
		return array(
			'html' => $html,
			'total' => $this->cart->total()
		);
	}

	public function order($payOption,$amount){
		$type = $this->input->post('type');
		$totalAmount = ($type=='cart') ? $this->cart->total() : $this->input->post('totalAmount');

		$order = array(
			'daId' => $this->input->post('address'),
			'totalAmount' => $totalAmount,
			'payMethod' => $payOption,
			'status' => 'Pending',
			'pId' => $this->session->userdata('uId'),
			'datetime' => date('Y-m-d H:i:s', now('Asia/Kolkata')),
		);

		$this->db->insert('order_medicine', $order);
		$orderId = $this->db->insert_id();


		if ($type == 'direct'){
			$item = array(
				'pwmId' => $this->input->post('pwmId'),
				'qty' => $this->input->post('qty'),
				'price' => $this->input->post('price'),
				'orderId' => $orderId,
			);
			$this->db->insert('order_item', $item);
			if ($payOption != 'COD')
			{
				$this->db->select('pharId');
				$this->db->where('pwmId', $this->input->post('pwmId'));
				$rowPhar = $this->db->get('pharmacist_wise_medicine')->row();
				
				$rowRate = $this->db->where('userType', 2)->get('commission_rate')->row();

				$commission = floor(($totalAmount * $rowRate->rate)/100);
				$finalAmount = $totalAmount - $commission;
				$insData = array(
					'amount' => $commission,
					'crId' => $rowRate->crId,
					'userId' => $rowPhar->pharId,
					'datetime' => date('Y-m-d H:i:s',now('Asia/Kolkata')),
				);

				$this->db->insert('commission_transaction', $insData);

				$this->db->set('amount', "amount+$finalAmount", FALSE);
				$this->db->where('userTypeId', 2);
				$this->db->where('userId', $rowPhar->pharId);
				$this->db->update('wallet');

				$this->db->set('amount', "amount+$commission", FALSE);
				$this->db->where('userTypeId', 4);
				$this->db->where('userId', 1);
				$this->db->update('wallet');
			}
		} elseif ($type == 'cart'){
			foreach ($this->cart->contents() as $items) {

				$item = array(
					'pwmId' => $items['id'],
					'qty' => $items['qty'],
					'price' => $items['price'],
					'type' => (isset($items['option']))? $items['option'] : 0,
					'orderId' => $orderId,
				);
				$this->db->insert('order_item', $item);

				if ($payOption != 'COD')
				{
					$subtotal = $items['subtotal'];
					$this->db->select('pharId');
					$this->db->where('pwmId', $items['id']);
					$rowPhar = $this->db->get('pharmacist_wise_medicine')->row();

					$rowRate = $this->db->where('userType', 2)->get('commission_rate')->row();

					$commission = floor(($subtotal * $rowRate->rate)/100);
					$finalAmount = $subtotal - $commission;
					$insData = array(
						'amount' => $commission,
						'crId' => $rowRate->crId,
						'userId' => $rowPhar->pharId,
						'datetime' => date('Y-m-d H:i:s',now('Asia/Kolkata')),
					);
					$this->db->insert('commission_transaction', $insData);

					$this->db->set('amount', "amount+$finalAmount", FALSE);
					$this->db->where('userTypeId', 2);
					$this->db->where('userId', $rowPhar->pharId);
					$this->db->update('wallet');

					$this->db->set('amount', "amount+$commission", FALSE);
					$this->db->where('userTypeId', 4);
					$this->db->where('userId', 1);
					$this->db->update('wallet');
				}

				$this->delete_cart($items['id'],$items['rowid'],0);
			}
		}

		if ($payOption != 'COD'){
			$pId = $this->session->userdata('uId');
			$userType = $this->session->userdata('userType');

			$this->db->select('walletId');
			$this->db->where('userId', $pId);
			$this->db->where('userTypeId', $userType);
			$wallet = $this->db->get('wallet')->row();
			if($payOption != 'wallet')
			{
				$rec = array(
					'amount' => $amount,
					'tranType' => 0,
					'walletId' => $wallet->walletId,
					'datetime' => date('Y-m-d H:i:s', now('Asia/Kolkata')),
				);

				$this->db->insert('bank_transaction', $rec);
				$this->db->set('amount', "amount+$amount", FALSE);
				$this->db->where('walletId', $wallet->walletId);
				$this->db->update('wallet');
			}

			$this->db->set('amount', "amount-$totalAmount", FALSE);
			$this->db->where('walletId', $wallet->walletId);
			$this->db->update('wallet');

			$payrec = array(
				'amount' => $totalAmount,
				'orderId' => $orderId,
				'pId' => $pId,
				'datetime' => date('Y-m-d H:i:s', strtotime('+2 sec',now('Asia/Kolkata'))),
			);
			$this->db->insert('payment_pharmacist', $payrec);
		}

	}

	public function presAddToCart($presId,$uId){
		$this->db->where('presId', $presId)
				->set('status', 1)
				->update('prescription');
		$rowPwm = $this->db->where('presId', $presId)->get('prescription')->row();
		$row = $this->getMedicine($rowPwm->pwmId,1);
		print_r($rowPwm->pwmId);

		if(!empty($uId)){
			$this->db->select('cartId');
			$this->db->where('pwmId', $row->pwmId);
			$this->db->where('pId', $uId);
			$query = $this->db->get('cart');
			$row2 = $query->row();
			$qty = $rowPwm->qty;
			if ($query->num_rows() > 0){
				$this->db->set('qty',"qty+$qty",FALSE);
				$this->db->where('cartId', $row2->cartId);
				$this->db->update('cart');
			} else {
				$cartData = array(
					'qty' => $qty,
					'pwmId' => $row->pwmId,
					'pId' => $uId
				);
				$this->db->insert('cart', $cartData);
			}

		}
		$data = array(
			'id' => $row->pwmId,
			'name' => $row->medName,
			'price' => $row->price,
			'qty' => $rowPwm->qty,
			'option' => 1
		);
		$this->cart->insert($data);
//			return $this->	show_cart();
	}

}

/* End of file ShopModel.php */
