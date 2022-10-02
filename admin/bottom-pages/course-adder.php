<?php
	
	$page = array("rootPath" => "../../");
	
	include_once($page["rootPath"] . "scripts/php/general-info.php");
	
	include_once($page["rootPath"] . "scripts/php/methods.php");
	
 ?>
 
  	<form method="post" class="form" autocomplete="off" id="frmAddCourse">
 
 		<br><br>
 
 		<label class="formHeading">New course</label>
 		
 		<br><br><br>
 
 		<input type="text" name="name" placeholder="Course's name" class="input">
 
 		<br><br><br>
 
 		<select name="institution" class="select">
  
   			<option value="default" hidden>Institution</option>
   				
   			<?php
   			
   				foreach($website["content"]["institutions"]["ids"] as $eachId) {
    
    					echo '<option value="' . $eachId . '" levelType="level">' . institutionDetails($eachId)["name"] . '</option>';
    					
    				}
    				
    			?>
    
  		</select>

 		<br><br><br>
 
 		<select name="department" class="select">
  
   			<option value="default" hidden>Department</option>
   				
   			<?php
   			
   				foreach($website["content"]["departments"]["ids"] as $eachId) {
    
    					echo '<option value="' . $eachId . '" levelType="level">' . departmentDetails($eachId)["name"] . '</option>';
    					
    				}
    				
    			?>
    
  		</select>

 		<br><br><br>
 
  <select name="level" class="select">
  
    <option value="default" hidden>Level</option>
    
    <option value="100 Level" levelType="level">100 level</option>
    
    <option value="200 Level" levelType="level">200 level</option>
    
    <option value="300 Level" levelType="level">300 level</option>
    
    <option value="400 Level" levelType="level">400 level</option>
    
    <option value="500 Level" levelType="level">500 level</option>
    
    <option value="ND1" levelType="diploma">ND 1</option>
    
    <option value="ND2" levelType="diploma">ND 2</option>
    
    <option value="HND1" levelType="diploma">HND 1</option>
    
    <option value="HND2" levelType="diploma">HND 2</option>
    
  </select>

 		<br><br><br><br>
 	
 		<input type="submit" name="submit" class="submit" value="Create course">
 	
 		<br><br><br>
 
	</form>

	<script>
	
		$("#frmAddCourse").submit(function() {
		
			event.preventDefault();
			
			$(this).hide();
			
			$(this).before('<div id="loader">Loading . . .</div>');
		
		
			var form = $(this);
		
			$.ajax({
				url: "scripts/ajax-handler.php",
				type: "post",
				dataType: "JSON",
				data: {
					request: "newCourse",
					courseDetails: {
						name: $(form).find("[name=name]").val(),
						level: $(form).find("[name=level]").val(),
						institutionId: $(form).find("[name=institution]").val(),
						departmentId: $(form).find("[name=department]").val()
					}
				},
				success: function(response) {
		
					if(response["status"] == "success") {
						
						sessionStorage.setItem("activeCourse", response["courseId"]);
	
						bottomPage.rise("course-page");
						
					}
			
				},
				error: function(response) {
					
					$("#frmAddCourse").show();
					
					$("#loader").remove();
					
					alert ( JSON.stringify(response) );
				}
			});
	
		});
	
	</script>