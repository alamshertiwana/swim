<?php

require_once('class-db-manager.php');
require_once('gateway\class-coach-gateway.php');

class Add_Coach_Front {

    function add_coach($data){

        $coach_gateway = new Coach_Gateway();
        $coach_gateway->insert_coach($data);

    }

}

?>