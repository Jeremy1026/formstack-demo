<?php

class UsersController
{
    public $users;
    private $table = "Users";
    private $missingKeys = array();

    public function __construct()
    {
        DB::$user = 'my_app';
        DB::$password = 'secret';
        DB::$dbName = 'my_app';
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
        $users = DB::query("SELECT * FROM Users");
        foreach ($users as $user)
        {
            $uModel = new UserModel($user['id'],
                                    $user['email'],
                                    $user['first_name'],
                                    $user['last_name'],
                                    $user['password']);
            $this->users[] = $uModel;
        }
        $this->users = $users;
        return $this->users;  
    }

    /**
      *
      * Get a spcecific user by their ID
      *
      * @author Jeremy Curcio <j.curcio@me.com>
      *
      * @since 1.0
      *
      * @param int  $id The ID of the user to retrieve
      * 
      */
    public function getUserByID($id)
    {
        $users = DB::query("SELECT * FROM Users WHERE `id`=%i",$id);
        foreach ($users as $user)
        {
            $uModel = new UserModel($user['id'],
                                    $user['email'],
                                    $user['first_name'],
                                    $user['last_name'],
                                    $user['password']);
            $this->users[] = $uModel;
        }
        $this->users = $users;
        return $this->users;  
    }


    /**
      *
      * Updates a users information with provided data.
      *
      * @author Jeremy Curcio <j.curcio@me.com>
      *
      * @since 1.0
      *
      * @param int   $id    The ID of the user to retrieve
      * @param array $user  Key=>Value array containing user data
      *       
      */
    public function updateUser($id, $user)
    {
        try
        {
            DB::update($this->table, $user, "id=%i", $id);          
        } catch (Exception $e)
        {
            return array("success"=>false, "error"=>$e);
        }
        return array("success"=>true,"updated"=>$id);
    }

    /**
      *
      * Creates a user with provided data.
      *
      * @author Jeremy Curcio <j.curcio@me.com>
      *
      * @since 1.0
      *
      * @param array $user  Key=>Value array containing user data
      *       
      */
    public function createUser($user)
    {
        if ($this->checkForRequiredKeys($user))
        {
            return array("error"=>"Missing key(s): ".implode(', ', $this->missingKeys));
        }

        DB::insert($this->table, $user);
        return array("success"=>true);
    }

    /**
      *
      * Delete a user based on a specific ID.
      *
      * @author Jeremy Curcio <j.curcio@me.com>
      *
      * @since 1.0
      *
      * @param int  $id     The ID of the user to delete
      * 
      */
    public function deleteUser($id = null)
    {
        if ($id == null)
        {
            try
            {
                $id = $_POST['id'];
            } catch (Exception $e)
            {
                return $e;
            }
        }
        DB::delete($this->table,'`id` = %i',$id);
        return array("success"=>true,"removed"=>$id);
    }

    /**
      *
      * Check against a pre-defined list of keys that are
      * required to successfully create/update a user.
      *
      * @author Jeremy Curcio <j.curcio@me.com>
      *
      * @since 1.0
      *
      * @param array   $user   User data used to verify
      *                        appriate keys exist to 
      *                        properly create/update user
      */
    private function checkForRequiredKeys($user)
    {
        $requiredKeys = array('first_name','last_name','email','password');
        foreach ($requiredKeys as $key)
        {
            if (!array_key_exists($key, $user))
            {
                $this->missingKeys[] = $key;
            }
        }
        if (count($this->missingKeys) != 0)
        {
            return true;
        } else
        {
            return false;
        }
    }
}