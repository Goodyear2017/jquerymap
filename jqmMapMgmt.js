/*
jQueryMaps Map Management Library

This file contains everything directed related to the map:
- The reference to the jQueryMaps library.
- The JQueryMaps class instancing when the page is loaded.

Call 1-866-392-0071 or email us at support@flashmaps.com for support.
*/

	// Load the jQueryMaps library
	document.write("<script src='jquerymaps/libs/jquerymaps/JQueryMaps.js'><\/script>");
	

	// jqmMap is the map instance
	var jqmMap;
	var jqmMapLoaded = false;

	
		$(window).load(function(){
		jqmLoadMap('events'); 
		
	
	});
		
$(window).resize( function() { jqmResize(); });
	$(window).bind("orientationchange", function(event) { jqmResize(); });
	
	/*** JQM - RESIZE ***/
	function jqmResize() {
		jqmMap.changeViewportSize({width: $(".box").width(), height: $(".box").height()});
	}

	function jqmLoadMap(id) {
		var theme = "jquerymaps/theme/" + id + "/us.xml";
		
		var params = {mapDivId: "jqm_map", configUrl: "jquerymaps/jqm_config.xml", initialThemeUrl: theme, width: $(".box").width(), height: $(".box").height()};
		
	

		if (jqmMapLoaded == false) {
	
			jqmMap = new JQueryMaps.Map(params); 
			jqmMapLoaded = true;
		} else {
			jqmMap.loadInitialTheme(theme);
		}
	}

	function jqmFromMap(obj) {}
		
	function jqmShowPopupUser(obj) {
		
        $.ajax({ url: "jquerymaps/info/user.php", data: "id=" + obj.id, success: function (data) {
            $("#jqm_dialog").dialog({ autoOpen: true, modal: false, width: 400, position: { of: "#jqm_map" }, resizable: false, show: "blind", title: obj.label });
            $("#jqm_detail").html(data).show();
        } });
	}
	
	function jqmShowPopupEvent(obj) {
		
        $.ajax({ url: "jquerymaps/info/event.php", data: "id=" + obj.id, success: function (data) {
		 $("#jqm_dialog").dialog({ autoOpen: true, modal: false, width: 360, maxHeight: 400, position: {of: "#jqm_map"}, resizable: true, show: "blind", title: obj.label });
		
            $("#jqm_detail").html(data).show();
			
			
        } });
	
	
	}
	
