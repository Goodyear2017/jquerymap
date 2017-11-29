<?php
	header("Content-Type: application/xml; charset=utf-8");
	echo "<jqm_features xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xsi:noNamespaceSchemaLocation=\"../../xsd/jqm_features.xsd\">\n";
	
	include("../../libs/jqmDB.php");
	
	$list = array();

	$sql = "SELECT s.countryID, s.stateID, s.state, COUNT(e.adid) AS total ";
	$sql .= "FROM jqm_us_states s, phpclassifieds_cities c, phpclassifieds_events e ";
	$sql .= "WHERE s.stateID = CONVERT(c.stateID using utf8) collate utf8_spanish_ci AND c.cityid = e.cityid AND DATE(e.starton)>=CURDATE()";
	$sql .= "GROUP BY s.countryID, s.stateID, s.state ";
	$sql .= "ORDER BY s.stateID";
	$query = $jqm_db->query($sql);

	if ($query->num_rows > 0)
		while ($rd = $query->fetch_assoc()) {
			echo "<feature id=\"" . strtolower($rd['countryID'] . "_" . $rd['stateID']) . "\" category=\"state\" label=\"" . htmlspecialchars($rd['state']) . "\" label_map=\"" . strtoupper($rd['stateID']) . "\" popup=\"" . $rd['total'] . " Events\" />\n";
			array_push($list, $rd['stateID']);
		}
	$query->close();
	
	$sql = "SELECT s.countryID, s.stateID, s.state ";
	$sql .= "FROM jqm_us_states s ";
	if (count($list) > 0) { $sql .= "WHERE s.stateID NOT IN ('" . implode("','", $list) . "') "; }
	$sql .= "ORDER BY s.stateID";
	$query = $jqm_db->query($sql);

	if ($query->num_rows > 0)
		while ($rd = $query->fetch_assoc())
			echo "<feature id=\"" . strtolower($rd['countryID'] . "_" . $rd['stateID']) . "\" category=\"nostate\" label=\"" . htmlspecialchars($rd['state']) . "\" label_map=\"" . strtoupper($rd['stateID']) . "\" popup=\"\" />\n";
	$query->close();
	$jqm_db->close();

	echo "</jqm_features>";
?>