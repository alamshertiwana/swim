<?php

class Swimmers_Race_Gateway {

    function insert_race_entry($data){ 

        /*
        TODO check if USER ID + RACE ID combination is already present. 
        Show an error in that case as the user entry has been already made for the race and multiple entries for the 
        same user should not be allowed
        */

        $db = new DB_Manager;
        $conn = $db->get_connection();
        
        // prepare and bind
        $stmt = $conn->prepare("INSERT INTO swimmers_race(ID, `USER_ID`, RACE_ID, TIME, ADJUSTED_TIME)  VALUES (NULL, ?, ?, ?, ?)");
        $stmt->bind_param("ssss", $user_id, $race_id, $time, $adjusted_time);
        
        // set parameters and execute
        $user_id            = $data['user_id'];
        $race_id            = $data['race_id'];
        $time               = $data['time'];
        $adjusted_time      = $data['adjusted_time'];
        
        $stmt->execute();
                
        $stmt->close();
        $conn->close();        
    }

    function get_race_result($id){
        $db = new DB_Manager;
        $conn = $db->get_connection();
        
        // prepare and bind
        $stmt = $conn->prepare("SELECT * FROM swimmers_race INNER JOIN users ON users.ID=swimmers_race.USER_ID WHERE RACE_ID = ?");        
        $stmt->bind_param("i", $race_id);

        // set parameters and execute
        $race_id            = $id;
                
        $stmt->execute();

        $result = $stmt->get_result();
        $coaches = $result->fetch_all(MYSQLI_ASSOC);
                
        $stmt->close();
        $conn->close();
        
        return $coaches;
    }    
  
}

?>