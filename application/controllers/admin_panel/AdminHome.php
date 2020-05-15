<?php
/**
 * 
 */
class AdminHome extends CI_controller
{
	
	function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata("AdminUsers"))
		{
			return redirect("admin_panel/Login");
		}
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