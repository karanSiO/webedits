<?php
require('connect.php');
include 'functions.php' ;
checkLogin();
?>

<?php
//store the received values in variables

$date = $_POST['date'];
$task = $_POST['task'];
$owner = $_POST['owner'];
$status = $_POST['status'];
$comment = $_POST['comment'];


//query to insert data uin database

$sql = "INSERT INTO $database.ongoing_tasks (date,task,owner,status,comment) VALUES ('".$date."','".$task."','".$owner."','".$status."','".$comment."')";
if ($conn->query($sql) === TRUE) {
	echo '<script>window.location.replace("http://training.coralearning.org/manage/data/production/ongoing_task_log.php");</script>';
} else {
    echo "Error updating record: " . $conn->error;
}
?>