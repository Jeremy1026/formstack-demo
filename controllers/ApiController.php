<?php

final class ApiController
{

    private $usersController;

    public function __construct()
    {
        $this->usersController = new UsersController();
    }
        
    public function getUsers()
    {
        $users = $this->usersController->getUsers();
        echo json_encode($users);
        return $users;
    }

    public function getUserByID()
    {
        $user = $this->usersController->getUserByID($_POST['id']);
        echo json_encode($user);
        return $user;
    }

    public function updateUser()
    {
        $data = $_POST;
        $id = $data['id'];
        $user = array("email"=>$data['email'],
                      "first_name"=>$data['firstName'],
                      "last_name"=>$data['lastName']);
        if ($data['password'] != '')
        {
            $user["password"] = password_hash($data['password'],PASSWORD_BCRYPT);
        }
        $updatedUser = $this->usersController->updateUser($id,$user);
        echo json_encode($updatedUser);
        if ($updatedUser)
        {
            return true;
        } else
        {
            return false;
        }
    }

    public function createUser()
    {
        try
        {
            $data = $_POST;
            $user = array("email"=>$data['email'],
                          "first_name"=>$data['firstName'],
                          "last_name"=>$data['lastName'],
                          "password"=>password_hash($data['password'],PASSWORD_BCRYPT));
            $createdUser = $this->usersController->createUser($user);
            echo json_encode($createdUser);
            if ($createdUser['success'])
            {
                return true;
            } else if ($createdUser['error'])
            {
                return false;
            }   
        } catch (Exception $e)
        {
            return false;
        }
    }

    public function deleteUser()
    {
        try
        {
            $deletedUser = $this->usersController->deleteUser($_POST['id']);
            echo json_encode($deletedUser);
            if ($deletedUser)
            {
                return true;
            } else
            {
                return false;
            }   
        } catch (Exception $e)
        {
            return false;
        }
    }  
}