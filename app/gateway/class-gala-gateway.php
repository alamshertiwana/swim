<?php

class Gala_Gateway {

    function insert_gala($data){

        $db = new DB_Manager;
        $conn = $db->get_connection();
        
        // prepare and bind
        $stmt = $conn->prepare("INSERT INTO gala (ID, NAME, DATE) VALUES (NULL, ?, ?)");
        $stmt->bind_param("ss", $name, $date);
        
        // set parameters and execute
        $name       = $data['name'];
        $date       = $data['date'];
        
        $stmt->execute();
                
        $stmt->close();
        $conn->close();        
    }

    function get_galas(){
        $db = new DB_Manager;
        $conn = $db->get_connection();
        
        // prepare and bind
        $stmt = $conn->prepare("SELECT * FROM gala");        
        
        $stmt->execute();

        $result = $stmt->get_result();
        $coaches = $result->fetch_all(MYSQLI_ASSOC);
                
        $stmt->close();
        $conn->close();
        
        return $coaches;
    }    
  
}

?>