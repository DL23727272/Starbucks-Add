
      alertify.set('notifier', 'position', 'top-right');
      alertify.set('notifier', 'delay', 5);
      
      //For navbar
      window.onscroll = function () { scrollFunction() };

      function scrollFunction() {
        if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
          document.getElementById("navbar").classList.add("blurred");
          const navLinks = document.querySelectorAll(".nav-link");
          navLinks.forEach(link => link.classList.add("scrolled"));
          document.getElementById("mugIcon").classList.add("scrolled"); // Add scrolled class to the icon
        } else {
          document.getElementById("navbar").classList.remove("blurred");
          const navLinks = document.querySelectorAll(".nav-link");
          navLinks.forEach(link => link.classList.remove("scrolled"));
          document.getElementById("mugIcon").classList.remove("scrolled"); // Remove scrolled class from the icon
        }
      }
      //end of function for navbarrr

      //Signup function
      function Signup() {
        // Get form data
        var customerSignUpEmail = $("#customerSignUpEmail").val();
        var customerSignUpName = $("#customerSignUpName").val();
        var customerSignUpPassword = $("#customerSignUpPassword").val();
        var customerPhoneNumber = $("#customerPhoneNumber").val(); 
        var customerAddress = $("#customerAddress").val(); 

        if (customerSignUpName === "" || customerSignUpPassword === "" || customerSignUpEmail === "" || customerPhoneNumber === "" || customerAddress === "") {
            alertify.error('Empty fields! Please fill all the fields.');
        } else {
            $.ajax({
                type: "POST",
                url: "./backend/signupProcess.php",
                data: {
                    customerSignUpEmail: customerSignUpEmail,
                    customerSignUpName: customerSignUpName,
                    customerSignUpPassword: customerSignUpPassword,
                    customerPhoneNumber: customerPhoneNumber,
                    customerAddress: customerAddress
                },
                dataType: "json",
                success: function(response) {
                    if (response.status === 'success') {
                     //   alertify.success(response.message);
                      Swal.fire({
                        icon: 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 2000 
                      });
                      setTimeout(function () {
                          location.reload();
                      }, 3000);
                    
                        $('#exampleModal').modal('hide');
                    } else {
                        alertify.error(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    // Handle error response
                    console.error(xhr.responseText);
                    alertify.error('Failed to sign up!');
                    // Display error message to the user
                }
            });
        }
      }


      //Status COunt 
      // AJAX request to fetch order counts from orderStatusCount.php
      function orderStatus(){
        $.ajax({
          url: './backend/orderStatusCount.php',
          method: 'GET',
          success: function(response) {
              // Parse the JSON response
              var counts = JSON.parse(response);

              // Update the respective elements with the fetched counts
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


      //Update function
      function updateUser(customerID) {
          var form = $('#editForm' + customerID);
          $.ajax({
              type: "POST",
              url: "./backend/updateUser.php",
              data: form.serialize(),
              success: function(response) {
                  // Handle success response
                  console.log(response);
              //    alertify.success('User updated successfully');
                  Swal.fire({
                    icon: 'success',
                    title: 'User updated successfully',
                    showConfirmButton: false,
                    timer: 2000 
                  });
                  $('#staticBackdrop' + customerID).modal('hide');
                  setTimeout(function () {
                      location.reload();
                  }, 3000);
                  
              },
              error: function(xhr, status, error) {
                  // Handle error
                  console.error(xhr.responseText);
              }
          });
      }
        $(document).ready(function() {
          $('#modalContainer').load('modal.html');
            // Fetch accounts data from the server
            $.ajax({
                url: './backend/fetchAccounts.php', 
                method: 'GET',
                dataType: 'html', 
                success: function(response) {
                    $('#account').html(response);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching accounts:', error);
                    $('#account').html('<p>Error fetching accounts. Please try again later.</p>');
                }
            });
        });
    
