<?php
/**
 * 
 */
class AddBalance extends CI_controller
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
		$this->load->view("admin/AddBalance");
	}

	public function getUser()
	{
		$userKey = $this->input->post("user");
		$this->db->like("user_id",$userKey);
		$this->db->or_like("name",$userKey);
		$get = $this->db->get("es_users");
		if($get->num_rows()==0)
		{
			echo "false";
		}
		else
		{
			$res = $get->result();
			foreach ($res as $key) { ?>
				<li onClick="getText('<?= $key->user_id; ?>');"><?= $key->user_id." (".$key->name.")"; ?></li>
			<?php
			}
		}
	}

	public function submitBal()
	{
		$userid = $this->input->post("userid");
		$amount = $this->input->post("amount");

		$submitBalance = $this->AdminModel->submitBalance($userid,$amount);
		$this->session->set_flashdata("Feed","Balance Updated");
		return redirect("admin_panel/AddBalance");
	}
}