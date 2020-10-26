<?php
/**
 * 
 */
class UserWallet extends CI_controller
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
			$data = $this->AdminModel->getUserWallerBal();
			//print_r($data);
			$this->load->view("admin/UserWallet",["data"=>$data]);
		}
		else
		{
			$this->session->set_flashdata("Feed","Not permission For this Section");
			return redirect("admin_panel/");
		}
	}

	public function transaction($userId = '')
	{
		$WalletTransaction = $this->AdminModel->WalletTransaction($userId);
		$this->load->view("admin/UserWallet",["trData"=>$WalletTransaction]);
	}
}