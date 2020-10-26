<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Products | Samridhi - Apna Samridhi</title>
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
                                <h2 class="breadcrumb-title">Products</h2>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Products</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb section end -->
        <section class="about-wrapper-area section-paddings">
            <div class="container">
                <div class="col-md-12 pad-15 cats">
                    <button onclick="location.href='<?= base_url('Products'); ?>'" class="catBtns catBtn-pri catBtn-active">All Category</button>
                    <?php foreach ($cats as $cat) { ?>
                       <button id="ct_<?= $cat['id']; ?>" class="catBtn catBtn-pri"><?= $cat['cat_name']; ?></button>
                    <?php } ?>
                </div>
                <div id="catPro">
                    <div class="row align-items-center">
                        <?php foreach($data as $pro){
                                if($pro['price']=="0.00")
                                {
                                    $prc = "<b class='text-danger'>Not Defined</b>";
                                }
                                else
                                {
                                    $prc = $pro['price'];
                                }
                         ?>
                            <div class="col-md-2">
                                <div  class="product-div moving-vertical">
                                    <span class="badges">Best Offer 
                                    </span><span class="bxblank"></span><br>
                                    <div class="pro_img">
                                        <img src="<?= base_url('uploads/products/'.$pro['img']); ?>"><br>
                                        <span class="pro-price">&#8377; <?= $prc; ?></span><br>
                                        <ul class="rating">
                                        <li><i class="fa fa-star orange"></i></li>
                                        <li><i class="fa fa-star orange"></i></li>
                                        <li><i class="fa fa-star orange"></i></li>
                                        <li><i class="fa fa-star orange"></i></li>
                                        <li><i class="fa fa-star-o orange"></i></li>
                                    </ul><br>
                                    <span class="pro-title"><?= $pro['pro_name']; ?></span>
                                    <p class="pro-des">This Product will available only Samridhi's Store</p>
                                    </div>
                                    
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <?php include("inc/loginModal.php"); ?>
    <?php include("inc/footer.php"); ?>
    <!-- footer section end -->

    <!-- JS
============================================ -->

    <?php include("inc/js.php"); ?>
    <script type="text/javascript">
        $(document).ready(function(){
            $(".catBtn").click(function(){
                ids = this.id;
                spl = ids.split("_");
                id = spl[1];
                $.post("<?= base_url('Products/getByCat'); ?>",
                        {
                            id:id
                        },
                        function(response,status)
                        {
                            $("#catPro").html(response);
                            $("#"+ids).addClass("catBtn-active");
                        }
                )
            });
        });
    </script>
    
</body>