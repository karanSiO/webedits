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

    	<title>CORA Learning </title>

    <!-- Bootstrap -->
    	<link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    	<link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    	<link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    	<link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-wysiwyg -->
    	<link href="../vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
    <!-- Select2 -->
    	<link href="../vendors/select2/dist/css/select2.min.css" rel="stylesheet">
    <!-- Switchery -->
    	<link href="../vendors/switchery/dist/switchery.min.css" rel="stylesheet">
    <!-- starrr -->
    	<link href="../vendors/starrr/dist/starrr.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    	<link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    	<link href="../build/css/custom.min.css" rel="stylesheet">
  	</head>

	<body class="nav-md">
  		<div class="container body">
     		<div class="main_container">
        		<div class="col-md-3 left_col">
          			<div class="left_col scroll-view">
            			<div class="navbar nav_title" style="border: 0;">
              				<a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>CORA Learning</span></a>
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
                				<h3>Change Task Log</h3>
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
                    			<h2>Update the task log</h2>
                    		<div class="clearfix"></div>
                  		</div>
                  	  <div class="x_content">
                    	<br />
                    		<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="update_task.php">
<?php
$id = $_GET['id'];
$sql = "SELECT * FROM $database.ongoing_tasks WHERE id = '".$id."'";
$result = mysqli_query($conn, $sql) or die("Selection Error " . mysqli_error($conn));
if(mysqli_num_rows($result) > 0) {
	while($store_data = mysqli_fetch_assoc($result)) {
		$id = $store_data{'id'};
    $date = $store_data{'date'};
    $task = $store_data{'task'};
    $owner = $store_data{'owner'};
    $status = $store_data{'status'};
    $comment = $store_data{'comment'};
	}
}
?>						
                          <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="id">ID <span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
<?php echo '<input type="text" id="id" name="id" value="'.$id.'" required="required" readonly="readonly" class="form-control col-md-7 col-xs-12">';
?>
</div>
                          </div>
								<div class="form-group">
                        			<label class="control-label col-md-3 col-sm-3 col-xs-12" for="date">Date <span class="required">*</span>
                        			</label>
                        			<div class="col-md-6 col-sm-6 col-xs-12">
<?php echo '<input type="text" id="startdate" name="date" value="'.$date.'" required="required" class="form-control col-md-7 col-xs-12">';
?>
                        			</div>
                    			</div>

		   		   				<div class="form-group">
                        			<label class="control-label col-md-3 col-sm-3 col-xs-12" for="task">Task <span class="required">*</span>
                        			</label>
                        			<div class="col-md-6 col-sm-6 col-xs-12">
<?php echo '<input type="text" id="task" name="task" value="'.$task.'" required="required" class="form-control col-md-7 col-xs-12">';
?>
                        			</div>
                    			</div>

                    			<div class="form-group">
                        			<label class="control-label col-md-3 col-sm-3 col-xs-12" for="owner">Owner<span class="required">*</span>
                        		</label>
                        			<div class="col-md-6 col-sm-6 col-xs-12">
<?php echo '<input type="text" id="owner" name="owner" value="'.$owner.'" required="required" class="form-control col-md-7 col-xs-12">';?>
                        			</div>
                    			</div>

                    			<div class="form-group">
                        			<label class="control-label col-md-3 col-sm-3 col-xs-12" for="status">Status<span class="required">*</span>
                        			</label>
                        			<div class="col-md-6 col-sm-6 col-xs-12">
