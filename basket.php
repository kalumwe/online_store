<?php
//ob_start();
session_start();

//include file(class) 
include_once './admin/includes/class.user.php';
    
//create object
$user = new User();

//redirect to '404' page if session 'uid' is false
if (!isset($_SESSION['uid'])) { 
  header("Location: 404.php");
  exit();
}


$uid = $_SESSION['uid'];

//redirect to '404' page if get_session() is false
if (!$user->get_session()) { 
  $url = "http://localhost:8080/online_store/404.php";
  header("Location: $url"); 
}

// set maximum number of records
define('SHOWMAX', 3);

//set quantity value
$qty = 1;

//redirect to checkout page if true
if(isset($_REQUEST[ 'checkout'])) { 
  header("Location: checkout1.php");
}

// If the user changes the quantity then Update the cart
  if(isset($_POST['qty'])) {
   /* if(isset($_REQUEST[ 'submit'])) { 
  foreach ( $_POST['qty'] as $prod_id => $item_qty ) {
// Ensure that the id and the quantity are integers
    $id = (int) $prod_id;
    $qty = (int) $item_qty;
// If the quantity is set to zero clear the session or else store the changed quantity*/
    if ( $qty == 0 ) { 
       // unset ($_SESSION['cart'][$id]); 
    } 
    elseif ( $qty > 0 ) { 
       $qty = $_POST['qty']; }
   // }
  }

// Set an initial variable for the total cost
  $total = 0; 
  $orderTotal =0;


  //images directory
  $imageDir = './img/';


