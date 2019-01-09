<?php
require('connect.php');
include 'functions.php' ;
checkLogin();
?>

<?php
$email = $_POST['email'];
$warning_email = $_POST['warning_email'];
$warning_date = $_POST['warningdate'];
$deactivationemail = $_POST['deactivationemail'];
$extendexpiration = $_POST['extendexpiration'];
$newexpirationdate = $_POST['newexpirationdate'];
$accountdeactivated = $_POST['accountdeactivated'];
$deactivationdate = $_POST['deactivationdate'];

$expirationdate_moodle = $deactivationdate;
			    $wyear = substr($expirationdate_moodle, 0, 4);
			   $wmonth = substr($expirationdate_moodle, 4, 2);
				 $wday = substr($expirationdate_moodle, 6, 2) + 1;
				  $day = $wmonth."/".$wday."/".$wyear;
$unix_timestamp = strtotime($day);

$moodle_sql = "UPDATE $database.mdl_user_enrolments mue, $database.mdl_user mu SET timeend = '".$unix_timestamp."' WHERE mu.email = '".$email."' AND mue.userid = mu.id";

if ($conn->query($moodle_sql) === TRUE) {
	$sql = "UPDATE $database.account_deactivation_log SET warning_email = '".$warning_email."',warning_date= ".$warning_date.", deactivation_email = '".$deactivationemail."', extend_expiration = '".$extendexpiration."', new_expiration_date = '".$newexpirationdate."', account_deactivated ='".$accountdeactivated."', deactivation_date = '".$deactivationdate."' WHERE emailid = '".$email."'";
	if ($conn->query($sql) === TRUE) {
		//echo $sql;
		echo '<script>window.location.replace("http://training.coralearning.org/manage/data/production/expiration_changed.php");</script>';
	}
	else {
		echo "Error updating dashboard table: " . $conn->error."<br>";
	}
}
else {
	echo "Error updating moodle table: " . $conn->error."<br>";
}
?>