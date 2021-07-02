<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NotiModel extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function fetch_noti($id,$userType){
		$this->db->where('userTypeId', $userType);
		$this->db->where('visitorId', $id);
		$this->db->where('deleted', 0);
		$query = $this->db->get('notification');
		$unseen_notification = 0;
		$now = time();
		$res = '';
		foreach ($query->result() as $row)
		{
			if ($row->status == 0){
				$unseen_notification++;
			}
			$post_date = strtotime($row->datetime);
			if ($row->msg == "Change Medicine Details")
			{
				$this->db->select('permission');
				$this->db->where('mupId', $row->id);
				$row2 = $this->db->get('medicine_update_permission')->row();

				if ($row2->permission > 0)
				{
					$this->db->set('deleted', 1);
					$this->db->where('notiId', $row->notiId);
					$this->db->update('notification');
				}
				else
				{
					$res .= '<li>
						<a href="' . base_url() . 'pharmacist/medicine/change/' . $row->id . '">
							<span class="icon icofont-edit"></span>
							<div class="content">
								<span class="desc">' . $row->msg . '</span>
								<span class="date">' . timespan($post_date, $now) . ' ago </span>
							</div>
						</a>
					</li>';
				}
			} elseif ($row->msg == "Changes Rejected")
			{
				$this->db->select('username');
				$this->db->where('pharId', $row->id);
				$row2 = $this->db->get('pharmacist')->row();

//				if ($row2->permission > 0)
//				{
//					$this->db->set('deleted', 1);
//					$this->db->where('notiId', $row->notiId);
//					$this->db->update('notification');
//				}
//				else
//				{
					$res .= '<li>
						<a href="javascript:void(0)">
							<span class="icon icofont-info-circle"></span>
							<div class="content">
								<span class="desc">Changes in Medicine Details are rejected by ' . $row2->username . '</span>
								<span class="date">' . timespan($post_date, $now) . ' ago </span>
							</div>
						</a>
					</li>';
//				}
			}

		}
		return array(
			'unseen_notification' => $unseen_notification,
			'notification' => $res,
		);

	}

	public function viewed_noti($id,$userType){

		$this->db->set('status', 1);
		$this->db->where('userTypeId', $userType);
		$this->db->where('visitorId', $id);
		$this->db->update('notification');
	}

}

/* End of file NotiModel.php */
