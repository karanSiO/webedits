<?php

//Connection details of Cora learning server database

$username = "jlwood_moodle";
$password = "Job301612!@";
$hostname = "45.40.142.226"; 
$database = "jlwood_moodle";

/*
//Connection details of Cora learning localhost database
$username = "root";
$password = "";
$hostname = "localhost"; 
$database = "coralearning";
*/

$conn = mysqli_connect($hostname, $username, $password,$database) or die("Unable to connect to MySQL");
?>