<?php 
include "../includes/sess.php";
include ("../includes/config.php");

$search_filter = "SELECT * FROM users";
$search_query = mysqli_query($db_conn, $search_filter);
$search_count = mysqli_num_rows($search_query);

?>
<?php
  if (isset($_POST['selectdate'])){
    if($_SERVER["REQUEST_METHOD"] == "POST") {
      include ("../includes/config.php");

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
    <link rel="stylesheet" href="../resources/css/topbar.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../resources/css/sidebar.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../resources/css/RM.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../resources/css/index.css?v=<?php echo time(); ?>">
    <title>Home - Risk Mitigation</title>
  </head>
  <body>
    <div>
    	<?php include "../includes/navbar.php"; ?>
    </div>
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <?php include "../includes/sidebar.php"; ?>
    <div class="main_content_wsb" id="main_content">
	    <div class="header">Risk Mitigation</div>
      <div class="topnavticket">
        <li class="navholder">
          <a onload="tablet1()" id="create" class="navticket-off" href="/RNA/K/Risk-Miti.php?action=create">Create</a>
          <a onclick="tablet2()" id="approval" class="navticket-off" href="/RNA/K/Risk-Miti.php?action=approval">Approval</a>
          <a onclick="tablet3()" id="confirm" class="navticket-off" href="/RNA/K/Risk-Miti.php?action=confirm">Confirmation</a>
          <a onclick="tablet4()" id="status" class="navticket-off" href="/RNA/K/Risk-Miti.php?action=status">Status</a>
        </li>
      </div>
      <div class="roomcontainer">
        <!--Date Selector-->
        <div class="wallhanger">
            <form class="dateselect" method="POST">
                <label class="dateLabel" type="date">Date: </label>
                <input class="datepicker" type="date" name="selectdate" id="today2">
                <button class="datebutton" type="submit" value="View" name="submit" id="submit">View</button>
            </form>
        </div>
        <div class="bedsidetable">
        <!--System Time-->
          <div class="systemtime" type="currenttime" id="currentTime"></div>
        </div>
      </div>
    <!--Bar Chart Display-->
      <div class="chart_container">
        <canvas class="test" id="myChart"></canvas>
      </div>
    <!--Table Display - Total-->
    <div class="table-container">
      <div class="table-summary">
        <table class="total">
            <h2 class="table-title-head">Total Manpower - Summary</h2>
          <tr class="table-head-summary">
            <th class="yes-head">Yes</th>
            <th class="no-head">No</th>
            <th class="info-head">No Information</th>
          </tr>
          <?php
            if (isset($_POST['selectdate'])){
              if($_SERVER["REQUEST_METHOD"] == "POST") {
                include ("../includes/config.php");
                $sql = "SELECT date_encoded, user_department, SUM(bcp_yes) AS sum_yes, SUM(bcp_no) AS sum_no, SUM(bcp_info) AS sum_info FROM workinfo where date_encoded between '$from' AND '$to'";
                $result = mysqli_query($db_conn,$sql);
                while($row=mysqli_fetch_array($result)){ ?>
                <tr class="table-body">
                  <td class="yes-body"><?php echo $row['sum_yes'];?></td>
                  <td class="no-body"><?php echo $row['sum_no'];?></td>
                  <td class="info-body"><?php echo $row['sum_info'];?></td>
                </tr>
              </table>
            </div>
    <?php       }
              }
            }?>
    <!--Table Display - Per Department-->
    <div class="table-perdept">
      <table class="perdept">
        <h2 class="table-title-perdept-head">Total per Department</h2>
        <tr class="table-head-perdept">
          <th class="depart-head">Department</th>
          <th class="date-head">Date Encoded</th>
          <th class="yes_per-head">Yes</th>
          <th class="no_per-head">No</th>
          <th class="info_per-head">No Information</th>
        </tr>
        <?php
        if (isset($_POST['selectdate'])){
          if($_SERVER["REQUEST_METHOD"] == "POST") {
          include ("../includes/config.php");
        $sql = "SELECT date_encoded, user_department, SUM(bcp_yes) AS sum_yes, SUM(bcp_no) AS sum_no, SUM(bcp_info) AS sum_info FROM workinfo where date_encoded between '$from' AND '$to' GROUP BY user_department";
        $result = mysqli_query($db_conn, $sql);
        while($row=mysqli_fetch_array($result)){ ?>
        <tr class="table-body-perdept">
          <td class="depart-body"><?php echo $row['user_department'];?></td>
          <td class="date-body"><?php echo $row['date_encoded'];?></td>
          <td class="yes_per-body"><?php echo $row['sum_yes'];?></td>
          <td class="no_per-body"><?php echo $row['sum_no'];?></td>
          <td class="info_per-body"><?php echo $row['sum_info'];?></td>
        </tr>
      </table>
    </div>
    <?php }}}?>
      <div class="tabContainer">
        <?php 
        if ( isset($_GET['action']) && $_GET['action']=="create") {
            include('../F/create.php');
          } else if ( isset($_GET['action']) && $_GET['action']=="approval") {
            include('../F/approval.php');
          } else if ( isset($_GET['action']) && $_GET['action']=="confirm") {
            include('../F/confirm.php');
          } else if ( isset($_GET['action']) && $_GET['action']=="status") {
            include('../F/status.php');
          }
        ?>
      </div>
    </div>
  </div>
</div>
  </body>
</html>
<script src="/RNA/resources/scripts/sidebar.js"></script>
<script src="/RNA/resources/scripts/searchbar.js"></script>
<script src="/RNA/resources/scripts/tablets.js"></script>
<script src="/RNA/resources/scripts/time2.js"></script>
<script>
var config, ctx;
  config = {
    type: 'bar',
    data: {
      labels: [<?php echo trim($labels);?>],
      datasets: [{
        label: 'Yes',
        backgroundColor: "rgba(18,122,0,0.9)",
        fillColor: "rgba(18,122,0,0.5)",
        data: [<?php echo trim($yes);?>],
      }, 
      {
        label: 'No Information',
        backgroundColor: "#8c8c8c",
        data: [<?php echo trim($info);?>]
      }, 
      {
        label: 'No',
        backgroundColor: '#89051b',
        data: [<?php echo trim($no);?>]
      }]
    },
    options: {
      scales: {
        xAxes: [{
          stacked: true
        }],
        yAxes: [{
          stacked: true
        }]
      }
    }
  };

  ctx = document.getElementById("myChart").getContext("2d");
  new Chart(ctx, config);
</script>