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
		$_SESSION["game"]=getGame("/wefound404/feed/?limit=100",20,3);
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
		if($nextQuestion!=null && $_SESSION["game"]->nbrAskedQuestions<=2){
			echo questionToJson($nextQuestion);
		}else
			echo '{"finished":true,"score":'.$_SESSION["game"]->score.'}';
	}

	function publishScore(){
		require('./service/getFBUserService.php');
		$user_profile = getFBUser();

		$userComment="Votre score est : ";
		if(isset($_GET["userComment"]))
			$userComment=$_GET["userComment"];

		$linkToShare="www.eira.fr";
		$message=$userComment."".$_SESSION["game"]->score;
		
		return publishResult($user_profile,$linkToShare,$message);
	}

?>