$(document).ready(function() {
	
	var department, institution, course;

	function loadCourses() {
	
	if(department == undefined || institution == undefined) {
		
		return;
	
	}
	
	$("#newDonationForm").find("#coursesHolder #content").html('<div class="placeholder">Getting courses . . .</div>');
		
	$.ajax({
		url: "../../../scripts/php/donate.php",
		type: "post",
		dataType: "JSON",
		data: {
			request: "getCourses",
			department: department,
			institution: institution
		},
		success: function(response) {
//alert ( JSON.stringify(response) );
			
			$("#newDonationForm").find("#coursesHolder #content").html('');
		
			$("#newDonationForm").find("#submitButton").attr("disabled", "true");
			
			if(response["courses"].length == 0) {
			
				$("#newDonationForm").find("#coursesHolder #content").html('<div class="placeholder">No courses found</div>');
		
			}
			
			for(var i = 0; i < response["courses"].length; i++) {
				
				var course = response["courses"][i];
				
				$("#newDonationForm").find("#coursesHolder #content").append('<input name="course" type="radio" id="chk' + course["courseId"] + '" value="' + course["courseId"] + '"> <label for="chk' + course["courseId"] + '">' + course["name"] + '</label> <br><br>');
			
			}
			
			$("#newDonationForm").find("[name=course]").change(function() {
	
				course = $(this).val();
	
				$("#newDonationForm").find("#submitButton").removeAttr("disabled");
			
			});

		},
		error: function(response) {
		alert ( JSON.stringify(response) );
		}
	});
	
	}

	$("#newDonationForm").find("[id=searchInput]").keyup(function() {
	
		var target = $(this).attr("for");
		
		var searchValue = $(this).val();
		
		for(var i = 0; i < $("[name=" + target + "]").length; i++) {
		
			var text = ($("[name=" + target + "]").eq(i).attr("text"));
			
			if(text.toLowerCase().indexOf(searchValue.toLowerCase()) == -1) {
			
				$("[name=" + target + "]").eq(i).hide();
			
				$("[name=" + target + "] + label").eq(i).hide();
			
			}
			
			else {
			
				$("[name=" + target + "]").eq(i).show();
			
				$("[name=" + target + "] + label").eq(i).show();
			
			}
				
		}
			
				
	});

	$("#newDonationForm").find("[name=department]").change(function() {
	
		department = $(this).val();
		
		loadCourses();
	
	});

	$("#newDonationForm").find("[name=institution]").change(function() {
	
		institution = $(this).val();
		
		loadCourses();
	
	});
	
});