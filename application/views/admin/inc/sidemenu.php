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
							<li><a class="slide-item" href="<?= base_url('admin_panel/ExecutiveMembers'); ?>">Executive Members</a></li>
							<li><a class="slide-item" href="<?= base_url('admin_panel/MembersTree'); ?>">Members Tree</a></li>
						</ul>
					</li>
					

					<li><h3>User Transactions</h3></li>
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon ti-pencil-alt"></i><span class="side-menu__label">User Transactions</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="<?= base_url('admin_panel/SubmitPurchase'); ?>">Submit Purchase</a></li>
							<li><a class="slide-item" href="<?= base_url('admin_panel/UserPurchasedHistory'); ?>">All User Purchased History</a></li>
							<li><a class="slide-item" href="<?= base_url('admin_panel/BusinessReport'); ?>">Business Report</a></li>
							<li><a class="slide-item" href="<?= base_url('admin_panel/UserWallet'); ?>">User Wallet</a></li>
							<li><a class="slide-item" href="<?= base_url('admin_panel/CompanyBusiness'); ?>">Company Business</a></li>
							
						</ul>
					</li>
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon ti-pie-chart"></i><span class="side-menu__label">Requests</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="<?= base_url('admin_panel/WithdrawRequest'); ?>">Withdraw Request</a></li>
							<li><a class="slide-item" href="<?= base_url('admin_panel/WithdrawRequestCompleted'); ?>">Withdraw Request Completed</a></li>
							
						</ul>
					</li>
					<li><h3>Products</h3></li>
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon ti-pie-chart"></i><span class="side-menu__label">Products</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="<?= base_url('admin_panel/ProductsCategories'); ?>">Products Categories</a></li>
							<li><a class="slide-item" href="<?= base_url('admin_panel/AddProducts'); ?>">Add Products</a></li>
							<li><a class="slide-item" href="<?= base_url('admin_panel/ViewProducts'); ?>">View Products</a></li>
							
						</ul>
					</li>
					<li><h3>Settings</h3></li>
					<li class="slide">
						<a class="side-menu__item"  href="<?= base_url('admin_panel/Settings'); ?>"><i class="side-menu__icon fas fa-cog"></i><span class="side-menu__label">Settings</span></a>
						
					</li>
					
					
					
				</ul>
			</div>
		</aside>