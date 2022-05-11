<?php

require_once('class-db-manager.php');
require_once("class-validation-helper.php");
require_once('gateway\class-swimmers-race-gateway.php');
require_once('gateway\class-user-gateway.php');

class Add_Race_Entry_Front {

    function add_race_entry($data){
        //The "error" contains error messages. The "pass" is set to true at the end if all validation checks are passed.
        $output = array("error"=> array(), "pass"=>false);

        $pass = true;  //This will returned at the end as part of the $output array it is set to false if any validation fails

        $required       = array("time","adjusted_time","user_id","race_id");
        $validation     = new Validation_Helper();

        $data           = $validation->trim_array($data);

        $check_passed   = $validation->keys_in_array($data,$required);
        
        if($check_passed == false){
            array_push($output['error'], 'Please make sure that all required values are filled.');
            $pass = false;
        }

        $check_passed = $this->check_unique_user_in_race($data);

        if($check_passed == false){
            array_push($output['error'], 'The swimmer has already been added to the race.');
            $pass = false;
        }         
        
        if($pass){
            $swimmers_race_gateway = new Swimmers_Race_Gateway();
            $swimmers_race_gateway->insert_race_entry($data);
        }

        $output['pass'] = $pass;

        return $output;
    }

    function get_users(){

        $users_gateway = new User_Gateway();
        $users = $users_gateway->get_users();

        return $users;

    }
    
    //Function returns true if no other records are found using the same USER ID and RACE ID
    function check_unique_user_in_race($data){

        $swimmers_race_gateway = new Swimmers_Race_Gateway();

        $results = $swimmers_race_gateway->get_result_by_race_and_user($data);

        if( empty($results) )
            return true;
        else 
            return false;
    }    

}

?>