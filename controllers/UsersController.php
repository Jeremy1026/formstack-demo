<?php

	class UsersController {

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
			// echo $this->createUser($user);


		}

        public function view() {
            $this->getUsers();

            $users = $this->users;
            require_once('views/users/home.template.php');
        }

		public function getUsers() {
			$users = DB::query("SELECT * FROM Users");
			foreach ($users as $user) {
				// print_r($user);
				$uModel = new UserModel($user['id'], $user['email'], $user['first_name'], $user['last_name'],$user['password']);
				$this->users[] = $uModel;
			}
			$this->users = $users;			
		}

		public function updateUser($id, $user) {
			DB::update($this->table, $user, "id=%i", $id);
		}

		public function createUser($user) {
			if ($this->checkForRequiredKeys($user)) {
				return "ERROR: Missing key(s): ".implode(', ', $this->missingKeys);
			}

			DB::insert($this->table, $user);
		}

		public function deleteUser($id) {
			DB::delete($this->table,'`id` = %i',$id);
		}

		private function checkForRequiredKeys($user) {
			$requiredKeys = array('first_name','last_name','email','password');
			foreach ($requiredKeys as $key) {
				if (!array_key_exists($key, $user)) {
					$this->missingKeys[] = $key;
				}
			}
			if (count($this->missingKeys) != 0) {
				return true;
			}
			else {
				return false;
			}
		}

//		public function 
	}