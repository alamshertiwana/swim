<?php   
        session_start();
        global $page_title;
        $page_title ="View Race";

        include("head.php");
        
        require_once("config.php");
        require_once("app/class-view-race-result-front.php");
?>

    <body>
    
    <?php include("header.php"); ?>

<?php

    $race_id = 0;

    if( isset( $_GET["race"] ) ){
        $race_id = $_GET["race"];        
    }

    $view_race_result   = new View_Race_Result_Front();
    $results              = $view_race_result ->get_race_result($race_id);

?>

    <div class="container-fluid">
    
        <div class="row">

        <?php include("navigation.php"); ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-4">

                <h1>View Race</h1>
                <?php
                    if( empty($results) )
                        echo '<p>There are no results to display right now</p>';
                ?>

                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        
                        <thead>
                            <tr>
                                <th scope="col">Position</th>
                                <th scope="col">Name</th>
                                <th scope="col">Time</th>
                                <th scope="col">Adjusted Time</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php
                                $position = 1;
                                foreach ($results as $result) {
                                    echo '<tr>';
                                    echo "<td>$position</td>";
                                    echo "<td>$result[FIRST_NAME] $result[LAST_NAME]</td>";
                                    echo "<td>$result[TIME]</td>";
                                    echo "<td>$result[ADJUSTED_TIME]</td>";
                                    echo '</tr>';
                                    $position++;
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
