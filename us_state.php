<?php
	$id = ""; if (!empty($_REQUEST["id"])) { $id = substr($_REQUEST["id"], 3, 2); }
	
	$theme = "id=\"" . $id . "\" shapesUrl=\"../../maps/counties_by_state/fm-us_" . $id . ".xml\" backgroundImageUrl=\"\" ";
	$theme .= "featuresUrl=\"us_counties_features.php?id=" . $id . "\" featureCategoriesUrl=\"us_counties_feature_categories.xml\" ";
	//$theme .= "markersUrl=\"us_counties_markers.php?id=" . $id . "\" markerCategoriesUrl=\"us_counties_marker_categories.xml\" ";
	$theme .= "markersUrl=\"us_states_markers.php?id=" . $id . "\" markerCategoriesUrl=\"us_states_marker_categories.xml\" ";
			
	echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
	echo "<jqm_theme xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xsi:noNamespaceSchemaLocation=\"../../xsd/jqm_theme.xsd\" reloadInterval=\"\" reloadFeatures=\"false\" reloadFeatureCategories=\"false\" reloadMarkers=\"false\" reloadMarkerCategories=\"false\" " . $theme . " >";
	echo "<platformFunctionality id=\"default\" calculatedMapAreas=\"false\" onMouseOverCalculateInterval=\"\" displayPolygons=\"true\" />";
	echo "</jqm_theme>";
?>