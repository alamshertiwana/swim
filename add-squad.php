<?php   
        session_start();
        global $page_title;
        $page_title ="Add Squad";

        include("head.php");
        
        require_once("config.php");
        require_once("app/class-add-squad-front.php");
?>

    <body>
    
    <?php include("header.php"); ?>

<?php

    if( isset( $_SESSION["type"] ) && ($_SESSION["type"] =='admin') ){
    }
    else{
        die("Only an admin can access this page");
    }

    $add_squad = new Add_Squad_Front();

    if( isset($_POST["submit"]) ){
        $formData   = $_POST["AddSquad"]; 
        $output     = $add_squad->add_squad($formData);
    }

    $coaches = $add_squad->get_coaches();

?>

    <div class="container-fluid">
    
        <div class="row">

        <?php include("navigation.php"); ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-4">

                <h1>Add Squad</h1>

                <?php
                    if( isset($output['pass']) && $output['pass']== true ){
                ?>
                <div class="alert alert-success" role="alert">
                    <p class="mb-0"><strong>Success!</strong> The data was added successfully.</p>
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

                <form action="add-squad.php" method="post">
                    <div class="form-group mb-3">
                        <label for="name">Squad Name</label>
                        <input type="text" class="form-control" id="name" name="AddSquad[name]" placeholder="Squad Name">
                    </div>
                    <div class="form-group mb-3">
                        <label for="coach">Select Coach</label>
                        <select id="coach" name="AddSquad[coach_id]" class="form-control">
                            <option disabled selected>Select Coach</option>
                            <?php 
                                foreach ($coaches as $coach) {
                                    $ID = $coach['ID'];
                                    $first_name = $coach['FIRST_NAME'];
                                    echo "<option value=$ID>$ID. $first_name </option>";
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
