<!doctype html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<?php include("inc/layout.php"); ?>
		<title>Tree- Admin Panel</title>
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
							<h4 class="content-title mb-0 my-auto">Home</h4><span class="text-muted mt-1 tx-13 ml-2 mb-0">/ Members Tree</span>
						</div>
					</div>
					
				</div>
				<!-- breadcrumb -->

				<!-- row -->
				<div class="row">
					<div class="">
						<div align="">
							<div class="tree">
                            <ul>
                              <li>
                                <a href="#">
                                  <i class="fa fa-user"></i><br>
                                  <?= @$treeData['mainUser']['name']; ?></a>
                                <ul>
                                  <?php if(!empty($treeData['firstRow'])): ?>
                                    <?php foreach ($treeData['firstRow'] as $key1) { ?>
                                    
                                    <li>
                                      <a href="<?= base_url('admin_panel/MembersTree/index/'.$key1['usrId']); ?>"><i class="fa fa-user"></i><br><?= substr($key1['name'],0,5); ?></a>
                                      <ul class="extraSmall">
                                        <?php if(!empty($key1['secRow'])): ?>
                                          <?php foreach ($key1['secRow'] as $key2) { ?>
                                            <li>
                                              <a href="<?= base_url('admin_panel/MembersTree/index/'.$key2['usrId']); ?>"><i class="fa fa-user"></i><br><?= $key2['name']; ?></a>
                                            </li>
                                          <?php } ?>
                                        <?php endif; ?>
                                        
                                      </ul>
                                    </li>
                                  <?php } ?>
                                  <?php endif; ?>
                                  
                                </ul>
                              </li>
                            </ul>
                          
                        </ul>
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
	</body>
</html>