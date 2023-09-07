<?php

//require file(class)
require_once './admin/includes/class.user.php'; 


//use PhpSolutions\Image\ThumbnailUpload;

//use check password class namespace
use PhpSolutions\Authenticate\CheckPassword;
require_once __DIR__ . '/./admin/PhpSolutions/Authenticate/CheckPassword.php';

//create object
$user = new User();

//initialize variables
$result1 = array();
$result2 = array();
$register = false;

//if(isset($_REQUEST[ 'submit'])) 
if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
  //reqiure recaptcha congig file
  require("cap.php");


//SANITIZE AND VALIDATE POST VALUES  

$firstname = $_POST['firstname'];
$firstname = $user->validateFirstname($firstname, 'firstname');

$lastname = $_POST['lastname'];
$lastname = $user->validateLastname($lastname, 'lastname');

$username = $_POST['uname'];
$username = $user->validateUsername($username, 'uname');

$email = $_POST['uemail'];
$email = $user->validateEmail($email, 'uemail');

$u_pass1 = $_POST['upass'];
$u_pass2 = $_POST['upass2'];
$password = $user->validatePassword($u_pass1, $u_pass2, 'upass', 'upass2');

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



//checkpassword object and call methods
    $checkPwd = new CheckPassword($u_pass1, 8);
    $checkPwd->requireMixedCase(true);
    $checkPwd->requireNumbers(1);
    $checkPwd->requireSymbols(1);
    if ($checkPwd->check()) {
        $result1 = ['Password OK'];
    } else {
        $result2 = $checkPwd->getErrors();
    }


 //get errors 
 $errors1 = $user->getErrors();
 $errors = array_merge($errors1, $result2);


 //call function if errors are empty
 if (empty($errors)) {
     $register = $user->registerUser($firstname, $lastname, $username, $email, $password, $address, $zip, $state, $country, $phone);
   }


 //display message if registered
 if (($register) && (empty($errors))) { 
        echo "
<script type='text/javascript'>
    alert('You have been registered Successfully');
</script>"; 
        echo "
<script type='text/javascript'>
    window.location.href = './login.php';
</script>"; 
    } else {
       // echo "
//<script type='text/javascript'>
    //alert('Registration failed! username or email already exists');
//</script>";
//if ($errors) {
    $errors = array_merge($errors1, $result2);
 }
}


?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Kalu : e-commerce register</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
      
    <!--external links-->
    <?php  include('./includes/external_links.php'); ?>
     
    <script language="javascript" type="text/javascript" src="js/validate.js"></script>
    <script language="javascript" type="text/javascript" src="js/countries.js"></script>
    <script language="javascript" type="text/javascript" src="js/citie.js"></script>
    <script language="javascript" type="text/javascript" src="js/check-password-strength.js"></script>
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->

   

<!--verification  when the page loads--
<script  src="https://www.google.com/recaptcha/enterprise.js?render=6LcXCAUnAAAAAL2p1HuUVK6Zo5wkfqpZ6OfSsWmF"></script>
<script>
  grecaptcha.enterprise.ready(async () => {
    const token = await grecaptcha.enterprise.execute('6LcXCAUnAAAAAL2p1HuUVK6Zo5wkfqpZ6OfSsWmF', {action: 'homepage'});
    // IMPORTANT: The 'token' that results from execute is an encrypted response sent by
    // reCAPTCHA Enterprise to the end user's browser.
    // This token must be validated by creating an assessment.
    // See https://cloud.google.com/recaptcha-enterprise/docs/create-assessment
  });
</script>
<--Add reCAPTCHA on an HTML button--
  <script>
   function onSubmit(token) {
     document.getElementById("demo-form").submit();
   }
</script>-->


</head>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>

    
    <!--verification on a user interaction--
    <script src="https://www.google.com/recaptcha/enterprise.js?render=6LcXCAUnAAAAAL2p1HuUVK6Zo5wkfqpZ6OfSsWmF"></script>

   <script>
