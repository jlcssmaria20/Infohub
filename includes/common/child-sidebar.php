<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #1A273A">
	<!-- LOGO -->	
	<a href="/dashboard" class="brand-link py-">
		<img src="/assets/images/logowhite.png" alt="<?php echo renderLang($dx); ?>" class="brand-image elevation-3 ml-2 float-none" style="width:35px; height:25px; ">
		<span class="brand-text font-weight-light ml-1"><?php echo "DX Info Hub"; ?></span>
	</a>
	<!-- SIDEBAR -->
	<div class="sidebar">
		<!-- SIDEBAR PROFILE -->
		<div class="user-panel my-3 d-flex">
			<div class="image">
				<?php
					echo '<img src="'.$_SESSION['sys_photo'].'" class="img-circle elevation-2" alt="User Image">';
				?>
			</div>
			<div class="info">
				<a href='/general' class="d-inline-block text-truncate" style="max-width: 190px;font-size:12px"><?php echo $_SESSION['sys_fullname']; ?></a>
			</div>
		</div>

		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
				
                <!-- Dashboard -->
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger <?php if($page == 'dashboard') { echo ' active'; } ?>" href="/dashboard"> <i class="nav-icon fa fa-tachometer-alt" aria-hidden="true"></i><p> Dashboard</p> </a>
                </li>
				
                <?php if(checkPermission('webinar-and-events')) { ?>
                  <!-- WEBINAR AND EVENTS -->
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger <?php if($page == 'webinarandevents') { echo ' active'; } ?>" href="/webinarandevents"><i class="nav-icon far fa-calendar-alt " aria-hidden="true"></i><p> Webinar and Events</p> </a>
                </li>
				<?php } ?>

				<?php if(checkPermission('documents')) { ?>
                <!-- DOCUMENTS AND QUICK LINKS -->
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger <?php if($page == 'documents') { echo ' active'; } ?>" href="/documents"><i class="nav-icon far fa-file-alt" aria-hidden="true"></i><p> Documents and Quick Links</p></a>
                </li>
				<?php } ?>
                <!-- THE TEAM -->
                <!-- <li class="nav-item">
                    <a class="nav-link js-scroll-trigger <?php if($page == 'teams') { echo ' active'; } ?>" href="/teams"><i class="nav-icon fa fa-users" aria-hidden="true"></i>Teams</a>
                </li> -->
				
				<?php if(checkPermission('announcements')) { ?>
                <!-- ANNOUNCEMENTS -->
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger <?php if($page == 'announcements') { echo ' active'; } ?>" href="/announcements"><i class="nav-icon fa fa-bullhorn" aria-hidden="true"></i><p> Announcements</p> </a>
                </li>
				<?php } ?>
				<?php
				if(
					checkPermission('admins') ||
					checkPermission('teams') ||
					checkPermission('roles') ||
					checkPermission('users') 
				) {
					$tree_open = '';
					$tree_active = '';
					if(
						$page == 'admins' ||
						$page == 'teams' ||
						$page == 'roles' ||
						$page == 'users' 
                        
					) {
						$tree_open = ' menu-open';
						$tree_active = ' active';
					}
				?>
				<li class="nav-item has-treeview <?php echo $tree_open; ?>">
					<a href="#" class="nav-link js-scroll-trigger<?php echo $tree_active; ?>">
						<i class="nav-icon fas fa-cubes"></i>
						<p><i class="nav-icon right fa fa-angle-left"></i> Administrator</p>
					</a>
					<ul class="nav nav-treeview">
					<?php if($_SESSION['sys_id'] == 1){ ?>
						
						<!-- ADMINS -->
						<li class="nav-item">
							<a href="/admins" class="nav-link js-scroll-trigger<?php if($page == 'admins') { echo ' active'; } ?>">
								<i class="nav-icon fa fa-user-secret"></i>
								<p> Admins</p>
							</a>
						</li>
						<?php } ?>

						<?php if(checkPermission('teams')) { ?>
						<!-- TEAMS -->
						<li class="nav-item">
							<a href="/teams" class="nav-link js-scroll-trigger<?php if($page == 'teams') { echo ' active'; } ?>">
								<i class="nav-icon fa fa-handshake"></i>
								<p> Teams</p>
							</a>
						</li>
						<?php } ?>

						<?php if(checkPermission('roles')) { ?>
						<!-- ROLES -->
						<li class="nav-item">
							<a href="/roles" class="nav-link js-scroll-trigger<?php if($page == 'roles') { echo ' active'; } ?>">
								<i class="nav-icon far fa-id-badge"></i>
								<p> Roles</p>
							</a>
						</li>
						<?php } ?>
						
						<?php if(checkPermission('users')) { ?>
						<!-- USERS -->
						<li class="nav-item">
							<a href="/users" class="nav-link js-scroll-trigger<?php if($page == 'users') { echo ' active'; } ?>">
								<i class="nav-icon fas fa-users"></i>
								<p> Users</p>
							</a>
						</li>
						<?php } ?>

					</ul>
				</li>
				<?php } ?>
				<?php if((checkPermission('general')) && ($_SESSION['sys_account_mode'] == 'user')) { ?>

				  <!-- GENERAL -->
				  <li class="nav-item">
                    <a class="nav-link js-scroll-trigger <?php if($page == 'general') { echo ' active'; } ?>" href="/general"><i class="nav-icon fas fa-th" aria-hidden="true"></i><p> General</p> </a>
                 </li>
				

				<?php } ?>	
				
				  <!-- TEST PAGE -->
				<!-- <li class="nav-item">
                    <a class="nav-link js-scroll-trigger <?php if($page == 'test') { echo ' active'; } ?>" href="/test"><i class="nav-icon fa fa-circle-o"></i><p>TEST</p> </a>
                </li> -->
			


		</nav>
		<!-- /.sidebar-menu -->
	</div>
	<!-- /.sidebar -->
</aside>
