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
							<h4 class="content-title mb-0 my-auto">Dashboard</h4><span class="text-muted mt-1 tx-13 ml-2 mb-0">/ Withdraw Request</span>
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
									Withdraw Request
								</h3>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table table-bordered" id="example">
										<thead>
											<tr>
												<th>SL</th>
												<th>Date</th>
												<th>User ID</th>
												<th>Notes</th>
												<th>Amount</th>
												<th>Action</th>
												
											</tr>
										</thead>
										<tbody>
											<?php if(!empty($data)){ ?>
												<?php $s = 1;
												 foreach($data as $key) { $sl = $s++; ?>
													<tr id="ttr_<?= $sl; ?>">
														<td><?= $sl; ?></td>
														<td><?= $key['date']; ?></td>
														<td><?= $key['userId']; ?></td>
														<td><?= $key['notes']; ?></td>
														<td>&#8377;<?= number_format($key['amount'],2); ?></td>
														<td><button id="ac_<?= $key['id']; ?>_<?= $sl; ?>" class="btn btn-success accept">Accept</button>
															<button id="cn_<?= $key['id']; ?>_<?= $sl; ?>" class="btn btn-danger cancel">Cancel</button></td>
														
													</tr>
											    <?php } ?>
											<?php } ?>
										</tbody>
										<tfoot>
											<tr>
												<th>SL</th>
												<th>Date</th>
												<th>User ID</th>
												<th>Notes</th>
												<th>Amount</th>
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
			</div>
			<!-- Container closed -->
		</div>
		<?php include("inc/rightmenu.php"); ?>
		<?php include("inc/footer.php"); ?>
		<?php include("inc/table_js.php"); ?>
		<script type="text/javascript">
			$(document).ready(function(){
				$(".accept").click(function(){
					permisn =  confirm('Confirm this request?');
					if(permisn == true)
					{
						var ids = this.id;
						spl = ids.split("_");
						id = spl[1];
						trId = "ttr_"+spl[2];
						$.post("<?= base_url('admin_panel/WithdrawRequest/acceptRequest'); ?>",
								{
									id: id
								},
								function(response,status)
								{
									alert("Request Accepted");
									location.href="<?= base_url('admin_panel/WithdrawRequest/'); ?>";
								}
						)
					}
					else
					{
						
						alert("Request Accepted");
						location.href="<?= base_url('admin_panel/WithdrawRequest/'); ?>";
					}
				});

				//If Cancel
				$(".cancel").click(function(){
					permisn =  confirm('Are you Confirm delete this request?');
					if(permisn == true)
					{
						var ids = this.id;
						spl = ids.split("_");
						id = spl[1];
						trId = "ttr_"+spl[2];
						$.post("<?= base_url('admin_panel/WithdrawRequest/deleteRequest'); ?>",
								{
									id: id
								},
								function(response,status)
								{
									alert("Request Deleted");
									location.href="<?= base_url('admin_panel/WithdrawRequest/'); ?>";
								}
						)
					}
					else
					{
						
						alert("Request Deleted");
						location.href="<?= base_url('admin_panel/WithdrawRequest/'); ?>";
					}
				});
			});
		</script>
	</body>
</html>