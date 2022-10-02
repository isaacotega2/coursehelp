<?php
	
	$page = array("rootPath" => "../../");
	
	include_once($page["rootPath"] . "scripts/php/general-info.php");
	
	include_once($page["rootPath"] . "scripts/php/methods.php");
	
 ?>
 
  	<form method="post" class="form" autocomplete="off" id="frmAddInstitution">
 
 		<br><br>
 
 		<label class="formHeading">Edit institution</label>
 		
 		<br><br><br>
 
 		<input type="text" name="name" placeholder="Institution's name" class="input">
 
 		<br><br><br>
 
  <select name="type" class="select">
  
    <option value="0" hidden>Type</option>
    
    <option value="university">University</option>
    
    <option value="polytechnic">Polytechnic</option>
    
  </select>

 		<br><br><br><br>
 	
 		<input type="submit" name="submit" class="submit" value="Edit institution">
 	
 		<br><br><br>
 
	</form>

	<script>
		
		$("#frmAddInstitution").submit(function() {
		
			event.preventDefault();
			
			$(this).hide();
			
			$(this).before('<div id="loader">Loading . . .</div>');
		
		
			var form = $(this);
		
			$.ajax({
				url: "scripts/ajax-handler.php",
				type: "post",
				dataType: "JSON",
				data: {
					request: "editInstitution",
					institutionDetails: {
						name: $(form).find("[name=name]").val(),
						type: $(form).find("[name=type]").val(),
						institutionId: sessionStorage.getItem("activeInstitution")
					}
				},
				success: function(response) {
		
					if(response["status"] == "success") {
						
						sessionStorage.setItem("activeInstitution", response["institutionId"]);
	
						bottomPage.rise("institution-page");
						
					}
			
				},
				error: function(response) {
				
					$("#frmAddInstitution").show();
					
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
					request: "getInstitutionDetails",
					institutionId: sessionStorage.getItem("activeInstitution")
				},
				success: function(response) {
				
					var form = $("#frmAddInstitution");
						
					$(form).find("[name=name]").val(response["name"]);
						
					$(form).find("[name=type]").val(response["type"]);
			
				},
				error: function(response) {
				
					alert ( JSON.stringify(response) );
					
				}
			});
		
		
	
	</script>