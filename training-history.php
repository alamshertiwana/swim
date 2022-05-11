<?php   
        global $page_title;
        $page_title ="Training History";

        include("head.php");
        
        require_once("config.php");
        require_once("app/class-training-history-front.php");
?>

    <body>
    
    <?php include("header.php"); ?>

<?php

    $training_history = new Training_History_Front();

    $trainings = array();    

    if( isset($_POST["submit"]) ){

        $formData = $_POST["TrainingHistory"];
        
        if( isset($_GET['user']) ){
            $user_id    = $_GET["user"];
            $formData   = array_merge($formData, array("user_id"=>$user_id) ); 
        }

        $trainings = $training_history->get_trainings($formData);
    
    }
    else if( isset($_GET['user']) ){
        $formData = array();
        $user_id    = $_GET["user"];
        $formData   = array_merge($formData, array("user_id"=>$user_id) );
        $trainings = $training_history->get_trainings($formData);         
    }
    else{
        die('User ID Missing!');
    }    

?>

    <div class="container-fluid">
    
        <div class="row">

        <?php include("navigation.php"); ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-4">

                <h1>Training History</h1>
                
                <form class="form-inline mb-3" action="training-history.php?user=<?php echo htmlspecialchars($_GET['user']); ?>" method="post">
                    <div class="row g-3 mb-3">
                        <div class="col-sm-6">
                            <label for="date">Select Stroke</label>                        
                            <select id="stroke" name="TrainingHistory[stroke]" class="form-control">
                                <option disabled selected>Select Stroke</option>
                                <option value="freestyle">Freestyle</option>
                                <option value="backstroke">Backstroke</option>
                                <option value="breaststroke">Breaststroke</option>
                                <option value="butterfly">Butterfly</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label for="date">From Date</label>
                            <input type="date" class="form-control" id="date" name="TrainingHistory[from_date]">
                        </div>
                    </div>                                      
                    <button type="submit" id="submit" name="submit" class="btn btn-primary">Filter Results</button>
                </form>

                <?php
                    if( empty($trainings) )
                        echo '<p>There are no search results to display.</p>';
                ?>

                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Time</th>
                                <th scope="col">Distance</th>
                                <th scope="col">Stroke</th>
                                <th scope="col">Date</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php
                                foreach ($trainings as $user) {
                                    echo '<tr>';
                                    echo "<td>$user[ID]</td>";
                                    echo "<td>$user[TIME_DATA]</td>";
                                    echo "<td>$user[DISTANCE]</td>";
                                    echo "<td class=\"text-capitalize\">$user[STROKE]</td>";
                                    echo "<td>$user[DATE]</td>";
                                    echo '</tr>';
                                }
                            ?>

                        </tbody>
                    </table>

                </div>

            </main>

        </div>

    </div>

<?php include("footer.php"); ?>
    </body>
</html>
