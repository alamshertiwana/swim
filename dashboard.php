<?php
  session_start();

  if( isset($_SESSION['type']) ){
  }
  else{
    die('Please login access the dashboard');
  }

?>
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
        
        <div class="col-md-6 mb-3">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Search & Filters</h5>
              <p class="card-text">Use to search and filter feature. You can search using User ID, First Name or Last Name. Then you can further check the users Training or Race data. By default when you open the Search page it will be empty. This is by design.</p>
              <a href="search-users.php" class="card-link">Search & Filter</a>
            </div>
          </div>      

        </div>

        <div class="col-md-6 mb-3">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">View Gala</h5>
              <p class="card-text">View Gala the list of all the Galas. You can then further check all the Races in each Gala. You can check the results for each Race.</p>
              <a href="view-gala.php" class="card-link">View Gala</a>
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
