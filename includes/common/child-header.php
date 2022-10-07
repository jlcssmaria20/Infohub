<nav class="main-header navbar navbar-expand navbar-white navbar-light">
	
	<!-- NAV LEFT -->
	<ul class="navbar-nav">
		
		<li class="nav-item">
			<a class="nav-link mr-3" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
		</li>
		
		<!-- <?php if($_SESSION['sys_data']['id'] == 1) { ?>
		<li class="nav-item">
			<a class="btn btn-default btn-reset-system mr-2" href="#" title=""><i class="fa fa-desktop mr-2"></i>System Reset</a>
		</li>
		<li class="nav-item">
			<a class="btn btn-default btn-reset-users mr-2" href="#" title=""><i class="fa fa-user mr-2"></i>Reset Users</a>
		</li>
		<?php } ?> -->
		<li class="nav-item">
			<p class="server-date text-secondary "><i class="far fa-calendar-alt mr-2"></i><?php echo renderLang($header_server_date); ?> <?php echo date('F j, Y ', time()); ?></p>
		</li>
		
	</ul><!-- nav left -->

	<!-- NAV RIGHT -->
	<ul class="navbar-nav ml-auto">
		
		<!-- <li class="nav-item dropdown">
			<a class="nav-link" data-toggle="dropdown" href="#" title="<?php //echo renderLang($switch_language); ?>">
				<i class="fa fa-globe-asia"></i>
			</a>
			<div class="dropdown-menu dropdown-menu-right p-0">
				<?php
				// foreach($language_arr as $language) {
				// 	echo '<a href="#" class="dropdown-item';
				// 	if($language[0] == $_SESSION['sys_data']['language']) {
				// 		echo ' active';
				// 	}
				// 	echo '">'.$language[1].'</a>';
				// }
				?>
			</div>
		</li> -->
		
		<!-- SETTINGS -->
		<!-- <li class="nav-item">
			<a class="nav-link" href="/settings" title="<?php echo renderLang($settings_title); ?>">
				<i class="fa fa-cogs"></i>
			</a>
		</li> -->
		
		<!-- SETTINGS -->
		<li class="nav-item">
			<a class="nav-link btn-logout" id="logout" href="/logout" title="<?php echo renderLang($lang_logout); ?>">
				<i class="fas fa-sign-out-alt text-primary"></i>
			</a>
		</li>
		
	</ul><!-- nav right -->
	
</nav>
<script>
		$(function() {

			$('#logout').click(function(e) {
			e.preventDefault();
			if(confirm('<?php echo renderLang($login_logout_confirmation)?>')){
				window.location.href = "/logout";
			}
		});
		});
	
</script>