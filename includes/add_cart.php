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
    $sessionId = (int) $_SESSION['uid'];
    

    //retrieve cart info for display
    $sql = "SELECT * FROM product LEFT JOIN variant
    ON product.id = variant.productId WHERE product.id = :prodid ";
    $stmt = $user->db->prepare($sql);
    $stmt->bindParam(':prodid', $prodId, PDO::PARAM_INT);
     $result = $stmt->execute();
    //$result = $user->db->query($sql);
    $row = $stmt->fetch();

    //set size value
    if (isset($_POST['size'])) {
        $size = $user->safe($_POST['size']);
    } else {
        $size =  $user->safe($row['size']);
    }
    

    //set quantity value
    if(isset($_POST['qnty'])) { 
    $qnty = (int) $_POST['qnty'];
    } else {
        $qnty = 1; 
    }

    //set color value
    $color = $user->safe($row['color']);
   

    //call add to cart function
    $user->addCart($prodId, $userId, $sessionId, $size, $color, $qnty);
   
    //return to prev page
    $url = $_SERVER['HTTP_REFERER'];
    header("Location: $url");
?>