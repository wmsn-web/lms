<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>About | Samridhi - Apna Samridhi</title>
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
                                <h2 class="breadcrumb-title">About Us</h2>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">About US</li>
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
                    <div class="col-lg-5 order-2 order-lg-1">
                        <div class="about-inner">
                            <h2 class="h1 title"><span>Provide</span> the Best <br> Solutions <span>to Improve</span> <br>your Business</h2>
                                <h3 class="subtitle">Create some exclusive way to solve our customer problems</h3>
                                <p>labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam</p>
                                <a href="#" class="btn btn-all">Let's Start</a>
                        </div>
                    </div>
                    <div class="col-lg-6 offset-lg-1 order-1 order-lg-2">
                        <div class="about-thumb">
                            <img src="<?= base_url('front_assets/images/service.png'); ?>" class="moving-vertical" alt="about thumb">
                        </div>
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
    
</body>