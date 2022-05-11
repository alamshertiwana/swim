<?php
        session_start();   
        global $page_title;
        $page_title ="Edit User";

        include("head.php");
        
        require_once("config.php");
        require_once("app/class-view-user-front.php");
?>

    <body>
    
    <?php include("header.php"); ?>

<?php

    $parent_id = 0;

    /*Users types that can access the page are Parent of Swimmer, Swimmer themself and an Admin*/
    if( isset( $_SESSION["type"] ) ){

        if( $_SESSION["type"] == "parent" ){
            $parent_id = $_SESSION["ID"];
        }
        else if( $_SESSION["type"] == "swimmer" ){
            
            if( $_SESSION["ID"]!= $_GET["user"] ){
                die("You can only edit your own details");
            }
        
        }
        else if( $_SESSION["type"] != "admin" ){
            die("Not allowed to access this page");
        }        
    }
    else{
        die("Missing SESSION. Please make sure you are logged in before accessing this page");
    }

    $view_user  = new View_User_Front();

    $user= null;

    if( isset($_GET["user"]) ){
        $user_obj = $view_user->get_user_details($_GET["user"]);
        $user_obj = array_pop($user_obj);

        if( !(isset($user_obj)) ){
            die("Not allowed to access user details");
        }
        else if( ($user_obj['PARENT1_ID']== $parent_id || $user_obj['PARENT2_ID']== $parent_id) ){
            $user = $user_obj;
        }
    }
    else{
        die('User ID Missing!');
    }
?>

    <div class="container-fluid">
    
        <div class="row">

        <?php include("navigation.php"); ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-4">

                <h1>View Swimmer</h1>                

                <table class="table table-striped table-sm">
                        
                        <thead>
                            <tr>
                                <th scope="col">Field</th>
                                <th scope="col">Value</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php
                                echo '<tr>';
                                echo "<td>ID</td>";
                                echo "<td>$user[ID]</td>";
                                echo '</tr>';
                                echo '<tr>';
                                echo "<td>Username</td>";
                                echo "<td>$user[USERNAME]</td>";
                                echo '</tr>';
                                echo '<tr>';
                                echo "<td>First Name</td>";
                                echo "<td>$user[FIRST_NAME]</td>";
                                echo '</tr>';
                                echo '<tr>';
                                echo "<td>Last Name</td>";
                                echo "<td>$user[LAST_NAME]</td>";
                                echo '</tr>';
                                echo '<tr>';
                                echo "<td>Email</td>";
                                echo "<td>$user[EMAIL]</td>";
                                echo '</tr>';
                                echo '<tr>';
                                echo "<td>Date of Birth</td>";
                                echo "<td>$user[DOB]</td>";
                                echo '</tr>';
                                echo '<tr>';
                                echo "<td>Telephone</td>";
                                echo "<td>$user[TELEPHONE]</td>";
                                echo '</tr>';
                                echo '<tr>';
                                echo "<td>Address</td>";
                                echo "<td>$user[ADDRESS]</td>";
                                echo '</tr>';
                                echo '<tr>';
                                echo "<td>Postcode</td>";
                                echo "<td>$user[POSTCODE]</td>";
                                echo '</tr>';
                            ?>

                        </tbody>
                    </table>

            </main>

        </div>

    </div>

<?php include("footer.php"); ?>
    </body>
</html>
