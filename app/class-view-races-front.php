<?php

require_once('class-db-manager.php');
require_once('gateway\class-race-gateway.php');

class View_Races_Front {

    function get_races($gala_id){

        $race_gateway   = new Race_Gateway();
        $races          = $race_gateway->get_races($gala_id);

        return $races;

    }

}

?>