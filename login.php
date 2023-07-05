<?php 
session_start(); 
include_once 'admin/includes/class.user.php'; 

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
         // echo "<script>location='./login.php'</script>"; 
          header("location:http://localhost:8080/online_store/index.php");
          session_start();
  
        } else {  
          $errors = array_merge($lgn_errors, $user->getErrors());
          ?>
          <script type="text/javascript">
            document.getElementById('wrongid').innerHTML = 'Wrong email, username Or password';
          </script>
          <?php
          
      
       }
   }


}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Kalu : e-commerce login</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
      
    <!--external links-->
    <?php  include('./includes/external_links.php'); ?>
    <script language="javascript" type="text/javascript" src="js/validate.js"></script>
 
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body>
          

 
 <!--header-->
     <?php  include('./admin/includes/header.php'); ?>
   
 
    <div id="all">
      <div id="content">
        <div class="container">
          <div class="row">
           
            <div class="col-lg-6 mx-auto">
              <div class="box">
                <h1>Login</h1>
                <p class="lead">Already our customer?</p>
                <p class="text-muted">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
                <hr>

                <form action="" method="post" onSubmit="return(submitLogin());" name="login">
                  <div class="form-group">
                    <label for="emailusername">Username or Email</label>
                    <input id="email" type="text" class="form-control" name="emailusername"
                    value = "<?php if (isset($_POST['emailusername'])) echo htmlspecialchars($_POST['emailusername'], ENT_QUOTES); ?>"
                    onBlur = "disappear()">
                    <span class="text-danger" id="error_message1"></span>
                  </div>
                   
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" type="password" class="form-control" name="password"
                    value = "<?php if (isset($_POST['password'])) echo htmlspecialchars($_POST['password'], ENT_QUOTES); ?>"
                    onBlur = "disappear()">
                     <span id="error_message2" class="text-danger"></span>
                  </div>

                 
                  <?php
                if ((!$login) && (!empty($errors))) {
                //print "Wrong username or password";
          //echo "<span class='error text-danger'>Wrong username or password</span>";

         echo '<ul>';
                foreach ($errors as $error) {
                    echo "<li>$error</li>";
                }
                echo '</ul>'; 
                    ?>
                    <script type="text/javascript">
                    document.getElementById("error_message2").innerHTML = "Wrong username or password";
                </script>
                <?php } ?>
                
                  <div class="text-center">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-sign-in"></i> Log in</button>
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


    <!-- JavaScript files-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="vendor/owl.carousel/owl.carousel.min.js"></script>
    <script src="vendor/owl.carousel2.thumbs/owl.carousel2.thumbs.js"></script>
    <script src="js/front.js"></script>
  </body>
</html>