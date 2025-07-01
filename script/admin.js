alertify.set('notifier', 'position', 'top-right');
      alertify.set('notifier', 'delay', 5);
      
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

      //UPdate the status pf the order

      function updateStatus(orderID, newStatus) {
        console.log('Order ID:', orderID);
          // Send AJAX request to update the status of the order
          $.ajax({
              url: './backend/updateOrderStatus.php',
              method: 'POST',
              data: { orderID: orderID, newStatus: newStatus },
              success: function(response) {
                  console.log("AJAX response:", response); // Debug statement
                  
                  if (response.trim() === 'success') {
                    //  alertify.success('The order has been updated successfully!');
                    Swal.fire({
                      icon: 'success',
                      title: 'The order has been updated successfully!',
                      showConfirmButton: false,
                      timer: 2000 
                    });

                  } else {
                      // gumagana na kaso nag aalert na failed lols debug naten gamit console.log
                      console.log("Failed to update order status. Response:", response); 
                      alertify.error('Failed to update order status. Please try again later.');
                  }
              },
              error: function(xhr, status, error) {
                  // Display an error message if the AJAX request fails
                  console.error("AJAX request failed:", error); // Debug statement
                  alertify.error('Failed to update order status. Please try again later.');
              }
          });
      }

      $(document).ready(function () {

            adminLoadProducts(); 
            
            $('#modalContainer').load('modal.html');

            // Ajax request to get total product count from PHP
            $.ajax({
                url: './backend/getTotalProductCount.php', 
                method: 'GET',
                success: function(response) {
                    $('#productCount').text(response); 
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching total product count:", error);
                }
            });

            //Status COunt  AJAX request to fetch order counts from orderStatusCount.php
            function orderStatus(){
              $.ajax({
                url: './backend/orderStatusCount.php',
                method: 'GET',
                success: function(response) {
                    // Parse the JSON response 
                    var counts = JSON.parse(response);
  
                    $('#pendingOrderCount').text(counts.pendingCount);
                    $('#processingOrderCount').text(counts.processingCount);
                    $('#completedOrderCount').text(counts.completedCount);
                    $('#cancelledOrderCount').text(counts.cancelledCount);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
              });

            }
            
            setInterval(orderStatus, 5000);

        
            //Add Product 
            $(document).on('click', '#addProductButton', function () {
                console.log("Submit button clicked"); // Debug statement
        
                // alertify.success("CLICKED");
        
                var formData = new FormData();
                formData.append('productName', $('#productName').val());
                formData.append('productPrice', $('#productPrice').val());
                formData.append('productDescription', $('#productDescription').val());
                formData.append('image', $('#productImageName')[0].files[0]);
                formData.append('productType', $('#productType').val());
        
                console.log("Form data:", formData); // Debug pppppppta ayaw mag function yung button
        
                $.ajax({
                    type: 'POST',
                    url: './backend/addProduct.php',
                    data: formData,
                    contentType: false,
                    processData: false,
                    beforeSend: function () {
                      
                        $('#addProductButton').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Submitting...');
                    },
                    success: function (response) {
                        console.log("AJAX request successful"); 
                        console.log("Response:", response); // check response  from server uo xd
        
                        if (response.trim() === 'Product inserted successfully') {
                          //  alertify.success('Product added successfully');
                            Swal.fire({
                              icon: 'success',
                              title: 'Product added successfully',
                              showConfirmButton: false,
                              timer: 2000 
                            });
                            $('#addProduct').modal('hide');
                            setTimeout(function () {
                                location.reload();
                            }, 3000);
                        } else {
                         //   alertify.error('Failed to add product');
                            Swal.fire({
                              icon: 'error',
                              title: 'Failed to add product',
                              showConfirmButton: false,
                              timer: 2000 
                            });
                            $('#addProductButton').prop('disabled', false).html('Submit');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error("AJAX request error:", xhr.responseText); // Debug statement
                        alertify.error('Error: ' + xhr.responseText);
                        $('#addProductButton').prop('disabled', false).html('Submit');
                    }
                });
            });

      });

      //Load ORDERS USING FETCHORDERS.PHP
      function loadOrders() { 
          $.ajax({
              url: './backend/adminFetchOrders.php',
              success: function(data) { 
                  if (data.trim() === '') {
                      $('#content').html('<div><p>NO ORDERS AVAILABLE</p></div>');
                  } else {
                      $('#content').html(data);
                  }
              },
              error: function() {
                  $('#content').html('<div><p>Error loading products. Please try again later.</p></div>');
              }
          });
      }
      
      //reload the content section  every 5 seconds
      setInterval(loadOrders, 5000); 
    
      
      //LOAD PRODUCTS USING ADMINLOADPRODUCTS.PHP      
      function adminLoadProducts(productType, targetElementId) {
        $.ajax({
            url: './backend/adminFetchProduct.php',
            method: 'POST', // Assuming you want to send POST data to fetch by product type
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

      function updateProduct(productID) {
        var formData = new FormData(document.getElementById('editForm' + productID));

        $.ajax({
            url: './backend/editProduct.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                // Handle success with SweetAlert
                Swal.fire({
                    title: 'Success!',
                    text: 'Product updated successfully!',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#editModal' + productID).modal('hide');
                        location.reload(); 
                    }
                });
            },
            error: function(xhr, status, error) {
                // Handle error with SweetAlert
                Swal.fire({
                    title: 'Error!',
                    text: 'Failed to update product: ' + error,
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });
      }

      function confirmDelete(productID) {
        console.log(productID);
          Swal.fire({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
              if (result.isConfirmed) {
                  deleteProduct(productID);
              }
          });
      }

      function deleteProduct(productID) {
          $.ajax({
              url: './backend/deleteProduct.php',
              type: 'POST',
              data: { id: productID },
              success: function(response) {
                  Swal.fire({
                      title: 'Deleted!',
                      text: 'Your product has been deleted.',
                      icon: 'success',
                      confirmButtonText: 'OK'
                  }).then((result) => {
                      if (result.isConfirmed) {
                          location.reload(); 
                      }
                  });
              },
              error: function(xhr, status, error) {
                  Swal.fire({
                      title: 'Error!',
                      text: 'Failed to delete product: ' + error,
                      icon: 'error',
                      confirmButtonText: 'OK'
                  });
              }
          });
      }