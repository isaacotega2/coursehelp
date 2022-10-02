<?php

	$page = array("rootPath" => "../../../", "title" => "Reply", "restriction" => array("account"));
	
	include_once($page["rootPath"] . "scripts/php/connection.php");
	
	include_once($page["rootPath"] . "scripts/php/functions.php");
	
	include_once($page["rootPath"] . "scripts/php/methods.php");
	
	include_once($page["rootPath"] . "scripts/php/general-info.php");
	
	$topicId = $_GET["topic-id"];
	
	if(!isset($_GET["unbased"])) {
	
		$baseId = $_GET["base-id"];
		
		$baseDetails = replyDetails($baseId);
	
	}
	
	$topicDetails = topicDetails($topicId);
	

	if(isset($_POST["reply"])) {
		
		$replyId = randomDigits(20);
	
		$reply = mysqli_real_escape_string($conn, $_POST["reply"]);
		
		$date = date("Y m d");
	
		$time = date("h:i");
		
		if(isset($_GET["unbased"])) {
		
			$sql = "INSERT INTO replies (reply_id, replier_usercode, topic_id, reply, based, date_posted, time_posted) VALUES ('$replyId', '" . $user["account"]["usercode"] . "', '$topicId', '$reply', 'false', '$date', '$time') ";
			
			notify($topicDetails["posterUsercode"], accountDetails($user["account"]["usercode"])["profilePicture"], ("topic?id=" . $topicId . "#" . $replyId), (accountDetails($user["account"]["usercode"])["nickname"] . " replied to your post, click to view."));
		
		}
		
		else {
		
			$sql = "INSERT INTO replies (reply_id, replier_usercode, topic_id, base_id, reply, based, date_posted, time_posted) VALUES ('$replyId', '" . $user["account"]["usercode"] . "', '$topicId', '$baseId', '$reply', 'true', '$date', '$time') ";
			
			notify(replyDetails($baseId)["replierUsercode"], accountDetails($user["account"]["usercode"])["profilePicture"], ("topic?id=" . $topicId . "#" . $replyId), (accountDetails($user["account"]["usercode"])["nickname"] . " replied to your comment, click to view."));
		
		}
		
		
		if(mysqli_query($conn, $sql)) {
			
			if(isset($_FILES["image1"])) {
				
				$file = $_FILES["image1"];
			
				$filePath = ($page["rootPath"] . "images/posts/" . $replyId . "_1.jpg");
	
				move_uploaded_file($file["tmp_name"], $filePath);
			
			}
		
			if(isset($_FILES["image2"])) {
			
				$file = $_FILES["image2"];
			
				$filePath = ($page["rootPath"] . "images/posts/" . $replyId . "_2.jpg");
	
				move_uploaded_file($file["tmp_name"], $filePath);
			
			}
		
			if(isset($_FILES["image3"])) {
			
				$file = $_FILES["image3"];
			
				$filePath = ($page["rootPath"] . "images/posts/" . $replyId . "_3.jpg");
	
				move_uploaded_file($file["tmp_name"], $filePath);
			
			}
		
			die( '<script> window.location.href = "' . $page["rootPath"] . 'topic?id=' . $topicId . '#' . $replyId . '"; </script>');
		
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

.head-div {
  height: 40px;
  background-color: rgb(131, 97, 97);
  color: white;
  margin-top: 10px;
}
    </style>


     <h2>Reply</h2>
     <h4> Notice: Please make sure you have read the rules & regulations about posting and creating of topics in the website (Located below this page) before creating a topic</h4>
     <form method="post" enctype="multipart/form-data"><br>
       <p><h3>Reply:</h3></p>
       <textarea name="reply" rows=8 cols=40 wrap=virtual></textarea>
       
       
       
      <input type="file" name="image1">
      <input type="file" name="image2">
      <input type="file" name="image3">
    
       <p><button class="sub" type="submit>">Reply</button></p>
</form>

<div>
  <h3>Rules & Regulations on Posting and Creating topics in the website</h3>
  <div>
    Please Observe the Following Rules below:
    <ul>
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
   
    </ul>
  </div>
</div>
    
<?php
	
	include($page["rootPath"] . "templates/footer.php");
	
?>