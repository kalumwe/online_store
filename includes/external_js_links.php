    
    
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="vendor/owl.carousel/owl.carousel.min.js"></script>
    <script src="vendor/owl.carousel2.thumbs/owl.carousel2.thumbs.js"></script>
    <script src="js/front.js"></script>

    <!--forms validation scripts-->
    <script language="javascript" type="text/javascript" src="./js/validate.js"></script>

<!--------------------------------------------------------------------------------------------
---------------------------------------------------------------------------------------------->


<!--scripts for addig, removing and updtading product cart items-->

<script>
  //Ajax using GET to add item to cart
  function  addToCart(productId, totalCart) {
      
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Request was successful, update the button text and disable the button
            const addToCartBtn = document.getElementById('addToCartBtn_'+productId+'');
            const totalCartItems = document.getElementById('totalCart');
            addToCartBtn.className = 'btn btn-outline-primary';
            addToCartBtn.textContent = 'Added to Cart';
            addToCartBtn.disabled = true;
            totalCart += 1;
            totalCartItems.textContent = totalCart +' items in cart ';
            

            // Optionally, you can also update the cart status on the page
           // document.getElementById('cartStatus').innerHTML = xhr.responseText;
            }
        };
        xhttp.open("GET", "./includes/add_cart.php?id="+ productId, true);
        xhttp.send();
        
}

</script>

<!--------------------------------------------------------------------------------------------
---------------------------------------------------------------------------------------------->

<script>
  //Ajax using GET to add item to wishlist 
  function  addToWishlist(productId) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Request was successful, update the button text and disable the button
            const addToCartBtn = document.getElementById('addToWishlistBtn_'+productId+'');
            addToCartBtn.className = 'btn btn-outline-info';
            addToCartBtn.textContent = 'Added to Wishlist';
            addToCartBtn.disabled = true;
            // Optionally, you can also update the cart status on the page
           // document.getElementById('cartStatus').innerHTML = xhr.responseText;
            }
        };
        xhttp.open("GET", "./includes/add_wishlist.php?id="+ productId, true);
        xhttp.send();
        
}

</script>
<!--------------------------------------------------------------------------------------------
---------------------------------------------------------------------------------------------->

<script>
  //Ajax using GET to delete items fron wishlist
  function  removeWishlist(productId) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Request was successful, update the button text and disable the button
           const removeCartItem = document.getElementById('WishlistItem_'+productId+'');
           removeCartItem.style.display = 'none';
            // Optionally, you can also update the cart status on the page
           // document.getElementById('cartStatus').innerHTML = xhr.responseText;
            }
        };
        xhttp.open("GET", "./includes/remove_wishlist.php?id="+ productId, true);
        xhttp.send();
        
}

</script>
<!--------------------------------------------------------------------------------------------
---------------------------------------------------------------------------------------------->

<script>
  //Ajax using GET to delete items fron cart 
  function  removeCartItem(productId) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Request was successful, update the button text and disable the button
           const removeCartItem = document.getElementById('cartItem_'+productId+'');
           removeCartItem.style.display = 'none';
            // Optionally, you can also update the cart status on the page
           // document.getElementById('cartStatus').innerHTML = xhr.responseText;
            }
        };
        xhttp.open("GET", "./includes/remove_cart.php?id="+ productId, true);
        xhttp.send();
        
}

</script>
<!--------------------------------------------------------------------------------------------
---------------------------------------------------------------------------------------------->

<script>
      //Ajax using GET to sort items on category page
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
<!--------------------------------------------------------------------------------------------
---------------------------------------------------------------------------------------------->

<script>
  //Ajax using GET to sort items on full category page 
  function sortDataFullCat() {
      
      var sortOption = document.getElementById("sortOptionFullCat").value;
      
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
             document.getElementById('catFullProducts').innerHTML = this.responseText;
             // console.log("value sent php successful");
            }
        };
        xhttp.open("GET", "./sort_full.php?sortOption=" + sortOption, true);
        xhttp.send();
        
}

</script>
<!--------------------------------------------------------------------------------------------
---------------------------------------------------------------------------------------------->


<script>
      //Ajax using GET for sorting on search page
      function sortDataSearch() {
          
          var sortOption = document.getElementById("sortOptionSearch").value;
          var searchedItem = document.getElementById("searchedItem").value;
          
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                 document.getElementById('searchProducts').innerHTML = this.responseText;
                 // console.log("value sent php successful");
                }
            };
            xhttp.open("GET", "./sort_search.php?sortOption=" + sortOption + "&search=" + searchedItem, true);
            xhttp.send();
            
    }
  
       </script>
 <!--------------------------------------------------------------------------------------------
---------------------------------------------------------------------------------------------->

<script>
    function addToCart1(productId) {
        // Send an AJAX request to add the product to the cart using post
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'add_cart.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Request was successful, update the button text and disable the button
                    const addToCartBtn = document.getElementById('addToCartBtn_'+productId+'');
                    addToCartBtn.className = 'btn btn-outline-primary';
                    addToCartBtn.textContent = 'Added to Cart';
                    addToCartBtn.disabled = true;

                    // Optionally, you can also update the cart status on the page
                   // document.getElementById('cartStatus').innerHTML = xhr.responseText;
                } else {
                    // Request failed, handle the error
                    console.error('Failed to add the product to the cart.');
                }
            }
        };
        xhr.send('product_id=' + encodeURIComponent(productId));
    }
</script>





