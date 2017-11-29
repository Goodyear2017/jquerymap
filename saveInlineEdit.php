<?php
error_reporting(E_ALL);
require_once("config.php");
$sql = "UPDATE phpclassifieds_events set " .$_REQUEST["column"]. " = '".$_REQUEST["value"]."' WHERE adid=".$_REQUEST["id"];
mysqli_query($jqm_db, $sql) or die("database error:". mysqli_error($jqm_db));
echo "saved";
?>