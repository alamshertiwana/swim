<?php   
        session_start();
        global $page_title;
        $page_title ="View Squads";

        include("head.php");
        
        require_once("config.php");
        require_once("app/class-view-squads-front.php");
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

    $view_squads = new View_Squads_Front();

    $squads = $view_squads->get_squads($coach_id);

?>

    <div class="container-fluid">
    
        <div class="row">

        <?php include("navigation.php"); ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-4">

                <h1>View Squads</h1>
                <?php
                    if( empty($squads) )
                        echo '<p>There are no races to display right now</p>';
                ?>

                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php
                                foreach ($squads as $squad) {
                                    echo '<tr>';
                                    echo "<td>$squad[ID]</td>";
                                    echo "<td>$squad[NAME]</td>";
                                    echo "<td><a href=\"view-squad-members.php?id=$squad[ID]\">View Members</a></td>";
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
