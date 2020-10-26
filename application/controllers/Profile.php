<?php

class Profile extends CI_controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model("SiteModel");
		if(!$this->session->userdata("userId"))
		{
			$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
			$base = base_url('UserLogin');
			return redirect($base);
		}
	}
	public function index()
	{
		$userId = $this->session->userdata("userId");
		$proData = $this->SiteModel->getProfile($userId);
		$dashBoardData = $this->SiteModel->dashBoardData($userId);
		//print_r($proData);
		$this->load->view("fronts/Profile",["proData"=>$proData,"dashData"=>$dashBoardData]);
	}

	public function addBank()
	{
		$userId = $this->input->post("userId");
		$bank = $this->input->post("bank");
		$ifsc = $this->input->post("ifsc");
		$ac_no = $this->input->post("ac_no");

		$data = ["bank"=>$bank,"ifsc"=>$ifsc,"ac_no"=>$ac_no];
		$this->db->where("user_id",$userId);
		$this->db->update("es_users",$data);
		
	}

	public function ChangePass()
	{
		$userId = $this->input->post("userId");
		$pass = $this->input->post("pass");
		$newpass = password_hash($pass, PASSWORD_DEFAULT);
		$this->db->where("user_id",$userId);
		$this->db->update("es_users",["password"=>$newpass]);

		$this->session->unset_userdata("userId");
		$this->session->set_flashdata("Feed","Password Changed Successfully. Login with new password.");
		return redirect("UserLogin");

	}

	public function Downline($userId = '')
	{
		if(empty($userId))
		{
			return redirect("Profile");
		}
		else
		{
			$getTree = $this->SiteModel->getMyTree($userId);
			//echo "<pre>";
			//print_r($getTree);
			$this->load->view("fronts/downline",["treeData"=>$getTree]);
		}
	}

	public function RequestWidthdraw($userId='')
	{
		if(empty($userId))
		{
			return redirect("Profile");
		}
		else
		{
			$requestData = $this->SiteModel->requestData($userId);
			$dashBoardData = $this->SiteModel->dashBoardData($userId);
			$this->load->view("fronts/RequestWidthdraw",["dashData"=>$dashBoardData,"request"=>$requestData]);
		}
	}

	public function Request()
	{
		$userId = $this->input->post("userId");
		$amt = $this->input->post("amt");
		date_default_timezone_set("Asia/Kolkata");
        $date = date('Y-m-d');
        $dt = date_create($date);
        $yrmnth = date_format($dt,"F")."-".date_format($dt,'Y');
		$this->db->insert("user_wallet",["user_id"=>$userId,"extra_notes"=>"User Request to withdraw amount from Admin","withdraw"=>$amt,"tr_date"=>$date,"yearmonth"=>$yrmnth,"status"=>0]);
		$this->session->set_flashdata("Feed","Request has been sent to admin.");
		return redirect("Profile/RequestWidthdraw/".$userId);
	}

	public function MyBusiness()
	{
		  date_default_timezone_set('Asia/Kolkata');
	      $Todate = date("Y-m-d");
	      $dt = date_create($Todate);
	      $mnths = date_format($dt,"F");
	      $years = date_format($dt,"Y");
	      $yrMnth = date_format($dt,"F")."-".date_format($dt,"Y");
		$userId = $this->session->userdata("userId");
		$getMytr = $this->SiteModel->getMytr($userId);
		$getTeambs = $this->SiteModel->getTeambs($userId,$yrMnth);
		$getMyBs = $this->SiteModel->getMyBs($userId,$yrMnth);
		$this->load->view("fronts/MyBusiness",["mytr"=>$getMytr,"bisRep"=>$getTeambs,"myBs"=>$getMyBs]);
	}

	public function GetTmbsByMn()
	{
		$userId = $this->input->post("user");
		$yrMnth = $this->input->post("mnYr");
		$getTeambs = $this->SiteModel->getTeambs($userId,$yrMnth);
		echo $getTeambs['bsRep'];
	}

	public function GetMybsByMn()
	{
		$userId = $this->input->post("user");
		$yrMnth = $this->input->post("mnYr");
		$getMyBs = $this->SiteModel->getMyBs($userId,$yrMnth);
		echo $getMyBs['myBsns'];
	}
}