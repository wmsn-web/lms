<?php
/**
 * 
 */
class Cron extends CI_controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model("AdminModel");
	}

	public function CreateMothlyReport()
	{
		date_default_timezone_set('Asia/Kolkata');
		$date = date('Y-m-d');
		$dt = date_create($date);
		$yrmnth = date_format($dt,"F")."-".date_format($dt,"Y");

		$this->db->where("userid!=","ESM-202020");
		$this->db->order_by("id","ASC");
		$getTree = $this->db->get("tree");
		if($getTree->num_rows()==0)
		{
			$return = "notFound";
		}
		else
		{
			$res = $getTree->result();
			foreach ($res as $key => $value) {
				$this->db->where(["user_id"=>$value->userid,"yearmonth"=>$yrmnth]);
				$gtBsns = $this->db->get("business_report_history");
				$getBRep = $gtBsns->num_rows();
				if($getBRep >0)
				{
					$bsnsRow = $gtBsns->row();
					$reportAmt = $bsnsRow->amount;
					$treeAmt = $value->tot_amount;
					$nowAmt = $treeAmt+$reportAmt;

					$this->db->where(["user_id"=>$value->userid,"yearmonth"=>$yrmnth]);
					$this->db->update("business_report_history",["amount"=>$nowAmt]);
					$return = "exist";
					$this->db->update("tree",["tot_amount"=>"0.00"]);
				}
				else
				{
					$this->db->insert("business_report_history",["user_id"=>$value->userid,"yearmonth"=>$yrmnth,"amount"=>$value->tot_amount]);
					$this->db->update("tree",["tot_amount"=>"0.00"]);
					$return = "succ";
				}
			}
		}
	}

	public function newTest()
	{
		$this->db->insert("demos",["status"=>1]);
	}
}