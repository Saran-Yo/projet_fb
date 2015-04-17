<?php
	
	use Facebook\FacebookSession;
	use Facebook\FacebookRedirectLoginHelper;
	use Facebook\FacebookRequest;
	use Facebook\GraphUser;
	use Facebook\FacebookRequestException;

	require_once('./model/Game.php');
	require_once('./model/Post.php');


	function getGame($pageFeedLink,$nbrTotalQuestions,$nbrPossibleAnswers){
		return new Game(getPosts($pageFeedLink),$nbrTotalQuestions,$nbrPossibleAnswers);
	}


	function getPosts($pageFeedLink){
		return convertJsonToPostList(getLinkTypePosts($pageFeedLink));
	}


	//return link type posts
	function getLinkTypePosts($pageFeedLink){
		$graphObjectArray=getPageContents($pageFeedLink);
		$fnFilterLinkTypePost=function($post){ return isset($post->picture) && isset($post->name);};
		return array_filter($graphObjectArray["data"],$fnFilterLinkTypePost);
	}

	function jsonToPost($json){
		$temp=$json->picture;
		return new Post($json->name,$temp);
	}

	//jsonToPost is called for each element of the json Array
	function convertJsonToPostList($json){
		return array_map("jsonToPost", $json);
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

	//to publish score
	function publishResult($user,$linkToShare,$message){
		$request = new FacebookRequest(
  		$_SESSION["session"],
  		'POST',
  		'/me/feed',
  		array (
    		'message' => $message,
    		'link'=>$linkToShare
  		));

  		$response = $request->execute();
		return $response->getGraphObject();
	}



?>