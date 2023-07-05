<?php

//SANITIZE AND VALIDATE POST VALUES
$firstname = $_POST['firstname'];
$firstname = $user->validateFirstname($firstname, 'firstname');

$lastname = $_POST['lastname'];
$lastname = $user->validateLastname($lastname, 'lastname');

$username = $_POST['uname'];
$username = $user->validateUsername($username, 'uname');

$email = $_POST['uemail'];
$email = $user->validateEmail($email, 'uemail');

$address = $_POST['street'];
$address = $user->validateAddress($address, 'street');

$state = $_POST['state'];
$state = $user->validateCityStateCountry($state, 'state');

$country = $_POST['country'];
$country = $user->validateCityStateCountry($country, 'country');

$zip = $_POST['zcode_pcode'];
$zip = $user->validateZipcode($zip, 'zcode_pcode');

$phone = $_POST['phone'];
$phone =  $user->validateTel($phone, 'phone');


$intro = $_POST['intro'];
$intro =  $user->validateIntro($intro, 'intro');


//save user id as int value
$userId = (int) $_POST['uid'];

//get errors
$Errors = $user->getErrors();

//execute sql query to check if username or email exists   
$sql1="SELECT * FROM users WHERE u_name=:username OR email=:uemail";
$stmt1 = $user->db->prepare($sql1);
// bind parameters and insert the details into the database
   $stmt1->bindParam(':username', $username, PDO::PARAM_STR);
   $stmt1->bindParam(':uemail', $email, PDO::PARAM_STR);
   $stmt1->execute();

   if ($stmt1->rowCount() == 1 ) {
       $Error = htmlentities($username) . ' or ' . htmlentities($email) .' is already in use.
       Please choose another username.';
       //return false;
    }


//call user update function if errors are empty
if (empty($Errors)) {
    $update = $user->updateUser($firstname, $lastname, $username, $email, $address, $zip, $state, $country, $phone, $intro, $userId); 
    $url = "http://localhost:8080/online_store/customer-account.php?updated=true";
              header("Location: $url");
              exit;
   
   } else {
    $Errors=$user->getErrors();
   }