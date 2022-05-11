<?php   
        session_start();
        global $page_title;
        $page_title ="Search & Filter Users";

        include("head.php");
        
        require_once("config.php");
        require_once("app/class-search-users-front.php");
?>

    <body>
    
    <?php include("header.php"); ?>

<?php

    $search_user = new Search_Users_Front();

    $users = array();    

    if( isset($_POST["submit"]) ){
        $formData = $_POST["SearchUser"]; // dont forget to sanitize any post data
        $users = $search_user->search_users($formData);
    }    

//    $users = $search_user->get_users();

?>

    <div class="container-fluid">
    
        <div class="row">

        <?php include("navigation.php"); ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-4">

                <h1>Search and Filter Users</h1>
                
                <form class="form-inline mb-3" action="search-users.php" method="post">
                    <div class="row g-3 mb-3">
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="username" name="SearchUser[ID]" placeholder="User ID" value="<?php  ?>">
                        </div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="first_name" name="SearchUser[first_name]" placeholder="First Name" value="">
                        </div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="last_name" name="SearchUser[last_name]" placeholder="Last Name" value="">
                        </div>
                    </div>                                      
                    <button type="submit" id="submit" name="submit" class="btn btn-primary">Submit</button>
                </form>

                <?php
                    if( empty($users) )
                        echo '<p>There are no search results to display.</p>';
                ?>

                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">F. Name</th>
                                <th scope="col">F. Name</th>
                                <th scope="col">Sex</th>
                                <th scope="col">DOB</th>
                                <th scope="col">Action</th>
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
                                    echo "<td>$user[DOB]</td>";
                                    echo "<td><a href=\"training-history.php?user=$user[ID]\">Training History</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"race-history.php?user=$user[ID]\">Race History</a></td>";
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
