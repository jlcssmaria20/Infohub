<?php
// INCLUDES
$module = 'login';
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
  <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;400;700&amp;display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
<link rel="stylesheet" href="/tcapWebsite/assets/common/css/reset.css">
<link rel="stylesheet" href="/tcapWebsite/assets/common/css/common.css">  <link rel="stylesheet" href="/tcapWebsite/assets/css/careers.css">
  <title>Careers - Forgot Password</title>
</head>
<style>
    .modFormArea input {
        margin: 0 0  !important;
    }
</style>

	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo renderLang($sitename); ?></title>
	<?php include($root.'/includes/common/links.php'); ?>
	<link rel="stylesheet" href="/modules/<?php echo $module; ?>/assets/css/style.css">
  <main>

  <section id="loginModal" class="login modal" style="display: block; transition: all 2s ease-in-out 0s;">
    <div class="modalWrap">
      <div class="modFormArea">
        <p class="title">Hi there!</p>
        <p>Make sure your account is activated before submitting forgot password!</p>
        <div id="otherExam" class="alert alert-success" style="display: none;"><h5><i class="icon fas fa-check"></i> Success!</h5>New Password has been sent to your email!</div>
        <form action="/forgot-function" method="post">
            <div class="input-group mb-3">
                <input type="email" id="email" class="form-control" name="email" placeholder="Enter Email" required>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-user"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <button type="submit" name="submit-login" class="btn btn-danger btn-block btn-flat">Submit</button>
                </div>
            </div>
            
        </form>
        <p class="notes">Don’t have an account yet?&nbsp;<a href="registration-form" id="registerBtn2">Register here -&gt;</a></p>
      </div>
    </div>
  </section>


  </main>

<!-- JAVASCRIPT -->
<script src="/plugins/jquery/jquery.min.js"></script>
<script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/dist/js/adminlte.min.js"></script>
<script>
    $(function() {
        
        // set uname focus if it is not blank, else focus on upass
        if($('#uname').val() == '') {
            $('#uname').focus();
        } else {
            $('#upass').focus();
        }

    });
</script>

<?php
	if(isset($_SESSION['forgot-password']) == 'forgot-password') { 
?>
<script>
	$("div#otherExam").html();
	$("div#otherExam").css("display","block");
</script>
<?php
}
?>