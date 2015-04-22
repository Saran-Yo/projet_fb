<?php
	$appId="";
	$appSecret="";
	$redirectUrl="";
	$permission=array('email','user_birthday,publish_actions');


	if($_SERVER['HTTP_HOST'] == 'localhost'){
		$appId = "680560495385944";
		$appSecret = "31dc15ed3f71d7acdd2e09f5c26b4863";
		$redirectUrl = "http://localhost/projet_fb/";
	}else{
		$appId = "680552975386696";
		$appSecret = "d0569ecbb268d40623df03c75166a5b5";
		$redirectUrl = "https://find404.herokuapp.com/";
	}
?>