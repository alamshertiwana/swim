<?php

require_once('class-db-manager.php');
require_once("class-validation-helper.php");
require_once('gateway\class-user-gateway.php');

class View_User_Front {

    function get_user_details($user_id){

        $user_gateway = new User_Gateway();
        $users = $user_gateway->get_user_details($user_id);

        return $users;
    }    

}

?>