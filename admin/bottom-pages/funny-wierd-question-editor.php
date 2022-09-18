<?php
	
	$page = array("rootPath" => "../../");
	
	include_once($page["rootPath"] . "scripts/php/general-info.php");
	
	include_once($page["rootPath"] . "scripts/php/methods.php");
	
 ?>
 
  	<form method="post" class="form" autocomplete="off" id="frmAddQuestion">
 
 		<br><br>
 
 		<label class="formHeading">Edit question</label>
 		
 		<br><br><br>
 
 		<input type="text" name="question" placeholder="Question" class="input">
 
 		<br><br><br><br>
 	
 		<input type="submit" name="submit" class="submit" value="Edit question">
 	
 		<br><br><br>
 
	</form>

	<script>
		
		$("#frmAddQuestion").submit(function() {
		
			event.preventDefault();
			
			$(this).hide();
			
			$(this).before('<div id="loader">Loading . . .</div>');
		
		
			var form = $(this);
		
			$.ajax({
				url: "scripts/ajax-handler.php",
				type: "post",
				dataType: "JSON",
				data: {
					request: "editFunnyWierdQuestion",
					questionDetails: {
						question: $(form).find("[name=question]").val(),
						questionId: sessionStorage.getItem("activeFunnyWierdQuestion")
					}
				},
				success: function(response) {
		
					if(response["status"] == "success") {
						
						sessionStorage.setItem("activeFunnyWierdQuestion", response["questionId"]);
	
						bottomPage.rise("funny-wierd-question-page");
						
					}
			
				},
				error: function(response) {
				
					$("#frmAddQuestion").show();
					
					$("#loader").remove();
					
					alert ( JSON.stringify(response) );
					
				}
			});
	
		});
			
		
			$.ajax({
				url: "scripts/ajax-handler.php",
				type: "post",
				dataType: "JSON",
				data: {
					request: "getFunnyWierdQuestionDetails",
					questionId: sessionStorage.getItem("activeFunnyWierdQuestion")
				},
				success: function(response) {
				
					var form = $("#frmAddQuestion");
						
					$(form).find("[name=question]").val(response["question"]);
						
				},
				error: function(response) {
				
					alert ( JSON.stringify(response) );
					
				}
			});
		
		
	
	</script>