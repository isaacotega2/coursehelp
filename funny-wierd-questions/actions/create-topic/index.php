<?php

	$page = array("rootPath" => "../../../", "title" => "Create topic", "restriction" => array("account"));
	
	include_once($page["rootPath"] . "scripts/php/connection.php");
	
	include_once($page["rootPath"] . "scripts/php/methods.php");
	
	include_once($page["rootPath"] . "scripts/php/general-info.php");
	
	$forumId = $_GET["id"];
	
	$forumDetails = forumDetails($forumId);
	
	$topicId = randomDigits(20);
	
	if(isset($_POST["title"])) {
		
		$title = mysqli_real_escape_string($conn, $_POST["title"]);
		
		$body = mysqli_real_escape_string($conn, $_POST["body"]);
		
		$date = date("Y m d");
	
		$time = date("h:i");
		
		$sql = "INSERT INTO topics (topic_id, forum_id, poster_usercode, title, body, date_posted, time_posted) VALUES ('$topicId', '$forumId', '" . $user["account"]["usercode"] . "', '$title', '$body', '$date', '$time') ";
		
		if(mysqli_query($conn, $sql)) {
		
			echo '<script> alert("Post Successful"); window.location.href = "' . $page["rootPath"] . $forumDetails["pageUri"] . '"; </script>';
		
		}
		
	}
	
	include_once($page["rootPath"] . "templates/header.php");
	
?>

    <style>
    .sub {
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

.sub:disabled {
  cursor: default;
}

.sub:focus {
  box-shadow: rgba(50, 50, 93, .1) 0 0 0 1px inset, rgba(50, 50, 93, .2) 0 6px 15px 0, rgba(0, 0, 0, .1) 0 2px 2px 0, rgba(50, 151, 211, .3) 0 0 0 4px;
}
body{
        font-family: -apple-system,system-ui,"Segoe UI",Roboto,"Helvetica Neue",Ubuntu,sans-serif;
      }

      a {
        text-decoration: none;
        color: black;
      }

      button {
  align-self: center;
  background-color: #fff;
  background-image: none;
  background-position: 0 90%;
  background-repeat: repeat no-repeat;
  background-size: 4px 3px;
  border-radius: 15px 225px 255px 15px 15px 255px 225px 15px;
  border-style: solid;
  border-width: 2px;
  box-shadow: rgba(0, 0, 0, .2) 15px 28px 25px -18px;
  box-sizing: border-box;
  color: #41403e;
  cursor: pointer;
  display: inline-block;
  font-family: Neucha, sans-serif;
  font-size: 1rem;
  line-height: 10px;
  outline: none;
  padding: .75rem;
  text-decoration: none;
  transition: all 235ms ease-in-out;
  border-bottom-left-radius: 15px 255px;
  border-bottom-right-radius: 225px 15px;
  border-top-left-radius: 255px 15px;
  border-top-right-radius: 15px 225px;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
  margin-top: 5px;
}

button:hover {
  box-shadow: rgba(0, 0, 0, .3) 2px 8px 8px -5px;
  transform: translate3d(0, 2px, 0);
}

button:focus {
  box-shadow: rgba(0, 0, 0, .3) 2px 8px 4px -6px;
}
      
.head-div {
  height: 40px;
  background-color: rgb(131, 97, 97);
  color: white;
  margin-top: 10px;
}
    </style>

  <div class="head-div"> <span style="display: flex; justify-content: center;
    height: 100%; align-items: center;">Create Topic</span></div>
    <hr>
     <h2>Create a Topic</h2>
     <h4> Notice: Please make sure you have read the rules & regulations about creating of topics in the website (Located below this page) before creating a topic</h4>
     <form method="post"><br>
       <p><h3>Topic Title:</h3></p> 
       <input type="text" name="title" size=40 maxlength=150 required>
       <p><h3>Post Text:</h3></p>
       <textarea name="body" rows=8 cols=40 wrap=virtual></textarea>
      <input type="file">
      <input type="file">
      <input type="file">
      <input type="file">
    
       <p><button class="sub" type="submit>">Add Topic</button></p>
</form>

<div>
  <h3>Rules & Regulations on Posting and Creating topics in the website</h3>
  <div>
    Please Observe the Following Rules below:
    <ul><!--
      <li>Don't bullly, abuse, delibrately insult/provoke, fight, or wish harm to any member of Coursehelp Forum</li>
      <li>Please spell words correctly when you post, and try to use perfect grammar and puntuation</li>
      <li>Don't threnten, support or defend violent acts against any person, tribe, race, animals, or group</li>
      <li>Don't post pornography or disgusting pictures or videos on any section of Coursehelp Forum</li>
      <li>Don't post adverts or affilate links on the website. you can contact Coursehelp Forum on Email ...... to upload your adverts in the designated area. </li>
      <li>Don't say, do or threnten to do anything that's detrimental to the security, success, or reputation of Coursehelp Forum</li>  
      <li>Don't post false information on Coursehelp Forum</li>
      <li>Don't use Coursehelp Forum for illegal acts, e.g Scams, plagiarism, hacking, gay meetings,incitement,promoting secession</li>
      <li>Don't violate the privacy of any people e.g by posting their private pics, info, or chats without permission</li>
      <li>Please Report any post or topic that violates the rules of Coursehelp Forum using the (Report) button</li>
      <li>Please search the Forum before creating a new topic/thread on the website</li>
      <li>Don't attempt to post censored words by misspelling them</li>
      <li>Don't promote shady investments like betting, HYIP, MLM, FOREX,binary options,and cryptocurrencies on Coursehelp Forum</li>
      <li>Don't spam the Forum by advertising or posting the same content many times</li>
      <li>Compliants to or against Moderators and Admins must be sent privately. Please don't disobey, disrespect, or defame them</li>
   -->
    </ul>
  </div>
</div>
    

<?php
	
	include($page["rootPath"] . "templates/footer.php");
	
?>