<?php

	class UsersController {
		public $users;
		private $table = "Users";
		private $missingKeys = array();

		public function getUsers() {
			$users = DB::query("SELECT * FROM Users");
			foreach ($users as $user) {
				$uModel = new UserModel($user['id'], $user['email'], $user['first_name'], $user['last_name'],$user['password']);
				$this->users[] = $uModel;
			}
			$this->users = $users;
            return $this->users;	
		}

		public function getUserByID($id) {
			$users = DB::query("SELECT * FROM Users WHERE `id`=%i",$id);
			foreach ($users as $user) {
				$uModel = new UserModel($user['id'], $user['email'], $user['first_name'], $user['last_name'],$user['password']);
				$this->users[] = $uModel;
			}
			$this->users = $users;
            return $this->users;	
		}

		public function updateUser($id, $user) {
			try {
				DB::update($this->table, $user, "id=%i", $id);			
			} catch (Exception $e) {
				return array("success"=>false, "error"=>$e);
			}
            return array("success"=>true,"updated"=>$id);
		}

		public function createUser($user) {
			if ($this->checkForRequiredKeys($user)) {
				return array("error"=>"Missing key(s): ".implode(', ', $this->missingKeys));
			}

			DB::insert($this->table, $user);
            return array("success"=>true);
		}

		public function deleteUser($id = null) {
			if ($id == null) {
				try {
					$id = $_POST['id'];
				} catch (Exception $e) {
					return $e;
				}
			}
			DB::delete($this->table,'`id` = %i',$id);
            return array("success"=>"true","removed"=>$id);
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
	}