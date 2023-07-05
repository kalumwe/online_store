<?php

//ob_start();
session_start();

//set session variables to true and false respectively
$_SESSION['category'] = true;
$_SESSION['Allcategory'] = false;
//define('ERROR_LOG','C:/Temp/logs/errors.log');

try {

include_once 'admin/includes/class.user.php';

//include file(class) 
$user = new User();


//save session 'uid' to variable if it's set
if (isset($_SESSION[ 'uid'])) {
  $uid = $_SESSION[ 'uid'];
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
define('SHOWMAX', 9);


//check if page exists 
if (!isset($_GET['ladies-t-shirt']) && (!isset($_GET['ladies-shirt'])) && (!isset($_GET['ladies-pants'])) 
    && (!isset($_GET['ladies-dress'])) && (!isset($_GET['ladies-accessories'])) && (!isset($_GET['men-t-shirt']))
    && (!isset($_GET['men-shirt'])) && (!isset($_GET['men-pants'])) && (!isset($_GET['men-trainers'])) 
    && (!isset($_GET['men-accessories'])) && (!isset($_GET['accessories-watches'])) )  
 {
    $url = "http://localhost:8080/online_store/404.php";
    header("Location: $url");
 }



//***** CATEGORY PAGE with unique GET values and each with different variable values***********

//--------LADIES CATEGORY---------                
if (isset(($_GET['ladies-t-shirt'])))  { 
     $category = "ladies";
     $type = "t-shirt";
     $currentURL = 'category.php?ladies-t-shirt';
    require 'admin/includes/category_queries.php';

    
  }

  if (isset(($_GET['ladies-shirt']))) {
    $category = "ladies";
    $type = "shirt";
    $currentURL = 'category.php?ladies-shirt';
    require 'admin/includes/category_queries.php';
 }

 if (isset(($_GET['ladies-pants']))) {
  $category = "ladies";
  $type = "pants";
  $currentURL = 'category.php?ladies-pants';
  require 'admin/includes/category_queries.php';
}

if (isset(($_GET['ladies-dress']))) {
  $category = "ladies";
  $type = "dress";
  $currentURL = 'category.php?ladies-dress';
  require 'admin/includes/category_queries.php';
}

if (isset(($_GET['ladies-accessories']))) {
  $category = "ladies";
  $type = "accessories";
  $currentURL = 'category.php?ladies-accessories';
  require 'admin/includes/category_queries.php';
}


 //-------MEN's CATEGORY-----------                
if (isset(($_GET['men-t-shirt'])))  { 
     $category = "men";
     $type = "t-shirt";
     $currentURL = 'category.php?men-t-shirt';
     require 'admin/includes/category_queries.php';

  }
               
if (isset(($_GET['men-shirt'])))  { 
  $category = "men";
  $type = "shirt";
  $currentURL = 'category.php?men-shirt';
  require 'admin/includes/category_queries.php';

}
                
if (isset(($_GET['men-pants'])))  { 
  $category = "men";
  $type = "pants";
  $currentURL = 'category.php?men-pants';
  require 'admin/includes/category_queries.php';

}
                
if (isset(($_GET['men-accessories'])))  { 
  $category = "men";
  $type = "accessories";
  $currentURL = 'category.php?men-accessories';
  require 'admin/includes/category_queries.php';

}

if (isset(($_GET['men-trainers'])))  { 
  $category = "men";
  $type = "sneakers";
  $currentURL = 'category.php?men-trainers';
  require 'admin/includes/category_queries.php';

}


 //-------ACCESSORIES CATEGORY-----------                
 if (isset(($_GET['accessories-watches'])))  { 
  $category = "accessories";
  $type = "watch";
  $currentURL = 'category.php?accessories-watches';
  require 'admin/includes/category_queries.php';

}


//set session variables to be uses for sorting in sort file
$_SESSION['cat'] = $category;
$_SESSION['type'] = $type;
     

 // set the current page 
$curPage = (isset ($_GET['curPage'])) ? (int) $_GET['curPage'] : 0;
$curPage = $user->safe($curPage);

// calculate the start row of the subset
$startRow = $curPage * SHOWMAX;
$pages = ceil ($totalPix/SHOWMAX);
if ($startRow > $totalPix) {    //(401)
   $startRow = 0;
   $curPage = 0;
}

if ($curPage >= $pages) {
	$startRow = 0;
    $curPage = 0;
}            

/*$currentURL = "http";
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
  $currentURL .="s";
}
$currentURL .= "://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];*/





//save category name to variable for display on parts of page depending on product's category name
if (isset($_GET['ladies-shirt']) || isset($_GET['ladies-t-shirt']) 
|| isset($_GET['ladies-pants']) || isset($_GET['ladies-accessories']) )  { 
  // $category = "ladies";
   $title = "Ladies"; 
} else if (isset($_GET['men-shirt'])  || isset($_GET['men-t-shirt']) 
|| isset($_GET['men-pants']) || isset($_GET['men-accessories']) || isset($_GET['men-trainers'])) {
  $title = "Men";
} elseif (isset($_GET['accessories-watches'])) {
  $title = "Accessories";
}


?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Kalu : e-commerce category</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    
    <!--external links-->
    <?php  include('./includes/external_links.php'); ?>
    <script>
      //Ajax using GET 
      function sortDataCategory() {
          
          var sortOption = document.getElementById("sortOption").value;
          
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                 document.getElementById('poductsInfo').innerHTML = this.responseText;
                 // console.log("value sent php successful");
                }
            };
            xhttp.open("GET", "./sort.php?sortOption=" + sortOption, true);
            xhttp.send();
            
    }
  
       </script>
 
 
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
              
                 
                  <li aria-current="page" class="breadcrumb-item active"><?= $title ?></li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-3">

            
