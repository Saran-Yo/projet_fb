<?php
	use Facebook\FacebookSession;
	use Facebook\FacebookRedirectLoginHelper;
	use Facebook\FacebookRequest;
	use Facebook\GraphUser;
	use Facebook\FacebookRequestException;

	function getFBUser($userId="me"){
		return (new FacebookRequest($_SESSION["session"], 'GET', '/'.$userId))->execute()->getGraphObject(GraphUser::className());
	}

	function getUserPermissions(){
		$request = new FacebookRequest(
	  		$_SESSION["session"],
	  		'GET',
	  		'/me/permissions'
		);
		$response = $request->execute();
		$graphObject = $response->getGraphObject();
		return $graphObject;
	}

?>