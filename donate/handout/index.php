<?php
	
	$page = array("rootPath" => "../../", "title" => "Home - Donate material", "restriction" => array("account"), "buttonLine" => array("exists" => false), "footer" => array("exists" => false));
	
	
	include_once($page["rootPath"] . "scripts/php/general-info.php");
	
	include_once($page["rootPath"] . "scripts/php/functions.php");
	
	include_once($page["rootPath"] . "scripts/php/methods.php");
	
	require_once($page["rootPath"] . "scripts/php/connection.php");
	
	
	include_once($page["rootPath"] . "templates/header.php");
	
?>

<style>

	.heading {
		font-size: 40px;
	
	}
	
	#donateNewButton {
		padding: 2cm 3cm;
		border-radius: 5px;
		font-size: 35px;
	}
	
	.handoutBox {
		width: 94%;
		padding: 2%;
		margin: 1%;
		box-shadow: 0 0 8px 0 black;
		color: black;
	}
	
	.handoutBox #name {
		font-size: 30px;
		display: block;
		margin: 5mm 0;
	}
	
	.handoutBox #detailsHolder {
		font-size: 20px;
		display: block;
		text-align: right;
	}
	
	.handoutBox #detailsHolder label {
		margin: 0 2mm;
	}

</style>

<h2 class="heading">Your Handout Donations</h2>

<div id="handoutsContainer">

	<?php
		
		if(count($website["content"]["donations"]["handouts"]["ids"]) == 0) {
		
			echo '<div class="placeHolder">
	
				<label class="statement">No handouts!</label>
		
			</div>';
		
		}
		
		foreach($website["content"]["donations"]["handouts"]["ids"] as $eachId) {
			
			$handoutDetails = donatedHandoutDetails($eachId);
		
			if($handoutDetails["donatorUsercode"] == $user["account"]["usercode"]) {
			
			echo '<a href="edit?id=' . $handoutDetails["handoutId"] . '">
			
			<div class="handoutBox">
	
				<label id="name">' . $handoutDetails["name"] . '</label>
				
				<div id="detailsHolder">
		
					<label id="status">' . $handoutDetails["statusComment"] . '</label>
					
				</div>
		
			</div>
			
			</a>';
			
			}
		
		}
		
	?>

</div>

<div class="centerHolder">
	
	<a href="policy">

		<button id="donateNewButton">Donate new handouts</button>
		
	</a>
	
</div>

<?php
	
	include($page["rootPath"] . "templates/footer.php");
	
?>