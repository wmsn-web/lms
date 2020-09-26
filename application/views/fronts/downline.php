<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Profile | Samridhi - Apna Samridhi</title>
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
      <?php
        date_default_timezone_set("Asia/Kolkata");
        $date = date('Y-m-d');
        $dt = date_create($date);
        $yrmnth = date_format($dt,"F")."-".date_format($dt,'Y');
      ?>
        <!-- breadcrumb section start -->
        <div class="breadcrumb-area top-45">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                      <div align="center" class="myTree">
                        <h2>Customer Tree View</h2>
                          <div class="tree">
                            <ul>
                              <li>
                                <a href="#">
                                  <i class="fa fa-user"></i><br>
                                  <?= $treeData['mainUser']['name']; ?></a>
                                <ul>
                                  <?php if(!empty($treeData['firstRow'])): ?>
                                    <?php foreach ($treeData['firstRow'] as $key1) { ?>
                                    
                                    <li>
                                      <a href="<?= base_url('Profile/Downline/'.$key1['usrId']); ?>"><i class="fa fa-user"></i><br><?= $key1['name']; ?></a>
                                      <ul>
                                        <?php if(!empty($key1['secRow'])): ?>
                                          <?php foreach ($key1['secRow'] as $key2) { ?>
                                            <li>
                                              <a href="<?= base_url('Profile/Downline/'.$key2['usrId']); ?>"><i class="fa fa-user"></i><br><?= $key2['name']; ?></a>
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
                          </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb section end -->
        
    </main>
    <?php include("inc/footer.php"); ?>
    <!-- footer section end -->

    <!-- JS
============================================ -->

    <?php include("inc/js.php"); ?>
    <script type="text/javascript">
    	$(document).ready(function(){
        
    	});
    </script>
</body>