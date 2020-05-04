<?php
/**
 * 
 */
class HomeAdmin extends CI_controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model("AdminModel");
	}

	function index()
	{
		$getTree = $this->AdminModel->getTree();
		//print_r($getTree);
		$this->load->view("admin/HomeAdmin",["getDtls"=>$getTree]);

	}

	function loginProcess()
	{
		$user = $this->input->post("username");
		$password = $this->input->post("password");
		$this->db->where(["admin_user"=>$user,"password"=>$password]);
		$getUser = $this->db->get("admin");
		$num = $getUser->num_rows();
		if($num==1)
		{
			$this->session->set_userdata("UserAdmin",$user);
			return redirect('admin_panel/HomeAdmin');
		}else{
			$this->session->set_flashdata("Feed","Invalid Username or Password!");
			return redirect('admin_panel/HomeAdmin');
		}
	}
}