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
							<h4 class="content-title mb-0 my-auto">Dashboard</h4><span class="text-muted mt-1 tx-13 ml-2 mb-0">/ Add Balance</span>
						</div>
					</div>
					
				</div>
				<!-- breadcrumb -->

				<!-- row -->
				<div class="row justify-content-center">
					<div class="col-md-6">
						<div class="card">
							<div class="card-header">
								<h3 class="card-title">
									Select User ID
								</h3>
							</div>
							<div class="card-body">
								<?php if($feed = $this->session->flashdata("Feed")){ ?>
									<span class="text-success"><?= $feed; ?></span>
								<?php } ?>
								<form action="<?= base_url('admin_panel/AddBalance/submitBal'); ?>" method="post">
									<div class="form-group">
										<label>Select User ID</label>
										<input type="text" name="userid" class="form-control" id="usr" autocomplete="off">
										<small class="text-danger" id="msg"></small>
										<div class="srcRes">
											<ul id="usrData"></ul>
										</div>
									</div>
									<div class="form-group">
										<label>Amount</label>
										<input type="text" name="amount" class="form-control">
									</div>
									<div class="form-group">
										<button id="bnt" class="btn btn-primary">Save</button>
									</div>
								</form>
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

					$.post("<?= base_url('admin_panel/AddBalance/getUser'); ?>",
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