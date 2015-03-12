<?php 
	use Facebook\FacebookSession;
	use Facebook\FacebookRedirectLoginHelper;
	use Facebook\FacebookRequest;
	use Facebook\GraphUser;
	use Facebook\FacebookRequestException;
	
	function home(){

		$user_profile = (new FacebookRequest($_SESSION["session"], 'GET', '/me'))->execute()->getGraphObject(GraphUser::className());
      	//var_dump($user_profile);

		require('./model/user_bd.php');

		if(!userExist($user_profile)){
			saveUser($user_profile);
		}
		require("./view/home.php");
	}

?>