<header class="header-area">
        <div class="main-header d-none d-lg-block">
            <!-- header top start -->
            <div class="header-top theme-bg">
                <div class="container">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-sm-4">
                            <div class="header-top-left text-center text-sm-left">
                                Call us:<a href="tel:+968573979894"> 01254 789 321</a>
                            </div>
                        </div>
                        <!-- <div class="col-sm-4">
                        <div class="login-register text-center">
                            <a href="#">Login/Register</a>
                        </div>
                    </div> -->
                        <div class="col-sm-8">
                            <div class="header-settings-bar d-flex justify-content-end">
                                <div class="header-social-link text-center text-sm-right">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                    <a href="#"><i class="fa fa-linkedin"></i></a>
                                </div>
                                <div class="language pl-30">
                                    <img src="<?= base_url(); ?>front_assets/img/icon/en.png" alt="flag"> English
                                    <i class="fa fa-angle-down"></i>
                                    <ul class="dropdown-list">
                                        <li><a href="#"><img src="<?= base_url(); ?>front_assets/img/icon/en.png" alt="flag"> English</a></li>
                                        <li><a href="#"><img src="<?= base_url(); ?>front_assets/img/icon/fr.png" alt="flag"> French</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- header top start -->
            <?php if($this->uri->segment(1)=="Home"): $cls = "header-transparent"; elseif($this->uri->segment(1)==""): $cls = "header-transparent"; else: $cls = ""; endif; ?>
            <!-- main menu start -->
            <div class="main-menu-wrapper sticky <?= $cls; ?>">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-3">
                            <!-- logo area start -->
                            <div class="brand-logo">
                                <a href="index.html">
                                    <img src="<?= base_url(); ?>assets/img/brand/logosmall.png" alt="brand logo">
                                </a>
                            </div>
                            <!-- logo area end -->
                        </div>
                        <div class="col-lg-9">
                            <div class="main-menu-inner">
                                <!-- main menu navbar start -->
                                <nav class="main-menu">
                                    <ul>
                                        <li class="active"><a href="<?= base_url(); ?>">Home</a>
                                        </li>
                                        <li><a href="<?= base_url('About'); ?>">About us</a></li>
                                        <li><a href="<?= base_url('Products'); ?>">Products</a>
                                        </li>
                                        <li><a href="<?= base_url('Blog'); ?>">Blog</a>
                                        </li>
                                        <li><a href="<?= base_url('Contact'); ?>">Contact</a>
                                        </li>
                                        <?php if($this->session->userdata("userId")): ?>
                                        <li><a href="#">My Account</a>
                                            <ul class="dropdown">
                                                <li><a href="<?= base_url('Profile'); ?>">Profile</a></li>
                                                <li><a href="<?= base_url('MyBusiness'); ?>">My Business</a></li>
                                                <li><a href="<?= base_url('MyTransaction'); ?>">My transaction</a></li>
                                                <li><a href="<?= base_url('Home/logout'); ?>">Logout</a></li>
                                            </ul>
                                        </li>
                                        <?php else: ?>
                                        <li><a href="#" data-toggle="modal" data-target="#modal1"> Signin </a>
                                        <?php endif; ?>
                                        </li>
                                    </ul>
                                </nav>
                                <!-- main menu navbar end -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- main menu end -->
        </div>

        <!-- mobile header start -->
        <!-- mobile header start -->
        <div class="mobile-header d-lg-none d-md-block sticky">
            <!--mobile header top start -->
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12">
                        <div class="mobile-main-header">
                            <div class="mobile-logo">
                                <a href="index.html">
                                    <img src="<?= base_url(); ?>assets/img/brand/logo.png" alt="Brand Logo">
                                </a>
                            </div>
                            <div class="mobile-menu-toggler">
                                <button class="mobile-menu-btn">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- mobile header top start -->
        </div>
        <!-- mobile header end -->
        <!-- mobile header end -->

        <!-- offcanvas mobile menu start -->
        <!-- off-canvas menu start -->
        <aside class="off-canvas-wrapper">
            <div class="off-canvas-overlay"></div>
            <div class="off-canvas-inner-content">
                <div class="btn-close-off-canvas">
                    <i class="fa fa-close"></i>
                </div>

                <div class="off-canvas-inner">
                    <!-- search box start -->
                    <div class="search-box-offcanvas">
                        <form>
                            <input type="text" placeholder="Search Here...">
                            <button class="search-btn"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                    <!-- search box end -->

                    <!-- mobile menu start -->
                    <div class="mobile-navigation">
                        <!-- mobile menu navigation start -->
                        <nav>
                            <ul class="mobile-menu">
                                <li class="menu-item-has-children"><a href="<?= base_url(); ?>">Home</a>
                                    
                                </li>
                                <li><a href="<?= base_url('AboutUs'); ?>">about us</a></li>
                                <li class="menu-item-has-children"><a href="<?= base_url('Product'); ?>">Product</a>
                                    
                                </li>
                                <li class="menu-item-has-children"><a href="<?= base_url('Blog'); ?>">blog</a>
                                    <li class="menu-item-has-children"><a href="<?= base_url('Contact'); ?>">Contact</a>
                                </li>
                                <?php if($this->session->userdata("userId")): ?>
                                    <li class="menu-item-has-children"><a href="#">My Account</a>
                                        <ul class="dropdown">
                                            <li><a href="<?= base_url('Profile'); ?>">Profile</a></li>
                                            <li><a href="<?= base_url('MyBusiness'); ?>">My Business</a></li>
                                            <li><a href="<?= base_url('MyTransaction'); ?>">My transaction</a></li>
                                            <li><a href="<?= base_url('Home/logout'); ?>">Logout</a></li>
                                        </ul>
                                    </li>
                                <?php else: ?>
                                    <li class="menu-item-has-children">
                                        <a href="#" id="sign"  data-toggle="modal" data-target="#modal1">Signin</a></li>
                                <?php endif; ?>
                            </ul>
                        </nav>
                        <!-- mobile menu navigation end -->
                    </div>
                    <!-- mobile menu end -->

                    <!-- language section start -->
                    <div class="mobile-top-dropdown">
                        <a href="#" class="dropdown-toggle" id="currency" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="<?= base_url(); ?>front_assets/img/icon/en.png" alt="flag"> English
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="currency">
                            <a class="dropdown-item" href="#"><img src="<?= base_url(); ?>front_assets/img/icon/en.png" alt="flag"> English</a>
                            <a class="dropdown-item" href="#"><img src="<?= base_url(); ?>front_assets/img/icon/fr.png" alt="flag"> French</a>
                        </div>
                    </div>
                    <!-- language section end -->

                    <!-- offcanvas widget area start -->
                    <div class="offcanvas-widget-area">
                        <div class="off-canvas-contact-widget">
                            <ul>
                                <li><i class="fa fa-mobile"></i>
                                    <a href="#">0123456789</a>
                                </li>
                                <li><i class="fa fa-envelope-o"></i>
                                    <a href="#">info@yourdomain.com</a>
                                </li>
                            </ul>
                        </div>
                        <div class="off-canvas-social-widget">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-pinterest-p"></i></a>
                            <a href="#"><i class="fa fa-linkedin"></i></a>
                            <a href="#"><i class="fa fa-youtube-play"></i></a>
                        </div>
                    </div>
                    <!-- offcanvas widget area end -->
                </div>
            </div>
        </aside>
        <!-- off-canvas menu end -->
        <!-- offcanvas mobile menu end -->

    </header>