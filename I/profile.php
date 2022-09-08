<?php 
include "./includes/sess.php";
include ("./includes/config.php");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./resources/css/topbar.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./resources/css/sidebar.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./resources/css/directory.css?v=<?php echo time(); ?>">
    <title>Home - Employee Directory</title>
  </head>
  <body>
    <div>
    	<?php include "./includes/navbar.php"; ?>
    </div>
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <?php include "./includes/sidebar.php"; ?>
    <div class="main_content">
	<div class="header">Profile</div>
  </div>
</div>
</div>
  </body>
</html>
<script src="/DNA/resources/scripts/sidebar.js"></script>
<script src="/DNA/resources/scripts/searchbar.js"></script>