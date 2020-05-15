<?php
class Test extends CI_controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$con = mysqli_connect("localhost","root","","new_mlm");
		$amount = 200;
		$userid = "U-164343";
		$under_userid = "U-653742";
		$side = "left";

		$temp_under_userid = $under_userid;

		$total_count=1;
		$i=1;
			$q1 = mysqli_query($con,"SELECT * FROM tree WHERE userid='$userid'");
			$r1 = mysqli_fetch_array($q1);
			$amount_count = $r1["tot_amount"]+$amount;
			mysqli_query($con,"UPDATE `tree` SET `tot_amount`='$amount_count' WHERE `userid`='$userid'");

		while($total_count>0){
			$i;
			$q = mysqli_query($con,"SELECT * FROM tree WHERE userid='$temp_under_userid'");
			$r = mysqli_fetch_array($q);
			$current_temp_amount_count = $r["tot_amount"]+$amount;
			$temp_under_userid;
			$temp_side_count;
			mysqli_query($con,"UPDATE `tree` SET `tot_amount`='$current_temp_amount_count' WHERE `userid`='$temp_under_userid'");


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