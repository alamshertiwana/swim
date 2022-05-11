<?php   
        session_start();
        global $page_title;
        $page_title ="View Children";

        include("head.php");
        
        require_once("config.php");
        require_once("app/class-view-children-front.php");
?>

    <body>
    
    <?php include("header.php"); ?>

<?php

    $parent_id = 0;

    if( isset( $_SESSION["type"] ) ){
        $parent_id = $_SESSION["ID"];        
    }

    $view_children = new View_Children_Front();

    $users = $view_children->get_users($parent_id);

?>

    <div class="container-fluid">
    
        <div class="row">

        <?php include("navigation.php"); ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-4">

                <h1>View Children</h1>
                <?php
                    if( empty($users) )
                        echo '<p>You do not have any children associated with your account.</p>';
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
                                    echo "<td><a href=\"view-user.php?user=$user[ID]\">View Details</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"edit-user.php?user=$user[ID]\">Edit Details</a></td>";
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
