<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Noti extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->model('NotiModel');

		$id = $this->session->userdata('uId');
		$userType = $this->session->userdata('userType');

		$view = $this->input->post('view');
		if (isset($view) && !empty($view)){
			$this->NotiModel->viewed_noti($id,$userType);
		}

		$res = $this->NotiModel->fetch_noti($id,$userType);
//		echo $id.$userType;
		echo json_encode($res);
	}

}

/* End of file Noti.php */
