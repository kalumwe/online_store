<?php
require_once 'class.user.php';


$user = new User();


    // Feedback form handler
    // set the error and thank you pages #1
    $formurl = "feedback_form.php" ;
    $errorurl = "feedback/error.php" ;
    $thankyouurl = "feedback/thankyou.php" ;
    $emailerrurl = "feedback/emailerr.php" ;
    $errormessageurl = "feedback/messageerror.php" ;
    $contacturl = "http://localhost:8080/online_store/contact.php";
    // set to the email address of the recipient
    $mailto = "kalumwe@icloud.com" ;
    $currentPage = basename($_SERVER['SCRIPT_FILENAME']);

    // Is first name present? If it is, sanitize it #2
    $firstname = $_POST['firstname'];
    if ($user->validateFirstname($firstname, 'firstname')) {
        $first_name = $firstname;
    } else {  
        $errors = 'yes';
    } 
    
    //Is the last name present? If it is, sanitize it
     $lastname = $_POST['lastname'];
     if ($user->validateLastname($lastname, 'lastname')) {
        $last_name = $lastname;
     } else {  
        $errors = 'yes';
     } 


    
    // Check for an email address:   
     $email = $_POST['email'];
     if (!$user->validateEmail($email, 'email')) {
        // if email is bad display error page
       header( "Location: $contacturl" );
       exit ;
     } else {
        $uemail = $email;
     }

     $subject = $_POST['subject'];
     if ($user->validateSubject($subject, 'subject')) {
        $subJect = $subject;
     //} else if (($last_name) || ($first_name)) {
       // $subJect = "Message from ". $first_name." ". $last_name;
     } else {
        $errors = 'yes';
     }
        
    
    

    /*$message =  $_POST['message']; //#5
    if ($user->validateMessage($message, 'message')) {
       $msg = $message;
    } else { // if message not valid display error page
        header( "Location: $errormessageurl" );
        exit;
    }*/

     $message = filter_var( $_POST['message'], FILTER_SANITIZE_STRING); //#5
    if ((!empty($message)) && (strlen($message) <= 480)) {
       // remove ability to create link in email
       $patterns = array("/http/", "/https/", "/\:/","/\/\//","/www./");
       $msg = preg_replace($patterns," ", $message);
       } else { // if message not valid display error page
        header( "Location: $errormessageurl" );
        exit;
    }



   //$mailSent = false;

    if (!empty($errors)) { // if errors display error page
        header( "Location: $errorurl" );
        exit ; 
    }



    // everything OK send e-mail #6
    //$subject = "Message from customer " . $first_name . " " . $last_name. " \n";
    $messageproper =
    "------------------------------------------------------------\n" .
    "Name of sender: $first_name $last_name\n" .
    "Email of sender: $uemail\n" .
    //"Telephone: $phonetrim\n" .
    //"brochure?: $brochure\n" .
    //"Address: $address1trim\n" .
    //"Address: $address2trim\n" .
    //"City: $citytrim\n" .
    //"Postcode: $zcode_pcodetrim\n" .
    //"Newsletter?:$letter\n" .
    "------------------------- MESSAGE -------------------------\n\n" .
    $msg .
    "\n\n------------------------------------------------------------\n" ;

    $mailSent = mail($mailto, $subJect, $messageproper, "From: \"$first_name $last_name\" <$email>" );

    if ($mailSent) {
    header( "Location: $thankyouurl" );
    exit ;
    }

    if (!$mailSent) {
       echo "<script type='text/javascript'>
              alert('email couldn't be sent.);
         </script>";
        //echo " <script type='text/javascript'>
       // window.location.href = '../admin.php';
       // </script>";
         
         echo "email couldn't be sent.";
    ?>
        <meta http-equiv="refresh" content="2;url=http://localhost:8080/online_store/index.php" />
        <?php
    }
    
?>