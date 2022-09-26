<?php
	
	$page = array("title" => "New Market List", "rootPath" => "../../", "unrestricted" => array("accountHolders", "businessActive") );
	
	include("../../templates/header.php");
	
	require("../../scripts/php/connection.php");
	
	
	if(isset($_POST["submit"])) {
	
		if(!empty($_POST["title"])  ) {
	
			$title = $_POST["title"];
			
			$schedule = array("date" => $_POST["year"] . " " . $_POST["month"] . " " . $_POST["date"], "time" => $_POST["hour"] . ":" . $_POST["minute"]);
	
			$date = date("Y m d");
		
			$time = date("h:i");
		
			$listId = "";						
						
			for($i = 0; $i < 20; $i++) {
						
				$listId .= rand(0, 9);
						
			}
			
			$sql = "INSERT INTO market_lists (list_id, business_id, title, creator_usercode, scheduled_date, scheduled_time, date_created, time_created) VALUES ('$listId', '" . $user["account"]["activeBusiness"]["id"] . "', '$title', '" . $user["account"]["usercode"] . "', '" . $schedule["date"] . "', '" . $schedule["time"] . "', '$date', '$time') ";
				
			if(mysqli_query($conn, $sql)) {
					
				toast("Market list created successfully!");
			
				relocate("../?id=" . $listId);
				
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

  <form method="post" class="form" id="frmNewMarketList" autocomplete="off">
 
 	<br><br>
 
 	<label class="formHeading">Add new market list for <?php echo $user["account"]["activeBusiness"]["name"]; ?></label>
 	
 	<br><br><br><br>
 	
 	<input type="text" name="title" placeholder="Enter a title e.g. Laundary items" class="input" value='<?php echo isset($_POST["title"]) ? htmlspecialchars($_POST["title"]) : "" ?>'>
 
 	<br><br><br><br>
 	
 	<table id="tblSchedule">
 	
 		<tr>
 			
 			<td>
 	
 				<label class="formLabel">Scheduled date</label>
 				
 			</td>
 			
 			<td>
 	
 				<select name="date">
 					
 					<?php
 						
 						$i = 0;
 						
 						while($i < 32) {
 						
 							echo '<option ' . (($i == date("d")) ? "selected" : "") . '>' . $i . '</option>';
 							
 							$i++;
 						
 						}
 						
 					?>
 				
 				</select>
 				
 				<select name="month">
 					
 					<?php
 						
 						$i = 0;
 						
 						while($i < 13) {
 						
 							echo '<option ' . (($i == date("m")) ? "selected" : "") . '>' . $i . '</option>';
 							
 							$i++;
 						
 						}
 						
 					?>
 				
 				</select>
 				
 				<select name="year">
 					
 					<?php
 						
 						$year = date("Y");
 						
 						echo '<option selected>' . $year . '</option>';
 							
 						echo '<option>' . ($year + 1) . '</option>';
 							
 					?>
 				
 				</select>
 				
 			</td>
 			
 		</tr>
 		
 		<tr>
 			
 			<td>
 	
 				<label class="formLabel">Scheduled time</label>
 				
 			</td>
 			
 			<td>
 	
 				<select name="hour">
 					
 					<?php
 						
 						$i = 0;
 						
 						while($i < 25) {
 						
 							echo '<option ' . (($i == date("H")) ? "selected" : "") . '>' . $i . '</option>';
 							
 							$i++;
 						
 						}
 						
 					?>
 				
 				</select>
 				
 				<span id="colon">:</span>
 				
 				<select name="minute">
 					
 					<?php
 						
 						$i = 0;
 						
 						while($i < 60) {
 						
 							echo '<option ' . (($i == date("i")) ? "selected" : "") . '>' . $i . '</option>';
 							
 							$i++;
 						
 						}
 						
 					?>
 				
 				</select>
 				
 			</td>
 			
 		</tr>
 		
 	</table>
 
 	<br><br><br><br>
 	
 	<input type="submit" class="submit" name="submit" value="Create List">
 	
 	<br><br><br><br>
 	
 </form>
 
</div>

<?php

	include("../../templates/footer.php");
	
?>