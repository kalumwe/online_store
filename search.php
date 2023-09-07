<?php
//ob_start();
session_start();
//$_SESSION['category'] = true;
//define('ERROR_LOG','C:/Temp/logs/errors.log');

try {
include_once './admin/includes/class.user.php';

//include file(class)
$user = new User();

//save session 'uid' to variable if it's set
if (isset($_SESSION[ 'uid'])) {
  $uid = $_SESSION[ 'uid'];
}

/*if (!($_GET['search']) ) {
  $url = "http://localhost:8080/online_store/index.php";
  header("Location: $url");
}*/

//images directory
$imageDir = './img/';
//$safe = $user->safe();
$result = false;

// define number of columns in table
define('COLS', 3);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
// initialize variables for the horizontal looper
$pos = 0;
$firstRow = true;
$startRow = 0;
$totalPix = false;
//$TotalMen = false;
//$TotalWomen = false;

// set maximum number of records
define('SHOWMAX', 24);

//sanitize, filter and validate POST value
$search = $user->safe(trim($_GET['search']));
if ((!empty($search)) && (strlen($search) <= 20)) {
    // remove ability to create link in email
    $patterns = array("/http/", "/https/", "/\:/","/\/\//","/www./");
    $search = preg_replace($patterns," ", $search);
    $search = filter_var( $search, FILTER_SANITIZE_STRING);
    $search = (filter_var($search, FILTER_SANITIZE_STRIPPED));
    $ok = true;
}  else {	
    $searchErr = 'Search input missing or exceeded max number of characters.';
}


//total number of all search results
$searchTotal =  "SELECT COUNT(*) FROM product as i LEFT JOIN Product_category as j ON i.id=j.productId LEFT JOIN  
category as z ON z.id=j.categoryId LEFT JOIN variant as k ON k.productId=i.id LEFT JOIN tag as t ON t.categoryId=z.id 
WHERE (i.title LIKE '%$search%')  OR (type LIKE '%$search%')  OR (brand LIKE '%$search%')  OR (categoryName LIKE '%$search%')
OR (t.title LIKE '%$search%')  OR (color LIKE '%$search%')";
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

//get page url
$currentURL = 'search.php?search';
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Kalu : e-commerce Search Page</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!--external links-->
    <?php  include('./includes/external_links.php'); ?>

    
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
                  <li class="breadcrumb-item"><a href="#">Search Page</a></li>
                  <li aria-current="page" class="breadcrumb-item active"><?= $user->safe(trim($_GET['search'])) ?></li>
                </ol>
              </nav>
              <div class="box">
                <h1>'<?= $user->safe(trim($_GET['search'])) ?>'</h1>
                <p>Search results for '<?= $user->safe(trim($_GET['search'])) ?>'.</p>
              </div>
              <div class="box info-bar">
                <div class="row">
                <div class="col-md-12 col-lg-4 products-showing">Showing <?php echo $startRow+1;            
                                if ($startRow+1 < $totalSrch) {
                                    echo ' to ';
                                   if ($startRow+SHOWMAX < $totalSrch) {
                                       echo $startRow+SHOWMAX;
                                    } else {
                                       echo $totalSrch;
									                  }
                                }
                                    echo " of $totalSrch products"; ?></div>
                  <div class="col-md-12 col-lg-6 products-number-sort">
                    <form class="form-inline d-block d-lg-flex justify-content-between flex-column flex-md-row">
                      <div class="products-number"><strong>Show</strong><a href="#" class="btn btn-sm btn-primary">12</a>
                      <a href="#" class="btn btn-outline-secondary btn-sm">24</a>
                      <a href="#" class="btn btn-outline-secondary btn-sm">All</a><span>products</span></div>
                      <div class="products-sort-by mt-2 mt-lg-0"><strong>Sort by</strong>
                        <select  name="sortby" class="form-control" id="sortOptionSearch" onchange="sortDataSearch()">
                        <option  value="i.createdAt">sort</option>
                          <option  value="price" onclick="" <?php  if ($_POST  === 'price') {
                                     echo 'selected';
                                 } ?>>Price</option>
                          <option  value="i.title" <?php  if ($_POST  === 'i.title') {
                                     echo 'selected';
                                 } ?>>Name</option>
                          <option  value="i.createdAt" <?php  if ($_POST  === 'i.createdAt') {
                                     echo 'selected';
                                 } ?>>Sales first</option>
                        </select>
                      
                      <input name="srch" id="searchedItem" type="hidden" value="<?= $user->safe(trim($_GET['search'])) ?>">
                     
                      </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>

              <?php

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

//SANITIZE, FILTER and VALIATE search input
$search = $user->safe(trim($_GET['search']));
if ((!empty($search)) && (strlen($search) <= 20)) {
    // remove ability to create link in email
    $patterns = array("/http/", "/https/", "/\:/","/\/\//","/www./");
    $search = preg_replace($patterns," ", $search);
    $search = filter_var( $search, FILTER_SANITIZE_STRING);
    $search = (filter_var($search, FILTER_SANITIZE_STRIPPED));
    $ok = true;
 }  else {	
    $searchErr = 'Search input missing or exceeded max number of characters.';
 }
}

 //Display search results if errors don't  exist
      if (empty($searchErr)) { 

              $sql = "SELECT *, i.title AS prodName, t.title  AS tagName, i.id AS pId, i.discount AS disc FROM product as i LEFT JOIN Product_category as j ON i.id=j.productId LEFT JOIN  
              category as z ON z.id=j.categoryId LEFT JOIN variant as k ON k.productId=i.id LEFT JOIN tag as t ON t.categoryId=z.id 
              WHERE (i.title LIKE '%$search%')  OR (type LIKE '%$search%')  OR (brand LIKE '%$search%')  OR (categoryName LIKE '%$search%')
              OR (t.title LIKE '%$search%')  OR (color LIKE '%$search%') LIMIT $startRow,". SHOWMAX;

              
              $result = $user->db->query($sql);
      } else { ?>
                <p class="text-center mx-auto"><?= $searchErr ?></p> 
      <?php  }
              ?>

              <div class="row products" id='searchProducts'>
        <?php 

              if ($result) {
                if ($result->rowCount() > 0) {
                  while($row = $result->fetch()) {
                    if ($pos++ % COLS === 0 && !$firstRow) {
                        echo "</div><div class='row products' id='searchProducts'>";
    
                     } 
                     
        ?>
                   
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
                </div>
                <a href='detail.php?id=<?= (int) $row['pId'] ?>' class='invisible'><img src='' alt=''  class='img-fluid'></a>
                <?php } ?>

                    <div class="text">
                      <h3><a href="detail.php?id=<?= (int) $row['pId'] ?>"><?= $user->safe($row['prodName']) ?></a></h3>

                      <p class="price">
                      <?php  if ((int) $row['oldPrice'] !== 0) { ?> 
                        <del>&dollar;<?= $user->safe($row['oldPrice']) ?></del>
                        <?php } else { echo "<del></del>";} ?>
                        &dollar;<?= $user->safe($row['price']) ?>
                        <?php  if ($user->safe($row['disc']) !== '0') { ?>
                         <span class="text-small text-success ml-4"> 
                        <?php  
                        echo "(". $user->safe($row['disc'])."% off)";?></span> <?php } else {  echo "";} ?>
                      </p>
                      
                      <p class="buttons"><a href="detail.php?id=<?= (int) $row['pId'] ?>" class="btn btn-outline-secondary">View detail</a>
                      <?php if(isset($_SESSION['uid'])) {  ?>
                        <?php if ($user->checkIfAddedToCart((int) $row['pId'], $_SESSION['uid'])) { ?>
                          <button href="#" class="btn btn-outline-primary" disabled>                       
                       </i>Added to cart</button>
                        <?php } else { ?>
                          <button class="btn btn-primary"
                          id="addToCartBtn_<?= (int) $row['pId'] ?>" data-product-id="<?= (int) $row['pId'] ?>"
                            onclick="addToCart(<?= (int) $row['pId'] ?>, <?= $totalCart ?>)">                       
                        <i class="fa fa-shopping-cart"></i>Add to cart</button>
                        <?php } 
                          } else { ?>
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
                 <?php } 

                  if ( (int) $row['new'] === 1) {
                  ?>
                    <div class='ribbon new'>
                    <div class='theribbon'>NEW</div>
                    <div class='ribbon-background'></div>
                  </div>
                    <?php
                  } else { ?>
                    <div></div>
                  <?php } 

                  if ( (int) $row['gift'] === 1) {
                    ?>
                    <div class='ribbon gift'>
                    <div class='theribbon'>GIFT</div>
                    <div class='ribbon-background'></div>
                  </div>
                    <?php
                  } else { ?>
                    <div></div>
                  <?php }  

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
                           echo "
                 </div>
                 <p class='mx-auto'>NO Records found!. Try another search. </p>";
         } 
      } else {
        echo "
        </div>
        <p class='mx-auto'>Cannot connect to server. Try again!</p> ";
    } 
    
