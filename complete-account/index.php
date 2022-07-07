<?php
	
	include_once("../scripts/php/connection.php");
	
	if(isset($_COOKIE["accountCookieCode"])) {
		
		$cookieCode = $_COOKIE["accountCookieCode"];
		
		if(isset($_POST["institution"])) {
		
			$institution = $_POST["institution"];
	
			$course = $_POST["course"];
	
			$level = $_POST["level"];
	
			$sql = "UPDATE accounts SET institution = '$institution', course = '$course', level = '$level' WHERE cookie_code = '$cookieCode' ";
	
			if(mysqli_query($conn, $sql)) {
			
				echo '<script> window.location.href = "success"; </script>';
		
			}
		
	//		else echo mysqli_error($conn);
			
		}
	
	}
	
	else {
	
		echo '<script> window.location.href = "../login"; </script>';
	
	}
	
	include_once("../scripts/php/general-info.php");
	
	include_once("../scripts/php/methods.php");
	
 ?>
 
 <!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
 body {
   font-family: -apple-system,system-ui,"Segoe UI",Roboto,"Helvetica Neue",Ubuntu,sans-serif;
 } 
/*the container must be positioned relative:*/
.custom-select {
  position: relative;
  font-family: Arial;
}

.custom-select select {
  display: none; /*hide original SELECT element:*/
}

.select-selected {
  background-color: rgb(131, 97, 97);
}

/*style the arrow inside the select element:*/
.select-selected:after {
  position: absolute;
  content: "";
  top: 14px;
  right: 10px;
  width: 0;
  height: 0;
  border: 6px solid transparent;
  border-color: #fff transparent transparent transparent;
}

/*point the arrow upwards when the select box is open (active):*/
.select-selected.select-arrow-active:after {
  border-color: transparent transparent #fff transparent;
  top: 7px;
}

/*style the items (options), including the selected item:*/
.select-items div,.select-selected {
  color: #ffffff;
  padding: 8px 16px;
  border: 1px solid transparent;
  border-color: transparent transparent rgba(0, 0, 0, 0.1) transparent;
  cursor: pointer;
  user-select: none;
}

/*style items (options):*/
.select-items {
  position: absolute;
  background-color: rgb(131, 97, 97);
  top: 100%;
  left: 0;
  right: 0;
  z-index: 99;
}

/*hide the items when the select box is closed:*/
.select-hide {
  display: none;
}

.select-items div:hover, .same-as-selected {
  background-color: rgba(0, 0, 0, 0.1);
}
/* Button styling*/


.button-1 {
  appearance: button;
  backface-visibility: hidden;
  background-color:  rgb(131, 97, 97);
  border-radius: 6px;
  border-width: 0;
  box-shadow: rgba(50, 50, 93, .1) 0 0 0 1px inset,rgba(50, 50, 93, .1) 0 2px 5px 0,rgba(0, 0, 0, .07) 0 1px 1px 0;
  box-sizing: border-box;
  color: #fff;
  cursor: pointer;
  font-family: -apple-system,system-ui,"Segoe UI",Roboto,"Helvetica Neue",Ubuntu,sans-serif;
  font-size: 100%;
  height: 40px;
  line-height: 1.15;
  margin: 12px 0 0;
  outline: none;
  overflow: hidden;
  padding: 0 25px;
  position: relative;
  text-align: center;
  text-transform: none;
  transform: translateZ(0);
  transition: all .2s,box-shadow .08s ease-in;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
  width: 150px;
  
}

.button-1:disabled {
  cursor: default;
}

.button-1:focus {
  box-shadow: rgba(50, 50, 93, .1) 0 0 0 1px inset, rgba(50, 50, 93, .2) 0 6px 15px 0, rgba(0, 0, 0, .1) 0 2px 2px 0, rgba(50, 151, 211, .3) 0 0 0 4px;
}

.button-div{
margin: auto;
}



</style>
</head>     

<body>
     <div style=" text-align: center;
     margin: 24px 0 12px 0;">
       <img style="height: 50px;" src="../cooltext412489882790884.png ">
     </div>
 
<form method="post">
  <h2>Select your Institution</h2>
<!--surround the select box with a "custom-select" DIV element. Remember to set the width:-->
<div>
  <select name="institution">
    <option value="0">Select Institution :</option>
    
    <?php
    	
    		foreach($website["content"]["institutions"]["ids"] as $eachId) {
    		
 			echo '<option>' . institutionDetails($eachId)["name"] . '</option>';
 			
 		}
 		
 	?>
 	
  </select>

</div>


  <h2>Choose your course of study</h2>


  <select name="course">
  
    <option value="0">Select your course of study :</option>
    
    <?php
    	
    		foreach($website["content"]["mainCourses"]["ids"] as $eachId) {
    		
 			echo '<option>' . mainCourseDetails($eachId)["name"] . '</option>';
 			
 		}
 		
 	?>
 	
  </select>


    <h2>Select Your Level</h2>

       <input type="radio" id="R1" name="level" value="100 Level">
       <label for="R1">100 Level</label> <br>
 
       <input type="radio" id="R2" name="level" value="200 Level">
       <label for="R2">200 Level</label> <br>

       <input type="radio" id="R3" name="level" value="300 Level">
       <label for="R3">300 Level</label> <br>

       <input type="radio" id="R4" name="level" value="400 Level">
       <label for="R4">400 Level</label> <br>

       <input type="radio" id="R5" name="level" value="500 Level">
       <label for="R5">500 Level</label> <br>

       <input type="radio" id="R6" name="level" value="ND 1">
       <label for="R6">ND 1</label> <br>

       <input type="radio" id="R7" name="level" value="ND 2">
       <label for="R7">ND 2</label> <br>

       <input type="radio" id="R8" name="level" value="HND 1">
       <label for="R8">HND 1</label> <br>

       <input type="radio" id="R9" name="level" value="HND 2">
       <label for="R9">HND 2</label> <br>

       <input type="radio" id="R10" name="level" value="Graduate">
       <label for="R10">Graduate</label> <br>

       <input type="radio" id="R11" name="level" value="Post Graduate">
       <label for="R11">Post Graduate</label> <br>

       <input type="radio" id="R12" name="level" value="Guest">
       <label for="R12">Guest</label> <br>
       
       
<div class="button-div">
  <button class="button-1" role="button">Proceed</button>
</div>


</form>
<script>


</script>

</body>
</html>