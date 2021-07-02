<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ChatModel extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function queue()
	{
		$query  =  $this->db
						->select('ica.datetime, ica.pId,username,ica.icappId,profileImg')
						->where('ica.status', 0)
						->where('dptId', 2)
						->order_by('ica.datetime')
						->join('patient p','p.pId=ica.pId')
						->get('instant_cure_appointment ica');

		$res = array();
		foreach ($query->result() as $row)
		{
			$now = time();
			$res[] = array(
				'pId' => $row->pId,
				'profileImg' => (($row->profileImg == '')? 'profile.png' : $row->profileImg),
				'icappId' => $row->icappId,
				'username' => $row->username,
				'datetime' => timespan( strtotime($row->datetime),$now ) . ' ago'
			);
		}
		return $res;
	}

	public function getChat($appId)
	{
		$queryChat = $this->db
						->where('icappId', $appId)
						->where('deleted', 0)
						->get('chat');

		$res = array();
		if ($queryChat->num_rows() > 0){
			foreach ($queryChat->result() as $rowChat)
			{
				$queryMsg = $this->db->where('chatId', $rowChat->chatId)->get('chat_msg');
				if ($queryMsg->num_rows() > 0){
					$rowMsg = $queryMsg->row();

					$res[] = array(
						'chatId' => $rowChat->chatId,
						'sender' => $rowChat->sender,
						'timestamp' => date('h:i A', strtotime($rowChat->timestamp)),
						'msg' => $rowMsg->msg,
					);
				} else {
					$rowAtt = $this->db->where('chatId', $rowChat->chatId)->get('chat_attachment')->row();

					$ext = pathinfo("chat-attch".$rowAtt->src, PATHINFO_EXTENSION);
					$extVal = 0;
					if ($ext == 'pdf'){
						$extVal = 1;
					} elseif ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'gif'){
						$extVal = 2;
					}
					$res[] = array(
						'chatId' => $rowChat->chatId,
						'sender' => $rowChat->sender,
						'timestamp' => date('h:i A', strtotime($rowChat->timestamp)),
						'src' => $rowAtt->src,
						'ext' => $extVal
					);
				}
			}
		}

		return $res;
	}

	public function sendMsg($sender)
	{
		$appId = $this->input->post('appId');
		$msg = $this->input->post('msg');
		$rowDoc = $this->db->where('icappId', $appId)->get('instant_cure_doctor')->row();

		print_r($rowDoc);
		$row = $this->db->select('pId')->where('icappId', $appId)->get('instant_cure_appointment')->row();

		$insData = array(
			'timestamp' => date('Y-m-d H:i:s', now('Asia/Kolkata')),
			'docId' => $rowDoc->docId,
			'icappId' => $appId,
			'sender' => $sender,
			'pId' => $row->pId
		);

		$this->db->insert('chat', $insData);
		$chatId = $this->db->insert_id();

		$insmsg = array(
			'msg' => $msg,
			'chatId' => $chatId,
		);
		$this->db->insert('chat_msg', $insmsg);
	}

	public function sendAttach($src,$sender)
	{
		$appId = $this->input->post('appId');

		$docId = $this->session->userdata('uId');

		$row = $this->db->select('pId')->where('icappId', $appId)->get('instant_cure_appointment')->row();

		$insData = array(
			'timestamp' => date('Y-m-d H:i:s', now('Asia/Kolkata')),
			'docId' => $docId,
			'icappId' => $appId,
			'sender' => $sender,
			'pId' => $row->pId
		);

		$this->db->insert('chat', $insData);
		$chatId = $this->db->insert_id();

		$insmsg = array(
			'src' => $src,
			'chatId' => $chatId,
		);
		$this->db->insert('chat_attachment', $insmsg);
		$ext = pathinfo("chat-attch".$src, PATHINFO_EXTENSION);
		$extVal = 0;
		if ($ext == 'pdf'){
			$extVal = 1;
		} elseif ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'gif'){
			$extVal = 2;
		}

		return array(
			'ext' => $extVal,
			'src' => $src,
			'timestamp' => date('h:i A', now('Asia/Kolkata'))
		);
	}

	public function getMsg($sender)
	{
		$appId = $this->input->post('appId');

		$queryChat = $this->db
					->where('icappId', $appId)
					->where('sender', $sender)
					->where('status', 0)
					->get('chat');

		$res = array();
		if ($queryChat->num_rows() > 0){
			foreach ($queryChat->result() as $rowChat)
			{
				$queryMsg = $this->db->where('chatId', $rowChat->chatId)->get('chat_msg');
				if ($queryMsg->num_rows() > 0){
					$rowMsg = $queryMsg->row();

					$res[] = array(
						'chatId' => $rowChat->chatId,
						'sender' => $rowChat->sender,
						'timestamp' => date('h:i A', strtotime($rowChat->timestamp)),
						'msg' => $rowMsg->msg,
					);
				} else {
					$rowAtt = $this->db->where('chatId', $rowChat->chatId)->get('chat_attachment')->row();

					$ext = pathinfo("chat-attch".$rowAtt->src, PATHINFO_EXTENSION);
					$extVal = 0;
					if ($ext == 'pdf'){
						$extVal = 1;
					} elseif ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'gif'){
						$extVal = 2;
					}
					$res[] = array(
						'chatId' => $rowChat->chatId,
						'sender' => $rowChat->sender,
						'timestamp' => date('h:i A', strtotime($rowChat->timestamp)),
						'src' => $rowAtt->src,
						'ext' => $extVal
					);
				}
			}
		}

		$this->db
			->set('status', 1)
			->where('icappId', $appId)
			->where('sender', $sender)
			->update('chat');

		return $res;
	}

	function startIC(){
		$docId = $this->session->userdata('uId');

		$this->db->where('docId', $docId)
				->set('active_status',1)
				->set('active_time',date('Y-m-d H:i:s', now('Asia/Kolkata')))
				->update('instant_cure_doctor');
	}

	function allocate(){
		$appId = $this->input->post('appId');
		$docId = $this->session->userdata('uId');
		if (isset($appId)&& $appId != '')
		{
			$this->db->where('icappId', $appId)
				->set('status', 1)
				->update('instant_cure_appointment');

			$this->db->where('docId', $docId)
				->set('allocated', 1)
				->set('icappId', $appId)
				->set('active_time', date('Y-m-d H:i:s', now('Asia/Kolkata')))
				->update('instant_cure_doctor');

			$row = $this->db->select('p.username,p.profileImg')
				->where('icappId', $appId)
				->join('patient p', 'p.pId=ica.pId')
				->get('instant_cure_appointment ica')->row();

			return array(
				'username' => $row->username,
				'profileImg' => (($row->profileImg == '')? 'profile.png' : $row->profileImg)
			);
		}
		return '';
	}

	function checkAlloc(){
		$docId = $this->session->userdata('uId');

		$row = $this->db->where('docId', $docId)->get('instant_cure_doctor')->row();

		return $row->allocated;
	}

	function next($appId){
		$docId = $this->session->userdata('uId');
		$this->db->where('docId', $docId)
			->set('allocated',0)
			->set('icappId',0)
			->update('instant_cure_doctor');
		$price = 300;
		$this->db->select('walletId');
		$this->db->where('userId', $docId);
		$this->db->where('userTypeId', 1);
		$wallet = $this->db->get('wallet')->row();

		$rowRate = $this->db->where('userType', 1)->get('commission_rate')->row();

		$commission = floor(($price * $rowRate->rate)/100);
		$finalAmount = $price - $commission;

		$this->db->set('amount', "amount+$finalAmount", FALSE);
		$this->db->where('walletId', $wallet->walletId);
		$this->db->update('wallet');

		$insData = array(
			'amount' => $commission,
			'crId' => $rowRate->crId,
			'userId' => $docId,
			'datetime' => date('Y-m-d H:i:s',now('Asia/Kolkata')),
		);
		$this->db->insert('commission_transaction', $insData);

		$rowP = $this->db->where('icappId', $appId)->get('instant_cure_appointment')->row();

		$pay = array(
			'amount' => $price,
			'appId' => $appId,
			'pId' => $rowP->pId,
			'appType' => 1,
			'datetime' => date('Y-m-d H:i:s', now('Asia/Kolkata')),
		);
		$this->db->insert('payment_doctor', $pay);

		$this->db->set('amount', "amount-$finalAmount", FALSE);
		$this->db->where('userTypeId', 4);
		$this->db->where('userId', 1);
		$this->db->update('wallet');

		return $this->db->where('icappId', $appId)
						->set('status',2)
						->update('instant_cure_appointment');
	}

	function checkApp($appId){
		$row = $this->db->where('icappId', $appId)->get('instant_cure_appointment')->row();

		$username = '';
		$profileImg = 'profile.png';
		if ($row->status == 1){
			$rowICD = $this->db->select('d.username,d.profileImg')
							->where('icappId', $appId)
							->join('doctor d','d.docId=icd.docId')
							->get('instant_cure_doctor icd')
							->row();
			$username = $rowICD->username;
			$profileImg = (($rowICD->profileImg == '')? 'profile.png' : $rowICD->profileImg);
		}
		return array(
			'status' => $row->status,
			'profileImg' => $profileImg,
			'username' => $username
		);
	}

	function endSession(){
		$docId = $this->session->userdata('uId');
		$this->db->where('docId', $docId)
			->set('allocated',0)
			->set('icappId',0)
			->set('active_status',0)
			->update('instant_cure_doctor');

	}

	function chatList(){
		$pId = $this->session->userdata('uId');
		$query = $this->db->query("select distinct (c.icappId),c.docId,d.username,d.profileImg,ica.datetime from instant_cure_appointment ica join chat c on ica.icappId = c.icappId join doctor d on c.docId = d.docId where ica.pId=$pId and ica.status = 2");

		$res = array();
		foreach ($query->result() as $row)
		{
			$res[] = array(
				'icappId' => $row->icappId,
				'datetime' => date('d M Y',strtotime($row->datetime)),
				'username' => $row->username,
				'profileImg' => $row->profileImg,
			);
		}
		return $res;
	}

}

/* End of file ChatModel.php */
