<?php

require_once('class-db-manager.php');
require_once('gateway\class-gala-gateway.php');

class View_Gala_Front {

    function get_gala(){

        $gala_gateway = new Gala_Gateway();
        $galas = $gala_gateway->get_galas();

        return $galas;

    }

}

?>