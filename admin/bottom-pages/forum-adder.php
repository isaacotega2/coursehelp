<?php
	
	$page = array("rootPath" => "../../");
	
	include_once($page["rootPath"] . "scripts/php/general-info.php");
	
	include_once($page["rootPath"] . "scripts/php/methods.php");
	
 ?>
 
  	<form method="post" class="form" autocomplete="off" id="frmAddForum">
 
 		<br><br>
 
 		<label class="formHeading">New forum</label>
 		
 		<br><br><br>
 
 		<input type="text" name="name" placeholder="Forum's name" class="input">
 
 		<br><br><br><br>
 	
 		<input type="submit" name="submit" class="submit" value="Create forum">
 	
 		<br><br><br>
 
	</form>

	<script>
		
		$("#frmAddForum").submit(function() {
		
			event.preventDefault();
			
			$(this).hide();
			
			$(this).before('<div id="loader">Loading . . .</div>');
		
		
			var form = $(this);
		
			$.ajax({
				url: "scripts/ajax-handler.php",
				type: "post",
				dataType: "JSON",
				data: {
					request: "newForum",
					forumDetails: {
						name: $(form).find("[name=name]").val()
					}
				},
				success: function(response) {
		
					if(response["status"] == "success") {
						
						sessionStorage.setItem("activeForum", response["forumId"]);
	
						bottomPage.rise("forum-page");
						
					}
			
				},
				error: function(response) {
				
					$("#frmAddForum").show();
					
					$("#loader").remove();
					
					alert ( JSON.stringify(response) );
					
				}
			});
	
		});
		
	</script>