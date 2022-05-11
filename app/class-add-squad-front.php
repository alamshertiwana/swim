<?php

require_once('class-db-manager.php');
require_once("class-validation-helper.php");
require_once('gateway\class-squad-gateway.php');
require_once('gateway\class-coach-gateway.php');

class Add_Squad_Front {

    function add_squad($data){

        //The "error" contains error messages. The "pass" is set to true at the end if all validation checks are passed.
        $output = array("error"=> array(), "pass"=>false);

        $pass = true;  //This will returned at the end as part of the $output array. It is set to false if any validation fails

        $required       = array("name","coach_id");
        $validation     = new Validation_Helper();

        $data           = $validation->trim_array($data);

        $check_passed   = $validation->keys_in_array($data,$required);
        
        if($check_passed == false){
            array_push($output['error'], 'Please make sure that all required values are filled.');
            $pass = false;
        }

        if($pass){
            $squad_gateway = new Squad_Gateway();
            $squad_gateway->insert_squad($data);
        }

        $output['pass'] = $pass;

        return $output;        

    }

    function get_coaches(){

        $coach_gateway = new Coach_Gateway();
        $coaches = $coach_gateway->get_coaches();

        return $coaches;

    }

}

?>