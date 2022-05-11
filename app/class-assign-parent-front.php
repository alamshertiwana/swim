<?php

require_once('class-db-manager.php');
require_once("class-validation-helper.php");
require_once('gateway\class-swimmers-race-gateway.php');
require_once('gateway\class-user-gateway.php');
require_once('gateway\class-parent-gateway.php');

class Assign_Parent_Front {

    function assign_parent($data){
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

        if($data["parent1_id"] == $data["parent2_id"]){
            array_push($output['error'], 'Parent 1 and Parent 2 cannot be the same');
            $pass = false;
            $output['pass'] = $pass;            
        }        

        $required       = array("parent1_id","parent2_id","user_id");
        $validation     = new Validation_Helper();

        $data           = $validation->trim_array($data);

        $check_passed   = $validation->keys_in_array($data,$required);
        
        if($check_passed == false){
            array_push($output['error'], 'Please make sure that all required values are filled.');
            $pass = false;
        }
        
        if($pass){
            $user_gateway = new User_Gateway();
            $user_gateway->update_parents($data);
        }

        $output['pass'] = $pass;

        return $output;
    }

    function get_parents(){

        $parent_gateway = new Parent_Gateway();
        $parents = $parent_gateway->get_parents();

        return $parents;
    }

    function get_user_details($user_id){

        $user_gateway = new User_Gateway();
        $users = $user_gateway->get_user_details($user_id);

        return $users;
    }    

}

?>