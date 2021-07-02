<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/AdminModel','AdminModel');
	}

	public function index()
	{
		$aId = $this->session->userdata('aId');
		if (!isset($aId)){
			redirect('admin/login');
		}
		$this->load->view('admin/admin');
	}

	public function fetchAdminList()
	{
		$res = $this->AdminModel->fetchAdminList();

		echo json_encode($res);
	}

	public function fetchAdmin($aId)
	{
		$res = $this->AdminModel->fetchAdmin($aId);

		echo json_encode($res);
	}

	public function addAdmin()
	{
		$profile = '';
		if (isset($_FILES['profileImg'])){

			$ran = rand(1000,9999);
			$config['upload_path']= './profile';
			$config['allowed_types']='gif|jpg|png';
			$config['file_name']= $ran. '_' .$_FILES['profileImg']['name'];
			$this->load->library('upload',$config);
			if($this->upload->do_upload('profileImg')){
				$data = array('upload_data' => $this->upload->data());
				echo $profile = $data['upload_data']['file_name'];
			} else {
				print_r($this->upload->display_errors());
			}
		}

		$res = $this->AdminModel->addAdmin($profile);

		echo json_encode($res);
	}

	public function editAdmin()
	{
		$profile = '';
		if (isset($_FILES['profileImg'])){

			$ran = rand(1000,9999);
			$config['upload_path']= './profile';
			$config['allowed_types']='gif|jpg|png';
			$config['file_name']= $ran. '_' .$_FILES['profileImg']['name'];
			$this->load->library('upload',$config);
			if($this->upload->do_upload('profileImg')){
				$data = array('upload_data' => $this->upload->data());
				echo $profile = $data['upload_data']['file_name'];
			} else {
				print_r($this->upload->display_errors());
			}
		}

		$res = $this->AdminModel->editAdmin($profile);

		echo json_encode($res);
	}

}

/* End of file Admin.php */
