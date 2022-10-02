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
 		position: relative;
 	}
 
 	#imageHolder .imageHolder #image {
 		width: 100%;
 		height: 100%;
 	}
 
 	#imageHolder .imageHolder #page {
 		width: 1cm;
 		height: 1cm;
 		background-color: rgba(0, 0, 0, 0.2);
 		line-height: 1cm;
 		padding: 2mm;
 		position: absolute;
 		bottom: 0;
 		right: 0;
 		color: black;
 		font-weight: 700;
 	}
 
 	#imageDisplayHolder #image {
 		width: 96%;
 		box-shadow: 0 0 3mm rgba(255, 255, 255, 0.5);
 		margin: 0 0 0 2%
 	}
 	
 	#imageDisplayHolder #lblImageChanger {
 		display: inline-block;
 		line-height: 2.5cm;
 	}
 
 </style>
 
 <h2 id="heading">Handouts</h2>
 
 <p class="hierachy"><label content="institution"></label> > <label content="department"></label> > courses > <label content="course"></label> > handouts > <label content="handout"></label> > gallery</p>
 
 <div id="imageDisplayHolder" style="display: none">
 
 	<h3 class="subHeading">Page <label id="pageNumber"></label></h3>
 
	<button class="closeButton" for="inpImageChanger" id="btnClose">X</button>
			
 	<img id="image"></img>
 	
 	<br><br>
 	
	<input type="file" id="inpImageChanger" class="hidden">
		
		<div class="centerHolder">
			
			<label class="button" for="inpImageChanger" id="lblImageChanger">Change image</label>
			
		</div>
	
 	
 
 </div>
 
 
 <div id="imageHolder"></div>
 
 <script>
 
 	var handoutId = sessionStorage.getItem("activeHandout");
 	
 	var handoutDetails = {}
 	
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
	
			handoutDetails = response;
			
			$("[content=institution]").html(response["institution"]["name"]);
			
			$("[content=department]").html(response["department"]["name"]);
			
			$("[content=course]").html(response["course"]["name"]);
			
			$("[content=handout]").html(response["name"]);
			
			loadImages();
				
		}
	});
	
	
 	var activePage = "1";
 	
 	function loadImages() {
 
			$("#imageHolder").html("");
				
			for(var i = 0; i < Number(handoutDetails["pagesNumber"]); i++) {
				
				var index = (i + 1);
				
				var imageHolder = '<div class="imageHolder" page="' + index + '"> <img id="image" src="../handout-page?id=' + handoutId + '&page=' + index + '"></img> <span id="page">' + index + '</span> </div>';
			
				$("#imageHolder").append(imageHolder);
				
			}
			
			$("#imageHolder").find(".imageHolder").click(function() {
				
				activePage = $(this).attr("page");
					
				displayImage();
			
			});
				
	}
	
	
	$("#imageDisplayHolder #inpImageChanger").change(function() {
		
		if(this.files.length !== 0) {
			
			$("#imageDisplayHolder #lblImageChanger").html("Uploading . . .");
		
			var image = this.files[0];
		
			var data = new FormData();
		
			data.append("image", image);
			
			data.append("request", "changeHandoutImage");
			
			data.append("handoutId", handoutId);
			
			data.append("page", activePage);
			
			$.ajax({
				url: "scripts/ajax-handler.php",
				type: "post",
				dataType: "JSON",
				contentType: false,
				processData: false,
				data: data,
				success: function(response) {
				
					if(response.status == "success") {
					
						$("#imageDisplayHolder #image").attr("src", '../handout-page?id=' + handoutId + '&page=' + activePage);
	
						loadImages();
						
						$("#imageDisplayHolder #lblImageChanger").html("Change image");
		
					}
				
				},
				error: function(response) {
					alert ( JSON.stringify(response) );
				}
			});
	
		}
	
	});
	
	
	$("#imageDisplayHolder #btnClose").click(function() {
	
		$("#imageHolder").show(100);
		
		$("#imageDisplayHolder").hide(100);
	
	});
	
	$(".hierachy #lblSubCourse").click(function() {
	
		bottomPage.rise("sub-course-page");
	
	});
	
	
	function displayImage() {
	
		$("#imageHolder").hide(100);
		
		$("#imageDisplayHolder").show(100);
		
		$("#imageDisplayHolder #pageNumber").html(activePage);
	
		$("#imageDisplayHolder #image").attr("src", '../handout-page?id=' + handoutId + '&page=' + activePage);
	
	}
	
 </script>
 
 
 