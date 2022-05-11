<?php   
        global $page_title;
        $page_title ="Add Race";

        include("head.php");
        
        require_once("config.php");
        require_once("app/class-add-race-front.php");
?>

    <body>
    
    <?php include("header.php"); ?>

<?php
    if( isset($_POST["submit"]) ){

        $gala_id            = $_GET["gala"];
        $formData           = $_POST["AddRace"];
        $formData           = array_merge($formData, array("gala_id"=>$gala_id) ); 
        $add_race_front     = new Add_Race_Front();
        $output             = $add_race_front->add_race($formData);
    
    }

?>

    <div class="container-fluid">
    
        <div class="row">

        <?php include("navigation.php"); ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-4">

                <h1>Add Race</h1>

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

                <form action="add-race.php?gala=<?php echo htmlspecialchars($_GET['gala']); ?>" method="post">
                    <div class="form-group mb-3">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="AddRace[name]" placeholder="Race Name">
                    </div>
                    <div class="form-group mb-3">
                        <label for="gender">Gender</label>
                        <select id="gender" name="AddRace[gender]" class="form-control">
                            <option disabled selected>Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>                    
                    <div class="form-group mb-3">
                        <label for="distance">Distance</label>
                        <select id="distance" name="AddRace[distance]" class="form-control">
                            <option disabled selected>Select Distance</option>
                            <option value="25">25m</option>
                            <option value="50">50m</option>
                            <option value="100">100m</option>
                            <option value="200">200m</option>
                            <option value="400">400m</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="stroke">Stroke</label>
                        <select id="stroke" name="AddRace[stroke]" class="form-control">
                            <option disabled selected>Select Stroke</option>
                            <option value="freestyle">Freestyle</option>
                            <option value="backstroke">Backstroke</option>
                            <option value="breaststroke">Breaststroke</option>
                            <option value="butterfly">Butterfly</option>
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
