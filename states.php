<?php
error_reporting(E_ALL);
require("config.php");

 
  $states = array ();

   
    $sql = "SELECT countryid, countryname FROM phpclassifieds_countries";
    $query = $jqm_db->query($sql);
   if ($query->num_rows > 0) {
      while ($record =$query->fetch_assoc()){
	   
      
        $states[] = array ('countryid' => $record['countryid'], 'countryname' => $record['countryname']);
	  }
    }
   
  
  echo json_encode($states);
?>