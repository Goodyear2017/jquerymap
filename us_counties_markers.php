<?php
	header("Content-Type: application/xml; charset=utf-8");
	echo "<jqm_markers xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xsi:noNamespaceSchemaLocation=\"../xsd/jqm_markers.xsd\">\n";
	
	include("../../libs/jqmDB.php");
	
	$id = ""; if (!empty($_REQUEST["id"])) { $id = $_REQUEST["id"]; }
	
	$sql = "SELECT ci.cityid, ci.cityname, ci.lat, ci.lon, COUNT(e.adid) AS total ";
	$sql .= "FROM phpclassifieds_cities ci, phpclassifieds_events e ";
	$sql .= "WHERE ci.stateID = '" . $id . "' AND ci.cityid = e.cityid  AND DATE(e.starton)>=CURDATE()";
	$sql .= "GROUP BY ci.cityid, ci.cityname, ci.lat, ci.lon ";
	$sql .= "ORDER BY ci.cityid";
	$query = $jqm_db->query($sql);

	if ($query->num_rows > 0)
		while ($rd = $query->fetch_assoc()) {
			echo "<marker id=\"" . $rd['cityid'] . "\" category=\"city\" label=\"" . htmlspecialchars($rd['cityname']) . "\" lat=\"" . $rd['lat'] . "\" lon=\"" . $rd['lon'] . "\" popup=\"" . $rd['total'] . " Events\" />\n";
		}
	$query->close();
	$jqm_db->close();

	echo "</jqm_markers>";
?>