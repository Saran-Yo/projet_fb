<?php

	use Facebook\FacebookSession;
	use Facebook\FacebookRedirectLoginHelper;
	use Facebook\FacebookRequest;
	use Facebook\GraphUser;
	use Facebook\FacebookRequestException;

	function userExist($user_profile){
		require("./model/db_connect.php");
		$userId=$user_profile->getId();
		$stmt = $dbh->prepare("select * from utilisateur where fb_id=:fbId");
      	$stmt->bindParam(':fbId',$userId);
      	$stmt->execute();
      	$result=$stmt->fetch();
      	if (empty($result)){
      		return false;
      	}else
      		return true;
	}


	function getUser($user_profile){
		require("./model/db_connect.php");
		$userId=$user_profile->getId();
		$stmt = $dbh->prepare("select * from utilisateur where fb_id=:fbId");
      	$stmt->bindParam(':fbId',$userId);
      	$stmt->execute();
      	$result=$stmt->fetch();
      	if (!empty($result)){
	      	require("./model/User.php");
	      	$user=new User();
	      	$user->id=$result["id"];
	      	$user->fbId=$result["fb_id"];
	      	$user->firstName=$result["first_name"];
	      	$user->lastName=$result["last_name"];
	      	$user->email=$result["email"];

	      	return $user;
	     }
	     
	     return null;
	}


	function saveUser($user_profile){
		require("./model/db_connect.php");
		$userId=$user_profile->getId();
		$userFirstName=$user_profile->getProperty("first_name");
		$userLastName=$user_profile->getProperty("last_name");
		$userEmail=$user_profile->getProperty("email");
		$stmt = $dbh->prepare("INSERT INTO utilisateur (fb_id,first_name,last_name,email) VALUES (:fbId,:fName,:lName,:email)");
		$stmt->bindParam(':fbId',$userId);
		$stmt->bindParam(':fName',$userFirstName);
		$stmt->bindParam(':lName',$userLastName);
		$stmt->bindParam(':email',$userEmail);
		$stmt->execute();
		//var_dump($stmt->errorInfo());
	}

?>