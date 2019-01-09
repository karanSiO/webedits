<?php

//CREDENTIALS FOR DB
define ('DBSERVER', '45.40.142.226');
define ('DBUSER', 'jlwood_moodle');
define ('DBPASS','Job301612!@');
define ('DBNAME','jlwood_moodle');

//LET'S INITIATE CONNECT TO DB
$connection = mysql_connect(DBSERVER, DBUSER, DBPASS) or die("Can't connect to server. Please check credentials and try again");
$result = mysql_select_db(DBNAME) or die("Can't select database. Please check DB name and try again");

//CREATE QUERY TO DB AND PUT RECEIVED DATA INTO ASSOCIATIVE ARRAY
if (isset($_REQUEST['query'])) {
    $query = $_REQUEST['query'];
    $sql = mysql_query ("SELECT school_name FROM participation_login WHERE school_name LIKE '%{$query}%'");
	$array = array();
    while ($row = mysql_fetch_array($sql)) {
        $array[] = array (
            'label' => $row['school_name'],
            'value' => $row['school_name'],
        );
    }
    //RETURN JSON ARRAY
    echo json_encode ($array);
}

?>