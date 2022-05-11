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

    $add_squad = new Add_Squad_Front();

    if( isset($_POST["submit"]) ){
        $formData = $_POST["AddSquad"]; // dont forget to sanitize any post data
        $add_squad->add_squad($formData);
    }

    $coaches = $add_squad->get_coaches();

?>

    <div class="container-fluid">
    
        <div class="row">

        <?php include("navigation.php"); ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-4">

                <h1>Add Squad</h1>

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
