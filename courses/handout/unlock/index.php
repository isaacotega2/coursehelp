<?php
	
	session_start();
	
	$page = array("rootPath" => "../../../", "restriction" => array("account"));
	
	$handoutId = $_GET["id"];
	

	include_once($page["rootPath"] . "scripts/php/methods.php");
	
	include_once($page["rootPath"] . "scripts/php/functions.php");
	
	
    	$handoutDetails = officialHandoutDetails($handoutId);
    	
    	$courseDetails = courseDetails($handoutDetails["courseId"]);
 			
    	$departmentDetails = departmentDetails($courseDetails["departmentId"]);
 			
    	$institutionDetails = institutionDetails($courseDetails["institutionId"]);
 			
  	  
  	  $accountDetails = accountDetails($user["account"]["usercode"]);
    	
     if(in_array($handoutDetails["handoutId"], $accountDetails["subscriptions"]["handout"]["active"]["ids"])) {
     		
     	relocate("../?id=" . $handoutId);
     		
     }
     
     
     $text = 'Hello ' . $accountDetails["nickname"] . ', we notice you would like to subscribe for ' . $courseDetails["name"] . ', in ' . $departmentDetails["name"] . ' in ' . $institutionDetails["name"] . '. Make sure to follow the instructions and pay to the designated account details provided. After which you send us a message, with the following:- 

<br><br>-Depositors name/ account name

<br>- Date of payment

<br>- Amount paid

<br>- name of course subscribe for (course id)

<br>- and a screenshot of your debit alert


<br><br>to us on WhatsApp (text has a link to my WhatsApp) or on email (barnabas_victor@yahoo.com) for confirmation and verification.';
     
	notify($user["account"]["usercode"], "images/subscribe.jpg", "", $text);
     		
 			
	$page["title"] = ("Unlock handout > " . $departmentDetails["name"] . " handout > " . $handoutDetails["name"]);
	
	include_once($page["rootPath"] . "templates/header.php");
	
?>

<style>
	
	table {
		font-size: 30px;
		margin: 1cm 0 1cm 0;
	}

</style>

    <div class="head-div"> <span style="display: flex; justify-content: center;"> Unlock handout - <?php echo $handoutDetails["name"]; ?></span></div>
       <hr>
       
       
    <div class="thread">
    
      <div style="color: grey;">
      
      	Course name: <?php echo $courseDetails["name"]; ?>

		<br>

		Level: <?php echo $courseDetails["level"]; ?> level

		<br>
		
		Posted on: <?php echo $handoutDetails["datePosted"]; ?> | <?php echo $handoutDetails["timePosted"]; ?>
		
		<br> Credit/Source: <?php echo $institutionDetails["name"]; ?>, <?php echo $departmentDetails["name"]; ?> Department</div>
      
      	<hr>
      
     	<div>
     
 		    <b>
 		    	
 		    		<a href="../../?department=<?php echo $departmentDetails["departmentId"]; ?>&action=handouts">
 		    			
 		    			<?php echo $institutionDetails["name"]; ?>
 		    			
 		    		</a>
 		    		
 		    		 >
 		    		 
 		    		<a href="../../">
 		    			
 		    			<?php echo $departmentDetails["name"]; ?>
 		    			
 		    		</a>
 		    		
 		    		 >
 		    		 
 		    		<a href="../../?department=<?php echo $departmentDetails["departmentId"]; ?>&action=handouts&institution=<?php echo $institutionDetails["institutionId"]; ?>">
 		    			
 		    			<?php echo $courseDetails["level"]; ?>
 		    			
 		    		</a>
 		    		
 		    		 >
 		    		 
 		    		<a href="../../?department=<?php echo $departmentDetails["departmentId"]; ?>&action=handouts&institution=<?php echo $institutionDetails["institutionId"]; ?>">
 		    			
 		    			<?php echo $courseDetails["name"]; ?>
 		    			
 		    		</a>
 		    		
 		    		 >
 		    		 
 		    		<a href="../../?department=<?php echo $departmentDetails["departmentId"]; ?>&action=handouts&institution=<?php echo $institutionDetails["institutionId"]; ?>&course=<?php echo $courseDetails["courseId"]; ?>">
 		    			
 		    			<?php echo $handoutDetails["name"]; ?>
 		    			
 		    		</a>
 		    		
 		    		 >
 		    		 
 		    		<a>unlock</a>
 		    		
 		    	</b>
 		    	
     	</div>
     
     </div>
     
    	<p>This handout, <b><?php echo $handoutDetails["name"]; ?></b> of the <?php echo $departmentDetails["name"]; ?> department of <?php echo $institutionDetails["name"]; ?> has been locked as you have not subscribed to view it.</p>
     	
    	<p>To unlock it, kindly pay to the sum of <?php echo $website["constants"]["handoutUnlockPrice"]; ?> to the account details provided below.</p>
    	
    	<table>
    		
    		<tr>
    		
    			<td>Account Number</td>
    			
    			<td><?php echo $website["bankAccounts"]["main"]["number"]; ?></td>
    		
    		</tr>
    	
    		<tr>
    		
    			<td>Account Name</td>
    			
    			<td><?php echo $website["bankAccounts"]["main"]["name"]; ?></td>
    		
    		</tr>
    	
    		<tr>
    		
    			<td>Bank</td>
    			
    			<td><?php echo $website["bankAccounts"]["main"]["bank"]; ?></td>
    		
    		</tr>
    	
    		<tr>
    		
    			<td>Amount</td>
    			
    			<td><?php echo $website["constants"]["handoutUnlockPrice"]; ?></td>
    		
    		</tr>
    	
    		<tr>
    		
    			<td>Product Id</td>
    			
    			<td><?php echo $handoutId; ?></td>
    		
    		</tr>
    	
    	</table>
     	
    	<p>After payment, message us by
    	
    		<a target="_blank" href="mailto:<?php echo $website["email"]["sender"]; ?>?subject=Successful+Payment+for+handout&body=Hello, This is to inform you that I have successfully transferred the sum of <?php echo $website["constants"]["handoutUnlockPrice"]; ?> to you for the subscription to view a handout with the product id: <?php echo $handoutId; ?>. Attached below is a screenshot of the receipt/debit alert. Thanks. ">mail</a>
    		
    	or
    	
    	<a target="_blank" href="https://api.whatsapp.com/send?phone=<?php echo $website["whatsapp"]["sender"]; ?>&text=Successful+Payment+for+handout%0D%0A%0D%0AHello, This is to inform you that I have successfully transferred the sum of <?php echo $website["constants"]["handoutUnlockPrice"]; ?> to you for the subscription to view a handout with the product id: <?php echo $handoutId; ?>. Attached below is a screenshot of the receipt/debit alert. Thanks. ">WhatsApp</a>
    	
    	attached with an evidence of payment such as a screenshot of bank debit alert or receipt to <?php echo $website["email"]["sender"]; ?> along with the product id above and you will be subscribed to view this handout for a period of <?php echo $website["constants"]["handoutUnlockDuration"]; ?> days.</p>
     	
<?php
	
	include($page["rootPath"] . "templates/footer.php");
	
?>