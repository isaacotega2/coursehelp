<?php

	$page = array("rootPath" => "");
	
	
	include_once($page["rootPath"] . "scripts/php/general-info.php");
		
	
	$page["title"] = $website["description"];
	
	include_once($page["rootPath"] . "templates/header.php");
	
?>

<br><br>
       <style>
       
.container {
  background-color: rgb(233, 195, 195);
  height: 280px;
  width: 100%;
}
    h3 {
      display: flex;
      justify-content: center;
      color: rgb(189, 112, 112);
      }

      .com{
        height: 100px;
        width: 66%;
      }
  
       </style>
  </head>
  <body>
  
    <div class="container">
       <div> <h3>Hot New Forum Topics</h3>
       <ul>
       
       	<?php
       		
       		$i = 0;
       	
       		foreach($website["content"]["topics"]["ids"] as $eachId) {
       		
       			echo ('<li> <a href="topic?id=' . $eachId . '">' . topicDetails($eachId)["title"] . '</a>');
       			
       			$i++;
       			
       			if($i >= 10) {
       			
       				break;
       			
       			}
       		
       		}
       	
       	?>
       </ul> 
      </div> </div>
      
      <a href="forum">
      
       <button>View More Forum Topics</button>
       
       </a>
      <hr>
          <div style="height: 450px;" class="container">
            <div> <h3>CourseHelp</h3>
            <h4>View Materials/Handouts for different courses.
              <br>And also upload Materials/Handouts on the website and get paid for every view
            </h4>
            <!-- remember to add images of comments about how good the cousrsehelp forum is here -->
            <img class="com" src="images/pages/homepage/comment1.jpg"> 
            <img class="com" src="images/pages/homepage/comment2.jpg"> 
            <img class="com" src="images/pages/homepage/comment3.jpg"> 
            </div>
          </div>
          
          
      <a href="courses">
      
           <button>View more Materials/Handout</button> <hr>
           
	</a>

           <div style="height: 100px;" class="container">
             <div> <h3>Funny /Weird Questions</h3>
                 <h4>Engage in series of Funny and Weird Questions, see hilarious answers and replies to the weird and funny questions </h4>
             </div>
           </div>
           
           <a href="funny-wierd-questions">
           	
           	<button>View Now</button>
           	
           </a>
           
            <hr><!--
           <div style="height: 150px;" class="container">
             <div> 
              <h3>Questions and Answer Game </h3>
              <h4> Pacticipate in the fun Trivia question and answer thread, to test your knowledge, enhance your 
                memory, and also exercises and boosts your brains capacity.</h4>
             </div>
           </div>
           <button>View Now</button> <hr>
           <div style="height: 150px;" class="container">
             <div>
                <h3>Study Partner/Group</h3>
                <h4>Meet fellow course enthusiast in your school to boost your reading habit,
                  share ideas, solve complex questions and assignment together, make new friends and boost your social network.</h4>
             </div>
           </div>
           <button>Explore Now</button> <hr>
-->
<?php
	
	include($page["rootPath"] . "templates/footer.php");
	
?>