<?php
require_once 'classControllers/init.php';
// include('backend/Admins.php');


if (!isset($_SESSION["role"])) {
  header('Location:admin_login.php');
}

$admin = new Admins();
$display = $admin->allAdmins();

if (isset($_GET["blockAdminId"])) {
  $id = $_GET["blockAdminId"];
  $blockAdminRes = $admin->blockAdmin($id);
  if ($blockAdminRes == true) {
    header("Location:admins.php");
  }
}

if (isset($_GET["activateAdminId"])) {
  $id = $_GET["activateAdminId"];
  $activateAdminRes = $admin->activateAdmin($id);
  if ($activateAdminRes == true) {
    header("Location:admins.php");
  }
}

if (isset($_GET['delete_id'])) {
  $admin_id = $_GET['delete_id'];

  $message = $admin->DeleteAdmin($admin_id);
}

if (isset($_GET["blockAdminId"])) {
  $id = $_GET["blockAdminId"];
  $blockAdminRes = $admin->blockAdmin($id);
  if ($blockAdminRes == true) {
    header("Location:admins.php");
  }
}

if (isset($_GET["activateAdminId"])) {
  $id = $_GET["activateAdminId"];
  $activateAdminRes = $admin->activateAdmin($id);
  if ($activateAdminRes == true) {
    header("Location:admins.php");
  }
}



?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Dashboard</title>

  <link rel="icon" type="img/png" href="images/hng-favicon.png">
  <link rel="stylesheet" href="css/dashboard.css">

  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

  <style type="text/css">
    .card {
      height: 150px;
      background: #ccc;
      margin: 15px;
      padding: 10px;
      border-radius: 15px;

    }

    .col-md-2 {
      height: 40px;
    }

    .col-md-8 {
      height: 1px;
      padding: 0;
      margin: 0;
    }
  </style>


  <script language="javascript" type="text/javascript">
    function printDiv(divID) {
      //Get the HTML of div
      var divElements = document.getElementById(divID).innerHTML;
      //Get the HTML of whole page
      var oldPage = document.body.innerHTML;

      //Reset the page's HTML with div's HTML only
      document.body.innerHTML =
        "<html><head><title></title></head><body><br><br><br>" + divElements + "</body>";

      //Print Page
      window.print();

      //Restore orignal HTML
      document.body.innerHTML = oldPage;
    }
  </script>
</head>

<body>
  <main class="reg">
    <?php
    if ($_SESSION["role"] != 1) {
      echo '<h2><br><br><br>Sorry, You do not have the priviledge to view this page</p>';
      echo '<h3><a href="dashboard.php">Dashboard</a></h3>';
      exit();
    }
    ?>
    <section id="overview-section">
      <h1>Registered Admins</h1>
      <div class="register-container">
        <div class="row">

          <?php
          if ($display == "0") {
            echo "<h2>There are no Registered Admins</h2>";
          } else {
            ?>
            <div class="col-md-2">
              <a href="new_admin.php">
                <button type="button" class="btn btn-primary btn-sm" id="export">&#43; New Admin</button>
              </a>
            </div>
            <div class="col-md-8"></div>
            <div class="col-md-2">
              <!--<a href="exports/export-to-pdf-mentors.php">-->
              <a href="#" onclick="javascript:printDiv('printablediv')">
                <button type="button" class="btn btn-primary btn-sm" id="export">Export to PDF</button>
              </a>
            </div>
        </div> <br /><br />
        <div class="row">
          <div class="table-responsive" id="printablediv">
            <table class="table table-hover mt-3 mb-1 table-condensed table-bordered" >
              <thead class="table-primary">
                <tr>
                  <th>S/N</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Email</th>
                  <th>Role</th>
                  <th>Registration Date</th>
                  <th colspan="3">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  echo $display;
                  ?>
              </tbody>
            </table>
          </div>
        <?php
        }
        ?>

        </div>
      </div>
      <br /><br />
      <!-- <button id="export">Export to Spreadsheet</button> -->

    </section>
    <!-- <section id="details-section">

			<div id="details-back">
                <div>
                    <a href="overview.html" id="newitem-go-back" title="Go back">
                        <div></div>
                    </a>
                </div>
            </div>
			<h2>Intern application details</h2>
			<em id="no-intern">No intern selected</em>
			<br />
			<p>Name: <span id="details-name"></span></p>
			<p>Email: <span id="details-email"></span></p>
			<p>Age: <span id="details-age"></span></p>
			<p>Phone Number: <span id="details-number"></span></p>
			<p>Track of interest: <span id="details-track"></span></p>
			<p>CV link: <span id="details-CV-link"></span></p>
			<p>State of residence: <span id="details-state-of-residence"></span></p>
			<div href="" id="details-return">Back to Overview</div>
		</section> -->
  </main>

  <input type="checkbox" id="mobile-bars-check" />
  <label for="mobile-bars-check" id="mobile-bars">
    <div class="stix" id="stik1"></div>
    <div class="stix" id="stik2"></div>
    <div class="stix" id="stik3"></div>
  </label>

  <?php include('fragments/sidebar.php'); ?>

</body>

</html>

<script type="text/javascript" src="js/dashboard.js"></script>