<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Contact Us | Samridhi - Apna Samridhi</title>
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
                                <h2 class="breadcrumb-title">Contact</h2>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
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
                
                <div id="catPro">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <h3>SAMRIDHI INDIA</h3><?= br(1); ?>
                            <h5>Contact Details</h5><?= br(2); ?>
                            <ul>
                                <li><i class="fa fa-phone"></i><?= nbs(5); ?> 9874 654 321</li>
                                <li><i class="fa fa-whatsapp"></i><?= nbs(5); ?> 9874 654 321</li>
                                <li><i class="fa fa-envelope"></i><?= nbs(5); ?> info@samridhiindia.com</li>
                                <li><i class="fa fa-envelope"></i><?= nbs(5); ?> support@samridhiindia.com</li>
                            </ul>
                        </div>
                        <div class="col-lg-6">
                            <form>
                                <h3>Send Us your Query</h3><?= br(1); ?>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label>Full Name</label>
                                        <input type="text" name="name" class="form-control">
                                    </div>
                                    <div class="form-group  col-md-6">
                                        <label>Email Address</label>
                                        <input type="text" name="name" class="form-control">
                                    </div>
                                    <div class="form-group  col-md-6">
                                        <label>Phone</label>
                                        <input type="text" name="name" class="form-control">
                                    </div>
                                    <div class="form-group  col-md-12">
                                        <label>Message</label>
                                        <textarea name="name" class="form-control" rows="6"></textarea>
                                    </div>
                                    <div class="form-group  col-md-12">
                                        <button class="bnt bnt-primary">Send</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2182.534716777239!2d88.5191669872291!3d23.076175656554412!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x1e70637e8a57fa9e!2sWMSolutions!5e0!3m2!1sen!2sin!4v1601644530317!5m2!1sen!2sin" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
        </section>
    </main>
    <?php include("inc/loginModal.php"); ?>
    <?php include("inc/footer.php"); ?>
    <!-- footer section end -->

    <!-- JS
============================================ -->

    <?php include("inc/js.php"); ?>
    <script type="text/javascript"></script>
    
</body>