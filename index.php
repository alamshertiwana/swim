<?php   
        session_start();
        global $page_title;
        $page_title ="Login";

        include("head.php");
        
        require_once("config.php");
        require_once("app/class-login-front.php");
?>

    <body>
    
    <?php include("header.php"); ?>

<?php
    if( isset($_POST["submit"]) ){

        $formData           = $_POST["Login"];
        $login_front        = new Login_Front();
        $output             = $login_front->login($formData);
    
    }

    if( isset($_SESSION['type']) ){
        header( 'Location: dashboard.php' );        
    }

?>

    <div class="container-fluid">
    
        <div class="row">

            <div class="col-md-2"></div>

            <main class="col-md-8 ms-sm-auto px-md-4 pt-4">

                <h1>Login</h1>

                <?php
                    if( isset($output['pass']) && $output['pass']== true ){
                        header( 'Location: dashboard.php' );
                ?>
                <div class="alert alert-success" role="alert">
                    <p class="mb-0"><strong>Success!</strong></p>
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

                <form action="index.php" method="post">
                    <div class="form-group mb-3">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="Login[username]" placeholder="Username">
                    </div>                    
                    <div class="form-group mb-3">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="Login[password]" placeholder="Password">
                    </div>
                    <div class="form-group mb-3">
                        <label for="user-type">User Type</label>
                        <select id="user-type" name="Login[user_type]" class="form-control">
                            <option disabled selected>Select Your User Type</option>
                            <option value="swimmer">Swimmer</option>
                            <option value="coach">Coach</option>
                            <option value="parent">Parent</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>                                        
                    <button type="submit" id="submit" name="submit" class="btn btn-primary">Submit</button>
                </form>

                <div class="row mt-3">

                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Register Swimmer</h5>
                                <p class="card-text">Register as a Swimmer in the system</p>
                                <a href="register.php" class="card-link">Register Swimmer</a>
                            </div>
                        </div>      
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Register Parent</h5>
                                <p class="card-text">Register as a parent in the system.</p>
                                <a href="add-parent.php" class="card-link">Register Parent</a>
                            </div>
                        </div>      
                    </div>

                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Register Coach</h5>
                                <p class="card-text">Register as a coach in the system</p>
                                <a href="add-coach.php" class="card-link">Register Coach</a>
                            </div>
                        </div>      
                    </div>

                </div>                

            </main>

            <div class="col-md-2"></div>

        </div>

    </div>

<?php include("footer.php"); ?>
    </body>
</html>
