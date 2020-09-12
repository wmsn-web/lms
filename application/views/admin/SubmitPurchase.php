<!doctype html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<?php include("inc/layout.php"); ?>
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
							<h4 class="content-title mb-0 my-auto">Dashboard</h4><span class="text-muted mt-1 tx-13 ml-2 mb-0">/ Submit Purchase</span>
						</div>
					</div>
					
				</div>
				<!-- breadcrumb -->

				<!-- row -->
				<div class="row justify-content-center">
					<div class="col-md-8">
						<div class="card">
							<div class="card-header bg-primary text-center">
								<h5 class="card-title text-white">
									Submit Details
								</h5>
							</div>
							<div class="card-body">
								<form action="<?= base_url('admin_panel/SubmitPurchase/addPurchase'); ?>" method="post">
									<div class="row">
										<div class="form-group col-sm-6">
											<label>Customer (<small class="text-danger">Search By Name or ID</small>)</label>
											<input type="text" name="userid" class="form-control" id="usr" autocomplete="off">
										<small class="text-danger" id="msg"></small>
										<div class="srcRes">
											<ul id="usrData"></ul>
										</div>
										</div>
										<div class="form-group col-sm-6">
											<label>Amount</label>
											<input type="text" name="amount" class="form-control">
										</div>
										<div class="form-group col-sm-12">
											<label>Notes</label>
											<input type="text" name="notes" class="form-control">
										</div>
										<div class="form-group col-sm-12">
											<button class="btn btn-primary">Submit</button>
										</div>
									</div>
								</form>
								<?php
									$date = date('Y-m-d');
			$dt = date_create($date);
			echo $monthyear = date_format($dt,"F")."-".date_format($dt,"Y");
								?>
							</div>
						</div>
					</div>
					
				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<?php include("inc/rightmenu.php"); ?>
		<?php include("inc/footer.php"); ?>
		<?php include("inc/js.php"); ?>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#usr").keyup(function(){
					var usr = $("#usr").val();

					$.post("<?= base_url('admin_panel/SubmitPurchase/getUser'); ?>",
						{
							user: usr
						},
						function(data,status)
						{
							if(data == "false")
							{
								$(".srcRes").hide();
								$("#msg").html("Invalid User ID");
								$("#bnt").attr("disabled",true);

							}
							else
							{
								if(usr=="")
								{
									$(".srcRes").hide();
								}
								else
								{
									$(".srcRes").show();
									$("#usrData").html(data);
									$("#bnt").attr("disabled",true);
								}
							}
							
						}
						)
				});
			});

			function getText(val)
		{
			$("#usr").val(val);
			$(".srcRes").hide();
			$("#bnt").attr("disabled",false);
		}
			
		</script>
	</body>
</html>