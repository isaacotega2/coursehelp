<?php
	
	require_once("connection.php");
	
	require_once("general-info.php");
	
	function accountDetails($usercode) {
		
		global $conn, $page, $website;
		
		$sql = "SELECT * FROM accounts WHERE usercode = '$usercode' ";
		
		if($result = mysqli_query($conn, $sql)) {
		
			$row = mysqli_fetch_array($result);
			
			$accountDetails = array();
			
			$accountDetails["is"] = array();
			
			$accountDetails["usercode"] = $row["usercode"];
		
			$accountDetails["fullName"] = $row["full_name"];
		
			$accountDetails["nickname"] = $row["nickname"];
		
			$accountDetails["bio"] = $row["bio"];
		
			$accountDetails["gender"] = $row["gender"];
		
			$accountDetails["emailAddress"] = $row["email_address"];
		
			$accountDetails["password"] = $row["password"];
		
			$accountDetails["institution"] = $row["institution"];
		
			$accountDetails["course"] = $row["course"];
		
			$accountDetails["level"] = $row["level"];
		
			$accountDetails["usercode"] = $row["usercode"];
		
			$accountDetails["cookieCode"] = $row["cookie_code"];
		
			$accountDetails["dateRegistered"] = $row["date_registered"];
		
			$accountDetails["timeRegistered"] = $row["time_registered"];
			
			$accountDetails["lastActiveDate"] = $row["last_active_date"];
		
			$accountDetails["lastActiveTime"] = $row["last_active_time"];
			
			
			$accountDetails["originalProfilePicture"] = ($page["rootPath"] . "images/profile-pictures/" . $row["usercode"] . ".jpg");
			
			$accountDetails["profilePicture"] = (file_exists($accountDetails["originalProfilePicture"]) ? $accountDetails["originalProfilePicture"] : ($page["rootPath"] . "images/avatars/" . $accountDetails["gender"] . ".jpg"));
		
			
			if(isset($_COOKIE[$website["cookies"]["admin"]["name"]])) {
			
				$accountDetails["is"]["websiteAdmin"] = true;
			
			}
			
			else {
			
				$accountDetails["is"]["websiteAdmin"] = false;
			
			}
			
			$sql = "SELECT * FROM notifications WHERE receiver_usercode = '$usercode' ORDER BY date_sent, time_sent DESC ";
		
			if($result = mysqli_query($conn, $sql)) {
		
				$accountDetails["notifications"]["ids"] = array();
			
				while($row = mysqli_fetch_array($result)) {
					
					$accountDetails["notifications"]["ids"][] = $row["notification_id"];
				
				}
				
			}
			
			$sql = "SELECT * FROM dialogues WHERE first_partner_usercode = '$usercode' OR second_partner_usercode = 'usercode' ";
		
			if($result = mysqli_query($conn, $sql)) {
		
				$accountDetails["unseenMessagesNumber"] = 0;
			
				$accountDetails["dialogues"]["ids"] = array();
			
				while($row = mysqli_fetch_array($result)) {
					
					$accountDetails["dialogues"]["ids"][] = $row["dialogue_id"];
					
					if($row["first_partner_usercode"] == $usercode) {
					
						if($row["first_partner_seen"] == "false") {
						
							$accountDetails["unseenMessagesNumber"]++;
						
						}
					
					}
				
					if($row["second_partner_usercode"] == $usercode) {
					
						if($row["second_partner_seen"] == "false") {
						
							$accountDetails["unseenMessagesNumber"]++;
						
						}
					
					}
				
				}
				
			}
			
			$sql = "SELECT * FROM subscriptions WHERE subscriber_usercode = '$usercode' AND type = 'official_handout' ";
		
			if($result = mysqli_query($conn, $sql)) {
		
				$accountDetails["subscriptions"]["handout"]["all"]["ids"] = array();
			
				$accountDetails["subscriptions"]["handout"]["active"]["ids"] = array();
			
				while($row = mysqli_fetch_array($result)) {
					
					$subscriptionId = $row["subscription_id"];
				
					$productId = $row["product_id"];
				
					$accountDetails["subscriptions"]["handout"]["all"]["ids"][] = $productId;
					
					if($row["active"] == "true") {
					
						$accountDetails["subscriptions"]["handout"]["active"]["ids"][] = $productId;
					
					}
				
				}
				
			}

			return $accountDetails;
	
		}
		
	}
	 
	
	function forumDetails($forumId) {
		
		global $conn, $page;
		
		$sql = "SELECT * FROM forums WHERE forum_id = '$forumId' ";
		
		if($result = mysqli_query($conn, $sql)) {
		
			$row = mysqli_fetch_array($result);
			
			$forumDetails = array();
			
			$forumDetails["forumId"] = $row["forum_id"];
		
			$forumDetails["name"] = $row["name"];
		
			$forumDetails["creatorUsercode"] = $row["creator_usercode"];
		
			$forumDetails["folder"] = $row["folder"];
		
			$forumDetails["pageUri"] = ("forum/" . $forumDetails["folder"]);
		
			$forumDetails["dateCreated"] = $row["date_created"];
		
			$forumDetails["timeCreated"] = $row["time_created"];
		
			$forumDetails["list"] = array();
					
			$sql = "SELECT * FROM forum_members WHERE forum_id = '$forumId' ";
		
			if($result = mysqli_query($conn, $sql)) {
			
				$forumDetails["members"]["number"] = mysqli_num_rows($result);
				
				$forumDetails["members"]["usercodes"] = array();
				
				while($row = mysqli_fetch_array($result)) {
				
					$forumDetails["members"]["usercodes"][] = $row["member_usercode"];
				
				}
			
			}
			
			$sql = "SELECT * FROM topics WHERE forum_id = '$forumId' ";
		
			if($result = mysqli_query($conn, $sql)) {
			
				$forumDetails["list"]["topics"] = array();
					
				while($row = mysqli_fetch_array($result)) {
					
					$forumDetails["list"]["topics"][] = $row["topic_id"];
					
				}
			
			}
		
			return $forumDetails;
	
		}
		
	}
	
	
	function forumMembersDetails($memberUsercode) {
		
		global $conn, $page;
		
		$sql = "SELECT * FROM forum_members WHERE member_usercode = '$memberUsercode' ";
		
		if($result = mysqli_query($conn, $sql)) {
		
			$row = mysqli_fetch_array($result);
			
			$forumMembersDetails = array();
			
			$forumMembersDetails["is"] = array();
			
			$forumMembersDetails["forumId"] = $row["forum_id"];
		
			$forumMembersDetails["memberUsercode"] = $row["member_usercode"];
		
			$forumMembersDetails["dateJoined"] = $row["date_joined"];
		
			$forumMembersDetails["timeJoined"] = $row["time_joined"];
			
			$forumMembersDetails["is"]["admin"] = ($row["admin"] == "true" ? true : false);
			
		
			return $forumMembersDetails;
	
		}
		
	}
	
	function topicDetails($topicId) {
		
		global $conn, $page;
		
		$sql = "SELECT * FROM topics WHERE topic_id = '$topicId' ";
		
		if($result = mysqli_query($conn, $sql)) {
		
			$row = mysqli_fetch_array($result);
			
			$topicDetails = array();
			
			$topicDetails["topicId"] = $row["topic_id"];
		
			$topicDetails["forumId"] = $row["forum_id"];
		
			$topicDetails["posterUsercode"] = $row["poster_usercode"];
		
			$topicDetails["title"] = $row["title"];
		
			$topicDetails["body"] = $row["body"];
		
			$topicDetails["datePosted"] = $row["date_posted"];
		
			$topicDetails["timePosted"] = $row["time_posted"];
		
			$topicDetails["list"] = array();
			
			$sql = "SELECT * FROM replies WHERE topic_id = '" . $topicDetails["topicId"] . "' ORDER BY date_posted, time_posted";
					
			if($result = mysqli_query($conn, $sql)) {
				
				$topicDetails["list"]["replies"]["ids"] = array();
		
				while($row = mysqli_fetch_array($result)) {
				
					$topicDetails["list"]["replies"]["ids"][] = $row["reply_id"];
				
				}
			
			}
			
			return $topicDetails;
	
		}
		
	}
	
	function replyDetails($replyId) {
		
		global $conn, $page;
		
		$sql = "SELECT * FROM replies WHERE reply_id = '$replyId' ";
		
		if($result = mysqli_query($conn, $sql)) {
		
			$row = mysqli_fetch_array($result);
			
			$replyDetails = array();
			
			$replyDetails["replyId"] = $row["reply_id"];
		
			$replyDetails["replierUsercode"] = $row["replier_usercode"];
		
			$replyDetails["topicId"] = $row["topic_id"];
		
			$replyDetails["baseId"] = $row["base_id"];
		
			$replyDetails["reply"] = $row["reply"];
		
			$replyDetails["datePosted"] = $row["date_posted"];
		
			$replyDetails["timePosted"] = $row["time_posted"];
		
			$replyDetails["is"] = array();
			
			$replyDetails["is"]["based"] = ($row["based"] == 'true');
			
			$replyDetails["likes"] = array();
			
			$replyDetails["likes"]["usercodes"] = array();
					
			$sql = "SELECT * FROM likes WHERE resource_id = '$replyId' ";
			
			if($result = mysqli_query($conn, $sql)) {
		
				$replyDetails["likes"]["number"] = mysqli_num_rows($result);
					
				while($row = mysqli_fetch_array($result)) {
			
					$replyDetails["likes"]["usercodes"][] = $row["liker_usercode"];
					
				}
					
		 	}
			
			$sql = "SELECT * FROM replies WHERE base_id = '$replyId' ";
			
			if($result = mysqli_query($conn, $sql)) {
		
				$replyDetails["replies"]["exists"] = (mysqli_num_rows($result) > 0);
					
				while($row = mysqli_fetch_array($result)) {
			
					$replyDetails["replies"]["ids"][] = $row["reply_id"];
					
				}
		 	
		 	}
		 	
			return $replyDetails;
	
		}
		
	}
	 
	
	function departmentDetails($departmentId) {
		
		global $conn, $page;
		
		$sql = "SELECT * FROM departments WHERE department_id = '$departmentId' ";
		
		if($result = mysqli_query($conn, $sql)) {
		
			$row = mysqli_fetch_array($result);
			
			$departmentDetails = array();
			
			$departmentDetails["departmentId"] = $row["department_id"];
		
			$departmentDetails["name"] = $row["name"];
		
			$departmentDetails["courses"] = array("ids" => array());
		
			$sql = "SELECT * FROM courses WHERE department_id = '$departmentId' ";
			
			if($result = mysqli_query($conn, $sql)) {
		
				$departmentDetails["courses"]["number"] = mysqli_num_rows($result);
					
				while($row = mysqli_fetch_array($result)) {
			
					$departmentDetails["courses"]["ids"][] = $row["course_id"];
					
				}
				
			}
	
		}
		
		return $departmentDetails;
	
	}
	
	
	function courseDetails($courseId) {
		
		global $conn, $page;
		
		$sql = "SELECT * FROM courses WHERE course_id = '$courseId' ";
		
		if($result = mysqli_query($conn, $sql)) {
		
			$row = mysqli_fetch_array($result);
			
			$courseDetails = array();
			
			$courseDetails["courseId"] = $row["course_id"];
		
			$courseDetails["departmentId"] = $row["department_id"];
		
			$courseDetails["institutionId"] = $row["institution_id"];
		
			$courseDetails["name"] = $row["name"];
		
			$courseDetails["level"] = $row["level"];
		
			$courseDetails["datePosted"] = $row["date_posted"];
		
			$courseDetails["acceptingDonation"] = ($row["accepting_donation"] == "true") ? true : false;
		
			$courseDetails["timePosted"] = $row["time_posted"];
		
			$sql = "SELECT * FROM official_handouts WHERE course_id = '$courseId' ";
			
			if($result = mysqli_query($conn, $sql)) {
		
				$courseDetails["handouts"]["number"] = mysqli_num_rows($result);
					
				$courseDetails["handouts"]["ids"] = array();
					
				while($row = mysqli_fetch_array($result)) {
			
					$courseDetails["handouts"]["ids"][] = $row["handout_id"];
					
				}
				
			}
	

		}
		
		return $courseDetails;
	
	}
	
	function institutionDetails($institutionId) {
		
		global $conn, $page, $website;
		
		$sql = "SELECT * FROM institutions WHERE institution_id = '$institutionId' ";
		
		if($result = mysqli_query($conn, $sql)) {
		
			$row = mysqli_fetch_array($result);
			
			$institutionDetails = array();
			
			$accountDetails["is"] = array();
			
			$institutionDetails["institutionId"] = $row["institution_id"];
		
			$institutionDetails["name"] = $row["name"];
		
			$institutionDetails["type"] = $row["type"];
		
		}
		
		return $institutionDetails;
	
	}
	
	function officialHandoutDetails($handoutId) {
		
		global $conn, $page;
		
		$sql = "SELECT * FROM official_handouts WHERE handout_id = '$handoutId' ";
		
		if($result = mysqli_query($conn, $sql)) {
		
			$row = mysqli_fetch_array($result);
			
			$officialHandoutDetails = array();
			
			$officialHandoutDetails["handoutId"] = $row["handout_id"];
		
			$officialHandoutDetails["courseId"] = $row["course_id"];
		
			$officialHandoutDetails["name"] = $row["name"];
		
			$officialHandoutDetails["pagesNumber"] = $row["pages_number"];
		
			$officialHandoutDetails["datePosted"] = $row["date_posted"];
		
			$officialHandoutDetails["timePosted"] = $row["time_posted"];
		
			$officialHandoutDetails["dateUpdated"] = $row["date_updated"];
		
			$officialHandoutDetails["timeUpdated"] = $row["time_updated"];
		
			return $officialHandoutDetails;
	
		}
		
	}
	
	
	function donatedHandoutDetails($handoutId) {
		
		global $conn, $page;
		
		$sql = "SELECT * FROM donated_handouts WHERE handout_id = '$handoutId' ";
		
		if($result = mysqli_query($conn, $sql)) {
		
			$row = mysqli_fetch_array($result);
			
			$donatedHandoutDetails = array();
			
			$donatedHandoutDetails["handoutId"] = $row["handout_id"];
		
			$donatedHandoutDetails["donatorUsercode"] = $row["donator_usercode"];
		
			$donatedHandoutDetails["courseId"] = $row["course_id"];
		
			$donatedHandoutDetails["departmentId"] = $row["department_id"];
		
			$donatedHandoutDetails["institutionId"] = $row["institution_id"];
		
			$donatedHandoutDetails["name"] = $row["name"];
		
			$donatedHandoutDetails["level"] = $row["level"];
		
			$donatedHandoutDetails["rejectionMessage"] = $row["rejection_message"];
		
			$donatedHandoutDetails["datePosted"] = $row["date_posted"];
		
			$donatedHandoutDetails["timePosted"] = $row["time_posted"];
			
			$donatedHandoutDetails["pagesNumber"] = $row["pages_number"];
			
			$donatedHandoutDetails["status"] = $row["status"];
			
			switch($donatedHandoutDetails["status"]) {
			
				case "building" :
					
					$donatedHandoutDetails["statusComment"] = "Uncompleted";
				
					break;
			
				case "reviewing" :
					
					$donatedHandoutDetails["statusComment"] = "Under review";
				
					break;
			
				case "approved" :
					
					$donatedHandoutDetails["statusComment"] = "Approved";
				
					break;
			
				case "rejected" :
					
					$donatedHandoutDetails["statusComment"] = "Rejected";
				
					break;
			
				default :
					
					$donatedHandoutDetails["statusComment"] = "Unknown";
				
					break;
			
			}
			
			return $donatedHandoutDetails;
	
		}
		
	}
	
	
	function subscriptionDetails($subscriptionId) {
		
		global $conn, $page;
		
		$sql = "SELECT * FROM subscriptions WHERE subscription_id = '$subscriptionId' ";
		
		if($result = mysqli_query($conn, $sql)) {
		
			$row = mysqli_fetch_array($result);
			
			$subscriptionDetails = array();
			
			$subscriptionDetails["subscriptionId"] = $row["subscription_id"];
		
			$subscriptionDetails["subscriberUsercode"] = $row["subscriber_usercode"];
		
			$subscriptionDetails["type"] = $row["type"];
		
			$subscriptionDetails["productId"] = $row["product_id"];
		
			$subscriptionDetails["duration"] = $row["duration"];
		
			$subscriptionDetails["active"] = $row["active"];
		
			$subscriptionDetails["dateSubscribed"] = $row["date_subscribed"];
		
			$subscriptionDetails["timeSubscribed"] = $row["time_subscribed"];
		
			return $subscriptionDetails;
	
		}
		
	}
	
	function dialogueDetails($dialogueId) {
		
		global $conn, $page, $user;
		
		$sql = "SELECT * FROM dialogues WHERE dialogue_id = '$dialogueId' ";
		
		if($result = mysqli_query($conn, $sql)) {
		
			$row = mysqli_fetch_array($result);
			
			$dialogueDetails = array();
			
			$dialogueDetails["dialogueId"] = $row["dialogue_id"];
		
			$dialogueDetails["firstPartnerUsercode"] = $row["first_partner_usercode"];
		
			$dialogueDetails["secondPartnerUsercode"] = $row["second_partner_usercode"];
			
			if($user["account"]["usercode"] == $dialogueDetails["firstPartnerUsercode"]) {
			
			$dialogueDetails["firstPartnerSeen"] = ($row["first_partner_seen"] == "true");
		
			$dialogueDetails["secondPartnerSeen"] = ($row["second_partner_seen"] == "true");
			
				$dialogueDetails["user"]["partner"]["usercode"] = $dialogueDetails["secondPartnerUsercode"];
			
			}
			
			else {
			
				$dialogueDetails["user"]["partner"]["usercode"] = $dialogueDetails["firstPartnerUsercode"];
			
			}
			
			$sql = "SELECT * FROM messages WHERE chat_id = '$dialogueId' ORDER BY date_sent, time_sent, id ";
		
			if($result = mysqli_query($conn, $sql)) {
				
				$dialogueDetails["messages"]["ids"] = array();
		
				while($row = mysqli_fetch_array($result)) {
				
					$dialogueDetails["messages"]["ids"][] = $row["message_id"];
				
				}
			
			}
		
			return $dialogueDetails;
	
		}
		
	}
	 
	
	function messageDetails($messageId) {
		
		global $conn, $page;
		
		$sql = "SELECT * FROM messages WHERE message_id = '$messageId' ";
		
		if($result = mysqli_query($conn, $sql)) {
		
			$row = mysqli_fetch_array($result);
			
			$messageDetails = array();
			
			$messageDetails["messageId"] = $row["message_id"];
		
			$messageDetails["chatId"] = $row["chat_id"];
		
			$messageDetails["text"] = $row["text"];
			
			$messageDetails["senderUsercode"] = $row["sender_usercode"];
		
			$messageDetails["dateSent"] = $row["date_sent"];
		
			$messageDetails["timeSent"] = $row["time_sent"];
			
			return $messageDetails;
	
		}
		
	}
	 
	
	function funnyWierdQuestionDetails($questionId) {
		
		global $conn, $page;
		
		$sql = "SELECT * FROM funny_wierd_questions WHERE question_id = '$questionId' ";
		
		if($result = mysqli_query($conn, $sql)) {
		
			$row = mysqli_fetch_array($result);
			
			$funnyWierdQuestionDetails = array();
			
			$funnyWierdQuestionDetails["questionId"] = $row["question_id"];
		
			$funnyWierdQuestionDetails["question"] = $row["question"];
		
			$funnyWierdQuestionDetails["datePosted"] = $row["date_posted"];
		
			$funnyWierdQuestionDetails["timePosted"] = $row["time_posted"];
		
			$funnyWierdQuestionDetails["list"] = array();
			
			$sql = "SELECT * FROM replies WHERE topic_id = '" . $funnyWierdQuestionDetails["questionId"] . "' ORDER BY date_posted, time_posted ";
					
			if($result = mysqli_query($conn, $sql)) {
				
				$funnyWierdQuestionDetails["list"]["replies"]["ids"] = array();
		
				while($row = mysqli_fetch_array($result)) {
				
					$funnyWierdQuestionDetails["list"]["replies"]["ids"][] = $row["reply_id"];
				
				}
			
			}
			
		}
		
		return $funnyWierdQuestionDetails;
	
	}
	
	
	function notificationDetails($notificationId) {
		
		global $conn, $page;
		
		$sql = "SELECT * FROM notifications WHERE notification_id = '$notificationId' ";
		
		if($result = mysqli_query($conn, $sql)) {
		
			$row = mysqli_fetch_array($result);
			
			$notificationDetails = array();
			
			$notificationDetails["notificationId"] = $row["notification_id"];
		
			$notificationDetails["receiverUsercode"] = $row["receiver_usercode"];
		
			$notificationDetails["imageSrc"] = str_replace("../", "", $row["image_src"]);
		
			$notificationDetails["text"] = $row["text"];
		
			$notificationDetails["link"] = $row["link"];
		
			$notificationDetails["seen"] = ($row["seen"] == "true");
		
			$notificationDetails["viewed"] = ($row["viewed"] == "true");
		
			$notificationDetails["dateSent"] = $row["date_sent"];
		
			$notificationDetails["timeSent"] = $row["time_sent"];
		
			return $notificationDetails;
	
		}
		
	}
	

	function icon($name, $type = "svg") {
		
		global $page;
	
		switch($type) {
		
			case "svg" :
			
				return file_get_contents($page["rootPath"] . "icons/" . $name . ".svg");
				
				break;
				
			case "image" :
			
				return file_get_contents($page["rootPath"] . "icons/" . $name . ".jpg");
				
				break;
				
			default :
			
				return file_get_contents($page["rootPath"] . "icons/" . $name . ".svg");
				
				
		}
	
	}
	
	function randomDigits($length) {
	
		$digits = "";						
						
		for($i = 0; $i < $length; $i++) {
						
			$digits .= rand(0, 9);
						
		}
		
		return $digits;
		
	}
					
 ?>