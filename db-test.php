<?php

//I have to use prepared statements instead of regular stamtents for security try it tomorrow
// defined( 'ABSPATH' ) || exit; look into this so that no one can open the file directly

class DB_MANAGER {

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

$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/common/header.php";

$root=pathinfo($_SERVER['SCRIPT_FILENAME']);
define ('BASE_FOLDER', basename($root['dirname']));
define ('SITE_ROOT',    realpath(dirname(__FILE__)));
define ('SITE_URL',    'http://'.$_SERVER['HTTP_HOST'].'/'.BASE_FOLDER);

/*Code for just checking the connection 
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully";
*/

/* Dummy SQL statement for reference
$sql = "INSERT INTO MyGuests (firstname, lastname, email)
VALUES ('John', 'Doe', 'john@example.com')";
*/


/*
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "swim";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
*/


/*Final Working Code for with prepared statment*/
$db = new DB_Manager;
$conn = $db->get_connection();

// prepare and bind
$stmt = $conn->prepare("INSERT INTO users (ID, USERNAME, PASSWORD, FIRST_NAME, LAST_NAME,SEX, DOB, EMAIL, TELEPHONE, ADDRESS, POSTCODE, PARENT1_ID, PARENT2_ID, SQUAD_ID) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NULL, NULL, NULL)");
$stmt->bind_param("ssssssssss", $username, $password, $first_name, $last_name, $sex, $dob, $email, $telephone, $address, $postcode);

// set parameters and execute
$username = "emma";
$password = "123456";
$first_name = "Emma";
$last_name = "Doe";
$sex = "Female";
$dob = "20/10/1996";
$email = "emmadoe@gmail.com";
$telephone ="07444166100";
$address ="House # 200, 1 North Street";
$postcode ="ST47FA";

$stmt->execute();

echo "New records created successfully";

$stmt->close();
$conn->close();

/* Normal SQL Code Final Working Code for without prepared statment
$sql = "INSERT INTO users (ID, USERNAME, PASSWORD, FIRST_NAME, LAST_NAME,SEX, DOB, EMAIL, TELEPHONE, ADDRESS, POSTCODE, PARENT1_ID, PARENT2_ID, SQUAD_ID) VALUES 
(NULL, 'emma', '123456', 'Emma', 'Doe', 'Female', '20/10/1996', 'janedoe@gmail.com', '07444166100', 'House # 100, 1 North Street', 'ST47DQ', NULL, NULL, NULL);";

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
*/



?>