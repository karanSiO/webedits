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

    <title>CORALearning | View Issues</title>

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
                <h3>Principal Emails</h3>
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
                    <h2>List of all the pricipals to whom emails has been send</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>District</th>
                          <th>State</th>
                          <th>School</th>
                          <th>Full Name</th>
                          <th>First Name</th>
                          <th>Last Name</th>
                          <th>Email</th>
                          <th>Phone</th>
                          <th>Fax</th>
                          <th>Address</th>
                          <th>City</th>
                          <th>Zip</th>
                          <th>Zip4</th>
                          <th>Mailing Address</th>
                          <th>Mailing City</th>
                          <th>Mailing State</th>
                          <th>Mailing Zip</th>
                          <th>Mailing Zip4</th>
                          <th>Status</th>
                          <th>Send Date</th>
                        </tr>
                      </thead>
                      <tbody>
          <?php

            $sql = "SELECT * FROM $database.principal";
            $result = mysqli_query($conn, $sql) or die("Selection Error " . mysqli_error($connection));
            if(mysqli_num_rows($result) > 0) {
                while($store_data = mysqli_fetch_assoc($result)) {
            $send_date = $store_data{'send_date'};
            $wyear = substr($send_date, 0, 4);
            $wmonth = substr($send_date, 4, 2);
            $wday = substr($send_date, 6, 2);
            $new_send_date = $wmonth."-".$wday."-".$wyear;
    
            echo "<tr>";
            echo "<td>".$store_data{'district'}."</td>";
            echo "<td>".$store_data{'state'}."</td>";
            echo "<td>".$store_data{'school'}."</td>";
            echo "<td>".$store_data{'full_name'}."</td>";
            echo "<td>".$store_data{'first_name'}."</td>";
            echo "<td>".$store_data{'last_name'}."</td>";
            echo "<td>".$store_data{'email'}."</td>";
            echo "<td>".$store_data{'phone'}."</td>";
            echo "<td>".$store_data{'fax'}."</td>";
            echo "<td>".$store_data{'address'}."</td>";
            echo "<td>".$store_data{'city'}."</td>";
            echo "<td>".$store_data{'zip'}."</td>";
            echo "<td>".$store_data{'zip4'}."</td>";
            echo "<td>".$store_data{'mailing_address'}."</td>";
            echo "<td>".$store_data{'mailing_city'}."</td>";
            echo "<td>".$store_data{'mailing_state'}."</td>";
            echo "<td>".$store_data{'mailing_zip'}."</td>";
            echo "<td>".$store_data{'mailing_zip4'}."</td>";
            echo "<td>".$store_data{'status'}."</td>";
            echo "<td>".$new_send_date."</td>";
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