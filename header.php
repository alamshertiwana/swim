<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="index.php">Swimming Gala</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="navbar-nav">
    <div class="nav-item text-nowrap">
      <?php 
        if(isset($_SESSION['type'])){
      ?>
      <a class="nav-link px-3" href="index.php?logout">Sign out</a>
      <?php
        }
      ?>
    </div>
  </div>
</header>
<?php 

if(isset($_GET['logout'])) {
  // clear the session variable, display logged out message
  session_unset();
  session_destroy();
}

?>