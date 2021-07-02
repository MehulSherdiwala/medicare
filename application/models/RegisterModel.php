<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class registerModel extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function addPatient($userdata){
		$this->db->insert('patient', $userdata);
		$pId = $this->db->insert_id();
		$wallet = array(
			'userTypeId' => 3,
			'userId' => $pId,
		);
		$this->db->insert('wallet', $wallet);
		return $pId;
	}
	public function addDoctor($userdata){
		$this->db->insert('doctor', $userdata);
		$docId = $this->db->insert_id();
		$wallet = array(
			'userTypeId' => 1,
			'userId' => $docId,
		);
		$this->db->insert('wallet', $wallet);
		return $docId;
	}
	public function addPharmacist($userdata){
		$this->db->insert('pharmacist', $userdata);
		$pharId = $this->db->insert_id();
		$wallet = array(
			'userTypeId' => 2,
			'userId' => $pharId,
		);
		$this->db->insert('wallet', $wallet);
		return $pharId;
	}

}

/* End of file registerModel.php */
