$(document).ready(function() {
	
	fillHandouts();
	

	function fillHandouts() {

	$.ajax({
		url: "scripts/ajax-handler.php",
		type: "post",
		dataType: "JSON",
		data: {
		
			request: "getDonatedHandouts"
		
		},
		success: function(response) {
	//		alert ( "success " + JSON.stringify(response) );
			
			for(var i = 0; i < response.length; i++) {
			//	alert();
				
				var index = (i + 1);
				
				var handout = response[i];
				
				var row = $('<tr id="' + handout["handoutId"] + '" class="handoutRow"></tr>').html('<td>' + index + '</td> <td>' + handout["name"] + '</td> <td>' + handout["donator"]["nickname"] + '</td> <td>' + handout["course"]["name"] + '</td> <td>' + handout["department"]["name"] + '</td> <td>' + handout["institution"]["name"] + '</td> <td>' + handout["pagesNumber"] + '</td>  <td>' + handout["status"] + '</td> <td>' + handout["datePosted"] + " | " + handout["timePosted"] + '</td> </tr>');
						
				$("#tblHandouts tbody").append(row);
						
			}
			
			$("#tblHandouts tbody .handoutRow").click(function () {
					
				sessionStorage.setItem("activeDonatedHandout", $(this).attr("id"));
	
				bottomPage.rise("donated-handout-page");
						
			});
			
		},
		error: function(response) {
		alert ("error " + JSON.stringify(response) );
		}
	});
	
	}

});
					