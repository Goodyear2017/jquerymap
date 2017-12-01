<?php
	// Set up here your database access credentials
	ini_set("date.timezone", "America/Los_Angeles");
	// Host name
	$host = "";

	// Database name
	$db = "";

	// User
	$user = "";

	// Password
	$pass = "";
	
	$jqm_db = new mysqli($host, $user, $pass, $db);
	if ($jqm_db->connect_errno) { echo "Error MySQL: (" . $jqm_db->connect_errno . ") " . $jqm_db->connect_error; }
	
	$jqm_db->set_charset("utf8");
?>