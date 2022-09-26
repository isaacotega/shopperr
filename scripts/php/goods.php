<?php
	
	$page = array("title" => "", "rootPath" => "../../", "unrestricted" => array("accountHolders") );
	
	include_once("functions.php");
	
	include_once("connection.php");
	
	include_once("general-info.php");
	
	include_once("account-info.php");
	
	isset($_GET["request"]) or die(relocate("../../"));
	
	$request = $_GET["request"];
	
	$date = date("Y m d");
		
	$time = date("h:i");
	
		
	if($request == "goodsInformation") {
	
		$goodId = $_GET["goodId"];
		
		$goodsInformation = array("goodId" => $goodId, "priceObj" => array("prices" => array(), "quantities" => array()), "tags" => array() );
			
		$sql = "SELECT * FROM goods WHERE good_id = '$goodId' ";
		
		if($result = mysqli_query($conn, $sql)) {
		
			$row = mysqli_fetch_array($result);
			
			$goodsInformation["name"] = $row["name"];
		
		}
		
		$sql = "SELECT * FROM prices WHERE good_id = '$goodId' ";
		
		if($result = mysqli_query($conn, $sql)) {
		
			while($row = mysqli_fetch_array($result)) {
			
				$goodsInformation["priceObj"]["prices"][] = $row["price"];
				
				$goodsInformation["priceObj"]["quantities"][] = $row["quantity"];
				
			}
		
		}
		
		$sql = "SELECT * FROM tags WHERE good_id = '$goodId' ";
		
		if($result = mysqli_query($conn, $sql)) {
		
			while($row = mysqli_fetch_array($result)) {
			
				$goodsInformation["tags"][] = $row["tag"];
				
			}
		
		}
		
		echo json_encode($goodsInformation);
	
	}
	
	if($request == "add") {
	
		$newGoodObj = json_decode($_GET["obj"], true);
		
		$goodId = "";						
						
		for($i = 0; $i < 20; $i++) {
						
			$goodId .= rand(0, 9);
						
		}
		
		$businessId = $user["account"]["activeBusiness"]["id"];
		
		$adderUsercode = $user["account"]["usercode"];
		
		$goodName = $newGoodObj["name"];
			
		$sql = "INSERT INTO goods (good_id, business_id, adder_usercode, name, date_added, time_added) VALUES ('$goodId', '$businessId', '$adderUsercode', '$goodName', '$date', '$time' )";
		
		mysqli_query($conn, $sql);
	
		foreach($newGoodObj["pricesArray"] as $eachPriceObj) {
			
			$price = $eachPriceObj["price"];
		
			$quantity = $eachPriceObj["quantity"];
		
			$sql = "INSERT INTO prices (good_id, price, quantity, adder_usercode, date, time) VALUES ('$goodId', '$price', '$quantity', '$adderUsercode', '$date', '$time' )";
		
			mysqli_query($conn, $sql);
		
		//	echo "<br>" . $sql;
			
		}
		
		foreach($newGoodObj["tagsArray"] as $eachTag) {
			
			$sql = "INSERT INTO tags (good_id, tag) VALUES ('$goodId', '$eachTag' )";
		
			mysqli_query($conn, $sql);
		
		}
		
		relocate("../../goods");
		
	}
	
	if($request == "edit") {
	
		$editedGoodObj = json_decode($_GET["obj"], true);
		
		$businessId = $user["account"]["activeBusiness"]["id"];
		
		$adderUsercode = $user["account"]["usercode"];
		
		$goodName = $editedGoodObj["name"];
			
		$goodId = $editedGoodObj["id"];
			
		$sql = "UPDATE goods SET name = '$goodName' WHERE good_id = '$goodId' ";
		
		mysqli_query($conn, $sql);

		$sql = "DELETE FROM prices WHERE good_id = '$goodId' ";
		
		mysqli_query($conn, $sql);

		$sql = "DELETE FROM tags WHERE good_id = '$goodId' ";
		
		mysqli_query($conn, $sql);
	
		foreach($editedGoodObj["pricesArray"] as $eachPriceObj) {
			
			$price = $eachPriceObj["price"];
		
			$quantity = $eachPriceObj["quantity"];
		
			$sql = "INSERT INTO prices (good_id, price, quantity, adder_usercode, date, time) VALUES ('$goodId', '$price', '$quantity', '$adderUsercode', '$date', '$time' )";
		
			mysqli_query($conn, $sql);
		
		//	echo "<br>" . $sql;
			
		}
		
		foreach($editedGoodObj["tagsArray"] as $eachTag) {
			
			$sql = "INSERT INTO tags (good_id, tag) VALUES ('$goodId', '$eachTag' )";
		
			mysqli_query($conn, $sql);
		
		}
		
		relocate("../../goods");
		
	}
	
 ?>