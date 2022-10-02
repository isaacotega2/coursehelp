<?php

	$page = array("rootPath" => "../", "title" => "Admin panel", "restriction" => array("account"));
	
	include_once("../scripts/php/access-restrictor.php");
	
	include_once("../scripts/php/general-info.php");
	
	include_once("../scripts/php/methods.php");
	
	include_once("templates/bottom-page.php");
	
	//	echo json_encode(accountDetails($user["account"]["usercode"]));
	
?>

<!DOCTYPE html PUBLIC -//W3C//DTD XHTML 1.0 Strict//EN http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd>

<html lang="en">

	<head>
		
		<script src="<?php echo $page["rootPath"]; ?>scripts/js/JQuery.js"></script>

		<script src="scripts/main.js"></script>
		
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	
		<meta name=”robots” content="noindex, nofollow">
		
		<title>Admin panel - <?php echo $website["name"]; ?></title>
		
		<link rel="stylesheet" type="text/css" href="<?php echo $page["rootPath"]; ?>styles/admin.css">

	</head>
	
	<body>
		
		<div id="header">
			
			<label id="heading">Admin panel</label>
		
			<a href="scripts/logout.php">
				
				<label id="lblLogOut">Log out</label>
				
			</a>
		
		</div>
		
		<br><br><br><br><br><br>

<?php
	
	if(!accountDetails($user["account"]["usercode"])["is"]["websiteAdmin"]) {
		
		include_once("pages/login.php");
		
		die();
	
	}
		

?>

		<div id="main"></div>
		
		<div id="footer">
		
		<table>
		
		<tr>
		
			<td class="item" page="general">
				
				<span id="icon">
					
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M20 7.093v-5.093h-3v2.093l3 3zm4 5.907l-12-12-12 12h3v10h7v-5h4v5h7v-10h3zm-5 8h-3v-5h-8v5h-3v-10.26l7-6.912 7 6.99v10.182z"/></svg>
				
				</span>
			
				<span id="text">General</span>
			
			</td>
		
			<td class="item" page="subscriptions">
			
				<span id="icon">
					
					<svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 24 24"><path d="M21.19 7h2.81v15h-21v-5h-2.81v-15h21v5zm1.81 1h-19v13h19v-13zm-9.5 1c3.036 0 5.5 2.464 5.5 5.5s-2.464 5.5-5.5 5.5-5.5-2.464-5.5-5.5 2.464-5.5 5.5-5.5zm0 1c2.484 0 4.5 2.016 4.5 4.5s-2.016 4.5-4.5 4.5-4.5-2.016-4.5-4.5 2.016-4.5 4.5-4.5zm.5 8h-1v-.804c-.767-.16-1.478-.689-1.478-1.704h1.022c0 .591.326.886.978.886.817 0 1.327-.915-.167-1.439-.768-.27-1.68-.676-1.68-1.693 0-.796.573-1.297 1.325-1.448v-.798h1v.806c.704.161 1.313.673 1.313 1.598h-1.018c0-.788-.727-.776-.815-.776-.55 0-.787.291-.787.622 0 .247.134.497.957.768 1.056.344 1.663.845 1.663 1.746 0 .651-.376 1.288-1.313 1.448v.788zm6.19-11v-4h-19v13h1.81v-9h17.19z"/></svg>
				
				</span>
			
				<span id="text">Subscriptions</span>
			
			</td>
		
			<td class="item" page="extra">
			
				<span id="icon">
					
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M23.269 19.743l-11.945-11.945c-.557-.557-.842-1.33-.783-2.115.115-1.485-.395-3.009-1.529-4.146-1.03-1.028-2.376-1.537-3.723-1.537-.507 0-1.015.072-1.505.216l3.17 3.17c.344 1.589-1.959 3.918-3.567 3.567l-3.169-3.17c-.145.492-.218 1-.218 1.509 0 1.347.51 2.691 1.538 3.721 1.135 1.136 2.66 1.645 4.146 1.53.783-.06 1.557.226 2.113.783l11.946 11.944c.468.468 1.102.73 1.763.73 1.368 0 2.494-1.108 2.494-2.494 0-.638-.244-1.276-.731-1.763zm-1.769 2.757c-.553 0-1-.448-1-1s.447-1 1-1c.553 0 1 .448 1 1s-.447 1-1 1zm-7.935-15.289l5.327-5.318c.584-.585 1.348-.878 2.113-.878.764 0 1.529.292 2.113.878.589.587.882 1.357.882 2.125 0 .764-.291 1.528-.873 2.11l-5.326 5.318-4.236-4.235zm-3.53 9.18l-5.227 5.185c-.227.23-.423.488-.574.774l-.301.58-2.1 1.07-.833-.834 1.025-2.146.58-.302c.286-.15.561-.329.79-.558l5.227-5.185 1.413 1.416z"/></svg>
				
				</span>
			
				<span id="text">Extra</span>
			
			</td>
		
			<td class="item" page="donations">
			
				<span id="icon">
					
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M11 24h-9v-12h9v12zm0-18h-11v4h11v-4zm2 18h9v-12h-9v12zm0-18v4h11v-4h-11zm4.369-6c-2.947 0-4.671 3.477-5.369 5h5.345c3.493 0 3.53-5 .024-5zm-.796 3.621h-2.043c.739-1.121 1.439-1.966 2.342-1.966 1.172 0 1.228 1.966-.299 1.966zm-9.918 1.379h5.345c-.698-1.523-2.422-5-5.369-5-3.506 0-3.469 5 .024 5zm.473-3.345c.903 0 1.603.845 2.342 1.966h-2.043c-1.527 0-1.471-1.966-.299-1.966z"/></svg>
				
				</span>
			
				<span id="text">Donations</span>
			
			</td>
		<!--
			<td class="item" page="posts">
			
				<span id="text">Posts</span>
			
			</td>
		-->

		</tr>
		
		</table>
		
		</div>
		
	</body>
	
</html>