<?php
              
//***** CATEGORY PAGE with unique GET values and each with different variable values***********

//--------LADIES CATEGORY---------                
if (isset(($_GET['ladies-t-shirt'])))  { 
  $category = "ladies";
  $type = "t-shirt";
  $currentURL = 'category.php?ladies-t-shirt';
 require 'admin/includes/category_queries.php';

 
}

if (isset(($_GET['ladies-shirt']))) {
 $category = "ladies";
 $type = "shirt";
 $currentURL = 'category.php?ladies-shirt';
 require 'admin/includes/category_queries.php';
}

if (isset(($_GET['ladies-pants']))) {
$category = "ladies";
$type = "pants";
$currentURL = 'category.php?ladies-pants';
require 'admin/includes/category_queries.php';
}


if (isset(($_GET['ladies-dress']))) {
$category = "ladies";
$type = "dress";
$currentURL = 'category.php?ladies-dress';
require 'admin/includes/category_queries.php';
}

if (isset(($_GET['ladies-accessories']))) {
$category = "ladies";
$type = "accessories";
$currentURL = 'category.php?ladies-accessories';
require 'admin/includes/category_queries.php';
}


//-------MEN's CATEGORY-----------                
if (isset(($_GET['men-t-shirt'])))  { 
  $category = "men";
  $type = "t-shirt";
  $currentURL = 'category.php?men-t-shirt';
  require 'admin/includes/category_queries.php';

}
            
if (isset(($_GET['men-shirt'])))  { 
$category = "men";
$type = "shirt";
$currentURL = 'category.php?men-shirt';
require 'admin/includes/category_queries.php';

}
             
if (isset(($_GET['men-pants'])))  { 
$category = "men";
$type = "pants";
$currentURL = 'category.php?men-pants';
require 'admin/includes/category_queries.php';

}
             
if (isset(($_GET['men-accessories'])))  { 
$category = "men";
$type = "accessories";
$currentURL = 'category.php?men-accessories';
require 'admin/includes/category_queries.php';

}

if (isset(($_GET['men-trainers'])))  { 
$category = "men";
$type = "sneakers";
$currentURL = 'category.php?men-trainers';
require 'admin/includes/category_queries.php';

}


//-------ACCESSORIES CATEGORY-----------                
if (isset(($_GET['accessories-watches'])))  { 
$category = "accessories";
$type = "watch";
$currentURL = 'category.php?accessories-watches';
require 'admin/includes/category_queries.php';

}


