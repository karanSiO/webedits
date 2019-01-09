<?php

session_start();
function checkLogin()
{
	if(!isset($_SESSION['sid'])){ header("location: login.php"); }

}
?>