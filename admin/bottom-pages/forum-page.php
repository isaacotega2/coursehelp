<?php
	
	$page = array("rootPath" => "../../");
	
	include_once($page["rootPath"] . "scripts/php/general-info.php");
	
	include_once($page["rootPath"] . "scripts/php/methods.php");
	
 ?>
 
 <h2 id="heading" content="name"></h2>
 

 <div id="unDisplayToggled">
 
		<table class="table" id="tblForum">
		
			<thead>
			
				<th>Forum's name</th>
			
				<th>Members No.</th>
			
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
		
		
 
 <h2 class="subHeading">Members</h2>
 
		<table class="table" id="tblMembers">
		
			<thead>
			
				<th>S/N</th>
			
				<th>Member's name</th>
			
				<th>Date joined</th>
			
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
			
					<td id="edit"><?php echo icon("edit"); ?></td>
			
					<td id="delete"><?php echo icon("delete"); ?></td>
					
				</tr>
			
			</tbody>

		</table>
		
	</div>
		
 <div id="deleteForumHolder" style="display: none">
 
	<button class="closeButton" for="inpImageChanger" id="btnClose">X</button>
			
	 <h2 class="subHeading">Delete forum?</h2>
 
	 <p class="statement">NOTE: Deleting a forum will lead to a loss of all information regarding that forum, such as posts, images, and even its link. Delete?</p>
		
	<div class="centerHolder">
		
		<button class="button" id="btnDeleteForum">Delete forum</button>
			
	</div>
		
</div>
	
	<br>
	<script>
	
	var forumId = sessionStorage.getItem("activeForum");
		
 	$.ajax({
		url: "scripts/ajax-handler.php",
		type: "post",
		dataType: "JSON",
		data: {
		
			request: "getForumDetails",

			forumId: forumId
		
		},
		success: function(response) {
		
			$("[content=name]").html(response["name"]);
			
			var row = $('<tr id="' + response["forumId"] + '" class="forumRow"></tr>').html('<td>' + response["name"] + '</td> <td>' + response["members"]["number"] + '</td> </tr>');
						
			$("#tblForum tbody").append(row);
			
			
			var membersDetails = response["membersDetails"];
			
			var membersAccountDetails = response["membersAccountDetails"];
			
			for(var i = 0; i < membersAccountDetails.length; i++) {
				
				var index = (i + 1);
			
				var row = $('<tr id="' + membersAccountDetails["usercode"] + '" class="forumRow"></tr>').html('<td>' + index + '</td> <td>' + membersAccountDetails[i]["nickname"] + '</td> <td>' + (membersDetails[i]["dateJoined"] + " | " + membersDetails[i]["timeJoined"]) + '</td> </tr>');
						
				$("#tblMembers tbody").append(row);
			
			}
					
		},
		error: function(response) {
		alert ( JSON.stringify(response) );
		}
	});
	
	
	$("#tblActions #edit").click(function() {
	
		bottomPage.rise("forum-editor");
	
	});
	
	$("#tblActions #delete").click(function() {
	
		$("#deleteForumHolder").show(100);
	
		$("#unDisplayToggled").hide(100);
	
	});
	
	$("#deleteForumHolder #btnClose").click(function() {
	
		$("#deleteForumHolder").hide(100);
	
		$("#unDisplayToggled").show(100);
	
	});
	
	$("#btnDeleteForum").click(function() {
	
		$.ajax({
			url: "scripts/ajax-handler.php",
			type: "post",
			dataType: "JSON",
			data: {
				request: "deleteForum",
				forumId: forumId
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
 
 
 