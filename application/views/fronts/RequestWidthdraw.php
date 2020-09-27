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
                    <div class="col-md-4">
                      <div class="card">
                          <div class="card-header">
                              <h4 class="card-title">Request Withdraw</h4>
                          </div>
                          <div class="card-body">
                            <?php if($feed = $this->session->flashdata("Feed")){ ?>
                                <span class="text-success"><?= $feed; ?></span>
                            <?php } ?>
                            <marquee class="marquee" onmouseover="this.stop();" onmouseout="this.start();">
                                <span class="text-danger">You can use you wallet balance for purchase from store. Withdraw request will be confirmed within 48 hour on your registered bank account. For further support mail us support@samridhiindia.com Thank You</span>
                            </marquee>
                              <h5>Wallet Balance: <em>&#8377;<?= $dashData['walletBalance']; ?>/-</em></h5>
                              <small id="msg"></small>
                              <form action="<?= base_url('Profile/Request/'); ?>" method="post">
                                  <div class="form-group">
                                      <label>Request Amount</label>
                                      <input type="text" id="amt" name="amt" class="form-control">
                                      <input type="hidden" name="userId" value="<?= $this->uri->segment(3); ?>">
                                      <span class="d-none" id="mxAmt"><?= $dashData['walletBalance']; ?></span>
                                  </div>
                                  <div class="form-group">
                                      <button disabled="disabled" id="bbnt" class="bnt bnt-primary">Send Request</button>
                                  </div>
                              </form>
                          </div>
                      </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                          <div class="card-header">
                              <h4 class="card-title">All Request</h4>
                          </div>
                          <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Date</th>
                                            <th>Notes</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!empty($request)): ?>
                                            <?php $s= 1; foreach($request as $rq): $sl= $s++;
                                                if($rq['status']==0)
                                                {
                                                    $status = "Pending";
                                                    $cls = "text-danger";
                                                }
                                                else
                                                {
                                                    $status = "Success";
                                                    $cls = "text-success";
                                                }
                                             ?>
                                                <tr>
                                                    <td><?= $sl; ?></td>
                                                    <td><?= $rq['date']; ?></td>
                                                    <td><?= $rq['notes']; ?></td>
                                                    <td><?= $rq['amount']; ?></td>
                                                    <td><b class="<?= $cls; ?>"><?= $status; ?></b></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
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
            $("#amt").keyup(function(){
                var mxAmt = $("#mxAmt").html();
                var amt = $("#amt").val();
                //alert(amt);
                if(amt > mxAmt)
                {
                    $("#msg").html("Insufficient Wallet Balance.");
                    $("#bbnt").attr("disabled",true);
                    $("#msg").css("color","#f00");
                }
                else
                {
                    $("#msg").html("");
                    $("#bbnt").attr("disabled",false);
                }
            });
    	});
    </script>
</body>