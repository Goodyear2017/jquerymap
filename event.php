<ul class="info">
<?php
	include("../libs/jqmDB.php");
	
	$id = ""; if (!empty($_REQUEST["id"])) { $id = $_REQUEST["id"]; }
	$info = "";
	
	$sql = "SELECT e.* ";
	$sql .= "FROM phpclassifieds_cities ci, phpclassifieds_events e ";
	$sql .= "WHERE ci.cityid = '" . $id . "' AND ci.cityid = e.cityid AND DATE(e.starton)>=CURDATE()
	ORDER BY DATE(e.starton) ASC
	";
	
	$query = $jqm_db->query($sql);

	if ($query->num_rows > 0)
		while ($rd = $query->fetch_assoc()) {
		?>
        <?php
			
			$date_time = strtotime($rd['starton']);
			$time=date("g:i A", $date_time);
		$string=$rd['addesc'];
			$string = preg_replace(
              "~[[:alpha:]]+://[^<>[:space:]]+[[:alnum:]/]~",
              "<a href=\"\\0\" target='_blank'>\\0</a>", 
              $string);
			$info .= "<li><b>" . ucwords($rd['adtitle']). "</b><br/><br/>";
			
			if($time=="12:00 AM"){
				$info .= "<i>" . date("m/d/y", $date_time). "</i><br /><br/>";}
				else{
				$info .= "<i>" . date("m/d/y g:i A", $date_time). "</i><br /><br/>";
					}
			if ($rd['area'] != "") { $info .= $rd['area'] . "<br /><br />";}
			
			if ($rd['addesc'] != "") { $info .= $string. "<br />"; }
			if ($rd['website'] != "") { $info .= "<a href='".$rd['website']."' target='_blank'>".$rd['website']."</a><br />"; }
			
			if ($rd['showemail'] ==2) { $info .= $rd['email'] . "<br /></li>"; }
			if ($rd['showemail'] == 1) { $info .= '<br /></li>'; }
			
			?>
			
			
			<?php
			 
		}?>
		
		<?php
	
	$jqm_db->close();

	echo $info;
	
?>
</ul>