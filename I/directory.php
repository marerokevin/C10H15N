<?php 
include "../includes/sess.php";
include ("../includes/config.php");

$search_filter = "SELECT * FROM users";
$search_query = mysqli_query($db_conn, $search_filter);
$search_count = mysqli_num_rows($search_query);

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../resources/images/fontawesome/css/all.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../resources/css/topbar.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../resources/css/sidebar.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../resources/css/directory.css?v=<?php echo time(); ?>">
    <title>Home - Employee Directory</title>
  </head>
  <body>
    <div>
    	<?php include "../includes/navbar.php"; ?>
    </div>
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <?php include "../includes/sidebar.php"; ?>
    <div class="main_content_wsb" id="main_content">
	<div class="header">Employee Directory</div>
	  <div class="searchbarWrapper" id="searchbarWrapper">
      <input class="searchbar" id="searchbar" onkeyup="search_employee()" type="text" name="search" placeholder="Search..">
    </div>
    <div class="resulttable">
      <table class="tablemain">
        <thead class="fixedHead">
          <tr>
            <th class="resulthead">ID Number</th>
            <th class="resulthead">Name</th>
            <th class="resulthead">Department</th>
            <th class="resulthead">Section</th>
            <th class="resulthead">Location</th>
            <th class="resulthead">E-mail Address</th>
            <th class="resulthead">Telephone Number</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = mysqli_fetch_assoc($search_query)) {?>
            <tr class="kevin">
              <td class="resultbody"><?php echo $row['id_number']; ?></td>
              <td class="resultbody"><?php echo $row['first_name'];?> <?php echo $row['last_name'];?> <?php echo $row['suffix'];?></td>
              <td class="resultbody"><?php echo $row['department']; ?></td>
              <td class="resultbody"><?php echo $row['section']; ?></td>
              <td class="resultbody"><?php echo $row['location']; ?></td>
              <td class="resultbody"><?php echo $row['email_addres']; ?></td>
              <td class="resultbody"><?php echo $row['telephone_number']; ?></td>
            </tr>
          <?php }; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>
</body>
</html>
<script src="/RNA/resources/scripts/sidebar.js"></script>
<script src="/RNA/resources/scripts/searchbar.js"></script>