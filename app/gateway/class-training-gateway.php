<?php

class Training_Gateway {

    function inser_training($data){

        $db = new DB_Manager;
        $conn = $db->get_connection();
        
        // prepare and bind
        $stmt = $conn->prepare("INSERT INTO training(ID, USER_ID, COACH_ID, TIME_DATA, DISTANCE, STROKE, DATE) VALUES (NULL, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iissss", $user_id, $coach_id, $time, $distance, $stroke, $date);
        
        // set parameters and execute
        $user_id    = $data['user_id'];
        $coach_id   = $data['coach_id'];
        $time       = $data['time'];
        $distance   = $data['distance'];
        $stroke     = $data['stroke'];
        $date       = $data['date'];
        
        $stmt->execute();
                
        $stmt->close();
        $conn->close();        
    }
    
    function get_trainings($data){

        $db = new DB_Manager;
        $conn = $db->get_connection();

        $ID             = $data['user_id'];
        $stroke         = ( isset($data['stroke']) ) ? $data['stroke'] : '';
        $from_date      = ( isset($data['from_date']) ) ? $data['from_date'] : '';        

        //All filter options are set
        if( !(empty($stroke)) && !(empty($from_date)) ){
            // prepare and bind
            $stmt = $conn->prepare("SELECT * FROM training WHERE USER_ID = ? AND STROKE = ? AND DATE >= ? ORDER BY DATE DESC;");        
            $stmt->bind_param("iss", $ID,$stroke,$from_date);
        }
        //only stroke is set
        else if( !(empty($stroke)) ){
            // prepare and bind
            $stmt = $conn->prepare("SELECT * FROM training WHERE USER_ID = ? AND STROKE = ? ORDER BY DATE DESC;");        
            $stmt->bind_param("is", $ID,$stroke);
        }
        else if( !(empty($from_date)) ){
            // prepare and bind
            $stmt = $conn->prepare("SELECT * FROM training WHERE USER_ID = ? AND DATE >= ? ORDER BY DATE DESC;");        
            $stmt->bind_param("is", $ID,$from_date);
        }
        //nothing is set to get all rows for the user with the current ID        
        else{
            // prepare and bind
            $stmt = $conn->prepare("SELECT * FROM training WHERE USER_ID = ? ORDER BY DATE DESC;");        
            $stmt->bind_param("i", $ID);
        }        
        $stmt->execute();

        $result = $stmt->get_result();
        $trainings = $result->fetch_all(MYSQLI_ASSOC);
                
        $stmt->close();
        $conn->close();
        
        return $trainings;       
    }    
  
}

?>