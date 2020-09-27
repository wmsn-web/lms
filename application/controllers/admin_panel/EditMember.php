<?php
/**
 * 
 */
class EditMember extends CI_controller 
{
	function __construct(){
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
		if(isset($_GET['under']))
		{
			$under = $_GET['under'];
			$get = $this->AdminModel->getUnders($under);
			if($get->num_rows() >0)
			{
				$row = $get->row();

			}else{
				$row = array();
				$this->session->set_flashdata("Feed","Invalid User Id");
				return redirect("admin_panel/AddMember");
			}
		}
		else
		{
			$row = array();
		}
		$userId = $this->uri->segment(4);
		$userData = $this->AdminModel->GetUserById($userId);
		if(empty($userData))
		{
			return redirect("admin_panel/AddMember/index/?under=".$under);
		}
		$this->load->view("admin/EditMember",["row"=>$row,"data"=>$userData]);
	}

	public function UpdateMem()
	{
		$name = $this->input->post("name");
		$fathname = $this->input->post("fathName");
		$dob = $this->input->post("dob");
		$gender = $this->input->post("gender");
		$addr = htmlentities($this->input->post("addr"));
		$phone = $this->input->post("phone");
		$email = $this->input->post("email");
		$bank = $this->input->post("bank");
		$ifsc = $this->input->post("ifsc");
		$ac_no = $this->input->post("ac_no");
		$userid = $this->input->post("userid");
		$memType = $this->input->post("memType");
		$under_userid = $this->input->post("under");
		$levels = $this->input->post("levels");

		$es_usersData = array
							(
								"name"	=>$name,
							   "email"	=>$email,
							   "phone"	=>$phone,
							 "address"	=>$addr,
						 "father_name"	=>$fathname,
								 "dob"	=>$dob,
							  "gender"	=>$gender,
								"bank"	=>$bank,
								"ifsc"	=>$ifsc,
							   "ac_no"	=>$ac_no,
							"mem_type"	=>$memType,
							"level"		=>$levels
							);
		$this->db->where("user_id",$userid);
		$this->db->update("es_users",$es_usersData);
		$this->session->set_flashdata("Feed","User Updated Successfully");
		return redirect("admin_panel/EditMember/index/".$userid."/?under=".$under_userid);
	}
}
