<nav class="main-header navbar navbar-expand navbar-white navbar-light">
	

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
			<a class="nav-link btn-logout" href="/logout" title="<?php echo renderLang($lang_logout); ?>">
				<i class="fa fa-sign-out-alt"></i>
			</a>
		</li>
		
	</ul><!-- nav right -->
	
</nav>