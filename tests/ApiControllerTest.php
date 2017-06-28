<?php

use PHPUnit\Framework\TestCase;

require 'vendor/autoload.php';
include('./controllers/ApiController.php');
include('./controllers/UsersController.php');
include('./models/UserModel.php');

class ApiControllerTest extends TestCase {

	public function testGetUsers() {
		$apiController = new ApiController();
		$users = $apiController->getUsers();
		$this->assertNotEmpty($users);
	}

	public function testGetUserByID() {
		$apiController = new ApiController();
		$users = $apiController->getUsers();
		$_POST['id'] = $users[count($users)-1]['id'];
		$user = $apiController->getUserByID();

		$this->assertNotEmpty($user);
	}

	public function testUpdateUser() {
		$_POST = array('id'         => 7,
					   'email'      => 'j.curcio@me.com',
					   'firstName' => 'Jeremy',
					   'lastName'  => 'Curciooooo',
					   'password'   => 'supersecurepassword');
		$apiController = new ApiController();
		$this->assertTrue($apiController->updateUser());
	}

	public function testCreateUser() {
		$_POST = array('email'      => 'j.curcio@me.com',
					   'firstName' => 'Jeremy',
					   'lastName'  => 'Curciooooo',
					   'password'   => 'supersecurepassword');
		$apiController = new ApiController();
		$this->assertTrue($apiController->createUser());
	}


	public function testFailCreateUser() {
		$_POST = array('email'      => 'j.curcio@me.com',
					   'firstName' => 'Jeremy');
		$apiController = new ApiController();
		$this->assertFalse($apiController->createUser());
	}

	public function testDeleteUser() {
		$apiController = new ApiController();
		$users = $apiController->getUsers();

		$_POST['id'] = $users[count($users)-1]['id'];

		$this->assertTrue($apiController->deleteUser());
	}
	

}