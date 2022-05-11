<?php

class Admin_Gateway {

    function login($data){
        $db = new DB_Manager;
        $conn = $db->get_connection();
        
        // prepare and bind
        $stmt = $conn->prepare("SELECT * FROM admin WHERE USERNAME = ?");        
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
  
}

?>