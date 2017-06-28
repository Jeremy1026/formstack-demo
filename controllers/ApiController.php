<?php

	class ApiController {

		private $usersController;

		public function __construct() {
			$this->usersController = new UsersController();
		}

		public function getUsers() {
           echo json_encode($this->usersController->getUsers());
		}

		public function getUserByID() {
           echo json_encode($this->usersController->getUserByID($_POST['id']));
		}

		public function updateUser() {
			$data = $_POST;
			$id = $data['id'];
			$user = array("email"=>$data['email'],
						  "first_name"=>$data['firstName'],
						  "last_name"=>$data['lastName']);
			if ($data['password'] != '') {
				$user["password"] = password_hash($data['password'],PASSWORD_BCRYPT);
			}
			echo json_encode($this->usersController->updateUser($id,$user));
		}

		public function createUser() {
			$data = $_POST;
			$user = array("email"=>$data['email'],
						  "first_name"=>$data['firstName'],
						  "last_name"=>$data['lastName'],
						  "password"=>password_hash($data['password'],PASSWORD_BCRYPT));
			echo json_encode($this->usersController->createUser($user));
		}

		public function deleteUser() {
			echo json_encode($this->usersController->deleteUser($_POST['id']));
		}
	}