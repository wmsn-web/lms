<?php
/**
 * 
 */
class AddMember extends CI_controller
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
		if(isset($_GET['under']))
		{
			$under = $_GET['under'];
			$get = $this->AdminModel->getUnders($under);
			if($get->num_rows() >0)
			{
				$row = $get->row();
			}else{
				$row = array();
			}
		}
		else
		{
			$row = array();
		}
		$this->load->view("admin/AddMember",["row"=>$row]);
	}
}