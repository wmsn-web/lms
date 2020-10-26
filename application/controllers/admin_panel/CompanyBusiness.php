<?php
/**
 * 
 */
class CompanyBusiness extends CI_controller
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
		$admin = $this->session->userdata("AdminUsers");
		if($admin == "admin")
		{
			date_default_timezone_set('Asia/Kolkata');
			$Todate = date("Y-m-d");
			$dt = date_create($Todate);
			$mnths = date_format($dt,"F");
			$years = date_format($dt,"Y");
			$yrMnth = date_format($dt,"F")."-".date_format($dt,"Y");
			$getCompanyBusiness = $this->AdminModel->getCompanyBusiness($yrMnth);
			$this->load->view("admin/CompanyBusiness",["data"=>$getCompanyBusiness]);
		}
		else
		{
			$this->session->set_flashdata("Feed","Not permission For this Section");
			return redirect("admin_panel/");
		}
	}

	public function getFilter()
	{
		$yrMnth = $this->input->post("yrMnth");
		$getCompanyBusiness = $this->AdminModel->getCompanyBusiness($yrMnth);
		$data = $getCompanyBusiness;

		$this->db->where(["level"=>8,"ex_status"=>0]);
		$getEx = $this->db->get("es_users")->num_rows();
		$per = 1/100;
		$amtt = $data['amount'] * $per;
		$eachAmt = $amtt /$getEx;

		$array = array("month"=>$yrMnth,"amount"=>$data['amount'],"getEx"=>$getEx, "eachAmt"=>$eachAmt);
		echo json_encode($array);
	 }


	 public function sendReward()
	 {
	 	date_default_timezone_set("Asia/Kolkata");
	 	$date = date("d-m-Y H:i:s");
	 	$amt = $this->input->post("amt");
	 	$mnth = $this->input->post("mnth");
	 	$msg = "Executive Reward";

	 	$this->db->where(["level"=>8,"ex_status"=>0]);
		$getEx = $this->db->get("es_users");
		if($getEx->num_rows()==0)
		{
			$return = "none";
		}
		else
		{
			$res = $getEx->result();
			foreach ($res as $key) {
				$this->db->where(["user_id"=>$key->user_id,"notes"=>$msg,"yearmonth"=>$mnth]);
				$chk = $this->db->get("user_wallet")->num_rows();
				if($chk >0)
				{
					$return =  "exst";
				}
				else
				{
					$dataArray = array
	 								(
	 									"user_id"		=>$key->user_id,
	 									"notes"			=>$msg,
	 									"deposit"		=>$amt,
	 									"tr_date"		=>$date,
	 									"yearmonth"		=>$mnth,
	 									"status"		=>1	
	 								 );
	 				$this->db->insert("user_wallet",$dataArray);
	 				$return =  "done";
				}
			}
		}

		echo $return;
	 }


}