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
 	 
 	 #rejectionForm {
 	 	display: none;
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
		
 		<br><br><br>
 		
 		<form class="form" id="rejectionForm">
 
 			<textarea type="text" name="message" placeholder="Rejection message(s) (Seperate with new lines)" class="textarea"></textarea>
 			
 			<input type="submit" class="submit" value="Reject">
 			
 		</form>
 
 		<br><br><br><br><br><br>
 
 
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
			
				$("#tblActions tbody tr").html('<td id="download">Download</td><td id="approve">Approve</td><td id="save">Save</td><td id="reject">Reject</td>');
			
			}
			
			else if(handout["status"] == "approved") {
			
				$("#tblActions tbody tr").html('<td id="download">Download</td><td id="save">Save to official handout</td>');
			
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
		
						request: "approveHandout",
						handoutId: handoutId
		
					},
					success: function(response) {
					//	alert ( JSON.stringify(response) );
						
						alert("Handout Approved!");
					
						if(response["status"] == "success") {
						
							bottomPage.rise("donated-handout-page");
						
						}
						
					},
					error: function(response) {
	
						alert ( JSON.stringify(response) );
			
					}
				});
			
			});
					
					
					
			$("#tblActions #save").click(function() {
				
				$(this).parents("#tblActions").before('<div id="loader">Loading . . .</div>');
		
 				$.ajax({
					url: "scripts/ajax-handler.php",
					type: "post",
					dataType: "JSON",
					data: {
		
						request: "saveHandout",
						handoutId: handoutId
		
					},
					success: function(response) {
					//	alert ( JSON.stringify(response) );
					
						if(response["status"] == "success") {
						
						alert("Handout Saved as official handout!");
					
						if(response["status"] == "success") {
						
							sessionStorage.setItem("activeHandout", handoutId);
	
							bottomPage.rise("handout-page");
						
						}
						
						}
						
						else if(response["status"] == "error") {
						
							if(response["cause"] == "handoutExists") {
							
								alert("Handout already saved!");
							}
						
						}
						
						else {}
						
					},
					error: function(response) {
	
						alert ( JSON.stringify(response) );
			
					}
				});
			
			});
					
					
			var rejectionForm = $("#rejectionForm");
				
			$("#tblActions #reject").click(function() {
			
				$(rejectionForm).show(100);
			
				$(rejectionForm).children("[name=message]").focus();
			
			});
				
			$(rejectionForm).submit(function() {
			
				$(this).before('<div id="loader">Loading . . .</div>');
		
 				$.ajax({
					url: "scripts/ajax-handler.php",
					type: "post",
					dataType: "JSON",
					data: {
		
						request: "rejectHandout",
						handoutId: handoutId,
						message: $(this).children("[name=message]").val()
		
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
					
			$("#tblActions #download").click(function() {
				
				$(this).parents("#tblActions").before('<div id="loader">Downloading . . .</div>');
		
 				$.ajax({
					url: "scripts/ajax-handler.php",
					type: "post",
					dataType: "JSON",
					data: {
		
						request: "downloadDonatedHandouts",
						handoutId: handoutId
		
					},
					success: function(response) {
					//	alert ( JSON.stringify(response) );
						
						if(response["status"] == "success") {
						
							$("body").append('<iframe class="hidden" src="scripts/handout-downloader.php?id=' + handoutId + '"></iframe>');
						
						//	window.open('scripts/handout-downloader.php?id=' + handoutId);
						
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
 
 
 