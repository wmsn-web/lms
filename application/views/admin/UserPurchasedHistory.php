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
							<h4 class="content-title mb-0 my-auto">Dashboard</h4><span class="text-muted mt-1 tx-13 ml-2 mb-0">/ All User Purchased History</span>
						</div>
					</div>
					
				</div>
				<!-- breadcrumb -->

				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header">
								<h4 class="card-title">
									All User Purchased History
								</h4>
							</div>
							<div class="card-body">
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
		</div>
		<?php include("inc/rightmenu.php"); ?>
		<?php include("inc/footer.php"); ?>
		<?php include("inc/table_js.php"); ?>
	</body>
</html>