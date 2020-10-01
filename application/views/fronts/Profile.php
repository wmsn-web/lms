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
        <div class="breadcrumb-area bg-img" data-bg="<?= base_url('front_assets/images/blog/page-banner.jpg'); ?>">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-wrap">
                            <nav aria-label="breadcrumb">
                                <h2 class="breadcrumb-title">My Account | Profile</h2>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">My Account | Profile</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb section end -->
        <section class="about-wrapper-area section-padding">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12 order-2 order-lg-1">
                        <div class="about-inner">
                           <h2 class="h1 title">Welcome <span>Name</span></h2><br>
                           <div class="row">
                              <div class="col-md-6 login-bx">
                                <h3>Dashboard</h3>
                                <div class="row">
                                  <div class="col-lg-4 col-md-6 text-center">
                                    <div class="service-policy-item cp mt-30">
                                        <div class="service-policy-icon">
                                            <span><?= $dashData['downline']; ?></span>
                                        </div>
                                        <h3 class="service-policy-title">Down Line<br>
                                        <small><a href="<?= base_url('Profile/Downline/'.$proData['userId']); ?>">View Downline</a></small></h3>
                                    </div>
                                  </div>
                                  <div class="col-lg-4 col-md-6 text-center">
                                    <div class="service-policy-item cp mt-30">
                                        <div class="service-policy-icon">
                                            <span>&#8377; <?= $dashData['walletBalance']; ?>/-</span>
                                        </div>
                                        <h3 class="service-policy-title">Wallet Balance
                                        <br><small><a href="<?= base_url('Profile/RequestWidthdraw/'.$proData['userId']); ?>">Request Widthdraw</a></small></h3>
                                    </div>
                                  </div>
                                  <div onclick="location.href='<?= base_url('Profile/MyBusiness'); ?>'" class="col-lg-4 col-md-6 text-center">
                                    <div class="service-policy-item cp mt-30">
                                        <div class="service-policy-icon">
                                            <span>&#8377; <?= $dashData['business']; ?>/-</span>
                                        </div>
                                        <h3 class="service-policy-title">Total Business
                                          <br><small>(<?= $yrmnth; ?>)</small></h3>
                                    </div>
                                  </div>
                                  
                                </div>
                              </div>
                           		<div class="col-md-6 login-bx">
                                <div id="profileDiv">
                           			<h3>My Profile Details</h3><br>
                           			<div class="row">
                           				<div class="form-froup col-sm-6">
                           					<label><b>Full Name:</b> <em><?= $proData['name']; ?></em> </label>
                           				</div>
                           				<div class="form-froup col-sm-6">
                           					<label><b>Father's Name:</b> <em><?= $proData['father_name']; ?></em></label>
                           				</div>
                           				<div class="form-froup col-sm-6">
                           					<label><b>Email Address:</b> <em><?= $proData['email']; ?></em></label>
                           				</div>
                           				<div class="form-froup col-sm-6">
                           					<label><b>Mobile:</b> <em><?= $proData['phone']; ?></em></label>
                           				</div>
                           				<div class="form-froup col-sm-6">
                           					<label><b>Address:</b> <em><?= $proData['address']; ?></em></label>
                           				</div>
                           				<div class="form-froup col-sm-6">
                           					<label><b>Gender:</b> <em><?= $proData['gender']; ?></em></label>
                           				</div>
                           				<div class="form-froup col-sm-6">
                           					<label><b>Date of Birth:</b> <em><?= $proData['dob']; ?></em></label>
                           				</div>
                           				<div class="form-froup col-sm-6">
                           					<label><b>User ID:</b> <em><?= $proData['userId']; ?></em></label>
                           				</div>
                           				<div class="form-froup col-sm-6">
                           					<label><b>Sponsor Name:</b> <em><?= $proData['sponsor']; ?></em></label>
                           				</div>
                           				<div class="form-froup col-sm-6">
                           					<label><b>Level:</b> <em>CL-<?= $proData['level']; ?></em></label>
                           				</div>
                           				
                           				<div class="form-froup col-sm-12 top-seperate">
                           					<label><b>Bank Details</b></label>
                           				</div>
                                  <?php
                                    if($proData['bank']=="" || $proData['ac_no']=="" || $proData['ifsc']==""):
                                  ?>

                                  
                                   
                                      <div class="form-group  col-sm-6">
                                        <label>Bank Name</label>
                                        <input type="text" id="bank" class="form-control" value="<?= $proData['bank']; ?>">
                                      </div>
                                      <div class="form-group  col-sm-6">
                                        <label>IFSC</label>
                                        <input type="text" id="ifsc" class="form-control"  value="<?= $proData['ifsc']; ?>">
                                      </div>
                                      <div class="form-group  col-sm-6">
                                        <label>A/c No</label>
                                        <input type="text" id="ac_no" class="form-control"  value="<?= $proData['ac_no']; ?>">
                                      </div>
                                      <input type="hidden" id="userId" value="<?= $proData['userId']; ?>">
                                      <div class="form-group  col-sm-12">
                                        <button id="adbnk" class="bnt bnt-primary"><i class="fa fa-save"></i> Save</button>
                                        <img id="loadr" src="<?= base_url('assets/img/loader.gif'); ?>" width="25">
                                      </div>
                                  
                                  <?php else: ?>
                           				<div class="form-froup col-sm-6">
                           					<label><b>Bank Name:</b> <em><?= $proData['bank']; ?></em></label>
                           				</div>
                           				<div class="form-froup col-sm-6">
                           					<label><b>A/C No:</b> <em><?= $proData['ac_no']; ?></em></label>
                           				</div>
                           				<div class="form-froup col-sm-6">
                           					<label><b>IFSC Code:</b> <em><?= $proData['ifsc']; ?></em></label>
                           				</div>
                                <?php endif; ?>
                           			</div>
                                <!--Row-->
                                </div><!--ProfileDiv-->
                                <div id="chpassDiv">
                                  <div class="container">
                                    <h3>Change Password</h3><br>
                                    <div class="form-group col-sm-12">
                                            <span class="text-danger">After Change password you will be logout from your account. Re-login with your new password.</span>
                                          </div>
                                    <form action="<?= base_url('Profile/ChangePass'); ?>" method="post">
                                      <div class="row  top-seperate">
                                          <div class="form-group col-sm-6">
                                            <label>New Password</label>
                                            <input type="password" id="pass" name="pass" class="form-control">
                                          </div>
                                          <div class="form-group col-sm-6">
                                            <label>Confirm Password</label>
                                            <input type="password" id="conpass"  class="form-control">
                                            <input type="hidden" name="userId" value="<?= $proData['userId']; ?>">
                                          </div>
                                          <div class="form-group col-sm-6">
                                            <span id="msg" class="text-danger"></span><br>
                                            <button id="subBtn" type="submit" class="bnt bnt-primary">Change</button>
                                          </div>
                                          <div class="form-group col-sm-6">
                                            <br>
                                            <button id="cncl" type="button" class="bnt bnt-danger">Cancel</button>
                                          </div>
                                          
                                      </div>
                                    </form>
                                  </div>
                                </div>
                                <div class="form-group col-sm-12 top-seperate">
                                    <label><a href="javascript:void(0)" id="viewChapass">Change Password</a></label>
                                  </div>
                           		</div>
                           		
                           </div>
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
        $("#loadr").hide();
        $("#chpassDiv").hide();
        $("#adbnk").click(function(){
          $("#adbnk").hide();
          $("#loadr").show();
          var userId = $("#userId").val();
          var bank = $("#bank").val();
          var ifsc = $("#ifsc").val();
          var ac_no = $("#ac_no").val();
          $.post("<?= base_url('Profile/addBank'); ?>",
            {
              userId: userId,
              bank: bank,
              ifsc: ifsc,
              ac_no: ac_no
            },
            function(response,status)
            {
              location.href="<?= base_url('Profile'); ?>"
            }
          )
        });
        $("#viewChapass").click(function(){
            $("#profileDiv").hide(200);
            $("#chpassDiv").show(200);
        });
        $("#cncl").click(function(){
            $("#profileDiv").show(200);
            $("#chpassDiv").hide(200);
        });
        $("#conpass").keyup(function(){

          var pass = $("#pass").val();
          var conpas = $("#conpass").val();
          //alert(pass)
          if(conpas === pass)
          {
            $("#subBtn").attr("disabled",false);
            $("#msg").html("");
          }
          else
          {
            $("#subBtn").attr("disabled",true);
            $("#msg").html("Password does not match!");
          }
        });
    	});
    </script>
</body>