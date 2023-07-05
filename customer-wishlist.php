<?php
//ob_start();
session_start();
//$_SESSION['category'] = true;
//define('ERROR_LOG','C:/Temp/logs/errors.log');

try {

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

//images directory
$imageDir = './img/';


// define number of columns in table
define('COLS', 3);

// initialize variables for the horizontal looper
$pos = 0;
$firstRow = true;
$startRow = 0;
$totalPix = false;
//$TotalMen = false;
//$TotalWomen = false;

// set maximum number of records
define('SHOWMAX', 12);


//total records
$searchTotal =  "SELECT COUNT(*) FROM product as i INNER JOIN wishlist as j ON i.id=j.productId 
INNER JOIN variant as k ON k.productId=i.id  WHERE j.userId='$uid'";
// submit query and store result as $totalPix
$total = $user->db->query($searchTotal);
$totalSrch = $total->fetch()[0]; 


// set the current page (401)
$curPage = (isset ($_GET['curPage'])) ? (int) $_GET['curPage'] : 0;
$curPage = $user->safe($curPage);

// calculate the start row of the subset
$startRow = $curPage * SHOWMAX;
$pages = ceil ($totalSrch/SHOWMAX);
if ($startRow > $totalSrch) {    //(401)
   $startRow = 0;
   $curPage = 0;
}

if ($curPage >= $pages) {
	$startRow = 0;
    $curPage = 0;
}

?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Kalu : e-commerce customer wishlist</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css">
    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700">
    <!-- owl carousel-->
    <link rel="stylesheet" href="vendor/owl.carousel/assets/owl.carousel.css">
    <link rel="stylesheet" href="vendor/owl.carousel/assets/owl.theme.default.css">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="favicon.png">
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
                  <li aria-current="page" class="breadcrumb-item active">My wishlist</li>
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
            <div id="wishlist" class="col-lg-9">
              <ul class="breadcrumb">
                <li><a href="index.php">Home </a></li>
                <li>&nbsp;/ wishlist</li>
              </ul>
              <div class="box">
                <h1>My wishlist</h1>
                <p class="lead">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
              </div>

              <?php
               $sql="SELECT  i.id AS pId, i.discount AS disc, title, price, oldPrice, image, sale, new, gift, sold FROM product as i INNER JOIN wishlist as j ON i.id=j.productId 
                    INNER JOIN variant as k ON k.productId=i.id  WHERE j.userId='$uid' ORDER BY j.added DESC LIMIT $startRow,". SHOWMAX;

                      $result = $user->db->query($sql);
                      ?>
              <div class="row products">
              <?php 
              if ($result) {
            //if(mysqli_num_rows($result) > 0) {
                if ($result->rowCount() > 0) {
                  while($row = $result->fetch()) {
                    

                    if ($pos++ % COLS === 0 && !$firstRow) {
                        echo "</div><div class='row products'>";
    
                     } ?>

                 <div class="col-lg-3 col-md-4">
                  <div class="product">
                    <div class="flip-container">
                      <div class="flipper">
                        <?php 
                         if ( !empty($row['image'])) {
                          $image = $imageDir . basename($row['image']);
                          if (file_exists($image) && is_readable($image)) {
                              $imageSize = getimagesize($image)[3];
                          }
                       if (!empty($imageSize)) { 
                        ?>
                        <div class="front"><a href="detail.php?id=<?= (int) $row['pId'] ?>"><img src="<?= $image ?>" alt="" <?= $imageSize ?> class="img-fluid"></a></div>
                        <div class="back"><a href="detail.php?id=<?= (int) $row['pId'] ?>"><img src="<?= $image ?>" alt="" <?= $imageSize ?> class="img-fluid"></a></div>
                      </div>
                    </div><a href="detail.php?id=<?= (int) $row['pId'] ?>" class="invisible"><img src="<?= $image ?>" alt="" <?= $imageSize ?> class="img-fluid"></a>
                    <?php } } else { ?>
                      <div class='front'><a href='detail.php?id=<?= (int) $row['pId'] ?>'><img src='' alt=''  class='img-fluid'></a></div>
                    <div class='back'><a href='detail.php?id=<?= (int) $row['pId'] ?>'><img src='' alt=''  class='img-fluid'></a></div>
                  </div>
                </div><a href='detail.php?id=<?= (int) $row['pId'] ?>' class='invisible'><img src='' alt=''  class='img-fluid'></a>
                <?php } ?>

                    <div class="text">
                      <h3><a href="detail.php?id=<?= (int) $row['pId'] ?>"><?= $user->safe($row['title']) ?></a></h3>

                      <p class="price">
                      <?php  if ( (int) $row['oldPrice'] !== 0) { ?> 
                        <del>&dollar;<?= $user->safe($row['oldPrice']) ?></del>
                        <?php } else { echo "<del></del>";} ?>
                        &dollar;<?= $user->safe($row['price']) ?>
                        <?php  if ($user->safe($row['disc']) !== '0') { ?>
                         <span class="text-small text-success ml-2"> 
                          <?php
                        
                        echo "(". $user->safe($row['disc'])."% off)";
                      ?></span> <?php } else {  echo "";} ?>
                      </p>
                      
                      <p class="buttons">
                      <?php if(isset($_SESSION['uid'])) {  ?>
                        <?php if ($user->checkIfAddedToCart((int) $row['pId'], $_SESSION['uid'])) { ?>
                          <a href="basket.php" class="btn btn-outline-primary px-3">                       
                       </i>Added to cart</a>
                        <?php } else { ?>
                      <a href="includes/add_cart.php?id=<?= (int) $row['pId'] ?>" class="btn btn-primary">                       
                        <i class="fa fa-shopping-cart"></i>Add to cart</a>
                        <?php } ?>

                        <a href="includes/remove_wishlist.php?id=<?= (int) $row['pId'] ?>" class="btn btn-outline-secondary px-4 mx-0"><i class="fa fa-trash-o "></i>Remove</a>
                     
                        
                        

                        <?php } else { ?>
                          <a href="detail.php?id=<?= (int) $row['pId'] ?>" class="btn btn-outline-secondary">View detail</a>
                          <a href="checkout1.php" class="btn btn-primary">
                           <i class="fa fa-shopping-cart"></i>Buy now</a></p>

                       <?php  } ?>
                    </div>
                    <!-- /.text-->
                    <?php
                    if ( (int) $row['sale'] === 1) { ?>
                    
                    <div class='ribbon sale'>
                    <div class='theribbon'>SALE</div>
                    <div class='ribbon-background'></div>
                  </div>
                    <?php
                  } else { ?>
                    <div></div>
                 <?php } ?>

                 <?php
                  if ( (int) $row['new'] === 1) {
                  ?>
                    <div class='ribbon new'>
                    <div class='theribbon'>NEW</div>
                    <div class='ribbon-background'></div>
                  </div>
                    <?php
                  } else { ?>
                    <div></div>
                  <?php } ?>


                 <?php 
                  if ( (int) $row['gift'] === 1) {
                    ?>
                    <div class='ribbon gift'>
                    <div class='theribbon'>GIFT</div>
                    <div class='ribbon-background'></div>
                  </div>
                    <?php
                  } else { ?>
                    <div></div>
                  <?php }  ?>


                  <?php 
                  if ( (int) $row['sold'] === 1) {
                    ?>
                    <div class='ribbon sold'>
                    <div class='theribbon'>SOLD</div>
                    <div class='ribbon-background'></div>
                  </div>
                    <?php
                  } else { ?>
                    <div></div>
                  <?php }  ?>

                  <!-- /.ribbon-->

                  </div>
                  <!-- /.product            -->
                </div>

                <?php
                  }
                
              
          } else {
                 echo "<p class='mx-auto'>NO Records found! </p>";
        } 

      } else {
        echo "<p>Cannot connect to server  </p> ";
    } 
  }  catch(Exception $e) // We finally handle any problems here
  {
  // print "An Exception occurred. Message: " . $e->getMessage();
  print "The system is busy please try later";
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


/*
      if (COLS-2 > 0) {
        for ($i = 0; $i < COLS-2; $i++) {
             echo '<div class="col-md-7"></div>';
        }
     }    */



?>
                <!-- /.products-->
              </div>

              <div class="pages">
                <?php if ($totalSrch >= 40) { ?>
                
                
                  <!--PAGINATION NAV LINKS-->
                <nav aria-label="Page navigation example" class="d-flex justify-content-center">
                  <ul class="pagination">
                    <li class="page-item">
                        
                      <?php if ($curPage > 0) { ?>
                      <a href="customer-wishlist.php?curPage=<?= $curPage -1 ?>" aria-label="Previous" class="page-link"><span aria-hidden="true">«</span><span class="sr-only">Previous</span></a></li>
                     <?php  } else {
                          // otherwise leave the cell empty
                             echo '&nbsp;';
                            } ?>
                    
                    <?php 
                            for ($i = 1; $i <= $pages; $i++) {
                    if ($i == $curPage) {
            
                    echo '
                    <li class="page-item"><a class="page-link " href="customer-wishlist.php?curPage=' . $i-1 . '">' . $i . '</a></li>';
                   } else {
                    echo '
                  
                  <li class="page-item ';  if ($i == $curPage + 1) { echo " active "; } echo'">
                  <a class="page-link" href="customer-wishlist.php?curPage=' . $i-1 . '">' . $i . '</a></li>';
                   }
                }
                ?>


                    <?php if ($startRow+SHOWMAX < $totalPix) { ?>
                    <li class="page-item"><a href="customer-wishlist.php?curPage=<?= $curPage +1 ?>" aria-label="Next" class="page-link"><span aria-hidden="true">»</span><span class="sr-only">Next</span></a></li>
                    <?php  } else {
                          // otherwise leave the cell empty
                            echo '&nbsp;';
                          } ?>
                  </ul>
                </nav>
              </div>
              <?php } ?>


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