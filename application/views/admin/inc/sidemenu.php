		<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
		<aside class="app-sidebar sidebar-scroll ">
			<div class="main-sidebar-header">
				
				<a class=" desktop-logo logo-light" href="<?= base_url(); ?>/admin_panel/"><img src="<?= base_url(); ?>assets/img/brand/logo.png" class="main-logo" alt="logo"></a>
				<a class=" desktop-logo logo-dark" href="<?= base_url(); ?>/admin_panel/"><img src="<?= base_url(); ?>assets/img/brand/logo-white.png" class="main-logo dark-theme" alt="logo"></a>
				<a class="logo-icon mobile-logo icon-light" href="<?= base_url(); ?>/admin_panel/"><img src="<?= base_url(); ?>assets/img/brand/favicon.png" class="logo-icon" alt="logo"></a>
				<a class="logo-icon mobile-logo icon-dark" href="<?= base_url(); ?>/admin_panel/"><img src="<?= base_url(); ?>assets/img/brand/favicon-white.png" class="logo-icon dark-theme" alt="logo"></a>
			

			
			</div>
			<div class="main-sidebar-body circle-animation ">

				<ul class="side-menu circle">
					<li><h3 class="">Dashboard</h3></li>
					<li class="slide">
						<a class="side-menu__item" href="<?= base_url(); ?>/admin_panel/"><i class="side-menu__icon ti-desktop"></i><span class="side-menu__label">Dashboard</span></a>
					</li>
					<li><h3>Join User</h3></li>
					
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon ti-user  menu-icons"></i><span class="side-menu__label">Members</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="<?= base_url('admin_panel/AddMember'); ?>">Add Member</a></li>
							<li><a class="slide-item" href="<?= base_url('admin_panel/AllMembers'); ?>">View All Members</a></li>
							<li><a class="slide-item" href="<?= base_url('admin_panel/AddBalance'); ?>">Add Balance</a></li>
							
						</ul>
					</li>
					

					<li><h3>Forms</h3></li>
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon ti-pencil-alt"></i><span class="side-menu__label">Forms</span><span class="badge badge-info side-badge">6</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="form-elements.html">Form Elements</a></li>
							<li><a class="slide-item" href="form-advanced.html">Advanced Forms</a></li>
							<li><a class="slide-item" href="form-layouts.html">Form Layouts</a></li>
							<li><a class="slide-item" href="form-validation.html">Form Validation</a></li>
							<li><a class="slide-item" href="form-wizards.html">Form Wizards</a></li>
							<li><a class="slide-item" href="form-editor.html">WYSIWYG Editor</a></li>
						</ul>
					</li>
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon ti-pie-chart"></i><span class="side-menu__label">Charts</span><span class="badge badge-danger side-badge">5</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="chart-morris.html">Morris Charts</a></li>
							<li><a class="slide-item" href="chart-flot.html">Flot Charts</a></li>
							<li><a class="slide-item" href="chart-chartjs.html">ChartJS</a></li>
							<li><a class="slide-item" href="chart-echart.html">Echart</a></li>
							<li><a class="slide-item" href="chart-sparkline.html">Sparkline</a></li>
							<li><a class="slide-item" href="chart-peity.html">Chart-peity</a></li>
						</ul>
					</li>
					<li><h3>Settings</h3></li>
					<li class="slide">
						<a class="side-menu__item"  href="<?= base_url('admin_panel/Settings'); ?>"><i class="side-menu__icon fas fa-cog"></i><span class="side-menu__label">Settings</span></a>
						
					</li>
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon ti-shopping-cart-full"></i><span class="side-menu__label">Ecommerce</span><span class="badge badge-success side-badge">3</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="products.html">Products</a></li>
							<li><a class="slide-item" href="product-details.html">Product-Details</a></li>
							<li><a class="slide-item" href="product-cart.html">Cart</a></li>
						</ul>
					</li>
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon ti-layers-alt"></i><span class="side-menu__label">Utilities</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="background.html">Background</a></li>
							<li><a class="slide-item" href="border.html">Border</a></li>
							<li><a class="slide-item" href="display.html">Display</a></li>
							<li><a class="slide-item" href="flex.html">Flex</a></li>
							<li><a class="slide-item" href="height.html">Height</a></li>
							<li><a class="slide-item" href="margin.html">Margin</a></li>
							<li><a class="slide-item" href="padding.html">Padding</a></li>
							<li><a class="slide-item" href="position.html">Position</a></li>
							<li><a class="slide-item" href="width.html">Width</a></li>
							<li><a class="slide-item" href="extras.html">Extras</a></li>
						</ul>
					</li>
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon ti-user"></i><span class="side-menu__label">Custom Pages</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="signin.html">Sign In</a></li>
							<li><a class="slide-item" href="signup.html">Sign Up</a></li>
							<li><a class="slide-item" href="forgot.html">Forgot Password</a></li>
							<li><a class="slide-item" href="reset.html">Reset Password</a></li>
							<li><a class="slide-item" href="lockscreen.html">Lockscreen</a></li>
							<li><a class="slide-item" href="underconstruction.html">UnderConstruction</a></li>
							<li><a class="slide-item" href="404.html">404 Error</a></li>
							<li><a class="slide-item" href="500.html">500 Error</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</aside>