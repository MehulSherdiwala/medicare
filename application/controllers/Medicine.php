<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Medicine extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("MedicineModel");
		$this->load->model("ShopModel");
	}

	public function index()
	{
		$data['countCart'] = $this->ShopModel->countCart();
		$data['search'] = $this->input->post('search');
		$this->load->view('medicine',$data);

	}

	public function medicinePages()
	{
		$this->load->library("pagination");
		$string	 = $this->uri->segment(4);
		$config = array();
		$config["base_url"] = "#";
		$config["total_rows"] = $this->MedicineModel->count_all($string);
		$config["per_page"] = 12;
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
			'medicine'   => $this->MedicineModel->fetch_details($config["per_page"], $start,$string)
		);
		echo json_encode($output);
	}

	public function medView(){

		$med = $this->input->get('_');
		$this->load->model('EncDec');
		$id = $this->EncDec->encrypt_decrypt('decrypt',$med);

		$data['medData'] = $this->MedicineModel->fetchMedicine($id,1);
		$data['countCart'] = $this->ShopModel->countCart();

		$data['medData']['pharId'] = $this->EncDec->encrypt_decrypt('encrypt',$data['medData']['pharId']);

		$userType = $this->session->userdata('userType');
		if ($userType == 3){
			$pId = $this->session->userdata('uId');
		} else {
			$pId = 0;
		}
		$data['review'] = $this->MedicineModel->checkReview($id,$pId);
		$data['rating'] = $this->MedicineModel->fetchReview($id);
		$data['avgRate'] = $this->MedicineModel->avgRating($id);

		$this->load->view('medicine-view', $data);

	}

	public function medReview(){
		$this->load->model('EncDec');
		$med = $this->input->post('medId');
		$id = $this->EncDec->encrypt_decrypt('decrypt',$med);
		$this->MedicineModel->saveReview($id);
		redirect($this->input->post('url'));
	}

	public function searchMed()
	{
		$str = $this->input->post('query');
		$res = $this->MedicineModel->searchMed($str);

		echo json_encode($res);
	}

}

/* End of file Medicine.php */
