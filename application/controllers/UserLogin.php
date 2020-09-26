<?php

class UserLogin extends CI_controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model("SiteModel");
		if($this->session->userdata("userId"))
		{
			$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
			$base = base_url();
			return redirect($base);
		}
	}
	public function index()
	{

		$this->load->view("fronts/Login");
		
	}
	public function Login()
	{
		$user = $this->input->post("username");
		$pass = $this->input->post("password");

		$this->db->where("user_id",$user);
		$gtUser = $this->db->get("es_users");
		if($gtUser->num_rows()==0)
		{
			$this->session->set_flashdata("Feed","Invalid User");
			return redirect("UserLogin");
		}
		else
		{
			$row = $gtUser->row();
			$passwordHash = $row->password;
			if(!password_verify($pass, $passwordHash))
			{
				$this->session->set_flashdata("Feed","Invalid Password");
				return redirect("UserLogin");
			}
			else
			{
				$this->session->set_userdata("userId",$user);
				echo "<script>"; echo "alert('Login Successfull'); location.href='".base_url('Profile')."'"; echo "</script>";
			}
		}

	}
}