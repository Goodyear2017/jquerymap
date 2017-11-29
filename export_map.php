<?php
require_once("config.php");

	
 header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=data.csv');  
      $output = fopen("php://output", "w");  
      fputcsv($output, array('Title', 'Date', 'Content', 'City'));  
      $query = "SELECT p1.adtitle, p1.starton, p1.addesc, p2.cityname
	FROM phpclassifieds_events AS p1 INNER JOIN phpclassifieds_cities AS p2 
WHERE p1.cityid = p2.cityid"; 
      $result = mysqli_query($jqm_db, $query);  
      while($row = mysqli_fetch_assoc($result))  
      {  
           fputcsv($output, $row);  
      }  
      fclose($output);  