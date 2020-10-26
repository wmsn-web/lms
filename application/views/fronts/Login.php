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
	        			<h4>Customer Login</h4><br>
	        			<?php if($feed = $this->session->flashdata("Feed")){ ?>
	        				<span class="text-danger"><?= $feed; ?></span>
	        			<?php } ?>
	        			<br>
	        			<form action="<?= base_url('UserLogin/Login'); ?>" method="post">
	        				<div class="input-group mb-3">
							  <div class="input-group-prepend">
							    <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
							  </div>
							  <input type="text" class="form-control" name="username" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" required="required">
							</div>
							<div class="input-group mb-3">
							  <div class="input-group-prepend">
							    <span class="input-group-text" id="basic-addon1"><i class="fa fa-key"></i></span>
							  </div>
							  <input type="password" class="form-control" name="password" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1"  required="required">
							</div>
							<button class="bnt bnt-primary">Login</button>
							<a class="text-danger" href="<?= base_url('ForgotPass'); ?>">Forgot Password?</a>
	        			</form>
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
</body>