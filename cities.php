<?php

require_once("config.php");

?>


<?php


 $state = isset($_GET['state']) ? $_GET['state'] : 0;
 
  $cities = array ();
  if ($state> 0) {
   
    $query = "SELECT * FROM phpclassifieds_cities WHERE countryid = ".$state."  AND enabled = '1' ORDER BY cityname ASC";
   $result =  $jqm_db->query($query);
    if ($result->num_rows > 0) {
      while ($record =$result->fetch_assoc()){
		  
         
        $cities[] = array ('cityid' => $record['cityid'], 'cityname' => $record['cityname']);
	  }
    }
   
  }
  echo json_encode($cities);
 
?>