<?php
require('connect.php');
include 'functions.php' ;
checkLogin();
?>

<?php
//store the received values in variables

$fullname = $_POST['fullname'];
$emailid = $_POST['emailid'];
$via = $_POST['via'];
$issue = $_POST['issue'];
$techfailure = $_POST['techFailure'];
$comment = $_POST['comment'];
$status = $_POST['status'];
$today=getdate(date("U"));
$todayYear = $today['year'];
$todayMonth = $today['mon'];
if($todayMonth != 11 || $todayMonth != 12) {
$todayMonth="0".$todayMonth;
}
$todayDay = $today['mday'];
$todayDayLength = strlen($todayDay);
if ($todayDayLength == 1) {
	$todayDay = "0".$todayDay;
}
$finaldate = $todayYear.$todayMonth.$todayDay;
//query to insert data uin database

$sql = "INSERT INTO $database.issue_log (date,full_name,email_id,via,issue,technical_failure,comments,status) VALUES ('".$finaldate."','".$fullname."','".$emailid."','".$via."','".$issue."','".$techfailure."','".$comment."','".$status."')";
if ($conn->query($sql) === TRUE) {
		echo '<script>window.location.replace("http://training.coralearning.org/manage/data/production/issue_submitted.php");</script>';
} else {
    echo "Error updating record: " . $conn->error;
}
?>