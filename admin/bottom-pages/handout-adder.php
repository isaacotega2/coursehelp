<?php
	
	$page = array("rootPath" => "../../");
	
	include_once($page["rootPath"] . "scripts/php/general-info.php");
	
	include_once($page["rootPath"] . "scripts/php/methods.php");
	
 ?>
 
  	<form method="post" class="form" autocomplete="off" id="frmAddHandout">
 
 		<br><br>
 
 		<label class="formHeading">New handout</label>
 		
 		<br><br><br>
 
  <select name="mainCourse" class="select">
  
    <option value="0" hidden>Main course</option>
    
    <?php
    	
    		foreach($website["content"]["mainCourses"]["ids"] as $eachId) {
    		
 			echo '<option value="' . $eachId . '">' . mainCourseDetails($eachId)["name"] . '</option>';
 			
 		}
 		
 	?>
 	
  </select>

 		<input type="text" name="subCourse" placeholder="Sub-course name" class="input">
 
  <select name="levelType" class="select">
  
    <option value="0" hidden>Level type</option>
    
    <option value="level">Level</option>
    
    <option value="diploma">Diploma</option>
    
  </select>

  <select name="level" class="select">
  
    <option value="0" hidden>Level</option>
    
    <option value="100" levelType="level">100 level</option>
    
    <option value="200" levelType="level">200 level</option>
    
    <option value="300" levelType="level">300 level</option>
    
    <option value="400" levelType="level">400 level</option>
    
    <option value="ND1" levelType="diploma">ND 1</option>
    
    <option value="ND2" levelType="diploma">ND 2</option>
    
    <option value="HND1" levelType="diploma">HND 1</option>
    
    <option value="HND2" levelType="diploma">HND 2</option>
    
  </select>

  <select name="institution" class="select">
  
    <option value="0" hidden>Institution</option>
    
    <?php
    	
    		foreach($website["content"]["institutions"]["ids"] as $eachId) {
    		
 			echo '<option>' . institutionDetails($eachId)["name"] . '</option>';
 			
 		}
 		
 	?>
 	
  </select>

 		<input type="text" name="department" placeholder="Department" class="input">
 
 		<input type="number" name="pagesNumber" placeholder="Number of pages (handout)" class="input">
 
 		<br><br><br><br>
 	
 		<input type="submit" name="submit" class="submit" value="Next">
 	
 		<br><br><br>
 
	</form>

	<script>
	
		$("#frmAddHandout").submit(function() {
		
			event.preventDefault();
			
			$(this).hide();
			
			$(this).before('<div id="loader">Loading . . .</div>');
		
		
			var form = $(this);
		
			$.ajax({
				url: "scripts/ajax-handler.php",
				type: "post",
				dataType: "JSON",
				data: {
					request: "newHandout",
					handoutDetails: {
						mainCourseId: $(form).find("[name=mainCourse]").val(),
						subCourse: $(form).find("[name=subCourse]").val(),
						levelType: $(form).find("[name=levelType]").val(),
						level: $(form).find("[name=level]").val(),
						institution: $(form).find("[name=institution]").val(),
						department: $(form).find("[name=department]").val(),
						pagesNumber: $(form).find("[name=pagesNumber]").val()
					}
				},
				success: function(response) {
		
					if(response["status"] == "success") {
						
						sessionStorage.setItem("activeHandout", response["subCourseId"]);
	
						bottomPage.rise("handout-gallery");
						
					}
			
				},
				error: function(response) {
					alert ( JSON.stringify(response) );
				}
			});
	
		});
	
	</script>