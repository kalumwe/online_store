<?php
//ob_start();
session_start();
//$_SESSION['category'] = true;
//define('ERROR_LOG','C:/Temp/logs/errors.log');

//try {
include_once './admin/includes/class.user.php';

$user = new User();


if (isset($_SESSION[ 'uid'])) {
  $uid = $_SESSION[ 'uid'];
} 


?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Kalu : e-commerce checkout 2</title>
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
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li aria-current="page" class="breadcrumb-item active">Checkout - Delivery method</li>
                </ol>
              </nav>
            </div>
            <div id="checkout" class="col-lg-9">
              <div class="box">
                <form method="get" action="checkout3.html">
                  <h1>Checkout - Delivery method</h1>
                  <div class="nav flex-column flex-sm-row nav-pills"><a href="checkout1.html" class="nav-link flex-sm-fill text-sm-center"> <i class="fa fa-map-marker">                  </i>Address</a><a href="checkout2.html" class="nav-link flex-sm-fill text-sm-center active"> <i class="fa fa-truck">                       </i>Delivery Method</a><a href="#" class="nav-link flex-sm-fill text-sm-center disabled"> <i class="fa fa-money">                      </i>Payment Method</a><a href="#" class="nav-link flex-sm-fill text-sm-center disabled"> <i class="fa fa-eye">                     </i>Order Review</a></div>
                  <div class="content py-3">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="box shipping-method">
                          <h4>USPS Next Day</h4>
                          <p>Get it right on next day - fastest option possible.</p>
                          <div class="box-footer text-center">
                            <input type="radio" name="delivery" value="delivery1">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="box shipping-method">
                          <h4>USPS Next Day</h4>
                          <p>Get it right on next day - fastest option possible.</p>
                          <div class="box-footer text-center">
                            <input type="radio" name="delivery" value="delivery2">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="box shipping-method">
                          <h4>USPS Next Day</h4>
                          <p>Get it right on next day - fastest option possible.</p>
                          <div class="box-footer text-center">
                            <input type="radio" name="delivery" value="delivery3">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="box-footer d-flex justify-content-between"><a href="checkout1.html" class="btn btn-outline-secondary"><i class="fa fa-chevron-left"></i>Back to address</a>
                    <button type="submit" class="btn btn-primary">Continue to Payment Method<i class="fa fa-chevron-right"></i></button>
                  </div>
                </form>
              </div>
              <!-- /.box-->
            </div>
            <!-- /.col-md-9-->
            <div class="col-md-3">
              <div id="order-summary" class="card">
                <div class="card-header">
                  <h3 class="mt-4 mb-4">Order summary</h3>
                </div>
                <div class="card-body">
                  <p class="text-muted">Shipping and additional costs are calculated based on the values you have entered.</p>
                  <div class="table-responsive">
                    <table class="table">
                      <tbody>
                        <tr>
                          <td>Order subtotal</td>
                          <th>$446.00</th>
                        </tr>
                        <tr>
                          <td>Shipping and handling</td>
                          <th>$10.00</th>
                        </tr>
                        <tr>
                          <td>Tax</td>
                          <th>$0.00</th>
                        </tr>
                        <tr class="total">
                          <td>Total</td>
                          <th>$456.00</th>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.col-md-3-->
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