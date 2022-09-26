<?php
	
	$page = array("title" => "", "rootPath" => "../", "unrestricted" => array("accountHolders") );
	
	include_once("../scripts/php/general-info.php");
	
	$page["title"] = "Donate to " . $app["appName"];
	
	include_once("../templates/header.php");
	
 ?>
 
<div id="main">
	
	<p class="statement">Dear valued user, we appreciate your support for our app as well as the positive results it brings to your business.</p>
	
	<p class="statement">We are a group of people committed to helping shop owners all around the globe manage their business records with ease, thus minimizing work load while increasing their productivity. And so we built and keep managing this platform where shop records can be done for free and with ease.</p>
	
	<p class="statement">Please show your appreciation and love for our service by donating to us. Nothing is too small.</p>
	
	<br>
	
	<p class="statement">Account number: 1494944065</p>
	
	<p class="statement">Account name: Isaac Otega</p>
	
	<p class="statement">Bank: Access Bank</p>
	
	<br>
	
	<p class="statement">You are also free to <a href="../feedback">contact us</a> for any feedback. Thank you very much.</p>
		
	<br><br>
		
</div>

<?php

	include("../templates/footer.php");
	
?>