$(document).ready(function() {

	loadPage("handouts");

	$("#footer .item").click(function() {
	
		loadPage($(this).attr("page"));
	
	});
		
	function loadPage(page) {
		
		pageLoader();
		
		$.ajax({
			url: "pages/" + page + ".php",
			success: function(response) {
			
				$("#main").html(response);
				
				$("#footer .item").attr("id", "");
		
				$("#footer [page=" + page + "]").attr("id", "selected");
		
			},
			error: function(response) {
			alert ( JSON.stringify(response) );
			}
		});
	
	}

});

function pageLoader() {
		
	$("#main").html('<div id="loader">Loading . . .</div>');
		
}
	