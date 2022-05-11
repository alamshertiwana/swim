<?php   
        session_start();
        global $page_title;
        $page_title ="View Race";

        include("head.php");
        
        require_once("config.php");
        require_once("app/class-view-races-front.php");
?>

    <body>
    
    <?php include("header.php"); ?>

<?php

    $gala_id = 0;

    if( isset( $_GET["gala"] ) ){
        $gala_id = $_GET["gala"];        
    }

    $view_races = new View_Races_Front();

    $races = $view_races->get_races($gala_id);

?>

    <div class="container-fluid">
    
        <div class="row">

        <?php include("navigation.php"); ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-4">

                <h1>View Race</h1>
                <?php
                    if( empty($races) )
                        echo '<p>There are no races to display right now</p>';
                ?>

                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Distance</th>
                                <th scope="col">Gender</th>
                                <th scope="col">Stroke</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php
                                foreach ($races as $race) {
                                    echo '<tr>';
                                    echo "<td>$race[ID]</td>";
                                    echo "<td>$race[NAME]</td>";
                                    echo "<td>$race[DISTANCE]m</td>";
                                    echo "<td>$race[GENDER]</td>";
                                    echo "<td class=\"text-capitalize\">$race[STROKE]</td>";
                                    if( isset( $_SESSION["type"] ) && ($_SESSION["type"] =='admin') ){
                                        echo '<td><a href="add-race-entry.php?race='.$race['ID'].'">Add Entry</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="view-race-result.php?race='.$race['ID'].'">View Results</a></td>';
                                    }
                                    else{
                                        echo '<td><a href="view-race-result.php?race='.$race['ID'].'">View Results</a></td>';                                    }                                    
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
