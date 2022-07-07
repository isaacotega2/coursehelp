 	<form method="post" class="form" autocomplete="off" id="frmLogin" action="scripts/login.php">
 
 		<br><br>
 
 		<label class="formHeading">Log in to <?php echo $website["name"]; ?>'s admin panel</label>
 		
 		<br><br><br>
 
 		<input type="password" name="password" placeholder="Enter Password" class="input">
 
 		<br><br><br><br>
 	
 		<input type="submit" name="submit" class="submit" value="Log In">
 	
 		<br><br><br>
 
	</form>

	<script>
	
		$("#frmLogin").submit(function() {
		
			if($("#frmLogin [name=password]").val() == "") {
			
				alert("Please enter a password");
				
				event.preventDefault();
			
			}
		
		});
	
	</script>