<?php

class User{

	public $id;
	public $fbId;
	public $firstName;
	public $lastName;
	public $email;


	public function __get($property){
		switch($property){
			case 'id':
				return $this->id;
			case 'fbId':
				return $this->fbId;
			case 'firstName':
				return $this->firstName;
			case 'lastName':
				return $this->lastName;
			case 'email':
				return $this->email;
		}
	}

	public function __set($property,$newValue){
		switch($property){
			case 'id':
				$this->id=$newValue;
				break;
			case 'fbId':
				$this->fbId=$newValue;
				break;
			case 'firstName':
				$this->firstName=$newValue;
				break;
			case 'lastName':
				$this->lastName=$newValue;
				break;
			case 'email':
				$this->email=$newValue;
				break;
		}
	}

}

?>