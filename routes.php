<?php

function call($controller, $action = null) {
    switch($controller) {
        case 'users':
            $controller = new UsersController();
            break;
    }
    if (($action) && ($action != '')) {
        $controller->{ $action }();
    }
}

call($controller, $action);

?>