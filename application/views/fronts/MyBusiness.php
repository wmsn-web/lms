<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Downline | Samridhi - Apna Samridhi</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link href="<?= base_url(); ?>assets/plugins/datatable/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="<?= base_url(); ?>assets/plugins/datatable/css/buttons.bootstrap4.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/plugins/datatable/css/responsive.bootstrap4.min.css" rel="stylesheet" />
    <link href="<?= base_url(); ?>assets/plugins/datatable/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/plugins/datatable/css/responsive.dataTables.min.css" rel="stylesheet">
    <?php include("inc/layout.php"); ?>

</head>
<body>
    <!-- Start Header Area -->
    <?php include("inc/menu.php"); ?>
    <main>
      <?php
        
          date_default_timezone_set('Asia/Kolkata');
          $Todate = date("Y-m-d");
          $dt = date_create($Todate);
          $mnths = date_format($dt,"F");
          $years = date_format($dt,"Y");
          $yrMnth = date_format($dt,"F")."-".date_format($dt,"Y");
        
      ?>
        <!-- breadcrumb section start -->
        <div class="breadcrumb-area top-45">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                      <div class="card bx-shaddow ht-550">
                        <div class="card-body">
                          <h3>Own Business</h3>
                          <hr>
                          <div class="table-responsive">
                            <table id="example2" class="table table-bordered">
                                  <thead>
                                      <tr>
                                          <th>SL</th>
                                          <th>Date</th>
                                          <th>Notes</th>
                                          <th>Amount</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                    <?php if(!empty($mytr)): ?>
                                      <?php $s=1; foreach($mytr as $key): $sl = $s++; ?>
                                          <tr>
                                              <td><?= $sl; ?></td>
                                              <td><?= $key['date']; ?></td>
                                              <td><?= $key['notes']; ?></td></td>
                                              <td><?= $key['amount']; ?></td></td>
                                          </tr>
                                        <?php endforeach; ?>
                                      <?php endif; ?>
                                  </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-12"><p>&nbsp; <br></div>
                    <div class="col-lg-12">
                      <div class="card bx-shaddow ht-550">
                        <div class="card-body">
                          <h3>Team Business Report</h3>
                          <hr>
                          <div class="row">
                              <div class="col-md-3">&nbsp;</div>
                              <div class="col-md-3">
                                  <div class="businessRep">
                                      <h3 class="ttl">My Business</h3>
                                      <div class="bsAmt">
                                          <h3 id="myBsAmt">&#8377; <?= $myBs['myBsns']; ?>/-</h3>
                                      </div>
                                      <div class="bsSlct">
                                          <select id="mnth">
                                                <?php
                                                  $mn = $this->db->get("months")->result();
                                                  foreach($mn as $m):
                                                    if($m->month == $mnths): $slct = "selected"; else: $slct=""; endif;
                                                ?>
                                                  <option value="<?= $m->month; ?>" <?= $slct; ?>><?= $m->month; ?></option>
                                                <?php endforeach; ?>
                                              </select>
                                              <select id="year">
                                                <?php
                                                  for ($i=1999; $i < 2051; $i++):
                                                    if($i == $years): $slct = "selected"; else: $slct = "";
                                                    endif;
                                                ?>
                                                  <option <?= $slct; ?> value="<?= $i; ?>"><?= $i; ?></option>
                                                <?php endfor; ?>
                                              </select>
                                              <i class="fa fa-search text-white cp trns" id="myBs"></i>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-md-3">
                                  <div class="businessRep">
                                      <h3 class="ttl">Team Business</h3>
                                      <div class="bsAmt">
                                          <h3 id="TmbsAmt">&#8377; <?= $bisRep['bsRep']; ?>/-</h3>

                                      </div>
                                      <div class="bsSlct">
                                          <select id="mn">
                                                <?php
                                                  $mn = $this->db->get("months")->result();
                                                  foreach($mn as $m):
                                                    if($m->month == $mnths): $slct = "selected"; else: $slct=""; endif;
                                                ?>
                                                  <option value="<?= $m->month; ?>" <?= $slct; ?>><?= $m->month; ?></option>
                                                <?php endforeach; ?>
                                              </select>
                                              <select id="yr">
                                                <?php
                                                  for ($i=1999; $i < 2051; $i++):
                                                    if($i == $years): $slct = "selected"; else: $slct = "";
                                                    endif;
                                                ?>
                                                  <option <?= $slct; ?> value="<?= $i; ?>"><?= $i; ?></option>
                                                <?php endfor; ?>
                                              </select>
                                              <i class="fa fa-search text-white cp trns" id="tmBs"></i>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-md-3">&nbsp;</div>
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
    <script src="<?= base_url(); ?>assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url(); ?>assets/plugins/datatable/js/dataTables.dataTables.min.js"></script>
    <script src="<?= base_url(); ?>assets/plugins/datatable/js/dataTables.responsive.min.js"></script>
    <script src="<?= base_url(); ?>assets/plugins/datatable/js/responsive.dataTables.min.js"></script>
    <script src="<?= base_url(); ?>assets/plugins/datatable/js/jquery.dataTables.js"></script>
    <script src="<?= base_url(); ?>assets/plugins/datatable/js/dataTables.bootstrap4.js"></script>
    <script src="<?= base_url(); ?>assets/plugins/datatable/js/dataTables.buttons.min.js"></script>
    <script src="<?= base_url(); ?>assets/plugins/datatable/js/buttons.bootstrap4.min.js"></script>
    <script src="<?= base_url(); ?>assets/plugins/datatable/js/jszip.min.js"></script>
    <script src="<?= base_url(); ?>assets/plugins/datatable/js/pdfmake.min.js"></script>
    <script src="<?= base_url(); ?>assets/plugins/datatable/js/vfs_fonts.js"></script>
    <script src="<?= base_url(); ?>assets/plugins/datatable/js/buttons.html5.min.js"></script>
    <script src="<?= base_url(); ?>assets/plugins/datatable/js/buttons.print.min.js"></script>
    <script src="<?= base_url(); ?>assets/plugins/datatable/js/buttons.colVis.min.js"></script>
    <script src="<?= base_url(); ?>assets/plugins/datatable/js/dataTables.responsive.min.js"></script>
    <script src="<?= base_url(); ?>assets/plugins/datatable/js/responsive.bootstrap4.min.js"></script>
    <script type="text/javascript">
    	$(document).ready(function(){
          $("#tmBs").click(function(){
            user = "<?= $this->session->userdata('userId'); ?>";
            mn = $("#mn").val();
            yr = $("#yr").val();
            mnYr = mn+"-"+yr;
              $.post("<?= base_url('Profile/GetTmbsByMn'); ?>",
                    {
                      user: user,
                      mnYr: mnYr
                    },
                    function(response,status)
                    {
                      $("#TmbsAmt").html("&#8377; "+response+"/-");
                    }

                )
          });
          $("#myBs").click(function(){
            user = "<?= $this->session->userdata('userId'); ?>";
            mn = $("#mnth").val();
            yr = $("#year").val();
            mnYr = mn+"-"+yr;
              $.post("<?= base_url('Profile/GetMybsByMn'); ?>",
                    {
                      user: user,
                      mnYr: mnYr
                    },
                    function(response,status)
                    {
                      $("#myBsAmt").html("&#8377; "+response+"/-");
                    }

                )
          })
                $('#example2').DataTable({
            responsive: true,
            language: {
              searchPlaceholder: 'Search...',
              sSearch: '',
              lengthMenu: '_MENU_',
            }
          });
          $('.example2').DataTable({
            responsive: true,
            language: {
              searchPlaceholder: 'Search...',
              sSearch: '',
              lengthMenu: '_MENU_',
            }
          });

          $('#example3').DataTable({
            responsive: true,
            language: {
              searchPlaceholder: 'Search...',
              sSearch: '',
              lengthMenu: '_MENU_',
            }
          });
          $('.example3').DataTable({
            responsive: true,
            language: {
              searchPlaceholder: 'Search...',
              sSearch: '',
              lengthMenu: '_MENU_',
            }
          });

          var ex = "<tr><td>sdfsf</td><td>sdfsf</td><td>sdfsf</td><td>sdfsf</td><td>sdfsf</td></tr>"
          $("#hh").html(ex);
    	});
    </script>
</body>