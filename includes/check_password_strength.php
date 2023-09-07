<?php
//include file(class)   
include_once '../admin/includes/class.user.php';

//create object
$user = new User();

$password = $user->safe($_POST['password']);

$strength = calculatePasswordStrength($password);
echo $strength;

function calculatePasswordStrength($password) {
  // Implement password strength calculation logic 
  // Return a strength value between 0 and 100
}
?>
