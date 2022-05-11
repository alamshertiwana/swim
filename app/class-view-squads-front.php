<?php

require_once('class-db-manager.php');
require_once('gateway\class-squad-gateway.php');

class View_Squads_Front {

    function get_squads($coach_id){

        $squad_gateway   = new Squad_Gateway();
        $squads          = $squad_gateway->get_squads_by_coach($coach_id);

        return $squads;

    }

}

?>