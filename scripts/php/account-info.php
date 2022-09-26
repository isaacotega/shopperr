<?php
	
	$date = date("Y m d");
	
	$time = date("H:i");

	if($user["isSignedIn"]) {			
		
		require("connection.php");
			
		$sql = "SELECT * FROM accounts WHERE cookie_code = '" . $_COOKIE[$cookies["account"]["name"]] . "' ";
			
			if($result = mysqli_query($conn, $sql)) {
			
				$row = mysqli_fetch_array($result);

				$user["account"] = array();
				
				$user["account"]["username"] = $row["username"];	
				
				$user["account"]["usercode"] = $row["usercode"];	
			
				$user["account"]["emailAddress"] = $row["email_address"];	
			
				$user["account"]["activeBusiness"]["id"] = $row["active_business_id"];		
				
				$user["account"]["isBusinessActive"] = (!empty($user["account"]["activeBusiness"]["id"]));
				
				$user["account"]["activeBusiness"]["originalProfilePictureSrc"] = $page["rootPath"] . "uploads/images/business/profile-pictures/" . $user["account"]["activeBusiness"]["id"] . ".jpg";		
				
				$user["account"]["activeBusiness"]["profilePictureSrc"] = file_exists($user["account"]["activeBusiness"]["originalProfilePictureSrc"]) ? $user["account"]["activeBusiness"]["originalProfilePictureSrc"] : $app["defaults"]["images"]["business"]["profilePicture"];		
			
				$sql = "SELECT business_name FROM businesses WHERE business_id = '" . $user["account"]["activeBusiness"]["id"] . "' AND active = 'true' ";		
			
				if($result = mysqli_query($conn, $sql)) {
				
					$row = mysqli_fetch_array($result);		
					
					$user["account"]["activeBusiness"]["name"] = $row["business_name"];		
						
				}	
			
				$sql = "SELECT * FROM business_admins WHERE business_id = '" . $user["account"]["activeBusiness"]["id"] . "' AND active = 'true' ";		
			
				if($result = mysqli_query($conn, $sql)) {			
					
					$user["account"]["activeBusiness"]["adminNo"] = mysqli_num_rows($result);		
					
					while($row = mysqli_fetch_array($result)) {
						
						$user["account"]["activeBusiness"]["adminsUsercodes"][] = $row["admin_usercode"];		
						
					}
						
				}		
						
				$sql = "SELECT * FROM business_admins WHERE admin_usercode = '" . $user["account"]["usercode"] . "' AND active = 'true' ";		
					
				if($result = mysqli_query($conn, $sql)) {			
					
					$user["account"]["administeredBusinessesId"] = array();
						
					while($row = mysqli_fetch_array($result)) {			
					
						$user["account"]["administeredBusinessesId"][] = $row["business_id"];			
							
					}		
						
				}		
					
				$sql = "SELECT * FROM admin_invitations WHERE invited_email_address = '" . $user["account"]["emailAddress"] . "' AND accepted = 'false' ";		
					
				if($result = mysqli_query($conn, $sql)) {			
					
					$user["account"]["invitedBusinessesId"] = array();
						
					while($row = mysqli_fetch_array($result)) {			
					
						$user["account"]["invitedBusinessesId"][] = $row["business_id"];			
							
					}		
						
				}
				
				
				$sql = "SELECT * FROM admin_invitations WHERE inviter_usercode = '" . $user["account"]["usercode"] . "' AND date = '$date' AND accepted = 'false' ";
					
				if($result = mysqli_query($conn, $sql)) {			
					
					$user["account"]["exceededDailyLimit"]["adminInvitations"] = ((mysqli_num_rows($result) >= $app["dailyLimits"]["adminInvitations"]) ? true : false);
					
				}		
					
				$sql = "SELECT * FROM admin_invitations WHERE business_id = '" . $user["account"]["activeBusiness"]["id"] . "' AND accepted = 'false' ";
					
				if($result = mysqli_query($conn, $sql)) {			
					
					$user["account"]["activeBusiness"]["invitedAdminsEmailAddresses"] = array();
						
					while($row = mysqli_fetch_array($result)) {
						
						$user["account"]["activeBusiness"]["invitedAdminsEmailAddresses"][] = $row["invited_email_address"];
						
					}
						
				}		
					
			}
				
		
		
			$sql = "SELECT * FROM market_lists WHERE business_id = '" . $user["account"]["activeBusiness"]["id"] . "' ";
			
			if($result = mysqli_query($conn, $sql)) {
				
				$user["account"]["activeBusiness"]["costPrices"] = array();
				
				while($row = mysqli_fetch_array($result)) {
			
					$user["account"]["activeBusiness"]["marketListsIds"][] = $row["list_id"];
					
					$listId = $row["list_id"];
					
					
					$costPriceSql = "SELECT * FROM market_list_items WHERE list_id = '$listId' ";
					
					if($costPriceResult = mysqli_query($conn, $costPriceSql)) {
						
						while($costPriceRow = mysqli_fetch_array($costPriceResult)) {
							
							if($costPriceRow["cost_price"] !== null && !empty($costPriceRow["cost_price"])) {
			
								$user["account"]["activeBusiness"]["costPrices"][] = array("itemId" => $costPriceRow["item_id"], "price" => $costPriceRow["cost_price"], "quantity" => $costPriceRow["quantity"]);
								
							}
						
						}
						
					}
			
				}
						
			}
		
			$sql = "SELECT * FROM active_market_lists WHERE usercode = '" . $user["account"]["usercode"] . "' ORDER BY date_activated, time_activated DESC";
			
			if($result = mysqli_query($conn, $sql)) {
				
				$user["account"]["hasActiveMarketList"] = (mysqli_num_rows($result) !== 0);
				
				$user["account"]["activeMarketLists"]["ids"] = array();
				
				while($row = mysqli_fetch_array($result)) {
				
					$user["account"]["activeMarketLists"]["ids"][] = $row["list_id"];
					
				}
				
			}
		
		
			$sql = "SELECT * FROM goods WHERE business_id = '" . $user["account"]["activeBusiness"]["id"] . "' ";
			
			if($result = mysqli_query($conn, $sql)) {
				
				$user["account"]["activeBusiness"]["goods"]["exists"] = ((mysqli_num_rows($result) == 0) ? false : true);
						
				$user["account"]["activeBusiness"]["goods"]["ids"] = array();
			
				while($row = mysqli_fetch_array($result)) {
			
					$user["account"]["activeBusiness"]["goods"]["ids"][] = $row["good_id"];
			
				}
						
			}
		
			$sql = "SELECT * FROM prices GROUP BY quantity";
			
			if($result = mysqli_query($conn, $sql)) {
				
				$user["account"]["activeBusiness"]["goods"]["quantities"] = array();
			
				while($row = mysqli_fetch_array($result)) {
				
					if(in_array($row["good_id"], $user["account"]["activeBusiness"]["goods"]["ids"])) {
			
						$user["account"]["activeBusiness"]["goods"]["quantities"][] = $row["quantity"];
					
					}
			
				}
						
			}
			
			$sql = "SELECT * FROM credebtors WHERE business_id = '" . $user["account"]["activeBusiness"]["id"] . "' ";
			
			if($result = mysqli_query($conn, $sql)) {
				
				$user["account"]["activeBusiness"]["creditors"]["recordIds"] = array();
				
				$user["account"]["activeBusiness"]["creditors"]["uniqueIds"] = array();
				
				$user["account"]["activeBusiness"]["debtors"]["recordIds"] = array();
				
				$user["account"]["activeBusiness"]["debtors"]["uniqueIds"] = array();
				
				$user["account"]["activeBusiness"]["customers"]["names"] = array();
				
				while($row = mysqli_fetch_array($result)) {
				
					if(!in_array($row["credebtors_name"], $user["account"]["activeBusiness"]["customers"]["names"])) {
				
						$user["account"]["activeBusiness"]["customers"]["names"][] = $row["credebtors_name"];
						
					}
						
					if($row["type"] == "creditors") {
			
						$user["account"]["activeBusiness"]["creditors"]["recordIds"][] = $row["record_id"];
						
						$user["account"]["activeBusiness"]["creditors"]["uniqueIds"][] = $row["unique_id"];
						
					}
						
					else if($row["type"] == "debtors") {
			
						$user["account"]["activeBusiness"]["debtors"]["recordIds"][] = $row["record_id"];
						
						$user["account"]["activeBusiness"]["debtors"]["uniqueIds"][] = $row["unique_id"];
						
					}
					
					else {}
				
				}
				
			}
			
			$sql = "SELECT * FROM receipts WHERE business_id = '" . $user["account"]["activeBusiness"]["id"] . "' ";
			
			if($result = mysqli_query($conn, $sql)) {
				
				$user["account"]["activeBusiness"]["receipts"]["exists"] = ((mysqli_num_rows($result) == 0) ? false : true);
						
				$user["account"]["activeBusiness"]["receipts"]["ids"] = array();
			
				while($row = mysqli_fetch_array($result)) {
			
					$user["account"]["activeBusiness"]["receipts"]["ids"][] = $row["receipt_id"];
			
				}
						
			}
		
			
		
		}
		
 ?>