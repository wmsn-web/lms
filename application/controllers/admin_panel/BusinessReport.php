<?php
/**
 * 
 */
class BusinessReport extends CI_controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model("AdminModel");
		if(!$this->session->userdata("AdminUsers"))
		{
			$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
			return redirect("admin_panel/Login?refer=$actual_link");
		}
	}

	public function index()
	{
		$this->load->view("admin/BusinessReport");
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
				$getBRep = $this->db->get("business_report_history")->num_rows();
				if($getBRep >0)
				{
					$return = "exist";
				}
				else
				{
					$this->db->insert("business_report_history",["user_id"=>$value->userid,"yearmonth"=>$yrmnth,"amount"=>$value->tot_amount]);
					$this->db->update("tree",["tot_amount"=>"0.00"]);
					$return = "succ";
				}
			}
		}

		if($return == "succ")
		{
			$this->session->set_flashdata("Feed","Report of $yrmnth created Successfully");
			return redirect("admin_panel/BusinessReport");
		}
		elseif($return == "exist")
		{
			$this->session->set_flashdata("Feed","Report of $yrmnth Already Exist!");
			return redirect("admin_panel/BusinessReport");
		}
		else
		{
			$this->session->set_flashdata("Feed","Report of $yrmnth Not Found!");
			return redirect("admin_panel/BusinessReport");
		}
		
	}
}