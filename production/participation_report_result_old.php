<?php
	require('connect.php');
  include 'functions.php' ;
    checkLogin();
?>
<?php
//Get the data from form
$course = $_POST['course'];
$college = $_POST['college'];
$enddate = strtotime($_POST['enddate']);
$startdate = strtotime($_POST['startdate']);
$coupon = $_POST['coupon'];

//Initialize the variables
$enrolled = 0;
$completed = 0;
$progress = 0;
$enrolledarray = array();
$completedarray = array();
$progessarray = array();


//Initialize the certificateid
if ($course == "Teaching Men of Color in Community College") {
  $certificateid = 2;
}
else if ($course == "Supporting Men of Color in Community College"){
  $certificateid = 3;
}
else if ($course == "Teaching Boys and Young Men of Color"){
  $certificateid = 4;
}
else if ($course == "Racial Microaggressions"){
  $certificateid = 5;
}
else if ($course == "Unconscious Bias"){
  $certificateid = 6;
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>CORALearning | Participation Report</title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.php" class="site_title"><i class="fa fa-paw"></i> <span>CORA Learning</span></a>
            </div>

            <div class="clearfix"></div>
			
			<!-- Menu Profile -->
            <?php
            	include('menu-profile.php');
            ?>
			<!-- End of menu profile -->

            <br />

            <!-- sidebar menu -->
            <?php 
				include('sidebar.php');
			?>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <?php 
				include('menu-footer-buttons.php');
			?>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
            <?php 
				include('top-navigation.php');
			?>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Participation Report</h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Yoohoo!! Here is your participation report</h2>
                    <div class="clearfix"></div>
                  </div>
                  <p style="text-align:center;">
                  <?php
                    //Print some data
                    echo "<strong>Training:</strong> ".$course."<br />";
                    echo "<strong>Report Start Date:</strong> ".$_POST['startdate']."<br />";
                    echo "<strong>Report End Date:</strong> ".$_POST['enddate']."<br />";
                    echo "<strong>College:</strong> ".$college."<br />"; 
                    echo "<strong><a href='http://coralearning.org/manage/send_coupon_api.php?action=get_data&coupon=".$coupon."' target='_blank'>Coupon Count</a></strong></br>";
                    ?>
                  </p>
<?php
//Summary Enrolled count
$sql = "SELECT count(u.id) as enrolled from $database.mdl_user u, $database.mdl_user_info_data ud where u.id = ud.userid AND ud.fieldid = 2 AND u.id in (SELECT userid FROM $database.mdl_user_info_data WHERE data = '".$college."') AND timecreated between ".$startdate." AND ".$enddate;
$result = mysqli_query($conn, $sql) or die("Selection Error " . mysqli_error($conn));
if(mysqli_num_rows($result) > 0) {
  while($store_data = mysqli_fetch_assoc($result)) {
    $enrolled = $store_data{'enrolled'};
  }
}

//Array of enrolled users
$sql = "SELECT u.id as user_id from $database.mdl_user u, $database.mdl_user_info_data ud where u.id = ud.userid AND ud.fieldid = 2 AND u.id in (SELECT userid FROM $database.mdl_user_info_data WHERE data = '".$college."') AND u.timecreated between ".$startdate." AND ".$enddate."";
$result = mysqli_query($conn, $sql) or die("Selection Error " . mysqli_error($conn));
if(mysqli_num_rows($result) > 0) {
  while($store_data = mysqli_fetch_assoc($result)) {
    $user_id = $store_data{'user_id'};
    array_push($enrolledarray,$user_id);
  }
}    

//Summary Completed count
$sql = "SELECT count(u.id) as completed FROM $database.mdl_user u, $database.mdl_certificate_issues ci WHERE u.id IN (SELECT userid FROM $database.mdl_user_info_data WHERE data = '".$college."') AND u.id = ci.userid AND ci.certificateid = ".$certificateid." AND u.timecreated between ".$startdate." AND ".$enddate."";
echo $sql;
$result = mysqli_query($conn, $sql) or die("Selection Error " . mysqli_error($conn));
if(mysqli_num_rows($result) > 0) {
  while($store_data = mysqli_fetch_assoc($result)) {
    $completed = $store_data{'completed'};
  }
} 

//Array of completed users
$sql = "SELECT u.id as user_id FROM $database.mdl_user u, $database.mdl_certificate_issues ci WHERE u.id IN (SELECT userid FROM $database.mdl_user_info_data WHERE data = '".$college."') AND u.id = ci.userid AND ci.certificateid = ".$certificateid." AND u.timecreated between ".$startdate." AND ".$enddate."";
$result = mysqli_query($conn, $sql) or die("Selection Error " . mysqli_error($conn));
if(mysqli_num_rows($result) > 0) {
  while($store_data = mysqli_fetch_assoc($result)) {
    $user_id = $store_data{'user_id'};
    array_push($completedarray,$user_id);
  }
} 

//In progress count
$progress = $enrolled - $completed;
?>

                  <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <div class="x_panel">
                        <div class="x_title">
                          <h2>Summary</h2>
                          <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                          <table class="table">
                            <thead>
                              <tr>
                                <th>User Status Summary</th>
                                <th>Number Of Users</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td><strong>Enrolled:</strong></td>
                                <td><?php echo $enrolled ?></td>
                              </tr>
                              <tr>
                                <td><strong>Completed:</strong></td>
                                <td><?php echo $completed ?></td>
                              </tr>
                              <tr>
                                <td><strong>In Progress:</strong></td>
                                <td><?php echo $progress ?></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12"></div>
                  </div>

                  <h4>The Report</h4>
                  <div class="x_content">
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>User Id</th>
                          <th>First Name</th>
                          <th>Last Name</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>

					<?php
            $arrlength = count($completedarray);
            
            for($x = 0; $x < $arrlength; $x++) {
						$sql = "SELECT id, firstname, lastname FROM $database.mdl_user WHERE id =".$completedarray[$x]."";
						$result = mysqli_query($conn, $sql);
						  if(mysqli_num_rows($result) > 0) {
							  while($store_data = mysqli_fetch_assoc($result)) {
								  echo "<tr>";
								  echo "<td>".$store_data{'id'}."</td>";
								  echo "<td>".$store_data{'firstname'}."</td>";
								  echo "<td>".$store_data{'lastname'}."</td>";
								  echo "<td>Certified</td>";
								  echo "</tr>";
							  }
						  }
            }

            for ($x=0; $x < sizeof($enrolledarray); $x++) {
              if (!in_array($enrolledarray[$x], $completedarray)) {
                  array_push($progessarray, $enrolledarray[$x]);
              }
            }

            $arrlength = count($progessarray);
            for($x = 0; $x < $arrlength; $x++) {
              $sql = "SELECT id, firstname, lastname FROM $database.mdl_user WHERE id =".$progessarray[$x]."";
              $result = mysqli_query($conn, $sql);
              if(!$result) {
                echo "";
              }
              else {
                if(mysqli_num_rows($result) > 0) {
                  while($store_data = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>".$store_data{'id'}."</td>";
                    echo "<td>".$store_data{'firstname'}."</td>";
                    echo "<td>".$store_data{'lastname'}."</td>";
                    echo "<td>In Progress</td>";
                    echo "</tr>";
                  }
                }
              }
            }
					?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            &copy All right reserved by <a href="https://www.coralearning.org">CORA Learning</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- iCheck -->
    <script src="../vendors/iCheck/icheck.min.js"></script>
    <!-- Datatables -->
    <script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="../vendors/datatables.net-scroller/js/datatables.scroller.min.js"></script>
    <script src="../vendors/jszip/dist/jszip.min.js"></script>
    <script src="../vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="../vendors/pdfmake/build/vfs_fonts.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>

    <!-- Datatables -->
    <script>
      $(document).ready(function() {
        var handleDataTableButtons = function() {
          if ($("#datatable-buttons").length) {
            $("#datatable-buttons").DataTable({
              dom: "Bfrtip",
              buttons: [
                {
                  extend: "copy",
                  className: "btn-sm"
                },
                {
                  extend: "csv",
                  className: "btn-sm"
                },
                {
                  extend: "excel",
                  className: "btn-sm"
                },
                {
                  extend: "pdfHtml5",
                  className: "btn-sm"
                },
                {
                  extend: "print",
                  className: "btn-sm"
                },
              ],
              responsive: true
            });
          }
        };

        TableManageButtons = function() {
          "use strict";
          return {
            init: function() {
              handleDataTableButtons();
            }
          };
        }();

        $('#datatable').dataTable();

        $('#datatable-keytable').DataTable({
          keys: true
        });

        $('#datatable-responsive').DataTable();

        $('#datatable-scroller').DataTable({
          ajax: "js/datatables/json/scroller-demo.json",
          deferRender: true,
          scrollY: 380,
          scrollCollapse: true,
          scroller: true
        });

        $('#datatable-fixed-header').DataTable({
          fixedHeader: true
        });

        var $datatable = $('#datatable-checkbox');

        $datatable.dataTable({
          'order': [[ 1, 'asc' ]],
          'columnDefs': [
            { orderable: false, targets: [0] }
          ]
        });
        $datatable.on('draw.dt', function() {
          $('input').iCheck({
            checkboxClass: 'icheckbox_flat-green'
          });
        });

        TableManageButtons.init();
      });
    </script>
    <!-- /Datatables -->
  </body>
</html>