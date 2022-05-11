<?php
        session_start();   
        global $page_title;
        $page_title ="Add Swimmer to Squad";

        include("head.php");
        
        require_once("config.php");
        require_once("app/add-swimmer-squad-front.php");
?>

    <body>
    
    <?php include("header.php"); ?>

<?php

    $add_swimmer_squad  = new Add_Swimmer_Squad_Front();

    if( isset($_POST["submit"]) ){

        if(isset($_POST["AssignSwimmer"])){
            $formData           = $_POST["AssignSwimmer"];
            $output             = $add_swimmer_squad->assign_swimmer_squad($formData);
    
        }

        else{
            $output             = $add_swimmer_squad->assign_swimmer_squad(null);
        }
    }

    $coach_id = 0;

    if( isset( $_SESSION["type"] ) && ($_SESSION["type"] =='coach') ){
        $coach_id = $_SESSION["ID"];        
    }
    else{
        die("Only a coach can access this page");
    }    

    $squads             = $add_swimmer_squad->get_squads($coach_id);
    $users              = $add_swimmer_squad->get_users();     

?>

    <div class="container-fluid">
    
        <div class="row">

        <?php include("navigation.php"); ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-4">

                <h1>Assign Swimmer to Squad</h1>

                <?php
                    if( isset($output['pass']) && $output['pass']== true ){
                ?>
                <div class="alert alert-success" role="alert">
                    <p class="mb-0"><strong>Success!</strong> The swimmer was assigned to the squad successfully.</p>
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

                <form action="add-swimmer-squad.php" method="post">
                    <div class="form-group mb-3">
                        <label for="select-squad">Select Squad</label>
                        <select id="select-squad" name="AssignSwimmer[squad_id]" class="form-control">
                            <option disabled selected>Select Squad</option>
                            <?php 
                                foreach ($squads as $squad) {
                                    $ID             = $squad['ID'];
                                    $name     = $squad['NAME'];
                                    echo "<option value=$ID>$ID. $name</option>";
                                }                            
                            ?>                            
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="users">Select User</label>
                        <select id="users" name="AssignSwimmer[user_id]" class="form-control">
                            <option disabled selected>Select User</option>
                            <?php 
                                foreach ($users as $user) {
                                    $ID             = $user['ID'];
                                    $first_name     = $user['FIRST_NAME'];
                                    $last_name      = $user['FIRST_NAME'];
                                    $username       = $user['USERNAME'];
                                    echo "<option value=$ID>$ID. $first_name $last_name ($username)</option>";
                                }                            
                            ?>                            
                        </select>
                    </div>                                                            
                    <button type="submit" id="submit" name="submit" class="btn btn-primary">Submit</button>
                </form>

            </main>

        </div>

    </div>

<?php include("footer.php"); ?>
    </body>
</html>
