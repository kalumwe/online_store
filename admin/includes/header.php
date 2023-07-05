<?php
$currentPage = basename($_SERVER['SCRIPT_FILENAME']); 


if (isset($_SESSION[ 'uid'])) {
 $sql = "SELECT COUNT(*) FROM cart LEFT JOIN cart_item ON cart.id = cart_item.cartId WHERE userId='$uid'";
                //$result = $user->db->query($sql);

      $total1 = $user->db->query($sql);
     $totalCart = $total1->fetch()[0];
   }

     //if(isset($_REQUEST[ 'search'])) { 
  //header("Location: search.php");
     // include('search.php');
//}

?>

<!-- navbar-->
    <header class="header mb-5">
      <!--
      *** TOPBAR ***
      _________________________________________________________
      -->
      <div id="top">
        <div class="container">
          <div class="row">
            <div class="col-lg-6 offer mb-3 mb-lg-0"><a href="#" class="btn btn-success btn-sm">Offer of the day</a><a href="#" class="ml-1">Get flat 35% off on orders over $50!</a></div>
            <div class="col-lg-6 text-center text-lg-right">
              <ul class="menu list-inline mb-0">
                <?php if(isset($_SESSION['uid'])) {  ?>
              <li class="list-inline-item"><a href="index.php?q=logout" class="list-top-item">Logout</a></li>
                <?php } else { ?>
              <li class="list-inline-item"><a href="#" data-toggle="modal" data-target="#login-modal" class="list-top-item">Login</a></li>
                <?php } ?>

                <?php if(isset($_SESSION['uid'])) {  ?>
                <li class="list-inline-item d-none"><a href="register.php" class="list-top-item d-none">Register</a></li>
                 <?php  } else { ?>
                        <li class="list-inline-item"><a href="register.php" class="list-top-item ">Register</a></li>
                <?php } ?>
                <li class="list-inline-item"><a href="contact.php" class="list-top-item">Contact</a></li>

                <?php if(isset($_SESSION['uid'])) {  ?>
                <li class="list-inline-item"><a href="#" class="list-top-item">Recently viewed</a></li>
                <?php  } else { ?>
                  <li class="list-inline-item"><a href="#" data-toggle="modal" data-target="#login-modal" class="list-top-item">Recently viewed</a></li>
                 <?php } ?>
                 <?php if(isset($_SESSION['uid'])) {  ?>
                <li class="list-inline-item"><a href="customer-account.php" class="list-top-item">Account</a></li>
                <?php  } else { 
                  echo "";
                  } ?>
              </ul>
              
            </div>
          </div>
        </div>
        <div id="login-modal" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true" class="modal fade">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Customer login</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
              </div>
              <div class="modal-body">
                <form action="login.php" method="post" name="login2" onSubmit="return(submitLogin2());">
                  <div class="form-group">
                    <input id="email-modal" type="text" placeholder="username or email" name="emailusername" class="form-control"
                    value = "<?php if (isset($_POST['emailusername'])) echo htmlspecialchars($_POST['emailusername'], ENT_QUOTES); ?>"
                    onBlur = "disappear()">
                    <span class="text-danger" id="error_message11"></span>
                  </div>
                  <div class="form-group">
                    <input id="password-modal" type="password" name="password" placeholder="password" class="form-control"
                    value = "<?php if (isset($_POST['password'])) echo htmlspecialchars($_POST['password'], ENT_QUOTES); ?>"
                    onBlur = "disappear()">
                    <span class="text-danger" id="error_message12"></span>                    
                  </div>

                  <span id="wrongid" class="text-danger"></span>
                  <p class="text-center">
                    <button class="btn btn-primary" ><i class="fa fa-sign-in"></i> Log in</button>
                  </p>
                </form>
                 
                <p class="text-center text-muted">Not registered yet?</p>
                <p class="text-center text-muted"><a href="register.php"><strong>Register now</strong></a>! It is easy and done in 1 minute and gives you access to special discounts and much more!</p>
              </div>
            </div>
          </div>
        </div>
        <!-- *** TOP BAR END ***-->
        
        
      </div>
      <nav class="navbar navbar-expand-lg">
        <div class="container"><a href="index.php" class="navbar-brand home"><!--<img src="img/.png" alt=" logo" class="d-none d-md-inline-block"><img src="img/logo-smal.png" alt=" logo" class="d-inline-block d-md-none">--><span class="sr-only">Kalu - go to homepage</span></a>
          <div class="navbar-buttons">
            <button type="button" data-toggle="collapse" data-target="#navigation" class="btn btn-outline-secondary navbar-toggler"><span class="sr-only">Toggle navigation</span><i class="fa fa-align-justify"></i></button>
            <button type="button" data-toggle="collapse" data-target="#search" class="btn btn-outline-secondary navbar-toggler"><span class="sr-only">Toggle search</span><i class="fa fa-search"></i></button><a href="basket.php" class="btn btn-outline-secondary navbar-toggler"><i class="fa fa-shopping-cart"></i></a>
          </div>
          <div id="navigation" class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item"><a href="index.php" class="nav-link <?php if ($currentPage == 'index.php') {
                            echo 'active';} ?>">Home</a></li>
              <li class="nav-item dropdown menu-large"><a href="category-full.php?men" data-toggle="dropdown" data-hover="dropdown" data-delay="200" class="dropdown-toggle nav-link">Men<b class="caret"></b></a>
                <ul class="dropdown-menu megamenu">
                  <li>
                    <div class="row">
                      <div class="col-md-6 col-lg-3">
                        <h5>Clothing</h5>
                        <ul class="list-unstyled mb-3">
                          <li class="nav-item"><a href="category.php?men-t-shirt" class="nav-link">T-shirts</a></li>
                          <li class="nav-item"><a href="category.php?men-shirt" class="nav-link">Shirts</a></li>
                          <li class="nav-item"><a href="category.php?men-pants" class="nav-link">Pants</a></li>
                          <li class="nav-item"><a href="category.php?men-accessories" class="nav-link">Accessories</a></li>
                        </ul>
                      </div>
                      <div class="col-md-6 col-lg-3">
                        <h5>Shoes</h5>
                        <ul class="list-unstyled mb-3">
                          <li class="nav-item"><a href="category.php?men-trainers" class="nav-link">Trainers</a></li>
                          <li class="nav-item"><a href="category.php?men-sandals" class="nav-link">Sandals</a></li>
                          <li class="nav-item"><a href="category.php?men-hiking-shoes" class="nav-link">Hiking shoes</a></li>
                          <li class="nav-item"><a href="category.php?men-casual" class="nav-link">Casual</a></li>
                        </ul>
                      </div>
                      <div class="col-md-6 col-lg-3">
                       
                        <h5>Featured</h5>
                        <ul class="list-unstyled mb-3">
                          <li class="nav-item"><a href="category.php" class="nav-link">Trainers</a></li>
                          <li class="nav-item"><a href="category.php" class="nav-link">Sandals</a></li>
                          <li class="nav-item"><a href="category.php" class="nav-link">Hiking shoes</a></li>
                        </ul>
                        <h5>Looks and trends</h5>
                        <ul class="list-unstyled mb-3">
                          <li class="nav-item"><a href="category.php" class="nav-link">Trainers</a></li>
                          <li class="nav-item"><a href="category.php" class="nav-link">Sandals</a></li>
                          <li class="nav-item"><a href="category.php" class="nav-link">Hiking shoes</a></li>
                        </ul>
                      </div>
                    </div>
                  </li>
                </ul>
              </li>
              <li class="nav-item dropdown menu-large"><a href="category-full.php?ladies" data-toggle="dropdown" data-hover="dropdown" data-delay="200" class="dropdown-toggle nav-link">Ladies<b class="caret"></b></a>
                <ul class="dropdown-menu megamenu">
                  <li>
                    <div class="row">
                      <div class="col-md-6 col-lg-3">
                        <h5>Clothing</h5>
                        <ul class="list-unstyled mb-3">
                          <li class="nav-item"><a href="category.php?ladies-t-shirt" class="nav-link">T-shirts</a></li>
                          <li class="nav-item"><a href="category.php?ladies-shirt" class="nav-link">Shirts</a></li>
                          <li class="nav-item"><a href="category.php?ladies-pants" class="nav-link">Pants</a></li>
                          <li class="nav-item"><a href="category.php?ladies-dresses" class="nav-link">Dresses</a></li>
                          <li class="nav-item"><a href="category.php?ladies-accessories" class="nav-link">Accessories</a></li>

                        </ul>
                      </div>
                      <div class="col-md-6 col-lg-3">
                        <h5>Shoes</h5>
                        <ul class="list-unstyled mb-3">
                          <li class="nav-item"><a href="category.php?ladies-trainers" class="nav-link">Trainers</a></li>
                          <li class="nav-item"><a href="category.php?ladies-sandals" class="nav-link">Sandals</a></li>
                          <li class="nav-item"><a href="category.php?ladies-hiking-shoes" class="nav-link">Hiking shoes</a></li>
                          <li class="nav-item"><a href="category.php?ladies-casual" class="nav-link">Casual</a></li>
                        </ul>
                      </div>
                      <div class="col-md-6 col-lg-3">
                        
                        <h5>Looks and trends</h5>
                        <ul class="list-unstyled mb-3">
                          <li class="nav-item"><a href="category.php" class="nav-link">Trainers</a></li>
                          <li class="nav-item"><a href="category.php" class="nav-link">Sandals</a></li>
                          <li class="nav-item"><a href="category.php" class="nav-link">Hiking shoes</a></li>
                        </ul>
                      </div>
                      <div class="col-md-6 col-lg-3">
                        <div class="banner"><a href="#"><img src="img/banner.jpg" alt="" class="img img-fluid"></a></div>
                        <div class="banner"><a href="#"><img src="img/banner2.jpg" alt="" class="img img-fluid"></a></div>
                      </div>
                    </div>
                  </li>
                </ul>
              </li>

              <li class="nav-item dropdown menu-large"><a href="category-full.php?accessories" data-toggle="dropdown" data-hover="dropdown" data-delay="200" class="dropdown-toggle nav-link">Accessories<b class="caret"></b></a>
                <ul class="dropdown-menu megamenu">
                  <li>
                    <div class="row">
                      <div class="col-md-6 col-lg-3">
                        <h5>Accessories</h5>
                        <ul class="list-unstyled mb-3">
                          <li class="nav-item"><a href="category.php?accessories-watches" class="nav-link">Watches</a></li>
                           </ul>
                         </div>
                       </div>
                  </li>
                </ul>
              </li>

              <li class="nav-item dropdown menu-large"><a href="#" data-toggle="dropdown" data-hover="dropdown" data-delay="200" class="dropdown-toggle nav-link">Template<b class="caret"></b></a>
                <ul class="dropdown-menu megamenu">
                  <li>
                    <div class="row">
                      <div class="col-md-6 col-lg-3">
                        <h5>Shop</h5>
                        <ul class="list-unstyled mb-3">
                          <li class="nav-item"><a href="index.php" class="nav-link">Homepage</a></li>
                          <li class="nav-item"><a href="category.php" class="nav-link">Category - sidebar left</a></li>
                          <li class="nav-item"><a href="category-right.php" class="nav-link">Category - sidebar right</a></li>
                          <li class="nav-item"><a href="category-full.php" class="nav-link">Category - full width</a></li>
                          <li class="nav-item"><a href="detail.php" class="nav-link">Product detail</a></li>
                        </ul>
                      </div>
                      <div class="col-md-6 col-lg-3">
                        <h5>User</h5>
                        <ul class="list-unstyled mb-3">
                          <li class="nav-item"><a href="register.php" class="nav-link">Register / login</a></li>
                          <li class="nav-item"><a href="customer-orders.php" class="nav-link">Orders history</a></li>
                          <li class="nav-item"><a href="customer-order.php" class="nav-link">Order history detail</a></li>
                          <li class="nav-item"><a href="customer-wishlist.php" class="nav-link">Wishlist</a></li>
                          <li class="nav-item"><a href="customer-account.php" class="nav-link">Customer account / change password</a></li>
                        </ul>
                      </div>
                      <div class="col-md-6 col-lg-3">
                        <h5>Order process</h5>
                        <ul class="list-unstyled mb-3">
                          <li class="nav-item"><a href="basket.php" class="nav-link">Shopping cart</a></li>
                          <li class="nav-item"><a href="checkout1.php" class="nav-link">Checkout - step 1</a></li>
                          <li class="nav-item"><a href="checkout2.php" class="nav-link">Checkout - step 2</a></li>
                          <li class="nav-item"><a href="checkout3.php" class="nav-link">Checkout - step 3</a></li>
                          <li class="nav-item"><a href="checkout4.php" class="nav-link">Checkout - step 4</a></li>
                        </ul>
                      </div>
                      <div class="col-md-6 col-lg-3">
                        <h5>Pages and blog</h5>
                        <ul class="list-unstyled mb-3">
                          <li class="nav-item"><a href="blog.php" class="nav-link">Blog listing</a></li>
                          <li class="nav-item"><a href="post.php" class="nav-link">Blog Post</a></li>
                          <li class="nav-item"><a href="faq.php" class="nav-link">FAQ</a></li>
                          <li class="nav-item"><a href="text.php" class="nav-link">Text page</a></li>
                          <li class="nav-item"><a href="text-right.php" class="nav-link">Text page - right sidebar</a></li>
                          <li class="nav-item"><a href="404.php" class="nav-link">404 page</a></li>
                          <li class="nav-item"><a href="contact.php" class="nav-link">Contact</a></li>
                        </ul>
                      </div>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
            <div class="navbar-buttons d-flex justify-content-end">
              <!-- /.nav-collapse-->
              <div id="search-not-mobile" class="navbar-collapse collapse"></div><a data-toggle="collapse" href="#search" class="btn navbar-btn btn-primary d-none d-lg-inline-block"><span class="sr-only">Toggle search</span><i class="fa fa-search"></i></a>

              <?php if(isset($_SESSION['uid'])) {  ?>
              <div id="basket-overview" class="navbar-collapse collapse d-none d-lg-block"><a href="basket.php" class="btn btn-primary navbar-btn"><i class="fa fa-shopping-cart"></i><span><?= $totalCart ?> items in cart</span></a></div>
               <?php } else { ?>
                  <div id="basket-overview" class="navbar-collapse collapse d-none d-lg-block"><a href="#" data-toggle="modal" data-target="#login-modal" class="btn btn-primary navbar-btn"><i class="fa fa-shopping-cart"></i>cart</a></div>
               <?php } ?>

            </div>
          </div>
        </div>
      </nav>
      <div id="search" class="collapse">
        <div class="container">
          <form role="search" class="ml-auto" method="post" action="search.php" name="srch">
            <div class="input-group">
              <input type="text" placeholder="Search" class="form-control" name="search" id="srch" onBlur="disppearSrch()">
              <div class="input-group-append">
                <button type="submit" name="Search" class="btn btn-primary" onclick="return(submitreg2());"><i class="fa fa-search"></i></button>
              </div>
              <span id='info' class='text-danger mx-3'></span>
            </div>
          </form>
        </div>
      </div>
    </header>
<?php
    if(isset($_REQUEST[ 'Search'])) { 
      //$url = "http://localhost:8080/online_store/search.php?search=". $user->safe($_POST['search']) ."";
  //header("Location: $url");
  //include('./search.php?search='. $user->safe($_POST['search']) .'');
}

           