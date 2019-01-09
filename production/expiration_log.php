<?php
	require('connect.php');
  include 'functions.php' ;
    checkLogin();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>CORALearning | Expiration Log</title>

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
                <h3>Expiration Log</h3>
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
                    <h2>Details of account deactivation process</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
						              <th>Email Id</th>
                          <th>Warning Email</th>
                          <th>Warning-Send Date</th>
                          <th>Deactivation Email</th>
                          <th>Extend Expiration</th>
                          <th>New Expiration Date</th>
                          <th>Account Deactivated</th>
                          <th>Deactivation Date</th>
                        </tr>
                      </thead>
                      <tbody>
					<?php

						$sql = "SELECT * FROM $database.account_deactivation_log ORDER BY warning_date DESC";
						$result = mysqli_query($conn, $sql) or die("Selection Error " . mysqli_error($connection));
						if(mysqli_num_rows($result) > 0) {
								while($store_data = mysqli_fetch_assoc($result)) {
            $warning_date = $store_data{'warning_date'};
            $wyear = substr($warning_date, 0, 4);
            $wmonth = substr($warning_date, 4, 2);
            $wday = substr($warning_date, 6, 2);
            $new_warning_date = $wmonth."-".$wday."-".$wyear;
    
            $expiration_date = $store_data{'new_expiration_date'};
            $eyear = substr($expiration_date, 0, 4);
            $emonth = substr($expiration_date, 4, 2);
            $eday = substr($expiration_date, 6, 2);
            $new_expiration_date = $emonth."-".$eday."-".$eyear;
    
            $deactivation_date = $store_data{'deactivation_date'};
            $dyear = substr($deactivation_date, 0, 4);
            $dmonth = substr($deactivation_date, 4, 2);
            $dday = substr($deactivation_date, 6, 2);
            $deactivation_date = $dmonth."-".$dday."-".$dyear;
    
            echo "<tr>";
            echo "<td><a href='edit_expiry.php?email=".$store_data{'emailid'}."' target='blank'>".$store_data{'emailid'}."</a></td>";
            echo "<td>".$store_data{'warning_email'}."</td>";
            echo "<td>".$new_warning_date."</td>";
            echo "<td>".$store_data{'deactivation_email'}."</td>";
            echo "<td>".$store_data{'extend_expiration'}."</td>";
            echo "<td>".$new_expiration_date."</td>";
            echo "<td>".$store_data{'account_deactivated'}."</td>";
            echo "<td>".$deactivation_date."</td>";
            echo "</tr>";
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