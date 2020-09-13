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
								<a class="modal-effect" data-effect="effect-slide-in-right" data-toggle="modal" href="#modaldemo8">
									<button class="btn btn-primary">Create Report - <?= $yrMnth; ?></button>
								</a>
								<div class="table-responsive">
									<table id="example2" class="table table-bordered">
										<thead>
											<tr>
												<th>SL</th>
												<th>Date</th>
												<th>User ID</th>
												<th>Name</th>
												<th>Notes</th>
												<th>Amount</th>
												<th>Month Year</th>
											</tr>
										</thead>
										<tbody>
											<?php if(!empty($data)): ?>
											<?php $i = 1; foreach($data as $key): $s = $i++; ?>
												<tr>
													<td><?= $s; ?></td>
													<td><?= $key['date']; ?></td>
													<td><?= $key['userid']; ?></td>
													<td><?= $key['name']; ?></td>
													<td><?= $key['notes']; ?></td>
													<td><?= $key['amount']; ?></td>
													<td><?= $key['yearmonth']; ?></td>
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
				<!-- row closed -->
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
			})
		</script>
	</body>
</html>