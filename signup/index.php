<?php

	$page = array("rootPath" => "../", "title" => "Signup", "buttonLine" => array("exists" => false));
	
	include_once("../scripts/php/connection.php");
	
	include_once("../scripts/php/functions.php");
	
	include_once("../scripts/php/methods.php");
	
	if(isset($_POST["fullName"])) {
	
		$usercode = randomDigits(20);
			
		$cookieCode = randomDigits(20);
			
		$fullName = mysqli_real_escape_string($conn, $_POST["fullName"]);
		
		$nickname = mysqli_real_escape_string($conn, $_POST["nickname"]);
	
		$email = mysqli_real_escape_string($conn, $_POST["email"]);
		
		$password = mysqli_real_escape_string($conn, $_POST["password"]);
	
		$gender = mysqli_real_escape_string($conn, $_POST["gender"]);
		
		$date = date("Y m d");
	
		$time = date("h:i");
		
		$sql = "INSERT INTO accounts (full_name, nickname, email_address, usercode, cookie_code, password, gender, date_registered, time_registered) VALUES ('$fullName', '$nickname', '$email', '$usercode', '$cookieCode', '$password', '$gender', '$date', '$time') ";
		
		if(mysqli_query($conn, $sql)) {
			
			notify($usercode, "images/icon.png", "", "Hi " . $nickname . ", Welcome to Coursehelp Forum. This is an educational website with the purpose to help students get educational Materials easily, Build Social Network, Make friends and Boost your intellectual capability through fun games and event. Please try as much as possible to obey the rules and regulations of the website. WELCOME

signed Coursehelp Forum");
			
			setcookie("accountCookieCode",  $cookieCode, time() + (86400 * 30), "/");
		
			echo '<script> window.location.href = "../complete-account"; </script>';
		
		}
//		else echo mysqli_error($conn);
	
	}

	
	include_once($page["rootPath"] . "templates/header.php");
	
?>
		
    <style>
      body{
        font-family: Arial, Helvetica, sans-serif;
        box-sizing: border-box;
      }
    input[type=text], input[type=password] {
      width: 100%;
      padding: 15px;
      margin: 5px 0 22px 0;
      display: inline-block;
      border: none;
      background: #f1f1f1;
    }

    input[text=text]:focus,
    input[type=password]:focus {
      background-color: #ddd;
      outline: none;
    }

    hr {
      border: 1px solid #f1f1f1;
      margin-bottom: 25px;
    }


    .container {
        padding: 16px;
  }

  .clearfix::after {
        content: "";
        clear: both;
        display: table;
  }

  @media screen and (max-width: 300px) {
      .signupbtn {
       width: 100px;
     }
  }
    
 
    </style>
        
    <form id="f" method="post"
    style="border: 1px solid #ccc;">
  <div class="container">
       <hi>Sign Up</hi>
       <p>please fill in this form to create an account</p>
       <hr>
         
       <label for="name"><b>Full name</b></label>
       <input type="text" placeholder="Enter Full name"
       name="fullName" required>

       
       <label for="nickname"><b>School Nickname(AKA)</b></label>
       <input type="text" placeholder="Enter Nickname"
       name="nickname" required>

       <label for="email"><b>Email</b></label>
       <input type="text" placeholder="Enter Email" name="email" required>
       
       <label for="psw"><b>Password</b></label>
       <input  id="pass" type="password" placeholder="Enter Password"
       name="password" required>

       <label for="psw-repeat"><b>Repeat Password</b></label>
       <input  id="repeat" type="password" placeholder="Repeat Password"
       name="psw-repeat" required>

       <p>Select Gender</p>
       <input type="radio" id="Mgender" name="gender" value="male">
       <label for="Mgender">Male</label> <br>
       <input type="radio" id="Fgender" name="gender" value="female" required>
       <label for="Fgender">Female</label> <br>

       <p> By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>
       <div class="clearfix">
          
          <button type="submit"  class="signupbtn"> Sign Up </button>

       </div>

               <br>
               
               <span class="psw">Already have an account?<a href="<?php echo $page["rootPath"] ?>login">Login</a> </span>
           
  </div>
  </form>
    <script>
       var form = 
       document.getElementById("f");

       form.addEventListener("submit",
       function() {
        var password = 
       form.querySelector("#pass").value;
       

       var repeatedPassword = 
       form.querySelector("#repeat").value;
       

       if(password != repeatedPassword) {

        alert("Password missmatch");
        event.preventDefault();
       }
       }
       );

        
   

    </script>

<?php
	
	include($page["rootPath"] . "templates/footer.php");
	
?>