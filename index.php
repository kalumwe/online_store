<?php
//ob_start();
session_start();

//define('ERROR_LOG','C:/Temp/logs/errors.log');

 try {

//include file(class)   
include_once 'admin/includes/class.user.php';


//create object
$user = new User();


//save session 'id' in variable if it's set
if (isset($_SESSION[ 'uid'])) {
  $uid = $_SESSION[ 'uid'];
}


//logout if GET 'q' is set
if (isset($_GET['q']))  { 
   $user->user_logout();
   header("location:index.php"); 
} 


//Directory for images
$imageDir = './img/';


// define number of columns in table
define('COLS', 3);

// initialize variables for the horizontal looper
$pos = 0;
$firstRow = true;

// set maximum number of records
define('SHOWMAX', 8);

// prepare SQL to get total records
$getTotal = 'SELECT COUNT(*) FROM product';

// submit query and store result as $totalPix
$total = $user->db->query($getTotal);
$totalPix = $total->fetch()[0];


?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Kalu : e-commerce store</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">

    <!--Include external links-->
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
             <span id="wrong_id" class="text-danger"></span>
            <div class="col-md-10 mx-auto">
              <div id="main-slider" class="owl-carousel owl-theme text-center">
                
                  <div class=" item text-center">
                    <img src="img/carousel-1.jpg" alt="" class="">
                     <!-- <h4 id="" class="text-light text-uppercase font-weight-medium mt-3 text-align-center midtext">10% Off Your First Order</h4>
                        <h3 class="display-4 text-white font-weight-semi-bold mt-4 midtext2">Fashionable Dress</h3>
                          <a href="" class="btn btn-primary py-2 px-3 midbtn">Shop Now</a>-->
                      </div>

                <div class="item">
                    <img src="img/camera.jpg" alt="" class="img-fluid" >
                            <!--<a href="" class="btn btn-primary py-2 px-3 midbtn">Shop Now</a>-->
                      </div>

                <div class="item">
                   <img src="img/watch.jpg" alt="" class="img-fluid" >
                      <!--<h4 id="" class="text-white text-uppercase font-weight-medium mt-3 text-align-center midtext">25% Off Your First Order</h4>
                         <h3 class="display-4 text-white font-weight-semi-bold mt-4 midtext2">Fashionable Watch</h3>
                            <a href="" class="btn btn-primary py-2 px-3 midbtn">Shop Now</a>-->
                  </div>

                
              </div>

              <!-- /#main-slider-->
            </div>
          </div>
        </div>
        <!--
        *** ADVANTAGES HOMEPAGE ***
        _________________________________________________________
        -->
        <div id="advantages">
          <div class="container">
            <div class="row mb-4">
              <div class="col-md-4">
                <div class="box clickable d-flex flex-column justify-content-center mb-0 h-100">
                  <div class="icon"><i class="fa fa-heart"></i></div>
                  <h3><a href="#">We love our customers</a></h3>
                  <p class="mb-0">We are known to provide best possible service ever</p>
                </div>
              </div>
              <div class="col-md-4">
                <div class="box clickable d-flex flex-column justify-content-center mb-0 h-100">
                  <div class="icon"><i class="fa fa-tags"></i></div>
                  <h3><a href="#">Best prices</a></h3>
                  <p class="mb-0">You can check that the height of the boxes adjust when longer text like this one is used in one of them.</p>
                </div>
              </div>
              <div class="col-md-4">
                <div class="box clickable d-flex flex-column justify-content-center mb-0 h-100">
                  <div class="icon"><i class="fa fa-thumbs-up"></i></div>
                  <h3><a href="#">100% satisfaction guaranteed</a></h3>
                  <p class="mb-0">Free returns on everything for 3 months.</p>
                </div>
              </div>
            </div>
            <!-- /.row-->
          </div>
          <!-- /.container-->
        </div>
        <!-- /#advantages-->
        <!-- *** ADVANTAGES END ***-->
        <!--
        *** HOT PRODUCT SLIDESHOW ***
        _________________________________________________________
        -->
        <div id="hot">
          <div class="box py-4">
            <div class="container">
              <div class="row">
                <div class="col-md-12">
                  <h2 class="mb-0 primary">Hot this week</h2>
                </div>
              </div>
            </div>
          </div>
          <div class='container'>
          <div class='product-slider owl-carousel owl-theme'>
          
              <?php 
               //try {
                    

                    //retrieve products data and display records
                     $sql = "SELECT id, title, price, oldPrice, image, sale, new, gift, sold FROM product LEFT JOIN variant
                      ON product.id = variant.productId LIMIT ". SHOWMAX;
                      $result = $user->db->query($sql);
                      
                      //$_SESSION['size'] = $user->safe($row['size']);
                      //$_SESSION['color'] = $user->safe($row['color']);


                   
                    if($result->rowCount() > 0) {
                      while ($row = $result->fetch()) {


                     echo "      
                    
              <div class='item'>
                <div class='product'>
                  <div class='flip-container'>
                    <div class='flipper'>"; 

                        if ( !empty($row['image'])) {
                            $image = $imageDir . basename($row['image']);
                            if (file_exists($image) && is_readable($image)) {
                                $imageSize = getimagesize($image)[3];
                            }
                         if (!empty($imageSize)) { 
                      echo "
                      <div class='front'><a href='detail.php?id=". (int) $row['id'] ."'><img src='" . $image . "' alt='' ". $imageSize ." class='img-fluid'></a></div>
                      <div class='back'><a href='detail.php?id=". (int) $row['id'] ."'><img src='" . $image . "' alt='' ". $imageSize ." class='img-fluid'></a></div>
                    </div>
                  </div><a href='detail.php' class='invisible'><img src='" . $image . "' alt='' ". $imageSize ." class='img-fluid'></a>";
                   }
                   } else {
                     echo "
                    <div class='front'><a href='detail.php?id=". (int) $row['id'] ."' ><img src='' alt=''  class='img-fluid'></a></div>
                    <div class='back'><a href='detail.php?id=". (int) $row['id'] ."'><img src='' alt=''  class='img-fluid'></a></div>
                  </div>
                </div><a href='detail.php?id=". (int) $row['id'] ."' class='invisible'><img src='' alt=''  class='img-fluid'></a>";

                 }
                   echo "
                  <div class='text'>
                    <h3><a href='detail.php?id=". (int) $row['id'] ."'>". $user->safe($row['title']) ."</a></h3>
                    <p class='price'>";
                    if ( (int) $row['oldPrice'] !== 0) {
                      echo "
                      <del>&dollar;". $user->safe($row['oldPrice']) ."</del>";
                    } else { echo "<del></del>";}
                    echo "
                      &dollar;". $user->safe($row['price']) ."
                    </p>
                  </div>";
                  if ( (int) $row['sale'] === 1) {
                    echo "
                    <div class='ribbon sale'>
                    <div class='theribbon'>SALE</div>
                    <div class='ribbon-background'></div>
                  </div>
                    ";
                  } else {
                    echo "<div></div>";
                  }

                  if ( (int) $row['new'] === 1) {
                    echo "
                    <div class='ribbon new'>
                    <div class='theribbon'>NEW</div>
                    <div class='ribbon-background'></div>
                  </div>
                    ";
                  } else {
                    echo "<div></div>";
                  }

                  if ( (int) $row['gift'] === 1) {
                    echo "
                    <div class='ribbon gift'>
                    <div class='theribbon'>GIFT</div>
                    <div class='ribbon-background'></div>
                  </div>
                    ";
                  } else {
                    echo "<div></div>";
                  }

                   
                  if ( (int) $row['sold'] === 1) {
                    echo "
                    <div class='ribbon sold'>
                    <div class='theribbon'>SOLD</div>
                    <div class='ribbon-background'></div>
                  </div>";
                    
                  } else { 
                    echo "<div></div>";
                  }
                  

                  

                  echo "
                 
                </div>
                
              </div>
                  
            
            ";
              
                }
              } else {
                        echo "<p>NO Data Exist</p>";
              } 
             

              }  catch(Exception $e) // We finally handle any problems here
                     {
                     // print "An Exception occurred. Message: " . $e->getMessage();
                     print "The system is busy please try later";
                     ob_end_clean();
                     // $date = date('m.d.y h:i:s');
                      echo $e->getMessage();
                     // $eMessage = $date . " | Exception Error | " , $errormessage . |\n";
                     // error_log($eMessage,3,ERROR_LOG);
                      // e-mail support person to alert there is a problem
                      // error_log("Date/Time: $date - Exception Error, Check error log for
                     //details", 1, noone@helpme.com, "Subject: Exception Error \nFrom:
                     // Error Log <errorlog@helpme.com>" . "\r\n");
                } catch(Error $e) {
                      // print "An Error occurred. Message: " . $e->getMessage();
                      print "The system is busy please try later";
                     // $date = date('m.d.y h:i:s');
                     echo $e->getMessage();
                     // $eMessage = $date . " | Error | " , $errormessage . |\n";
                     // error_log($eMessage,3,ERROR_LOG);
                     // e-mail support person to alert there is a problem
                     // error_log("Date/Time: $date - Error, Check error log for
                     //details", 1, noone@helpme.com, "Subject: Error \nFrom: Error Log
                     // <errorlog@helpme.com>" . "\r\n");
                }
              ?>
              
              </div>
        <!--
        *** GET INSPIRED ***
        _________________________________________________________
        -->
        <div class="container">
          <div class="col-md-12">
            <div class="box slideshow">
              <h3>Get Inspired</h3>
              <p class="lead">Get the inspiration from our world class designers</p>
              <div id="get-inspired" class="owl-carousel owl-theme">
                <div class="item"><a href="#"><img src="img/getinspired1.jpg" alt="Get inspired" class="img-fluid"></a></div>
                <div class="item"><a href="#"><img src="img/getinspired2.jpg" alt="Get inspired" class="img-fluid"></a></div>
                <div class="item"><a href="#"><img src="img/getinspired3.jpg" alt="Get inspired" class="img-fluid"></a></div>
              </div>
            </div>
          </div>
        </div>
        <!-- *** GET INSPIRED END ***-->
        <!--
        *** BLOG HOMEPAGE ***
        _________________________________________________________
        -->
        <div class="box text-center">
          <div class="container">
            <div class="col-md-12">
              <h3 class="text-uppercase">From our blog</h3>
              <p class="lead mb-0">What's new in the world of fashion? <a href="blog.html">Check our blog!</a></p>
            </div>
          </div>
        </div>
        <div class="container">
          <div class="col-md-12">
            <div id="blog-homepage" class="row">
              <div class="col-sm-6">
                <div class="post">
                  <h4><a href="post.html">Fashion now</a></h4>
                  <p class="author-category">By <a href="#">John Slim</a> in <a href="">Fashion and style</a></p>
                  <hr>
                  <p class="intro">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
                  <p class="read-more"><a href="post.html" class="btn btn-primary">Continue reading</a></p>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="post">
                  <h4><a href="post.html">Who is who - example blog post</a></h4>
                  <p class="author-category">By <a href="#">John Slim</a> in <a href="">About Minimal</a></p>
                  <hr>
                  <p class="intro">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
                  <p class="read-more"><a href="post.html" class="btn btn-primary">Continue reading</a></p>
                </div>
              </div>
            </div>
            <!-- /#blog-homepage-->
          </div>
         <!-- /.product-slider-->
         </div>
            <!-- /.container-->
        <!-- *** BLOG HOMEPAGE END ***-->
      </div>
    </div>


    <!--*** include FOOTER ***_________________________________________________________-->
   
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
 <?php 
//ob_end_flush();
?>
