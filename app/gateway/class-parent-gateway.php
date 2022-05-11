<?php

class Parent_Gateway {

    function insert_parent($data){

        $db = new DB_Manager;
        $conn = $db->get_connection();
        
        // prepare and bind
        $stmt = $conn->prepare("INSERT INTO parent (ID, USERNAME, PASSWORD, FIRST_NAME, LAST_NAME, SEX, DOB, EMAIL, TELEPHONE, ADDRESS, POSTCODE) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
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

    function login($data){
        $db = new DB_Manager;
        $conn = $db->get_connection();
        
        // prepare and bind
        $stmt = $conn->prepare("SELECT * FROM parent WHERE USERNAME = ?");        
        $stmt->bind_param("s", $username);

        // set parameters and execute
        $username = $data['username'];
                
        $stmt->execute();

        $result = $stmt->get_result();
        $parent = $result->fetch_all(MYSQLI_ASSOC);
                
        $stmt->close();
        $conn->close();
        
        return $parent;
    }
    
    function get_parents(){
        $db = new DB_Manager;
        $conn = $db->get_connection();
        
        // prepare and bind
        $stmt = $conn->prepare("SELECT * FROM parent");        
        
        $stmt->execute();

        $result     = $stmt->get_result();
        $parents    = $result->fetch_all(MYSQLI_ASSOC);
                
        $stmt->close();
        $conn->close();
        
        return $parents;
    }
    
    function get_parent_by_username($data){
        $db = new DB_Manager;
        $conn = $db->get_connection();
        
        // prepare and bind
        $stmt = $conn->prepare("SELECT * FROM parent WHERE USERNAME = ?");        
        $stmt->bind_param("s", $username);

        // set parameters and execute
        $username = $data['username'];      
        
        $stmt->execute();

        $result     = $stmt->get_result();
        $parents    = $result->fetch_all(MYSQLI_ASSOC);
                
        $stmt->close();
        $conn->close();
        
        return $parents;
    }     
  
}

?>