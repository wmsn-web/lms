<?php
/**
 * 
 */
class Join extends CI_controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	function userJoin()
	{
		$con = mysqli_connect("localhost","root","","new_mlm");
    if(isset($_GET['join_user'])){
	$side='';
	$name = mysqli_real_escape_string($con,$_GET['name']);
	$email = mysqli_real_escape_string($con,$_GET['email']);
	$mobile = mysqli_real_escape_string($con,$_GET['phone']);
	$address = mysqli_real_escape_string($con,$_GET['addr']);
	$account = "4471";
	$under_userid = mysqli_real_escape_string($con,$_GET['under']);
	$side = mysqli_real_escape_string($con,$_GET['side']);
	$userid = "U-".mt_rand(100000,999999);
	$password = "123456";
	$capping = 500;
	
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
						return redirect("admin_panel/HomeAdmin");
					    die();
					}

				}else{
					$this->session->set_flashdata("Feed","Under Position Does not Exist");
						return redirect("admin_panel/HomeAdmin");
					die();
				}
			}else{
				$this->session->set_flashdata("Feed","Email Address Exist");
						return redirect("admin_panel/HomeAdmin");
				die();
			}
		}else{
			$this->session->set_flashdata("Feed","User ID Exist");
						return redirect("admin_panel/HomeAdmin"); 
			die();
		}
		
			
		
			
		$query1 = mysqli_query($con,"INSERT INTO user(`name`,`user_id`,`email`,`password`,`mobile`,`address`,`account`,`under_userid`,`side`) VALUES('$name','$userid','$email','$password','$mobile','$address','$account','$under_userid','$side')");

		if(!$query1)
		{
			echo mysqli_error($con);
			die();
		}
		
		//Insert into Tree
		//So that later on we can view tree.
		$query2 = mysqli_query($con,"INSERT INTO tree(`userid`) VALUES('$userid')");
		if(!$query2)
		{
			echo mysqli_error($con);
			die();
		}
		
		//Insert to side
		$query = mysqli_query($con,"UPDATE tree SET `$side`='$userid' WHERE userid='$under_userid'");

		$temp_under_userid = $under_userid;
		$temp_side_count = $side.'count'; //leftcount or rightcount
		$temp_side = $side;
		$total_count=1;
		$i=1;
		while($total_count>0){
			$i;
			$q = mysqli_query($con,"SELECT * FROM tree WHERE userid='$temp_under_userid'");
			$r = mysqli_fetch_array($q);
			$current_temp_side_count = $r[$temp_side_count]+1;
			$temp_under_userid;
			$temp_side_count;
			mysqli_query($con,"UPDATE `tree` SET `$temp_side_count`='$current_temp_side_count' WHERE `userid`='$temp_under_userid'");
			

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
	}
	
	return redirect("admin_panel/HomeAdmin");
}

	

	function checkUserId($userid)
{

$chech = $this->db->query("SELECT * FROM user WHERE user_id='$userid'");
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
	
	$checkUserMail = $this->db->query("SELECT * FROM user WHERE email='$email'");
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
	$emailUnder =  $this->db->query("SELECT * FROM user WHERE user_id='$under_userid'");
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
	$query = $this->db->query("SELECT * FROM user WHERE user_id='$userid'");
	$result = $query->row();
	return $result->under_userid;
}
function getUnderIdPlace($userid){
	global $con;
	$query = $this->db->query("SELECT * FROM user WHERE user_id='$userid'");
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
