<?php

class Coach_Gateway {

    function insert_coach($data){

        $db = new DB_Manager;
        $conn = $db->get_connection();
        
        // prepare and bind
        $stmt = $conn->prepare("INSERT INTO coach (ID, USERNAME, PASSWORD, FIRST_NAME, LAST_NAME, SEX, DOB, EMAIL, TELEPHONE, ADDRESS, POSTCODE) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
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
    }

    function get_coaches(){
        $db = new DB_Manager;
        $conn = $db->get_connection();
        
        // prepare and bind
        $stmt = $conn->prepare("SELECT * FROM coach");        
        
        $stmt->execute();

        $result = $stmt->get_result();
        $coaches = $result->fetch_all(MYSQLI_ASSOC);
                
        $stmt->close();
        $conn->close();
        
        return $coaches;
    }

    function login($data){
        $db = new DB_Manager;
        $conn = $db->get_connection();
        
        // prepare and bind
        $stmt = $conn->prepare("SELECT * FROM coach WHERE USERNAME = ?");        
        $stmt->bind_param("s", $username);

        // set parameters and execute
        $username = $data['username'];
                
        $stmt->execute();

        $result = $stmt->get_result();
        $coache = $result->fetch_all(MYSQLI_ASSOC);
                
        $stmt->close();
        $conn->close();
        
        return $coache;
    }    
  
}

?>