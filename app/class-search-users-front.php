<?php

require_once('class-db-manager.php');
require_once("class-validation-helper.php");
require_once('gateway\class-user-gateway.php');

class Search_Users_Front {

    function get_users(){

        $users_gateway = new User_Gateway();
        $users = $users_gateway->get_users();

        return $users;
    }

    function search_users($data){

        //The "error" contains error messages. The "pass" is set to true at the end if all validation checks are passed.
        $output = array("error"=> array(), "pass"=>false);

        $pass = true;  //This will returned at the end as part of the $output array it is set to false if any validation fails

        $validation     = new Validation_Helper();

        $data           = $validation->trim_array($data);
        
        $users_gateway = new User_Gateway();
        $users = $users_gateway->search_users($data);

        return $users;
    }    

}

?>