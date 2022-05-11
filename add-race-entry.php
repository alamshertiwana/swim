<?php   
        session_start();
        global $page_title;
        $page_title ="Add Race Entry";

        include("head.php");
        
        require_once("config.php");
        require_once("app/class-add-race-entry-front.php");
?>

    <body>
    
    <?php include("header.php"); ?>

<?php
    
    $add_race_entry_front = new Add_Race_Entry_Front();

    if( isset($_POST["submit"]) ){

        $race_id                    = $_GET["race"];
        $formData                   = $_POST["AddRaceEntry"];
        $formData                   = array_merge($formData, array("race_id"=>$race_id) ); 
        $output                     = $add_race_entry_front->add_race_entry($formData);
    
    }

    $users = $add_race_entry_front->get_users();   

?>

    <div class="container-fluid">
    
        <div class="row">

        <?php include("navigation.php"); ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-4">

                <h1>Add Race Entry</h1>

                <?php
                    if( isset($output['pass']) && $output['pass']== true ){
                ?>
                <div class="alert alert-success" role="alert">
                    <p class="mb-0"><strong>Success!</strong> The data was added successfully.</p>
                </div>
                <?php
                    }
                    elseif( isset($output['pass']) && $output['pass']== false ){
                ?>
                <div class="alert alert-danger" role="alert">
                    <p class="mb-0"><strong>Error!</strong> Please fix the following issues :</p>
                    <ul class="mb-0">
                    <?php
                        foreach ($output['error'] as $message) {
                            echo "<li> $message </li>";
                        }                        
                    ?>
                    </ul>
                </div>
                <?php
                    }
                ?>                

                <form action="add-race-entry.php?race=<?php echo htmlspecialchars($_GET['race']); ?>" method="post">
                    <div class="form-group mb-3">
                        <label for="time">Time (HH:MM:SS.MS)</label>
                        <input type="time" step="0.01" class="form-control" id="time" name="AddRaceEntry[time]" placeholder="Race Name">
                    </div>
                    <div class="form-group mb-3">
                        <label for="adjusted-time">Adjusted Time (HH:MM:SS.MS)</label>
                        <input type="time" step="0.01" class="form-control" id="adjusted-time" name="AddRaceEntry[adjusted_time]" placeholder="Race Name">
                    </div>
                    <div class="form-group mb-3">
                        <label for="users">Select User</label>
                        <select id="users" name="AddRaceEntry[user_id]" class="form-control">
                            <option disabled selected>Select User</option>
                            <?php 
                                foreach ($users as $user) {
                                    $ID             = $user['ID'];
                                    $first_name     = $user['FIRST_NAME'];
                                    $last_name      = $user['FIRST_NAME'];
                                    $username       = $user['USERNAME'];
                                    echo "<option value=$ID>$ID. $first_name $last_name ($username)</option>";
                                }                            
                            ?>                            
                        </select>
                    </div>                     
                    <button type="submit" id="submit" name="submit" class="btn btn-primary">Submit</button>
                </form>

            </main>

        </div>

    </div>

<?php include("footer.php"); ?>
    </body>
</html>
