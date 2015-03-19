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
		//if user doesn't exist then save him
		if(!userExist($user_profile)){
			saveUser($user_profile);
		}
		if(!isset($_SESSION["allPosts"]))
			$_SESSION["allPosts"]=array();
		if(!isset($_SESSION["askedQuestions"]))
			$_SESSION["askedQuestions"]=array();

		if(!isset($_SESSION["score"]))
			$_SESSION["score"]=0;

		//here we init all link type posts
		storeLinkTypePosts();
		if(count($_SESSION["allPosts"])>0){
			echo count($_SESSION["allPosts"]);
		}
		require("./view/home.php");
	}


	//need minimum 20 posts of type link
	function storeLinkTypePosts(){
		$graphObjectArray=getPageContents("/wefound404/feed/?limit=100");
		$minimumRequiredPosts=20;
		if(count($graphObjectArray["data"]>0)){
			$cptLink=0;
			for($i=0;$i<count($graphObjectArray["data"]);++$i){
				if($graphObjectArray["data"][$i]->type=='link'){
					$_SESSION["allPosts"][$i]=$graphObjectArray["data"][$i];
				}
			}
		}
	}


	//for a given page
	function getPageContents($pageFeedLink){
		$request = new FacebookRequest(
			$_SESSION["session"],
			'GET',
			$pageFeedLink
		);
		$response = $request->execute();
		return  $response->getGraphObject()->asArray();
	}


	//this function returns a random post
	function getRandomPost(){
		$randomNumber=rand(1,count($_SESSION["allPosts"]));
		for($i=0;$i<count($_SESSION["allPosts"]);++$i){
			if($randomNumber==$i)
				return $graphObjectArray["data"][$i];
		}
	}

	//returns an object attributes as array
	function getPostProperties($postObject){
		return var_dump(array_keys(get_object_vars($postObject)));
	}



	function isAlreadyAsked(){
		$found=false;
		for($i=0;$i<count($_SESSION["askedQuestions"]);++$i){
			if($_SESSION["askedQuestions"][$i]->id==$_SESSION["questionToAsk"]->id){
				$found=true;
				break;
			}
		}
		return $found;
	}


	//GET : ask a random question to user;
	function randomQuestion(){
		if(count($_SESSION["askedQuestions"])<20){
			$_SESSION["questionToAsk"]=getRandomPost();
			while(isAlreadyAsked()){
				$_SESSION["questionToAsk"]=getRandomPost();
			}

			//if question to ask then store it
			$_SESSION["startTime"]=getdate();
			$_SESSION["askedQuestions"][]=$_SESSION["questionToAsk"];
		}
	}


?>