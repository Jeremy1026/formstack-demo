<?php

final class ApiController
{

    private $usersController;

    public function __construct()
    {
        $this->usersController = new UsersController();
    }
    
    /**
     *
     * Get list of all users that are currently
     * stored in the database. 
     *
     * @author Jeremy Curcio <j.curcio@me.com>
     *
     * @since 1.0
     *
     */
    public function getUsers()
    {
        $users = $this->usersController->getUsers();
        echo json_encode($users);
        return $users;
    }

    /**
      *
      * Get a spcecific user by their ID. ID to be
      * provided via POST using key 'id'
      *
      * @author Jeremy Curcio <j.curcio@me.com>
      *
      * @since 1.0
      *
      */
    public function getUserByID()
    {
        $user = $this->usersController->getUserByID($_POST['id']);
        echo json_encode($user);
        return $user;
    }

    /**
      *
      * Updates a users information with provided data.
      * Data provided via POST, must include 'id' key. 
      *
      * @author Jeremy Curcio <j.curcio@me.com>
      *
      * @since 1.0
      *
      */
    public function updateUser()
    {
        $data = $_POST;
        if (isNull($data['id'])) {
            return false;
        }
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

    /**
      *
      * Create a new user. User data sent via POST. 
      *
      * @author Jeremy Curcio <j.curcio@me.com>
      *
      * @since 1.0
      *
      */
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

    /**
      *
      * Delete a user based on the ID. ID must be passed with POST
      * using key 'id'.
      *
      * @author Jeremy Curcio <j.curcio@me.com>
      *
      * @since 1.0
      *
      */
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