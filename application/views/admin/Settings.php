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
							<h4 class="content-title mb-0 my-auto">Dashboard</h4><span class="text-muted mt-1 tx-13 ml-2 mb-0">/ Settings</span>
						</div>
					</div>
					
				</div>
				<!-- breadcrumb -->

				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header">
								<h5 class="card-title">Settings</h5>
							</div>
							<div class="card-body">
								<div class="row">
									<div class="col-md-3">
										<form action="<?= base_url('admin_panel/Settings/updateSetup'); ?>" method="post">
											<?php 
												$set = $this->db->get("settings")->row();
											?>
											<div class="form-group">
												<label>Change Level Duration</label>
												<input type="number" name="duration" class="form-control" value="<?= $set->level_chng_duration; ?>">
											</div>
											<div class="form-group">
												<button class="btn btn-outline-primary">Save</button>
											</div>
										</form>
									</div>
									<div class="col-md-9">
										<div class="form-group">
											<label>Level Scheme Setting</label>
											<div class="table-responsive">
												<table class="table table-bordered">
													<tr>
														<th>Rank</th>
														<th>S.P.C.B</th>
														<th>T.P.C.B</th>
														<th>P.Target</th>
														<th>Action</th>
													</tr>
													<?php
														$gtlvlSetUp = $this->db->get("level_setup")->result();
														foreach($gtlvlSetUp as $gtLvl):
													?>
														<tr>
															<td><input type="text" class="tblInput" id="lv_<?= $gtLvl->id; ?>" value="<?= $gtLvl->level; ?>"></td>
															<td><input type="text" class="tblInput" id="sp_<?= $gtLvl->id; ?>" value="<?= $gtLvl->spcb; ?>"></td>
															<td><input type="text" class="tblInput" id="tp_<?= $gtLvl->id; ?>" value="<?= $gtLvl->tpcb; ?>"></td>
															<td><input type="text" class="tblInput" id="tr_<?= $gtLvl->id; ?>" value="<?= $gtLvl->target; ?>"></td>
															<td><button class="btn btn-outline-primary">Save</button></td>
														</tr>
													<?php endforeach; ?>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div id="fls" class="flashd">Setup Updated</div>
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
		<?php include("inc/js.php"); ?>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#fls").hide();
				$(".tblInput").blur(function(){
					ids = this.id;
					spl = ids.split("_");
					tblRow = spl[0];
					id = spl[1];
					tdval = this.value;
					$.post("<?= base_url('admin_panel/Settings/UpdateLevelSetup'); ?>",
							{
								tblRow: tblRow,
								id: id,
								tdval: tdval
							},
							function(response,status)
							{
								if(response=="done")
								{
									$("#fls").show();
									$("#fls").fadeOut(5000);
								}
							}
					) 
				});
			});
		</script>
	</body>
</html>