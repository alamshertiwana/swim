<?php

class DB_Manager {

function get_connection(){
  
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "swim";
  
  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  
  return $conn;
}

}


?>