?>
             
            <!--CATEGORY SIDEBAR NAVIGATION-->
            <?php include ('includes/category_sidebar.php'); ?>


            <div class="col-lg-9">
              <div class="box">
                <h1> <?= $title ?></h1>
                <p>In our <?= $title ?> department we offer wide selection of the best products we have found and carefully selected worldwide.</p>
               
              </div>

              <div class="box info-bar">
                <div class="row">
                <div class="col-md-12 col-lg-4 products-showing">Showing <?php echo $startRow+1;            
                                   if ($startRow+1 < $totalPix) {
                                        echo ' to ';
                                   if ($startRow+SHOWMAX < $totalPix) {
                                         echo $startRow+SHOWMAX;
                                    } else {
                                       echo $totalPix;
									 }
                                    }
                                    echo " of $totalPix products"; ?></div>
                  <!--<div class="col-md-12 col-lg-4 products-showing">Showing <strong>12</strong> of <strong>25</strong> products</div>-->
                  <div class="col-md-12 col-lg-8 products-number-sort">
                    <form class="form-inline d-block d-lg-flex justify-content-between flex-column flex-md-row" method="post" name="">
                      <div class="products-number"><strong>Show</strong><a href="#" class="btn btn-sm btn-primary">12</a><a href="#" class="btn btn-outline-primary btn-sm">24</a><a href="#" class="btn btn-outline-primary btn-sm">All</a><span>products</span></div>
                      <div class="products-sort-by mt-2 mt-lg-0"><strong>Sort by</strong>
                        <select id="sortOption" name="sort" class="form-control" onchange="sortDataCategory()">
                        <option  value="i.createdAt">sort</option>
                          <option  value="price" onclick="" <?php  if ($_POST && $_POST['sort'] === 'price') {
                                     echo 'selected';
                                 } ?>>Price</option>
                          <option  value="i.title" <?php  if ($_POST && $_POST['sort'] === 'i.title') {
                                     echo 'selected';
                                 } ?>>Name</option>
                          <option  value="i.createdAt" <?php  if ($_POST && $_POST['sort'] === 'i.createdAt') {
                                     echo 'selected';
                                 } ?>>Sales first</option>
                        </select>
                        <input id="submit" class="" 
                       type="submit" name="submit" value="Sort">
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <div class="row products" id="poductsInfo">
                <?php


             //Display products info if result is true

              if ($result1) {
            //if(mysqli_num_rows($result) > 0) {
                if ($stmt->rowCount() > 0) {
                  while($row = $stmt->fetch()) {
                    

                    if ($pos++ % COLS === 0 && !$firstRow) {
                        echo "</div><div class='row products' id='poductsInfo'>";
    
                     } ?>

                <div class="col-lg-4 col-md-6">
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
                         <span class="text-small text-success ml-4"> 
                          <?php
                        
                        echo "(". $user->safe($row['disc'])."% off)";
                      ?></span> <?php } else {  echo "";} ?>
                      </p>
                      
                      <p class="buttons"><a href="detail.php?id=<?= (int) $row['pId'] ?>" class="btn btn-outline-secondary">View detail</a>
                      <?php if(isset($_SESSION['uid'])) {  ?>
                        <?php if ($user->checkIfAddedToCart((int) $row['pId'], $_SESSION['uid'])) { ?>
                          <a href="#" class="btn btn-outline-primary">                       
                       </i>Added to cart</a>
                        <?php } else { ?>
                      <a href="includes/add_cart.php?id=<?= (int) $row['pId'] ?>" class="btn btn-primary">                       
                        <i class="fa fa-shopping-cart"></i>Add to cart</a>
                        <?php } ?>
                        
                        

                        <?php } else { ?>
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
                 echo "<p class='mx-auto'>NO Data Exist</p>";
        } 

      }


/*
      if (COLS-2 > 0) {
        for ($i = 0; $i < COLS-2; $i++) {
             echo '<div class="col-md-7"></div>';
        }
     }    */


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


  

?>
              
                <!-- /.products-->
              </div>
              <div class="pages">
                <p class="loadMore"><a href="#" class="btn btn-primary btn-lg"><i class="fa fa-chevron-down"></i> Load more</a></p>

                <!--PAGINATION NAV LINKS-->
                <nav aria-label="Page navigation example" class="d-flex justify-content-center">
                  <ul class="pagination">
                    <li class="page-item">

                      <?php if ($curPage > 0) { ?>
                      <a href="<?= $currentURL ?>&curPage=<?= $curPage -1 ?>" aria-label="Previous" class="page-link">
                      <span aria-hidden="true">«</span><span class="sr-only">Previous</span></a></li>
                     <?php  } else {
                          // otherwise leave the cell empty
                             echo '&nbsp;';
                            } ?>

                            <?php 
                            for ($i = 1; $i <= $pages; $i++) {
                    if ($i == $curPage) {
            
                    echo '
                    <li class="page-item"><a class="page-link " href="'. $currentURL .'&curPage=' . $i-1 . '">' . $i . '</a></li>';
                   } else {
                    echo '
                  
                  <li class="page-item ';  if ($i == $curPage + 1) { echo " active "; } echo'">
                  <a class="page-link" href="'. $currentURL .'&curPage=' . $i-1 . '">' . $i . '</a></li>';
                   }
                }
                ?>

                    <?php if ($startRow+SHOWMAX < $totalPix) { ?>
                    <li class="page-item"><a href="<?= $currentURL ?>&curPage=<?= $curPage +1 ?>" aria-label="Next" class="page-link"><span aria-hidden="true">»</span><span class="sr-only">Next</span></a></li>
                    <?php  } else {
                          // otherwise leave the cell empty
                            echo '&nbsp;';
                          } ?>
                  </ul>
                </nav>
                
              </div>
            </div>
            <!-- /.col-lg-9-->
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
