$(document).ready(function() {
	
	fillDepartments();

	fillCourses();

	fillInstitutions();
	
	fillForums();
	
	function fillDepartments() {

	$.ajax({
		url: "scripts/ajax-handler.php",
		type: "post",
		dataType: "JSON",
		data: {
		
			request: "getDepartments"
		
		},
		success: function(response) {
//alert ( JSON.stringify(response) );
			
			for(var i = 0; i < response.length; i++) {
			//	alert();
				
				var index = (i + 1);
				
				var department = response[i];
				
				var row = $('<tr id="' + department["departmentId"] + '" class="departmentRow"></tr>').html('<td>' + index + '</td> <td>' + department["name"] + '</td> <td>' + department["courses"]["number"] + '</td> </tr>');
						
				$("#tblDepartments tbody").append(row);
			
			}
			
			$("#tblDepartments tbody .departmentRow").click(function () {
					
				sessionStorage.setItem("activeDepartment", $(this).attr("id"));
	
				bottomPage.rise("department-page");
						
			});
			
		},
		error: function(response) {
		alert ( JSON.stringify(response) );
		}
	});
	
	}
	
	function fillCourses() {

	$.ajax({
		url: "scripts/ajax-handler.php",
		type: "post",
		dataType: "JSON",
		data: {
		
			request: "getCourses"
		
		},
		success: function(response) {
		//	alert ( JSON.stringify(response[0]) );
			
			for(var i = 0; i < response.length; i++) {
			//	alert();
				
				var index = (i + 1);
				
				var course = response[i];
				
				var row = $('<tr id="' + course["courseId"] + '" class="courseRow"></tr>').html('<td>' + index + '</td> <td>' + course["name"] + '</td> <td>' + course["department"]["name"] + '</td> <td>' + course["institution"]["name"] + '</td> <td>' + course["level"] + '</td> <td>' + course["handouts"]["number"] + '</td> <td>' + course["datePosted"] + " | " + course["timePosted"] + '</td> </tr>');
						
				$("#tblCourses tbody").append(row);
				
			}
						
			$("#tblCourses tbody .courseRow").click(function () {
					
				sessionStorage.setItem("activeCourse", $(this).attr("id"));
	
				bottomPage.rise("course-page");
						
			});
			
		},
		error: function(response) {
		alert ( JSON.stringify(response) );
		}
	});
	
	}
	
	function fillInstitutions() {

	$.ajax({
		url: "scripts/ajax-handler.php",
		type: "post",
		dataType: "JSON",
		data: {
		
			request: "getInstitutions"
		
		},
		success: function(response) {
	//		alert ( JSON.stringify(response) );
			
			for(var i = 0; i < response.length; i++) {
			//	alert();
				
				var index = (i + 1);
				
				var institution = response[i];
				
				var row = $('<tr id="' + institution["institutionId"] + '" class="institutionRow"></tr>').html('<td>' + index + '</td> <td>' + institution["name"] + '</td> <td>' + institution["type"] + '</td> </tr>');
						
				$("#tblInstitutions tbody").append(row);
						
			}
			
			$("#tblInstitutions tbody .institutionRow").click(function () {
					
				sessionStorage.setItem("activeInstitution", $(this).attr("id"));
	
				sessionStorage.setItem("institutionAction", "add");
	
				bottomPage.rise("institution-page");
						
			});
			
		},
		error: function(response) {
		alert ( JSON.stringify(response) );
		}
	});
	
	}
	
	function fillForums() {

	$.ajax({
		url: "scripts/ajax-handler.php",
		type: "post",
		dataType: "JSON",
		data: {
		
			request: "getForums"
		
		},
		success: function(response) {
	//		alert ( JSON.stringify(response) );
			
			for(var i = 0; i < response.length; i++) {
			//	alert();
				
				var index = (i + 1);
				
				var forum = response[i];
				
				var row = $('<tr id="' + forum["forumId"] + '" class="forumRow"></tr>').html('<td>' + index + '</td> <td>' + forum["name"] + '</td> <td>' + forum["members"]["number"] + '</td> </tr>');
						
				$("#tblForums tbody").append(row);
						
			}
			
			$("#tblForums tbody .forumRow").click(function () {
					
				sessionStorage.setItem("activeForum", $(this).attr("id"));
	
				bottomPage.rise("forum-page");
						
			});
			
		},
		error: function(response) {
		alert ( JSON.stringify(response) );
		}
	});
	
	}
	
	
	$("#btnAddCourse").click(function() {
	
		bottomPage.rise("course-adder");
	
	});

	$("#btnAddDepartment").click(function() {
	
		bottomPage.rise("department-adder");
	
	});

	$("#btnAddInstitution").click(function() {
	
		bottomPage.rise("institution-adder");
	
	});

	$("#btnAddForum").click(function() {
	
		bottomPage.rise("forum-adder");
	
	});

});
					