<!doctype html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<?php include("inc/form_layout.php"); ?>
		<title> Admin Panel</title>
	</head>
	<body class="main-body app sidebar-mini Light-mode">
		<!--div id="global-loader" class="light-loader">
			<img src="<?= base_url(); ?>assets/img/loaders/loader.svg" class="loader-img" alt="Loader">
		</div-->
		<?php include("inc/sidemenu.php"); ?>
		<div class="main-content app-content">
			<?php include("inc/header.php"); ?>
			<div class="container-fluid">

				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Dashboard</h4><span class="text-muted mt-1 tx-13 ml-2 mb-0">/ Super Admin</span>
						</div>
					</div>
					
				</div>
				<!-- breadcrumb -->

				<!-- row -->
				<div class="row">
					<div class="col-md-4">
						<div class="card">
							<div class="card-header">
								<h3 class="card-title">
									Add Super Admin
								</h3>
							</div>
							<div class="card-body">
								<form action="<?= base_url('admin_panel/SuperAdmin/addAdmin'); ?>" method="post" enctype="multipart/form-data">
									<div class="form-group">
										<label>Admin ID</label>
										<input type="text" name="userAdmin" class="form-control" id="usr" autocomplete="off" required="required">
										<small class="text-danger" id="msg"></small>
										<div class="srcRes">
											<ul id="usrData"></ul>
										</div>
									</div>
									<div class="form-group">
										<label>Password</label><br>
										<input type="password" name="pass" id="pss" class="form-controls">
										<span onclick="pwdEye()" class="addon"><i id="icn" class="fas fa-eye-slash"></i></span>
									</div>
									<div class="form-group">

										<button class="btn btn-outline-primary">Add</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<div class="col-md-8">
						<div class="card">
							<div class="card-header">
								<h3 class="card-title">
									Super Admins
								</h3>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table table-bordered" id="example2">
										<thead>
											<tr>
												<th>SL</th>
												<th>Admin ID</th>
												<th>Name</th>
												<th>Action</th>
												
											</tr>
										</thead>
										<tbody>
											<?php if(!empty($data)): ?>
												<?php $s = 1; foreach($data as $key): $sl = $s++;
													if($key['status']==0)
													{
														$bg = "bg-danger-lite";
														$link = "<a onclick=\"return confirm('Unsuspend this user?')\" class='text-danger' href='".base_url('admin_panel/SuperAdmin/unsuspend/'.$key['id'])."'>Suspended</a>";
													}
													else
													{
														$bg = "bg-success-lite";
														$link = "<a onclick=\"return confirm('Suspend this user? User will not able to login.')\" class='text-success' href='".base_url('admin_panel/SuperAdmin/suspend/'.$key['id'])."'>Suspend</a>";
													}
												 ?>
													<tr class="<?= $bg; ?>">
														<td><?= $sl; ?></td>
														<td><?= $key['adminId']; ?></td>
														<td><?= $key['name']; ?></td>
														<td>
															<?= $link; ?>
														</td>
													</tr>
												<?php endforeach; ?>
											<?php endif; ?>
										</tbody>
										<tfoot>
											<tr>
												<th>SL</th>
												<th>Admin ID</th>
												<th>Name</th>
												<th>Action</th>
											</tr>
										</tfoot>
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
		</div>
		<?php include("inc/rightmenu.php"); ?>
		<?php include("inc/footer.php"); ?>
		<?php include("inc/form_js.php"); ?>
		<script type="text/javascript">
			$(document).ready(function(){
				$(".flashd").fadeOut(5000);
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
			function pwdEye()
				{
					var pwd = document.getElementById("pss");
					var attr = pwd.type;
					if(attr === "password")
					{
						pwd.type = "text";
						$("#icn").removeClass("fa-eye-slash");
						$("#icn").addClass("fa-eye");
					}
					else
					{
						pwd.type = "password";
						$("#icn").addClass("fa-eye-slash");
						$("#icn").removeClass("fa-eye");
					}
				}

				function getText(val)
		{
			$("#usr").val(val);
			$(".srcRes").hide();
			$("#bnt").attr("disabled",false);
			var userId = val;
			$.post("<?= base_url('admin_panel/SubmitPurchase/getWallet'); ?>",
						{
							userId: userId
						},
						function(response,status)
						{
							$("#wlBal").html("Wallet Balance: &#8377;"+response);
							$("#hideSpan").html(response);
						}

				)
		}
		function lnkconfirm()
		{
			return confirm('Uuu')
		}
		</script>
	</body>
</html>