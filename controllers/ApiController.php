<?php

	class ApiController {

		private $this->usersController;

		public function __construct() {
			$this->usersController = new UsersController();
		}

		public function deleteUser() {
			$this->usersController->deleteUser($_POST['id']);
			return json_encode(array("result"=>"success"));
		}

	}

?>