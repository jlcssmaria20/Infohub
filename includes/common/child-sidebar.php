<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<!-- LOGO -->
	<a href="#" class="brand-link">
		<img src="/assets/images/logo-rrx.png" alt="<?php echo renderLang($sitename); ?>" class="brand-image img-circle elevation-3">
		<span class="brand-text font-weight-light"><?php echo renderLang($sitename); ?></span>
	</a>
	<!-- SIDEBAR -->
	<div class="sidebar">
		<!-- SIDEBAR PROFILE -->
		<div class="user-panel mt-3 pb-3 mb-3 d-flex">
			<div class="image">
				<?php
				if($_SESSION['sys_data']['photo'] == '') {
					echo '<img src="/assets/images/profile-default.png" class="img-circle elevation-2" alt="User Image">';
				} else {
					echo '<img src="/assets/images/team-images/'.$_SESSION['sys_data']['photo'].'" class="img-circle elevation-2" alt="User Image">';
				}
				?>
			</div>
			<div class="info">
				<a href='#' style="" class="d-block"><?php echo $_SESSION['sys_fullname']; ?></a>
			</div>
		</div>

		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
				
                <!-- Dashboard -->
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger <?php if($page == 'i-dashboard') { echo ' active'; } ?>" href="/dashboard"> <i class="nav-icon fas fa-tachometer-alt" aria-hidden="true"></i>DASHBOARD</a>
                </li>
                
                  <!-- WEBINAR AND EVENTS -->
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger <?php if($page == 'i-webinar-and-events') { echo ' active'; } ?>" href=""><i class="fa fa-calendar" aria-hidden="true"></i>WEBINAR AND EVENTS</a>
                </li>

                <!-- DOCUMENTS AND QUICK LINKS -->
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger <?php if($page == 'i-documents') { echo ' active'; } ?>" href=""><i class="fa fa-file-text-o" aria-hidden="true"></i>DOCUMENTS AND QUICK LINKS</a>
                </li>

                <!-- THE TEAM -->
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger <?php if($page == 'i-users') { echo ' active'; } ?>" href=""><i class="fa fa-users" aria-hidden="true"></i>THE TEAM</a>
                </li>

                <!-- ANNOUNCEMENTS -->
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger <?php if($page == 'i-announcements') { echo ' active'; } ?>" href=""><i class="fa fa-bullhorn" aria-hidden="true"></i>ANNOUNCEMENTS</a>
                </li>

				  <!-- TEST PAGE -->
				  <li class="nav-item">
                    <a class="nav-link js-scroll-trigger <?php if($page == 'test') { echo ' active'; } ?>" href="/test"><i class="fa fa-circle-o" aria-hidden="true"></i>TEST</a>
                </li>
			


		</nav>
		<!-- /.sidebar-menu -->
	</div>
	<!-- /.sidebar -->
</aside>
