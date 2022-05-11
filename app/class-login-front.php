<?php

require_once('class-db-manager.php');
require_once("class-validation-helper.php");
require_once('gateway\class-parent-gateway.php');
require_once('gateway\class-coach-gateway.php');
require_once('gateway\class-user-gateway.php');
require_once('gateway\class-admin-gateway.php');

class Login_Front {

    function login($data){

        //The "error" contains error messages. The "pass" is set to true at the end if all validation checks are passed.
        $output = array("error"=> array(), "pass"=>false);

        $pass = true;  //This will returned at the end as part of the $output array it is set to false if any validation fails

        $required       = array("username","password","user_type");
        $validation     = new Validation_Helper();

        $data           = $validation->trim_array($data);

        $check_passed   = $validation->keys_in_array($data,$required);
        
        if($check_passed == false){
            array_push($output['error'], 'Please make sure that all required values are filled.');
            $pass = false;
        }
              

        if($pass){

            if($data['user_type'] ==  'coach'){

                $coach_gateway  = new Coach_Gateway();
                $user          = $coach_gateway->login($data);

                if(!isset($user) || empty($user)){
                    array_push($output['error'], 'The login details are incorrect.');
                    $pass = false;                
                }
                else{

                    if( !( password_verify($data['password'], $user[0]['PASSWORD'])) ) {
                        array_push($output['error'], 'The login details are incorrect.');
                        $pass = false;
                    }
                    else{
                        $_SESSION["username"]   = $user[0]['USERNAME'];
                        $_SESSION["type"]       = "coach";                        
                        $_SESSION["ID"]         = $user[0]['ID'];                        
                    }

                }                    
            }

            else if($data['user_type'] ==  'swimmer'){

                $user_gateway  = new User_Gateway();
                $user          = $user_gateway->login($data);

                if(!isset($user) || empty($user)){
                    array_push($output['error'], 'The login details are incorrect.');
                    $pass = false;                
                }
                else{

                    if( !( password_verify($data['password'], $user[0]['PASSWORD'])) ) {
                        array_push($output['error'], 'The login details are incorrect.');
                        $pass = false;
                    }
                    else{
                        $_SESSION["username"]   = $user[0]['USERNAME'];
                        $_SESSION["type"]       = "user";                        
                        $_SESSION["ID"]         = $user[0]['ID'];                        
                    }

                }
            }

            else if($data['user_type'] ==  'parent'){

                $parent_gateway     = new Parent_Gateway();
                $user               = $parent_gateway->login($data);

                if(!isset($user) || empty($user)){
                    array_push($output['error'], 'The login details are incorrect.');
                    $pass = false;                
                }
                else{

                    if( !( password_verify($data['password'], $user[0]['PASSWORD'])) ) {
                        array_push($output['error'], 'The login details are incorrect.');
                        $pass = false;
                    }
                    else{
                        $_SESSION["username"]   = $user[0]['USERNAME'];
                        $_SESSION["type"]       = "parent";                        
                        $_SESSION["ID"]         = $user[0]['ID'];                        
                    }

                }
            }
            
            else if($data['user_type'] ==  'admin'){

                $admin_gateway      = new Admin_Gateway();
                $user               = $admin_gateway->login($data);

                if(!isset($user) || empty($user)){
                    array_push($output['error'], 'The login details are incorrect.');
                    $pass = false;                
                }
                else{

                    if( !( password_verify($data['password'], $user[0]['PASSWORD'])) ) {
                        array_push($output['error'], 'The login details are incorrect.');
                        $pass = false;
                    }
                    else{
                        $_SESSION["username"]   = $user[0]['USERNAME'];
                        $_SESSION["type"]       = "admin";                        
                        $_SESSION["ID"]         = $user[0]['ID'];                        
                    }

                }
            }            

            else{
                $pass = false;                
            }

        }

        $output['pass'] = $pass;

        return $output;
    }

}

?>