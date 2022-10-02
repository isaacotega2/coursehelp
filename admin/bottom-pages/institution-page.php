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
 
 <h2 id="heading" content="name"></h2>
 

 <div id="unDisplayToggled">
 
		<table class="table" id="tblInstitution">
		
			<thead>
			
				<th>Institution's name</th>
			
				<th>Type</th>
			
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
		
 <div id="deleteInstitutionHolder" style="display: none">
 
	<button class="closeButton" for="inpImageChanger" id="btnClose">X</button>
			
	 <h2 class="subHeading">Delete forum?</h2>
 
	 <p class="statement">NOTE: Deleting an institution will lead to a loss of all information regarding that institution. Delete?</p>
		
	<div class="centerHolder">
		
		<button class="button" id="btnDeleteInstitution">Delete Institution</button>
			
	</div>
		
</div>
	
	<br>
	
	<script>
	
	var institutionId = sessionStorage.getItem("activeInstitution");
		
 	$.ajax({
		url: "scripts/ajax-handler.php",
		type: "post",
		dataType: "JSON",
		data: {
		
			request: "getInstitutionDetails",

			institutionId: institutionId
		
		},
		success: function(response) {
		
			$("[content=name]").html(response["name"]);
			
			var row = $('<tr id="' + response["institutionId"] + '" class="institutionRow"></tr>').html('<td>' + response["name"] + '</td> <td>' + response["type"] + '</td> </tr>');
						
			$("#tblInstitution tbody").append(row);
					
		},
		error: function(response) {
		alert ( JSON.stringify(response) );
		}
	});
	
	
	$("#tblActions #edit").click(function() {
	
		bottomPage.rise("institution-editor");
	
	});
	
	$("#tblActions #delete").click(function() {
	
		$("#deleteInstitutionHolder").show(100);
	
		$("#unDisplayToggled").hide(100);
	
	});
	
	$("#deleteInstitutionHolder #btnClose").click(function() {
	
		$("#deleteInstitutionHolder").hide(100);
	
		$("#unDisplayToggled").show(100);
	
	});
	
	$("#btnDeleteInstitution").click(function() {
	
		$.ajax({
			url: "scripts/ajax-handler.php",
			type: "post",
			dataType: "JSON",
			data: {
				request: "deleteInstitution",
				institutionId: institutionId
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
 
 
 