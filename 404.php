<?php
require('includes/config.php');
$page = '404';
$uri = '/';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include('includes/common/links.php'); ?>
  <link rel="stylesheet" href="<?php echo $uri; ?>assets/css/notFound404.css">
        <link rel="icon" type="image/x-icon" href="assets/images/favicon.png">
  <title>Page Not Found - <?php echo $sitenamee; ?></title>
</head>
<body id="notFound">

  <main class="container w-75">
  
    <section class="mt-5 text-center">
      <div class="innerWrap">

        <p class="image"><img src="<?php echo $uri; ?>assets/images/404.jpg" style="width:500px" alt="404 Error Image"></p>
        <h2>Oops! This page is nowhere to be found.</h2>
        <p>Sorry but 404 means that we cannot find any page on our site that is associated to the link you are trying to access.</p>
        <ul class="actionList">
          <a href="<?php echo $uri; ?>" class="btn btn-primary">Go Back Home</a>
        </ul>
      </div>
    </section>
 
  </main>

  
  <?php include('includes/common/js.php'); ?>

</body>
</html>