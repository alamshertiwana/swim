<?php

require_once('class-db-manager.php');
require_once('gateway\class-user-gateway.php');

class View_Users_Front {

    function get_users(){

        $users_gateway = new User_Gateway();
        $users = $users_gateway->get_users();

        return $users;

    }

}

?>