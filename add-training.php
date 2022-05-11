<?php   
        session_start();   
        global $page_title;
        $page_title ="Add Training";

        include("head.php");
        
        require_once("config.php");
        require_once("app/class-add-training-front.php");
?>

    <body>
    
    <?php include("header.php"); ?>

<?php

    $coach_id = 0;

    if( isset( $_SESSION["type"] ) && ($_SESSION["type"] =='coach') ){
        $coach_id = $_SESSION["ID"];        
    }
    else{
        die("Only a coach can access this page");
    }    
    
    $add_training_front = new Add_Training_Front();

    if( isset($_POST["submit"]) ){

        $user_id                    = $_GET["user"];
        $formData                   = $_POST["AddTraining"];
        $formData                   = array_merge($formData, array("coach_id"=>$coach_id) ); 
        $formData                   = array_merge($formData, array("user_id"=>$user_id) ); 
        $output                     = $add_training_front->add_training($formData);
    
    }

?>

    <div class="container-fluid">
    
        <div class="row">

        <?php include("navigation.php"); ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-4">

                <h1>Add Training</h1>

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

                <form action="add-training.php?user=<?php echo htmlspecialchars($_GET['user']); ?>" method="post">
                    <div class="form-group mb-3">
                        <label for="time">Time (HH:MM:SS.MS)</label>
                        <input type="time" step="0.01" class="form-control" id="time" name="AddTraining[time]" placeholder="Race Name">
                    </div>
                    <div class="form-group mb-3">
                        <label for="stroke">Stroke</label>
                        <select id="stroke" name="AddTraining[stroke]" class="form-control">
                            <option disabled selected>Select Stroke</option>
                            <option value="freestyle">Freestyle</option>
                            <option value="backstroke">Backstroke</option>
                            <option value="breaststroke">Breaststroke</option>
                            <option value="butterfly">Butterfly</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="distance">Distance</label>
                        <select id="distance" name="AddTraining[distance]" class="form-control">
                            <option disabled selected>Select Distance</option>
                            <option value="25">25m</option>
                            <option value="50">50m</option>
                            <option value="100">100m</option>
                            <option value="200">200m</option>
                            <option value="400">400m</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="date">Training Date</label>
                        <input type="date" class="form-control" id="date" name="AddTraining[date]">
                    </div>                                                             
                    <button type="submit" id="submit" name="submit" class="btn btn-primary">Submit</button>
                </form>

            </main>

        </div>

    </div>

<?php include("footer.php"); ?>
    </body>
</html>
