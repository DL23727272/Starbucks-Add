 //For navbar
        window.onscroll = function () { scrollFunction() };

        function scrollFunction() {
          if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
            document.getElementById("navbar").classList.add("blurred");
            const navLinks = document.querySelectorAll(".nav-link");
            navLinks.forEach(link => link.classList.add("scrolled"));
            document.getElementById("mugIcon").classList.add("scrolled"); 
          } else {
            document.getElementById("navbar").classList.remove("blurred");
            const navLinks = document.querySelectorAll(".nav-link");
            navLinks.forEach(link => link.classList.remove("scrolled"));
            document.getElementById("mugIcon").classList.remove("scrolled");
          }
        }
        //end of function for navbarrr
      
        // For carousel na nag chachange image
        function imgSlider(anything){
          document.querySelector('.starbucks').src = anything;
        }

        alertify.set('notifier', 'position', 'top-right');
        alertify.set('notifier', 'delay', 5);
        


         // Function to update cart count sa navbar
        function updateCartCount() {
            var cartItems = JSON.parse(localStorage.getItem("cartItems")) || [];
            var totalCount = 0;
            
            cartItems.forEach(function(item) {
                totalCount += item.quantity;
            });
        
            // Update the cart count in the HTML
            document.getElementById('cartCount').innerText = totalCount;
            
            // Store the cart count in local storage
            localStorage.setItem("cartCount", totalCount);
        }

        function displayCartCount() {
            var totalCount = localStorage.getItem("cartCount") || 0;
            document.getElementById('cartCount').innerText = totalCount;
        }

        displayCartCount();
        
      //  $(document).ready(function () {
        window.onload = function (){
          $('#modalContainer').load('modal.html');

          $('#total').hide()
          $(".addtocart").click(function () {
            
              var productId = $(this).data("product-id");
              var productName = $(this).data("product-name");
              var productImage = $(this).data("product-image");
              var productDetail = $(this).data("product-detail");
              var productPrice = $(this).data("product-price");
              var productType = $(this).data("product-type");

              //ayaw magpakita yung picture sa modal 
              console.log("Product Image URL:", productImage);
              console.log("Product ID:", productId);
              console.log("Product Name:", productName);
              console.log("Product Image:", productImage);
              console.log("Product Detail:", productDetail);
              console.log("Product Price:", productPrice);
              console.log("Product Type:", productType);
              
              $("#modalProduct #fruitname").text(productName);
              $("#modalProduct #fruitprice").text("Php " + productPrice);
              $("#modalProduct #fruitdetail").text(productDetail);
              $("#modalProduct #fruitimage").attr("src", "/3rdyr/hendrick/products/" + productImage); //Palitan niyo para magpakita yung image

              //FUnction for Increment Button on MOdal product
              $("#increment").click(function () {
                  let quantity = parseInt($("#quantity").val());
                  quantity += 1; 
                  $("#quantity").val(quantity); 
                  $('#total').show();
                  $('#total').val(productPrice * quantity); 
              });
            
              //FUnction for Decrement Button on MOdal product
              $("#decrement").click(function () {
                  let quantity = parseInt($("#quantity").val());
                  if (quantity > 0) {
                      quantity -= 1; 
                      $("#quantity").val(quantity); 
                      $('#total').show();
                      $('#total').val(productPrice * quantity); 
                  }
              });
            
              $('#close').click(function(){
                $('#quantity').val(0);
                $('#total').hide()

                //mahirap na bug requires modern solution reload para di mag double yung Qt sa modal
                setTimeout(function () {
                    location.reload();
                }, 10);
              });

              $('#buy').click(function () {
                  //alertify.success('Item added to cart!');
                  Swal.fire({
                    icon: 'success',
                    title: 'Item added to cart!',
                    showConfirmButton: false,
                    timer: 1500 
                  });
                  
                  var quantity = parseInt($("#quantity").val());
                  var total = productPrice * quantity;
              
                  var cartItem = {
                      productId: productId, 
                      productName: productName,
                      productPrice: productPrice,
                      quantity: quantity,
                      total: total
                  };
              
                  // Store the cart item in localStorage
                  var cartItems = JSON.parse(localStorage.getItem("cartItems")) || [];
                  cartItems.push(cartItem);
                  localStorage.setItem("cartItems", JSON.stringify(cartItems));
              
                  // Clear the quantity after adding to cart
                  $("#quantity").val(0);
              
                  setTimeout(function () {
                      location.reload();
                  }, 2000);
                  updateCartCount();
              });
            
            
              // Function to display cart items
              function displayCartItems() {
                    var cartItems = JSON.parse(localStorage.getItem("cartItems")) || [];
                    var cartOutput = "Product Name\tQuantity\tTotal\n";
              }
              
              // Display cart items when the page loads
              displayCartItems();
              
        
          });
        }

         
            
        function adminLoadProducts(productType, targetElementId) {
          $.ajax({
              url: './backendfetchProduct.php',
              method: 'POST', 
              data: { productType: productType },
              success: function (data) {
                  if (data.trim() === '') {
                      $('#' + targetElementId).append('<div><p>No products available.</p></div>');
                  } else {
                      $('#' + targetElementId).append(data);
                  }
              },
              error: function () {
                  $('#' + targetElementId).append('<div><p>Error loading products. Please try again later.</p></div>');
              }
          });
        }
  
        // Load Coffee products
        $(document).ready(function () {
          adminLoadProducts('drink', 'drink');
        });
  
        // Load Food products
        $(document).ready(function () {
          adminLoadProducts('food', 'food');
        });
  
        // Load Desserts products
        $(document).ready(function () {
          adminLoadProducts('dessert', 'dessert');
        });
  