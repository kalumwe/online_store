<?php
   
session_start();

//include file(class) 
include_once '../admin/includes/class.user.php';

//create object
$user = new User();

//redirect to home page if session variable is false
   if (!isset($_SESSION['uid'])) { 
       header("Location: index.php");
       exit();
     }

   $prodId = (int) $_GET['id'];
   $userId = (int) $_SESSION['uid'];    
   //$sessionId = (int) $_SESSION['uid'];

   //$_SESSION['size'] = 
   //$_SESSION['color'] = $user->safe($row['color']);
   //$_SESSION['color'];
    
   //if (isset())
   $done = $user->removeCart($prodId);

   If ($done) {
   $url = $_SERVER['HTTP_REFERER'];
   header("Location: $url");
   } else {
       //echo $user->getErrors();
       
       foreach ($user->getErrors() as $error) {
           echo $error;
       }
      
   }

   


   
?>