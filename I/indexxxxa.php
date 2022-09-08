<?php 
include "/C10H15N/Includes/reqs/sess.php";
include ("/C10H15N/Includes/D/config.php");

$search_filter = "SELECT * FROM users";
$search_query = mysqli_query($db_conn, $search_filter);
$search_count = mysqli_num_rows($search_query);

?>
<?php
  if (isset($_POST['selectdate'])){
    if($_SERVER["REQUEST_METHOD"] == "POST") {
      include ("/C10H15N/Includes/D/config.php");

      $from=date('Y-m-d 00:00:00',strtotime($_POST['selectdate']));
      $to=date('Y-m-d 23:59:59',strtotime($_POST['selectdate']));

      $sum_yeses = "SELECT date_encoded, user_department, SUM(bcp_yes) AS sum_yes FROM workinfo where date_encoded between '$from' AND '$to' GROUP BY user_department";
      $sum_yes = mysqli_query($db_conn, $sum_yeses) or die("error to fetch data");

      $sum_nos = "SELECT date_encoded, user_department, SUM(bcp_no) AS sum_no FROM workinfo where date_encoded between '$from' AND '$to' GROUP BY user_department";      
      $sum_no = mysqli_query($db_conn, $sum_nos) or die("error to fetch data");
        
      $sum_infos = "SELECT date_encoded, user_department, SUM(bcp_info) AS sum_info FROM workinfo where date_encoded between '$from' AND '$to' GROUP BY user_department";
      $sum_info = mysqli_query($db_conn, $sum_infos) or die("error to fetch data");

      if ($sum_yes->num_rows > 0) {
        $labels = $yes = '';
        while($row = $sum_yes->fetch_assoc()) {
          //get the company name separated by comma for chart labels
          $labels.= '"' .$row["user_department"]. '",';
          //get the total separated by comma for chart data
          $yes.= $row["sum_yes"].',';
        }
      }

      if ($sum_no->num_rows > 0) {
        $labels = $no = '';
        while($row = $sum_no->fetch_assoc()) {
          //get the company name separated by comma for chart labels
          $labels.= '"' .$row["user_department"]. '",';
          //get the total separated by comma for chart data
          $no.= -1 * $row["sum_no"].',';
        }
      }

      if ($sum_info->num_rows > 0) {
        $labels = $info = '';
        while($row = $sum_info->fetch_assoc()) {
          //get the company name separated by comma for chart labels
          $labels.= '"' .$row["user_department"]. '",';
          //get the total separated by comma for chart data
          $info.= $row["sum_info"].',';
        }
      }
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/C10H15N/images/fontawesome/css/all.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../S/css/topbar.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../S/css/sidebar.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../S/css/index.css?v=<?php echo time(); ?>">
    <title>Home - Dashboard</title>
  </head>
  <body>
  <div>
    	<?php include "../includes/navbar.php"; ?>
    </div>
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <?php include "../includes/sidebar.php"; ?>
    <div class="main_content_wsb" id="main_content">
      <div class="header">Dashboard</div>
      
  </body>
</html>
  <script>
    let today = new Date().toISOString().substr(0, 10);
    document.querySelector("#today2").valueAsDate = new Date();
  </script>
<script src="/RNA/resources/scripts/sidebar.js"></script>
<script src="/RNA/resources/scripts/searchbar.js"></script>