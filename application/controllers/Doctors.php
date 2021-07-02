<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Doctors extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('DoctorModel');
	}

	public function index()
	{
		$data['search'] = $this->input->post('search');
		$this->load->view('doctors',$data);
	}

	public function doctorPages()
	{
		$this->load->library("pagination");
		$string	 = $this->uri->segment(4);

		$config = array();
		$config["base_url"] = "#";
		$config["total_rows"] = $this->DoctorModel->count_all($string);
		$config["per_page"] = 16;
		$config["uri_segment"] = 3;
		$config["use_page_numbers"] = TRUE;
		$config["full_tag_open"] = '<ul class="pagination">';
		$config["full_tag_close"] = '</ul>';
		$config["first_tag_open"] = '<li class="page-item">';
		$config["first_tag_close"] = '</li>';
		$config["last_tag_open"] = '<li class="page-item">';
		$config["last_tag_close"] = '</li>';
		$config['next_link'] = '&gt;';
		$config["next_tag_open"] = '<li class="page-item">';
		$config["next_tag_close"] = '</li>';
		$config["prev_link"] = "&lt;";
		$config["prev_tag_open"] = "<li class='page-item'>";
		$config["prev_tag_close"] = "</li>";
		$config["cur_tag_open"] = "<li class='page-item active'><a href='#' class='page-link'>";
		$config["cur_tag_close"] = "</a></li>";
		$config["num_tag_open"] = "<li class='page-item'>";
		$config["num_tag_close"] = "</li>";
		$config["num_links"] = 5;
		$config['attributes'] = array('class' => 'page-link');
		$this->pagination->initialize($config);
		$page = $this->uri->segment(3);
		$start = ($page - 1) * $config["per_page"];
		$output = array(
			'pagination_link'  => $this->pagination->create_links(),
			'doctor'   => $this->DoctorModel->fetch_details($config["per_page"], $start,$string)
		);
		echo json_encode($output);
	}

	public function searchDis()
	{
		$str = $this->input->post('query');
		$res = $this->DoctorModel->searchDis($str);

		echo json_encode($res);
	}
}

/* End of file Doctors.php */
