<?php   
        session_start();
        global $page_title;
        $page_title ="Add Gala";

        include("head.php");
        
        require_once("config.php");
        require_once("app/class-add-gala-front.php");
?>

    <body>
    
    <?php include("header.php"); ?>

<?php
    if( isset($_POST["submit"]) ){

        $formData           = $_POST["AddGala"];
        $add_gala_front     = new Add_Gala_Front();
        $output             = $add_gala_front->add_gala($formData);
    
    }

?>

    <div class="container-fluid">
    
        <div class="row">

        <?php include("navigation.php"); ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-4">

                <h1>Add Gala</h1>

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

                <form action="add-gala.php" method="post">
                    <div class="form-group mb-3">
                        <label for="first-name">Gala Name</label>
                        <input type="text" class="form-control" id="first-name" name="AddGala[name]" placeholder="Name">
                    </div>
                    <div class="form-group mb-3">
                        <label for="date">Gala Date</label>
                        <input type="date" class="form-control" id="date" name="AddGala[date]">
                    </div>                                          
                    <button type="submit" id="submit" name="submit" class="btn btn-primary">Submit</button>
                </form>

            </main>

        </div>

    </div>

<?php include("footer.php"); ?>
    </body>
</html>
