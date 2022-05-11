<?php
        session_start();   
        global $page_title;
        $page_title ="Assign Parent";

        include("head.php");
        
        require_once("config.php");
        require_once("app/class-assign-parent-front.php");
?>

    <body>
    
    <?php include("header.php"); ?>

<?php

    $assign_parent  = new Assign_Parent_Front();

    if( isset($_POST["submit"]) ){

        if(isset($_POST["AssignParent"])){

            $user_id            = $_GET["user"];
            $formData           = $_POST["AssignParent"];
            $formData           = array_merge($formData, array("user_id"=>$user_id) ); 
            $output             = $assign_parent->assign_parent($formData);
    
        }

        else{
            $output             = $assign_parent->assign_parent(null);
        }
    }

    $user= array();

    if( isset($_GET["user"]) ){
        $user = $assign_parent->get_user_details($_GET["user"]);
        $user = array_pop($user);
    }

    $parents = $assign_parent->get_parents();
?>

    <div class="container-fluid">
    
        <div class="row">

        <?php include("navigation.php"); ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-4">

                <h1>Assign Parent</h1>

                <?php
                    if( isset($output['pass']) && $output['pass']== true ){
                ?>
                <div class="alert alert-success" role="alert">
                    <p class="mb-0"><strong>Success!</strong> The parents were assigned to the user successfully.</p>
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

                <form action="assign-parent.php?user=<?php echo htmlspecialchars($_GET['user']); ?>" method="post">
                    <div class="form-group mb-3">
                        <label for="select-parent-1">Select Parent 1</label>
                        <select id="select-parent-1" name="AssignParent[parent1_id]" class="form-control">
                            <?php
                                if( isset($user['PARENT1_ID']) ){
                                    $id = array_search($user['PARENT1_ID'], array_column($parents, 'ID'));
                                    echo '<option value="'.$user['PARENT1_ID'].'" selected>'.$parents[$id]['FIRST_NAME'].'</option>';
                                }
                                else{
                                    echo "<option disabled selected>Select Parent 1</option>";
                                }
                            ?>
                            <?php 
                                foreach ($parents as $parent) {
                                    $ID         = $parent['ID'];
                                    $name       = $parent['FIRST_NAME'];
                                    echo "<option value=$ID>$ID. $name</option>";
                                }                            
                            ?>                            
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="select-parent-2">Select Parent 2</label>
                        <select id="select-parent-2" name="AssignParent[parent2_id]" class="form-control">
                            <?php
                                if( isset($user['PARENT2_ID']) ){
                                    $id = array_search($user['PARENT2_ID'], array_column($parents, 'ID'));
                                    echo '<option value="'.$user['PARENT2_ID'].'" selected>'.$parents[$id]['FIRST_NAME'].'</option>';
                                }
                                else{
                                    echo "<option disabled selected>Select Parent 2</option>";
                                }
                            ?>
                            <?php 
                                foreach ($parents as $parent) {
                                    $ID         = $parent['ID'];
                                    $name       = $parent['FIRST_NAME'];
                                    echo "<option value=$ID>$ID. $name</option>";
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
