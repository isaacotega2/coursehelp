<?php
	
	$page = array("rootPath" => "../", "title" => "Login");
	
	
	include_once("../scripts/php/functions.php");
	
	include_once("../scripts/php/methods.php");
	
	isset($_GET["id"]) or die(relocate("../"));
	
	$usercode = $_GET["id"];
	
	$accountDetails = accountDetails($usercode);
	
	include_once($page["rootPath"] . "templates/header.php");
	
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
    
  <div class="head-div"> <span> Viewing profile - B_Baz </span></div>
     <br>
     
     <h4> Profile picture</h4>
     <img style="height: 200px;" src="Pic.jpg">
     <hr>
     <h4> About me</h4>
     <p>My name is Barnabas Victor and i love coding</p>
     <hr>
    <p> <b>Name:</b> Victor Barnabas</p>
    <p> <b>Also known as:</b> B_Baz</p>
    <p><b>Gender:</b> Male</p>
    <p><b>Institution:</b> University of Abuja</p>
    <p><b>Course of study:</b> Geography</p>
    <p><b>Level:</b>400 Level</p>
    <p><b>Rank:</b> Admin </p>
    <hr>
    <p> <b>Time Registered:</b> June 13 2022</p>
    <p> <b>Last seen:</b> Yesterday, 3:30 am</p>
    <p><b>Total post:</b> 434</p>
      
     <p><a href="#"> EDIT PROFILE </a></p> <hr>

     <div>
       <h2 class="dash">DASHBOARD</h2>
       <h3>Materials Posted Stats</h3>
       <p><b>Current Withdrawable Balance:</b> N14,300</p>
       <button > <a class="button-link" href="#"> Withdraw Now</a></button>
       <h4>List of materials posted</h4>  </div>
    <div>
       <ul>
         <li> <a href="#"> History Of Geography </a> </li>
         </ul>
         <h5>SUBCRIPTIONS (past 3 months)</h5>
         <p> 35 users purchase this material in January 2022 </p>
         <p> 10 users purchase this material in Febuary 2022 </p>
         <p> 278 users purchase this material in March 2022 </p>
         <h4>This month (April) financial stats</h4>
         <p>106 users currently purchased this material </p>
         <p><b>Total money acquired: </b> N7,200</p>
         <p><b>Withdrawable Balance (after 40% charge): </b> N4,320</p>
      </div> <hr>

      <div>
        <ul>
          <li> <a href="#"> History Of Geomorphic thought </a> </li>
          </ul>
          <h5>SUBCRIPTIONS (past 3 months)</h5>
          <p> 5 users purchase this material in July 2022 </p>
          <p> 32 users purchase this material in August 2022 </p>
          <p> 47 users purchase this material in September 2022 </p>
          <h4>This month (October) financial stats</h4>
          <p>12 users currently purchased this material </p>
          <p><b>Total money acquired: </b> N2,000</p>
          <p><b>Withdrawable Balance (after 40% charge): </b> N1,200</p>
       </div> <hr>

       <div>
        <ul>
          <li> <a href="#"> Climatology of the Tropics </a> </li>
          </ul>
          <h5>SUBCRIPTIONS (past 3 months)</h5>
          <p> 2 users purchase this material in July 2022 </p>
          <p> 53 users purchase this material in August 2022 </p>
          <p> 3 users purchase this material in September 2022 </p>
          <h4>This month (October) financial stats</h4>
          <p>1 users currently purchased this material </p>
          <p><b>Total money acquired: </b> N400</p>
          <p><b>Withdrawable Balance (after 40% charge): </b> N240</p>
       </div> <hr>
       

<?php
	
	include($page["rootPath"] . "templates/footer.php");
	
?>