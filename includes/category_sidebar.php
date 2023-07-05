 <?php 



 ?>

 <!--
              *** MENUS AND FILTERS ***
              _________________________________________________________
              -->
              <div class="card sidebar-menu mb-4">
                <div class="card-header">
                  <h3 class="h4 card-title">Categories</h3>
                </div> 
                <div class="card-body">
                  <ul class="nav nav-pills flex-column category-menu">
                    <li><a href="category-full.php?men" class="nav-link">Men <span class="badge badge-secondary"><?= $totalMen ?></span></a>
                      <ul class="list-unstyled">
                        <li class=""><a href="category.php?men-t-shirt" class="nav-link">T-shirts</a></li>
                          <li class=""><a href="category.php?men-shirt" class="nav-link">Shirts</a></li>
                          <li class=""><a href="category.php?men-pants" class="nav-link">Pants</a></li>
                          <li class=""><a href="category.php?men-accessories" class="nav-link">Accessories</a></li>
                      </ul>
                    </li>
                    <li><a href="category-full.php?ladies" class="nav-link">Ladies  <span class="badge badge-secondary"><?= $totalLadies ?></span></a>
                      <ul class="list-unstyled">
                        <li class=""><a href="category.php?ladies-t-shirt" class="nav-link">T-shirts</a></li>
                          <li class=""><a href="category.php?ladies-shirt" class="nav-link">Shirts</a></li>
                          <li class=""><a href="category.php?ladies-pants" class="nav-link">Pants</a></li>
                          <li class=""><a href="category.php?ladies-dresses" class="nav-link">Dresses</a></li>
                          <li class=""><a href="category.php?ladies-accessories" class="nav-link">Accessories</a></li>
                      </ul>
                    </li>
                    <li><a href="category-full.php?accessories" class="nav-link">Accessories  <span class="badge badge-secondary"><?= $totalAccessories ?></span></a>
                      <ul class="list-unstyled">
                         <li class=""><a href="category.php?accessories-watches" class="nav-link">Watches</a></li>
                      </ul>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="card sidebar-menu mb-4">
                <div class="card-header">
                  <h3 class="h4 card-title">Brands <a href="#" class="btn btn-sm btn-danger pull-right"><i class="fa fa-times-circle"></i> Clear</a></h3>
                </div>
                <div class="card-body">
                  <form>
                    <div class="form-group">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox"> Armani  (<?= $totalBrand1 ?>)
                        </label>
                      </div>
                      <div class="checkbox">
                        <label>
                          <input type="checkbox"> Versace  (<?= $totalBrand2 ?>)
                        </label>
                      </div>
                      <div class="checkbox">
                        <label>
                          <input type="checkbox"> Gucci  (<?= $totalBrand3 ?>)
                        </label>
                      </div>
                      <div class="checkbox">
                        <label>
                          <input type="checkbox"> Nike  (<?= $totalBrand4 ?>)
                        </label>
                      </div>
                    </div>
                    <button class="btn btn-default btn-sm btn-primary"><i class="fa fa-pencil"></i> Apply</button>
                  </form>
                </div>
              </div>
              <div class="card sidebar-menu mb-4">
                <div class="card-header">
                  <h3 class="h4 card-title">Colours <a href="#" class="btn btn-sm btn-danger pull-right"><i class="fa fa-times-circle"></i> Clear</a></h3>
                </div>
                <div class="card-body">
                  <form>
                    <div class="form-group">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox"><span class="colour white"></span> White (<?= $totalColor1 ?>)
                        </label>
                      </div>
                       <div class="checkbox">
                        <label>
                          <input type="checkbox"><span class="colour black"></span> Black (<?= $totalColor2 ?>)
                        </label>
                      </div>
                      <div class="checkbox">
                        <label>
                          <input type="checkbox"><span class="colour blue"></span> Blue (<?= $totalColor3 ?>)
                        </label>
                      </div>
                      <div class="checkbox">
                        <label>
                          <input type="checkbox"><span class="colour green"></span>  Green (<?= $totalColor4 ?>)
                        </label>
                      </div>
                      <div class="checkbox">
                        <label>
                          <input type="checkbox"><span class="colour yellow"></span>  Yellow (<?= $totalColor5 ?>)
                        </label>
                      </div>
                      <div class="checkbox">
                        <label>
                          <input type="checkbox"><span class="colour red"></span>  Red (<?= $totalColor6 ?>)
                        </label>
                      </div>
                    </div>
                    <button class="btn btn-default btn-sm btn-primary"><i class="fa fa-pencil"></i> Apply</button>
                  </form>
                </div>
              </div>
              <!-- *** MENUS AND FILTERS END ***-->
              <div class="banner"><a href="#"><img src="img/banner.jpg" alt="sales 2014" class="img-fluid"></a></div>
            </div>