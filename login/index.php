<?php
	
	$page = array("rootPath" => "../", "title" => "Login", "buttonLine" => array("exists" => false));
	

	include_once("../scripts/php/connection.php");
	
	include_once("../scripts/php/functions.php");
	
	include_once("../scripts/php/methods.php");
	
	if(isset($_POST["email"])) {
		
		$email = mysqli_real_escape_string($conn, $_POST["email"]);
		
		$password = mysqli_real_escape_string($conn, $_POST["password"]);
		
		$sql = "SELECT * FROM accounts WHERE email_address = '$email' ";
		
		if($result = mysqli_query($conn, $sql)) {
			
			if(mysqli_num_rows($result) > 0) {
			
				$row = mysqli_fetch_array($result);
				
				if($row["password"] == $password) {
					
					$cookieCode = $row["cookie_code"];
			
					setcookie("accountCookieCode",  $cookieCode, time() + (86400 * 30), "/");
		
					echo '<script> alert("Login Successful"); </script>';
				
					relocate( isset($_GET["next"]) ? $_GET["next"] : $page["rootPath"] );
				
				}
				
				else {
				
					echo '<script> alert("Wrong Password"); </script>';
				
				}
				
			}
		
			else {
				
				echo '<script> alert("This email is not registered"); </script>';
				
			}
		
		}
	//	else echo mysqli_error($conn);
	
	}
	
	
	include_once($page["rootPath"] . "templates/header.php");
	
?>

    <style>
      body{
        font-family: Arial, Helvetica, sans-serif;
      }
      form{border: 3px solid #f1f1f1;}

      input[type=text], input[type=password] {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        box-sizing: border-box;
      }

      .imgcontainer {
        text-align: center;
        margin: 24px 0 12px 0;
      }

      .container{
        padding: 16px;
      }

      span.psw {
        float: right;
        padding-top: 16px;
      }

      @media screen and (max-width: 300px) {
         span.psw {
           display: block;
           float: none;
         }
      }
 

    </style>
    
        <h2>Login</h2>

 		<?php echo (isset($_GET["next"]) ? '<div class="centerHolder"> <label class="formLabel">You have to login to view this page</label> </div>' : ""); ?>
 	
        <form method="post">
          <div class="container">
              <label for="email"><b>Email</b></label>
              <input type="text" placeholder="Enter Email" name="email" required>
          
              <label for="psw"><b>Password</b></label>
              <input type="password" placeholder="Enter Password" name="password" required>
           
               <button type="submit">Login</button>    
           </div>

           <div class="container"
           style="background-color: #f1f1f1;">
               <span class="psw"> <a href="#">Forgot Password?</a> </span>
               
               <br>
               
               <span class="psw">Don't have an account?<a href="<?php echo $page["rootPath"] ?>signup">Signup</a> </span>
           
           </div>
        </form>

<?php
	
	include($page["rootPath"] . "templates/footer.php");
	
?>