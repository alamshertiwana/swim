<?php

require_once('class-db-manager.php');
require_once('gateway\class-swimmers-race-gateway.php');

function date_sort($a, $b) {
    return strtotime($a['ADJUSTED_TIME']) - strtotime($b['ADJUSTED_TIME']);
} 

class View_Race_Result_Front {
   

    function get_race_result($race_id){

        $swimmer_race   = new Swimmers_Race_Gateway();
        $results        = $swimmer_race->get_race_result($race_id);

        usort($results, "date_sort");        

        return $results;

    }

}

?>