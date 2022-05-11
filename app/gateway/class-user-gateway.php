<?php

class User_Gateway {

    function insert_user($data){

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
    }

    function get_users(){
        $db = new DB_Manager;
        $conn = $db->get_connection();
        
        // prepare and bind
        $stmt = $conn->prepare("SELECT * FROM users");        
        
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
        $stmt = $conn->prepare("SELECT * FROM users WHERE USERNAME = ?");        
        $stmt->bind_param("s", $username);

        // set parameters and execute
        $username = $data['username'];
                
        $stmt->execute();

        $result = $stmt->get_result();
        $user   = $result->fetch_all(MYSQLI_ASSOC);
                
        $stmt->close();
        $conn->close();
        
        return $user;
    }
    
    //The parameter arrays contains the User ID and the Squad ID and then it updates the Squad columns in the Users table for the specfic User ID
    function update_squad($data){

        $db = new DB_Manager;
        $conn = $db->get_connection();
        
        // prepare and bind
        $stmt = $conn->prepare("UPDATE users SET SQUAD_ID = ? WHERE ID = ?");
        $stmt->bind_param("ii", $squad_id, $user_id);
        
        // set parameters and execute
        $squad_id       = $data['squad_id'];
        $user_id        = $data['user_id'];
        
        $stmt->execute();
                
        $stmt->close();
        $conn->close();        
    }
    
    function get_users_in_squad($squad_id){
        $db = new DB_Manager;
        $conn = $db->get_connection();
        
        // prepare and bind
        $stmt = $conn->prepare("SELECT * FROM users WHERE SQUAD_ID = ?");        
        $stmt->bind_param("i", $id);

        // set parameters and execute
        $id = $squad_id;
                
        $stmt->execute();

        $result = $stmt->get_result();
        $coaches = $result->fetch_all(MYSQLI_ASSOC);
                
        $stmt->close();
        $conn->close();
        
        return $coaches;
    }
    
    //The parameter arrays contains the Parent 1 ID and the Parent 2 ID and then it updates the columns in the Users table for the specfic User ID
    function update_parents($data){

        $db = new DB_Manager;
        $conn = $db->get_connection();
        
        // prepare and bind
        $stmt = $conn->prepare("UPDATE users SET PARENT1_ID = ?, PARENT2_ID = ? WHERE ID = ?");
        $stmt->bind_param("iii", $parent1_id, $parent2_id, $user_id);
        
        // set parameters and execute
        $parent1_id     = $data['parent1_id'];
        $parent2_id     = $data['parent2_id'];
        $user_id        = $data['user_id'];
        
        $stmt->execute();
                
        $stmt->close();
        $conn->close();        
    }
    
    function get_user_details($user_id){
        $db = new DB_Manager;
        $conn = $db->get_connection();
        
        // prepare and bind
        $stmt = $conn->prepare("SELECT * FROM users WHERE ID = ?");        
        $stmt->bind_param("i", $id);

        // set parameters and execute
        $id = $user_id;
                
        $stmt->execute();

        $result = $stmt->get_result();
        $coaches = $result->fetch_all(MYSQLI_ASSOC);
                
        $stmt->close();
        $conn->close();
        
        return $coaches;
    }
    
    function get_users_by_parent($parent_id){
        $db = new DB_Manager;
        $conn = $db->get_connection();
        
        // prepare and bind
        $stmt = $conn->prepare("SELECT * FROM users WHERE PARENT1_ID = ? OR PARENT2_ID = ?;");        
        $stmt->bind_param("ii", $p1_id, $p2_id);

        // set parameters and execute
        $p1_id = $parent_id;
        $p2_id = $parent_id;
                
        $stmt->execute();

        $result = $stmt->get_result();
        $coaches = $result->fetch_all(MYSQLI_ASSOC);
                
        $stmt->close();
        $conn->close();
        
        return $coaches;
    }
    
    function update_user($data){

        $db = new DB_Manager;
        $conn = $db->get_connection();
        
        // prepare and bind
        $stmt = $conn->prepare("UPDATE users SET FIRST_NAME = ?, LAST_NAME = ?, EMAIL = ?, DOB = ?, TELEPHONE = ?, ADDRESS = ?, POSTCODE = ? WHERE ID = ?");
        $stmt->bind_param("sssssssi", $first_name, $last_name, $email,$dob, $telephone, $address, $postcode, $user_id);
        
        // set parameters and execute
        $first_name     = $data['first_name'];
        $last_name      = $data['last_name'];
        $email          = $data['email'];
        $dob            = $data['dob'];
        $telephone      = $data['telephone'];
        $address        = $data['address'];
        $postcode       = $data['postcode'];
        $user_id        = $data['user_id'];
        
        $stmt->execute();
                
        $stmt->close();
        $conn->close();        
    }
    
    function search_users($data){
        $db = new DB_Manager;
        $conn = $db->get_connection();
        
        // prepare and bind
        $stmt = $conn->prepare("SELECT * FROM users WHERE ID = ? OR FIRST_NAME LIKE ? OR LAST_NAME LIKE ?;");        
        $stmt->bind_param("iss", $ID, $first_name,$last_name);

        // set parameters and execute
        $ID             = $data['ID'];
        $first_name     = ( empty($data['first_name']) ) ? '' : '%'.$data['first_name'].'%';
        $last_name      = ( empty($data['last_name']) ) ? '' : '%'.$data['last_name'].'%';
                
        $stmt->execute();

        $result = $stmt->get_result();
        $coaches = $result->fetch_all(MYSQLI_ASSOC);
                
        $stmt->close();
        $conn->close();
        
        return $coaches;
    }    
  
}

?>