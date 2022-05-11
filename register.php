<?php   
        global $page_title;
        $page_title ="Register";

        include("head.php");
        
        require_once("config.php");
        require_once("app/class-register-front.php");
?>

    <body>
    
    <?php include("header.php"); ?>

<?php
    if( isset($_POST["submit"]) ){

        $formData           = $_POST["RegisterForm"]; 
        $register_front     = new Register_Front();
        $output             = $register_front->register_user($formData);

    }
?>

    <div class="container-fluid">
    
        <div class="row">

        <?php include("navigation.php"); ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-4">

                <h2>Register Swimmer</h2>

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

                <form action="register.php" method="post">
                    <div class="form-group mb-3">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="RegisterForm[username]" placeholder="Username">
                    </div>                    
                    <div class="form-group mb-3">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="RegisterForm[password]" placeholder="Password">
                    </div>
                    <div class="form-group mb-3">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" name="RegisterForm[email]" placeholder="Enter email">
                    </div>
                    <div class="form-group mb-3">
                        <label for="first-name">First Name</label>
                        <input type="text" class="form-control" id="first-name" name="RegisterForm[first_name]" placeholder="First Name">
                    </div>                      
                    <div class="form-group mb-3">
                        <label for="last-name">Last Name</label>
                        <input type="text" class="form-control" id="last-name" name="RegisterForm[last_name]" placeholder="Last Name">
                    </div>
                    <div class="form-group mb-3">
                        <label for="gender">Gender</label>
                        <select id="gender" name="RegisterForm[sex]" class="form-control">
                            <option disabled selected>Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>                    
                    <div class="form-group mb-3">
                        <label for="date">Date of Birth</label>
                        <input type="date" class="form-control" id="date" name="RegisterForm[dob]">
                    </div>                    
                    <div class="form-group mb-3">
                        <label for="telephone">Telephone Number</label>
                        <input type="text" class="form-control" id="telephone" name="RegisterForm[telephone]" pattern="[0-9]{11}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" name="RegisterForm[address]" placeholder="Address">
                    </div>
                    <div class="form-group mb-3">
                        <label for="postcode">Postcode</label>
                        <input type="text" class="form-control" id="postcode" name="RegisterForm[postcode]" placeholder="Postcode">
                    </div>                    
                    <button type="submit" id="submit" name="submit" class="btn btn-primary">Submit</button>
                </form>

            </main>

        </div>

    </div>


    <?php include("footer.php") ?>
    </body>
</html>
