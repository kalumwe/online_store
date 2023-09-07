<?php

//ob_start();
session_start();

//set session variables to false
$_SESSION['Allcategory'] = false;
$_SESSION['category'] = false;

//define('ERROR_LOG','C:/Temp/logs/errors.log');

//try {

//include file(class)  
include_once 'admin/includes/class.user.php';

//create object
$user = new User();

//save session 'uid' to variable if it's set
if (isset($_SESSION[ 'uid'])) {
  $uid = $_SESSION[ 'uid'];
}

//check if GET 'id' is set and is an integer 
if (isset($_GET['id']) && is_numeric($_GET['id']))  { 
  $productId = (int) ($_GET['id']);
  
  //retrieve a product details
  $sql ="SELECT * FROM product WHERE id='$productId'";
  $query = $user->db->query($sql);


  //redirect to '404' page if product id doesn't exist in database
  if ($query->rowCount() > 0) {    
    $productId = (int) ($_GET['id']);
  }  else {   
    $url = "http://localhost:8080/online_store/404.php";
     header("Location: $url");       
       // header("Location: $url");
  }
}  else {   
  $url = "http://localhost:8080/online_store/404.php"; 
   header("Location: $url");       
     // header("Location: $url");
}


//images directory
$imageDir = './img/';

//retrieve data for a product for display
$sql="SELECT *, i.id AS id, i.discount AS disc FROM product as i RIGHT JOIN Product_category as j ON i.id=j.productId RIGHT JOIN  
     category as z ON z.id=j.categoryId RIGHT JOIN variant as k ON k.productId=i.id  
     WHERE i.id='$productId'";
$query = $user->db->query($sql);
$row = $query->fetch();


//save title category to variable for display on parts of page depending on product's category name
if ($user->safe($row['categoryName']) == "ladies") {
  $title = 'Ladies';
} else if ($user->safe($row['categoryName']) == "men") {
  $title = 'Men';
} else {
  if ($user->safe($row['categoryName']) == "accessories") {
    $title = 'Accessories';
  }
}


if (isset($_REQUEST['submit'])) {
 

}

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
define('SHOWMAX', 6);

 require 'admin/includes/category_queries.php';

