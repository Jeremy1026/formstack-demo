<?php

	class UsersViewController {

		public $users;

        public function view() {
            $usersController = new UsersController();
            $this->users = $usersController->getUsers();

            $users = $this->users;
            require_once('views/users/home.template.php');
        }
	}