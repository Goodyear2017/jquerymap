<?php
header("Access-Control-Allow-Origin: *");
session_start();

define('IN_SCRIPT', true); 

	require_once("config.php");
	require_once("Mobile_Detect.php");
	
	$list_states = "<option value=\"\"></option>";

	$sql = "SELECT countryID, stateID, state FROM jqm_us_states ORDER BY stateID";
	$query = $jqm_db->query($sql);

	if ($query->num_rows > 0)
		while ($rd = $query->fetch_assoc())
			$list_states .= "<option value=\"" . strtolower($rd['countryID'] . "_" . $rd['stateID']) . "\">" . $rd['state'] . "</option>";
	$query->close();
?>

<!DOCTYPE html>
<html lang="en">

<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# website: http://ogp.me/ns/website#">
<title>Equity in Action Map Full Size </title>
 <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
   <meta name="robots" content="index,follow" /> 
    <meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
     <meta property="fb:app_id"                       content="" />
    <meta property="og:type" content="article" />
    <meta property="og:url"   content="/map" /> 
    <meta property="og:title"                        content="Action Map" /> 
    <meta property="og:description"        content="" />
  <meta property="og:image"    content="size-map.jpg" /> 
        

    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    
<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/smoothness/jquery-ui.css" />
     <link rel="stylesheet" type="text/css" href="css/jquery-ui-timepicker-addon.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- For IE 8 and lower, jQueryMaps uses Google ExplorerCanvas -->
    <!--[if IE]><script>if (document.documentMode < 9) document.write("<script src='jquerymaps/libs/excanvas/excanvas_tagcanvas.js'><\/script>");</script><![endif]-->

	<!-- jQuery and jQuery-UI libraries are needed by jQueryMaps -->
	

    
 
	<!-- This library contains everything directly related to the map -->
<script type="text/javascript" src="jquerymaps/libs/jqmMapMgmt.js" ></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.js"></script>
<script type="text/javascript" src="js/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript" src="js/touchdown.min.js"></script>
<script type="text/javascript" src="js/popupwindow.js"></script>
<script>
$( '#nav li:has(ul)' ).doubleTapToGo();
</script>

<script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "map",
  
  "name": "Action Map",
  "alternateName": "Action Map",
  "url": "",
  "dateCreated": "April 2017",
  
   "potentialAction": {
    "@type": "SearchAction",
    "target": "http://query./search?q={search_term_string}",
    "query-input": "required name=search_term_string"
  }
}
</script>
</head>

<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8&appId=";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

  <script>window.twttr = (function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0],
    t = window.twttr || {};
  if (d.getElementById(id)) return t;
  js = d.createElement(s);
  js.id = id;
  js.src = "https://platform.twitter.com/widgets.js";
  fjs.parentNode.insertBefore(js, fjs);

  t._e = [];
  t.ready = function(f) {
    t._e.push(f);
  };

  return t;
}(document, "script", "twitter-wjs"));</script>    
    



	<div class="content">
   
  <div  class="col-lg-2 col-md-2 col-sm-2 col-xs-3 col-lg-push-5 col-md-push-5 col-sm-push-5 col-xs-push-4">
<a class="logo" href="http://dayofequity.org/equity-in-action-map/"><img class="img-responsive" src="/11/dayofequity-logo-new.png" width="80%" /></a>
</div>
<button type="button" class="btn btn-info btn-lg sharebutton" data-toggle="modal" data-target="#myModal"><i class="fa fa-share-alt fa-1x" aria-hidden="true"></i></button>
<!-- modal-->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title text-center">Share the Map</h3>
        </div>
        <div class="modal-body">
          <h4><b>Link</b>: http://dayofequity.org/map/</h4>

<br/>
<h4><b>Social</b>: <span style="display:inline-block;">
<div class="fb-share-button" data-href="/map/" data-layout="button_count" data-size="large" data-mobile-iframe="false"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fdayofequity.org%2Fmap%2F&amp;src=sdkpreparse">Share</a></div>
<a class="twitter-share-button"
  href="https://twitter.com/intent/tweet?text=join us!"
  data-size="large">
Tweet</a></span></h4>   
 <br/>       

<h4><b>Embed Code</b>:

<?php
echo '<pre>';
echo htmlspecialchars('<iframe src="/map/" width="750" height="560" frameborder="0"></iframe>');
echo '</pre>';
?>
</h4>

        </div>
        <div class="modal-footer">
    
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  <!-- end modal -->
        	<!-- JQUERYMAPS MAP -->
            <div class="box">
                <div id="jqm_loader" class="jqm_loader"></div>
                <div id="jqm_map"></div>
                <div id="jqm_popup" class="jqm_popup">##label##<br>##popup##</div>
                <div id="jqm_popup_marker" class="jqm_popup_marker">##label##<br>##popup##</div>
            </div>
            <!-- JQUERYMAPS MAP - END -->

      
    
    	
	
    
    <div id="jqm_dialog" title="">
        <div id="jqm_detail" class="jqm_detail"></div>
    </div>
    
    <?php
	$detect = new Mobile_Detect;
	if ( $detect->isMobile() ) {
 

	?>
    <div class="visible-xs-block ">
 
 <?php include('event_mobile.php'); ?>
 </div><?php } 
 ?>
 

  </div>
  

 

</body>
</html>
