<?php
	
	session_start();
	
	$page = array("title" => "New business", "rootPath" => "../../", "unrestricted" => array("accountHolders") );
	
	include("../../templates/header.php");
	
	require("../../scripts/php/connection.php");
	
	
	if(isset($_POST["submit"])) {
	
		if(!empty($_POST["businessName"])) {
	
			$businessName = $_POST["businessName"];
	
			$date = date("Y m d");
		
			$time = date("h:i");
		
			$businessId = "";						
						
			for($i = 0; $i < 20; $i++) {
						
				$businessId .= rand(0, 9);
						
			}
			
			$sql = "INSERT INTO businesses (business_id, business_name, creator_usercode, active, date_created, time_created) VALUES ('$businessId', '$businessName', '" . $user["account"]["usercode"] . "', 'true', '$date', '$time') ";
			
			mysqli_query($conn, $sql);
			
			$sql = "INSERT INTO business_admins (business_id, admin_usercode, admin_type, active, date_added, time_added) VALUES ('$businessId', '" . $user["account"]["usercode"] . "', '1', 'true', '$date', '$time')";
				
			mysqli_query($conn, $sql);
					
			$sql = "UPDATE accounts SET active_business_id = '$businessId' WHERE usercode = '" . $user["account"]["usercode"] . "' ";
				
			mysqli_query($conn, $sql);
					
			toast("Business, $businessName created successfully!");
			
			relocate("../../home");
	
		}
		
		else {
		
			toast("Please fill in the details");
		
		}
	
	}
	
?>

<link rel="stylesheet" type="text/css" href="../../styles/account-page.css">

<script src="../../scripts/js/account-page.js"></script>

<div id="main">

  <form method="post" class="form" id="frmNewBusiness" autocomplete="off">
 
 	<br><br>
 
 	<label class="formHeading">Register a new business on <?php echo $app["appName"]; ?></label>
 	
 	<br><br><br><br>
 	
 	<input type="text" name="businessName" placeholder="Enter business name" class="input" value='<?php echo isset($_POST["businessName"]) ? htmlspecialchars($_POST["businessName"]) : "" ?>'>
 
 	<br><br><br><br>
 	
 	<input type="submit" class="submit" name="submit" value="Register">
 	
 	<br><br><br><br>
 	
 </form>
 
</div>

<?php

	include("../../templates/footer.php");
	
?>