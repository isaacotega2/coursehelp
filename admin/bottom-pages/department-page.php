<?php
	
	$page = array("rootPath" => "../../");
	
	include_once($page["rootPath"] . "scripts/php/general-info.php");
	
	include_once($page["rootPath"] . "scripts/php/methods.php");
	
 ?>
 
 <style>
 	
 </style>
 
 <h2 id="heading" content="department"></h2>
 
 <p class="hierachy">Departments > <label content="department"></label></p>
 
 
 <h2 id="heading">Courses</h2>
 
 <div id="unDisplayToggled">
 
		<table class="table" id="tblCourses" identifier="courseTable">
		
			<thead>
			
				<th>S/N</th>
				
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
		
 <div id="deleteHolder" style="display: none">
 
	<button class="closeButton" id="btnClose">X</button>
			
	 <h2 class="subHeading">Delete subscription?</h2>
 
	 <p class="statement">NOTE: Deleting a department will lead to loss in all information of that department as well as a malfunction of all courses registered under that department. Delete?</p>
		
	<div class="centerHolder">
		
		<button class="button" id="btnDeleteDepartment">Delete Department</button>
			
	</div>
		
</div>
	
 <script>
 
 	var departmentId = sessionStorage.getItem("activeDepartment");
 	
 	$.ajax({
		url: "scripts/ajax-handler.php",
		type: "post",
		dataType: "JSON",
		data: {
		
			request: "getDepartmentDetails",
			departmentId: departmentId
		
		},
		success: function(response) {
		
		//	alert ( JSON.stringify(response) );
		
			$("[content=department]").html(response["name"]);
			
			for(var i = 0; i < response["courses"]["ids"].length; i++) {
				
 				$.ajax({
					url: "scripts/ajax-handler.php",
					type: "post",
					dataType: "JSON",
					data: {
		
						request: "getCourseDetails",
						courseId: response["courses"]["ids"][i]
		
					},
					success: function(response) {
						
						var index = ($("[identifier=courseTable] tbody tr").length + 1);
				
						var course = response;
					
						var row = $('<tr id="' + course["courseId"] + '" class="courseRow"></tr>').html('<td>' + index + '</td> <td>' + course["name"] + '</td> <td>' + course["level"] + '</td> <td>' + course["handouts"]["number"] + '</td> <td>' + course["datePosted"] + " | " + course["timePosted"] + '</td> </tr>');
						
						$("#bottomPage #tblCourses tbody").append(row);
					
					}
					
				});
			
			}
		
		}
	});
 	
	$("#tblActions #edit").click(function() {
	
		bottomPage.rise("department-editor");
	
	});
	
	$("#tblActions #delete").click(function() {
	
		$("#deleteHolder").show(100);
	
		$("#unDisplayToggled").hide(100);
	
	});
	
	$("#deleteHolder #btnClose").click(function() {
	
		$("#deleteHolder").hide(100);
	
		$("#unDisplayToggled").show(100);
	
	});
	
	$("#btnDeleteDepartment").click(function() {
	
		$.ajax({
			url: "scripts/ajax-handler.php",
			type: "post",
			dataType: "JSON",
			data: {
				request: "deleteDepartment",
				departmentId: departmentId
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
 
 
 