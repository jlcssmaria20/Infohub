<nav class="main-header navbar navbar-expand navbar-white navbar-light">
	
	<!-- NAV LEFT -->
	<ul class="navbar-nav">
		
		<li class="nav-item">
			<a class="nav-link mr-3" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
		</li>
		
		<li class="nav-item">
			<p class="server-date text-secondary "><i class="far fa-calendar-alt mr-2"></i><?php echo renderLang($header_server_date); ?> <?php echo date('F j, Y ', time()); ?></p>
		</li>
		
	</ul><!-- nav left -->

	<!-- NAV RIGHT -->
	<ul class="navbar-nav ml-auto">
		
		
		
		<!-- SETTINGS -->
		<li class="nav-item">
			<a class="nav-link btn btn-default btn-logout" id="logout" href="/logout" title="<?php echo renderLang($lang_logout); ?>">
				Logout <i class="fas fa-sign-out-alt"></i>
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