<?php

session_start();

//define('ERROR_LOG','C:/Temp/logs/errors.log');
//include file(class) 
include_once './admin/includes/class.user.php';

//create object
$user = new User();

//redirect to '404' page if session 'uid' is false
if (isset($_SESSION[ 'uid'])) {
  $uid = $_SESSION[ 'uid'];
} else {
  $url = "http://localhost:8080/online_store/404.php";
  header("Location: $url");
}

//redirect to '404' page if get_session() is false
if (!$user->get_session()) { 
  $url = "http://localhost:8080/online_store/404.php";
  header("Location: $url"); 
}


?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Kalu : e-commerce customer orders</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
      
    <!--external links-->
    <?php  include('./includes/external_links.php'); ?>
 
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
                  <li aria-current="page" class="breadcrumb-item active">My orders</li>
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
            <div id="customer-orders" class="col-lg-9">
              <div class="box">
                <h1>My orders</h1>
                <p class="lead">Your orders on one place.</p>
                <p class="text-muted">If you have any questions, please feel free to <a href="contact.html">contact us</a>, our customer service center is working for you 24/7.</p>
                <hr>
                <div class="table-responsive">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>Order</th>
                        <th>Date</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th># 1735</th>
                        <td>22/06/2013</td>
                        <td>$ 150.00</td>
                        <td><span class="badge badge-info">Being prepared</span></td>
                        <td><a href="customer-order.php" class="btn btn-primary btn-sm">View</a></td>
                      </tr>
                      <tr>
                        <th># 1735</th>
                        <td>22/06/2013</td>
                        <td>$ 150.00</td>
                        <td><span class="badge badge-info">Being prepared</span></td>
                        <td><a href="customer-order.html" class="btn btn-primary btn-sm">View</a></td>
                      </tr>
                      <tr>
                        <th># 1735</th>
                        <td>22/06/2013</td>
                        <td>$ 150.00</td>
                        <td><span class="badge badge-success">Received</span></td>
                        <td><a href="customer-order.html" class="btn btn-primary btn-sm">View</a></td>
                      </tr>
                      <tr>
                        <th># 1735</th>
                        <td>22/06/2013</td>
                        <td>$ 150.00</td>
                        <td><span class="badge badge-danger">Cancelled</span></td>
                        <td><a href="customer-order.html" class="btn btn-primary btn-sm">View</a></td>
                      </tr>
                      <tr>
                        <th># 1735</th>
                        <td>22/06/2013</td>
                        <td>$ 150.00</td>
                        <td><span class="badge badge-warning">On hold</span></td>
                        <td><a href="customer-order.html" class="btn btn-primary btn-sm">View</a></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
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