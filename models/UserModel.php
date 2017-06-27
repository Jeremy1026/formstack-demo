<?php
	
	class UserModel {

		public $id;
		public $email;
		public $firstName;
		public $lastName;
		public $password;

		public function __construct($id = null, $email = null, $firstName = null, $lastName = null, $password = null) {
			$this->id = $id;
			$this->email = $email;
			$this->firstName = $firstName;
			$this->lastName = $lastName;
			$this->password = $password;
		}

	}