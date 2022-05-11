<?php

require_once('class-db-manager.php');
require_once("class-validation-helper.php");
require_once('gateway\class-parent-gateway.php');

class Add_Parent_Front {

    function add_parent($data){

        //The "error" contains error messages. The "pass" is set to true at the end if all validation checks are passed.
        $output = array("error"=> array(), "pass"=>false);

        $pass = true;  //This will returned at the end as part of the $output array it is set to false if any validation fails

        $required       = array("username","password","first_name","last_name","email","sex","dob","telephone","address","postcode");
        $validation     = new Validation_Helper();

        $data           = $validation->trim_array($data);

        $check_passed   = $validation->keys_in_array($data,$required);
        
        if($check_passed == false){
            array_push($output['error'], 'Please make sure that all required values are filled.');
            $pass = false;
        }
        
        $check_passed = $validation->validate_email($data['email']);

        if($pass){
            $parent_gateway = new Parent_Gateway();
            $parent_gateway->insert_parent($data);
        }

        $output['pass'] = $pass;

        return $output;

    }

}

?>