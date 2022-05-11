<?php

require_once('class-db-manager.php');
require_once("class-validation-helper.php");
require_once('gateway\class-swimmers-race-gateway.php');
require_once('gateway\class-user-gateway.php');
require_once('gateway\class-squad-gateway.php');

class Add_Swimmer_Squad_Front {

    
    function get_squads($coach_id){

        $squad_gateway  = new Squad_Gateway();
        $squads         = $squad_gateway->get_squads_by_coach($coach_id);

        return $squads;        
    }

}

?>