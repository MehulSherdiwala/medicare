<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DiseaseModel extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function addDisease($disData, $syData){
		$this->db->insert('disease', $disData);
		echo $disId = $this->db->insert_id();
		
		if ($disId != 0 ){
			foreach ($syData as $sy_datum)
			{
				$sy = array(
					"description" => $sy_datum,
					"disId" => $disId,
					"createdAt" => date('Y-m-d H:i:s', now('Asia/Kolkata')),
				);
				$this->db->insert('symptoms', $sy);
				reset($sy);
			}
		}
	}

	public function editDisease($disId,$disData, $syData){
		$this->db->where('disId', $disId);
		$this->db->update('disease', $disData);

		$this->db->where('disId', $disId);
		$this->db->delete('symptoms');

		foreach ($syData as $sy_datum)
		{
			$sy = array(
				"description" => $sy_datum,
				"disId" => $disId,
				"createdAt" => date('Y-m-d H:i:s', now('Asia/Kolkata')),
			);
			$this->db->insert('symptoms', $sy);
			reset($sy);
		}
	}

	public function fetchDisease($disId){
		$disease = array();
		if ($disId != 0){
			$this->db->where('disId', $disId);
			$query = $this->db->get('disease');
			$row = $query->row();
			$this->db->where('disId', $disId);
			$sy = $this->db->get('symptoms');
			$syDesc = array();
			foreach ($sy->result() as $syrow) {
				array_push($syDesc, $syrow->description);
			}
			$disease = array(
				"disId" => $row->disId,
				"disName" => $row->disName,
				"description" => $row->description,
				"syDesc" => $syDesc
			);
		}  else {
			$this->load->helper('text');
			$this->db->where('deleted', 0);
			$query = $this->db->get('disease');

			foreach ($query->result() as $row) {
				$this->db->where('disId', $row->disId);
				$sy = $this->db->get('symptoms');
				$syDesc = array();
				foreach ($sy->result() as $syrow) {
					array_push($syDesc, $syrow->description);
				}
				$disease[] = array(
					"disId" => $row->disId,
					"disName" => $row->disName,
					"description" => word_limiter($row->description , 5, '...'),
					"syDesc" => implode(',', $syDesc)
				);
			}
		}

		return $disease;
	}

	public function deleteDisease($disId){
		$disData = array(
			"deleted" => 1,
			"deletedAt" => date('Y-m-d H:i:s', now('Asia/Kolkata')),
		);
		$this->db->where('disId', $disId);
		$this->db->update('disease', $disData);
	}

	function count_all($str)
	{
		$query = $this->db->where('deleted',0)->like('disName',$str)->get("disease");
		return $query->num_rows();
	}

	function fetch_details($limit, $start,$string)
	{
		$this->load->helper('text');
		$this->load->model('EncDec');
		$output = '';
		$this->db->select("disId,disName,description");
		$this->db->from("disease");
		$this->db->where('deleted', 0);
		$this->db->like('disName', $string);
		$this->db->order_by("disName", "ASC");
		$this->db->limit($limit, $start);
		$query = $this->db->get();

		foreach ($query->result() as $row)
		{
			$output .= '
					<div class=" col col-md-4 mt-4">
						<a href="'. base_url() .'disease/'.str_replace(" ", "-", "$row->disName").'.html?_='.$this->EncDec->encrypt_decrypt('encrypt',$row->disId).'">
							<div class="disease-info">
								<h4 class="text-center">'. $row->disName .'</h4>
								<hr>
								<p class="text-justify">'.  word_limiter($row->description, 20, '...') .'</p>
							</div>
						</a>
					</div>
					';
		}
		return $output;
	}

	public function fetchDiseaseDoc($disId)
	{
		$this->load->model('EncDec');

		$query = $this->db->query("SELECT d.username,d.docId,d.specialization,d.profileImg,c.cityName,s.stateName FROM `doctor` `d` JOIN `city` `c` ON `d`.`cityId` = `c`.`cityId` JOIN `state` `s` ON `c`.`stateId` = `s`.`stateId` WHERE specialization like concat('%',(select disName from disease where disId=$disId),'%') and status > 0");

		$res = array();
		foreach ($query->result() as $row)
		{
			$queryCnt = $this->db->where('userId', $row->docId)
				->where('userType', 1)
				->order_by('datetime', 'desc')
				->get('rating');
			$res[] = array(
				'username' => $row->username,
				'profileImg' => $row->profileImg,
				'specialization' => $row->specialization,
				'stateName' => $row->stateName,
				'cityName' => $row->cityName,
				'cnt' => $queryCnt->num_rows(),
				'rating' => $this->avgRating($row->docId),
				'docId' => $this->EncDec->encrypt_decrypt('encrypt', $row->docId),
			);
		}

		return $res;
	}

	function avgRating($docId){
		$row = $this->db->select_avg('rates','rates')
			->where('userType', 1)
			->where('userId', $docId)
			->get('rating')->row();

		return floor($row->rates);
	}

	function searchDis($str)
	{
		$this->db->select("disName");
		$this->db->from("disease");
		$this->db->where('deleted', 0);
		$this->db->like('disName', $str);
		$query = $this->db->get();

		$res = array();
		foreach ($query->result() as $row)
		{
			$res[] = array(
				'disName' => $row->disName
			);
		}

		return $res;
	}
}

/* End of file DiseaseModel.php */
