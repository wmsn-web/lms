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
							<h4 class="content-title mb-0 my-auto">Dashboard</h4><span class="text-muted mt-1 tx-13 ml-2 mb-0">/ All Products</span>
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
									Edit Products
									<span class="right"><a href="<?= base_url('admin_panel/AddProducts/'); ?>">Add New Product</a></span>
								</h3>
							</div>
							<div class="card-body">
								<form action="<?= base_url('admin_panel/AddProducts/edPro'); ?>" method="post" enctype="multipart/form-data">
									<div class="form-group">
										<label>Product Name</label>
										<input type="text" name="proName" class="form-control" value="<?= $proData['pro_name']; ?>">
									</div>
									<div class="form-group">
										<label>Select Category</label>
										<select name="catId" class="form-control">
											<option>Select Category</option>
											<?php
												foreach($cats as $cat):
												if($cat['id'] == $proData['cat_id'])
												{
													$slct = "selected";
												}
												else
												{
													$slct = "";
												}
											?>
											<option <?= $slct; ?> value="<?= $cat['id']; ?>"><?= $cat['cat_name']; ?></option>
											<?php endforeach; ?>
										</select>
									</div>
									<div class="form-group">
										<label>Select Product Image</label>
										<input type="file" name="pro_mg" class="dropify" data-height="100" data-default-file="<?= base_url('uploads/products/'.$proData['img']); ?>" />
									</div>
									<input type="hidden" name="id" value="<?= $this->uri->segment(4); ?>">
									<div class="form-group">
										<button class="btn btn-outline-primary">Save</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<div class="col-md-8">
						<div class="card">
							<div class="card-header">
								<h3 class="card-title">
									All Products
								</h3>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table table-bordered" id="example2">
										<thead>
											<tr>
												<th>SL</th>
												<th>Category Name</th>
												<th>Product Name</th>
												<th>Image</th>
												<th>Action</th>
												
											</tr>
										</thead>
										<tbody>
											<?php if(!empty($data)): ?>
												<?php $s = 1; foreach($data as $key): $sl = $s++;
												if($this->uri->segment(4)==$key['id'])
													{
														$opc = "opacity: 0.25";
													}
													else
													{
														$opc = "opacity: 1";
													}
												 ?>
													<tr style="<?= $opc; ?>">
														<td><?= $sl; ?></td>
														<td><?= $key['cat_name']; ?></td>
														<td><?= $key['pro_name']; ?></td>
														<td><img src="<?= base_url('uploads/products/'.$key['img']); ?>" width="65"></td>
														<td>
															<a href="<?= base_url('admin_panel/AddProducts/index/'.$key['id']); ?>">
																<i class="fas fa-pen"></i> Edit
															</a>
														</td>
													</tr>
												<?php endforeach; ?>
											<?php endif; ?>
										</tbody>
										<tfoot>
											<tr>
												<th>SL</th>
												<th>Category Name</th>
												<th>Product Name</th>
												<th>Image</th>
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
			});
		</script>
	</body>
</html>