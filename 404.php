<?php
require('includes/config.php');
$page = '404';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include('includes/common/links.php'); ?>
  <link rel="stylesheet" href="<?php echo $uri; ?>assets/css/notFound404.css">
  <title>Page Not Found - <?php echo $sitenamee; ?></title>
</head>
<body id="notFound">
  <!-- HEADER -->
  <?php include('includes/common/child-header.php'); ?>
  <!-- /HEADER -->

  <main>
  <!-- Start editing page content here -->
    <section class="mainContent">
      <div class="innerWrap">
        <p class="image"><img src="<?php echo $uri; ?>assets/images/undraw_page_not_found.svg" alt="404 Error Image"></p>
        <h2>Oops! This page is nowhere to be found.</h2>
        <p>Sorry but 404 means that we cannot find any page on our site that is associated to the link you are trying to access.</p>
        <ul class="actionList">
          <li><a class="btn-normal icon-before" href="<?php echo $uri; ?>">Go back to home</a></li>
          <li><a class="btn-normal icon-after" href="<?php echo $uri; ?>services">See services we offer</a></li>
        </ul>
      </div>
    </section>
  <!-- /End editing page content here -->
  </main>

  <!-- FOOTER -->
  <?php include('includes/common/child-footer.php'); ?>
  <!-- /FOOTER -->

  <!-- SCRIPTS -->
  <?php include('includes/common/js.php'); ?>
  <script>

  </script>
  <!-- /SCRIPTS -->
</body>
</html>