<?php
	
	$page = array("rootPath" => "../../");
	
	include_once($page["rootPath"] . "scripts/php/general-info.php");
	
	include_once($page["rootPath"] . "scripts/php/methods.php");
	
 ?>
 
  	<form method="post" class="form" autocomplete="off" id="frmAddSubscription">
 
 		<br><br>
 
 		<label class="formHeading">New handout subscription</label>
 		
 		<br><br><br>
 		
 		<hr>
 
 		<select name="institution" class="select" information="true">
  
   			<option value="default" hidden>Institution</option>
   				
   			<?php
   			
   				foreach($website["content"]["institutions"]["ids"] as $eachId) {
    
    					echo '<option value="' . $eachId . '" levelType="level">' . institutionDetails($eachId)["name"] . '</option>';
    					
    				}
    				
    			?>
    
  		</select>

 		<br><br><br>
 
 		<select name="department" class="select" information="true">
  
   			<option value="default" hidden>Department</option>
   				
   			<?php
   			
   				foreach($website["content"]["departments"]["ids"] as $eachId) {
    
    					echo '<option value="' . $eachId . '" levelType="level">' . departmentDetails($eachId)["name"] . '</option>';
    					
    				}
    				
    			?>
    
  		</select>

 		<br><br><br>
 
  <select name="level" class="select" information="true">
  
    <option value="default" hidden>Level</option>
    
    <option value="100 Level" levelType="level">100 level</option>
    
    <option value="200 Level" levelType="level">200 level</option>
    
    <option value="300 Level" levelType="level">300 level</option>
    
    <option value="400 Level" levelType="level">400 level</option>
    
    <option value="ND1" levelType="diploma">ND 1</option>
    
    <option value="ND2" levelType="diploma">ND 2</option>
    
    <option value="HND1" levelType="diploma">HND 1</option>
    
    <option value="HND2" levelType="diploma">HND 2</option>
    
  </select>

 		<br><br><br>
 
 		<select name="handout" class="select">
  
   			<option value="default" hidden>Awaiting information</option>
   				
   			<option value="Fetching handouts . . ." hidden>Fetching handouts . . .</option>
   				
   			<option value="Select handout" hidden>Select handout</option>
   				
    		</select>
    
 		<hr>or<hr>
 
 		<input type="text" name="productId" placeholder="Enter product id" class="input">
 
 		<hr>
 
 		<br><br><br>
 
 		<select name="subscriber" class="select">
  
   			<option value="default" hidden>Subscriber</option>
   				
   			<?php
   			
   				foreach($website["content"]["accounts"]["usercodes"] as $eachUsercode) {
    
    					echo '<option value="' . $eachUsercode . '">' . accountDetails($eachUsercode)["fullName"] . '</option>';
    					
    				}
    				
    			?>
    
  		</select>

 		<br><br><br>
 
 		<input type="number" name="duration" placeholder="Duration(days)" class="input">
 
 		<br><br><br><br>
 	
 		<input type="submit" name="submit" class="submit" value="Add subscription">
 	
 		<br><br><br>
 
	</form>

	<script>
		
		var form = $("#frmAddSubscription");
		
		
		$(form).find("[information=true]").change(function() {
			
			if($(form).find("[name=institution]").val() !== "default" && $(form).find("[name=department]").val() !== "default" && $(form).find("[name=level]").val() !== "default") {
		
				$(form).find("[name=handout]").val("Fetching handouts . . .").css("color", "green");
				
			$.ajax({
				url: "scripts/ajax-handler.php",
				type: "post",
				dataType: "JSON",
				data: {
					request: "fetchOfficialHandouts",
					handoutDetails: {
						institutionId: $(form).find("[name=institution]").val(),
						departmentId: $(form).find("[name=department]").val(),
						level: $(form).find("[name=level]").val()
					}
				},
				success: function(response) {
		
					if(response["status"] == "success") {
						
			//		alert ( "success" + JSON.stringify(response) );
						
						var handouts = response["handouts"];
						
						$(form).find("[name=handout]").val("Select handout").css("color", "black");
				
						for(var i = 0; i < handouts.length; i++) {
						
							$(form).find("[name=handout]").append('<option value="' + handouts[i]["handoutId"] + '">' + handouts[i]["name"] + ' (' + handouts[i]["handoutId"] + ')</option>');
				
						}
					
					}
				},
				error: function(response) {
				
					$("#frmAddSubscription").show();
					
					$("#loader").remove();
					
					alert ( JSON.stringify(response) );
					
				}
			});
	
			}
		
		});
		
		
		$("#frmAddSubscription").submit(function() {
		
			event.preventDefault();
			
			$(this).hide();
			
			$(this).before('<div id="loader">Loading . . .</div>');
		
		
			var form = $(this);
		
			if($(form).find("[name=productId]").val() == "") {
			
				var productId = $(form).find("[name=handout]").val();
			
			}
			
			else {
			
				var productId = $(form).find("[name=productId]").val();
			
			}
		
			$.ajax({
				url: "scripts/ajax-handler.php",
				type: "post",
				dataType: "JSON",
				data: {
					request: "newSubscription",
					subscriptionDetails: {
						productId: productId,
						duration: $(form).find("[name=duration]").val(),
						type: "official_handout",
						subscriberUsercode: $(form).find("[name=subscriber]").val()
					}
				},
				success: function(response) {
		
					if(response["status"] == "success") {
						
						sessionStorage.setItem("activeSubscription", response["institutionId"]);
	
				//		bottomPage.rise("subscription-page");
						
						bottomPage.drop();
						
					}
			
				},
				error: function(response) {
				
					$("#frmAddSubscription").show();
					
					$("#loader").remove();
					
					alert ( JSON.stringify(response) );
					
				}
			});
	
		});
			
	</script>