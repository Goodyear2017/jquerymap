<?php

define('IN_SCRIPT', true); 
error_reporting(E_ALL);
	require_once("config.php");
	
	include_once ('languages/common.php');
	$list_states = "<option value=\"\"></option>";

	$sql = "SELECT countryID, stateID, state FROM jqm_us_states ORDER BY stateID";
	$query = $jqm_db->query($sql);

	if ($query->num_rows > 0)
		while ($rd = $query->fetch_assoc())
			$list_states .= "<option value=\"" . strtolower($rd['countryID'] . "_" . $rd['stateID']) . "\">" . $rd['state'] . "</option>";
	$query->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>

 <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Even Map Form</title>
    <meta name="robots" content="noindex, follow">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    
  
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/smoothness/jquery-ui.css" />
  <link rel="stylesheet" type="text/css" href="css/jquery-ui-timepicker-addon.css" />
	
	
<script type="text/javascript" src="js/bootstrap-validator.js"></script>
<script type="text/javascript" src="js/jquery-ui-timepicker-addon.js"></script>
<style>
body{background-color:#fff !important;}
.content{background-color:#fff !important;}
.box{background-color:#fff !important;}

</style>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-88575803-1', 'auto');
  ga('send', 'pageview');

</script>
</head>

<body>



<div class="content">
<div class="box">
 <?php include('post_form.php'); ?></div>
 </div>

 
 

</body>
</html>
