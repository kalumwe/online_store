<?php 

//use check password class namespace
use PhpSolutions\Authenticate\CheckPassword;
require_once __DIR__ . '/../PhpSolutions/Authenticate/CheckPassword.php';

//create object
$user = new User();
 
//sanitize, validate and filter POST value
$old_password = trim($user->safe($_POST['upass']));
$old_password = filter_var( $old_password, FILTER_SANITIZE_STRING);
$old_password = (filter_var($old_password, FILTER_SANITIZE_STRIPPED));

    if (empty($old_password)) {
        $errors[] = 'You forgot to enter your old password.';
    }


   $u_pass1 = $_POST['upass1'];
   $u_pass2 = $_POST['upass2'];
   
   //call function to sanitize and filter POST values
   $password = $user->validatePassword($u_pass1, $u_pass2, 'upass1', 'upass2');


   //create object and call methods
    $checkPwd = new CheckPassword($u_pass1, 8);
    $checkPwd->requireMixedCase(true);
    $checkPwd->requireNumbers(1);
    $checkPwd->requireSymbols(1);
    if ($checkPwd->check()) {
        $result1 = ['Password OK'];
    } else {
        $result2 = $checkPwd->getErrors();
    }

    //save user id as int value
    $userId = (int) $uid;

  //get errors   
 $errors1 = $user->getErrors();
 $errors = array_merge($errors1, $result2);

 //call function if errors are empty
if (empty($errors)) {
  $change = $user->changePassword($userId, $old_password, $password); 
 }

 //display message if changed
if (($change) && (empty($errors))) { 
  $done = "Your Password has been Changed Successfully";
      echo "
<script type='text/javascript'>
  alert('Your Password has been Changed Successfully');
</script>"; 
      echo "
<script type='text/javascript'>
  window.location.href = 'customer-account.php';
</script>"; 
  } else {
  $errors1 = array_merge($errors, $user->getErrors());
  $errors = array_merge($errors1, $result2);
}


?>