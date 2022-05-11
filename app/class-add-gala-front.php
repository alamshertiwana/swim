<?php

require_once('class-db-manager.php');
require_once("class-validation-helper.php");
require_once('gateway\class-gala-gateway.php');

class Add_Gala_Front {

    function add_gala($data){

        //The "error" contains error messages. The "pass" is set to true at the end if all validation checks are passed.
        $output = array("error"=> array(), "pass"=>false);

        $pass = true;  //This will returned at the end as part of the $output array. It is set to false if any validation fails

        $required       = array("name","date");
        $validation     = new Validation_Helper();

        $data           = $validation->trim_array($data);

        $check_passed   = $validation->keys_in_array($data,$required);
        
        if($check_passed == false){
            array_push($output['error'], 'Please make sure that all required values are filled.');
            $pass = false;
        }
        
        if($pass){
            $gala_gateway = new Gala_Gateway();
            $gala_gateway->insert_gala($data);
        }

        $output['pass'] = $pass;

        return $output;

    }

}

?>