function onClick(e) {
  e.preventDefault();
  grecaptcha.enterprise.ready(async () => {
    const token = await grecaptcha.enterprise.execute('6LcXCAUnAAAAAL2p1HuUVK6Zo5wkfqpZ6OfSsWmF', {action: 'LOGIN'});
    // IMPORTANT: The 'token' that results from execute is an encrypted response sent by
    // reCAPTCHA Enterprise to the end user's browser.
    // This token must be validated by creating an assessment.
    // See https://cloud.google.com/recaptcha-enterprise/docs/create-assessment
  });
}
</script>-->


  <body>
 
 <!--header-->
     <?php  include('./admin/includes/header.php'); ?>
   
 
    <div id="all">
      <div id="content">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <!-- breadcrumb-->
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li aria-current="page" class="breadcrumb-item active">New account / Sign in</li>
                </ol>
              </nav>

         <?php
              //$errors1 = array_merge($errors, $img_errors);

          //display error messages if exists
             if (isset($errors) && !empty($errors))  {
               
                echo '<ul class="mt-3">';
                foreach ($errors as $error) {
                    echo "<li class=' text-danger'>$error</li>";
                }
                echo '</ul>';
            }
            ?>

            </div>
            <div class="col-lg-10 d-flex align-items-center justify-content-center mx-auto">
              <div class="box">
                <h1>New account</h1>
                <p class="lead">Not our registered customer yet?</p>
                <p>With registration with us new world of fashion, fantastic discounts and much more opens to you! The whole process will not take you more than a minute!</p>
                <p class="text-muted">If you have any questions, please feel free to <a href="contact.php">contact us</a>, our customer service center is working for you 24/7.</p>
                <hr>
                 <form action="register.php" method="post" name="reg" enctype="multipart/form-data" 
            onSubmit="return(submit_reg());">

            <div class="row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                  <div class="form-group">
                    <label for="firstname">First Name*:</label>
                    <input type="text" class="form-control form-control-user" name="firstname" id="firstname" 
                      placeholder="Enter your first name"
                      value = "<?php if (isset($_POST['firstname'])) echo htmlspecialchars($_POST['firstname'], ENT_QUOTES); ?>"
                      onBlur = "disappear()" maxlength="40"
                      pattern="[a-zA-Z][a-zA-Z\s\.]*"  required
                      title="Alphabetic and space only max of 30 characters">
                      <span class="text-danger" id="error_message1"></span>
                   </div>
                  </div>

               <div class="col-sm-6 mb-3 mb-sm-0">
                <div class="form-group">
                    <label for="lastname">Last Name*:</label>
                    <input type="text" class="form-control form-control-user" name="lastname" id="lastname" 
                      placeholder="Enter your last name"
                      value = "<?php if (isset($_POST['lastname'])) echo htmlspecialchars($_POST['lastname'], ENT_QUOTES); ?>"
                      onBlur = "disappear()"  maxlength="40"   required
                      maxlength="40"  pattern="[a-zA-Z][a-zA-Z\s\-\']*"
                      title="Alphabetic, dash, quote and space only max of 40 characters" >
                      <span class="text-danger" id="error_message2"></span>
                </div>
               </div>
            </div>

              <div class="row">
               <div class="col-sm-6  mb-sm-0">
                <div class="form-group">
                    <label for="uname">User Name*:</label>                  
                    <input type="text" class="form-control form-control-user" name="uname" id="uname"
                        placeholder="Enter Username example: kalu"
                        value = "<?php if (isset($_POST['uname'])) echo htmlspecialchars($_POST['uname'], ENT_QUOTES); ?>"
                        onBlur = "disappear(); checkUser(this);" maxlength="15" onchange="checkUser(this)"
                        pattern="[a-zA-Z][a-zA-Z\s\.]*" 
                        title="Alphabetic and space only max of 30 characters">
                    <span class="text-danger" id="error_message3"></span>
                </div>
              </div>
              </div>
       
                <div class="form-group">
                    <label for="uemail">Email*:</label>
                    <input type="email" class="form-control form-control-user" name="uemail"
                      placeholder="Enter email example: kalu@gmail.com" 
                      value = "<?php if (isset($_POST['uemail'])) echo htmlspecialchars($_POST['uemail'], ENT_QUOTES); ?>"
                      onBlur = "disappear()" maxlength="50" onchange="checkEmail(this)">
                    <span class="text-danger" id="error_message4"></span>

                </div>
        
            <div class="row">
              <div class="col-sm-6 mb-sm-0">
                <div class="form-group">
                    <label for="upass">Password*:</label>
                    <input type="text" class="form-control form-control-user" name="upass"  id="upass"
                    placeholder="Enter Password" 
                    value = "<?php if (isset($_POST['upass'])) echo htmlspecialchars($_POST['upass'], ENT_QUOTES); ?>"
                    onBlur = "disappear()"  minlength="8" maxlength="30" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,12}"
                    title="One number, one upper, one lower, one special, with 8 to 12 characters" 
                    onkeyup="checkPasswordStrength(this.value)">                 
                   <span class="text-danger" id="error_message5"><?php
                    //display error messages if exists
                      if (isset($result2) && !empty($result2))  {
               
                      echo '<ul class="">';
                          foreach ($result2 as $error) {
                            echo "<li class=' text-danger'>$error</li>";
               }
                       echo '</ul>';
                     }?>
                     </span>
                    <div id="progressBar"></div>
                    <div class="d-flex">
                    <i id="strengthIcon"></i><span id="passwordStrength"></span></div>
                </div>
              </div>

              <div class="col-sm-6 mb-sm-0">
               <div class="form-group">
                    <label for="upass2">Confirm Password*:</label>
                    <input type="text" class="form-control form-control-user" name="upass2"  id="upass2"
                    placeholder="Confirm Password"
                    value = "<?php if (isset($_POST['upass2'])) echo htmlspecialchars($_POST['upass2'], ENT_QUOTES); ?>"
                    onBlur = "disappear()"  minlength="8" maxlength="12" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,12}"
                     title="One number, one upper, one lower, one special, with 8 to 12 characters" >
                        <span class="text-danger" id="error_message6"></span>
                </div>
               </div>

            </div>

                <div class="form-group">
                    <label for="street">Street*:</label>
                    <input type="text" class="form-control form-control-user" name="street" placeholder="Enter your Address"
                        value = "<?php if (isset($_POST['street'])) echo htmlspecialchars($_POST['street'], ENT_QUOTES); ?>"
                        onBlur = "disappear()" min="1" max="150"
                        pattern="[a-zA-Z0-9][a-zA-Z0-9\s\.\,\-]*" 
                        title="Alphabetic, period, comma, dash and space only max of 30 characters" 
                         maxlength="30" >
                        <span class="text-danger" id="error_message7"></span>
                </div>

                <div class="form-group">
                    <label for="zcode_pcode" class="">Zip/Postal Code*:</label>
                   <div class="col-sm-8 ml-0 pl-0">
                    <input type="text" class="form-control form-control-user" id="zcode_pcode" name="zcode_pcode" 
                        pattern="[a-zA-Z0-9][a-zA-Z0-9\s]*" 
                        title="Alphabetic, period and space only max of 30 characters" 
                        placeholder="Enter Zip or Postal Code" minlength="5" maxlength="15" 
                        value="<?php if (isset($_POST['zcode_pcode'])) 
                       echo htmlspecialchars($_POST['zcode_pcode'], ENT_QUOTES); ?>" >
                       <span class="text-danger" id="error_message8"></span>
                   </div>
                </div>  

               <div class="row">
                <div class="col-md-6 mb-sm-0">
                        <div class="form-group">
                          <label for="state">City*:</label>
                          <select id="state" name="state" class="form-control">
                             <option selected value="<?php 
                       if (isset($_POST['state'])) echo htmlspecialchars($_POST['state'], ENT_QUOTES); ?>">Lusaka</option>
                          </select>
                          <span class="text-danger" id="error_message9"></span>
                        </div>
                      </div>

                      <div class="col-md-6 mb-sm-0">
                        <div class="form-group">
                          <label for="country">Country*:</label>
                          <select id="country" name="country" class="form-control" >
                            <option selected value="<?php 
                       if (isset($_POST['country'])) echo htmlspecialchars($_POST['country'], ENT_QUOTES); ?>">Zambia</option>
                          </select>
                          <span class="text-danger" id="error_message10"></span>
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                       <label for="phone" class="">Telephone:</label>
                       <div class="col-sm-8 ml-0 pl-0">
                       <input type="tel" class="form-control" id="phone" name="phone" 
                            placeholder="Enter your Phone Number" maxlength="30"
                           value="<?php if (isset($_POST['phone']))  echo htmlspecialchars($_POST['phone'], ENT_QUOTES); ?>" >
                        </div>
                      </div>

                     <div class="form-group row">
                      <label class="col-sm-4 col-form-label"></label>
                       <div class="col-sm-8">
                        <div class="g-recaptcha" style="padding-left: 50px;" data-sitekey="6LcXCAUnAAAAAL2p1HuUVK6Zo5wkfqpZ6OfSsWmF"></div>
                       </div>
                      </div>

                      <!--<button class="g-recaptcha"
                          data-callback='onSubmit'
                          data-action='submit'>
                          Submit</button>-->

                  <div class="text-center">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-user-md"></i> Register</button>
                  </div>
                </form>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
     

    <!--*** FOOTER ***_________________________________________________________-->
   
    <?php include('./includes/footer.php'); ?>

    <!-- *** COPYRIGHT END ***--> 

<script>

  //element disappear when you click anywhere on the page
      document.addEventListener('click', function (event) {
        var myDiv = document.getElementById('');
        var targetElement = event.target; // clicked element

        // Check if the clicked element is the div or its child
        var isClickInsideDiv = myDiv.contains(targetElement);

        // If not, hide the div
        if (!isClickInsideDiv) {
          myDiv.style.display = 'none';
        }
      });
    </script>


    <!-- JavaScript files-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="vendor/owl.carousel/owl.carousel.min.js"></script>
    <script src="vendor/owl.carousel2.thumbs/owl.carousel2.thumbs.js"></script>
    <script src="js/front.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
  </body>
</html>