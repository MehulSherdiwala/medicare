<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('ChatModel');
	}

	public function index()
	{
		$this->load->view('doctor/chat');
	}

	public function queue()
	{
		$res = $this->ChatModel->queue();

		echo json_encode($res);
	}

	public function get_chat($appId)
	{
		$res = $this->ChatModel->getChat($appId);

		echo json_encode($res);
	}

	public function send()
	{
		$this->ChatModel->sendMsg(0);
	}

	public function sendAttach()
	{

		$ran = rand(1000,9999);
		$config['upload_path']="./chat-attach";
		$config['allowed_types']='gif|jpg|png|pdf';
		$config['file_name']= $ran."_".$_FILES['file']['name'];
		$this->load->library('upload',$config);
		if($this->upload->do_upload("file")){
			$data = array('upload_data' => $this->upload->data());
			$res = $this->ChatModel->sendAttach($data['upload_data']['file_name'],0);
			echo json_encode($res);
		}

	}

	public function getMsg()
	{
		$res = $this->ChatModel->getMsg(1);

		echo json_encode($res);
	}

	public function allocate()
	{
		$res = $this->ChatModel->allocate();

		echo json_encode($res);
	}

	public function checkAlloc()
	{
		$res = $this->ChatModel->checkAlloc();

		echo $res;
	}

	public function next($appId)
	{
		$res = $this->ChatModel->next($appId);

		echo $res;
	}

	public function endSession()
	{
		$res = $this->ChatModel->endSession();

		redirect('doctor');
	}

}

/* End of file Chat.php */
