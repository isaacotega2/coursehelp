$(document).ready(function() {
	
	fillFunnyWierdQuestions();
	

	function fillFunnyWierdQuestions() {

	$.ajax({
		url: "scripts/ajax-handler.php",
		type: "post",
		dataType: "JSON",
		data: {
		
			request: "getFunnyWierdQuestions"
		
		},
		success: function(response) {
	//		alert ( JSON.stringify(response) );
			
			for(var i = 0; i < response.length; i++) {
			//	alert();
				
				var index = (i + 1);
				
				var question = response[i];
				
				var row = $('<tr id="' + question["questionId"] + '" class="questionRow"></tr>').html('<td>' + index + '</td> <td>' + question["question"] + '</td> <td>' + question["datePosted"] + " | " + question["timePosted"] + '</td> </tr>');
						
				$("#tblFunnyWierdQuestions tbody").append(row);
						
			}
			
			$("#tblFunnyWierdQuestions tbody .questionRow").click(function () {
					
				sessionStorage.setItem("activeFunnyWierdQuestion", $(this).attr("id"));
	
				bottomPage.rise("funny-wierd-question-page");
						
			});
			
		},
		error: function(response) {
		alert ( JSON.stringify(response) );
		}
	});
	
	}
	
	
	$("#btnAddFunnyWierdQuestion").click(function() {
	
		bottomPage.rise("funny-wierd-question-adder");
	
	});

});
					