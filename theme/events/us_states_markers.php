<?php
	header("Content-Type: application/xml; charset=utf-8");
	echo "<jqm_markers xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xsi:noNamespaceSchemaLocation=\"../xsd/jqm_markers.xsd\">\n";
	
	include("../../libs/jqmDB.php");
	
	$sql = "SELECT ci.*, e.*";
	$sql .= "FROM phpclassifieds_cities ci, phpclassifieds_events e ";
	$sql .= "WHERE ci.cityid = e.cityid  AND DATE(e.starton)>=CURDATE()";

	
	$query = $jqm_db->query($sql);

	if ($query->num_rows > 0)
		while ($rd = $query->fetch_assoc()) {
	echo $rd['cityid'];
			echo "<marker id=\"" . $rd['cityid'] . "\" category=\"city\" label=\"" . ucwords(htmlspecialchars($rd['cityname'])) . "\" lat=\"" . $rd['lat'] . "\" lon=\"" . $rd['lon'] . "\" popup=\"" . $rd['total'] . " Events\" />\n";
		}
	
	$jqm_db->close();
	
		
	echo "</jqm_markers>";
?>
