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
			$q = $this->db->get("es_users");
			$row = $q->row();

			$total = $leftcount+$rightcount+$threecount+$fourthcount+$fifthcount;

			$data[]= array
				(
					"userid"=>$userid,
					"total"=>$total,
					"name"=>$row->name,
					"email"=>$row->email,
					"mobile"=>$row->phone,
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

	public function getAllMembers()
	{
		$this->db->order_by("join_date","ASC");
		$this->db->where("user_id !=","ESM-202020");
		$get = $this->db->get("es_users");
		$result = $get->result();
		if($get->num_rows() == 0)
		{
			$data = array();
		}
		else
		{
			foreach ($result as $key) {
			$userId = $key->user_id;
			$this->db->where("userid",$userId);
			$query = $this->db->get("tree");
			$trRow = $query->row();
			$leftcount = $trRow->leftcount;
			$rightcount = $trRow->rightcount;
			$threecount = $trRow->threecount;
			$fourthcount = $trRow->fourthcount;
			$fifthcount = $trRow->fifthcount;
			$sixthcount = $trRow->sixthcount;
			$seventhcount = $trRow->seventhcount;
			$eighthcount = $trRow->eighthcount;
			$ninthcount = $trRow->ninthcount;
			$tenthcount = $trRow->tenthcount;
			$total = $leftcount+$rightcount+$threecount+$fourthcount+$fifthcount+$sixthcount+$seventhcount+$eighthcount+$ninthcount+$tenthcount;
			$income = $trRow->tot_amount;
				$data[] = array
								(
									"user_id"	=>$key->user_id,
									   "name"	=>$key->name,
									 "mobile"	=>$key->phone,
									  "under"	=>$key->under_userid,
									  "total"	=>$total,
									 "income"	=>$income,
									 "level"	=>$key->level,
									 "join_date"	=>$key->join_date
								);
			}
		}

		return $data;
	}

	public function submitBalance($userid,$amount,$notes)
	{
		$this->db->where("user_id",$userid);
		$get = $this->db->get("es_users");
		$row = $get->row();
		$userId = $row->user_id;
		$under_userid = $row->under_userid;
		$side = $row->side;
		$temp_under_userid = $under_userid;

		date_default_timezone_set('Asia/Kolkata');
			$date = date('Y-m-d');
			$dt = date_create($date);
			$monthyear = date_format($dt,"F")."-".date_format($dt,"Y");

			$UserLevel = $row->level;

			$this->db->where("level",$UserLevel);
			$gtSetting = $this->db->get("level_setup")->row();
			$spcb = @$gtSetting->spcb /100;
			$prcntSp = $amount*$spcb;

			$wlletdataSingle = array
						(
							"user_id"=>$userId,
							"notes" =>$notes,
							"deposit" =>$prcntSp,
							"tr_date"   =>date('d-m-Y H:i:s'),
							"yearmonth"=>$monthyear

						);
			$this->db->insert("user_wallet",$wlletdataSingle);

		$total_count=1;
		$i=1;

		$allTempUser = array();
		while($total_count>0){
			$i;
			$this->db->where("userid",$temp_under_userid);
			$get2 = $this->db->get("tree");
			$row2 = $get2->row();
			$current_temp_amount_count = $row2->tot_amount + $amount;
			$temp_under_userid;
			$temp_side_count;
			$this->db->where("userid",$temp_under_userid);
			$this->db->update("tree",["tot_amount"=>$current_temp_amount_count]);
			
			$datas = array
						(
							"user_id"=>$temp_under_userid,
							"notice" =>$notes,
							"amount" =>$amount,
							"date"   =>date('d-m-Y H:i:s'),
							"yearmonth"=>$monthyear

						);
			$this->db->insert("transaction_notice",$datas);

			$this->db->where("user_id",$temp_under_userid);
			$getlvl = $this->db->get("es_users")->row();
			$underUserLevel = $getlvl->level;

			$this->db->where("level",$underUserLevel);
			$gtSetting = $this->db->get("level_setup")->row();
			$tpcb = @$gtSetting->tpcb /100;
			$prcnt = $amount*$tpcb;
			$tpcbAmt = $amount+$prcnt;

			$wlletdatas = array
						(
							"user_id"=>$temp_under_userid,
							"notes" =>$notes,
							"deposit" =>$prcnt,
							"tr_date"   =>date('d-m-Y H:i:s'),
							"yearmonth"=>$monthyear

						);
			$this->db->insert("user_wallet",$wlletdatas);

			$allTempUser[] = array
									(
										"userid"=>$temp_under_userid,
										"deposit" =>$prcnt,
										"tr_date"   =>date('d-m-Y H:i:s'),
										"amount" =>$amount
									);

			$tree_data = $this->tree($temp_under_userid);
					$temp_left_count = $tree_data['leftcount'];
					$temp_right_count = $tree_data['rightcount'];

				$next_under_userid = $this->getUnderId($temp_under_userid);
				$temp_side = $this->getUnderIdPlace($temp_under_userid);
				$temp_side_count = $temp_side.'count';
				$temp_under_userid = $next_under_userid;	
				
				$i++;
				if($temp_under_userid==""){
				$total_count=0;
			}
		}

		$datas2 = array
						(
							"user_id"=>$userId,
							"notice" =>$notes,
							"amount" =>$amount,
							"date"   =>date('d-m-Y H:i:s'),
							"yearmonth"=>$monthyear

						);
			$this->db->insert("my_transaction",$datas2);

		return $allTempUser;
	}
	function checkUserId($userid)
{

$chech = $this->db->query("SELECT * FROM es_users WHERE user_id='$userid'");
	$num = $chech->num_rows();
	if($num>0)
	{
		return false;
	}
	else
	{
		return true;
	}
}
function emailCheck($email)
{
	
	$checkUserMail = $this->db->query("SELECT * FROM es_users WHERE email='$email'");
    $num = $checkUserMail->num_rows();
    if($num>0)
    {
    	return false;
    }
    else
    {
    	return true;
    }
    
}

function emailUnder($under_userid)
{
	global $con;
	$emailUnder =  $this->db->query("SELECT * FROM es_users WHERE user_id='$under_userid'");
    $num = $emailUnder->num_rows();
    if($num>0)
    {
    	return true;
    }
    else
    {
    	return false;
    }
    
}

function tree($userid){
	//global $con;
	$data = array();
	$query = $this->db->query("SELECT * from tree WHERE userid='$userid'");
	$result = $query->row();
	$data['left'] = $result->left;
	$data['right'] = $result->right;
	$data['three'] = $result->three;
	$data['fourth'] = $result->fourth;
	$data['fifth'] = $result->fifth;


	$data['leftcount'] = $result->leftcount;
	$data['rightcount'] = $result->rightcount;
	$data['threecount'] = $result->threecount;
	$data['fourthcount'] = $result->fourthcount;
	$data['fifthcount'] = $result->fifthcount;
	
	return $data;
}
function getUnderId($userid){
	global $con;
	$query = $this->db->query("SELECT * FROM es_users WHERE user_id='$userid'");
	$result = $query->row();
	return $result->under_userid;
}
function getUnderIdPlace($userid){
	global $con;
	$query = $this->db->query("SELECT * FROM es_users WHERE user_id='$userid'");
	$result = $query->row();
	return $result->side;
}

function side_check($under_userid,$side){
	
	
	$query =$this->db->query("select * from tree where userid='$under_userid'");
	$result = $query->row();
	$side_value = $result->$side;
	if($side_value==''){
		return true;
	}
	else{
		return false;
	}
}

	public function GetUserById($userId)
	{
		$this->db->where("user_id",$userId);
		$getUser = $this->db->get("es_users");
		if($getUser->num_rows()==0)
		{
			$data = array();
		}
		else
		{
			$rows = $getUser->row();
			$data = array
						(
							"name"		=>$rows->name,
							"email"		=>$rows->email,
							"phone"		=>$rows->phone,
							"address"	=>$rows->address,
							"father"	=>$rows->father_name,
							"dob"		=>$rows->dob,
							"gender"	=>$rows->gender,
							"side"		=>$rows->side,
							"memType"	=>$rows->mem_type,
							"bank"		=>$rows->bank,
							"ifsc"		=>$rows->ifsc,
							"ac_no"		=>$rows->ac_no,
							"userId"	=>$rows->user_id,
							"level"		=>$rows->level
						);
		}

		return $data;
	}

	public function checkChangeLevel()
	{
		date_default_timezone_set('Asia/Kolkata');
		$date = date('Y-m-d');
		$set = $this->db->get("settings")->row();
		$duration = $set->level_chng_duration;
		$GT = $this->db->query("SELECT * FROM  es_users where last_update < now() - INTERVAL $duration DAY");
		$row = $GT->result();

		foreach ($row as $key) {
			$level = $key->level;
			$nowLvl = $level+1;

			$mem_type = $key->mem_type;
			
			$this->db->query("UPDATE  `es_users` SET `level`='$nowLvl',`last_update`='$date' WHERE `last_update` < now() - INTERVAL $duration DAY AND `mem_type` = 'Package'");
			
		}

	}
}