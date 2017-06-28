<?php

use PHPUnit\Framework\TestCase;

require_once 'vendor/autoload.php';
include_once('./controllers/ApiController.php');
include_once('./controllers/UsersController.php');
include_once('./models/UserModel.php');

class UsersControllerTest extends TestCase {

	public function testCreateUser() {
		$user = array('email'      => 'j.curcio@me.com',
					   'first_name' => 'Jeremy',
					   'last_name'  => 'Curciooooo',
					   'password'   => 'supersecurepassword');
		$usersController = new UsersController();
		$this->assertTrue($usersController->createUser($user)['success']);
	}

	public function testGetUsers() {
		$usersController = new UsersController();
		$users = $usersController->getUsers();
		$this->assertNotEmpty($users);
	}

	public function testGetUserByID() {
		$usersController = new UsersController();

		$users = $usersController->getUsers();
		$id = $users[count($users)-1]['id'];

		$user = $usersController->getUserByID($id);

		print_r($usersController);

		$this->assertNotEmpty($user);
	}

	public function testUpdateUser() {
		$user = array('email'      => 'j.curcio@me.com',
					  'first_name'  => 'Jeremy',
					  'last_name'   => 'Curciooooo',
					  'password'   => 'supersecurepassword');
		$id = 7;
		$usersController = new UsersController();
		$updateUser = $usersController->updateUser($id, $user);
		$this->assertTrue($updateUser['success']);
	}


	public function testFailCreateUser() {
		$user = array('email'      => 'j.curcio@me.com',
					   'firstName' => 'Jeremy');
		$usersController = new UsersController();
		$this->assertNotEmpty($usersController->createUser($user)['error']);
	}

	public function testDeleteUser() {
		$usersController = new UsersController();
		$users = $usersController->getUsers();

		$id = $users[count($users)-1]['id'];

		$this->assertTrue($usersController->deleteUser($id)['success']);
	}
	

}