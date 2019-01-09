<?php
session_start();

// remove all session variables
session_unset(); 

// destroy the session 
session_destroy(); 

header('Location: http://training.coralearning.org/manage/data/production/login.php');
exit; 

?>
