<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Dashboard Template · Bootstrap v5.1</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/dashboard/">

    

    <!-- Bootstrap core CSS -->
<link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="dashboard.css" rel="stylesheet">
  </head>
  <body>
    
<?php include("header.php"); ?>

<div class="container-fluid">
  <div class="row">

  <?php include("navigation.php"); ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
      </div>

      <div class="row">
        
        <div class="col-md-4 mb-3">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Add Parent</h5>
              <p class="card-text">Add a new parent using a form on this page.</p>
              <a href="add-parent.php" class="card-link">Add Parent</a>
            </div>
          </div>      

        </div>
        
        <div class="col-md-4 mb-3">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Add Coach</h5>
              <p class="card-text">Add a new coach using a form on this page.</p>
              <a href="add-coach.php" class="card-link">Add Coach</a>
            </div>
          </div>      

        </div>

        <div class="col-md-4 mb-3">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Add Squad</h5>
              <p class="card-text">Add a new squad using a form on this page.</p>
              <a href="add-squad.php" class="card-link">Add Squad</a>
            </div>
          </div>      

        </div>

        <div class="col-md-4 mb-3">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Register</h5>
              <p class="card-text">Register a new swimmer here.</p>
              <a href="register.php" class="card-link">Register Swimmer</a>
            </div>
          </div>      

        </div>

      </div>
      
    </main>
  </div>
</div>

<?php include("footer.php") ?>
  </body>
</html>
