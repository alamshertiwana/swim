<?php   
        session_start();
        global $page_title;
        $page_title ="View Squad Members";

        include("head.php");
        
        require_once("config.php");
        require_once("app/class-view-squad-members-front.php");
?>

    <body>
    
    <?php include("header.php"); ?>

<?php

    if( isset( $_SESSION["type"] ) && ($_SESSION["type"] =='coach') ){
    }
    else{
        die("Only a coach can access this page");
    }  

    $squad_id = 0;

    if( isset( $_GET["id"] ) ){
        $squad_id = $_GET["id"];        
    }

    $view_squad_members = new View_Squad_Members_Front();

    $users = $view_squad_members->get_users($squad_id);

?>

    <div class="container-fluid">
    
        <div class="row">

        <?php include("navigation.php"); ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-4">

                <h1>View Squad Members</h1>
                <?php
                    if( empty($users) )
                        echo '<p>There are no members to display right now</p>';
                ?>

                <div class="table-responsive">
                <table class="table table-striped table-sm">
                        
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">F. Name</th>
                                <th scope="col">L. Name</th>
                                <th scope="col">Gender</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php
                                foreach ($users as $user) {
                                    echo '<tr>';
                                    echo "<td>$user[ID]</td>";
                                    echo "<td>$user[FIRST_NAME]</td>";
                                    echo "<td>$user[LAST_NAME]</td>";
                                    echo "<td>$user[SEX]</td>";
                                    echo "<td><a href=\"add-training.php?user=$user[ID]\">Add Training</td>";
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
