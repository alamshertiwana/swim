<?php

require_once('class-db-manager.php');
require_once("class-validation-helper.php");
require_once('gateway\class-swimmers-race-gateway.php');
require_once('gateway\class-user-gateway.php');
require_once('gateway\class-squad-gateway.php');

class Add_Swimmer_Squad_Front {

    function assign_swimmer_squad($data){
        //The "error" contains error messages. The "pass" is set to true at the end if all validation checks are passed.
        $output = array("error"=> array(), "pass"=>false);

        //If data is null then return immediately as further checks require data in the array
        if($data == null){

            array_push($output['error'], 'Please make sure that all required values are filled.');
            $pass = false;
            $output['pass'] = $pass;
            return $output;            

        }        

        $pass = true;  //This will returned at the end as part of the $output array it is set to false if any validation fails

        $required       = array("squad_id","user_id");
        $validation     = new Validation_Helper();

        $data           = $validation->trim_array($data);

        $check_passed   = $validation->keys_in_array($data,$required);
        
        if($check_passed == false){
            array_push($output['error'], 'Please make sure that all required values are filled.');
            $pass = false;
        }
        
        if($pass){
            $user_gateway = new User_Gateway();
            $user_gateway->update_squad($data);
        }

        $output['pass'] = $pass;

        return $output;
    }

    function get_users(){

        $users_gateway = new User_Gateway();
        $users = $users_gateway->get_users();

        return $users;

    }
    
    function get_squads($coach_id){

        $squad_gateway  = new Squad_Gateway();
        $squads         = $squad_gateway->get_squads_by_coach($coach_id);

        return $squads;        
    }

}

?>