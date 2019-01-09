<?php
require('connect.php');
include 'functions.php' ;
checkLogin();
?>

<?php
//store the received values in variables

$date = $_POST['date'];
$minutes = $_POST['minutes'];

//query to insert data uin database

$sql = "INSERT INTO $database.meeting_minutes (date,minutes) VALUES ('".$date."','".$minutes."')";
if ($conn->query($sql) === TRUE) {
	echo '<script>window.location.replace("http://training.coralearning.org/manage/data/production/meeting_minutes.php");</script>';
} else {
    echo "Error updating record: " . $conn->error;
}
?>