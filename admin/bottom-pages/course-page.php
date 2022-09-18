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
 
 <h2 id="heading" content="course"></h2>
 
 <p class="hierachy"><label content="institution"></label>/<label content="department"></label> dept. > courses > <label content="course"></label></p>
 
 
		<table class="table" id="tblCourse">
		
			<thead>
			
				<th>Name</th>
			
				<th>Level</th>
			
				<th>Handouts number</th>
			
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
		
 
 <h2 id="heading">Handouts</h2>
 
		<table class="table" id="tblHandouts">
		
			<thead>
			
				<th>S/N</th>
				
				<th>Name</th>
			
				<th>Pages number</th>
			
				<th>Date posted</th>
			
				<th>Last updated</th>
			
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
		
		<div class="centerHolder">
		
			<button class="button" id="btnAddHandout">Add a handout</button>
			
		</div>
	
 
 
 
 <!--
 <div id="imageHolder"></div>-->
 
 <script>
 
 	var courseId = sessionStorage.getItem("activeCourse");
 	
	loadImages();
				
 	function loadImages() {
 
 	$.ajax({
		url: "scripts/ajax-handler.php",
		type: "post",
		dataType: "JSON",
		data: {
		
			request: "getCourseDetails",
			courseId: courseId
		
		},
		success: function(response) {
//			alert ( JSON.stringify(response) );
			
			var course = response;
					
			var row = $('<tr id="' + course["courseId"] + '" class="courseRow"></tr>').html('<td>' + course["name"] + '</td> <td>' + course["level"] + '</td> <td>' + course["handouts"]["number"] + '</td> <td>' + course["datePosted"] + " | " + course["timePosted"] + '</td> </tr>');
						
			$("#tblCourse tbody").append(row);
					
					
			$("[content=institution]").html(response["institution"]["name"]);
			
			$("[content=department]").html(response["department"]["name"]);
			
			$("[content=course]").html(response["name"]);
			
			
			for(var i = 0; i < Number(response["handouts"]["number"]); i++) {
			
				var index = (i + 1);
				
				var handoutDetails = response["handoutDetails"][i];
					
				var row = $('<tr id="' + handoutDetails["handoutId"] + '" class="courseRow"></tr>').html('<td>' + index + '</td> <td>' + handoutDetails["name"] + '</td> <td>' + handoutDetails["pagesNumber"] + '</td> <td>' + handoutDetails["datePosted"] + " | " + handoutDetails["timePosted"] + '</td> <td>' + handoutDetails["dateUpdated"] + " | " + handoutDetails["timeUpdated"] + '</td> </tr>');
						
				$("#tblHandouts tbody").append(row);
					
			
			}
			
				$("#tblHandouts tbody .courseRow").click(function() {
					
					sessionStorage.setItem("activeHandout", $(this).attr("id"));
	
					bottomPage.rise("handout-page");
				
				});
						
			/*
			$("#imageHolder").html("");
				
			for(var i = 0; i < 3; i++) {
		//		Number(response["pagesNumber"])
				var index = (i + 1);
				
				var imageHolder = '<div class="imageHolder" page="' + index + '"> <img id="image" src="../scripts/php/handout-page.php?course-id=' + response["subCourseId"] + '&page=' + index + '"></img> </div>';
			
				$("#imageHolder").append(imageHolder);
				
			}
			
			var moreImageHolder = '<div class="imageHolder"> <div id="moreImage">+' + response["pagesNumber"] + '</div> </div>';
			
			$("#imageHolder").append(moreImageHolder);
				
			$("#imageHolder").find("#moreImage").click(function() {
				
				bottomPage.rise("handout-gallery");
			
			});
				*/
		},
		error: function(response) {
		alert ( JSON.stringify(response) );
		}
	});
	
	}
	
	$("#btnAddHandout").click(function() {
	
		bottomPage.rise("handout-adder");
	
	});

	
 </script>
 
 
 