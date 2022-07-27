<nav class="main-header navbar navbar-expand-md navbar-dark navbar-black navbar-portal">
	<div class="container">
		
		<a href="/newsfeed" class="navbar-brand">
			<img src="/assets/images/logo-rrx.png" alt="<?php echo renderLang($sitename); ?>" class="brand-image img-circle elevation-3 mr-2" style="opacity: .8">
			<span class="brand-text font-weight-light"><?php echo renderLang($sitename); ?></span>
		</a>

		<button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">

			<!-- SEARCH FORM -->
			<form class="form-inline ml-0 ml-md-3">
				<div class="input-group input-group-sm">
					<input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
					<div class="input-group-append">
						<button class="btn btn-navbar" type="submit">
							<i class="fas fa-search"></i>
						</button>
					</div>
				</div>
			</form>
			
			<!-- NAVIGATION -->
			<ul class="navbar-nav">
				<?php if(checkPermission('admin-access')) { ?>
				<li class="nav-item">
					<a href="/dashboard" class="nav-link"><i class="fa fa-user-tie mr-2"></i><?php echo renderLang($lang_admin); ?></a>
				</li>
				<?php } ?>
				<li class="nav-item">
					<a href="/newsfeed" class="nav-link<?php if($module == 'newsfeed') { echo ' active'; } ?>"><i class="far fa-newspaper mr-2"></i><?php echo renderLang($newsfeed_newsfeed); ?></a>
				</li>
				<li class="nav-item">
					<a href="/mytickets" class="nav-link<?php if($module == 'mytickets') { echo ' active'; } ?>"><i class="fa fa-ticket-alt mr-2"></i><?php echo renderLang($tickets_tickets); ?></a>
				</li>
				<li class="nav-item dropdown">
					<a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle"><i class="fa fa-user mr-2"></i><?php echo $_SESSION['sys_fullname']; ?></a>
					<ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
						<li><a href="#" class="dropdown-item"><i class="fa fa-cogs mr-2"></i><?php echo renderLang($settings_title); ?></a></li>
						<li><a href="/logout" class="dropdown-item"><i class="fa fa-sign-out-alt mr-2"></i><?php echo renderLang($lang_logout); ?></a></li>
					</ul>
				</li>
			</ul>
			
		</div>
		
	</div>
</nav>