<?php

	class Question{
		public $possibleAnswers; //array post
		private $startTime;
		private $goodAnswer;

		public function __construct($goodAnswer,$wrongAnswers){
			$this->possibleAnswers=$wrongAnswers;
			$this->possibleAnswers[]=$goodAnswer;
			$this->goodAnswer=$goodAnswer;
			//sort randomly
			shuffle($this->possibleAnswers);
			$this->startTime=time();
		}

		//checks if given post name is correct
		public function wellAnswered($postName){
			return $this->goodAnswer->name==$postName;
		}


		public function __get($property){
			switch($property){
				case 'possibleAnswers':
					return $this->possibleAnswers;
				case 'startTime':
					return $this->startTime;
				case 'goodAnswer':
					return $this->goodAnswer;
			}
		}

	}

?>