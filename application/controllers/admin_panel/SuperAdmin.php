<?php
/**
 * 
 */
class SuperAdmin extends CI_controller
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
			$getSuperAdmin = $this->AdminModel->getSuperAdmin();
			$this->load->view("admin/SuperAdmin",["data"=>$getSuperAdmin]);
		}
		else
		{
			$this->session->set_flashdata("Feed","Not permission For this Section");
			return redirect("admin_panel/");
		}
	}

	public function addAdmin()
	{
		$userAdmin = $this->input->post("userAdmin");
		$pass = $this->input->post("pass");
		$password = password_hash($pass, PASSWORD_DEFAULT);
		//Check Admin
		$this->db->where("admin_user",$userAdmin);
		$chk = $this->db->get("admin")->num_rows();
		if($chk > 0)
		{
			$this->session->set_flashdata("Feed","Admin Already Exist!");
			return redirect("admin_panel/SuperAdmin");
		}
		else
		{
			$this->db->insert("admin",["admin_user"=>$userAdmin,"password"=>$password]);
			$this->session->set_flashdata("Feed","Super Admin Added Successfully");
			return redirect("admin_panel/SuperAdmin");
		}
	}

	public function suspend($id='')
	{
		$this->db->where("id",$id);
		$chk = $this->db->update("admin",["status"=>0]);
		$this->session->set_flashdata("Feed","Super Admin has been suspended");
		return redirect("admin_panel/SuperAdmin");
	}

	public function unsuspend($id='')
	{
		$this->db->where("id",$id);
		$chk = $this->db->update("admin",["status"=>1]);
		$this->session->set_flashdata("Feed","Super Admin Unsuspended Successfully");
		return redirect("admin_panel/SuperAdmin");
	}
}