/*
      if (COLS-2 > 0) {
        for ($i = 0; $i < COLS-2; $i++) {
             echo '<div class="col-md-7"></div>';
        }
     }    */

//get page url
$currentURL = 'search.php?search';

?>
                <!-- /.products-->
              </div>
              <div class="pages mx-auto">
                <?php if ($totalSrch >= 8) { ?>
                <p class="loadMore"><a href="#" class="btn btn-primary btn-lg"><i class="fa fa-chevron-down"></i> Load more</a></p>
                <?php } ?>

                <!--PAGINATION NAV LINKS-->
                <nav aria-label="Page navigation example" class="d-flex justify-content-center">
                  <ul class="pagination">
                    <li class="page-item">
                        
                      <?php if ($curPage > 0) { ?>
                      <a href="<?= $currentURL ?>&curPage=<?= $curPage -1 ?>" aria-label="Previous" class="page-link"><span aria-hidden="true">«</span><span class="sr-only">Previous</span></a></li>
                     <?php  } else {
                          // otherwise leave the cell empty
                             echo '&nbsp;';
                            }
                      ?>

                    <?php 
                    //page link numbers
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
   
    <!--*** FOOTER ***-->
   
    <?php include('./includes/footer.php'); ?>

    <!-- *** COPYLEFT END ***--> 

  <?php 
    // Close the PDO connection at the end of the script or when it's no longer needed
    $user->db = null;

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

    <!-- JavaScript files-->
    <?php include('./includes/external_js_links.php'); ?>

  </body>
</html>