<?php
error_reporting(E_ALL);
session_start();

require_once("config.php");

$password = ""; 
require_once 'php-spam-filter/spamfilter.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Map manager</title>
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="robots" content="nofollow" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
   
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">  
<link rel="stylesheet" type="text/css" href="css/password_css.css">
<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script>
function highlightEdit(editableObj) {
	$(editableObj).css("background","#FFF");
} 
function saveInlineEdit(editableObj,column,id) {
// no change change made then return false
if($(editableObj).attr('data-old_value') === editableObj.innerHTML)
return false;
// send ajax to update value
$(editableObj).css("background","#FFF url(ajax-loader.gif) no-repeat right");
$.ajax({
url: "saveInlineEdit.php",
type: "POST",
dataType: "json",
data:'column='+column+'&value='+editableObj.innerHTML+'&id='+id,
success: function(response) {
// set updated value as old value
$(editableObj).attr('data-old_value',editableObj.innerHTML);
$(editableObj).css("background","#FDFDFD");
},
error: function () {
console.log("errr");
}
});
}
</script>
</head>
<body>
<div class="container">
<div class="row col-lg-12 col-xs-12 col-md-12">
<?php if (isset($_POST["password"]) && ($_POST["password"]=="$password")) {?>
 <h2>Map Admin</h2>
<?php 
$result="SELECT count(*) AS total from phpclassifieds_events WHERE YEAR(timestamp)>=2017";
$query = $jqm_db->query($result);
if ($query->num_rows > 0)
while ($data= $query->fetch_assoc()){

echo '<h1>total:'.$data['total'].'</h1>';

}
?>
<a href="export_map.php"><button>Export Excel Sheet</button></a>

<table border="1" class="table table-condensed table-hover table-striped bootgrid-table text-left">
<tr><th>Event Date</th><th>Location</th><th>Title</th><th>Content</th><th>update/delete</th></tr>

<?php 
$sql = "SELECT  e.*,ci.* 
FROM phpclassifieds_cities ci, phpclassifieds_events e
	WHERE  ci.cityid = e.cityid
	ORDER BY DATE(e.starton) DESC";
	$query = $jqm_db->query($sql);
if ($query->num_rows > 0)
while ($rd = $query->fetch_assoc()){
	$title_c=$rd['adtitle'];
	$text_c=$rd['addesc'];
	$filter = new SpamFilter();
	$result = $filter->check_text($text_c);
	
?>	
	 <tr>
     <?php echo '<td >'.$rd['starton'].'</td>'; ?>
    <?php  echo '<td >'.$rd['cityname'].'</td>'; ?>
		
     
     <td contenteditable="true" data-old_value="<?php echo $title_c; ?>" onBlur="saveInlineEdit(this,'adtitle','<?php echo $rd['adid']; ?>')"  onClick="highlightEdit(this);"><div style="font-size:18px;margin-top:10px;font-weight:bold;"><?php echo $title_c; ?></div></td>
	
<?php	
	if($result){
?><td contenteditable="true" data-old_value="<?php echo $text_c; ?>" onBlur="saveInlineEdit(this,'addesc','<?php echo $rd['adid']; ?>')"  onClick="highlightEdit(this);"><p class="text-danger"><?php echo $text_c; ?></p></td>
	<?php
    }else{?>
		<td contenteditable="true" data-old_value="<?php echo $text_c; ?>" onBlur="saveInlineEdit(this,'addesc','<?php echo $rd['adid']; ?>')"  onClick="highlightEdit(this);"><?php echo $text_c; ?></td>
	<?php
    }
    	
		
		?>
        
   <td>
   
       
    <a href="delete_map.php?sid=<?php echo $rd['adid']; ?>" onclick="return confirm('Are you sure you want to delete <p class='text-warning'><?php echo $title_c; ?>'</p>)">Delete</a>
   
    </td>
</tr>
<?php
}
?>

</table>

<?php } else
{
// Wrong password or no password entered display this message
if (isset($_POST['password']) || $password == "") {
  print "<p align=\"center\"><font color=\"red\"><b>Incorrect Password</b><br>Please enter the correct password</font></p>";}
  print "<form method=\"post\"><p align=\"center\">Please enter your password for access<br>";
  print "<input name=\"password\" type=\"password\" size=\"25\" maxlength=\"10\"><input value=\"Login\" type=\"submit\"></p></form>";
}
 
?>

</div></div>


</body>
</html>
