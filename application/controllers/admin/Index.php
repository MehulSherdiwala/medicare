<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$aId = $this->session->userdata('aId');
		if (!isset($aId)){
			redirect('admin/login');
		}
		$this->load->model('admin/AdminModel','AdminModel');
		$data['data'] = $this->AdminModel->dashboard();
		$this->load->view('admin/index',$data);
	}

}

/* End of file Index.php */
