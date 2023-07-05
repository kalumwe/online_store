<?php 
session_start(); 
include_once 'includes/class.user.php'; 

$user = new User(); 

$lgn_errors = array();
$login = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

 $u_name = trim($user->safe($_POST['emailusername']));	
    if ((!empty($u_name)) &&
        (strlen($u_name) <= 50))  {				
        //Sanitize the trimmed first name
        $u_name = filter_var( $_POST['emailusername'], FILTER_SANITIZE_STRING);
        $u_name = filter_var($u_name, FILTER_SANITIZE_STRIPPED);
        //$u_name =  filter_var( $_POST['emailusername'], FILTER_SANITIZE_EMAIL);		
    } else {	
        $lgn_errors[] = 'Only alphanumeric characters, hyphens, and underscores are permitted in username';
    }

    $u_pass = trim($user->safe($_POST['password']));
    if ((empty($u_pass)) || (!preg_match( '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$@!%&*?])[A-Za-z\d#$@!%&*?]{8,12}$/', $u_pass))) {
        $lgn_errors[] = 'Invalid password, 8 to 12 chars, one upper, one lower, one number, one special.'; 
    } else {
        $u_pass = filter_var( $_POST['password'], FILTER_SANITIZE_STRING);
        $u_pass = (filter_var($u_pass, FILTER_SANITIZE_STRIPPED));
   
    }

    $errors = array_merge($lgn_errors, $user->getErrors());

    if (empty($errors)) {
       $login = $user->check_login($u_name, $u_pass);


       if (($login) && (empty($errors))) { 
         // echo "<script>location='./login.php' 
          header("location:http://localhost:8080/online_store/index.php");
          session_start();
  
        } else {  
          $errors = array_merge($lgn_errors, $user->getErrors());
          //print "Wrong username or password";
          
          //echo "<span class='error text-danger'>Wrong username or password</span>";
        // echo '<ul>';
                foreach ($errors as $error) {
                    echo "<script> 
          document.getElementById('wrong_id').innerHTML = ". $error .";
          </script>";
                }
                //echo '</ul>';

              /*  $key = 'Trav3lw@rldwitTh@nd33';
               $sql = "SELECT AES_DECRYPT(pass, '$key') AS pass FROM users WHERE u_name = '$u_name'";
               $query = $user->db->query($sql);
               $row = $query->fetch();
               echo '<ul>';
                foreach ($row as $result) {
                    echo "<li>$result</li>";
                }
                echo '</ul>';*/

      
       }
   }


}