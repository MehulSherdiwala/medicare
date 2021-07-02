<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class stateCityModel extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function fetchState(){
		$query = $this->db->get('state');
		foreach ($query->result() as $row)
		{
			$state[] = array(
				'stateId' => $row->stateId,
				'stateName' => $row->stateName
			);
		}
		return $state;
	}

	public function fetchCity($id){
		$this->db->where('stateId', $id);
		$query = $this->db->get('city');

		foreach ($query->result() as $row)
		{
			$state[] = array(
				'cityId' => $row->cityId,
				'cityName' => $row->cityName
			);
		}

		return $state;
	}

	public function fetchStateCity($cityId){
		$row = $this->db->where('cityId', $cityId)
					->join('state','state.stateId=city.stateId')
					->get('city')->row();

		$res = array(
			'cityName' => $row->cityName,
			'stateName' => $row->stateName,
		);

		return $res;
	}

	public function fetchStateList()
	{
		$query = $this->db->get('state');

		$res = array();

		foreach ($query->result() as $row)
		{
			$rowCity = $this->db->query('select count(*) as total from city where stateId='.$row->stateId)->row();
			$res[] = array(
				'stateId' => $row->stateId,
				'stateName' => $row->stateName,
				'totalCity' => $rowCity->total,
			);
		}

		return $res;
	}

	public function fetchStateDetail($id)
	{
		$row = $this->db->where('stateId', $id)->get('state')->row();

		return array(
			'stateId' => $row->stateId,
			'stateName' => $row->stateName
		);
	}

	public function updateState()
	{
		$stateId = $this->input->post('stateId');
		$stateName = $this->input->post('stateName');

		$this->db->set('stateName', $stateName);
		$this->db->where('stateId', $stateId);
		$this->db->update('state');
	}

	public function addState()
	{
		$stateName = $this->input->post('stateName');
		$data = array(
			'stateName' => $stateName
		);

		$this->db->insert('state', $data);
	}

	public function fetchCityList()
	{
		$query = $this->db->join('city c','c.stateId=s.stateId')->get('state s');

		$res = array();

		foreach ($query->result() as $row)
		{
			$res[] = array(
				'cityId' => $row->cityId,
				'cityName' => $row->cityName,
				'stateName' => $row->stateName,
			);
		}

		return $res;
	}

	public function fetchCityDetail($id)
	{
		$row = $this->db->where('cityId', $id)->join('city c','c.stateId=s.stateId')->get('state s')->row();

		return array(
			'cityId' => $row->cityId,
			'cityName' => $row->cityName,
			'stateId' => $row->stateId
		);
	}

	public function updateCity()
	{
		$stateId = $this->input->post('stateId');
		$cityId = $this->input->post('cityId');
		$cityName = $this->input->post('cityName');

		$this->db->set('stateId', $stateId);
		$this->db->set('cityName', $cityName);
		$this->db->where('cityId', $cityId);
		$this->db->update('city');
	}

	public function addCity()
	{
		$cityName = $this->input->post('cityName');
		$stateId = $this->input->post('stateId');
		$data = array(
			'stateId' => $stateId,
			'cityName' => $cityName
		);

		$this->db->insert('city', $data);
	}

}

/* End of file stateCityModel.php */
