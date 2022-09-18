<?php
	
	$page = array("rootPath" => "../../");
	
	include_once($page["rootPath"] . "scripts/php/general-info.php");
	
	include_once($page["rootPath"] . "scripts/php/methods.php");
	
 ?>
 
  	<form method="post" class="form" autocomplete="off" id="frmAddQuestion">
 
 		<br><br>
 
 		<label class="formHeading">New Question</label>
 		
 		<br><br><br>
 
 		<input type="text" name="question" placeholder="Question" class="input">
 
 		<br><br><br><br>
 	
 		<input type="submit" name="submit" class="submit" value="Add Question">
 	
 		<br><br><br>
 
	</form>

	<script>
			
		$("#frmAddQuestion").submit(function() {
		
			event.preventDefault();
			
		
			var form = $(this);
		
		
			if($(form).find("[name=question]").val() == "") {
			
				alert("Please fill in the datails");
				
				return;
			
			}
			
			$(this).hide();
			
			$(this).before('<div id="loader">Loading . . .</div>');
		
		
			$.ajax({
				url: "scripts/ajax-handler.php",
				type: "post",
				dataType: "JSON",
				data: {
					request: "newFunnyWierdQuestion",
					questionDetails: {
						question: $(form).find("[name=question]").val()
					}
				},
				success: function(response) {
		
			//		alert ( "success >>> " + JSON.stringify(response) );
				
					if(response["status"] == "success") {
						
						sessionStorage.setItem("activeFunnyWierdQuestion", response["questionId"]);
	
						bottomPage.rise("funny-wierd-question-page");
						
					}
			
				},
				error: function(response) {
				
					$(form).show();
					
					$("#loader").remove();
					
					alert ( JSON.stringify(response) );
					
				}
			});
	
		});
	
	</script>