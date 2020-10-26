<?php
/**
 * 
 */
class BusinessReportUser extends CI_controller
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

	public function index($user = '',$dates = '')
	{
		$admin = $this->session->userdata("AdminUsers");
		if($admin == "admin")
		{
			$userRep = $this->AdminModel->usrReport($user,$dates);
			//echo "<pre>";
			//print_r($userRep);
			$this->load->view("admin/BusinessReportUser",["data"=>$userRep]);
		}
		else
		{
			$this->session->set_flashdata("Feed","Not permission For this Section");
			return redirect("admin_panel/");
		}
	}
}