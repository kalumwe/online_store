<?php
   
/* update cart */ 
   
//set variables to integer values and sanitize
$cartItem = (int) $row['cId'];
$qnty = (int) $_POST['qty_'.$prodId.''];
$size = $user->safe($_POST['size_'.$prodId.'']);

try {

$sql="UPDATE cart_item SET quantity=:qnty, size=:sze WHERE id=:id";
$stmt = $user->db->prepare($sql);
$stmt->bindParam(':qnty', $qnty, PDO::PARAM_INT);
$stmt->bindParam(':id', $cartItem, PDO::PARAM_INT);
$stmt->bindParam(':sze', $size, PDO::PARAM_STR);
$stmt->execute();

//header("Location: http://localhost:8080/online_store/basket.php");
  //  exit;
    echo "
    <script type='text/javascript'>
        window.location.href = './basket.php';
    </script>";
   //header('Refresh: 1');

//$url = $_SERVER['HTTP_REFERER'];


   

    if (isset($stmt)) {
        echo $stmt->errorInfo()[2];
       // $this->errors[] = $stmt->errorInfo()[2];
        //$this->errors[] = "Data cannot be retrieved";
    }
} catch (PDOException $e) {
    echo $e->getMessage();
    //$this->errors[] = "Data can't be retrieved";
    // print "An Exception occurred. Message: " . $e->getMessage();
    //print "The system is busy please again try later";
    // $date = date('m.d.y h:i:s');                
    // $eMessage = $date . " | Exception Error | " , $errormessage . |\n";
    // error_log($eMessage,3,ERROR_LOG);
    // e-mail support person to alert there is a problem
    // error_log("Date/Time: $date - Exception Error, Check error log for
    //details", 1, noone@helpme.com, "Subject: Exception Error \nFrom:
    // Error Log <errorlog@helpme.com>" . "\r\n");

} catch (PDOError $e) {
    echo  $e->getMessage();
    //$this->errors[] = $e->getMessage();
    //$this->errors[] = "Data cannot be retrieved";
    // print "An Error occurred. Message: " . $e->getMessage();
    // print "The system is busy please try later";
    // $date = date('m.d.y h:i:s');        
    // $eMessage = $date . " | Error | " , $errormessage . |\n";
    // error_log($eMessage,3,ERROR_LOG);
    // e-mail support person to alert there is a problem
    // error_log("Date/Time: $date - Error, Check error log for
    //details", 1, noone@helpme.com, "Subject: Error \nFrom: Error Log
    // <errorlog@helpme.com>" . "\r\n");

}

