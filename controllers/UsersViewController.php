<?php

class UsersViewController
{

    public $users;

    /**
	  *
	  * Get necessary user information to display
	  * and prepare view for display.
	  *
	  * @author Jeremy Curcio <j.curcio@me.com>
	  *
	  * @since 1.0
	  *
	  */
    public function view()
    {
        $usersController = new UsersController();
        $this->users = $usersController->getUsers();

        $users = $this->users;
        require_once('views/users/home.template.php');
    }
}