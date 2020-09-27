<?php
 /**
  * 
  */
 class WithdrawRequest extends CI_controller
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
		$pendingRequest = $this->AdminModel->pendingRequest();
		$this->load->view("admin/WithdrawRequest",["data"=>$pendingRequest]);
	}
}