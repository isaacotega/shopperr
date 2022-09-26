<?php
	
	$page = array("title" => "Welcome", "rootPath" => "../");
	
	include("../templates/header.php");
	
?>

<link rel="stylesheet" type="text/css" href="../styles/welcome.css">

<div id="main">

	<div id="container">
		
		<h1>Welcome to <?php echo $app["appName"]; ?></h1>
	
		<p><?php echo $app["appName"]; ?> is a mobile app used by shop outlets and enterprises to make records of sales and other commercial information.</p>
		
		<br>
		
		<p><a href="../login">Sign in</a> or <a href="../signup">Sign up</a> now to get started.</p>
	
	</div>

</div>

<script>

	$("a").click(function() {
	
		fullLoader();
	
	});
	
</script>

<?php

	include("../templates/footer.php");
	
?>