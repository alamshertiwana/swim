<?php   
        global $page_title;
        $page_title ="View Users";

        include("head.php");
        
        require_once("config.php");
        require_once("app/class-view-users-front.php");
?>

    <body>
    
    <?php include("header.php"); ?>

<?php

    $view_users = new View_Users_Front();

    $users = $view_users->get_users();

?>

    <div class="container-fluid">
    
        <div class="row">

        <?php include("navigation.php"); ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-4">

                <h1>View Users</h1>
                <?php
                    if( empty($users) )
                        echo '<p>There are no users to display right now</p>';
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
                                <th scope="col">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php
                                foreach ($users as $user) {
                                    echo '<tr>';
                                    echo "<td>$user[ID]</td>";
                                    echo "<td>$user[USERNAME]</td>";
                                    echo "<td>$user[FIRST_NAME]</td>";
                                    echo "<td>$user[LAST_NAME]</td>";
                                    echo "<td>$user[SEX]</td>";
                                    echo "<td>$user[DOB]</td>";
                                    echo "<td>$user[EMAIL]</td>";
                                    echo "<td>$user[TELEPHONE]</td>";
                                    echo "<td>$user[ADDRESS]</td>";
                                    echo "<td>$user[POSTCODE]</td>";
                                    echo "<td><a href=\"assign-parent.php?user=$user[ID]\">Assign Parent</td>";
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
