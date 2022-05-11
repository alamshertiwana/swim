<?php

require_once('class-db-manager.php');
require_once("class-validation-helper.php");
require_once('gateway\class-coach-gateway.php');

class Add_Coach_Front {

    function add_coach($data){

        $coach_gateway = new Coach_Gateway();

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
            return $output;
        }
        
        $check_passed = $validation->validate_email($data['email']);

        if($check_passed == false){
            array_push($output['error'], 'Please enter a valid email address.');
            $pass = false;
        }

        $check_passed = $validation->validate_name_length($data['first_name']);

        if($check_passed == false){
            array_push($output['error'], 'The first name cannot be longer than 50 characters.');
            $pass = false;
        }
        
        $check_passed = $validation->validate_name_length($data['last_name']);

        if($check_passed == false){
            array_push($output['error'], 'The last name cannot be longer than 50 characters.');
            $pass = false;
        }
        
        $check_passed = ctype_digit($data['telephone']);

        if($check_passed == false){
            array_push($output['error'], 'The telephone can only contain numbers.');
            $pass = false;
        }
        
        $check_passed = $validation->validate_date($data['dob'],18);

        if($check_passed == false){
            array_push($output['error'], 'The date of birth selected makes the age less than 18 years old.');
            $pass = false;
        }

        $check_passed = $this->check_unique_username($data);

        if($check_passed == false){
            array_push($output['error'], 'The Username is already in use.');
            $pass = false;
        }        

        if($pass){
            $coach_gateway->insert_coach($data);
        }

        $output['pass'] = $pass;

        return $output;
    }

    //Function returns true if no other records are found using the same username
    function check_unique_username($data){

        $coach_gateway = new Coach_Gateway();

        $coaches = $coach_gateway->get_coach_by_username($data);

        if( empty($coaches) )
            return true;
        else 
            return false;
    }    

}

?>