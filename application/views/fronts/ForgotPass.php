<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Login | Samridhi - Apna Samridhi</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <?php include("inc/layout.php"); ?>
    <style type="text/css">
    	.dangerOut:focus
    	{
    		border-color: rgba(229, 103, 23, 0.8);
    box-shadow: 0 1px 1px rgba(229, 103, 23, 0.075) inset, 0 0 8px rgba(229, 103, 23, 0.6);
    outline: 0 none;
    	}
    </style>
</head>
<body>
    <!-- Start Header Area -->
    <?php include("inc/menu.php"); ?>
    <main>

        <!-- breadcrumb section start -->
        <section class="login">
        	<div class="container">
	        	<div class="row justify-content-center"> 
	        		<div class="col-md-4 login-bx">
	        			<h4>Reset Password</h4><br>
	        			<?php if($feed = $this->session->flashdata("Feed")){ ?>
	        				<span class="text-danger"><?= $feed; ?></span>
	        			<?php } ?>
	        			<br>
	        			<div id="usr">
	        				<span id="msg1"></span><br>
	        				<label>Please Enter your User ID</label>
	        				<div class="input-group mb-3">

							  <div class="input-group-prepend">
							    <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
							  </div>
							  <input type="text" class="form-control" name="username" placeholder="Please Enter your User ID" id="ussrId" aria-label="Username" aria-describedby="basic-addon1" required="required">
							</div>
							
							<button class="bnt bnt-primary" id="btn1">Submit</button>
							
	        			</div>
	        			<div id="otps">
	        				<span id="msg2"></span><br>
	        				<label>OTP has been sent to your mobile number</label>
	        				<div class="input-group mb-3">
							  <div class="input-group-prepend">
							    <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock"></i></span>
							  </div>
							  <input type="tel" class="form-control" id="ottp" placeholder="Please Enter OTP" aria-label="" aria-describedby="basic-addon1" required="required">
							</div>
							
							<button class="bnt bnt-primary" id="btn2">Submit OTP</button>
							<a href="javascript:void(0)" id="rsend">Resend</a>
	        			</div>
	        			<div id="rSetPass">
	        				<label>New Password</label>
	        				<div class="input-group mb-3">
							  <div class="input-group-prepend">
							    <span class="input-group-text" id="basic-addon1"><i class="fa fa-key"></i></span>
							  </div>
							  <input type="password" class="form-control" id="pass" placeholder="New Password" aria-label="" aria-describedby="basic-addon1" required="required">
							</div>

							<label>Confirm Password</label>
	        				<div class="input-group mb-3">
							  <div class="input-group-prepend">
							    <span class="input-group-text" id="basic-addon1"><i class="fa fa-key"></i></span>
							  </div>
							  <input type="password" class="form-control" id="conpass" placeholder="Confirm Password" aria-label="" aria-describedby="basic-addon1" required="required">
							</div>
							
							<button class="bnt bnt-primary" id="btn3">Change Passowrd</button>
	        			</div>
	        		</div>
	        	</div>
	        </div>
        </section>
    </main>
    <?php include("inc/footer.php"); ?>
    <!-- footer section end -->

    <!-- JS
============================================ -->

    <?php include("inc/js.php"); ?>
    <script type="text/javascript">
    	$(document).ready(function(){
    		$("#otps").hide();
    		$("#rSetPass").hide();
    		$("#btn1").click(function(){

    			userId = $("#ussrId").val();
    			$.post("<?= base_url('ForgotPass/sendOtp'); ?>",
    					{
    						userId: userId
    					},
    					function(response,status)
    					{
    						if(response == "inv")
    						{
    							$("#msg1").html("Invalid User ID");
    							$("#msg1").addClass("text-danger");
    						}
    						else
    						{
    							$("#usr").slideUp(200);
    							$("#otps").show(200);
    							$("#rSetPass").hide();
    						}
    					}
    				)
    			//$("#usr").slideUp(200);
    			//$("#otps").show(200);
    		});

    		$("#btn2").click(function(){
    			ottp = $("#ottp").val();
    			userId = $("#ussrId").val();
    			$.post("<?= base_url('ForgotPass/checkOTP'); ?>",
    					{
    						userId: userId,
    						ottp: ottp
    					},
    					function(response,status)
    					{
    						if(response == "invOtp")
    						{
    							$("#msg2").html("Invalid OTP You Entered! ");
    							$("#msg2").addClass("text-danger");
    						}
    						else
    						{
    							$("#usr").hide();
    							$("#otps").slideUp(200);
    							$("#rSetPass").show(200);
    						}
    					}
    				)
    		});

    		$("#rsend").click(function(){
    			$("#usr").show();
				$("#otps").hide(200);
				$("#rSetPass").hide(200);
				$("#ottp").val("");
    		});

    		$("#btn3").click(function(){
    			pass = $("#pass").val();
    			conpass = $("#conpass").val();
    			userId = $("#ussrId").val();
    			if(pass == "" | conpass == "")
    			{
    				$("#pass").focus();
    				$("#pass").addClass("dangerOut");

    				$("#conpass").focus();
    				$("#conpass").addClass("dangerOut");
    				alert("Please Enter atleast 8 character");
    			}
    			else
    			{
    				if(pass == conpass)
    				{
    					$.post("<?= base_url("ForgotPass/ChangePass"); ?>",
    							{
    								userId: userId,
    								pass: conpass
    							},
    							function(response,status)
    							{
    								location.href="<?= base_url('UserLogin'); ?>";
    							}
    						)
    					
    				}

    				else
    				{
    					alert("Password did not match!");
    					$("#conpass").focus();
    					$("#conpass").addClass("dangerOut");
    				}
    			}
    		});
    	});
    </script>
</body>