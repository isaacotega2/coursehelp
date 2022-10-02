$(document).ready(function() {

	loadPage("general");

				//	bottomPage.rise("official-handout-subscription-adder");
						
	$("#footer .item").click(function() {
	
		loadPage($(this).attr("page"));
	
	});
		
	function loadPage(page) {
		
	//	pageLoader();
		
		$.ajax({
			url: "pages/" + page + ".php",
			success: function(response) {
			
				$("#main").html(response);
				
				$("#footer .item").attr("id", "");
		
				$("#footer [page=" + page + "]").attr("id", "selected");
		/*
	$("#main .container #content").css({
		height: "10cm",
		overflow: "hidden",
		border: "10px solid green"
	});
*/
			},
			error: function(response) {
			alert ( JSON.stringify(response) );
			},
			cache: false
		});
	
	}
	
});

function pageLoader() {
		
	$("#main").html('<div id="loader">Loading . . .</div>');
		
}
	