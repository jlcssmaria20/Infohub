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
					echo '<img src="/assets/uploadimages/'.$_SESSION['sys_data']['photo'].'" class="img-circle elevation-2" alt="User Image">';
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
					<?php if($module == 'dashboard') {  ?>
						<a href="/dashboard" class="nav-link active">
							<i class="nav-icon fas fa-tachometer-alt"></i><p>Dashboard</p>
						</a>
					<?php } else { ?>
						<a href="/dashboard" class="nav-link">
							<i class="nav-icon fas fa-tachometer-alt"></i><p>Dashboard</p>
						</a>
					<?php } ?>
				</li>
				<!-- Webinar and Events -->
					<!-- <li class="nav-item">
					<?php //if($module == 'teamviews') {  ?>
						<a href="/teamviews" class="nav-link active">
							<i class="nav-icon fas fa-grip-horizontal"></i><p>User Home Page</p>
						</a>
					<?php //} else { ?>
						<a href="/teamviews" class="nav-link">
							<i class="nav-icon fas fa-grip-horizontal"></i><p>User Home Page</p>
						</a>
					<?php //} ?>
				</li> -->


				<!-- Webinar and Events -->
				<li class="nav-item">
					<?php if($module == 'webinarandevents') {  ?>
						<a href="/webinar-and-events" class="nav-link active">
							<i class="nav-icon far fa-image"></i><p>Webinar and Events</p>
						</a>
					<?php } else { ?>
						<a href="/webinar-and-events" class="nav-link">
							<i class="nav-icon far fa-image"></i><p>Webinar and Events</p>
						</a>
					<?php } ?>
				</li>

				<!-- Users -->
				<li class="nav-item">
					<?php if($module == 'users') {  ?>
						<a href="/users" class="nav-link active">
							<i class="nav-icon far fa-user"></i><p>Users</p>
						</a>
					<?php } else { ?>
						<a href="/users" class="nav-link">
							<i class="nav-icon far fa-user"></i><p>Users</p>
						</a>
					<?php } ?>
				</li>


				<!-- Documents and quick links -->
				<li class="nav-item">
					<?php if($module == 'documentsquicklinks') {  ?>
						<a href="/documents-quick-link" class="nav-link active">
							<i class="nav-icon fas fa-copy"></i><p>Documents & Quick Links</p>
						</a>
					<?php } else { ?>
						<a href="/documents-quick-link" class="nav-link">
							<i class="nav-icon fas fa-copy"></i><p>Documents & Quick Links</p>
						</a>
					<?php } ?>
				</li>

				<!-- Announcement -->
				<li class="nav-item">
					<?php if($module == 'announcements') {  ?>
						<a href="/announcements" class="nav-link active">
							<i class="nav-icon far fa-envelope"></i><p>Announcement</p>
						</a>
					<?php } else { ?>
						<a href="/announcements" class="nav-link">
							<i class="nav-icon far fa-envelope"></i><p>Announcement</p>
						</a>
					<?php } ?>
				</li>


					<!-- general -->
					<li class="nav-item">
					<?php if($module == 'generals') {  ?>
						<a href="/generals" class="nav-link active">
							<i class="nav-icon fas fa-th"></i><p>General</p>
						</a>
					<?php } else { ?>
						<a href="/generals" class="nav-link">
							<i class="nav-icon fas fa-th"></i><p>General</p>
						</a>
					<?php } ?>
				</li>

		</nav>
		<!-- /.sidebar-menu -->
	</div>
	<!-- /.sidebar -->
</aside>
