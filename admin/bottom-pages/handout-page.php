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
			
				<th>Pages number</th>
			
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
 
 <script>
 
 	var handoutId = sessionStorage.getItem("activeHandout");
 	
 	$.ajax({
		url: "scripts/ajax-handler.php",
		type: "post",
		dataType: "JSON",
		data: {
		
			request: "getOfficialHandoutDetails",
			handoutId: handoutId
		
		},
		success: function(response) {
	//		alert ( JSON.stringify(response) );
			
			$("[content=institution]").html(response["institution"]["name"]);
			
			$("[content=department]").html(response["department"]["name"]);
			
			$("[content=course]").html(response["course"]["name"]);
			
			$("[content=handout]").html(response["name"]);
			
			var handout = response;
					
			var row = $('<tr id="' + handout["handoutId"] + '" class="handoutRow"></tr>').html('<td>' + handout["name"] + '</td> <td>' + handout["pagesNumber"] + '</td> <td>' + handout["datePosted"] + " | " + handout["timePosted"] + '</td> </tr>');
						
			$("#tblHandout tbody").append(row);
					
					
			for(var i = 0; i < 3; i++) {
		//		Number(response["pagesNumber"])
				var index = (i + 1);
				
				var imageHolder = '<div class="imageHolder" page="' + index + '"> <img id="image" src="../handout-page?id=' + response["handoutId"] + '&page=' + index + '"></img> </div>';
			
				$("#imageHolder").append(imageHolder);
				
			}
			
			var moreImageHolder = '<div class="imageHolder"> <div id="moreImage">+' + response["pagesNumber"] + '</div> </div>';
			
			$("#imageHolder").append(moreImageHolder);
				
			$("#imageHolder").find("#moreImage").click(function() {
				
				bottomPage.rise("handout-gallery");
			
			});
		},
		error: function(response) {
	
			alert ( JSON.stringify(response) );
			
		}
	});
			
			
 </script>
 
 
 