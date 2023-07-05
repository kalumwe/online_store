  <?php



//include '../includes/title.php';
  //$mailSent = false;

// check if the form has been submitted
if(isset($_REQUEST[ 'subscribe'])) { 
   
    //require './admin/includes/feedback-handler.php';
     // Check for an email address: 
     $emailerrurl = "feedback/emailerr.php" ;
     $mailto = "kalumwe@icloud.com" ;
     
     $email = $_POST['email'];
     if (!$user->validateEmail($email, 'email')) {
        // if email is bad display error page
       header( "Location: $emailerrurl" );
       exit ;
     } else {
        $uemail = $email;
     }

    // everything OK send e-mail #6
    $subject = "Message from customer " . $uemail;
    $messageproper = "Email of sender: $uemail\n";

    $mailSent = mail($mailto, $subject, $messageproper, "From: <$uemail>" ); 

    if ($mailSent) {
        //header('Location: http://localhost:8080/phpsols/gallery/thank_you.php');
        //exit;
        echo "<script type='text/javascript'>
        alert('Thank you for signing up!');
       </script>";
   //$sent ="Thank you for signing up";
    } else {
      
      echo "<script type='text/javascript'>
        document.getElementById('err').innerHTML = 'Email couldn't be sent!.';
         alert('email couldn't be sent!');


       </script>";
    }
} 
?>


  <div id="footer">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-md-6">
            <h4 class="mb-3">Pages</h4>
            <ul class="list-unstyled">
              <li><a href="text.php">About us</a></li>
              <li><a href="text.php">Terms and conditions</a></li>
              <li><a href="faq.php">FAQ</a></li>
              <li><a href="contact.php">Contact us</a></li>
            </ul>
            <hr>
            <h4 class="mb-3">User section</h4>
            <ul class="list-unstyled">
        
               <?php if(isset($_SESSION['uid'])) {  ?>
              <li><a href="index.php?q=logout">Logout</a></li>
                <?php } else { ?>
              <li class=""><a href="admin/login.php" data-toggle="modal" data-target="#login-modal">Login</a></li>
                <?php } ?>

                <?php if(isset($_SESSION['uid'])) {  ?>
                <li class=" d-none"><a href="register.php" class="d-none"></a></li>
                 <?php  } else { ?>
                        <li><a href="register.php">Register</a></li>
                <?php } ?>
            </ul>
          </div>
          <!-- /.col-lg-3-->
          <div class="col-lg-3 col-md-6">
            <h4 class="mb-3">Top categories</h4>
            <h5>Men</h5>
            <ul class="list-unstyled">
              <li class="nav-item"><a href="category.php?men-t-shirt" class="">T-shirts</a></li>
                          <li class=""><a href="category.php?men-shirt" class="">Shirts</a></li>
                          <li class=""><a href="category.php?men-pants" class="">Pants</a></li>
                          <li class=""><a href="category.php?men-accessories" class="">Accessories</a></li>
            </ul>
            <h5>Ladies</h5>
            <ul class="list-unstyled">
              <li class="nav-item"><a href="category.php?ladies-t-shirt" class="">T-shirts</a></li>
                          <li class="nav-item"><a href="category.php?ladies-shirt" class="">Shirts</a></li>
                          <li class="nav-item"><a href="category.php?ladies-pants" class="">Pants</a></li>
                          <li class="nav-item"><a href="category.php?ladies-dresses" class="">Dresses</a></li>
                          <li class="nav-item"><a href="category.php?ladies-accessories" class="">Accessories</a></li>
            </ul>
          </div>
          <!-- /.col-lg-3-->
          <div class="col-lg-3 col-md-6">
            <h4 class="mb-3">Where to find us</h4>
            <p><strong>Obaju Ltd.</strong><br>13/25 New Avenue<br>New Heaven<br>45Y 73J<br>England<br><strong>Great Britain</strong></p><a href="contact.php">Go to contact page</a>
            <hr class="d-block d-md-none">
          </div>
          <!-- /.col-lg-3-->
          <div class="col-lg-3 col-md-6">
            <h4 class="mb-3">Get the news</h4>
            <p class="text-muted">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
            <form action="index.php" method="post" name="subscribe" id="subscribe">
              <div class="input-group">
                <input type="text" class="form-control" name="email" id="email" onBlur="disppearSub()"><span class="input-group-append">
                  <button type="submit" name="subscribe" class="btn btn-outline-secondary" onclick="return(submitreg3());">Subscribe!</button></span>       </div>
              <!-- /input-group-->
            </form>
            <span id='err' class='text-danger'></span>

            <?php if (isset($_REQUEST[ 'subscribe']) && (!$mailSent)) { ?>
              <script type='text/javascript'>
                //document.getElementById('err').innerHTML = "Sorry, your mail could not be sent. Please try later.";
                alert("Sorry, your mail could not be sent. Please try later.");
             </script>

        <!--<p class="text-warning">Sorry, your mail could not be sent. Please try later.</p>-->
        <?php } elseif (isset($_REQUEST[ 'subscribe']) && $errors) {
             ?>
        <p class="warning">Please make sure that your input is correct.</p>
        <?php } ?>

            <hr>
            <h4 class="mb-3">Stay in touch</h4>
            <p class="social"><a href="#" class="facebook external"><i class="fa fa-facebook"></i></a><a href="#" class="twitter external"><i class="fa fa-twitter"></i></a><a href="#" class="instagram external"><i class="fa fa-instagram"></i></a><a href="#" class="gplus external"><i class="fa fa-google-plus"></i></a><a href="#" class="email external"><i class="fa fa-envelope"></i></a></p>
          </div>
          <!-- /.col-lg-3-->
        </div>
        <!-- /.row-->
      </div>
      <!-- /.container-->
    </div>
    <!--
    *** COPYRIGHT ***
    FOOTER
    __________________________________________________________-->

 <!-- /#footer-->
    <!-- *** FOOTER END ***-->
    
    
    <!--
    *** COPYRIGHT ***
    _________________________________________________________
    -->
    <div id="copyright">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 mb-2 mb-lg-0 d-flex align-items-center justify-content-center">
            <p class="text-center text-lg-left mx-auto ">©2023 Kalu.</p>
          </div>
          </div>
        </div>
      </div>
    </div>
    <!-- *** COPYRIGHT END ***-->


   