?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Kalu : e-commerce cart</title>
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
                  <li aria-current="page" class="breadcrumb-item active">Shopping cart</li>
                </ol>
              </nav>
            </div>
            <div id="basket" class="col-lg-9">
              <div class="box">
              <?php 

                $sql="SELECT *, i.id AS pId, j.id AS cId, i.price AS Prce, i.discount AS Disc, i.quantity AS qty, j.quantity AS qnty, j.createdAt AS lastAdd,
                j.size AS sze  FROM product as i INNER JOIN cart_item as j ON i.id=j.productId INNER JOIN  
                      cart as z ON z.id=j.cartId /*INNER JOIN order as p ON p.procuctId=i.id*/ INNER JOIN variant as k ON k.productId=i.id 
                       WHERE z.userId='$uid' ORDER BY lastAdd DESC";
                 //$stmt = $user->db->prepare($sql);
                 //$stmt->bindParam(':Sort', $sort, PDO::PARAM_STR);              
                 //$stmt->bindParam(':pwd', $password, PDO::PARAM_STR);
                 //$result = $stmt->execute();
                $result = $user->db->query($sql);


                  ?>
                
                  <h1>Shopping cart</h1>
                 
                  <p class="text-muted">You currently have <?= $totalCart ?> item(s) in your cart.</p>
                  <form method="post" action="" name='cart'>
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                        <th></th>
                          <th colspan="2">Product</th>
                          <th>Quantity</th>
                          <th>Size</th>
                          <th>Unit price</th>
                          <th>Discount</th>
                          <th colspan="1">Total</th>
                        </tr>
                      </thead>

                      <?php
                      //$qty = 1;
                    
             
                   //if(mysqli_num_rows($result) > 0)
                    if($result->rowCount() > 0) {
                      $counter = 1;
                      while ($row = $result->fetch()) {

                        //save quantity value 
                        $qty = (int) $row['quantity'];
                           
                       //set product id and discount values
                        $prodId =  (int) $row['pId'];
                        $disc = $user->safe($row['Disc']);

                        //include update cart file if true
                        if(isset($_REQUEST[ 'update'])) {
                          include('includes/update_cart.php');
                      }
                      
                     
                        //calculate subtotal
                        if ($disc == 0) {
                        $subtotal = $qty *  $user->safe($row['Prce']);
                        } else {
                           
                          $subtotal1 = $qty *  $user->safe($row['Prce']);
                          $sub = $disc/100 * $subtotal1;
                          $subtotal = $subtotal1 - $sub;
                        }
                        
                         // $subtotal = $qty * $user->safe($row['Prce']);
                       // }

                        //calculate total 
                        $total += $subtotal;                     
                    ?>
                    
                      <tbody id="cartItem_<?= (int) $row['pId'] ?>">
                        <tr>
                        <td><?php echo $counter ?></td>
                          <td>
                          <?php 
                          //display cart content
                        if ( !empty($row['thumb'])) {
                            $image = $imageDir . basename($row['thumb']);
                            if (file_exists($image) && is_readable($image)) {
                               $imageSize = getimagesize($image)[3];
                            } ?>
                            <a href="detail.php?id=<?= (int) $row['pId'] ?>"><img src="<?= $image ?>.jpg" alt="<?= $user->safe($row['title']) ?>"></a>
                          <?php //}
                   } else { ?>
                           <a href="detail.php?id=<?= (int) $row['pId'] ?>"><img src="" alt="default"></a>
                           <?php } ?>
                        
                        </td>
                          <td><a href="detail.php?id=<?= (int) $row['pId'] ?>"><?= $user->safe($row['title']) ?></a></td>
                          <td>
                            <input type="number" min="1" name="qty_<?= $prodId ?>" value="<?php echo $qty; if(isset($_POST['qty_'.$prodId.''])) { 
                                echo (int) $_POST[ 'qty_'.$prodId.''];}?>" class="form-control">
                          </td>
                          <td>
                          <select name="size_<?= $prodId ?>"  id="size" class="form-control">
           
                          <option value="<?= $user->safe($row['sze']) ?>" <?php
                        if (!$_POST || $_POST['size_'.$prodId.''] == ''.$user->safe($row['sze']).'') {
                            echo 'selected';
                        } ?>><?= $user->safe($row['sze']) ?></option>
            
                       <option value="XS" <?php
                        if ($_POST && $_POST['size_'.$prodId.''] == 'XS') {
                            echo 'selected';
                        } ?>>XS</option>
                         <option value="S" <?php
                        if ($_POST && $_POST['size_'.$prodId.''] == 'S') {
                            echo 'selected';
                        } ?>>S</option>
                         <option value="M" <?php
                        if ($_POST && $_POST['size_'.$prodId.''] == 'M') {
                            echo 'selected';
                        } ?>>M</option>
                         <option value="L" <?php
                        if ($_POST && $_POST['size_'.$prodId.''] == 'L') {
                            echo 'selected';
                        } ?>>L</option>
                         <option value="XL" <?php
                        if ($_POST && $_POST['size_'.$prodId.''] == 'XL') {
                            echo 'selected';
                        } ?>>XL</option>
                       </select>
                          </td>
                          <td>$<?= number_format($user->safe($row['Prce']), 2) ?></td>
                          <td><?= $user->safe($row['Disc']) ?>%</td>
                          <td>$<?= number_format($subtotal, 2) ?></td>
                          <td><a href="includes/remove_cart.php?id=<?= (int) $row['pId'] ?>" onclick="removeCartItem(<?= (int) $row['pId'] ?>)"><i class="fa fa-trash-o"></i></a></td>
                        </tr>
                        <?php $counter=$counter+1; ?>
                      <?php } 
                      //end of while loop?>
                      </tbody>
                    
                      <tfoot>
                        <tr>
                          <th colspan="7">Total</th>
                          <th colspan="2">$<?php echo number_format($total, 2);?></th>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                  <!-- /.table-responsive-->
                  <div class="box-footer d-flex justify-content-between flex-column flex-lg-row">
                    <div class="left"><a href="" class="btn btn-outline-secondary"><i class="fa fa-chevron-left"></i> Continue shopping</a></div>
                    <div class="right">
                      <button type="submit" name="update" class="btn btn-outline-secondary"><i class="fa fa-refresh"></i> Update cart</button>
                      <button type="submit" name="checkout" class="btn btn-primary">Proceed to checkout <i class="fa fa-chevron-right"></i></button>
                    </div>
                  </div>
                </form>

                <?php 
                } else {
                  echo "<p class='mx-auto'>NO Data Exist</p>";
               
                }
                ?>
              </div>
              <!-- /.box-->
              <div class="row same-height-row">
                <div class="col-lg-3 col-md-6">
                  <div class="box same-height">
                    <h3>You may also like these products</h3>
                  </div>
                </div>
                <?php

                //retrieve products info for display
                $sql = "SELECT id, title, price, oldPrice, image, sale, new, gift, sold FROM product LEFT JOIN variant
                      ON product.id = variant.productId LIMIT ". SHOWMAX;
                      $result = $user->db->query($sql);

                      
                    if ($result->rowCount() > 0) {
                      while ($row = $result->fetch()) {
                        
                         
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

      //}
      ?>
                
              </div>
            </div>
            <!-- /.col-lg-9-->
            <div class="col-lg-3">
              <div id="order-summary" class="box">
                <div class="box-header">
                  <h3 class="mb-0">Order summary</h3>
                </div>
                <p class="text-muted">Shipping and additional costs are calculated based on the values you have entered.</p>
                <div class="table-responsive">
                  <table class="table">
                    <tbody>
                      <tr>
                        <td>Order subtotal</td>
                        <th>$<?php echo number_format($total, 2);?></th>
                      </tr>
                      <tr>
                        <td>Shipping and handling</td>
                        <?php
                        $shipping = 10; ?>
                        <th>$<?= $shipping ?></th>
                      </tr>
                      <tr>
                        <td>Tax</td>
                        <th>$0.00</th>
                      </tr>
                      <?php 
                      //calculate order total
                      $orderTotal += $shipping;
                      $orderTotal += $total;
                      ?>
                      <tr class="total">
                        <td>Total</td>
                        <th>$<?php echo number_format($orderTotal, 2);?></th>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <!--<div class="box">
                <div class="box-header">
                  <h4 class="mb-0">Coupon code</h4>
                </div>
                <p class="text-muted">If you have a coupon code, please enter it in the box below.</p>
                <form>
                  <div class="input-group">
                    <input type="text" class="form-control"><span class="input-group-append">
                      <button type="button" class="btn btn-primary"><i class="fa fa-gift"></i></button></span>
                  </div>
                  <-- /input-group--/
                </form>
              </div>-->
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
    <?php include('./includes/external_js_links.php'); ?>

  </body>
</html>
<?php
// Close the PDO connection at the end of the script or when it's no longer needed
$user->db = null;

ob_end_flush(); ?>