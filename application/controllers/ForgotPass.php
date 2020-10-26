<?php
/**
 * 
 */
class ForgotPass extends CI_controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->view("fronts/ForgotPass");
	}

	public function sendOtp()
	{
		$userId = $this->input->post("userId");
		$this->db->where("user_id",$userId);
		$get = $this->db->get("es_users");
		if($get->num_rows()==0)
		{
			echo "inv";
		}
		else
		{
			$row = $get->row();
			$mobile = $row->phone;
			$otp = mt_rand(000000,999999);
			$this->db->where("user_id",$userId);
			$this->db->update("es_users",["forgot_token"=>$otp]);
			
			$sms = $this->db->get("sms_set")->row();
			$smsUser= $sms->sms_user;
			$smsPass = $sms->sms_pass;
			$number=$mobile;
			$sender= $sms->sender;
			$message = "Your OTP for reset password is ".$otp." Please ignore if you did not sent request.";

			$url="login.bulksmsgateway.in/sendmessage.php?user=".urlencode($smsUser)."&password=".urlencode($smsPass)."&mobile=".urlencode($number)."&sender=".urlencode($sender)."&message=".urlencode($message)."&type=".urlencode('3'); 
				$ch = curl_init($url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				echo $curl_scraped_page = curl_exec($ch);
				curl_close($ch);
				echo "ok";
				 
		}
	}

	public function checkOTP()
	{
		$userId = $this->input->post("userId");
		$ottp = $this->input->post("ottp");

		$this->db->where(["user_id"=>$userId,"forgot_token"=>$ottp]);
		$get = $this->db->get("es_users");
		if($get->num_rows()==0)
		{
			echo "invOtp";
		}
		else
		{
			$this->db->where("user_id",$userId);
			$this->db->update("es_users",["forgot_token"=>null]);
			echo "ok";
		}
	}

	public function ChangePass()
	{
		$userId = $this->input->post("userId");
		$pass = $this->input->post("pass");
		$password = password_hash($pass, PASSWORD_DEFAULT);
		$this->db->where(["user_id"=>$userId]);
		$this->db->update("es_users",["password"=>$password]);
	}
}