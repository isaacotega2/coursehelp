<?php
	
	$page = array("rootPath" => "../../");
	
	include_once($page["rootPath"] . "scripts/php/general-info.php");
	
	include_once($page["rootPath"] . "scripts/php/methods.php");
	
 ?>
 
 <style>
 	
 	#imageHolder {
 		text-align: center;
 	}
 
 	#imageHolder .imageHolder {
 		width: 8cm;
 		height: 8cm;
 		margin: 1mm;
 		display: inline-block;
 		overflow: scroll;
 	}
 
 	#imageHolder .imageHolder #image {
 		width: 100%;
 		height: 100%;
 	}
 
 	#imageHolder .imageHolder #moreImage {
 		width: 100%;
 		height: 100%;
 		background-color: rgba(0, 0, 0, 0.2);
 		line-height: 8cm;
 		font-size: 40px;
 		font-weight: 700;
 	 }

 
 </style>
 
 <h2 id="heading" content="handout"></h2>
 
 <p class="hierachy"><label content="institution"></label>/<label content="department"></label> dept. > courses > <label content="course"></label> > handouts > <label content="handout"></label> </p>
 
 
		<table class="table" id="tblHandout">
		
			<thead>
			
				<th>Name</th>
			
				<th>Donator</th>
			
				<th>Course</th>
			
				<th>Department</th>
			
				<th>Institution</th>
			
				<th>Pages number</th>
			
				<th>Status</th>
			
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
		
 
 <h2 id="heading">Pages</h2>
 
 <div id="imageHolder"></div>
 
 <br>
 
 <h2 id="heading">Actions</h2>
 
		<table class="table" id="tblActions">
		
			<tbody>
				
				<tr>
					
					<td>Loading . . .</td>
					
				</tr>
			
			</tbody>

		</table>
		
 
 <br>
 
 <script>
 
 	var handoutId = sessionStorage.getItem("activeDonatedHandout");
 	
 	$.ajax({
		url: "scripts/ajax-handler.php",
		type: "post",
		dataType: "JSON",
		data: {
		
			request: "getDonatedHandoutDetails",
			handoutId: handoutId
		
		},
		success: function(response) {
		//	alert ( JSON.stringify(response) );
			
			$("[content=institution]").html(response["institution"]["name"]);
			
			$("[content=department]").html(response["department"]["name"]);
			
			$("[content=course]").html(response["course"]["name"]);
			
			$("[content=handout]").html(response["name"]);
			
			var handout = response;
					
			var row = $('<tr id="' + handout["handoutId"] + '" class="handoutRow"></tr>').html('<td>' + handout["name"] + '</td> <td>' + handout["donator"]["nickname"] + '</td> <td>' + handout["course"]["name"] + '</td> <td>' + handout["department"]["name"] + '</td> <td>' + handout["institution"]["name"] + '</td> <td>' + handout["pagesNumber"] + '</td> <td>' + handout["status"] + '</td> <td>' + handout["datePosted"] + " | " + handout["timePosted"] + '</td> </tr>');
						
			$("#tblHandout tbody").append(row);
			
			if(handout["status"] == "reviewing") {
			
				$("#tblActions tbody tr").html('<td id="approve">Approve and save</td><td id="reject">Reject</td>');
			
			}
			
			else {
			
				$("#tblActions tbody tr").html('<td>No actions!</td>');
			
			}
					
					
			$("#tblActions #approve").click(function() {
				
				$(this).parents("#tblActions").before('<div id="loader">Loading . . .</div>');
		
 				$.ajax({
					url: "scripts/ajax-handler.php",
					type: "post",
					dataType: "JSON",
					data: {
		
						request: "approveAndSaveHandout",
						handoutId: handoutId
		
					},
					success: function(response) {
					//	alert ( JSON.stringify(response) );
						
						alert("Approved and saved as official handout!");
					
						if(response["status"] == "success") {
						
							sessionStorage.setItem("activeHandout", handoutId);
	
							bottomPage.rise("handout-page");
						
						}
						
					},
					error: function(response) {
	
						alert ( JSON.stringify(response) );
			
					}
				});
			
			});
					
					
			$("#tblActions #reject").click(function() {
				
				$(this).parents("#tblActions").before('<div id="loader">Loading . . .</div>');
		
 				$.ajax({
					url: "scripts/ajax-handler.php",
					type: "post",
					dataType: "JSON",
					data: {
		
						request: "rejectHandout",
						handoutId: handoutId
		
					},
					success: function(response) {
					//	alert ( JSON.stringify(response) );
						
						alert("Handout rejected!");
							
						if(response["status"] == "success") {
						
							bottomPage.drop();
						
						}
						
					},
					error: function(response) {
	
						alert ( JSON.stringify(response) );
			
					}
				});
			
			});
					
			for(var i = 0; i < Number(response["pagesNumber"]); i++) {
		
				var index = (i + 1);
				
				var imageHolder = '<div class="imageHolder" page="' + index + '"> <img id="image" src="../handout-page?id=' + response["handoutId"] + '&page=' + index + '"></img> </div>';
			
				$("#imageHolder").append(imageHolder);
				
			}
			
		},
		error: function(response) {
	
			alert ( JSON.stringify(response) );
			
		}
	});
			
			
 </script>
 
 
 