<?php
//ob_start();

session_start();

//$_SESSION['category'] = true;
//define('ERROR_LOG','C:/Temp/logs/errors.log');

//try {

//include file(class) 
include_once './admin/includes/class.user.php';

//use check password class namespace
use PhpSolutions\Authenticate\CheckPassword;
require_once __DIR__ . '/./admin/PhpSolutions/Authenticate/CheckPassword.php';

//create object
$user = new User();

//intialize variables
$errors = [];
$Errors = [];
$Error = '';
$result2 = [];
//$pass =[];
$change = false;


//redirect to '404' page if session 'uid' is false
if (isset($_SESSION[ 'uid'])  && is_numeric($_SESSION[ 'uid'])) {
  $uid = (int) $_SESSION[ 'uid'];
} else {
  $url = "http://localhost:8080/online_store/404.php";
  header("Location: $url");
}


//redirect to '404' page if get_session() is false
if (!$user->get_session()) { 
  $url = "http://localhost:8080/online_store/404.php";
  header("Location: $url"); 
}

 //retrieve all user records 
$sql="SELECT * FROM users WHERE user_id='$uid'";
$query = $user->db->query($sql);
$row = $query->fetch();

//reqiure file if true
if(isset($_REQUEST[ 'changePass'])) {
  require('./admin/includes/change_user_password.php');
 
}

//reqiure file if true
if(isset($_REQUEST[ 'update'])) {
  require('./admin/includes/change_user_details.php');
 
}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Kalu : e-commerce customer account</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
     
    <!--external links-->
    <?php  include('./includes/external_links.php'); ?>
    <script language="javascript" type="text/javascript" src="js/countries.js"></script>
 
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
            <div class="col-lg-12">
              <!-- breadcrumb-->
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                  <li aria-current="page" class="breadcrumb-item active">My account</li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-3">
              <!--
              *** CUSTOMER MENU ***
              _________________________________________________________
              -->
              <?php  include('./includes/customer_section.php'); ?>
              
              <!-- /.col-lg-3-->
              <!-- *** CUSTOMER MENU END ***-->
            </div>
            <div class="col-lg-9">
              <div class="box">
                <h1>My account</h1>

     <?php   
     //display update message if true        
if (isset($_GET['updated'])) {
    echo " <p class='text-success'>Details Updated Successfully!!</p> ";
}
?>

                <p class="lead">Change your personal details or your password here.</p>
                <p class="text-muted">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
                <h3>Change password</h3>

                <?php
          //$errors1 = array_merge($errors, $img_errors);

          //dispay error messages if exixts
             if (isset($errors) && !empty($errors))  {
               
                echo '<ul class="mt-3">';
                foreach ($errors as $error) {
                    echo "<li class=' text-danger'>$error</li>";
                }
                echo '</ul>';
            }
 
            //display message if true
            if (($change) && (empty($errors))) { 
                echo "<p class='text-success'>$done</p>";
            }
 
