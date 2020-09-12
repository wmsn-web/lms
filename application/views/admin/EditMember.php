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
							<h4 class="content-title mb-0 my-auto">Dashboard</h4><span class="text-muted mt-1 tx-13 ml-2 mb-0">/ Update Members</span>
						</div>
					</div>
					
				</div>
				<!-- breadcrumb -->


				<!-- row -->
				<div class="row justify-content-center">
					<div class="col-md-8">
					<div class="card">
						<div class="card-header text-center">
							<h3 class="card-title">Update Members</h3>
						</div>
						<div class="card-body">
							<?php if($feed = $this->session->flashdata("Feed")){ ?>
								<span class="text-danger"><?= $feed; ?></span> 
							<?php } ?>
							<?php if(isset($_GET['under'])){ ?>
								<?php
					if($row->left == NULL){ $disp1 = "";}
					elseif($data['side']=="left"){$disp1 = "checked";}
					else{$disp1="disabled";}
					if($row->right == ""){ $disp2 = "";}
					elseif($data['side']=="right"){$disp2 = "checked";}
					else{$disp2 = "disabled";}
					if($row->three == ""){ $disp3 = "";}
					elseif($data['side']=="three"){$disp3 = "checked";}
					else{$disp3 = "disabled";}
					if($row->fourth == ""){ $disp4 = "";}
					elseif($data['side']=="fourth"){$disp4 = "checked";}
					else{$disp4 = "disabled";}
					if($row->fifth == ""){ $disp5 = "";}
					elseif($data['side']=="fifth"){$disp5 = "checked";}
					else{$disp5 = "disabled";}
					if($row->sixth == ""){ $disp6 = "";}
					elseif($data['side']=="sixth"){$disp6 = "disabled";}
					else{$disp6 = "disabled";}
					if($row->seventh == ""){ $disp7 = "";}
					elseif($data['side']=="seventh"){$disp7 = "disabled";}
					else{$disp7 = "disabled";}
					if($row->eighth == ""){ $disp8 = "";}
					elseif($data['side']=="eighth"){$disp8 = "disabled";}
					else{$disp5 = "disabled";}
					if($row->ninth == ""){ $disp9 = "";}
					elseif($data['side']=="ninth"){$disp9 = "disabled";}
					else{$disp9 = "disabled";}
					if($row->tenth == ""){ $disp10 = "";}
					elseif($data['side']=="tenth"){$disp10 = "disabled";}
					else{$disp10 = "disabled";}
					
				?>
							<form action="<?= base_url('admin_panel/EditMember/UpdateMem'); ?>" method="post">
								<div class="row">
									<div class="form-group col-md-12">
										<h5 class="card-title">Personal Information</h5>
									</div>
								<div class="form-group col-md-6">
									<label>Full Name</label>
									<input type="text" name="name" class="form-control" required="required" value="<?= $data['name']; ?>">
								</div>
								<div class="form-group col-md-6">
									<label>Father's Name</label>
									<input type="text" name="fathName" class="form-control" required="required" value="<?= $data['father']; ?>">
								</div>
								<div class="form-group col-md-4">
									<label>Date of Birth</label>
									<input type="date" name="dob" class="form-control" required="required" value="<?= $data['dob']; ?>">
								</div>
								<div class="form-group col-md-4">
									<label>Gender</label>
									<?php
										if($data['gender']=="Male")
										{
											$slctMale = "selected";
											$slctFemale = "";
										}
										else
										{
											$slctMale = "";
											$slctFemale = "selected";
										}
									?>
									<select name="gender" class="form-control" required="required">
										<option value="">Select</option>
										<option <?= $slctMale; ?> value="Male">Male</option>
										<option <?= $slctFemale; ?> value="Female">Female</option>
									</select>
								</div>
								<div class="form-group col-md-4">
									<label>Member Type</label>
									<?php
										if($data['memType']=="Free")
										{
											$slctFree = "selected";
											$slctPkg = "";
										}
										else
										{
											$slctFree = "";
											$slctPkg = "selected";
											if($data['level'] > 1)
											{
												$readOnly = "readonly";
												$disbl = "disabled";
											}
											else
											{
												$readOnly = "";
												$disbl = "";
											}
										}
									?>
									<select name="memType" class="form-control" <?= $readOnly; ?> required="required">
										<option value="">Select</option>
										<option<?= $disbl; ?> <?= $slctFree; ?> value="Free">Free</option>
										<option <?= $slctPkg; ?> value="Package">Package</option>
									</select>
								</div>
								<div class="form-group col-md-12">
									<label>Address</label>
									<input type="text" name="addr" class="form-control" required="required" value="<?= $data['address']; ?>">
								</div>
								<div class="form-group col-md-12">
										<h5 class="card-title">Contact Information</h5>
									</div>
								<div class="form-group col-md-6">
									<label>Mobile Number</label>
									<input type="text" name="phone" maxlength="10" class="form-control" required="required" value="<?= $data['phone']; ?>" >
								</div>
								<div class="form-group col-md-6">
									<label>Email Address</label>
									<input type="email" name="email"  class="form-control" required="required" value="<?= $data['email']; ?>">
								</div>
								
								
								<hr>
								<div class="form-group col-md-12">
									<h5 class="card-title">Bank Details</h5>
								</div>
									<div class="form-group col-md-6">
										<label>Bank Name</label>
										<input type="text" name="bank" class="form-control" required="required" value="<?= $data['bank']; ?>">
								    </div>
								    <div class="form-group col-md-6">
										<label>IFSC Code</label>
										<input type="text" name="ifsc" class="form-control" required="required" value="<?= $data['ifsc']; ?>">
								    </div>
								    <div class="form-group col-md-6">
										<label>Account Number</label>
										<input type="text" id="ac" name="ac_no" class="form-control" required="required" value="<?= $data['ac_no']; ?>">
								    </div>
								    <div class="form-group col-md-6">
										<label>Confirm Account Number <small id="msg"></small></label>
										<input type="text" id="conAc" name="" class="form-control" required="required" value="<?= $data['ac_no']; ?>">
								    </div>
								    <input type="hidden" name="userid" value="<?= $data['userId']; ?>">
								    <input type="hidden" name="under" value="<?=  $_GET['under']; ?>">
								
								<div class="form-group col-md-12">
									<button id="reg" class="btn btn-primary">Update</button><br>
									
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