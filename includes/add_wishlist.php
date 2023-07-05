<?php
   
    session_start();

     //include file(class) 
   include_once '../admin/includes/class.user.php';
    
   //create object
   $user = new User();

   //redirect to homepage if session 'uid' is false
    if (!isset($_SESSION['uid'])) { 
        header("Location: index.php");
        exit();
      }

     
    //set variables to integer values
    $prodId = (int) $_GET['id'];
    $userId = (int) $_SESSION['uid'];    
    //$sessionId = (int) $_SESSION['uid'];

   //call add to wishlist function
    $user->addWishlist($prodId, $userId);
   
    //return to prev page
    $url = $_SERVER['HTTP_REFERER'];
    header("Location: $url");
?>