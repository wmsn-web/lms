<?php
/**
 * 
 */
class ExecutiveMembers extends CI_controller
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
			$getExecutiveMembers = $this->AdminModel->getExecutiveMembers();
			$this->load->view("admin/ExecutiveMembers",["data"=>$getExecutiveMembers]);
		}
		else
		{
			$this->session->set_flashdata("Feed","Not permission For this Section");
			return redirect("admin_panel/");
		}
	}

	public function SuspendUser($userId='')
	{
		$this->db->where("user_id",$userId);
		$this->db->update("es_users",["ex_status"=>1]);
		$this->session->set_flashdata("Feed","User Suspended");
		return redirect("admin_panel/ExecutiveMembers");
	}

	public function unspendUser($userId='')
	{
		$this->db->where("user_id",$userId);
		$this->db->update("es_users",["ex_status"=>0]);
		$this->session->set_flashdata("Feed","User Unsuspended");
		return redirect("admin_panel/ExecutiveMembers");
	}
}