<?php
/**
 * 
 */
class Home extends CI_controller
{
	
	function index()
	{
		$allpro = $this->SiteModel->getAllProducts5();
		$this->load->view("fronts/home",["data"=>$allpro]);
	}
	public function logout()
	{
		$this->session->unset_userdata("userId");
		$base = base_url();
		echo "<script>"; echo "alert('Successfully Logout'); location.href='".base_url()."'"; echo "</script>";
	}
}