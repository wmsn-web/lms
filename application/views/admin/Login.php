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
		<div class="container-fluid">
			<div class="row justify-content-center">
				<div class="col-md-4">
					<div class="card">
						<div class="card-header text-center">
							<h3 class="card-title">Admin Login</h3>
						</div>
						<div class="card-body">
							<?php if($feed = $this->session->flashdata("Feed")){ ?>
								<span class="text-danger"><?= $feed; ?></span>
							<?php } ?>
							<form action="<?= base_url(); ?>admin_panel/Login/loginProcess?refer=<?= @$_GET['refer']; ?>" method="post">
								<div class="form-group">
									<label>Username</label>
									<input type="text" name="user" class="form-control" required="required">
								</div>
								<div class="form-group">
									<label>Password</label>
									<input type="password" name="pass" class="form-control" required="required">
								</div>
								<div class="form-group">
									<button class="btn btn-primary">Login</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php include("inc/js.php"); ?>
	</body>
</html>