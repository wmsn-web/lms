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
		$this->db->order_by("id","ASC");
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

	public function purchaseFromwallet($userid,$amount,$notes,$purchase_id)
	{
		date_default_timezone_set('Asia/Kolkata');
			$date = date('Y-m-d');
			$dt = date_create($date);
			$monthyear = date_format($dt,"F")."-".date_format($dt,"Y");
			$wlletdataSingle = array
						(
							"user_id"=>$userid,
							"purchase_id"=>$purchase_id,
							"notes" =>$notes,
							"withdraw" =>$amount,
							"tr_date"   =>date('d-m-Y H:i:s'),
							"yearmonth"=>$monthyear,
							"status"	=>1

						);
			$this->db->insert("user_wallet",$wlletdataSingle);

	}

	public function submitBalance($userid,$amount,$notes,$purchase_id,$updtBy)
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
							"purchase_id"=>$purchase_id,
							"notes" =>$notes,
							"deposit" =>$prcntSp,
							"tr_date"   =>date('d-m-Y H:i:s'),
							"yearmonth"=>$monthyear,
							"status"	=>1

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
							"purchase_id"=>$purchase_id,
							"notice" =>"Purchased by ".$userId,
							"amount" =>$amount,
							"date"   =>date('d-m-Y H:i:s'),
							"yearmonth"=>$monthyear,
							"update_by"=>$updtBy

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
							"purchase_id"=>$purchase_id,
							"notes" =>"Purchased by ".$userId,
							"deposit" =>$prcnt,
							"tr_date"   =>date('d-m-Y H:i:s'),
							"yearmonth"=>$monthyear,
							"status"	=>1

						);
			$this->db->insert("user_wallet",$wlletdatas);

			$allTempUser[] = array
									(
										"userid"=>$temp_under_userid,
										"purchase_id"=>$purchase_id,
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
							"purchase_id"=>$purchase_id,
							"notice" =>$notes,
							"amount" =>$amount,
							"date"   =>date('d-m-Y H:i:s'),
							"yearmonth"=>$monthyear,
							"update_by"=>$updtBy

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
		if($GT->num_rows()==0)
		{

		}
		else
		{
			$row = $GT->result();

			foreach ($row as $key) {
				$level = $key->level;
				if($level > 7)
				{
					//Nothing
				}
				else
				{
					$nowLvl = $level+1;
					$users = $key->user_id;

					$mem_type = $key->mem_type;
					
					$this->db->query("UPDATE  `es_users` SET `level`='$nowLvl',`last_update`='$date' WHERE `last_update` < now() - INTERVAL $duration DAY AND `mem_type` = 'Package' AND `user_id`='$users'");
				}
				
			}

			$this->db->update("settings",["start_date"=>$date]);
		}
		

	}

	public function getMtTr()
	{
		$this->db->where("user_id!=","ESM-202020");
		$this->db->order_by("id","ASC");
		$gttr = $this->db->get("my_transaction");
		if($gttr->num_rows()==0)
		{
			$data = array();
		}
		else
		{
			$res = $gttr->result();
			foreach ($res as $key) {
				$this->db->where("user_id",$key->user_id);
				$gtUsr = $this->db->get("es_users")->row();

				$data[] = array
							(
								"date"	=>$key->date,
								"userid"=>$key->user_id,
								"name"	=>$gtUsr->name,
								"notes"	=>$key->notice,
								"amount"=>$key->amount,
								"yearmonth"=>$key->yearmonth
							);
			}
		}

		return $data;
	}
	

	public function getAllTr()
	{
		$this->db->where("user_id!=","ESM-202020");
		$this->db->order_by("id","DESC");
		$gttr = $this->db->get("transaction_notice");
		if($gttr->num_rows()==0)
		{
			$data = array();
		}
		else
		{
			$res = $gttr->result();
			foreach ($res as $key) {
				$this->db->where("user_id",$key->user_id);
				$gtUsr = $this->db->get("es_users")->row();

				$data[] = array
							(
								"date"	=>$key->date,
								"userid"=>$key->user_id,
								"name"	=>$gtUsr->name,
								"notes"	=>$key->notice,
								"amount"=>$key->amount,
								"yearmonth"=>$key->yearmonth
							);
			}
		}

		return $data;
	}

	public function getBusinessReport($yrmnth)
	{
		$this->db->where("yearmonth",$yrmnth);
		$getReport = $this->db->get("business_report_history");
		if($getReport->num_rows()==0)
		{
			$data = array();
		}
		else
		{
			$res = $getReport->result();
			foreach ($res as $key) {
				$this->db->where("user_id",$key->user_id);
				$usr = $this->db->get("es_users")->row();


				$data[] = array
							(
								"userid" =>$key->user_id,
								"name"	=>@$usr->name,
								"yearmonth" =>$key->yearmonth,
								"amount" =>$key->amount
							);
			}
			
		}


		$this->db->where("yearmonth",$yrmnth);
		$this->db->select_sum("amount");
		$totBusiness = $this->db->get("business_report_history")->row();

		$this->db->where("yearmonth",$yrmnth);
		$this->db->select_sum("amount");
		$totTr = $this->db->get("my_transaction")->row();

		$othrBs = $totTr->amount - $totBusiness->amount;

		$allData = ["data"=>$data,"totTr"=>$totTr->amount,"totBusiness"=>$totBusiness->amount,"othrBs"=>$othrBs];
		return $allData;
	}

	public function usrReport($user,$dates)
	{
		$this->db->where(["user_id"=>$user,"yearmonth"=>$dates]);
		$this->db->order_by("id","ASC");
		$this->db->distinct();
		$this->db->select("notice");
		$get = $this->db->get("transaction_notice");
		if($get->num_rows()==0)
		{
			$data = array();
		}
		else
		{
			$res = $get->result();
			$data = [];
			foreach ($res as $key) {
				$notice = $key->notice;
				$expl = explode(" ", $notice);
				$this->db->where(["user_id"=>$expl[2],"yearmonth"=>$dates]);
				$this->db->order_by("id","ASC");
				$myTr = $this->db->get("my_transaction");

				$this->db->where(["user_id"=>$expl[2]]);
				$user = $this->db->get("es_users")->row();

				$name = @$user->name;

				$this->db->where(["user_id"=>$expl[2],"yearmonth"=>$dates]);
				$this->db->select_sum("amount");
				$gtSum = $this->db->get("my_transaction")->row();

				if($myTr->num_rows()==0)
				{
					$trData = array();
				}
				else
				{
					$trRes = $myTr->result();
					$trData = [];
					foreach($trRes as $tr):
						$this->db->where("user_id",$tr->user_id);
						$gtUsr = $this->db->get("es_users")->row();
						$trData[] = array
										(
											"userid" =>$tr->user_id,
											"name"	=>$gtUsr->name,
											"notice"=>$tr->notice,
											"amount"=>$tr->amount,
											"date" =>$tr->date
										);
					endforeach;	
				}
				$data[] = array("mnUser"=>$expl[2],"mnName"=>$name,"totAmt"=>$gtSum->amount,"trData"=>$trData);
			}
		}

		$dataAll = array("data"=>$data);

		return $dataAll;
	}

	public function getUserWallerBal()
	{
		$this->db->where("user_id!=",'ESM-202020');
		$this->db->order_by("id","ASC");
		$getUser = $this->db->get("es_users");
		if($getUser->num_rows()==0)
		{
			$data = array();
		}
		else
		{
			$res = $getUser->result();
			foreach ($res as $key):
				$this->db->where("user_id",$key->user_id);
				$this->db->select_sum("deposit");
				$dep = $this->db->get("user_wallet")->row();
				$totDeposit = $dep->deposit;

				$this->db->where("user_id",$key->user_id);
				$this->db->select_sum("withdraw");
				$wthdrw = $this->db->get("user_wallet")->row();
				$totWithdraw = $wthdrw->withdraw;

				$walletBalance = $totDeposit - $totWithdraw;
				$data[] = array
								(
									"userId" =>$key->user_id,
									"name"	 =>$key->name,
									"balance" =>$walletBalance
								);
			endforeach;
		}

		return $data;
	}
	public function WalletTransaction($userId)
	{
		$this->db->where("user_id",$userId);
		$get = $this->db->get("user_wallet");
		if($get->num_rows()==0)
		{
			$data = array();
		}
		else
		{
			$this->db->where("user_id",$userId);
			$getUser = $this->db->get("es_users");
			if($getUser->num_rows()==0):
				$name = "";
			else:
				$row = $getUser->row();
				$name = $row->name;
			endif;
			$res = $get->result();
			foreach ($res as $key):
				$data[] = array
							(
								"userId"	=>$userId,
								"name"		=>$name,
								"notes"		=>$key->notes,
								"dep"		=>$key->deposit,
								"withdraw"	=>$key->withdraw,
								"date"		=>$key->tr_date
							);
			endforeach;
		}

		$this->db->where("user_id",$userId);
				$this->db->select_sum("deposit");
				$dep = $this->db->get("user_wallet")->row();
				$totDeposit = $dep->deposit;

				$this->db->where("user_id",$userId);
				$this->db->select_sum("withdraw");
				$wthdrw = $this->db->get("user_wallet")->row();
				$totWithdraw = $wthdrw->withdraw;

				$walletBalance = $totDeposit - $totWithdraw;
				$allData = ["data"=>$data,"bal"=>$walletBalance];
		return $allData;
	}
	public function pendingRequest()
	{
		$this->db->where(["extra_notes!="=>null, "status"=>0]);
		$this->db->order_by("id", "ASC");
		$getRequest = $this->db->get("user_wallet");
		if($getRequest->num_rows()==0)
		{
			$data = array();
		}
		else
		{
			$res = $getRequest->result();
			foreach ($res as $key) {
				$data[] = array
								(
									"userId"=>$key->user_id,
									"date"	=>$key->tr_date,
									"notes"	=>$key->extra_notes,
									"amount"=>$key->withdraw,
									"status"=>$key->status,
									"id"	=>$key->id
								);
			}
		}

		return $data;
	}

	public function getExecutiveMembers()
	{
		$this->db->where(["user_id!="=>"ESM-202020","level"=>8]);
		$this->db->order_by("id","ASC");
		$getex = $this->db->get("es_users");
		if($getex->num_rows()==0)
		{
			$data = array();
		}
		else
		{
			$res = $getex->result();
			foreach ($res as $key) {
				$data[] = array
								(
									"name"	=>$key->name,
									"userId"=>$key->user_id,
									"email"	=>$key->email,
									"level"	=>$key->level,
									"phone"	=>$key->phone,
									"exStatus"=>$key->ex_status
								);
			}
		}

		return $data;
	}


	public function getCompanyBusiness($yrMnth)
	{
		$this->db->where("yearmonth",$yrMnth);
		$this->db->select_sum("amount");
		$get = $this->db->get("my_transaction");
		if($get->num_rows()==0)
		{
			$data = array();
		}
		else
		{
			$row = $get->row();
			$this->db->where(["level"=>8,"ex_status"=>0]);
			$getExs = $this->db->get("es_users");
			$rowEx = $getExs->row();
			$getEx = $getExs->num_rows();
			$per = 1/100;
			$amtt = $row->amount * $per;
			if($getEx == 0)
			{
				$eachAmt = 0;
			}
			else
			{
				$eachAmt = $amtt /$getEx;
			}
			$data = array
						(
							"month"	=>$yrMnth,
							"amount"=>$row->amount,
							"getEx" =>$getEx,
							"eachAmt"=>$eachAmt
						);
		}

		return $data;
	}

	public function CompTree($userId)
	{
		$this->db->where(["user_id"=>$userId]);
		$gt0 = $this->db->get("es_users");
		if($gt0->num_rows()==0)
		{
			$allData = array();
			$mainUser = array();
			$upperUser = array(); 
		}
		else
		{
			$rrow = $gt0->row();
			$mainUser = array("name"=>$rrow->name,"usrId"=>$rrow->user_id);
			$this->db->where("user_id",$rrow->under_userid);
			$getUpper = $this->db->get("es_users");
			if($getUpper->num_rows()==0)
			{
				$upperUser = array();
			}
			else
			{
				$uprUser = $getUpper->row();
				$upperUser = array("name"=>@$uprUser->name,"usrId"=>@$uprUser->user_id);
			}
			
		}
		$this->db->where(["under_userid"=>$userId]);
		$this->db->order_by("id","ASC");
		$gt = $this->db->get("es_users");
		if($gt->num_rows()==0)
		{
			$firstRow = array();
		}
		else
		{
			$first = $gt->result();
			foreach($first as $fr)
			{
				$this->db->where("under_userid",$fr->user_id);
				$gt2 = $this->db->get("es_users");
				if($gt2->num_rows()==0)
				{
					$SecRow = array();
				}
				else
				{
					$second = $gt2->result();
					$SecRow = [];
					foreach ($second as $sec) {
						$this->db->where("under_userid",$sec->user_id);
						$gt3 = $this->db->get("es_users");
						if($gt3->num_rows()==0)
						{
							$ThrdRow = array();
						}
						else
						{
							$ThrdRowss = $gt3->result();
							$ThrdRow = [];
							foreach ($ThrdRowss as $th) {
								$ThrdRow[] = array
													(
														"name"=>$th->name,
														"usrId"=>$th->user_id
													);
							}
						}
						$SecRow[] = array
										(
											"name"=>$sec->name,
											"usrId"=>$sec->user_id,
											"thrdRow"=>$ThrdRow
										);
					}
				}
				$firstRow[] = array
									(
										"name" => $fr->name,
										"usrId"=>$fr->user_id,
										"secRow"=>$SecRow,
										
										
									);
			}
		}

		$allData = ["mainUser"=>$mainUser,"firstRow"=>$firstRow];
		return $allData;
	}

	public function CompleteRequest()
	{
		$this->db->where(["extra_notes!="=>null, "status"=>1]);
		$this->db->order_by("id", "ASC");
		$getRequest = $this->db->get("user_wallet");
		if($getRequest->num_rows()==0)
		{
			$data = array();
		}
		else
		{
			$res = $getRequest->result();
			foreach ($res as $key) {
				$data[] = array
								(
									"userId"=>$key->user_id,
									"date"	=>$key->tr_date,
									"notes"	=>$key->extra_notes,
									"amount"=>$key->withdraw,
									"status"=>$key->status,
									"id"	=>$key->id
								);
			}
		}

		return $data;
	}

	public function getAllCat()
	{
		$this->db->order_by("id","DESC");
		$allCat = $this->db->get("categories");
		if($allCat->num_rows()==0)
		{
			$data = array();
		}
		else
		{
			$res = $allCat->result();
			foreach ($res as $key) {
				$data[] = array
							(
								"cat_name"=>$key->cat_name,
								"img"=>$key->cat_img,
								"id"=>$key->id
							);
			}
		}

		return $data;
	}

	public function getCatById($id)
	{
		$this->db->where("id",$id);
		$allCat = $this->db->get("categories");
		if($allCat->num_rows()==0)
		{
			$data = array();
		}
		else
		{
			$key = $allCat->row();
			$data = array
							(
								"cat_name"=>$key->cat_name,
								"img"=>$key->cat_img,
								"id"=>$key->id
							);
		}

		return $data;
	}

	public function getAllProducts()
	{
		$this->db->order_by("id","DESC");
		$getPro = $this->db->get("products");
		if($getPro->num_rows()==0)
		{
			$data = array();
		}
		else
		{
			$res = $getPro->result();
			foreach ($res as $key) {
				$this->db->where("id",$key->cat_id);
				$Cat = $this->db->get("categories")->row();
				$data[] = array
							(
								"cat_name" => $Cat->cat_name,
								"pro_name" =>$key->pro_name,
								"img"	=>$key->pro_img,
								"id"	=>$key->id,
								"price" =>$key->price
							);
			}
		}

		return $data;
	}

	public function getProById($id)
	{
		$this->db->where("id",$id);
		$getPro = $this->db->get("products");
		if($getPro->num_rows()==0)
		{
			$data = array();
		}
		else
		{
			$key = $getPro->row();
			$data = array
							(
								"pro_name" =>$key->pro_name,
								"img"	=>$key->pro_img,
								"id"	=>$key->id,
								"cat_id"=>$key->cat_id,
								"price"=>$key->price
							);
		}

		return $data;
	}

	public function getSuperAdmin()
	{
		$this->db->where("admin_user!=","admin");
		$get = $this->db->get("admin");
		if($get->num_rows()==0)
		{
			$data = array();
		}
		else
		{
			$res = $get->result();
			foreach ($res as $key) {
				$this->db->where("user_id",$key->admin_user);
				$get2 = $this->db->get("es_users");
				if($get2->num_rows()==0)
				{
					$name = "";
				}
				else
				{
					$row = $get2->row();
					$name = $row->name;
				}

				$data[] = array
								(
									"adminId"=>$key->admin_user,
									"name" =>$name,
									"id" =>$key->id,
									"status"=>$key->status
								);
			}
		}

		return $data;
	}

}