<?php   
        global $page_title;
        $page_title ="Race History";

        include("head.php");
        
        require_once("config.php");
        require_once("app/class-race-history-front.php");
?>

    <body>
    
    <?php include("header.php"); ?>

<?php

    $race_history = new Race_History_Front();

    $races = array();
    $formData = array();
    
    if( isset($_POST["submit"]) ){

        if(isset($_POST["RaceHistory"]) ){
            $formData = $_POST["RaceHistory"];
        }
        
        if( isset($_GET['user']) ){
            $user_id    = $_GET["user"];
            $formData   = array_merge($formData, array("user_id"=>$user_id) ); 
        }

        $races = $race_history->get_races($formData);
    
    }
    else if( isset($_GET['user']) ){
        $user_id    = $_GET["user"];
        $formData   = array_merge($formData, array("user_id"=>$user_id) );
        $races = $race_history->get_races($formData);         
    }
    else{
        die('User ID Missing!');
    }    

?>

    <div class="container-fluid">
    
        <div class="row">

        <?php include("navigation.php"); ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-4">

                <h1>Race History</h1>
                
                <form class="form-inline mb-3" action="race-history.php?user=<?php echo htmlspecialchars($_GET['user']); ?>" method="post">
                    <div class="row g-3 mb-3">
                        <div class="col-sm-6">
                            <label for="date">Select Stroke</label>                        
                            <select id="stroke" name="RaceHistory[stroke]" class="form-control">
                                <option disabled selected>Select Stroke</option>
                                <option value="freestyle">Freestyle</option>
                                <option value="backstroke">Backstroke</option>
                                <option value="breaststroke">Breaststroke</option>
                                <option value="butterfly">Butterfly</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label for="date">Select Distance</label>
                            <select id="distance" name="RaceHistory[distance]" class="form-control">
                                <option disabled selected>Select Distance</option>
                                <option value="25">25m</option>
                                <option value="50">50m</option>
                                <option value="100">100m</option>
                                <option value="200">200m</option>
                                <option value="400">400m</option>
                            </select>
                        </div>
                    </div>                                      
                    <button type="submit" id="submit" name="submit" class="btn btn-primary">Filter Results</button>
                </form>

                <?php
                    if( empty($races) )
                        echo '<p>There are no search results to display.</p>';
                ?>

                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        
                        <thead>
                            <tr>
                                <th scope="col">Race Name</th>
                                <th scope="col">Time</th>
                                <th scope="col">Adj. Time</th>
                                <th scope="col">Distance</th>
                                <th scope="col">Stroke</th>
                                <th scope="col">Date</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php
                                foreach ($races as $race) {
                                    echo '<tr>';
                                    echo "<td>$race[RACE_NAME]</td>";
                                    echo "<td>$race[TIME]</td>";
                                    echo "<td>$race[ADJUSTED_TIME]</td>";
                                    echo "<td>$race[DISTANCE]</td>";
                                    echo "<td class=\"text-capitalize\">$race[STROKE]</td>";
                                    echo "<td>$race[DATE]</td>";
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
