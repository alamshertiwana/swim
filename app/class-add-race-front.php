<?php

require_once('class-db-manager.php');
require_once("class-validation-helper.php");
require_once('gateway\class-race-gateway.php');

class Add_Race_Front {

    function add_race($data){

        //The "error" contains error messages. The "pass" is set to true at the end if all validation checks are passed.
        $output = array("error"=> array(), "pass"=>false);

        $pass = true;  //This will returned at the end as part of the $output array it is set to false if any validation fails

        $required       = array("name","gender","distance","stroke","gala_id");
        $validation     = new Validation_Helper();

        $data           = $validation->trim_array($data);

        $check_passed   = $validation->keys_in_array($data,$required);
        
        if($check_passed == false){
            array_push($output['error'], 'Please make sure that all required values are filled.');
            $pass = false;
        }
        
        if($pass){
            $race_gateway = new Race_Gateway();
            $race_gateway->insert_race($data);
        }

        $output['pass'] = $pass;

        return $output;

    }

}

?>