?>


                <form action="customer-account.php" method="post" name="change_pass" enctype="multipart/form-data" onSubmit="return(checkPassword());">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="upass">Old password</label>
                        <input id="upass" type="password" class="form-control" name="upass"  id="upass" 
                        value = "<?php if (isset($_POST['upass'])) echo htmlspecialchars($_POST['upass'], ENT_QUOTES); ?>"
                        onBlur = "disappear()"  minlength="8" maxlength="12" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,12}"
                        title="One number, one upper, one lower, one special, with 8 to 12 characters" >
                        <span class="text-danger" id="error_message1"></span>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="upass1">New password</label>
                        <input id="upass1" type="password" class="form-control" name="upass1"  id="upass1" 
                        value = "<?php if (isset($_POST['upass1'])) echo htmlspecialchars($_POST['upass1'], ENT_QUOTES); ?>"
                    onBlur = "disappear()"  minlength="8" maxlength="12" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,12}"
                    title="One number, one upper, one lower, one special, with 8 to 12 characters" 
                    >
                    <span class="text-danger" id="error_message2"><?php  if (isset($result2) && !empty($result2))  {
               
                  echo '<ul class="">';
                   foreach ($result2 as $error) {
                      echo "<li class=' text-danger'>$error</li>";
                   }
                      echo '</ul>';
                 }?></span>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="upass2">Retype new password</label>
                        <input type="password" class="form-control"name="upass2"  id="upass2"
                    value = "<?php if (isset($_POST['upass2'])) echo htmlspecialchars($_POST['upass2'], ENT_QUOTES); ?>"
                    onBlur = "disappear()"  minlength="8" maxlength="12" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,12}"
                     title="One number, one upper, one lower, one special, with 8 to 12 characters" >
                        <span class="text-danger" id="error_message3"></span>
                      </div>
                    </div>
                  </div>
                  <!-- /.row-->
                  <div class="col-md-12 text-center">
                    <button type="submit" name="changePass" class="btn btn-primary"><i class="fa fa-save"></i> Save new password</button>
                  </div>
                </form>
                <h3 class="mt-5">Personal details</h3>
                <?php
          //$errors1 = array_merge($errors, $img_errors);

          //dispay error messages if exixts
             if (isset($Errors) && !empty($Errors))  {
               
                echo '<ul class="mt-3">';
                foreach ($Errors as $error) {
                    echo "<li class=' text-danger'>$error</li>";
                }
                echo '</ul>';
            }
            ?>
                <form action="customer-account.php" method="post" name="update_details" enctype="multipart/form-data" onSubmit="return(updateDetails());">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="firstname">Firstname</label>
                        <input id="firstname" name="firstname" type="text" class="form-control"
                        value = "<?php 
                       if (isset($_POST['firstname'])){ echo htmlspecialchars($_POST['firstname'], ENT_QUOTES);
                       } else {echo $user->safe($row['first_name']); } ?>"
                        onBlur = "disappear()" maxlength="40"
                      pattern="[a-zA-Z][a-zA-Z\s\.]*" 
                      title="Alphabetic and space only max of 30 characters">
                      <span class="text-danger" id="error_message4"></span>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="lastname">Lastname</label>
                        <input type="text" class="form-control" name="lastname" placeholder="Enter last name"
                      value = "<?php 
                       if (isset($_POST['lastname'])) echo htmlspecialchars($_POST['lastname'], ENT_QUOTES);
                        else echo $user->safe($row['last_name']);  ?>"
                      onBlur = "disappear()"  maxlength="40"
                      maxlength="40"  pattern="[a-zA-Z][a-zA-Z\s\-\']*"
                      title="Alphabetic, dash, quote and space only max of 40 characters" >
                      
                      <span class="text-danger" id="error_message5"></span>
                      </div>
                    </div>
                  </div>
                  <!-- /.row-->
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="uname">Username</label>
                        <input id="" type="text" class="form-control" name="uname" placeholder="exmple: kalu"
                        value = "<?php  
                        if (isset($_POST['uname'])) echo htmlspecialchars($_POST['uname'], ENT_QUOTES); 
                        else echo $user->safe($row['u_name']); ?>"
                        onBlur = "disappear(); editCheckUser(this);" maxlength="15"
                        pattern="[a-zA-Z][a-zA-Z\s\.]*"
                        title="Alphabetic and space only max of 30 characters">
                       
                    <span class="text-danger" id="error_message6"><?php if (isset($Error)) { echo $Error;} ?></span>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="street">Street</label>
                        <input type="text" class="form-control" name="street" placeholder=""
                        value = "<?php 
                         if (isset($_POST['street'])) echo htmlspecialchars($_POST['street'], ENT_QUOTES); 
                         else echo $user->safe($row['street']); ?>"
                        onBlur = "disappear()" min="1" max="150"
                        pattern="[a-zA-Z0-9][a-zA-Z0-9\s\.\,\-]*" 
                        title="Alphabetic, period, comma, dash and space only max of 30 characters" 
                        placeholder="Address" maxlength="30" >
                        <span class="text-danger" id="error_message7"></span>
                      </div>
                    </div>
                  </div>
                  <!-- /.row-->
                  <div class="row">
                    <div class="col-md-6 col-lg-3">
                      <div class="form-group">
                        <label for="tel">Telephone</label>
                        <input type="tel" class="form-control" id="phone" name="phone" 
                            placeholder="Phone Number" maxlength="30"
                           value="<?php 
                              if (isset($_POST['phone']))  echo htmlspecialchars($_POST['phone'], ENT_QUOTES); 
                              else  echo $user->safe($row['tel']); ?>" >
                      </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                      <div class="form-group">
                        <label for="zcode_pcode">ZIP</label>
                        <input type="text" class="form-control" id="zcode_pcode" name="zcode_pcode" 
                        pattern="[a-zA-Z0-9][a-zA-Z0-9\s]*" 
                        title="Alphabetic, period and space only max of 30 characters" 
                        placeholder="Zip or Postal Code" minlength="5" maxlength="15" 
                        value="<?php
                         if (isset($_POST['zcode_pcode'])) 
                       echo htmlspecialchars($_POST['zcode_pcode'], ENT_QUOTES); else  echo $user->safe($row['zip']); ?>" >
                       <span class="text-danger" id="error_message8"></span>
                      </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                      <div class="form-group">
                        <label for="state">State</label>
                        <select id="state" name="state" class="form-control">
                             <option selected value="<?php echo $user->safe($row['state']);
                          ?>"><?php echo $user->safe($row['state']);  
                          ?></option>
                          </select>
                          <span class="text-danger" id="error_message9"></span>
                      </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                      <div class="form-group">
                        <label for="country">Country</label>
                        <select id="country" name="country" class="form-control" value="">
                            <option selected value="<?php echo $user->safe($row['country']);
                          ?>"><?php echo $user->safe($row['country']);
                          ?></option>
                          </select>
                          <span class="text-danger" id="error_message10"></span>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="intro">Intro</label>
                        <input id="intro" type="text" name="intro" class="form-control"
                        value="<?php 
                         if (isset($_POST['intro'])) 
                       echo htmlspecialchars($_POST['intro'], ENT_QUOTES); else echo $user->safe($row['intro']);?>" >
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="uemail">Email</label>
                        <input type="email" class="form-control form-control-user" name="uemail" placeholder="example: kalu@gmail.com" 
                        value = "<?php 
                       if (isset($_POST['uemail'])) echo htmlspecialchars($_POST['uemail'], ENT_QUOTES);
                       else echo $user->safe($row['email']); ?>"
                      onBlur = "disappear(); editCheckEmail(this);" maxlength="50">
                     <span class="text-danger" id="error_msg_email"></span>
                      </div>
                    </div>
                    <input name="uid" type="hidden" value="<?= (int) $row['user_id'] ?>">
                    <div class="col-md-12 text-center">
                      <button type="submit" name="update" class="btn btn-primary"><i class="fa fa-save"></i> Save changes</button>
                    </div>
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