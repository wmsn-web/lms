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
							<h4 class="content-title mb-0 my-auto">Dashboard</h4><span class="text-muted mt-1 tx-13 ml-2 mb-0">/ All Members</span>
						</div>
					</div>
					
				</div>
				<!-- breadcrumb -->

				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header">
								<h3 class="card-title">
									All Members
								</h3>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table table-bordered" id="example">
										<thead>
											<tr>
												<th>Join Date</th>
												<th>User ID</th>
												<th>Full Name</th>
												<th>Mobile Number</th>
												<th>Under User</th>
												<th>Down Count</th>
												<th>business Amount</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach($data as $key) { ?>
												<tr>
													<td><?= $key['join_date']; ?></td>
													<td><?= $key['user_id']; ?></td>
													<td><?= $key['name']; ?></td>
													<td><?= $key['mobile']; ?></td>
													<td><?= $key['under']; ?></td>
													<td><?= $key['total']; ?></td>
													<td><?= $key['income']; ?></td>
												</tr>
										    <?php } ?>
										</tbody>
										<tfoot>
											<tr>
												<th>Join Date</th>
												<th>User ID</th>
												<th>Full Name</th>
												<th>Mobile Number</th>
												<th>Under User</th>
												<th>Down Count</th>
												<th>business Amount</th>
											</tr>
										</tfoot>
									</table>
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
		<?php include("inc/table_js.php"); ?>
	</body>
</html>