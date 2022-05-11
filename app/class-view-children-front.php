<?php

require_once('class-db-manager.php');
require_once("class-validation-helper.php");
require_once('gateway\class-user-gateway.php');

class View_Children_Front {

    
    function get_users($parent_id){

        $user_gateway  = new User_Gateway();
        $users         = $user_gateway->get_users_by_parent($parent_id);

        return $users;        
    }

}

?>