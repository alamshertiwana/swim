<?php

require_once('class-db-manager.php');
require_once("class-validation-helper.php");
require_once('gateway\class-race-gateway.php');

class Race_History_Front {

    function get_races($data){

        //The "error" contains error messages. The "pass" is set to true at the end if all validation checks are passed.
        $output = array("error"=> array(), "pass"=>false);

        $pass = true;  //This will returned at the end as part of the $output array it is set to false if any validation fails

        $validation     = new Validation_Helper();

        $data           = $validation->trim_array($data);
        
        $race_gateway = new Race_Gateway();
        $races = $race_gateway->get_races_for_search($data);

        return $races;
    }    

}

?>