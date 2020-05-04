<?php
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
	
	if(checkUserId($userid))
		{
			if (emailCheck($email)) 
			{
				if(emailUnder($under_userid))
				{
					if(side_check($under_userid,$side))
					{

					}else{
						echo "Site Not Exist";
					    die();
					}

				}else{
					echo "under Not Exist";
					die();
				}
			}else{
				echo "Email Exist";
				die();
			}
		}else{
			echo "user_id Exist";
			die();
		}
		
			
		
			/*
		$query = mysqli_query($con,"INSERT INTO user(`name`,`user_id`,`email`,`password`,`mobile`,`address`,`account`,`under_userid`,`side`) VALUES('$name','$userid','$email','$password','$mobile','$address','$account','$under_userid','$side')");
		
		//Insert into Tree
		//So that later on we can view tree.
		$query = mysqli_query($con,"INSERT INTO tree(`userid`) VALUES('$userid')");
		
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
			

			$tree_data = tree($temp_under_userid);
					
					
					$temp_left_count = $tree_data['leftcount'];
					$temp_right_count = $tree_data['rightcount'];

				$next_under_userid = getUnderId($temp_under_userid);
				$temp_side = getUnderIdPlace($temp_under_userid);
				$temp_side_count = $temp_side.'count';
				$temp_under_userid = $next_under_userid;	
				
				$i++;
				if($temp_under_userid==""){
				$total_count=0;
			}
		}
	}
	*/
}
function checkUserId($userid)
{
	global $con;
$chech = mysqli_query($con,"SELECT * FROM user WHERE user_id='$userid'");
	$num = mysqli_num_rows($chech);
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
	global $con;
	$checkUserMail = mysqli_query($con,"SELECT * FROM user WHERE email='$email'");
    $num = mysqli_num_rows($checkUserMail);
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
	$emailUnder = mysqli_query($con,"SELECT * FROM user WHERE user_id='$under_userid'");
    $num = mysqli_num_rows($emailUnder);
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
	global $con;
	$data = array();
	$query = mysqli_query($con,"SELECT * from tree WHERE userid='$userid'");
	$result = mysqli_fetch_array($query);
	$data['left'] = $result['left'];
	$data['right'] = $result['right'];
	$data['leftcount'] = $result['leftcount'];
	$data['rightcount'] = $result['rightcount'];
	
	return $data;
}
function getUnderId($userid){
	global $con;
	$query = mysqli_query($con,"SELECT * FROM user WHERE user_id='$userid'");
	$result = mysqli_fetch_array($query);
	return $result['under_userid'];
}
function getUnderIdPlace($userid){
	global $con;
	$query = mysqli_query($con,"SELECT * FROM user WHERE user_id='$userid'");
	$result = mysqli_fetch_array($query);
	return $result['side'];
}

function side_check($under_userid,$side){
	global $con;
	
	$query =mysqli_query($con,"select * from tree where userid='$under_userid'");
	$result = mysqli_fetch_array($query);
	$side_value = $result[$side];
	if($side_value==''){
		return true;
	}
	else{
		return false;
	}
}

?>