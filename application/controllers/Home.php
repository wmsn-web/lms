<?php
/**
 * 
 */
class Home extends CI_controller
{
	
	function index()
	{
		$this->load->view("fronts/home");
	}
	public function logout()
	{
		$this->session->unset_userdata("userId");
		$base = base_url();
		echo "<script>"; echo "alert('Successfully Logout'); location.href='".base_url()."'"; echo "</script>";
	}
}