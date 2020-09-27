<?php
/**
 * 
 */
class SiteModel extends CI_model
{
	public function getProfile($userId)
	{
		$this->db->where("user_id",$userId);
		$getUser = $this->db->get("es_users");
		if($getUser->num_rows()==0)
		{
			$data = array();
		}
		else
		{
			$row = $getUser->row();
			$underId = $row->under_userid;
			$this->db->where("user_id",$underId);
			$getunder = $this->db->get("es_users")->row();
			$sponsor = $getunder->name;
			$data = array
						(
							"name"			=>$row->name,
							"email"			=>$row->email,
							"phone"			=>$row->phone,
							"father_name"	=>$row->father_name,
							"address"		=>$row->address,
							"dob"			=>$row->dob,
							"gender"		=>$row->gender,
							"sponsor"		=>$sponsor,
							"bank"			=>$row->bank,
							"ifsc"			=>$row->ifsc,
							"ac_no"			=>$row->ac_no,
							"level"			=>$row->level,
							"userId"		=>$row->user_id
						);
		}

		return $data;
	}

	public function dashBoardData($userId)
	{
		
		//Get Downline Count
		$this->db->where("userid",$userId);
		$gtdown = $this->db->get("tree");
		if($gtdown->num_rows()==0)
		{
			$total = "";
			$business = "";
		}
		else
		{
			$trRow = $gtdown->row();
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
			$business = $trRow->tot_amount;
		}

		$this->db->where("user_id",$userId);
		//$this->db->select_sum("deposit");
		$wallet = $this->db->get("user_wallet");
		if($wallet->num_rows()==0)
		{
			$walletBalance = 0;
		}
		else
		{
			$this->db->where("user_id",$userId);
			$this->db->select_sum("deposit");
			$gtdep = $this->db->get("user_wallet")->row();
			$dep = $gtdep->deposit;

			$this->db->where("user_id",$userId);
			$this->db->select_sum("withdraw");
			$gtw = $this->db->get("user_wallet")->row();
			$wdr = $gtw->withdraw;

			$walletBalance = $dep - $wdr;
		}

		

		$data = array("downline"=>$total, "business"=>$business, "walletBalance"=>$walletBalance);
		return $data;
	}

	//Vital Section Tree View
	public function getMyTree($userId)
	{
		$this->db->where(["user_id"=>$userId]);
		$gt0 = $this->db->get("es_users");
		if($gt0->num_rows()==0)
		{
			$allData = array();
			$mainUser = array();
		}
		else
		{
			$rrow = $gt0->row();
			$mainUser = array("name"=>$rrow->name,"usrId"=>$rrow->user_id);
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

	public function requestData($userId)
	{
		$this->db->where(["user_id"=>$userId,"extra_notes!="=>null]);
		$getrequest = $this->db->get("user_wallet");
		if($getrequest->num_rows()==0)
		{
			$data = array();
		}
		else
		{
			$res = $getrequest->result();
			foreach ($res as $key) {
				$data[] = array
								(
									"date"	=>$key->tr_date,
									"notes"	=>$key->extra_notes,
									"amount"=>$key->withdraw,
									"status"=>$key->status
								);
			}
		}

		return $data;
	}
}