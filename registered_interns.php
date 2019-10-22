<?php
require 'classControllers/init.php';

if (!isset($_SESSION["role"])) {
  header('Location:admin_login.php');
}
// include('backend/Interns.php');
$interns = new Intern;
$display = $interns->allInterns();
$internDetails = $interns->view();
$searc = $interns->search();

if (isset($_GET['delete_id'])) {
  $intern_id = $_GET['delete_id'];

  $message = $interns->DeleteIntern($intern_id);
}

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Interns</title>
  <link rel="icon" type="img/png" href="images/hng-favicon.png">
  <link rel="stylesheet" href="css/dashboard.css">

  <!-- Latest compiled and minified CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <!-- Optional JavaScript -->
   <!-- jQuery first, then Popper.js, then Bootstrap JS -->

   <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous"></script>
   <!-- <script src="jquery-3.4.1.min.js"></script> -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>



  <!-- jQuery library -->
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->

  <!-- Latest compiled JavaScript -->
  <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script> -->

  <style type="text/css">
    .card {
      height: 150px;
      background: #ccc;
      margin: 15px;
      padding: 10px;
      border-radius: 15px;

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
    <section id="overview-section interns-list">
      <!-- <h1>Dashboard</h1> -->
      <h2>Registered Interns </h2>
      <!-- <section id="intern-section">
				Populated by `js/dashboard.js`
			</section> -->

      <div class="container">
        <div class="row">

          <?php
          if ($display == "0") {
            echo "<h2>There are no Registered Interns</h2>";
          } else {
            ?>
            <!--<div class="col-md-3">-->
            <!--    <a href="exports/export-to-excel.php">-->
            <!--        <button type="button" id="export">Export to Spreadsheet</button>-->
            <!--    </a>-->
            <!--</div>-->
            <div class="col-md-3">
              <!--<a href="exports/export-to-pdf.php">-->
              <a href="#" onclick="javascript:printDiv('printablediv')">
                <button type="button" class="btn btn-info" id="export">Export to PDF</button>
              </a>
            </div>
            <div class="table-responsive" id="printablediv">

      <?php
          if(isset($_POST['search']))
          {
            while ($search = mysqli_fetch_assoc($searc)) {
              echo "<div class='text-center bg-secondary'>".$search['name'].", Intern id is
              ".$search['intern_id']." and Location is ".$search['current_location']."</div><br/>";
        }
      }
      ?>

        <form action="" method="post">
            <input type="text" class="form-control mt-3 mb-0" name="valueToSearch" placeholder="Search Intern By Name or Location"class="ml-5" /><br><br>
            <input type="submit" name="search" value="Search" class="ml-5 mt-0 btn btn-info" /><br><br>


              <table class="table table-hover table-bordered  mt-3 mb-1 table-condensed">
                <thead class="table-primary">
                  <tr>
                    <th></th>
                    <th>S/N</th>
                    <th>Name</th>
                    <th>Emai</th>
                    <th>Phone</th>
                    <!-- <th>Porfolio</th> -->
                    <th>CV</th>
                    <th>Exp</th>
                    <th>Interest</th>
                    <th>Location</th>
                    <th>Emp. Stat</th>
                    <th>About</th>
                    <th>Reg. Date</th>
                    <th>Action</th>

                  </tr>
                </thead>
                <tbody>
                  <?php
                    echo $display;
                    ?>
                </tbody>
              </table>
            </form>

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


  <?php ob_start(); ?>
    <!-- Modal -->
    <div class="modal fade details-1" id="details-modal" tabindex="-1"
    role="dialog" aria-labelledby="details-l" aria-hidden="true">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
          <div class="modal-header text-center">
            <h3>Intern Details</h3>
          </div>
          <div class="modal-body">
            <div class="container">
              <div class="row">

                <div class="col-sm-7">

                  <div>Intern ID: <?=$internDetails['intern_id'];?></div>
                  <div>Name: <?=$internDetails['name'];?></div>
                  <div>Email: <?=$internDetails['email'];?></div>
                  <div>Phone No: <?=$internDetails['phone_no'];?></div>
                  <div>Link: <?=$internDetails['link_to_portfolio'];?></div>
                  <div>Link: <?=$internDetails['link_to_cv'];?></div>
                  <div>Years: <?=$internDetails['years_of_experience'];?></div>
                  <div>Interest: <?=$internDetails['interest'];?></div>
                  <div>Location: <?=$internDetails['current_location'];?></div>
                  <div>Status: <?=$internDetails['employment_status'];?></div>
                  <div>About: <?=$internDetails['about'];?></div>
                  <div>Time: <?=$internDetails['timestamp'];?></div>
                </div>
                <div class="col-sm-6 modal-footer"></div>
                <div class="modal-footer col-sm-6">
                  <button type="button" class="btn btn-info" onclick="closeModel()">Close</button>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>

  <?php echo ob_get_clean(); ?>

  <script>

  // Ajax request from Modal To display the each intern.
    function interndetails(id){
      // alert(id);
      var data = {"id" : id};
      jQuery.ajax({
        url : 'registered_interns.php',
        method : "get",
        data : data,
        success: function(data){
          jQuery('body').append(data);
          jQuery('#details-modal').modal('toggle');
        },
        error: function(){alert("Something went wrong!")},
      });
    }

   // To close the display of each intern
      function closeModel(){
        jQuery('#details-modal').modal('hide');
        setTimeout(function(){
          jQuery('#details-modal').remove();
          jQuery('.modal-backdrop').remove();
        },500);
      }

    </script>


  <script type="text/javascript" src="js/dashboard.js"></script>


</body>

</html>
