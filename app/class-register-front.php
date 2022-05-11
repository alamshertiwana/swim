<?php

require_once('class-db-manager.php');
require_once('gateway\class-user-gateway.php');

class Register_Front {

    function register_user($data){

        $user_gateway = new User_Gateway();
        $user_gateway->insert_user($data);
/*
        $db = new DB_Manager;
        $conn = $db->get_connection();
        
        // prepare and bind
        $stmt = $conn->prepare("INSERT INTO users (ID, USERNAME, PASSWORD, FIRST_NAME, LAST_NAME,SEX, DOB, EMAIL, TELEPHONE, ADDRESS, POSTCODE, PARENT1_ID, PARENT2_ID, SQUAD_ID) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NULL, NULL, NULL)");
        $stmt->bind_param("ssssssssss", $username, $password, $first_name, $last_name, $sex, $dob, $email, $telephone, $address, $postcode);
        
        // set parameters and execute
        $username       = $data['username'];
        $password       = $data['password'];
        $first_name     = $data['first_name'];
        $last_name      = $data['last_name'];
        $sex            = $data['sex'];
        $dob            = $data['dob'];
        $email          = $data['email'];
        $telephone      = $data['telephone'];
        $address        = $data['address'];
        $postcode       = $data['postcode'];
        
        $stmt->execute();
                
        $stmt->close();
        $conn->close();        
*/


    }


  
}

?>