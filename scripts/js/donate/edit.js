$(document).ready(function() {

	$(".imageHolder").find("[type=file]").change(function() {
	
		var page = $(this).parent(".imageHolder").attr("page");
		
		var image = this.files[0];
		
		var data = new FormData();
		
		data.append("request", "uploadPage");
		
		data.append("page", page);
		
		data.append("handoutId", handoutId);
		
		data.append("image", image);
		
	$.ajax({
		url: "../../../scripts/php/donate.php",
		type: "post",
		dataType: "JSON",
		contentType: false,
		processData: false,
		data: data,
		success: function(response) {

			//alert ( JSON.stringify(response) );
			
			if(response["status"] == "success") {
				
				var element = $("[page=" + page + "] img");
				
				var originalSrc = $(element).attr("src");
			
				$(element).attr("src", "");
				
				
				$(element).attr("src", originalSrc);
					
			
			}
			
		},
		error: function(response) {
		alert ( JSON.stringify(response) );
		}
	});
	
	});

});