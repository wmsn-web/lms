<?php
class TestTree extends CI_controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$amount = 200;
		$usersid = "ESM-202020";
		

		$this->db->where("under_userid",$usersid);
		$get = $this->db->get("es_users");
		$row = $get->row();
		$userid = $row->user_id;
		$side = $row->side;
		$temp_userid = $userid;
		$res = $get->result();
		/*
		foreach ($res as $key) {
			$this->db->where("under_userid",$key->user_id);
			$getNext = $this->db->get("es_users");
			$nxtData = [];
			$getRes = $getNext->result();
			$lastStep = [];
			foreach ($getRes as $keyNext) {
				$this->db->where("under_userid",$keyNext->user_id);
				$spt2 = $this->db->get("es_users")->result();
				foreach ($spt2 as $keystp2) {
					$lastStep[] = array("name"=>$keystp2->name);
				}
				$nxtData[] = array("name"=>$keyNext->name,"data"=>$lastStep);
			}

			$data[] = array("name"=>$key->name,"data"=>$nxtData);
		}

		echo "<pre>";
		print_r($data);
		*/

		$x = 1;
 
while($x >0) {
  if ($x == 2) {
    break;
  }
  echo "The number is: $x <br>";
  $x++;
} 
		
	}

	
}