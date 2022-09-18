<?php
	
	$page = array("rootPath" => "../../");
	
	include_once($page["rootPath"] . "scripts/php/general-info.php");
	
	include_once($page["rootPath"] . "scripts/php/methods.php");
	
 ?>
 
 <style>
 	
 	#tblActions tbody tr:active {
 		background-color: rgba(0, 0, 0, 0);
 	}
 	
 	#tblActions tbody tr td:active {
 		background-color: rgba(255, 255, 255, 0.05);
 	}
 	
 </style>
 
 <h2 id="heading">Official handout subscription</h2>
 

 <div id="unDisplayToggled">
 
		<table class="table" id="tblSubscription">
		
			<thead>
			
				<th>Handout's name</th>
			
				<th>Handouts's id</th>
			
				<th>Subscriber</th>
			
				<th>Insitution</th>
			
				<th>Department</th>
			
				<th>Course</th>
			
				<th>Date subscribed</th>
			
				<th>Duration (days)</th>
			
				<th>Active</th>
			
			</thead>
		
			<tbody></tbody>
		<!--
			<tfoot>
			
				<th></th>
			
				<th></th>
			
				<th></th>
			
			</tfoot>
		-->
		</table>
		
 <h2 class="subHeading">Actions</h2>
 
		<table class="table" id="tblActions">
		
			<tbody>
				
				<tr>
			
					<td id="activationToggler"></td>
			
					<td id="delete"><?php echo icon("delete"); ?></td>
					
				</tr>
			
			</tbody>

		</table>
		
	</div>
		
 <div id="deleteHolder" style="display: none">
 
	<button class="closeButton" id="btnClose">X</button>
			
	 <h2 class="subHeading">Delete subscription?</h2>
 
	 <p class="statement">NOTE: Deleting a handout subscription will lead to an automatic unsubscription of the user from viewing that handout. Delete?</p>
		
	<div class="centerHolder">
		
		<button class="button" id="btnDeleteSubscription">Delete Subscription</button>
			
	</div>
		
</div>
	
	<br>
	
	<script>
	
	var subscriptionId = sessionStorage.getItem("activeSubscription");
	
	function toggleActivation(icon) {
	
		if(icon == "deactivate") {
			
			$("#activationToggler").html('<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M2 2h20v20h-20z"/></svg>');
		
		}
		
		else if(icon == "activate")	{
			
			$("#activationToggler").html('<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M3 22v-20l18 10-18 10z"/></svg>');
		
		}
		
		else {}
	
	}
		
 	$.ajax({
		url: "scripts/ajax-handler.php",
		type: "post",
		dataType: "JSON",
		data: {
		
			request: "getOfficialHandoutSubscriptionDetails",

			subscriptionId: subscriptionId
		
		},
		success: function(response) {
		
			var row = $('<tr id="' + response["handout"]["handoutId"] + '" class="subscriptionRow"></tr>').html('<td>' + response["handout"]["name"] + '</td> <td>' + response["handout"]["handoutId"] + '</td> <td>' + response["subscriber"]["nickname"] + '</td> <td>' + response["institution"]["name"] + '</td> <td>' + response["course"]["name"] + '</td> <td>' + response["department"]["name"] + '</td> <td>' + response["dateSubscribed"] + " | " + response["timeSubscribed"] + '</td> <td>' + response["duration"] + '</td> <td>' + response["active"] + '</td> </tr>');
						
			$("#bottomPage #tblSubscription tbody").append(row);
			
			toggleActivation( (response["active"] == "true") ? "deactivate" : "activate" );
					
		},
		error: function(response) {
		alert ( JSON.stringify(response) );
		}
	});
	
	
	$("#tblActions #activationToggler").click(function() {
	
 	$.ajax({
		url: "scripts/ajax-handler.php",
		type: "post",
		dataType: "JSON",
		data: {
		
			request: "activateSubscription",

			subscriptionId: subscriptionId
		
		},
		success: function(response) {
		
			toggleActivation( (response["active"] == "true") ? "deactivate" : "activate" );
					
		},
		error: function(response) {
		alert ( JSON.stringify(response) );
		}
	});
	
	});
	
	$("#tblActions #delete").click(function() {
	
		$("#deleteHolder").show(100);
	
		$("#unDisplayToggled").hide(100);
	
	});
	
	$("#deleteHolder #btnClose").click(function() {
	
		$("#deleteHolder").hide(100);
	
		$("#unDisplayToggled").show(100);
	
	});
	
	$("#btnDeleteSubscription").click(function() {
	
		$.ajax({
			url: "scripts/ajax-handler.php",
			type: "post",
			dataType: "JSON",
			data: {
				request: "deleteSubscription",
				subscriptionId: subscriptionId
			},
			success: function(response) {
		
				bottomPage.drop();
					
			},
			error: function(response) {
				alert ( JSON.stringify(response) );
			}
		});
	
	});
	
 </script>
 
 
 