<?php
	
	date_default_timezone_set("Africa/Lagos");
	
	$app = array(
		"appName" => file_get_contents($page["rootPath"] . "templates/app-name.txt"),
		"currency" => "₦",
		"baseUrl" => "shopperr.ovolisky.com.ng",
		"defaults" => array(
			"images" => array(
				"business" => array(
					"profilePicture" => $page["rootPath"] . "images/defaults/business/profile-picture.jpg"
				)
			),
			"receipts" => array(
				"pagesNumber" => 100
			)
		),
		"dailyLimits" => array(
			"adminInvitations" => 3
		),
		"links" => array(
			"download" => array(
				"googlePlayStore" => "http://play.google.com/store/shopperr"
			)
		)
	);
	
	$cookies = array("account" => array("name" => "shprAccCk", "lifetime" => 30));
	
	$user = array("isSignedIn" => (isset($_COOKIE[$cookies["account"]["name"]])) );
	
 ?>