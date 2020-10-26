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
		$this->load->view("admin/AddMember",["row"=>$row]);
	}

	public function insertMem()
	{
		$name = $this->input->post("name");
		$fathname = $this->input->post("fathName");
		$dob = $this->input->post("dob");
		$gender = $this->input->post("gender");
		$addr = htmlentities($this->input->post("addr"));
		$phone = $this->input->post("phone");
		$email = $this->input->post("email");
		$side = $this->input->post("side");
		$bank = $this->input->post("bank");
		$ifsc = $this->input->post("ifsc");
		$ac_no = $this->input->post("ac_no");
		$userid = $this->input->post("userid");
		$memType = $this->input->post("memType");
		$under_userid = $this->input->post("under");
		$levels = $this->input->post("levels");
		$account = "4471";
		$fixdPass = "123456";
		$password = password_hash($fixdPass, PASSWORD_DEFAULT);
		$capping = 500;
		date_default_timezone_set('Asia/Kolkata');
		$joinDate = date('Y-m-d');
		$set = $this->db->get("settings")->row();
		$duration = $set->level_chng_duration;
		$start_date = $set->start_date;
		$updtBys = $this->session->userdata("AdminUsers");
		if($updtBys =="admin")
		{
			$updtBy = null;
		}
		else
		{
			$updtBy = $updtBys;
		}

		if($this->checkUserId($userid))
		{
			if ($this->emailCheck($email)) 
			{
				if($this->emailUnder($under_userid))
				{
					if($this->side_check($under_userid,$side))
					{

					}else{
						$this->session->set_flashdata("Feed","Position Does not Exist");
						return redirect("admin_panel/AddMember/?under=".$under_userid);
					    die();
					}

				}else{
					$this->session->set_flashdata("Feed","Under Position Does not Exist");
						return redirect("admin_panel/AddMember/?under=".$under_userid);
					die();
				}
			}else{
				$this->session->set_flashdata("Feed","Email Address Exist");
						return redirect("admin_panel/AddMember/?under=".$under_userid);
				die();
			}
		}else{
			$this->session->set_flashdata("Feed","User ID Exist");
						return redirect("admin_panel/AddMember/?under=".$under_userid); 
			die();
		}

		$es_usersData = array
							(
								"name"	=>$name,
							 "user_id"	=>$userid,
							   "email"	=>$email,
							   "phone"	=>$phone,
							 "address"	=>$addr,
						 "father_name"	=>$fathname,
								 "dob"	=>$dob,
							  "gender"	=>$gender,
						"under_userid"	=>$under_userid,
								"side"	=>$side,
								"bank"	=>$bank,
								"ifsc"	=>$ifsc,
							   "ac_no"	=>$ac_no,
							"password"	=>$password,
							"mem_type"	=>$memType,
							"level"		=>$levels,
							"last_update"=>$start_date,
						   "join_date"	=>$joinDate,
						   "update_by"	=>$updtBy
							);
		$this->db->insert("es_users",$es_usersData);
		$this->db->insert("tree",["userid"=>$userid]);

		$this->db->where("userid",$under_userid);
		$this->db->update("tree",[$side=>$userid]);

		//Send Sms//
		//Get SMS Credentials//
		$sms = $this->db->get("sms_set")->row();
		$smsUser= $sms->sms_user;
		$smsPass = $sms->sms_pass;
		$number=$phone;
		$sender= $sms->sender;
		$message = "Dear ".$name.", Thanks for join with us. Your UserID is: ".$userid." and Password is: ".$fixdPass." Please Don't share your UserID & Password.";

		$url="login.bulksmsgateway.in/sendmessage.php?user=".urlencode($smsUser)."&password=".urlencode($smsPass)."&mobile=".urlencode($number)."&sender=".urlencode($sender)."&message=".urlencode($message)."&type=".urlencode('3'); 
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			echo $curl_scraped_page = curl_exec($ch);
			curl_close($ch); 

		$temp_under_userid = $under_userid;
		$temp_side_count = $side.'count'; //leftcount or rightcount
		$temp_side = $side;
		$total_count=1;
		$i=1;
		while($total_count>0){
			$i;
			
			$this->db->where("userid",$temp_under_userid);
			$get = $this->db->get("tree");
			$row = $get->row();
			$current_temp_side_count = $row->$temp_side_count +1;
			$temp_under_userid;
			$temp_side_count;
			
			$this->db->where("userid",$temp_under_userid);
			$this->db->update("tree",[$temp_side_count=>$current_temp_side_count]);
			$tree_data = $this->tree($temp_under_userid);
					
					
					$temp_left_count = $tree_data['leftcount'];
					$temp_right_count = $tree_data['rightcount'];

				$next_under_userid = $this->getUnderId($temp_under_userid);
				$temp_side = $this->getUnderIdPlace($temp_under_userid);
				$temp_side_count = $temp_side.'count';
				$temp_under_userid = $next_under_userid;	
				
				$i++;
				if($temp_under_userid==""){
				$total_count=0;
			}
		}

		$this->session->set_flashdata("Feed","Member Added Successfully..<b style='color:#090'>ID:".$userid." </b>");
		return redirect("admin_panel/AddMember/");
	}


		function checkUserId($userid)
{

$chech = $this->db->query("SELECT * FROM es_users WHERE user_id='$userid'");
	$num = $chech->num_rows();
	if($num>0)
	{
		return false;
	}
	else
	{
		return true;
	}
}
function emailCheck($email)
{
	
	$checkUserMail = $this->db->query("SELECT * FROM es_users WHERE email='$email'");
    $num = $checkUserMail->num_rows();
    if($num>0)
    {
    	return false;
    }
    else
    {
    	return true;
    }
    
}

function emailUnder($under_userid)
{
	global $con;
	$emailUnder =  $this->db->query("SELECT * FROM es_users WHERE user_id='$under_userid'");
    $num = $emailUnder->num_rows();
    if($num>0)
    {
    	return true;
    }
    else
    {
    	return false;
    }
    
}

function tree($userid){
	//global $con;
	$data = array();
	$query = $this->db->query("SELECT * from tree WHERE userid='$userid'");
	$result = $query->row();
	$data['left'] = $result->left;
	$data['right'] = $result->right;
	$data['three'] = $result->three;
	$data['fourth'] = $result->fourth;
	$data['fifth'] = $result->fifth;


	$data['leftcount'] = $result->leftcount;
	$data['rightcount'] = $result->rightcount;
	$data['threecount'] = $result->threecount;
	$data['fourthcount'] = $result->fourthcount;
	$data['fifthcount'] = $result->fifthcount;
	
	return $data;
}
function getUnderId($userid){
	global $con;
	$query = $this->db->query("SELECT * FROM es_users WHERE user_id='$userid'");
	$result = $query->row();
	return $result->under_userid;
}
function getUnderIdPlace($userid){
	global $con;
	$query = $this->db->query("SELECT * FROM es_users WHERE user_id='$userid'");
	$result = $query->row();
	return $result->side;
}

function side_check($under_userid,$side){
	
	
	$query =$this->db->query("select * from tree where userid='$under_userid'");
	$result = $query->row();
	$side_value = $result->$side;
	if($side_value==''){
		return true;
	}
	else{
		return false;
	}
}


}