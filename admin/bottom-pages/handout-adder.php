<?php
	
	$page = array("rootPath" => "../../");
	
	include_once($page["rootPath"] . "scripts/php/general-info.php");
	
	include_once($page["rootPath"] . "scripts/php/methods.php");
	
 ?>
 
 <h2 id="heading" content="course">New handout</h2>
 
 <p class="hierachy"><label content="institution"></label> > <label content="department"></label> > courses > <label content="course"></label> > New handout </p>
 
  	<form method="post" class="form" autocomplete="off" id="frmAddHandout">
 
 		<br><br>
 
 		<input type="text" name="name" placeholder="Handout's name" class="input">
 
 		<input type="number" name="pagesNumber" placeholder="Number of pages (handout)" class="input">
 
 		<br><br><br><br>
 	
 		<input type="submit" name="submit" class="submit" value="Next">
 	
 		<br><br><br>
 
	</form>

	<script>
	
 	var courseId = sessionStorage.getItem("activeCourse");
 	
 	$.ajax({
		url: "scripts/ajax-handler.php",
		type: "post",
		dataType: "JSON",
		data: {
		
			request: "getCourseDetails",
			courseId: courseId
		
		},
		success: function(response) {
		//	alert ( JSON.stringify(response) );
			
			var course = response;
					
			$("[content=institution]").html(response["institution"]["name"]);
			
			$("[content=department]").html(response["department"]["name"]);
			
			$("[content=course]").html(response["name"]);
			
		}
	});
			
			
		$("#frmAddHandout").submit(function() {
		
			event.preventDefault();
			
		
			var form = $(this);
		
		
			if($(form).find("[name=name]").val() == "" || $(form).find("[name=level]").val() == "default" || $(form).find("[name=pagesNumber]").val() == "") {
			
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
					request: "newOfficialHandout",
					handoutDetails: {
						courseId: courseId,
						name: $(form).find("[name=name]").val(),
						pagesNumber: $(form).find("[name=pagesNumber]").val()
					}
				},
				success: function(response) {
		
			//		alert ( "success >>> " + JSON.stringify(response) );
				
					if(response["status"] == "success") {
						
						sessionStorage.setItem("activeHandout", response["handoutId"]);
	
						bottomPage.rise("handout-gallery");
						
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