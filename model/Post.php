<?php

class Post{

	public $name;
	public $pictureLink;
	private $pictureUsed; //boolean



	public function __construct($name,$pictureLink){
		$this->name=$name;
		$this->pictureLink=$pictureLink;
		$this->pictureUsed=false;
	}


	public function __get($property){
		switch($property){
			case 'name':
				return $this->name;
			case 'pictureLink':
				return $this->pictureLink;
			case 'pictureUsed':
				return $this->pictureUsed;
		}
	}

	public function __set($property,$newValue){
		switch($property){
			case 'pictureUsed':
				$this->pictureUsed=$newValue;
				break;
		}
	}

}

?>