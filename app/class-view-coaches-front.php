<?php

require_once('class-db-manager.php');
require_once('gateway\class-coach-gateway.php');

class View_Coaches_Front {

    function get_coaches(){

        $coach_gateway = new Coach_Gateway();
        $coaches = $coach_gateway->get_coaches();

        return $coaches;

    }

}

?>