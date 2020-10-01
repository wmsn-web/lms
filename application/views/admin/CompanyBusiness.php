<!doctype html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<?php include("inc/table_layout.php"); ?>
		<title> Admin Panel</title>
	</head>
	<body class="main-body app sidebar-mini Light-mode">
		<div id="global-loader" class="light-loader">
			<img src="<?= base_url(); ?>assets/img/loaders/loader.svg" class="loader-img" alt="Loader">
		</div>
		<?php include("inc/sidemenu.php"); ?>
		<div class="main-content app-content">
			<?php include("inc/header.php"); ?>
			<div class="container-fluid">

				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Dashboard</h4><span class="text-muted mt-1 tx-13 ml-2 mb-0">/ Business Report</span>
						</div>
					</div>
					
				</div>
				<!-- breadcrumb -->
				<?php
					date_default_timezone_set('Asia/Kolkata');
					$Todate = date("Y-m-d");
					$dt = date_create($Todate);
					$mnths = date_format($dt,"F");
					$years = date_format($dt,"Y");
					$yrMnth = date_format($dt,"F")."-".date_format($dt,"Y");
				?>
				<!-- row -->
				
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header">
								<h4 class="card-title">
									Company Business Report
								</h4>
							</div>
							<div class="card-body">
								

								
								<select id="mnth">
									<?php
										$mn = $this->db->get("months")->result();
										foreach($mn as $m):
											if($m->month == $mnths): $slct = "selected"; else: $slct=""; endif;
									?>
										<option value="<?= $m->month; ?>" <?= $slct; ?>><?= $m->month; ?></option>
									<?php endforeach; ?>
								</select>
								<select id="year">
									<?php
										for ($i=1999; $i < 2051; $i++):
											if($i == $years): $slct = "selected"; else: $slct = "";
											endif;
									?>
										<option <?= $slct; ?> value="<?= $i; ?>"><?= $i; ?></option>
									<?php endfor; ?>
								</select>
								<button id="fltr" class="btn btn-warning"><i class="fa fa-filter text-white"></i></button><?= br(3); ?>
								<div class="table-responsive">
									<table id="example" class="table table-bordered">
										<thead>
											<th>SL</th>
											<th>Month</th>
											<th>Amount</th>
											<th>Action</th>
										</thead>
										<tbody id="fltrTbl">
											<tr>
												<td>1</td>
												<td><span class="mnth1"><?= $data['month']; ?></span></td>
												<td><span class="amt1"><?= $data['amount']; ?></span></td>
												<td><a class="modal-effect" data-effect="effect-slide-in-right" data-toggle="modal" href="#modaldemo8">Executive Reward</a></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					
				</div>
				<!-- row closed -->
				<?php if($feed = $this->session->flashdata("Feed")): ?>
					<div class="flashd"><?= $feed; ?></div>
				<?php endif; ?>
			</div>
			<!-- Container closed -->

			<div class="modal" id="modaldemo8">
			<div class="modal-dialog modal-md" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h6 class="modal-title">Calculation</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body">
						<table class="tbl">
							<tr>
								<th>Total Company Business (<span class="mnth1"><?= $data['month']; ?></span>)</th>
								<td><span class="amt1"><?= $data['amount']; ?></span></td>
							</tr>
							<tr>
								<th>Total Executive Members</th>
								<td><span id="mems"><?= $data['getEx']; ?></span></td>
							</tr>
							<tr>
								<th>Each Executive Members Get</th>
								<td><span id="cals"><?= $data['eachAmt']; ?></span></td>
							</tr>
						</table>
					</div>
					<div class="modal-footer justify-content-center">
						<button id="subAuth" class="btn ripple btn-primary" type="button">Send to Wallet</button>
						<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
					</div>
				</div>
			</div>
		</div>
			
		</div>
		<?php include("inc/rightmenu.php"); ?>
		<?php include("inc/footer.php"); ?>
		<?php include("inc/table_js.php"); ?>
		<script src="<?= base_url('assets/js/modal.js'); ?>"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#fltr").click(function(){
					year = $("#year").val();
					mnth = $("#mnth").val()
					yrMnth = mnth+"-"+year;
					$.post("<?= base_url('admin_panel/CompanyBusiness/getFilter'); ?>",
							{
								yrMnth: yrMnth
							},
							function(respons,status)
							{
								var data = JSON.parse(respons);
								$(".mnth1").html(data.month);
								$("#mems").html(data.getEx);
								$("#cals").html(data.eachAmt)
								//For Modal
								$(".amt1").html(data.amount);
							}
					)
				});

				$("#subAuth").click(function(){
					amt = $("#cals").html();
					mnth = $(".mnth1").html();
					if(amt =="" || amt == 0)
					{
						alert("No business this month");
						$("#modaldemo8").modal('hide');
					}
					else
					{
						$.post("<?= base_url('admin_panel/CompanyBusiness/sendReward'); ?>",
								{
									amt: amt,
									mnth: mnth
								},
								function(response,status)
								{
									if(response=="none")
									{
										alert("No Member Found!");
										location.href="?= base_url('admin_panel/CompanyBusiness/'); ?>";
									}
									else if(response=="exst")
									{
										alert("Already Added");
										location.href="<?= base_url('admin_panel/CompanyBusiness/'); ?>"
									}
									else
									{
										alert("Reward Added Successfully");
										location.href="<?= base_url('admin_panel/CompanyBusiness/'); ?>"
									}
								}
						)
					}
				});
				
			});
		</script>
	</body>
</html>