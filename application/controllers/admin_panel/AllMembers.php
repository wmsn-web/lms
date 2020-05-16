<?php
 /**
  * 
  */
 class AllMembers extends CI_controller
 {
 	
 	function __construct()
	{
		parent::__construct();
		$this->load->model("AdminModel");
		if(!$this->session->userdata("AdminUsers"))
		{
			return redirect("admin_panel/Login");
		}
	}

	public function index()
	{
		$getAllMembers = $this->AdminModel->getAllMembers();
		$this->load->view("admin/AllMembers",["data"=>$getAllMembers]);
	}
 }