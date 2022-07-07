<?php
	
 ?>
 
<div class="container">
 
	<h2 id="heading">Our handouts</h2>
	
	<div id="content">
	
		<table class="table" id="tblOurHandouts">
		
			<thead>
			
				<th>S/N</th>
			
				<th>Sub-course</th>
			
				<th>Course</th>
			
				<th>Level</th>
			
				<th>Pages no.</th>
			
				<th>Institution</th>
			
				<th>Dept.</th>
			
				<th>Date posted</th>
			
				<th>Actions</th>
			
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
		
			<button class="button" id="btnAddHandout">Add handout</button>
			
		</div>
	
	</div>
 
</div>

<script>

	$(document).ready(function() {
	
	fillOurHandouts();
	
	function fillOurHandouts() {

	$.ajax({
		url: "scripts/ajax-handler.php",
		type: "post",
		dataType: "JSON",
		data: {
		
			request: "getHandouts"
		
		},
		success: function(response) {
	//		alert ( JSON.stringify(response) );
			
			for(var i = 0; i < response.length; i++) {
			//	alert();
				
				var index = (i + 1);
				
				var handout = response[i];
				
				var row = $('<tr id="' + handout["subCourseId"] + '"></tr>').html('<td>' + index + '</td> <td>' + handout["name"] + '</td> <td>' + handout["course"] + '</td> <td>' + handout["level"] + '</td> <td>' + handout["pagesNumber"] + '</td> <td>' + handout["institution"] + '</td> <td>' + handout["department"] + '</td> <td>' + handout["datePosted"] + ", " + handout["timePosted"] + '</td> <td>a</td>');
				
				$("#tblOurHandouts tbody").append(row);
			
			}
			
				$("#tblOurHandouts tbody tr").click(function () {
					
					sessionStorage.setItem("activeHandout", $(this).attr("id"));
	
					bottomPage.rise("handout-gallery");
						
				});
			
		},
		error: function(response) {
		alert ( JSON.stringify(response) );
		}
	});
	
	}
	
	$("#btnAddHandout").click(function() {
	
		bottomPage.rise("handout-adder");
	
	});

	});
					
</script>