<?php
/**
 * 
 */
class Settings extends CI_controller
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
			$this->load->view("admin/Settings");
		}
		else
		{
			$this->session->set_flashdata("Feed","Not permission For this Section");
			return redirect("admin_panel/");
		}
	}

	public function updateSetup()
	{
		$level_chng_duration = $this->input->post("duration");
		$date = $this->input->post("dates");

		$SetupData = array
							(
								"level_chng_duration"	=>$level_chng_duration,
								"start_date"	=>$date
							);
		$this->db->update("settings",$SetupData);
		$this->db->update("es_users",["last_update"=>$date]);

		$this->session->set_flashdata("Feed","Settings Updated");
		return redirect("admin_panel/Settings");
	}

	public function UpdateLevelSetup()
	{
		$tblRow = $this->input->post("tblRow");
		$id = $this->input->post("id");
		$tdval = $this->input->post("tdval"); 

		if($tblRow == "lv"){$tblR = "level";}
		elseif($tblRow == "sp"){$tblR = "spcb";}
		elseif($tblRow == "tp"){$tblR = "tpcb";}
		elseif($tblRow == "tr"){$tblR = "target";}
		else{$tblR = "";}


		$this->db->where("id",$id);
		$sql = $this->db->update("level_setup",["$tblR"=>$tdval]);
		if($sql)
		{
			echo "done";
		}
		else
		{
			echo "none";
		}
	}

	public function minimum_withdraw()
	{
		$minimum_withdraw = $this->input->post("minimum_withdraw");

		$SetupData = array
							(
								"minimum_withdraw"	=>$minimum_withdraw
							);
		$this->db->update("settings",$SetupData);

		$this->session->set_flashdata("Feed","Settings Updated");
		return redirect("admin_panel/Settings");
	
	}

}
