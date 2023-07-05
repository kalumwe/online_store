<?php

session_start();

 try {

    //include file(class) 
    include_once './admin/includes/class.user.php';
    
    //create object
    $user = new User();
  
//set session variables to true and false respectively    
$_SESSION['category'] = true;
$_SESSION['Allcategory'] = false;


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



 // set the current page (401)
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

   //return to previous page if GET is false 
    if (!isset($_GET) ) {
        $url = $_SERVER['HTTP_REFERER'];
        header("Location: $url");
    }

    //sanitize value
    $sortOption = $user->safe($_GET['sortOption']);
    
    //images directory
    $imageDir = './img/';

    
    //call sort function if session variable is true
    if ($_SESSION['category']) {
      $category = $user->safe($_SESSION['cat']);
      $type = $user->safe($_SESSION['type']);
    
           $result = $user->sortCategory($type, $category, $sortOption, $startRow);
      
           // prepare SQL to get total records
           $totalPix = $user->getTotalSortCategory($type, $category, $startRow);
      
          }

 
    //display results
    if ($result) {
  //if(mysqli_num_rows($result) > 0) {
      if ($result->rowCount() > 0) {
        while($row = $result->fetch()) {
          

          if ($pos++ % COLS === 0 && !$firstRow) {
              echo "</div><div class='row products' id='poductsInfo'>";

           } 
           
           ?>

          

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

           <!-- /.ribbon-->
        <?php } ?>

       
         </div>
         <!-- /.product            -->
    </div>

<?php


    }
                
              
            } else {
                   echo "<p class='mx-auto'>NO Records found! </p>";
          } 

        } else {
            echo "<p class='mx-auto'>Cannot connect to server. Try again!</p> ";
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
  