?> 

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Kalu : e-commerce customer detail</title>
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
                
                  <li class="breadcrumb-item"><a href="#"><?= $title ?></a></li>
                  <li class="breadcrumb-item"><a href="#"><?= $user->safe($row['type']) ?>s</a></li>
                  <li aria-current="page" class="breadcrumb-item active"><?= $user->safe($row['title']) ?></li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-3 order-2 order-lg-1">

             <!--CATEGORY SIDEBAR-->
            <?php include ('includes/category_sidebar.php'); ?>


            <div class="col-lg-9 order-1 order-lg-2">
              <div id="productMain" class="row">
                <div class="col-md-5">
                  <div data-slider-id="1" class="owl-carousel shop-detail-carousel">
                  <?php 
                         if ( !empty($row['imageDetail'])) {
            
                          $image = $imageDir . basename($row['imageDetail']);
                          if (file_exists($image) && is_readable($image)) {
                              $imageSize = getimagesize($image)[3];
                          }
                       //if (!empty($imageSize)) { 
                        ?>
                    <div class="item"> <img src="<?= $image ?>1.jpg" alt="" class="img-fluid"></div>
                    <div class="item"> <img src="<?= $image ?>2.jpg" alt="" class="img-fluid"></div>
                    <div class="item"> <img src="<?= $image ?>3.jpg" alt="" class="img-fluid"></div>


                    <?php //}
                   } else { ?>
                    <div class="item"> <img src="" alt="" class="img-fluid"></div>
                    <div class="item"> <img src="" alt="" class="img-fluid"></div>
                    <div class="item"> <img src="" alt="" class="img-fluid"></div>
                    <?php } ?>
                  </div>
                 

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

                <div class="col-md-7">
                  <div class="box">
                    <h1 class="text-center"><?= $user->safe($row['title']) ?></h1>
                    <p class="goToDescription"><a href="#details" class="scroll-to">Scroll to product details, material &amp; care and sizing</a></p>
                    <p class="price">$<?php echo $user->safe($row['price']);  if ( (int) $row['oldPrice'] !== 0) { ?> 
                      &nbsp;<del class="text-muted">&dollar;<?= $user->safe($row['oldPrice']) ?></del>
                        <?php } else { echo "";} ?>
                       <?php  if ($user->safe($row['disc']) !== '0') { ?>
                         <span class="text-small text-success ml-4"> 
                          <?php
                        
                        echo "(". $user->safe($row['disc'])."% off)";
                      ?></span> <?php } else {  echo "";} ?> </p>
                    <p class="py-2 mb-4">
                                <i class="fa fa-star text-warning"></i>
                                <i class="fa fa-star text-warning"></i>
                                <i class="fa fa-star text-warning"></i>
                                <i class="fa fa-star text-warning"></i>
                                <i class="fa fa-star text-secondary"></i>
                                <span class="list-inline-item text-dark">Rating 4.8 | 36 Comments</span>
                            </p>
                            <div class=" mb-3">

                            <?php /*if (isset($_REQUEST['wishlist'])) {
                                     $url = "./includes/add_wishlist.php?id=".(int) $row['id']."";
                                     header("Location: $url");
                            } */?>

                          <?php/* if (isset($_REQUEST['submit'])) {
                                     $url = "./includes/add_cart.php?id=".(int) $row['id']."";
                                     header("Location: $url");
                            } */?>

                              <form method="post" action="<?php echo "./includes/add_cart.php?id=". (int) $row['id']."";  ?>" name="variants">
                    <p class="text-dark font-weight-bold mb-1 mr-3">Size:</p>
                    
                        <div class="custom-control  custom-control-inline">
                            <input type="radio" class="custom-control-input primary" id="size-1" name="size" value="XS"
                            <?php
                                 if ($_POST && $_POST['size'] == 'XS') {
                                     echo 'checked';
                                 } ?>>
                            <label class="custom-control-label " for="size-1">XS</label>
                        </div>
                        <div class="custom-control  custom-control-inline">
                            <input type="radio" class="custom-control-input" id="size-2" name="size" value="S"
                            <?php
                                 if ($_POST && $_POST['size'] == 'S') {
                                     echo 'checked';
                                 } ?>>
                            <label class="custom-control-label" for="size-2">S</label>
                        </div>
                        <div class="custom-control custom-control-inline">
                            <input type="radio" class="custom-control-input" id="size-3" name="size" value="M"
                            <?php
                                 if ($_POST && $_POST['size'] == 'M') {
                                     echo 'checked';
                                 } ?>>
                            <label class="custom-control-label" for="size-3">M</label>
                        </div>
                        <div class="custom-control  custom-control-inline">
                            <input type="radio" class="custom-control-input" id="size-4" name="size" value="L"
                            <?php
                                 if ($_POST && $_POST['size'] == 'L') {
                                     echo 'checked';
                                 } ?>>
                            <label class="custom-control-label" for="size-4">L</label>
                        </div>
                        <div class="custom-control custom-control-inline">
                            <input type="radio" class="custom-control-input" id="size-5" name="size" value="XL"
                            <?php
                                 if ($_POST && $_POST['size'] == 'XL') {
                                     echo 'checked';
                                 } ?>>
                            <label class="custom-control-label" for="size-5">XL</label>
                        </div>
                    
                </div>
              <!--  <div class=" mb-4">
                    <p class="text-dark font-weight-bold mb-1 mr-3">Color:</p>
                    
                        <div class="custom-control  custom-control-inline">
                            <input type="radio" class="custom-control-input" id="color-1" name="color" value="Black">
                            <label class="custom-control-label" for="color-1">Black</label>
                        </div>
                        <div class="custom-control  custom-control-inline">
                            <input type="radio" class="custom-control-input" id="color-2" name="color" value="White">
                            <label class="custom-control-label" for="color-2">White</label>
                        </div>
                        <div class="custom-control  custom-control-inline">
                            <input type="radio" class="custom-control-input" id="color-3" name="color" value="Red">
                            <label class="custom-control-label" for="color-3">Red</label>
                        </div>
                        <div class="custom-control  custom-control-inline">
                            <input type="radio" class="custom-control-input" id="color-4" name="color" value="Blue">
                            <label class="custom-control-label" for="color-4">Blue</label>
                        </div>
                        <div class="custom-control  custom-control-inline">
                            <input type="radio" class="custom-control-input" id="color-5" name="color" value="Green">
                            <label class="custom-control-label" for="color-5">Green</label>
                        </div>
                   
                </div>-->
               
                <div class="border d-flex align-items-center py-1 mb-4 bg-white border-gray  w-75"><span class=" font-weight-bold px-2 mb-1 text-dark mr-3 no-select">Quantity:</span>
                    <div class="quantity">
                    <div class="col-sm-12">
                      <input class="form-control border-0 shadow-0 p-0" type="number" value="<?php if (isset($_POST['qnty'])) {
                        echo (int) $_POST['qnty']; } else { echo 1; }?>" name="qnty">
                    </div>
                    </div>
                  </div>
                    
                    <p class="text-center buttons ">
                      <?php if(isset($_SESSION['uid'])) {  ?>
                        <?php if ($user->checkIfAddedToCart((int) $row['id'], $_SESSION['uid'])) { ?>
   
                          <button href="" class="btn btn-outline-primary px-3" disabled>
                          <i class="fa fa-shopping-cart px-1">                       
                       </i>Added to cart</button>
                       
                        <?php } else { ?>
                          <button class="btn btn-primary"
                          id="addToCartBtn_<?= (int) $row['id'] ?>" data-product-id="<?= (int) $row['id']?>"
                            onclick="addToCar(<?= (int) $row['id'] ?>, <?= $totalCart ?>)">                       
                        <i class="fa fa-shopping-cart"></i>Add to cart</button>
                        <?php } ?>
                        </form>
      
                        <?php } else { ?>            
                          <a href="checkout1.php" class="btn btn-primary">
                           <i class="fa fa-shopping-cart"></i>Buy now</a>
                           <a href="#" data-toggle="modal" data-target="#login-modal" class="list-top-item btn btn-info">
                            <i class="fa fa-heart"></i>Add to wishlist</a>
                      <?php } ?>        

                            <?php if(isset($_SESSION['uid'])) {  ?>
                              
                              <?php if ($user->checkIfAddedToWishlist((int) $row['id'], $_SESSION['uid'])) { ?>
                           <button class="btn btn-outline-info " disabled><i class="fa fa-heart px-1"></i>Added to wishlist</button>
                           <?php } else { ?>
                            <!--<form method="post" action=" ./includes/add_wishlist.php?id=" name="wshlist" class="d-inline">-->
                            <button class="btn btn-info" id="addToWishlistBtn_<?= (int) $row['id'] ?>"
                             onclick="addToWishlist(<?= (int) $row['id'] ?>)"><i class="fa fa-heart"></i>Add to wishlist</button>
                            <?php } ?>
                            <?php } ?>

                            <!--</form--></p>
                           
                  </div>     
                 
                </div>

                <div class="col-md-12">

                  <div data-slider-id="1" class="owl-thumbs">
                    <?php

                  if ( !empty($row['thumb'])) {
            
            $image = $imageDir . basename($row['thumb']);
            if (file_exists($image) && is_readable($image)) {
                $imageSize = getimagesize($image)[3];
            }
         //if (!empty($imageSize)) { 
          ?>
                    <button class="owl-thumb-item"><img src="<?= $image ?>.jpg" alt="" class="img-fluid"></button>
                    <button class="owl-thumb-item"><img src="<?= $image ?>2.jpg" alt="" class="img-fluid"></button>
                    <button class="owl-thumb-item"><img src="<?= $image ?>3.jpg" alt="" class="img-fluid"></button>

                    <?php //}
                   } else { ?>
                    
                    <button class="owl-thumb-item"><img src="" alt="" class="img-fluid"></button>
                    <button class="owl-thumb-item"><img src="" alt="" class="img-fluid"></button>
                    <button class="owl-thumb-item"><img src="" alt="" class="img-fluid"></button>
                    <?php } ?>

                  </div>
             </div>
                
              </div>
              
              <div id="details" class="box">
                <p></p>
                <h4>Product details</h4>
                <p><?= $user->safe($row['description']) ?></p>
                <h4>Material &amp; care</h4>
                <ul>
                  <li>Polyester</li>
                  <li>Machine wash</li>
                </ul>
                <h4>Size &amp; Fit</h4>
                <ul>
                  <li>Regular fit</li>
                  <li>The model (height 5'8" and chest 33") is wearing a size S</li>
                </ul>
                <blockquote>
                  <p><em><?= $user->safe($row['content']) ?></em></p>
                </blockquote>
                <hr>
                <div class="social">
                  <h4>Show it to your friends</h4>
                  <p><a href="#" class="external facebook"><i class="fa fa-facebook"></i></a><a href="#" class="external gplus"><i class="fa fa-google-plus"></i></a><a href="#" class="external twitter"><i class="fa fa-twitter"></i></a><a href="#" class="email"><i class="fa fa-envelope"></i></a></p>
                </div>
              </div>
              <div class="row same-height-row">
                <div class="col-md-3 col-sm-6">
                  <div class="box same-height">
                    <h3>You may also like these products</h3>
                  </div>
                </div>
                <?php 
               //try {
                      //retrieve products data and display records
                     $sql = "SELECT id, title, price, oldPrice, image, sale, new, gift FROM product LEFT JOIN variant
                      ON product.id = variant.productId LIMIT ". SHOWMAX;
                      $result = $user->db->query($sql);
                 
                    if ($result->rowCount() > 0) {
                      while ($row = $result->fetch()) {
                        if ($pos++ % COLS === 0 && !$firstRow) { ?>
                          </div><div class='row same-height-row'>
                         

      
                     <?php  }
                        ?>

                <div class="col-md-3 col-sm-6">
                  <div class="product same-height">
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
                        <div class="front"><a href="detail.php?id=<?= (int) $row['id'] ?>"><img src="<?= $image ?>" alt="" class="img-fluid"></a></div>
                        <div class="back"><a href="detail.php?id=<?= (int) $row['id'] ?>"><img src="<?= $image ?>" alt="" class="img-fluid"></a></div>
                      </div>
                    </div><a href="detail.php?id=<?= (int) $row['id'] ?>" class="invisible"><img src="<?= $image ?>" alt="" class="img-fluid"></a>
                    <?php   }
                   } else { ?>
                    <div class=""><a href="detail.php?id=<?= (int) $row['id'] ?>"><img src="" alt="" class="img-fluid"></a></div>
                        <div class="back"><a href="detail.php?id=<?= (int) $row['id'] ?>"><img src="" alt="" class="img-fluid"></a></div>
                      </div>
                    </div><a href="detail.php?id=<?= (int) $row['id'] ?>" class="invisible"><img src="" alt="" class="img-fluid"></a>
                    <?php } ?>

                     <div class="text">
                      <h3><a href="detail.php?id=<?= (int) $row['id'] ?>"><?= $user->safe($row['title']) ?></a></h3>

                      <p class="price">
                      <?php  if ( (int) $row['oldPrice'] !== 0) { ?> 
                        <del>&dollar;<?= $user->safe($row['oldPrice']) ?></del>
                        <?php } else { echo "<del></del>";} ?>
                        &dollar;<?= $user->safe($row['price']) ?>
                      </p>
                      
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

                  </div>
                  <!-- /.product            -->
                </div>
                  

                <?php

                
              }
          } else {
                 echo "<p class='mx-auto'>NO Data Exist</p>";
        } 

      //}
      ?>
                <div class="col-md-3 col-sm-6">
                  <div class="box same-height">
                    <h3>Products viewed recently</h3>
                  </div>
                </div> 
               
              </div>
            </div>
            <!-- /.col-md-9-->
          </div>
        </div>
      </div>
    </div>
     

    <!--*** FOOTER ***_________________________________________________________-->
   
    <?php include('./includes/footer.php'); ?>

    <?php // Close the PDO connection at the end of the script or when it's no longer needed
          $user->db = null;
      ?>

    <!-- *** COPYRIGHT END ***--> 


    <!-- JavaScript files-->
    <?php include('./includes/external_js_links.php'); ?>

  </body>
      </html>