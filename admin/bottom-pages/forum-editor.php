<?php
	
	$page = array("rootPath" => "../../");
	
	include_once($page["rootPath"] . "scripts/php/general-info.php");
	
	include_once($page["rootPath"] . "scripts/php/methods.php");
	
 ?>
 
  	<form method="post" class="form" autocomplete="off" id="frmAddForum">
 
 		<br><br>
 
 		<label class="formHeading">Edit forum</label>
 		
 		<br><br><br>
 
 		<input type="text" name="name" placeholder="Forum's name" class="input">
 
 		<br><br><br><br>
 	
 		<input type="submit" name="submit" class="submit" value="Edit forum">
 	
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
					request: "editForum",
					forumDetails: {
						name: $(form).find("[name=name]").val(),
						forumId: sessionStorage.getItem("activeForum")
					}
				},
				success: function(response) {
		
					if(response["status"] == "success") {
						
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
		
			$.ajax({
				url: "scripts/ajax-handler.php",
				type: "post",
				dataType: "JSON",
				data: {
					request: "getForumDetails",
					forumId: sessionStorage.getItem("activeForum")
				},
				success: function(response) {
				
					var form = $("#frmAddForum");
						
					$(form).find("[name=name]").val(response["name"]);
						
				},
				error: function(response) {
				
					alert ( JSON.stringify(response) );
					
				}
			});
		
	</script>