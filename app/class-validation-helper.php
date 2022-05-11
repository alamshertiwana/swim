<?php

class Validation_Helper {

    //The function takes an arry as input and trimes all values
    function trim_array($data){

        $output = array_map('trim', $data);

        return $output;

    }

    /*Takes two arrays as input. The first contains array to be checked and the second contains array of strings. 
    Returns false if any of the strings in the $required array do not exist in the $input array.
    This functions also checks if any required fields are empty and returns false.
    */
    function keys_in_array($input, $required){

        $pass = true;

        foreach ($required as $key) {

            $pass = array_key_exists($key,$input);

            if($pass==false || empty($input[$key]) ){
                $pass = false;
                break;
            }
        }
        
        return $pass;

    }

    function validate_email($email){

        // Remove all illegal characters from email
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }

    }


  
}

?>