<?php
	
	$page = array("rootPath" => "../../");
	
	include_once($page["rootPath"] . "scripts/php/general-info.php");
	
	include_once($page["rootPath"] . "scripts/php/methods.php");
	
 ?>
 
  	<form method="post" class="form" autocomplete="off" id="frmAddDepartment">
 
 		<br><br>
 
 		<label class="formHeading">New department</label>
 		
 		<br><br><br>
 
 		<input type="text" name="name" placeholder="Department's name" class="input">
 
 		<br><br><br><br>
 	
 		<input type="submit" name="submit" class="submit" value="Add department">
 	
 		<br><br><br>
 
	</form>

	<script>
			
		$("#frmAddDepartment").submit(function() {
		
			event.preventDefault();
			
		
			var form = $(this);
		
		
			if($(form).find("[name=name]").val() == "") {
			
				alert("Please fill in the datails");
				
				return;
			
			}
			
	//		$(this).hide();
			
			$(this).before('<div id="loader">Loading . . .</div>');
		
		
			$.ajax({
				url: "scripts/ajax-handler.php",
				type: "post",
				dataType: "JSON",
				data: {
					request: "newDepartment",
					departmentDetails: {
						name: $(form).find("[name=name]").val()
					}
				},
				success: function(response) {
		
			//		alert ( "success >>> " + JSON.stringify(response) );
				
					if(response["status"] == "success") {
						
						sessionStorage.setItem("activeDepartment", response["departmentId"]);
	
						bottomPage.rise("department-page");
						
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