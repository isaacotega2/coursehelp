<?php
	
	$page = array("rootPath" => "../");
	
	
	include_once("../scripts/php/functions.php");
	
	include_once("../scripts/php/methods.php");
	
	isset($_GET["id"]) or die(relocate("../"));
	
	$usercode = $_GET["id"];
	
	$accountDetails = accountDetails($usercode);
	
	$page["title"] = $accountDetails["nickname"];
	
	include_once($page["rootPath"] . "templates/header.php");
	
	$accountDetails = accountDetails($usercode);
	
?>

    <style>
  .button-link {
    text-decoration: none;
    color: black;
}
  .dash {
    display: flex;
    justify-content: center;
  }
    </style>
    
  <div class="head-div"> <span> Viewing profile - <?php echo $accountDetails["nickname"]; ?> </span></div>
     <br>
     
     <h4> Profile picture</h4>
     <img style="height: 200px;" src="<?php echo $accountDetails["profilePicture"]; ?>">
     <hr>
     <h4> About me</h4>
     <p><pre><?php echo $accountDetails["bio"]; ?></pre></p>
     <hr>
    <p> <b>Name:</b> <pre><?php echo $accountDetails["fullName"]; ?></pre></p>
    <p> <b>Also known as:</b> <?php echo $accountDetails["nickname"]; ?></p>
    <p><b>Gender:</b> <?php echo $accountDetails["gender"]; ?></p>
    <p><b>Institution:</b> <?php echo $accountDetails["institution"]; ?></p>
    <p><b>Course of study:</b> <?php echo $accountDetails["course"]; ?></p>
    <p><b>Level:</b><?php echo $accountDetails["level"]; ?></p>
 <!--   <p><b>Rank:</b> Admin </p>-->
    <hr>
    <p> <b>Time Registered:</b> <?php echo $accountDetails["dateRegistered"]; ?> | <?php echo $accountDetails["timeRegistered"]; ?></p>
    <p> <b>Last seen:</b> <?php echo $accountDetails["lastActiveDate"]; ?> | <?php echo $accountDetails["lastActiveTime"]; ?></p>
  <!--  <p><b>Total post:</b> 434</p>-->
    
    <?php
      
     	if($accountDetails["usercode"] == $user["account"]["usercode"]) {
     	
     		echo '<p><a href="' . $page["rootPath"] . 'edit-profile"> EDIT PROFILE </a></p>';
     		
     	}
     	
     	else {
     	
     		echo '<p><a href="' . $page["rootPath"] . 'messages/dialogue/init?partner=' . $accountDetails["usercode"] . '"> MESSAGE </a></p>';
     		
     	}
     
     ?>
     
     <hr>

     <div>

<?php
	
	include($page["rootPath"] . "templates/footer.php");
	
?>