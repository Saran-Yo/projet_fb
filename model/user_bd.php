<?php

	use Facebook\FacebookSession;
	use Facebook\FacebookRedirectLoginHelper;
	use Facebook\FacebookRequest;
	use Facebook\GraphUser;
	use Facebook\FacebookRequestException;

	function userExist($user_profile){
		require("./model/db_connect.php");
		$userId=$user_profile->getId();
		$stmt = $dbh->prepare("select * from user where facebook_id=:fbId");
      	$stmt->bindParam(':fbId',$userId);
      	$stmt->execute();
      	$result=$stmt->fetch();
      	if (empty($result)){
      		return false;
      	}else
      		return true;
	}


	function saveUser($user_profile){
		require("./model/db_connect.php");
		$userId=$user_profile->getId();
		$userFirstName=$user_profile->getProperty("first_name");
		$userLastName=$user_profile->getProperty("last_name");
		$userEmail=$user_profile->getProperty("email");

		$stmt = $dbh->prepare("INSERT INTO user (facebook_Id,first_name,last_name,email) VALUES (:fbId,:fName,:lName,:email)");
		$stmt->bindParam(':fbId',$userId);
		$stmt->bindParam(':fName',$userFirstName);
		$stmt->bindParam(':lName',$userLastName);
		$stmt->bindParam(':email',$userEmail);
		$stmt->execute();
	}

?>