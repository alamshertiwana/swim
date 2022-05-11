<?php
        session_start();   
        global $page_title;
        $page_title ="Edit User";

        include("head.php");
        
        require_once("config.php");
        require_once("app/class-edit-user-front.php");
?>

    <body>
    
    <?php include("header.php"); ?>

<?php

    $parent_id = 0;

    /*Users types that can access the page are Parent of Swimmer, Swimmer themself and an Admin*/
    if( isset( $_SESSION["type"] ) ){

        if( $_SESSION["type"] == "parent" ){
            $parent_id = $_SESSION["ID"];
        }
        else if( $_SESSION["type"] == "swimmer" ){
            
            if( $_SESSION["ID"]!= $_GET["user"] ){
                die("You can only edit your own details");
            }
        
        }
        else if( $_SESSION["type"] != "admin" ){
            die("Not allowed to access this page");
        }        
    }
    else{
        die("Missing SESSION. Please make sure you are logged in before accessing this page");
    }

    $edit_user  = new Edit_User_Front();

    if( isset($_POST["submit"]) ){

        if(isset($_POST["EditUser"])){

            $user_id            = $_GET["user"];
            $formData           = $_POST["EditUser"];
            $formData           = array_merge($formData, array("user_id"=>$user_id) ); 
            $output             = $edit_user->edit_user($formData);
    
        }

        else{
            $output             = $edit_user->edit_user(null);
        }
    }

    $user= null;

    if( isset($_GET["user"]) ){
        $user_obj = $edit_user->get_user_details($_GET["user"]);
        $user_obj = array_pop($user_obj);

        if( !(isset($user_obj)) ){
            die("Not allowed to access user details");
        }
        else if( ($user_obj['PARENT1_ID']== $parent_id || $user_obj['PARENT2_ID']== $parent_id) ){
            $user = $user_obj;
        }
    }
    else{
        die('User ID Missing!');
    }
?>

    <div class="container-fluid">
    
        <div class="row">

        <?php include("navigation.php"); ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-4">

                <h1>Edit Swimmer</h1>

                <?php
                    if( isset($output['pass']) && $output['pass']== true ){
                ?>
                <div class="alert alert-success" role="alert">
                    <p class="mb-0"><strong>Success!</strong> The swimmer details were updated successfully.</p>
                </div>
                <?php
                    }
                    elseif( isset($output['pass']) && $output['pass']== false ){
                ?>
                <div class="alert alert-danger" role="alert">
                    <p class="mb-0"><strong>Error!</strong> Please fix the following issues :</p>
                    <ul class="mb-0">
                    <?php
                        foreach ($output['error'] as $message) {
                            echo "<li> $message </li>";
                        }                        
                    ?>
                    </ul>
                </div>
                <?php
                    }
                ?>                

                <form action="edit-user.php?user=<?php echo $_GET['user']; ?>" method="post">
                    <div class="form-group mb-3">
                        <label for="username">Username</label>
                        <input readonlytext type="text" readonly class="form-control" id="username" placeholder="Username" value="<?php echo $user['USERNAME']; ?>">
                    </div>                    
                    <div class="form-group mb-3">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" name="EditUser[email]" placeholder="Enter email" value="<?php echo $user['EMAIL']; ?>">
                    </div>
                    <div class="form-group mb-3">
                        <label for="first-name">First Name</label>
                        <input type="text" class="form-control" id="first-name" name="EditUser[first_name]" placeholder="First Name" value="<?php echo $user['FIRST_NAME']; ?>">
                    </div>                      
                    <div class="form-group mb-3">
                        <label for="last-name">Last Name</label>
                        <input type="text" class="form-control" id="last-name" name="EditUser[last_name]" placeholder="Last Name" value="<?php echo $user['LAST_NAME']; ?>">
                    </div>
                    <div class="form-group mb-3">
                        <label for="date">Date of Birth</label>
                        <input type="date" class="form-control" id="date" name="EditUser[dob]" value="<?php echo $user['DOB']; ?>">
                    </div>                    
                    <div class="form-group mb-3">
                        <label for="telephone">Telephone Number</label>
                        <input type="text" class="form-control" id="telephone" name="EditUser[telephone]" pattern="[0-9]{11}" value="<?php echo $user['TELEPHONE']; ?>">
                    </div>
                    <div class="form-group mb-3">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" name="EditUser[address]" placeholder="Address" value="<?php echo $user['ADDRESS']; ?>">
                    </div>
                    <div class="form-group mb-3">
                        <label for="postcode">Postcode</label>
                        <input type="text" class="form-control" id="postcode" name="EditUser[postcode]" placeholder="Postcode" value="<?php echo $user['POSTCODE']; ?>">
                    </div>                    
                    <button type="submit" id="submit" name="submit" class="btn btn-primary">Update</button>
                </form>

            </main>

        </div>

    </div>

<?php include("footer.php"); ?>
    </body>
</html>