<?php echo '<input type="text" id="status" name="status" value="'.$status.'" required="required" class="form-control col-md-7 col-xs-12">';?>
                        			</div>
                    			</div>

                          <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="comment">Comment<span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
  <textarea type="text" id="comment" name="comment" required="required" class="form-control col-md-7 col-xs-12"><?php echo $comment; ?></textarea>
                              </div>
                          </div>

								<div class="ln_solid"></div>
                      
                    			<div class="form-group">
                        			<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          				<button type="submit" class="btn btn-success">Submit</button>
                        			</div>
                    			</div>
		 						</form>
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
    <!-- bootstrap-progressbar -->
    <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="../vendors/iCheck/icheck.min.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="../vendors/moment/min/moment.min.js"></script>
    <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap-wysiwyg -->
    <script src="../vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
    <script src="../vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
    <script src="../vendors/google-code-prettify/src/prettify.js"></script>
    <!-- jQuery Tags Input -->
    <script src="../vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
    <!-- Switchery -->
    <script src="../vendors/switchery/dist/switchery.min.js"></script>
    <!-- Select2 -->
    <script src="../vendors/select2/dist/js/select2.full.min.js"></script>
    <!-- Parsley -->
    <script src="../vendors/parsleyjs/dist/parsley.min.js"></script>
    <!-- Autosize -->
    <script src="../vendors/autosize/dist/autosize.min.js"></script>
    <!-- jQuery autocomplete -->
    <script src="../vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
    <!-- starrr -->
    <script src="../vendors/starrr/dist/starrr.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>


    <!-- bootstrap-wysiwyg -->
    <script>
      $(document).ready(function() {
        $('#startdate').daterangepicker({
          singleDatePicker: true,
          calender_style: "picker_4"
        }, function(start, end, label) {
          console.log(start.toISOString(), end.toISOString(), label);
        });
      });
    </script>
    <script>
      $(document).ready(function() {
        function initToolbarBootstrapBindings() {
          var fonts = ['Serif', 'Sans', 'Arial', 'Arial Black', 'Courier',
              'Courier New', 'Comic Sans MS', 'Helvetica', 'Impact', 'Lucida Grande', 'Lucida Sans', 'Tahoma', 'Times',
              'Times New Roman', 'Verdana'
            ],
            fontTarget = $('[title=Font]').siblings('.dropdown-menu');
          $.each(fonts, function(idx, fontName) {
            fontTarget.append($('<li><a data-edit="fontName ' + fontName + '" style="font-family:\'' + fontName + '\'">' + fontName + '</a></li>'));
          });
          $('a[title]').tooltip({
            container: 'body'
          });
          $('.dropdown-menu input').click(function() {
              return false;
            })
            .change(function() {
              $(this).parent('.dropdown-menu').siblings('.dropdown-toggle').dropdown('toggle');
            })
            .keydown('esc', function() {
              this.value = '';
              $(this).change();
            });

          $('[data-role=magic-overlay]').each(function() {
            var overlay = $(this),
              target = $(overlay.data('target'));
            overlay.css('opacity', 0).css('position', 'absolute').offset(target.offset()).width(target.outerWidth()).height(target.outerHeight());
          });

          if ("onwebkitspeechchange" in document.createElement("input")) {
            var editorOffset = $('#editor').offset();

            $('.voiceBtn').css('position', 'absolute').offset({
              top: editorOffset.top,
              left: editorOffset.left + $('#editor').innerWidth() - 35
            });
          } else {
            $('.voiceBtn').hide();
          }
        }

        function showErrorAlert(reason, detail) {
          var msg = '';
          if (reason === 'unsupported-file-type') {
            msg = "Unsupported format " + detail;
          } else {
            console.log("error uploading file", reason, detail);
          }
          $('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>' +
            '<strong>File upload error</strong> ' + msg + ' </div>').prependTo('#alerts');
        }

        initToolbarBootstrapBindings();

        $('#editor').wysiwyg({
          fileUploadError: showErrorAlert
        });

        window.prettyPrint;
        prettyPrint();
      });
    </script>
    <!-- /bootstrap-wysiwyg -->

    <!-- Select2 -->
    <script>
      $(document).ready(function() {
        $(".select2_single").select2({
          placeholder: "Select a state",
          allowClear: true
        });
        $(".select2_group").select2({});
        $(".select2_multiple").select2({
          maximumSelectionLength: 4,
          placeholder: "With Max Selection limit 4",
          allowClear: true
        });
      });
    </script>
    <!-- /Select2 -->

    <!-- jQuery Tags Input -->
    <script>
      function onAddTag(tag) {
        alert("Added a tag: " + tag);
      }

      function onRemoveTag(tag) {
        alert("Removed a tag: " + tag);
      }

      function onChangeTag(input, tag) {
        alert("Changed a tag: " + tag);
      }

      $(document).ready(function() {
        $('#tags_1').tagsInput({
          width: 'auto'
        });
      });
    </script>
    <!-- /jQuery Tags Input -->

    <!-- Parsley -->
    <script>
      $(document).ready(function() {
        $.listen('parsley:field:validate', function() {
          validateFront();
        });
        $('#demo-form .btn').on('click', function() {
          $('#demo-form').parsley().validate();
          validateFront();
        });
        var validateFront = function() {
          if (true === $('#demo-form').parsley().isValid()) {
            $('.bs-callout-info').removeClass('hidden');
            $('.bs-callout-warning').addClass('hidden');
          } else {
            $('.bs-callout-info').addClass('hidden');
            $('.bs-callout-warning').removeClass('hidden');
          }
        };
      });

      $(document).ready(function() {
        $.listen('parsley:field:validate', function() {
          validateFront();
        });
        $('#demo-form2 .btn').on('click', function() {
          $('#demo-form2').parsley().validate();
          validateFront();
        });
        var validateFront = function() {
          if (true === $('#demo-form2').parsley().isValid()) {
            $('.bs-callout-info').removeClass('hidden');
            $('.bs-callout-warning').addClass('hidden');
          } else {
            $('.bs-callout-info').addClass('hidden');
            $('.bs-callout-warning').removeClass('hidden');
          }
        };
      });
      try {
        hljs.initHighlightingOnLoad();
      } catch (err) {}
    </script>
    <!-- /Parsley -->

    <!-- Autosize -->
    <script>
      $(document).ready(function() {
        autosize($('.resizable_textarea'));
      });
    </script>
    <!-- /Autosize -->
  	</body>
</html>