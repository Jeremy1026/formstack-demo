<?php

function call($controller, $action = null) {
    switch($controller) {
        case 'users':
            $controller = new UsersViewController();
            break;
        case 'api':
            $controller = new ApiController();
            break;
    }
    if ((!$action) || ($action == '')) {
        $action = 'view';
    }

   $controller->{ $action }();
}

call($controller, $action);

?>