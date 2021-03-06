<?php
/**
 * 
 */
class MembersTree extends CI_controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model("AdminModel");
		$this->load->model("SiteModel");
		if(!$this->session->userdata("AdminUsers"))
		{
			$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
			return redirect("admin_panel/Login?refer=$actual_link");
		}
	}

	public function index($userId='ESM-202020')
	{
		$getTree = $this->AdminModel->CompTree($userId);
		//print_r($getTree);
		$this->load->view("admin/MembersTree",["treeData"=>$getTree]);
	}
}