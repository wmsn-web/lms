<?php
/**
 * 
 */
class BusinessReport extends CI_controller
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
		date_default_timezone_set('Asia/Kolkata');
		$date = date('Y-m-d');
		$dt = date_create($date);
		$yrmnth = date_format($dt,"F")."-".date_format($dt,"Y");

		$getReport = $this->AdminModel->getBusinessReport($yrmnth);
		//echo "<pre>";
		//print_r($getReport);
		$this->load->view("admin/BusinessReport",["report"=>$getReport]);
	}

	public function CreateMothlyReport()
	{
		date_default_timezone_set('Asia/Kolkata');
		$date = date('Y-m-d');
		$dt = date_create($date);
		$yrmnth = date_format($dt,"F")."-".date_format($dt,"Y");

		$this->db->where("userid!=","ESM-202020");
		$this->db->order_by("id","ASC");
		$getTree = $this->db->get("tree");
		if($getTree->num_rows()==0)
		{
			$return = "notFound";
		}
		else
		{
			$res = $getTree->result();
			foreach ($res as $key => $value) {
				$this->db->where(["user_id"=>$value->userid,"yearmonth"=>$yrmnth]);
				$gtBsns = $this->db->get("business_report_history");
				$getBRep = $gtBsns->num_rows();
				if($getBRep >0)
				{
					$bsnsRow = $gtBsns->row();
					$reportAmt = $bsnsRow->amount;
					$treeAmt = $value->tot_amount;
					$nowAmt = $treeAmt+$reportAmt;

					$this->db->where(["user_id"=>$value->userid,"yearmonth"=>$yrmnth]);
					$this->db->update("business_report_history",["amount"=>$nowAmt]);
					$return = "exist";
					$this->db->update("tree",["tot_amount"=>"0.00"]);
				}
				else
				{
					$this->db->insert("business_report_history",["user_id"=>$value->userid,"yearmonth"=>$yrmnth,"amount"=>$value->tot_amount]);
					$this->db->update("tree",["tot_amount"=>"0.00"]);
					$return = "succ";
				}
			}
		}

		if($return == "succ")
		{
			$this->session->set_flashdata("Feed","Report of $yrmnth created Successfully");
			return redirect("admin_panel/BusinessReport");
		}
		elseif($return == "exist")
		{
			$this->session->set_flashdata("Feed","Report of $yrmnth Already Exist!");
			return redirect("admin_panel/BusinessReport");
		}
		else
		{
			$this->session->set_flashdata("Feed","Report of $yrmnth Not Found!");
			return redirect("admin_panel/BusinessReport");
		}
		
	}

	public function getReportJs()
	{
		$yrmnth = $this->input->post("yrMnth");
		$getReport = $this->AdminModel->getBusinessReport($yrmnth); ?>

		<span id="prc" class="right singlePrice">
												<table class="table table-bordered">
													<tr>
														<th>Business =</th>
														<td><?= $getReport['totBusiness']; ?></td>
													</tr>
													<tr>
														<th>Others =</th>
														<td><?= number_format($getReport['othrBs'],2); ?></td>
													</tr>
												</table>
												Total Business
												<?= $getReport['totTr']; ?>
											</span><br><br>
		<table id="example2" class="table table-bordered">
										<thead>
											<tr>
												<th>SL</th>
												<th>Month</th>
												<th>User ID</th>
												<th>Amount</th>
												
											</tr>
										</thead>
										<tbody id="flttr">
											
											<?php if(!empty($getReport['data'])): ?>
											<?php $i = 1; foreach($getReport['data'] as $key): $s = $i++; ?>
												<tr>
													<td><?= $s; ?></td>
													<td><?= $key['yearmonth']; ?></td>
													<td><a href="<?= base_url('admin_panel/BusinessReportUser/index/'.$key['userid']); ?>"><?= $key['userid']." - ".$key['name']; ?></a></td>
													<td><?= $key['amount']; ?></td>
												</tr>
											<?php endforeach; ?>
											<?php endif; ?>
										</tbody>
									</table>

	<?php
	}
}