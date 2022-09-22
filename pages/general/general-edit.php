<?php
// INCLUDES
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

// check if user has existing session
if(checkSession()) {

    // check permission to access this page or function
	if(checkPermission('general')) {
	
        // clear sessions from forms
        clearSessions();

        // set page
        $page = 'general';

        $account_id = $_SESSION['sys_id'];
        $sql = $pdo->prepare("SELECT * FROM users WHERE user_id = :user_id LIMIT 1");
        $sql->bindParam(":user_id", $account_id);
        $sql->execute();

        // check if ID exists
        if($sql->rowCount()) {

            $data = $sql->fetch(PDO::FETCH_ASSOC);

            $user_skills = $data['user_skills'];
            if(isset($_SESSION['sys_general_edit_skills_val'])) {
                $user_skills = $_SESSION['sys_general_edit_skills_val'];
                unset($_SESSION['sys_general_edit_skills_val']);
            }
            $user_mantra = $data['user_mantra_in_life'];
            if(isset($_SESSION['sys_general_edit_mantra_val'])) {
                $user_mantra_in_life = $_SESSION['sys_general_edit_mantra_val'];
                unset($_SESSION['sys_general_edit_mantra_val']);
            }
            $user_nickname = $data['user_nickname'];
            if(isset($_SESSION['sys_general_edit_nickname_val'])) {
                $user_nickname = $_SESSION['sys_general_edit_nickname_val'];
                unset($_SESSION['sys_general_edit_nickname_val']);
            }
            $user_photo = $data['user_photo'];
            if(isset($_SESSION['sys_general_edit_photo_val'])) {
                $user_photo = $_SESSION['sys_general_edit_photo_val'];
                unset($_SESSION['sys_general_edit_photo_val']);
            }

            $user_firstname = $data['user_firstname'];
            if(isset($_SESSION['sys_general_edit_firstname_val'])) {
                $user_firstname = $_SESSION['sys_general_edit_firstname_val'];
                unset($_SESSION['sys_general_edit_firstname_val']);
            }
            $user_middlename = $data['user_middlename'];
            if(isset($_SESSION['sys_general_edit_middlename_val'])) {
                $user_middlename = $_SESSION['sys_general_edit_middlename_val'];
                unset($_SESSION['sys_general_edit_middlename_val']);
            }
            $user_lastname = $data['user_lastname'];
            if(isset($_SESSION['sys_general_edit_lastname_val'])) {
                $user_lastname = $_SESSION['sys_general_edit_lastname_val'];
                unset($_SESSION['sys_general_edit_lastname_val']);
            }
            $user_mobile = $data['user_mobile'];
            if(isset($_SESSION['sys_general_edit_mobile_val'])) {
                $user_mobile = $_SESSION['sys_general_edit_mobile_val'];
                unset($_SESSION['sys_general_edit_mobile_val']);
            }
    
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="icon" type="image/x-icon" href="assets/images/favicon.png">
    <title><?php echo $dx."General (Update Account)"; ?></title>
	<link rel="stylesheet" href="/assets/css/general.css">
	<?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/links.php'); ?>
	
</head>

<body class="hold-transition sidebar-mini layout-fixed">
	
	<!-- WRAPPER -->
	<div class="wrapper">
		
		<?php
		require($_SERVER['DOCUMENT_ROOT'].'/includes/common/child-header.php');
		require($_SERVER['DOCUMENT_ROOT'].'/includes/common/child-sidebar.php');
		?>

		<!-- CONTENT -->
		<div class="content-wrapper" style="height:120vh;">
			
			<!-- CONTENT HEADER -->
			<section class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1><i class="nav-icon fas fa-th" aria-hidden="true"></i><?php echo renderLang($account_edit); ?></h1>
						</div>
					</div>
				</div>
			</section>

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">
					
					<?php
					renderError('sys_general_edit_err');
					renderSuccess('sys_general_edit_suc');
					?>
                    <form method="post" action="/submit-edit-general/<?php echo encryptID($account_id) ?>" enctype="multipart/form-data">
                        <div class="card">
                            <!-- <div class="card-header">
                            </div> -->
                            <!-- YOUR ACCOUNT -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-3 text-center ">
                                        <div class="m-3">
                                            <img class="profile-user-img img-fluid img-circle"
                                            src="<?php echo $_SESSION['sys_photo'] ?>"
                                            alt="User profile picture">
                                        </div>
                                        <h3 class="profile-username"><?php echo $_SESSION['sys_fullname']; ?></h3>
                                        <p class="text-muted"><?php echo $data['user_email'] ?></p>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="card-header pl-0">
                                            <h3 class="card-skills"><?php echo renderLang($account_details); ?></h3>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <!-- EMPLOYEE ID -->
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="emp id" class="mr-1">	<?php echo renderLang($account_employee_id_label); ?> </label>
                                                    <input type="text" class="form-control required" placeholder="" value="<?php echo $data['user_employee_id'] ?>" disabled>
                                                </div>
                                            </div>	
                              
                                            <!-- SKILLS -->
                                            <div class="col-lg-4">
										        <?php $err = isset($_SESSION['sys_general_edit_skills_err']) ? 1 : 0; ?>
                                                <div class="form-group">
                                                 
                                                    <label for="skills" class="mr-1<?php if($err) { echo ' text-danger'; } ?>"><?php if($err) { echo '<i class="far fa-times-circle mr-1"></i>'; } echo renderLang($account_skills_label); ?></label>

                                                    <span class="right badge badge-danger"><?php echo renderLang($label_required); ?></span>
                                                    
                                                    <input type="text" minlength="4" maxlength="50" class="form-control required<?php if($err) { echo ' is-invalid'; } ?>" id="skills" name="skills" placeholder="<?php echo renderLang($account_skills_label); ?>" value="<?php echo $user_skills ?>" required>
											        
                                                    <?php if($err) { echo '<p class="error-message text-danger mt-1">'.$_SESSION['sys_general_edit_skills_err'].'</p>'; unset($_SESSION['sys_general_edit_skills_err']); } ?>
									
                                                </div>
                                            </div>
                                            <!-- MANTRA -->
                                            <div class="col-lg-4">
                                                <?php $err = isset($_SESSION['sys_general_edit_mantra_err']) ? 1 : 0; ?>
                                                <div class="form-group">
                                                    <label for="mantra" class="mr-1<?php if($err) { echo ' text-danger'; } ?>"><?php if($err) { echo '<i class="far fa-times-circle mr-1"></i>'; } echo renderLang($account_mantra_label); ?></label>

                                                    <span class="right badge badge-danger"><?php echo renderLang($label_required); ?></span>

                                                    <input type="text" minlength="4" maxlength="50" class="form-control required<?php if($err) { echo ' is-invalid'; } ?>" id="mantra" name="mantra" placeholder="<?php echo renderLang($account_mantra_label); ?>" value="<?php echo $user_mantra ?>" required>

                                                    <?php if($err) { echo '<p class="error-message text-danger mt-1">'.$_SESSION['sys_general_edit_mantra_err'].'</p>'; unset($_SESSION['sys_general_edit_mantra_err']); } ?>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="card-header pl-0">
                                            <h3 class="card-skills"><?php echo renderLang($account_personal_information); ?></h3>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <!-- FIRSTNAME-->
                                            <div class="col-lg-4">
                                                <?php $err = isset($_SESSION['sys_general_edit_firstname_err']) ? 1 : 0; ?>
                                                <div class="form-group">
                                                    <label for="firstname" class="mr-1<?php if($err) { echo ' text-danger'; } ?>"><?php if($err) { echo '<i class="far fa-times-circle mr-1"></i>'; } echo renderLang($account_firstname_label); ?></label>

                                                    <span class="right badge badge-danger"><?php echo renderLang($label_required); ?></span>

                                                    <input type="text" minlength="1" maxlength="10" class="form-control required<?php if($err) { echo ' is-invalid'; } ?>" id="firstname" name="firstname" placeholder="<?php echo renderLang($account_firstname_label); ?>" value="<?php echo $user_firstname ?>" required>

                                                    <?php if($err) { echo '<p class="error-message text-danger mt-1">'.$_SESSION['sys_general_edit_firstname_err'].'</p>'; unset($_SESSION['sys_general_edit_firstname_err']); } ?>
                                                </div>
                                            </div>
                                            <!-- MIDDLE NAME -->
                                            <div class="col-lg-4">
                                                <?php $err = isset($_SESSION['sys_general_edit_middlename_err']) ? 1 : 0; ?>
                                                <div class="form-group">
                                                    <label for="middlename" class="mr-1<?php if($err) { echo ' text-danger'; } ?>"><?php if($err) { echo '<i class="far fa-times-circle mr-1"></i>'; } echo renderLang($account_middlename_label); ?></label>

                                                    <input type="text" class="form-control required<?php if($err) { echo ' is-invalid'; } ?>" id="middlename" name="middlename" placeholder="<?php echo renderLang($account_middlename_label); ?>" value="<?php echo $user_middlename ?>">

                                                    <?php if($err) { echo '<p class="error-message text-danger mt-1">'.$_SESSION['sys_general_edit_middlename_err'].'</p>'; unset($_SESSION['sys_general_edit_middlename_err']); } ?>
                                                </div>
                                            </div>
                                            <!-- LAST NAME -->
                                            <div class="col-lg-4">
                                                <?php $err = isset($_SESSION['sys_general_edit_lastname_err']) ? 1 : 0; ?>
                                                <div class="form-group">
                                                    <label for="lastname" class="mr-1<?php if($err) { echo ' text-danger'; } ?>"><?php if($err) { echo '<i class="far fa-times-circle mr-1"></i>'; } echo renderLang($account_lastname_label); ?></label>

                                                    <span class="right badge badge-danger"><?php echo renderLang($label_required); ?></span>

                                                    <input type="text" minlength="1" maxlength="10" class="form-control required<?php if($err) { echo ' is-invalid'; } ?>" id="lastname" name="lastname" placeholder="<?php echo renderLang($account_lastname_label); ?>" value="<?php echo $user_lastname ?>" required>

                                                    <?php if($err) { echo '<p class="error-message text-danger mt-1">'.$_SESSION['sys_general_edit_lastname_err'].'</p>'; unset($_SESSION['sys_general_edit_lastname_err']); } ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <!-- NICKNAME-->
                                            <div class="col-lg-4">
                                                <?php $err = isset($_SESSION['sys_general_edit_nickname_err']) ? 1 : 0; ?>
                                                <div class="form-group">
                                                    <label for="nickname" class="mr-1<?php if($err) { echo ' text-danger'; } ?>"><?php if($err) { echo '<i class="far fa-times-circle mr-1"></i>'; } echo renderLang($account_nickname); ?></label>

                                                    <span class="right badge badge-danger"><?php echo renderLang($label_required); ?></span>

                                                    <input type="text" minlength="4" maxlength="50" class="form-control required<?php if($err) { echo ' is-invalid'; } ?>" id="nickname" name="nickname" placeholder="<?php echo renderLang($account_nickname_label); ?>" value="<?php echo $user_nickname ?>" required>

                                                    <?php if($err) { echo '<p class="error-message text-danger mt-1">'.$_SESSION['sys_general_edit_nickname_err'].'</p>'; unset($_SESSION['sys_general_edit_nickname_err']); } ?>
                                                </div>
                                  
                                            </div>
                                         
                                            <!-- IMAGE -->
                                            <div class="col-5">
                                                <?php $err = isset($_SESSION['sys_general_edit_photo_err']) ? 1 : 0; ?>
                                                <div class="form-group">
                                                    <label for="photo" class="mr-1<?php if($err) { echo ' text-danger'; } ?>"><?php if($err) { echo '<i class="far fa-times-circle mr-1"></i>'; } echo renderLang($account_image); ?></label> 
                                                   
                                                    <span class="right badge badge-danger"><?php echo renderLang($label_required); ?></span>
                                                    
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input <?php if($err) { echo ' is-invalid'; } ?>" id="photo" name="photo">
                                                        <label for="photo" class="custom-file-label"><?php echo $user_photo; ?></label>
                                                        <?php if($err) { echo '<p class="error-message text-danger mt-1">'.$_SESSION['sys_general_edit_photo_err'].'</p>'; unset($_SESSION['sys_general_edit_photo_err']); } ?>
                                                        <input type="hidden" name="file_src" value="<?php echo $user_photo; ?>">
                                                    </div>
                                                    <br><br>
                                                    <p><?php echo renderLang($settings_general_msg2);?>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <br>
                                        <div class="card-header pl-0">
                                            <h3 class="card-skills"><?php echo renderLang($account_contact_information); ?></h3>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <!-- EMAIL-->
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="firstname" class="mr-1"><?php echo renderLang($account_email_label);  ?> </label>
                                                    <input type="text" class="form-control required" placeholder="" value="<?php echo $data['user_email'] ?>" disabled>
                                                </div>
                                            </div>
                                            <!-- CONTACT NUMBER -->
                                            <div class="col-lg-4">
                                                <?php $err = isset($_SESSION['sys_general_edit_mobile_err']) ? 1 : 0; ?>
                                                <div class="form-group">
                                                    <label for="mobile" class="mr-1<?php if($err) { echo ' text-danger'; } ?>"><?php if($err) { echo '<i class="far fa-times-circle mr-1"></i>'; } echo renderLang($account_mobile_label); ?></label>

                                                    <span class="right badge badge-danger"><?php echo renderLang($label_required); ?></span>

                                                    <input type="text" minlength="8" maxlength="15" class="form-control required<?php if($err) { echo ' is-invalid'; } ?>" id="mobile" name="mobile" placeholder="<?php echo renderLang($account_mobile_label); ?>" value="<?php echo $user_mobile ?>" required>

                                                    <?php if($err) { echo '<p class="error-message text-danger mt-1">'.$_SESSION['sys_general_edit_mobile_err'].'</p>'; unset($_SESSION['sys_general_edit_mobile_err']); } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- FOOTER -->
                            <div class="card-footer text-right">
                                <a href="/general" class="btn btn-default text-dark mr-1"><i class="fa fa-arrow-left mr-2"></i><?php echo renderLang($btn_back); ?></a>
                                <button class="btn btn-primary"><i class="fa fa-upload mr-2"></i><?php echo renderLang($account_update_account); ?></button>
                            </div>
                        </div>
                    </form>
				</div>
			</section>
		</div>
		<!-- /.content-wrapper -->
        <?php } ?>
		<?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/child-footer.php'); ?>
		
	</div><!-- wrapper -->

	<?php require($_SERVER['DOCUMENT_ROOT'].'/includes/common/js.php'); ?>
	
    <script>
        
		// for input image
		$('#photo').on('change',function(){
			//get the file name
			var photo = $(this).val();
			//replace the "Choose a file" label
			$(this).next('.custom-file-label').html(photo);
		});
    </script>
</body>

</html>

<?php
    } else { // permission not found

        $_SESSION['sys_permission_err'] = renderLang($permission_message_1); // "You are not authorized to access the page or function."
        header('location: /dashboard');

    }
	
} else { // no session found, redirect to login page
	
	$_SESSION['sys_login_err'] = renderLang($login_msg_err_4); // "Session not found.<br>Please login to create one."
	header('location: /login');
	
}
?>