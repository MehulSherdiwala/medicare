<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MedicineModel extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function fetchMST(){
		$query = $this->db->get('medicine_storage_type');

		foreach ($query->result() as $row)
		{
			$MST [] = array(
				'mstId' => $row->mstId,
				'mstType' => $row->mstType,
			);
		}
		return $MST;
	}

	public function fetchDose(){
		$query = $this->db->get('medicine_dose');

		foreach ($query->result() as $row)
		{
			$MST [] = array(
				'doseId' => $row->doseId,
				'doseUnit' => $row->doseUnit,
			);
		}
		return $MST;
	}

	public function fetchUnit($id){
		$this->db->where('mstId', $id);
		$query = $this->db->get('medicine_storage_unit');

		foreach ($query->result() as $row)
		{
			$MST [] = array(
				'msuId' => $row->msuId,
				'unit' => $row->unit,
			);
		}
		return $MST;
	}

	public function addMedicine($disData,$pharMedData){
		$query = $this->db->query('select medId, SUM(CASE when deleted = 1 then 1 else 0 end ) as medDeleted , if(@res := ((select SUM(CASE when deleted = 1 then pwmId else -1 end ) from pharmacist_wise_medicine where medId = medicine.medId and pharId = '.$pharMedData['pharId'].')),@res,"n") as pwm from medicine where medName = "'.$disData['medName'].'"');
		$row = $query->row();
		if (!empty($row->medId)){
//			return $row->pwm;
			if ($row->medDeleted == 1){
				$this->db->where('medId', $row->medId);
				$this->db->set('deleted', 0);
				$this->db->update('medicine');
				if ($row->pwm > 0 && is_numeric($row->pwm))
				{
					$this->db->where('pwmId', $row->pwm);
					$this->db->set('deleted', 0);
					$this->db->update('pharmacist_wise_medicine');
				} else
				{
					$pharMedData['medId'] = $row->medId;
					$this->db->insert('pharmacist_wise_medicine', $pharMedData);
				}
			}
			elseif ($row->pwm > 0 && is_numeric($row->pwm))
			{
				$this->db->where('pwmId', $row->pwm);
				$this->db->set('deleted', 0);
				$this->db->update('pharmacist_wise_medicine');
			}
			elseif ($row->pwm == 'n')
			{
				$pharMedData['medId'] = $row->medId;
				$this->db->insert('pharmacist_wise_medicine', $pharMedData);
			}
			elseif($row->pwm == -1)
			{
				return 1;
			}
		} else {
			$img = array();
			if ($_FILES['files']['name'] != ''){
				$ran = rand(1000,9999);
				$config['upload_path']= './medicineImg';
				$config['allowed_types']='gif|jpg|png';
				$this->load->library('upload',$config);
				for ($i = 0;$i < count($_FILES['files']['name']);$i++){
					$_FILES['file']['name'] = $ran. '_' .$_FILES['files']['name'][$i];
					$_FILES['file']['type'] = $_FILES['files']['type'][$i];
					$_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
					$_FILES['file']['error'] = $_FILES['files']['error'][$i];
					$_FILES['file']['size'] = $_FILES['files']['size'][$i];
					if($this->upload->do_upload('file')){
						$data = array('upload_data' => $this->upload->data());
						$img[] = $data['upload_data']['file_name'];
					} else {
						print_r($this->upload->display_errors());
					}
				}
			}
			$disData['image'] = implode(',',$img);
			$this->db->insert('medicine', $disData);
			$pharMedData['medId'] = $this->db->insert_id();
			$this->db->insert('pharmacist_wise_medicine', $pharMedData);
		}
//		echo 'select medId, SUM(CASE when deleted = 1 then 1 else 0 end ) as medDeleted , (select SUM(CASE when deleted = 1 then 0 else pwmId end ) from pharmacist_wise_medicine where medId = medicine.medId and pharId = '.$pharMedData['pharId'].') as pwm from medicine where medName = "'.$disData['medName'].'"';
	}

	public function editMedicine($pwmId,$medData){
		$this->db->where('pwmId', $pwmId);
		$this->db->update('pharmacist_wise_medicine', $medData);

	}

	public function fetchMedicine($pwmId , $flag=0){
		if ($pwmId != 0){
//			$query = $this->db->query("SELECT *, (select disName from disease where disId= m.disId) as disName FROM `medicine` `m`, `pharmacist_wise_medicine` `p` WHERE m.medId = p.medId AND m.medId = $medId");

			if ($flag == 0) {
				$query = $this->db->query("SELECT m.medId,m.medName,m.medDescription,capacity,price,dose,pwmId, disId,msuId,doseId,m.image, (select mstId from  medicine_storage_unit where msuId = p.msuId) as mstId FROM `medicine` `m`, `pharmacist_wise_medicine` `p` WHERE m.medId = p.medId AND p.pwmId = ".$pwmId);
				$row = $query->row();
				$medicine = array(
					"medId" => $row->medId,
					"image" => (($row->image=='')? 'medicine2.png':$row->image),
					"medName" => $row->medName,
					"medDescription" => $row->medDescription,
					"price" => $row->price,
					"dose" => $row->dose,
					"doseId" => $row->doseId,
					"capacity" => $row->capacity,
					"msuId" => $row->msuId,
					"mstId" => $row->mstId,
					"disId" => $row->disId,
					"pwmId" => $row->pwmId,
				);
			} else {
				$query = $this->db->query("SELECT m.medId,m.medName,m.medDescription,m.image,pwmId,capacity,price,dose,pharId, (select disName from disease where disId= m.disId) as disName,(select unit from medicine_storage_unit where msuId = p.msuId) as unit,(select doseUnit from medicine_dose where doseId = p.doseId) as doseUnit,(select username from pharmacist where pharId = p.pharId) as pharName, (select mstType from medicine_storage_type inner join medicine_storage_unit msu on medicine_storage_type.mstId = msu.mstId where msuId = p.msuId) as type FROM `medicine` `m`, `pharmacist_wise_medicine` `p` WHERE m.medId = p.medId AND p.pwmId = ".$pwmId);
				$row = $query->row();
				$medicine = array(
					"medId" => $row->medId,
					"image" => (($row->image=='')? 'medicine.png':$row->image),
					"pwmId" => $row->pwmId,
					"medName" => $row->medName,
					"medDescription" => $row->medDescription,
					"price" => $row->price,
					"pharName" => $row->pharName,
					"pharId" => $row->pharId,
					"dose" => $row->dose.' '.$row->doseUnit,
					"capacity" => $row->capacity.' '.$row->unit.' in '.$row->type,
					"disName" => ($row->disName == null) ? '' :$row->disName,
				);
			}
		} else {
			$this->load->helper('text');
			$pharId = $this->session->userdata('uId');
//			$this->db->where('deleted', 0);
//			$this->db->where('pharId', $pharId);
//			$this->db->where('m.medId', 'p.medId');
//			$this->db->select('*,(select disName from disease where disId= m.disId) as disName');
//			$query = $this->db->get('medicine m, pharmacist_wise_medicine p');
			$query = $this->db->query("SELECT m.medId,m.medName,m.medDescription,m.image,capacity,price,dose,pwmId, (select disName from disease where disId= m.disId) as disName,(select unit from medicine_storage_unit where msuId = p.msuId) as unit,(select doseUnit from medicine_dose where doseId = p.doseId) as doseUnit, (select mstType from medicine_storage_type inner join medicine_storage_unit msu on medicine_storage_type.mstId = msu.mstId where msuId = p.msuId) as type FROM `medicine` `m`, `pharmacist_wise_medicine` `p` WHERE p.deleted = 0 AND p.pharId = $pharId AND m.medId = p.medId");

			$medicine = array();
			foreach ($query->result() as $row) {
				$medicine[] = array(
					"medId" => $row->medId,
					"image" => (($row->image=='')? 'medicine.png':$row->image),
					"medName" => $row->medName,
					"medDescription" => word_limiter($row->medDescription , 5, '...'),
					"price" => $row->price,
					"dose" => $row->dose.' '.$row->doseUnit,
					"capacity" => $row->capacity.' '.$row->unit.' in '.$row->type,
					"disName" => ($row->disName == null) ? '' :$row->disName,
					"pwmId" => $row->pwmId,
				);
			}
		}

		return $medicine;
	}

	public function deleteMedicine($medId){
		$Data = array(
			"deleted" => 1,
			"deletedAt" => date('Y-m-d H:i:s', now('Asia/Kolkata')),
		);
		$query = $this->db->query('select (select count(pwmId) from pharmacist_wise_medicine where medId=medicine.medId and deleted = 0) as totalMed from medicine where medId='.$medId);
		$row = $query->row();
		if($row->totalMed == 1){
			$this->db->where('medId', $medId);
			$this->db->update('medicine', $Data);

			$this->db->where('medId', $medId);
			$this->db->where('deleted', 0);
			$this->db->update('pharmacist_wise_medicine', $Data);

		} else {
			$uId = $this->session->userdata('uId');
			$this->db->where('medId', $medId);
			$this->db->where('deleted', 0);
			$this->db->where('pharId', $uId);
			$this->db->update('pharmacist_wise_medicine', $Data);
		}
	}

	public function fetchDisease(){
		$query = $this->db->get('disease');
		$disease = array();
		foreach ($query->result() as $row) {
			$disease[] = array(
				"disId" => $row->disId,
				"disName" => $row->disName,
			);
		}
		return $disease;
	}

	function count_all($string)
	{
		$query = $this->db->where('m.deleted',0)
			->where('pwm.deleted',0)
			->where('p.dptId', 4)
			->like('medName',$string)
			->join('pharmacist_wise_medicine pwm','pwm.medId=m.medId')
			->join('pharmacist p','pwm.pharId=p.pharId')
			->get("medicine m");
		return $query->num_rows();
	}

	function fetch_details($limit, $start,$string)
	{
		$this->load->helper('text');
		$this->load->model('EncDec');
		$string = str_replace("%20", " ", $string);
		$output = '';
//		$this->db->select("*");
		$this->db->select("pwmId,medName,medDescription,capacity,unit,mstType,price,dose,doseUnit,image");
		$this->db->from("medicine");
		$this->db->join('pharmacist_wise_medicine','medicine.medId=pharmacist_wise_medicine.medId');
		$this->db->join('medicine_storage_unit','pharmacist_wise_medicine.msuId=medicine_storage_unit.msuId');
		$this->db->join('medicine_storage_type','medicine_storage_unit.mstId=medicine_storage_type.mstId');
		$this->db->join('medicine_dose','medicine_dose.doseId = pharmacist_wise_medicine.doseId');
		$this->db->join('pharmacist','pharmacist_wise_medicine.pharId=pharmacist.pharId');
		$this->db->where('medicine.deleted', 0);
		$this->db->like('medicine.medName', $string);
		$this->db->where('pharmacist.dptId', 4);
		$this->db->where('pharmacist_wise_medicine.deleted', 0);
		$this->db->order_by("medName", "ASC");
		$this->db->limit($limit, $start);
		$query = $this->db->get();
			foreach ($query->result() as $row)
			{
				$str = $row->medName.' '.$row->dose.$row->doseUnit;
				$len = strlen($str);
				if ($len > 17)
				{
					$pos = strpos($str, ' ', 17);
					if ($pos != '')
					{
						$str = substr($str, 0, $pos) . '...';
					}
					$len = strlen($str);

					if ($len > 20){
						$word = str_word_count($str) - 1;
						$str = word_limiter($str, (($word==0)? 1 : $word), '...');
					}
				}
				$img = explode(',',$row->image);
				$output .= '
					<div class="product-box product-wrap col col-md-3 ml-2 my-4">
							<div class="img-wrapper">
								<div class="front">
									<a href="'. base_url() .'medicine/'.str_replace(" ", "-", "$row->medName $row->dose $row->doseUnit").'.html?_='.$this->EncDec->encrypt_decrypt('encrypt',$row->pwmId).'"><img alt="" src="'. base_url() .'medicineImg/'. (($img[0]=="") ? 'medicine.png' : $img[0]) .'" class="img-fluid bg-img" ></a>
								</div>
								<div class="cart-info cart-wrap">
									<button  title="Add to cart" onclick="addToCart(\''.$this->EncDec->encrypt_decrypt('encrypt',$row->pwmId).'\')" class="addToCart"><i class="ti-shopping-cart"></i> Add to cart</button>
								</div>
							</div>
							<div class="product-info">
								<a href="'. base_url() .'medicine/'.str_replace(" ", "-", "$row->medName $row->dose $row->doseUnit").'.html?_='.$this->EncDec->encrypt_decrypt('encrypt',$row->pwmId).'" title="'. $row->medName.' '.$row->dose.$row->doseUnit .'" data-toggle="tooltip" data-placement="bottom" ><h5>'.$str.'</h5></a>
								<h6>'.$row->capacity.' '.$row->unit.' '.$row->mstType.'</h6>
								<h4><i class="fas fa-rupee-sign"></i> '.$row->price.'</h4>
							</div>
						</div>
					';
			}
		return $output;
	}

	public function fetchMed($query,$flag){
		if (!empty($query)){
			if ($flag == 0)
			{
				$this->db->like('medName', $query);
			} else{
				$this->db->where('medName', $query);
			}
		}
		$query = $this->db->get('medicine');
		$data = array();
		foreach ($query->result() as $row)
		{
			$data[] = array(
				'medName' => $row->medName,
				'medDesc' => $row->medDescription,
			);
		}
		return $data;
	}

	public function fetchMedName($medId){
		$data = array();
		if ($medId == 0)
		{
			$pharId = $this->session->userdata('uId');
			$this->db->select('medName,medicine.medId');
			$this->db->from('medicine');
			$this->db->join('pharmacist_wise_medicine', 'pharmacist_wise_medicine.medId = medicine.medId');
			$this->db->where('pharId', $pharId);
			$query = $this->db->get();
			foreach ($query->result() as $row)
			{
				$data[] = array(
					'medId' => $row->medId,
					'medName' => $row->medName,
				);
			}
		} else {
			$this->db->select('medName,medDescription,disId');
			$this->db->from('medicine');
			$this->db->where('medId', $medId);
			$query = $this->db->get();
			foreach ($query->result() as $row)
			{
				$data = array(
					'medDesc' => $row->medDescription,
					'medName' => $row->medName,
					'disId' => $row->disId,
				);
			}
		}
		return $data;
	}

	public function updateMedDetails($data)	{
		$query = $this->db->query('select count(medicine.medId) as count from medicine inner join pharmacist_wise_medicine on medicine.medId=pharmacist_wise_medicine.medId where medicine.medId='.$data['medId']);
		$row = $query->row();
		
		if ($row->count == 1){
			$data['status'] = 1;
			$this->db->insert('medicine_update_details', $data);

			$upArr = array(
				'medName' => $data['updatedMedName'],
				'medDescription' => $data['updatedMedDescription'],
				'disId' => $data['updatedDisId'],
				'updatedBy' => $data['updatedBy'],
				'updatedAt' => date('Y-m-d H:i:s', now('Asia/Kolkata')),
			);

			$this->db->select('medName,medDescription,disId');
			$this->db->where('medId', $data['medId']);
			$query = $this->db->get('medicine');
			$row = $query->row();

			if ($data['updatedMedName'] == '' ){
				$upArr['medName'] = $row->medName;
			}
			if ($data['updatedMedDescription'] == '' ){
				$upArr['medDescription'] = $row->medDescription;
			}
			if ($data['updatedDisId'] == 0 ){
				$upArr['disId'] = $row->disId;
			}

			$this->db->where('medId', $data['medId']);
			$this->db->update('medicine', $upArr);

			$this->db->select('mudId');
			$this->db->where('medId', $data['medId']);
			$this->db->where('type', 0);
			$query2 = $this->db->get('medicine_update_details');

			if ($query2->num_rows() == 0){
				$data['type'] = 0;
				$data['updatedMedName'] = $row->medName;
				$data['updatedMedDescription'] = $row->medDescription;
				$data['updatedDisId'] = $row->disId;

				$this->db->insert('medicine_update_details', $data);
			}

		} else {
			$this->db->insert('medicine_update_details', $data);
			$mudId = $this->db->insert_id();

			$query = $this->db->query('select pharId from pharmacist_wise_medicine where medId='.$data['medId'].' and  pharId!='.$data['updatedBy']);

			foreach ($query->result() as $row)
			{
				$upArr = array(
					'pharId' => $row->pharId,
					'mudId' => $mudId
				);
				$this->db->insert('medicine_update_permission', $upArr);
				$mupId = $this->db->insert_id();

				$noti = array(
					'userTypeId' => $this->session->userdata('userType'),
					'visitorId' => $row->pharId,
					'msg' => 'Change Medicine Details',
					'id' => $mupId,
					'datetime' => date('Y-m-d H:i:s', now('Asia/Kolkata'))
				);
				$this->db->insert('notification', $noti);
			}
		}

	}

	public function permission($type,$id){
		if ($type == 1){
			$this->db->select('medicine_update_details.updatedMedName,medicine_update_details.updatedMedDescription,medicine_update_details.updatedDisId,medicine.medName,medicine.medDescription,(select disName from disease where disId = medicine.disId) as disName,(select disName from disease where disId = medicine_update_details.updatedDisId) as updatedDisName');
			$this->db->from('medicine_update_permission');
			$this->db->join('medicine_update_details', 'medicine_update_details.mudId = medicine_update_permission.mudId');
			$this->db->join('medicine', 'medicine.medId = medicine_update_details.medId');
			$this->db->where('medicine_update_permission.mupId', $id);
			return $this->db->get()->row();
		} else {
			$permission = $this->input->post('permission');
			$perdata = array(
				'permission' => $permission,
				'permissionDateTime' => date('Y-m-d H:i:s', now('Asia/Kolkata'))
			);
			$this->db->where('mupId', $id);
			$this->db->update('medicine_update_permission', $perdata);

			$this->db->select('mudId');
			$this->db->where('mupId', $id);
			$rowPer = $this->db->get('medicine_update_permission')->row();
			if ($permission != 2)
			{
				$query = $this->db->query('SELECT permission,mudId FROM medicine_update_permission where mudId = (select mudId from medicine_update_permission where mupId = ' . $id . ')');
				$result = 0;
				foreach ($query->result() as $row)
				{
//				print_r($row);
					if ($row->permission == 0 || $row->permission == 2)
					{
						$result = 2;
					} else
					{
						if ($row->permission == 1 && $result != 2)
						{
							$result = 1;
						}
					}
				}
				echo $result;
				if ($result == 1)
				{
					$this->db->select('updatedMedName,updatedMedDescription,updatedDisId,updatedBy,medId');
					$this->db->where('mudId', $rowPer->mudId);
					$query = $this->db->get('medicine_update_details');
					$row = $query->row();
					print_r($row);

					$upArr = array(
						'medName' => $row->updatedMedName,
						'medDescription' => $row->updatedMedDescription,
						'disId' => $row->updatedDisId,
						'updatedBy' => $row->updatedBy,
						'updatedAt' => date('Y-m-d H:i:s', now('Asia/Kolkata')),
					);

					$this->db->select('medName,medDescription,disId');
					$this->db->where('medId', $row->medId);
					$query2 = $this->db->get('medicine');
					$row2 = $query2->row();

					if ($upArr['medName'] == '' ){
						$upArr['medName'] = $row2->medName;
					}
					if ($upArr['medDescription'] == '' ){
						$upArr['medDescription'] = $row2->medDescription;
					}
					if ($upArr['disId'] == 0 ){
						$upArr['disId'] = $row2->disId;
					}
//					print_r($upArr);
					echo $row->medId;

					$this->db->where('medId', $row->medId);
					echo $this->db->update('medicine', $upArr);

					$this->db->set('status', 1);
					$this->db->where('mudId', $rowPer->mudId);
					$this->db->update('medicine_update_details');

					$this->db->select('mudId');
					$this->db->where('medId', $row->medId);
					$this->db->where('type', 0);
					$query2 = $this->db->get('medicine_update_details');

					if ($query2->num_rows() == 0){
						$data['type'] = 0;
						$data['updatedMedName'] = $row2->medName;
						$data['updatedMedDescription'] = $row2->medDescription;
						$data['updatedDisId'] = $row2->disId;
						$data['updatedBy'] = $row->updatedBy;
						$data['createdAt'] = date('Y-m-d H:i:s', now('Asia/Kolkata'));

						$this->db->insert('medicine_update_details', $data);
					}
				}
			} elseif ($permission == 2){
				$this->db->select('updatedBy');
				$this->db->where('mudId', $rowPer->mudId);
				$row = $this->db->get('medicine_update_details')->row();
				$noti = array(
					'userTypeId' => $this->session->userdata('userType'),
					'visitorId' => $row->updatedBy,
					'msg' => 'Changes Rejected',
					'id' => $this->session->userdata('uId'),
					'datetime' => date('Y-m-d H:i:s', now('Asia/Kolkata'))
				);
				$this->db->insert('notification', $noti);

				$this->db->set('status', 2);
				$this->db->where('mudId', $rowPer->mudId);
				$this->db->update('medicine_update_details');
			}
		}
	}

	function fetchMedList(){
		$query = $this->db->query("SELECT m.medId,m.medName,m.medDescription,capacity,price,dose,pwmId, (select disName from disease where disId= m.disId) as disName,(select unit from medicine_storage_unit where msuId = p.msuId) as unit,(select doseUnit from medicine_dose where doseId = p.doseId) as doseUnit, (select mstType from medicine_storage_type inner join medicine_storage_unit msu on medicine_storage_type.mstId = msu.mstId where msuId = p.msuId) as type FROM `medicine` `m`, `pharmacist_wise_medicine` `p` WHERE p.deleted = 0  AND m.medId = p.medId");
		$medicine = array();

		foreach ($query->result() as $row) {
			$medicine[] = array(
				"medName" => $row->medName. ' ' .$row->dose.' '.$row->doseUnit,
				"pwmId" => $row->pwmId
			);
		}

		return $medicine;
	}

	function searchMed($str){
		$query = $this->db->like('medName', $str)->where('deleted',0)->get('medicine');

		$res = array();
		foreach ($query->result() as $row)
		{
			$res[] = array(
				'medName' => $row->medName
			);
		}

		return $res;
	}

	function checkReview($med,$pId){
		if (isset($_SESSION['userType']) && $_SESSION['userType']==3 )
		{
			if ($pId != 0)
			{
				$query = $this->db->select('om.pId')
					->where('om.pId', $pId)
					->where('pwm.pwmId', $med)
					->join('order_item oi', 'om.orderId=oi.orderId')
					->join('pharmacist_wise_medicine pwm', 'pwm.pwmId=oi.pwmId')
					->get('order_medicine om');

				if ($query->num_rows() > 0)
				{
					return 1;
				} else
				{
					return 0;
				}
			} else
			{
				return 0;
			}
		}
		return 0;
	}

	function saveReview($medId){
		$pId = $this->session->userdata('uId');

		$insData = array(
			'description' => $this->input->post('description'),
			'rates' => $this->input->post('rating'),
			'pId' => $pId,
			'pwmId' => $medId,
			'datetime' => date('Y-m-d H:i:s',now('Asia/Kolkata')),
		);

		$this->db->insert('medicine_rating', $insData );
	}

	function fetchReview($pwmId){
		$queryCnt = $this->db->where('pwmId', $pwmId)
			->order_by('datetime', 'desc')
			->get('medicine_rating');
		$cnt = $queryCnt->num_rows();

		$query = $this->db
			->select('rates,r.description,r.datetime,p.username,p.profileImg')
			->where('pwmId', $pwmId)
			->order_by('datetime', 'desc')
			->join('patient p', 'p.pId=r.pId')
			->get('medicine_rating r');

		$res = array();
		foreach ($query->result() as $row)
		{
			$post_date = strtotime($row->datetime);
			$now = date('Y-m-d',now('Asia/Kolkata'));

			$res[] = array(
				'rates' => $row->rates,
				'profileImg' => $row->profileImg,
				'description' => $row->description,
				'username' => $row->username,
				'datetime' => timespan($post_date, $now, 1),
			);
		}

		return array(
			'count' => $cnt,
			'rate' => $res,
		);
	}

	function avgRating($pwmId){
		$row = $this->db->select_avg('rates','rates')
			->where('pwmId', $pwmId)
			->get('medicine_rating')->row();

		return floor($row->rates);
	}

	public function fetchMedicinePdf()
	{
		$this->load->helper('text');
		$pharId = $this->session->userdata('uId');
		$time = $this->input->post('time_period');
		if (isset($time) && $time!='')
		{
			$dates = explode('/', $time);
			$query = $this->db->query("SELECT m.medId,m.medName,m.medDescription,m.image,p.createdAt,capacity,price,dose,pwmId, (select disName from disease where disId= m.disId) as disName,(select unit from medicine_storage_unit where msuId = p.msuId) as unit,(select doseUnit from medicine_dose where doseId = p.doseId) as doseUnit, (select mstType from medicine_storage_type inner join medicine_storage_unit msu on medicine_storage_type.mstId = msu.mstId where msuId = p.msuId) as type FROM `medicine` `m`, `pharmacist_wise_medicine` `p` WHERE p.deleted = 0 AND p.pharId = 1 AND m.medId = p.medId and  substr(p.createdAt,1,10) between '". date('Y-m-d',strtotime($dates[0])) ."' and '". date('Y-m-d',strtotime($dates[1])) ."'");
		} else
		{
			$query = $this->db->query("SELECT m.medId,m.medName,m.medDescription,m.image,p.createdAt,capacity,price,dose,pwmId, (select disName from disease where disId= m.disId) as disName,(select unit from medicine_storage_unit where msuId = p.msuId) as unit,(select doseUnit from medicine_dose where doseId = p.doseId) as doseUnit, (select mstType from medicine_storage_type inner join medicine_storage_unit msu on medicine_storage_type.mstId = msu.mstId where msuId = p.msuId) as type FROM `medicine` `m`, `pharmacist_wise_medicine` `p` WHERE p.deleted = 0 AND p.pharId = $pharId AND m.medId = p.medId");
		}

		$medicine = array();
		foreach ($query->result() as $row) {
			$medicine[] = array(
				'createdAt' => date('d M Y',strtotime($row->createdAt)),
				'medName' => $row->medName,
				'medDescription' => word_limiter($row->medDescription , 5, '...'),
				'price' => $row->price,
				'dose' => $row->dose.' '.$row->doseUnit,
				'capacity' => $row->capacity.' '.$row->unit.' in '.$row->type,
				'disName' => ($row->disName == null) ? '' :$row->disName,
				'pwmId' => $row->pwmId,
			);
		}
		return $medicine;
	}

}

/* End of file MedicineModel.php */
