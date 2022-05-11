<?php

class Squad_Gateway {

    function insert_squad($data){
        $db = new DB_Manager;
        $conn = $db->get_connection();
        
        // prepare and bind
        $stmt = $conn->prepare("INSERT INTO squad (ID, COACH_ID, NAME) VALUES (NULL, ?, ?)");
        $stmt->bind_param("is", $coach_id, $squad_name);
        
        // set parameters and execute
        $squad_name     = $data['name'];
        $coach_id       = $data['coach_id'];
        
        $stmt->execute();
                
        $stmt->close();
        $conn->close();                
    }

    function get_squads_by_coach($coach_id){
        $db = new DB_Manager;
        $conn = $db->get_connection();
        
        // prepare and bind
        $stmt = $conn->prepare("SELECT * FROM squad WHERE COACH_ID = ?");        
        $stmt->bind_param("i", $c_id);

        // set parameters and execute
        $c_id = $coach_id;
                
        $stmt->execute();

        $result = $stmt->get_result();
        $coache = $result->fetch_all(MYSQLI_ASSOC);
                
        $stmt->close();
        $conn->close();
        
        return $coache;
    }    
  
}

?>