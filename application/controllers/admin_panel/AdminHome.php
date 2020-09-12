<?php
/**
 * 
 */
class AdminHome extends CI_controller
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
		
		$checkChangeLevel = $this->AdminModel->checkChangeLevel();
	}

	function index()
	{
		$this->load->view("admin/AdminHome");
	}

	function dashboard()
	{
		$this->load->view("admin/AdminHome");
	}

	function logout()
	{
		$this->session->unset_userdata("AdminUsers");
		return redirect("admin_panel/Login");
	}
}