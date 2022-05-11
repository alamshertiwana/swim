<?php

require_once('class-db-manager.php');
require_once('gateway\class-squad-gateway.php');
require_once('gateway\class-coach-gateway.php');

class Add_Squad_Front {

    function add_squad($data){
        /*
        TODO Validation for this function
        */

        $squad_gateway = new Squad_Gateway();
        $squad_gateway->insert_squad($data);

    }

    function get_coaches(){

        $coach_gateway = new Coach_Gateway();
        $coaches = $coach_gateway->get_coaches();

        return $coaches;

    }

}

?>