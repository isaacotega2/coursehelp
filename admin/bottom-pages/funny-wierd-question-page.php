<?php
	
	$page = array("rootPath" => "../../");
	
	include_once($page["rootPath"] . "scripts/php/general-info.php");
	
	include_once($page["rootPath"] . "scripts/php/methods.php");
	
 ?>
 
 <h2 id="heading">Funny/Wierd Question</h2>
 
 

 <div id="unDisplayToggled">
 
		<table class="table" id="tblFunnyWierdQuestion">
		
			<thead>
			
				<th>Question</th>
			
				<th>Date posted</th>
				
			</thead>
		
			<tbody>
			
			</tbody>
			
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
 
	 <p class="statement">NOTE: Deleting a qusstion will lead to a loss of all information regarding that question, such as likes and comments. Delete?</p>
		
	<div class="centerHolder">
		
		<button class="button" id="btnDelete">Delete question</button>
			
	</div>
		
</div>
	
 <script>
 
	var questionId = sessionStorage.getItem("activeFunnyWierdQuestion");
		
 	$.ajax({
		url: "scripts/ajax-handler.php",
		type: "post",
		dataType: "JSON",
		data: {
		
			request: "getFunnyWierdQuestionDetails",

			questionId: questionId
		
		},
		success: function(response) {
		
			var row = $('<tr id="' + response["questionId"] + '" class="questionRow"></tr>').html('<td>' + response["question"] + '</td> <td>' + response["datePosted"] + " | " + response["timePosted"] + '</td> </tr>');
						
			$("#tblFunnyWierdQuestion tbody").append(row);
			
		},
		error: function(response) {
		alert ( JSON.stringify(response) );
		}
	});
	
	
	$("#tblActions #edit").click(function() {
	
		bottomPage.rise("funny-wierd-question-editor");
	
	});
	
	$("#tblActions #delete").click(function() {
	
		$("#deleteForumHolder").show(100);
	
		$("#unDisplayToggled").hide(100);
	
	});
	
	$("#deleteForumHolder #btnClose").click(function() {
	
		$("#deleteForumHolder").hide(100);
	
		$("#unDisplayToggled").show(100);
	
	});
	
	$("#btnDelete").click(function() {
	
		$.ajax({
			url: "scripts/ajax-handler.php",
			type: "post",
			dataType: "JSON",
			data: {
				request: "deleteFunnyWierdQuestion",
				questionId: questionId
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
 
 
 