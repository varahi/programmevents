// Accordion  
$( function() {	  
	  var icons = {
			header: "iconClosed",    // custom icon class
			activeHeader: "iconOpen" // custom icon class
		};	  
	  
	  $("#accordion").accordion({
		  accordion: true,
		  icons: icons,
		  header: "div.header",
		  collapsible: true, 
		  active: false,
		  speed: 500,
		}); 
  
});

// Datepicker
$( "#startdate" ).datepicker({ dateFormat: "mm/dd/yy" });
$( "#enddate" ).datepicker({ dateFormat: "mm/dd/yy" });