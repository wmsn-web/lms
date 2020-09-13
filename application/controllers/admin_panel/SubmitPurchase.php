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

				$this->db->where("user_id",$userid);
				$this->db->select_sum("deposit");
				$gtWallet1 = $this->db->get("user_wallet")->row();
				$bal1 = $gtWallet1->deposit;

				$this->db->where("user_id",$userid);
				$user1 = $this->db->get("es_users")->row();
				$email1 = $user1->email;
				$name1 = $user1->name;
				$spcb1 = @$key->deposit;

		$this->load->library('email');
				//SMTP & mail configuration
				$config = array(
				            'protocol' => 'smtp', 
				            'smtp_host' => 'ssl://smtp.gmail.com', 
				            'smtp_port' => 465, 
				            'smtp_user' => 'solutions.web2019@gmail.com', 
				            'smtp_pass' => 'Goodnight88', 
				            'mailtype' => 'html', 
				            'charset' => 'iso-8859-1'
							);
		
		if(!empty($submitBalance))
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
				$tpcb = @$key->deposit;


							$this->email->initialize($config);
							$this->email->set_mailtype("html");
							$this->email->set_newline("\r\n");

							$data = array("amount"=>$amount,"email"=>$email,"name"=>$name,"csbk"=>$tpcb,"bal"=>$bal);

							$mesage = $this->load->view("MailTemplates/BalancePurchase",$data,TRUE);
							$this->email->to($email);
							$this->email->from('solutions.web2019@gmail.com','Samridhi');
							$this->email->subject('Payment Success');
							$this->email->message($mesage);
							$this->email->send();
			}

							$this->email->initialize($config);
							$this->email->set_mailtype("html");
							$this->email->set_newline("\r\n");

							$data = array("amount"=>$amount,"email"=>$email1,"name"=>$name1,"csbk"=>$spcb1,"bal"=>$bal1);

							$mesage = $this->load->view("MailTemplates/BalancePurchase",$data,TRUE);
							$this->email->to($email1);
							$this->email->from('solutions.web2019@gmail.com','Samridhi');
							$this->email->subject('Payment Success');
							$this->email->message($mesage);
							$this->email->send();
		}

		$this->session->set_flashdata("Feed","Amount Updated");
		return redirect("admin_panel/SubmitPurchase");
	}

}