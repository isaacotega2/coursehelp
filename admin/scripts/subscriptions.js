$(document).ready(function() {
	
	fillOfficialHandoutSubscription();

	function fillOfficialHandoutSubscription() {

	$.ajax({
		url: "scripts/ajax-handler.php",
		type: "post",
		dataType: "JSON",
		data: {
		
			request: "getOfficialHandoutSubscriptions"
		
		},
		success: function(response) {
//		alert ( JSON.stringify(response) );
			
			for(var i = 0; i < response.length; i++) {
			//	alert();
				
				var index = (i + 1);
				
				var subscription = response[i];
				
				var row = $('<tr id="' + subscription["subscriptionId"] + '" class="subscriptionRow"></tr>').html('<td>' + index + '</td> <td>' + subscription["handout"]["name"] + '</td> <td>' + subscription["subscriber"]["nickname"] + '</td> <td>' + subscription["duration"] + '</td> <td>' + subscription["dateSubscribed"] + " | " + subscription["timeSubscribed"] + '</td> <td>' + subscription["active"] + '</td> </tr>');
						
				$("#tblOfficialHandoutSubscriptions tbody").append(row);
			
			}
			
			$("#tblOfficialHandoutSubscriptions tbody .subscriptionRow").click(function () {
					
				sessionStorage.setItem("activeSubscription", $(this).attr("id"));
	
				bottomPage.rise("official-handout-subscription-page");
						
			});
			
		},
		error: function(response) {
		alert ( JSON.stringify(response) );
		}
	});
	
	}
	
	$("#btnAddOfficialHandoutSubscription").click(function() {
	
		bottomPage.rise("official-handout-subscription-adder");
	
	});

});
					