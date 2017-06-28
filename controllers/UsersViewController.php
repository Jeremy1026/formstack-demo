<?php

	class UsersViewController {

		public $users;
		private $table = "Users";
		private $missingKeys = array();


		public function __construct() {
			
			// $this->getUsers();

   //          $users = $this->users;
			// require_once('views/users/home.template.php');

            // $this->updateUser($uModel->id, array('first_name'=>'J-Bone'));

			// $this->deleteUser(2);

			// $user = array("email"=>"jeremy1026@gmail.com",
			// 			  "first_name"=>"Jeremy",
			// 			  "last_name"=>"Curcio",
			// 			  "password"=>password_hash('123',PASSWORD_BCRYPT));
			// $usersController = new UsersController();
   //          echo json_encode($usersController->createUser($user));


		}

        public function view() {
            $usersController = new UsersController();
            $this->users = $usersController->getUsers();

            $users = $this->users;
            require_once('views/users/home.template.php');
        }
	}