<aside class="main-sidebar sidebar-dark-primary elevation-4">
	
	<!-- LOGO -->
	<a href="/newsfeed" class="brand-link">
		<img src="/assets/images/logo-rrx.png" alt="<?php echo renderLang($sitename); ?>" class="brand-image img-circle elevation-3">
		<span class="brand-text font-weight-light"><?php echo renderLang($sitename); ?></span>
	</a>

	<!-- SIDEBAR -->
	<div class="sidebar">
		
		<!-- SIDEBAR PROFILE -->
		<div class="user-panel mt-3 pb-3 mb-3 d-flex">
			<div class="image" style="color:#fff;">
                <i class="nav-icon fa fa-book" style="color: #fff;padding: 8px 8px 0;"></i>
			</div>
			<div class="info">
                <a href="#" class="d-block"style="font-size: 16px; margin: -5px -2px;"><?php echo $_SESSION['nameExam']; ?></a>
			</div>
		</div>

		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
				
				<?php
                    // get the count column in exam list question table
                    $sql = $pdo->prepare("SELECT * FROM exam_list_question");
                    $sql->execute();
                    $colcount = $sql->columnCount();
                    $minus = 3;
                    $count = $colcount - $minus; // display total subtraction

                    $sql = $pdo->prepare("SELECT * FROM examlists WHERE user_id= ".$_SESSION['sys_data']['id']." ");
                    $sql->execute();
                    while($data = $sql->fetch(PDO::FETCH_ASSOC)){
                    
                        if($data['user_id'] == $_SESSION['sys_data']['id']) {
                            if($data['exam_name'] == 0) {
                                echo ' <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="far fa-circle nav-icon" style="color:#dc3545;"></i>
                                            <p> '.$data['exam_name'].'<p id="exam-alert"></p></p>
                                        </a>
                                    </li>
                                ';
                            } else {
                                echo ' <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="nav-icon fas fa-check" style="color:#28a745;"></i>
                                            <p>'.$data['exam_name'].'<p id="exam-alert"></p></p>
                                        </a>
                                    </li>
                                ';
                            }	
                        } // $data['user_id']
                    }
				?>
			</ul>
		</nav>
		<!-- /.sidebar-menu -->
	</div>
	<!-- /.sidebar -->
</aside>