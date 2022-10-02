<?php
	
	$page = array("rootPath" => "../../");
	
	include_once($page["rootPath"] . "scripts/php/general-info.php");
	
	include_once($page["rootPath"] . "scripts/php/methods.php");
	
 ?>
 
 <style>
 	
 </style>
 
 <h2 id="heading" content="mainCourse"></h2>
 
 <p class="hierachy"><label content="mainCourse"></label></p>
 
 
 <h2 id="heading">SubCourses</h2>
 
		<table class="table" id="tblSubCourses">
		
			<thead>
			
				<th>S/N</th>
				
				<th>Sub-course's name</th>
			
				<th>Level type</th>
			
				<th>Level</th>
			
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
		
 <script>
 
 	var mainCourseId = sessionStorage.getItem("activeMainCourse");
 	
	loadImages();
				
 	function loadImages() {
 
 	$.ajax({
		url: "scripts/ajax-handler.php",
		type: "post",
		dataType: "JSON",
		data: {
		
			request: "getMainCourseDetails",
			mainCourseId: mainCourseId
		
		},
		success: function(response) {
		
		alert ( JSON.stringify(response) );
	
			$("[content=mainCourse]").html(response["name"]);
			
			for(var i = 0; i < response["subCourses"]["ids"].length; i++) {
				
 				$.ajax({
					url: "scripts/ajax-handler.php",
					type: "post",
					dataType: "JSON",
					data: {
		
						request: "getSubCourseDetails",
						subCourseId: response["subCourses"]["ids"][i]
		
					},
					success: function(response) {
						
						var subCourse = response;
		alert();
						var row = $('<tr id="' + subCourse["subCourseId"] + '" class="subCourseRow"></tr>').html('<td></td> <td>></td> <td>' + subCourse["name"] + '</td> <td>' + course["levelType"] + '</td> <td>' + subCourse["level"] + '</td> </tr>');
						
					$("#tblSubCourses tbody").append();
					
				}
			
			}
			
	elae {	alert ( JSON.stringify(response) );}
		},
		error: function(response) {
		alert ( JSON.stringify(response) );
		}
	});
	
	}
	
	
 </script>
 
 
 