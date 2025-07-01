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

      //fetch the customer order
      $(document).ready(function() {
          // Retrieve customer ID from sessionStorage
          var customerID = sessionStorage.getItem('customerID');
          console.log('Retrieved Customer ID: ' + customerID);

          
          // Check if customerID is present
          if (customerID) {
              // Send AJAX request to fetch orders for the customer in section orders
              $.ajax({
                url: './backend/customerOrders.php',
                method: 'GET',
                data: { customerID: customerID },
                success: function(response) {
                    $('#orders').html(response);

                    // Reload the orders section periodically
                    setInterval(function () {
                        $.ajax({
                            url: './backend/customerOrders.php',
                            method: 'GET',
                            data: { customerID: customerID },
                            success: function(newResponse) {
                                $('#orders').html(newResponse);
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                            }
                        });
                    }, 10000); // 10 seconds reload
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
            

            // Send AJAX request to fetch total number of orders for the customer
              $.ajax({
                  url: './backend/countOrders.php',
                  method: 'GET',
                  data: { customerID: customerID }, // Pass customerID to the PHP script
                  success: function(totalOrders) {
                      $('#totalOrders').text(totalOrders); // Update the total orders count in the HTML
                      console.log('TOTal Orders: ' + totalOrders); // debug statement
                  },
                  error: function(xhr, status, error) {
                      console.error(error);
                  }
              });

          } else {
              console.log('Customer ID not found in sessionStorage'); 
          }
      });
    
      

       alertify.set('notifier', 'position', 'top-right');
       alertify.set('notifier', 'delay', 5);

       document.addEventListener("DOMContentLoaded", function() {
            var customerID = sessionStorage.getItem('customerID');
            var customerName = sessionStorage.getItem('customerName');
            var cartItems = JSON.parse(localStorage.getItem("cartItems")) || [];
            // Check if customerID is present
            if (customerID) {
              document.getElementById('customerID').innerText = 'Customer Name: ' + customerName;
              console.log('Customer ID ' + customerID)
              console.log('Customer Name ' + customerName);
              console.log(cartItems)
               
            } else {
                console.log('Customer ID not found in sessionStorage'); 
            }
        });

          // Function to place an order
          function placeOrder() {
            var customerID = sessionStorage.getItem('customerID');
            var cartItems = JSON.parse(localStorage.getItem("cartItems")) || [];
            var paymentMethod;

            if (customerID && cartItems.length > 0) {
                var orderData = {
                    customerID: customerID,
                    items: JSON.stringify(cartItems), 
                    paymentMethod: paymentMethod 
                };

                // Show modal to select payment method
                Swal.fire({
                    title: 'Select Payment Method',
                    html: `
                        <select id="paymentMethod" name="paymentMethod" class="form-control">
                            <option value="cash">Cash</option>
                            <option value="gcash">GCash</option>
                        </select>
                    `,
                    showCancelButton: true,
                    confirmButtonText: 'Proceed',
                    preConfirm: () => {
                        return document.getElementById('paymentMethod').value;
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        paymentMethod = result.value; 
                        orderData.paymentMethod = paymentMethod; 

                        // Debugging: Log paymentMethod and orderData
                        console.log("Payment Method:", paymentMethod);
                        console.log("Order Data:", orderData); 

                        if (paymentMethod === 'cash') {
                            Swal.fire({
                                icon: 'info',
                                title: 'Please pay at the counter',
                                showConfirmButton: false,
                                timer: 2000
                            }).then(() => {
                                processOrder(orderData); 
                            });
                        } else if (paymentMethod === 'gcash') {
                            handleGCashPayment(orderData); 
                        }
                    }
                });
            } else {
                alert('Please log in or add items to your cart.');
            }
          }

          // Function to handle GCash payment
          function handleGCashPayment(orderData) {
            Swal.fire({
                title: 'GCash Payment',
                html: `
                    <div>
                        <img src="./img/DL.png" style="width: 200px; height: 200px;" alt="GCash QR Code">
                        <br><br>
                        <button id="paidButton" class="btn btn-success">Paid</button>
                        <button id="backButton" class="btn btn-secondary ms-2">Back to Selection</button>
                    </div>
                `,
                showCloseButton: true,
                showConfirmButton: false,
                allowOutsideClick: false 
            }).then((result) => {
                if (result.dismiss === Swal.DismissReason.close) {
                    // Handle case where modal is closed by the X button
                    console.log('GCash modal closed by X button');
                } else if (result.dismiss === Swal.DismissReason.backdrop) {
                    // Handle case where modal is closed by clicking outside
                    console.log('GCash modal closed by clicking outside');
                }
            });

            // Handle "Paid" button click
            $(document).on('click', '#paidButton', function() {
                orderData.paymentStatus = 'Paid - MOP: Gcash'; 
                processOrder(orderData); 
                Swal.close(); 
            });

            // Handle "Back to Selection" button click
            $(document).on('click', '#backButton', function() {
                Swal.close();
                placeOrder(); 
            });
          }

          // Function to process order
          function processOrder(orderData) {
            // Ajax call to orderProcess.php
            $.ajax({
                type: "POST",
                url: "./backend/orderProcess.php",
                data: orderData, // Send orderData including paymentMethod
                dataType: "json",
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 2000
                        }).then(() => {
                            location.reload(); // Reload the page after successful order
                            localStorage.removeItem("cartItems");
                            localStorage.setItem("cartCount", 0);
                            updateCartCount(); // Update cart count if necessary
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Failed to place order. Please try again later.',
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Failed to place order. Please try again later.',
                    });
                }
            });
          }




        //END ORDER FUNCTION

        //Para ito for displaying ng cart items 
        document.addEventListener("DOMContentLoaded", function () {
            const displayCartItems = () => {
                var cartItems = JSON.parse(localStorage.getItem("cartItems")) || [];

                var cartTableBody = document.getElementById("cartTableBody");
                var cartStatus = document.getElementById("cartStatus");
                var totalAmountElement = document.getElementById("totalAmount");

                cartTableBody.innerHTML = "";
                var totalAmount = 0;
                var totalItems = 0;

                // Iterate sa each cart item and append to the table
                cartItems.forEach(function (item, index) {

                    // Handle null or undefined total valuess
                    var total = item.total || 0;

                    if (cartItems.length === 0) {
                        cartStatus.style.display = "block";
                    } else {
                        cartStatus.style.display = "none";
                        var row = "<tr>" +
                            "<td>" + item.productName + "</td>" +
                            "<td>" + item.quantity + "</td>" +
                            "<td>" + total.toFixed(2) + "</td>" +
                            "<td><button class='btn btn-outline-danger cancel-btn' onclick='cancelItem(" + index + ")'>Cancel</button></td>" +
                            "</tr>";

                        // Append the row to the table body
                        cartTableBody.innerHTML += row;

                        // Update the totalAmount variable with the current item's total
                        totalAmount += total;

                        totalItems += item.quantity;
                    }
                });

                // Update the total amount and total items displayed on the page
                document.getElementById("totalAmount").innerText = "Php " + totalAmount.toFixed(2);
                
                document.getElementById("totalItems").innerText = totalItems;
            };

            // Call the displayCartItems function when the page loads
            displayCartItems();
        });

        //Cancel function on my cart
        function cancelItem(index) {

            //  alertify.success('Item canceled successfully!');
            Swal.fire({
              icon: 'success',
              title: 'Item canceled successfully!',
              showConfirmButton: false,
              timer: 1500 // Adjust the duration as needed
            });
            

              // Retrieve the cart items from localStorage
              var cartItems = JSON.parse(localStorage.getItem("cartItems")) || [];

              setTimeout(function () {
                          location.reload();
              }, 1000);

              // Check if the index is valid
              if (index >= 0 && index < cartItems.length) {
                  // Update the cart count by subtracting the quantity of the canceled item
                  var canceledItemQuantity = cartItems[index].quantity;
                  var totalCount = parseInt(localStorage.getItem("cartCount")) || 0;
                  totalCount -= canceledItemQuantity;
                  localStorage.setItem("cartCount", totalCount);
          
                  // Remove the item at the specified index from the array
                  cartItems.splice(index, 1);

                  // Update localStorage with the modified cartItems array
                  localStorage.setItem("cartItems", JSON.stringify(cartItems));

                  // Call the function to refresh the displayed cart items
                  displayCartItems();

                  // Update the cart count in the navbar
                  updateCartCount();

                  
                  if (window.location.pathname.includes('home.html')) {
                      // Retrieve the cartCount element from home.html and update its value
                      var cartCountElement = document.getElementById('cartCount');
                      if (cartCountElement) {
                          cartCountElement.innerText = totalCount;
                      }
                  }
                
              } else {
                  // Show an error message if the index is out of bounds
                  alertify.error('Invalid index for canceling item!');
              }
          }
      
       
       