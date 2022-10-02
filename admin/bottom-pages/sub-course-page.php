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
 
 <h2 id="heading" content="subCourse"></h2>
 
 <p class="hierachy"><label content="mainCourse"></label> > <label content="subCourse"></label></p>
 
 
 <h2 id="heading">Handouts</h2>
 
 <div id="imageHolder"></div>
 
 <script>
 
 	var subCourseId = sessionStorage.getItem("activeHandout");
 	
	loadImages();
				
 	function loadImages() {
 
 	$.ajax({
		url: "scripts/ajax-handler.php",
		type: "post",
		dataType: "JSON",
		data: {
		
			request: "getSubCourseDetails",
			subCourseId: subCourseId
		
		},
		success: function(response) {
	//		alert ( JSON.stringify(response) );
			$("[content=mainCourse]").html(response["mainCourseDetails"]["name"]);
			
			$("[content=subCourse]").html(response["name"]);
			
			$("#imageHolder").html("");
				
			for(var i = 0; i < 3; i++) {
		//		Number(response["pagesNumber"])
				var index = (i + 1);
				
				var imageHolder = '<div class="imageHolder" page="' + index + '"> <img id="image" src="../scripts/php/handout-page.php?sub-course-id=' + response["subCourseId"] + '&page=' + index + '"></img> </div>';
			
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
	
	}
	
	
 </script>
 
 
 