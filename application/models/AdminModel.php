<?php
/**
 * 
 */
class AdminModel extends CI_model
{
	
	function getTree()
	{
		$query = $this->db->get("tree");
		$result = $query->result();

		$data = array();
		foreach ($result as $key) {
			$userid = $key->userid;
			$left = $key->left;
			$right = $key->right;
			$three = $key->three;
			$fourth = $key->fourth;
			$fifth = $key->fifth;

			$leftcount = $key->leftcount;
			$rightcount = $key->rightcount;
			$threecount = $key->threecount;
			$fourthcount = $key->fourthcount;
			$fifthcount = $key->fifthcount;

			$this->db->where("user_id",$userid);
			$q = $this->db->get("user");
			$row = $q->row();

			$total = $leftcount+$rightcount+$threecount+$fourthcount+$fifthcount;

			$data[]= array
				(
					"userid"=>$userid,
					"total"=>$total,
					"name"=>$row->name,
					"email"=>$row->email,
					"mobile"=>$row->mobile,
					"position"=>$row->side,
					"under"=>$row->under_userid
				);
		}

		return $data;
	}

	public function getUnders($under)
	{
		$this->db->where("userid",$under);
		$get = $this->db->get("tree");
		return $get;
	}
}