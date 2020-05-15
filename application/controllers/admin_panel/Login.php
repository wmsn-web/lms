<?php
/**
 * 
 */
class Login extends CI_controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->view("admin/Login");
	}

	public function loginProcess()
	{
		$user = $this->input->post("user");
		$pass = $this->input->post("pass");

		$this->db->where("admin_user",$user);
		$getUser = $this->db->get("admin");
		$num = $getUser->num_rows();
		$row = $getUser->row();
		$pawd = $row->password;//taken from database
		if($num ==0)
		{
			$this->session->set_flashdata("Feed","Invalid Username!");
			return redirect("admin_panel/Login");
		}
		if (password_verify($pass, $pawd)) {
				$back = base_url('admin_panel/AdminHome/dashboard');
				if($_GET['refer'] == "")
			{
				$back = base_url('admin_panel/AdminHome/dashboard');
			}
			else
			{
				$back = $_GET['refer'];
			}
				$this->session->set_userdata("AdminUsers",$user);
				return redirect($back);

		}else{
			$this->session->set_flashdata("Feed","Invalid Password!");
			return redirect("admin_panel/Login");
		}

	}
}