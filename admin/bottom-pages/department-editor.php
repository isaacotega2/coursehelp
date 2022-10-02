<?php
	
	$page = array("rootPath" => "../../");
	
	include_once($page["rootPath"] . "scripts/php/general-info.php");
	
	include_once($page["rootPath"] . "scripts/php/methods.php");
	
 ?>
 
  	<form method="post" class="form" autocomplete="off" id="frmAddDepartment">
 
 		<br><br>
 
 		<label class="formHeading">Edit department</label>
 		
 		<br><br><br>
 
 		<input type="text" name="name" placeholder="Department's name" class="input">
 
 		<br><br><br><br>
 	
 		<input type="submit" name="submit" class="submit" value="Edit department">
 	
 		<br><br><br>
 
	</form>

	<script>
		
		$("#frmAddDepartment").submit(function() {
		
			event.preventDefault();
			
			$(this).hide();
			
			$(this).before('<div id="loader">Loading . . .</div>');
		
		
			var form = $(this);
		
			$.ajax({
				url: "scripts/ajax-handler.php",
				type: "post",
				dataType: "JSON",
				data: {
					request: "editDepartment",
					departmentDetails: {
						name: $(form).find("[name=name]").val(),
						departmentId: sessionStorage.getItem("activeDepartment")
					}
				},
				success: function(response) {
		
					if(response["status"] == "success") {
						
						sessionStorage.setItem("activeDepartment", response["departmentId"]);
	
						bottomPage.rise("department-page");
						
					}
			
				},
				error: function(response) {
				
					$("#frmAddDepartment").show();
					
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
					request: "getDepartmentDetails",
					departmentId: sessionStorage.getItem("activeDepartment")
				},
				success: function(response) {
				
					var form = $("#frmAddDepartment");
						
					$(form).find("[name=name]").val(response["name"]);
						
				},
				error: function(response) {
				
					alert ( JSON.stringify(response) );
					
				}
			});
		
		
	
	</script>