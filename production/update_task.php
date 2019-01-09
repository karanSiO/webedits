<?php
require('connect.php');
include 'functions.php' ;
checkLogin();
?>

<?php
$id = $_POST['id'];
$date = $_POST['date'];
$task = $_POST['task'];
$owner = $_POST['owner'];
$status = $_POST['status'];
$comment = $_POST['comment'];

$moodle_sql = "UPDATE $database.ongoing_tasks SET date = '".$date."', task = '".$task."', owner = '".$owner."', status = '".$status."', comment = '".$comment."' WHERE id = '".$id."'";

if ($conn->query($moodle_sql) === TRUE) {
	echo '<script>window.location.replace("http://training.coralearning.org/manage/data/production/ongoing_task_log.php");</script>';
}
else {
	echo "Error updating moodle table: " . $conn->error."<br>";
}
?>