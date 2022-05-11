<?php   
        session_start();
        global $page_title;
        $page_title ="View Gala";

        include("head.php");
        
        require_once("config.php");
        require_once("app/class-view-gala-front.php");
?>

    <body>
    
    <?php include("header.php"); ?>

<?php

    $view_gala = new View_Gala_Front();

    $galas = $view_gala->get_gala();

?>

    <div class="container-fluid">
    
        <div class="row">

        <?php include("navigation.php"); ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-4">

                <h1>View Gala</h1>
                <?php
                    if( empty($galas) )
                        echo '<p>There are no galas to display right now</p>';
                ?>

                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Date</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php
                                foreach ($galas as $gala) {
                                    echo '<tr>';
                                    echo "<td>$gala[ID]</td>";
                                    echo "<td>$gala[NAME]</td>";
                                    echo "<td>$gala[DATE]</td>";
                                    echo '<td><a href="add-race.php?gala='.$gala['ID'].'">Add Race</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="view-races.php?gala='.$gala['ID'].'">View Races</a></td>';
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
