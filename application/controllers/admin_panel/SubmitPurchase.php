<?php
/**
 * 
 */
class SubmitPurchase extends CI_controller
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
		//$this->load->view("MailTemplates/BalancePurchase");
		$this->load->view("admin/SubmitPurchase");
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

	public function addPurchase()
	{
		$userid = $this->input->post("userid");
		$amount = $this->input->post("amount");
		$notes = $this->input->post("notes");

		$submitBalance = $this->AdminModel->submitBalance($userid,$amount,$notes);
		
		if(!empty($submitBalance)
		{
			foreach ($submitBalance as $key) {
				#Get data from Wallet
				$this->db->where("user_id",$key['userid']);
				$this->db->select_sum("deposit");
				$gtWallet = $this->db->get("user_wallet")->row();
				$bal = $gtWallet->deposit;

				#Get end user data from users

				$this->db->where("user_id",$key['userid']);
				$user = $this->db->get("es_users")->row();
				$email = $user->email;
				$name = $user->name;
				$amount =$key->amount;
				$tpcb = $key->deposit;
			}
		}
	}

}