//$(document).ready(function() {

var bottomPage = {
		drop: function() {
			
			setTimeout(function() {
		
				$("#bottomPage").css({
					display: "none"
				});

			}, 200);

			$("#bottomPage #background").css({
				backgroundColor: "rgba(255, 255, 255, 0)"
			});

			$("#bottomPage #container").css({
				height: "0"
			});

		},
		rise: function(page) {
			
			$("#bottomPage #background").off("click").click(function() {
				
				bottomPage.drop();
				
			});
			
			$("#bottomPage").css({
				display: "block"
			});

			$("#bottomPage #background").css({
				backgroundColor: "rgba(255, 255, 255, 0.3)"
			});

			$.ajax({
				url: "bottom-pages/" + page + ".php",
				data: {
					page: bottomPageInfo["page"]
				},
				success: function(response) {
				
					$("#bottomPage #container").html(response).css({
						height: "75%"
					});
				
				},
				error: function(response) {
				
					alert( JSON.stringify(response) );
				
				}
			});
	
		}
}

$(document).ready(function() {

});