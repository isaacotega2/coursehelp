 
     <?php
     	
     	if(isset($page["footer"])) {
     		
     		if($page["footer"]["exists"]) {
     			
     			include($page["rootPath"] . "templates/foot.php");
     			
     		}
     		
     		else {
     		
     		
     		}
     	
    		}
    		
    		else {
    		
     			include($page["rootPath"] . "templates/foot.php");
     			
    		}
    		
    	?>   
    
      </body>
</html>