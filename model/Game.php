<?php

	require_once('./model/Question.php');

	class Game{
		private $possiblePosts; //all posts to be questionned
		private $nbrGoodAnswers=0;
		private $currentQuestion;
		private $nbrPossibleAnswers;
		public $nbrAskedQuestions=0;
		private $nbrTotalQuestions;


		public function __construct($possiblePosts,$nbrTotalQuestions,$nbrPossibleAnswers){
			if(count($possiblePosts)<$nbrPossibleAnswers)
				throw new Exception("Erreur : Plus de réponses par question que de publication !");
			$this->possiblePosts=$possiblePosts;
			$this->nbrPossibleAnswers=$nbrPossibleAnswers;
			$this->nbrTotalQuestions=$nbrTotalQuestions;
		} 


		public function __get($property){
			switch($property){
				case 'finished':
					return $this->nbrAskedQuestions>=$this->nbrTotalQuestions;
				case 'score':
					return $this->nbrGoodAnswers;
			}
		}

		public function answerCurrentQuestion($postName){
			if($this->currentQuestion->wellAnswered($postName))
				++$this->nbrGoodAnswers;
			$this->currentQuestion=null;
		}


		public function nextQuestion(){
			if($this->finished)
				return null;

			++$this->nbrAskedQuestions;

			//function that checks if a post if not used yet
			$checkPictureNotUsed=function($post){return !$post->pictureUsed;};
			//for each possible posts, checks whether post is not used and return an array of not used questions 
			$notUsedQuestions= array_filter($this->possiblePosts,$checkPictureNotUsed);
			//choose randomly a post
			$postToDisplay=$notUsedQuestions[array_rand($notUsedQuestions)];

			//for question to ask, checks if its not the question to ask
			$checkIsNotDisplayed=function($post) use ($postToDisplay){ return $post != $postToDisplay;};

			$wrongAnswers=array_filter($this->possiblePosts,$checkIsNotDisplayed);
			//give an array of $possibleAnswers-1 posts
			$otherPosts=array_map(function($i) use ($wrongAnswers){return $wrongAnswers[$i];},array_rand($wrongAnswers,$this->nbrPossibleAnswers-1));

			$postToDisplay->pictureUsed=true;
			$this->currentQuestion=new Question($postToDisplay,$otherPosts);
			
			return $this->currentQuestion;
		}
	}

?>