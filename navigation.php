<?php

  if(isset($_SESSION['type'])){

    if( $_SESSION['type'] == 'admin' ){
      include('template/navigation-admin.php');
    }
    else if( $_SESSION['type'] == 'coach' ){
      include('template/navigation-coach.php');      
    }
    else if( $_SESSION['type'] == 'parent' ){
      include('template/navigation-parent.php');      
    }
    else if( $_SESSION['type'] == 'user' ){
      include('template/navigation-swimmer.php');      
    }
  
  }
  else{
    echo 'Please login to see navigation <a href="index.php">Login</a>';
  }
  

?>