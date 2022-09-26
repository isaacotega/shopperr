<?php
	
	session_start();
	
	$page = array("title" => "New Market List", "rootPath" => "../../", "unrestricted" => array("accountHolders", "businessActive") );
	
	include("../../templates/header.php");
	
	require("../../scripts/php/connection.php");
	
	
	if(isset($_POST["submit"])) {
	
		if(!empty($_POST["title"])  ) {
	
			$title = $_POST["title"];
			
			$schedule = array("date" => $_POST["date"] . " " . $_POST["month"] . " " . $_POST["year"], "time" => $_POST["hour"] . ":" . $_POST["minute"]);
	
			$date = date("Y m d");
		
			$time = date("h:i");
		
			$listId = "";						
						
			for($i = 0; $i < 20; $i++) {
						
				$listId .= rand(0, 9);
						
			}
			
			$sql = "INSERT INTO market_lists (list_id, business_id, title, creator_usercode, scheduled_date, scheduled_time, date_created, time_created) VALUES ('$listId', '" . $user["account"]["activeBusiness"]["id"] . "', '$title', '" . $user["account"]["usercode"] . "', '" . $schedule["date"] . "', '" . $schedule["time"] . "', '$date', '$time') ";
				
			if(mysqli_query($conn, $sql)) {
					
				toast("Market list created successfully!");
			
				//relocate("../edit");
				
			}
	
		}
		
		else {
		
			toast("Please fill in the details");
		
		}
	
	}
	
?>

<link rel="stylesheet" type="text/css" href="../../styles/account-page.css">

 <link rel="stylesheet" type="text/css" href="../../styles/pages/new-market-list.css">
 
<script src="../../scripts/js/account-page.js"></script>

<div id="main">

</div>

<?php

	include("../../templates/footer.php");
	
?>