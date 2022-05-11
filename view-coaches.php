<?php   
        global $page_title;
        $page_title ="View Coaches";

        include("head.php");
        
        require_once("config.php");
        require_once("app/class-view-coaches-front.php");
?>

    <body>
    
    <?php include("header.php"); ?>

<?php

    $view_coaches = new View_Coaches_Front();

    $coaches = $view_coaches->get_coaches();

?>

    <div class="container-fluid">
    
        <div class="row">

        <?php include("navigation.php"); ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-4">

                <h1>View Coaches</h1>
                <?php
                    if( empty($coaches) )
                        echo '<p>There are no coaches to display right now</p>';
                ?>

                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Username</th>
                                <th scope="col">F. Name</th>
                                <th scope="col">L. Name</th>
                                <th scope="col">Sex</th>
                                <th scope="col">DOB</th>
                                <th scope="col">Email</th>
                                <th scope="col">Telephone</th>
                                <th scope="col">Address</th>
                                <th scope="col">Postcode</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php
                                foreach ($coaches as $coach) {
                                    echo '<tr>';
                                    echo "<td>$coach[ID]</td>";
                                    echo "<td>$coach[USERNAME]</td>";
                                    echo "<td>$coach[FIRST_NAME]</td>";
                                    echo "<td>$coach[LAST_NAME]</td>";
                                    echo "<td>$coach[SEX]</td>";
                                    echo "<td>$coach[DOB]</td>";
                                    echo "<td>$coach[EMAIL]</td>";
                                    echo "<td>$coach[TELEPHONE]</td>";
                                    echo "<td>$coach[ADDRESS]</td>";
                                    echo "<td>$coach[POSTCODE]</td>";
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
