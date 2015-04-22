<?php 

	function home(){
		require('./service/getFBUserService.php');
		$user_profile = getFBUser();
      	//var_dump($user_profile);
		require('./model/user_bd.php');
		//if user doesn't exist then save him
		if(!userExist($user_profile)){
			saveUser($user_profile);
		}
		require("./view/home.php");
	}


	//need minimum 20 posts of type link
	function initGame(){
		$_SESSION["game"]=getGame("/wefound404/feed/?limit=100",10,3);
		nextQuestion();
	}

	function questionToJson($question){
		return '{"picture":"'.$question->goodAnswer->pictureLink.'","answers":['.join(array_map(function($post){return '"'.$post->name.'"';},$question->possibleAnswers), ',').'],"score":'.$_SESSION["game"]->nbrAskedQuestions.'}';
	}


	function getNextQuestion(){
		return $_SESSION["game"]->nextQuestion();
	}


	function nextQuestion(){
		if(isset($_POST["answer"])){
			$response=$_POST["answer"];
			$_SESSION["game"]->answerCurrentQuestion($response);
		}
		
		$nextQuestion=getNextQuestion();
		if($nextQuestion!=null){
			echo questionToJson($nextQuestion);
		}else{
			require('./service/getFBUserService.php');
			$user_profile = getFBUser();
			require('./model/user_bd.php');
			$user=getUser($user_profile);
			require('./model/game_bd.php');
			saveUserScoreBd($user,$_SESSION["game"]->score);
			echo '{"finished":true,"score":'.$_SESSION["game"]->score.'}';
		}
	}

	function publishScore(){
		require('./service/getFBUserService.php');
		$user_profile = getFBUser();

		$userComment="";
		if(isset($_GET["userComment"]))
			$userComment=$_GET["userComment"];

		$linkToShare="www.eira.fr";
		$message=$userComment."--- Score : ".$_SESSION["game"]->score;
		
		return publishResult($user_profile,$linkToShare,$message);
	}

	function getBestScores(){
		require('./model/game_bd.php');
		echo json_encode(getAllBestScores());
	}


	function publishActionStatus(){
		if(userCanPublish())
			echo "true";
		else
			echo "false";
	}

	function userCanPublish(){
		require('./service/getFBUserService.php');
		$permissions=getUserPermissions()->asArray();
		$permissionAccepted=false;
		for($i=0;$i<count($permissions);++$i){
			if($permissions[$i]->permission=="publish_actions"){
				if($permissions[$i]->status=="granted")
					$permissionAccepted=true;
				break;
			}
		}
		return $permissionAccepted;
	}

?>