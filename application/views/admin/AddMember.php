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
							<h4 class="content-title mb-0 my-auto">Dashboard</h4><span class="text-muted mt-1 tx-13 ml-2 mb-0">/ Add Members</span>
						</div>
					</div>
					
				</div>
				<!-- breadcrumb -->


				<!-- row -->
				<div class="row justify-content-center">
					<div class="col-md-8">
					<div class="card">
						<div class="card-header text-center">
							<h3 class="card-title">Add Members</h3>
						</div>
						<div class="card-body">
							<?php if($feed = $this->session->flashdata("Feed")){ ?>
								<span class="text-danger"><?= $feed; ?></span>
							<?php } ?>
							<?php if(isset($_GET['under'])){ ?>
								<?php
					if($row->left == NULL){ $disp1 = "style='display:inline-block'";}else{$disp1="style='display:none'";}
					if($row->right == ""){ $disp2 = "style='display:inline-block'";}else{$disp2 = "style='display:none'";}
					if($row->three == ""){ $disp3 = "style='display:inline-block'";}else{$disp3 = "style='display:none'";}
					if($row->fourth == ""){ $disp4 = "style='display:inline-block'";}else{$disp4 = "style='display:none'";}
					if($row->fifth == ""){ $disp5 = "style='display:inline-block'";}else{$disp5 = "style='display:none'";}
					if($row->sixth == ""){ $disp6 = "style='display:inline-block'";}else{$disp6 = "style='display:none'";}
					if($row->seventh == ""){ $disp7 = "style='display:inline-block'";}else{$disp7 = "style='display:none'";}
					if($row->eighth == ""){ $disp8 = "style='display:inline-block'";}else{$disp5 = "style='display:none'";}
					if($row->ninth == ""){ $disp9 = "style='display:inline-block'";}else{$disp9 = "style='display:none'";}
					if($row->tenth == ""){ $disp10 = "style='display:inline-block'";}else{$disp10 = "style='display:none'";}
					
				?>
							<form action="<?= base_url('admin_panel/AddMember/insertMem'); ?>" method="post">
								<div class="row">
									<div class="form-group col-md-12">
										<h5 class="card-title">Personal Information</h5>
									</div>
								<div class="form-group col-md-6">
									<label>Full Name</label>
									<input type="text" name="name" class="form-control" required="required">
								</div>
								<div class="form-group col-md-6">
									<label>Father's Name</label>
									<input type="text" name="fathName" class="form-control" required="required">
								</div>
								<div class="form-group col-md-4">
									<label>Date of Birth</label>
									<input type="date" name="dob" class="form-control" required="required">
								</div>
								<div class="form-group col-md-4">
									<label>Gender</label>
									<select name="gender" class="form-control" required="required">
										<option value="">Select</option>
										<option value="Male">Male</option>
										<option value="Female">Female</option>
									</select>
								</div>
								<div class="form-group col-md-4">
									<label>Member Type</label>
									<select name="memType" class="form-control" required="required">
										<option value="">Select</option>
										<option value="Free">Free</option>
										<option value="Package">Package</option>
									</select>
								</div>
								<div class="form-group col-md-12">
									<label>Address</label>
									<input type="text" name="addr" class="form-control" required="required">
								</div>
								<div class="form-group col-md-12">
										<h5 class="card-title">Contact Information</h5>
									</div>
								<div class="form-group col-md-6">
									<label>Mobile Number</label>
									<input type="text" name="phone" maxlength="10" class="form-control" required="required">
								</div>
								<div class="form-group col-md-6">
									<label>Email Address</label>
									<input type="email" name="email"  class="form-control" required="required">
								</div>
								
								<div class="form-group col-md-12">
									<label>Select Position</label><?= nbs(2); ?>
									<div class="pos">
									<span <?= $disp1; ?> >
										<input type="radio" value="left" name="side"> 1st
									</span>
									<span <?= $disp2; ?> >
			    						<input type="radio" value="right" name="side"> 2nd
			    					</span>
			    					<span <?= $disp3; ?> >
			    						<input type="radio" value="three" name="side"> 3rd
			    					</span>
			    					<span <?= $disp4; ?> >
			    						<input type="radio" value="fourth" name="side"> 4th
			    					</span>
			    					<span <?= $disp5; ?> >
			    						<input type="radio" value="fifth" name="side"> 5th
			    					</span>
			    					<span <?= $disp6; ?> >
			    						<input type="radio" value="sixth" name="side"> 6th
			    					</span>
			    					<span <?= $disp7; ?> >
			    						<input type="radio" value="seventh" name="side"> 7th
			    					</span>
			    					<span <?= $disp8; ?> >
			    						<input type="radio" value="eighth" name="side"> 8th
			    					</span>
			    					<span <?= $disp9; ?> >
			    						<input type="radio" value="ninth" name="side"> 9th
			    					</span>
			    					<span <?= $disp10; ?> >
			    						<input type="radio" value="tenth" name="side"> 10th
			    					</span>
			    				</div>
								</div>
								<hr>
								<div class="form-group col-md-12">
									<h5 class="card-title">Bank Details</h5>
								</div>
									<div class="form-group col-md-6">
										<label>Bank Name</label>
										<input type="text" name="bank" class="form-control">
								    </div>
								    <div class="form-group col-md-6">
										<label>IFSC Code</label>
										<input type="text" name="ifsc" class="form-control">
								    </div>
								    <div class="form-group col-md-6">
										<label>Account Number</label>
										<input type="text" id="ac" name="ac_no" class="form-control">
								    </div>
								    <div class="form-group col-md-6">
										<label>Confirm Account Number <small id="msg"></small></label>
										<input type="text" id="conAc" name="" class="form-control">
								    </div>
								    <input type="hidden" name="userid" value="<?=  "SM-".mt_rand(100000000,99999999999); ?>">
								    <input type="hidden" name="under" value="<?=  $_GET['under']; ?>">
								
								<div class="form-group col-md-12">
									<button id="reg" class="btn btn-primary">Register</button><br>
									
								</div>
							</form>
						<?php }else{ ?>
							<form action="<?= base_url('admin_panel/AddMember/'); ?>" method="get">
								<div class="form-group col-md-12">
									<label>Sponsor ID</label>
									<input type="text" name="under"  class="form-control" required="required"  id="usr" autocomplete="off">
										<small class="text-danger" id="msg"></small>
										<div class="srcRes">
											<ul id="usrData"></ul>
										</div>
								</div>
								<div class="form-group col-md-12">
									<button id="bnt" class="btn btn-primary">Next</button>
								</div>
							</form>
						<?php } ?>
						</div>
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
				$("#ac").blur(function(){
					$("#ac").removeAttr("type","text");
					$("#ac").attr("type","password");
				});
				$("#ac").focus(function(){
					$("#ac").removeAttr("type","password");
					$("#ac").attr("type","text");
				});
				$("#conAc").keyup(function(){
					var ac = $("#ac").val();
					var conAc = $("#conAc").val()
					if(conAc == ac)
					{
						$("#msg").html("Account Number Matched.");
						$("#msg").css("color","#090");
						$("#reg").attr("disabled",false);
					}
					else
					{
						$("#msg").html("Does Not Match!.");
						$("#msg").css("color","#f00");
						$("#reg").attr("disabled",true);
					}
				});

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