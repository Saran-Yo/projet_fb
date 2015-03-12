<?php

	function userExist($user_profile){
		$stmt = $dbh->prepare("select * from user where facebook_id=:fbId");
      	$stmt->bindParam(':pFacebookId',$user_profile->getId());
      	$stmt->execute();
      	$result=$stmt->fetch();
      	if (empty($result)){
      		return false;
      	}else
      		return true;
	}


	function saveUser($user_profile){
		$stmt = $dbh->prepare("INSERT INTO user (facebookId,name,mail) VALUES (:pFacebookId,:pName,:pMail)");
		$stmt->bindParam(':pFacebookId',$user_profile->getId());
		$stmt->bindParam(':pName',$user_profile->getProperty("first_name"));
		$stmt->bindParam(':pMail',$user_profile->getProperty("email"));
		$stmt->execute();
	}

?>