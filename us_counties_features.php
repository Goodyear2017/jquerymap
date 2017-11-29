<?php
	header("Content-Type: application/xml; charset=utf-8");
	echo "<jqm_features xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xsi:noNamespaceSchemaLocation=\"../xsd/jqm_features.xsd\">\n";
	
	include("../../libs/jqmDB.php");
	
	$id = ""; if (!empty($_REQUEST["id"])) { $id = $_REQUEST["id"]; }
	$list = array();
	
	$sql = "SELECT c.countryID, c.stateID, c.countyID, c.county, COUNT(e.adid) AS total ";
	$sql .= "FROM jqm_us_counties c, phpclassifieds_cities ci, phpclassifieds_events e ";
	$sql .= "WHERE c.stateID = '" . $id . "' AND c.countyID = CONVERT(ci.countyID using utf8) collate utf8_spanish_ci AND ci.cityid = e.cityid AND DATE(e.starton)>=CURDATE()";
	$sql .= "GROUP BY c.countryID, c.stateID, c.countyID, c.county ";
	$sql .= "ORDER BY c.countyID";
	$query = $jqm_db->query($sql);

	if ($query->num_rows > 0)
		while ($rd = $query->fetch_assoc()) {
			echo "<feature id=\"" . strtolower($rd['countryID'] . "_" . $rd['stateID'] . "_" . $rd['countyID']) . "\" category=\"county\" label=\"" . htmlspecialchars($rd['county']) . "\" popup=\"" . $rd['total'] . " Events\" />\n";
			array_push($list, $rd['countyID']);
		}
	$query->close();
	
	$sql = "SELECT c.countryID, c.stateID, c.countyID, c.county ";
	$sql .= "FROM jqm_us_counties c ";
	$sql .= "WHERE c.stateID = '" . $id . "' ";
	if (count($list) > 0) { $sql .= "AND c.countyID NOT IN ('" . implode("','", $list) . "') "; }
	$sql .= "ORDER BY c.stateID, c.countyID";
	$query = $jqm_db->query($sql);

	if ($query->num_rows > 0)
		while ($rd = $query->fetch_assoc())
			echo "<feature id=\"" . strtolower($rd['countryID'] . "_" . $rd['stateID'] . "_" . $rd['countyID']) . "\" category=\"nocounty\" label=\"" . htmlspecialchars($rd['county']) . "\" popup=\"\" />\n";
	$query->close();
	$jqm_db->close();

	echo "</jqm_features>";
?>