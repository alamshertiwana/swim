<?php

class Race_Gateway {

    function insert_race($data){

        $db = new DB_Manager;
        $conn = $db->get_connection();
        
        // prepare and bind
        $stmt = $conn->prepare("INSERT INTO race(ID, GALA_ID, NAME, DISTANCE, GENDER, STROKE)  VALUES (NULL, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $gala_id, $name, $distance, $gender, $stroke);
        
        // set parameters and execute
        $gala_id        = $data['gala_id'];
        $name           = $data['name'];
        $distance       = $data['distance'];
        $gender         = $data['gender'];
        $stroke         = $data['stroke'];
        
        $stmt->execute();
                
        $stmt->close();
        $conn->close();        
    }

    function get_races($_gala_id){
        $db = new DB_Manager;
        $conn = $db->get_connection();
        
        // prepare and bind
        $stmt = $conn->prepare("SELECT * FROM race WHERE GALA_ID = ?");        
        $stmt->bind_param("i", $gala_id);

        $gala_id = $_gala_id;

        $stmt->execute();

        $result = $stmt->get_result();
        $coaches = $result->fetch_all(MYSQLI_ASSOC);
                
        $stmt->close();
        $conn->close();
        
        return $coaches;
    }
    
    function get_races_for_search($data){

        $db = new DB_Manager;
        $conn = $db->get_connection();

        $ID             = $data['user_id'];
        $stroke         = ( isset($data['stroke']) ) ? $data['stroke'] : '';
        $distance       = ( isset($data['distance']) ) ? $data['distance'] : '';        

        //All filter options are set
        if( !(empty($stroke)) && !(empty($distance)) ){
            // prepare and bind
            $stmt = $conn->prepare("SELECT *, race.NAME AS RACE_NAME FROM ((swimmers_race INNER JOIN race ON swimmers_race.RACE_ID = race.ID) INNER JOIN gala ON gala.ID = race.GALA_ID) WHERE USER_ID = ? AND race.STROKE = ? AND race.DISTANCE =? ");        
            $stmt->bind_param("iss", $ID,$stroke,$distance);
        }
        //only stroke is set
        else if( !(empty($stroke)) ){
            // prepare and bind
            $stmt = $conn->prepare("SELECT *, race.NAME AS RACE_NAME FROM ((swimmers_race INNER JOIN race ON swimmers_race.RACE_ID = race.ID) INNER JOIN gala ON gala.ID = race.GALA_ID) WHERE USER_ID = ? AND race.STROKE = ?");        
            $stmt->bind_param("is", $ID,$stroke);
        }
        else if( !(empty($distance)) ){
            // prepare and bind
            $stmt = $conn->prepare("SELECT *, race.NAME AS RACE_NAME FROM ((swimmers_race INNER JOIN race ON swimmers_race.RACE_ID = race.ID) INNER JOIN gala ON gala.ID = race.GALA_ID) WHERE USER_ID = ? AND race.DISTANCE =? ");        
            $stmt->bind_param("is", $ID,$distance);
        }
        //nothing is set to get all rows for the user with the current ID        
        else{
            // prepare and bind
            $stmt = $conn->prepare("SELECT *, race.NAME AS RACE_NAME FROM ((swimmers_race INNER JOIN race ON swimmers_race.RACE_ID = race.ID) INNER JOIN gala ON gala.ID = race.GALA_ID) WHERE USER_ID = ? ");        
            $stmt->bind_param("i", $ID);
        }        
        $stmt->execute();

        $result = $stmt->get_result();
        $races = $result->fetch_all(MYSQLI_ASSOC);
                
        $stmt->close();
        $conn->close();
        
        return $races;       
    }    
  
}

?>