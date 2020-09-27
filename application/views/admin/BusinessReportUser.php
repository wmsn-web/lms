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
							<h4 class="content-title mb-0 my-auto">Dashboard</h4><span class="text-muted mt-1 tx-13 ml-2 mb-0">/ User Business Report</span>
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
									Business Report
								</h4>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<div id="tblJs">
										
									<table id="example2" class="table table-bordered">
										<thead>
											<tr>
												<th>SL</th>
												<th>User ID</th>
												<th>Transactions</th>
												
											</tr>
										</thead>
										<tbody id="flttr">
											
											<?php if(!empty($data['data'])): ?>
											<?php $i = 1; foreach($data['data'] as $key): $s = $i++; ?>
												<tr>
													<td><?= $s; ?></td>
													<td><?= $key['mnUser']; ?><br>
														<?= $key['mnName']; ?><br>
														<b>Total Amount:</b><i><?= $key['totAmt']; ?></i>
													</td>
													<td>
														<table id="" class="table table-bordered example2">
															<thead>
																<tr class="bg-dark text-white">
																	<th>Name</th>
																	<th>Notes</th>
																	<th>Amount</th>
																	<th>Date</th>
																</tr>
															</thead>
															<tbody>
																<?php foreach ($key['trData'] as $keyTr): ?>
																	<tr>
																		<td><?= $keyTr['name']; ?></td>
																		<td><?= $keyTr['notice']; ?></td>
																		<td><?= $keyTr['amount']; ?></td>
																		<td><?= $keyTr['date']; ?></td>
																	</tr>
																<?php endforeach; ?>
															</tbody>
														</table>
													</td>
													
												</tr>
											<?php endforeach; ?>
											<?php endif; ?>
										</tbody>
									</table>
									</div>
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
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h6 class="modal-title">Submit Authentication Number</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body">
						<span class="text-danger" id="msg"></span>
						<input type="password" class="form-control" id="authNum">
					</div>
					<div class="modal-footer justify-content-center">
						<button id="subAuth" class="btn ripple btn-primary" type="button">Authenticate</button>
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

				$("#subAuth").click(function(){
					var authNum = $("#authNum").val();
					if(authNum == ""){$("#msg").html("Invalid Auth Number!");}
						else
						{
							$("#msg").html("");
					$.post("<?= base_url('admin_panel/AdminHome/validAuth'); ?>",
							{
								authNum: authNum
							},
							function(response,status)
							{
								if(response == "none")
								{
									$("#msg").html("Invalid Auth Number!");
								}
								else
								{
									$("#msg").html("");
									location.href="<?= base_url('admin_panel/BusinessReport/CreateMothlyReport'); ?>";
								}
							}
					)
				}
				});

				$("#fltr").click(function(){
					var mnth = $("#mnth").val()
					var yr = $("#year").val()
					var yrMnth = mnth+"-"+yr;

					$.post("<?= base_url('admin_panel/BusinessReport/getReportJs'); ?>",
							{
								yrMnth: yrMnth
							},
							function(response,status)
							{
								$("#tblJs").html(response);
								//$("#prc").hide();
							}
					)
					
				});
			});
		</script>
	</body>
</html>