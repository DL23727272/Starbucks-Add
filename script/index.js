 alertify.set('notifier', 'position', 'top-right');

      $(document).ready(function () {
        $('#modalContainer').load('modal.html');
      });
    
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
     
      //form validation
      function Login() {
          var username = document.getElementById("customerName").value;
          var password = document.getElementById("customerPassword").value;
      
          if (username == "" && password == "") {
              alertify.error('Empty fields! Please fill all the fields.');
          } else if (username == "") {
              alertify.error('Fill up the Username field!');
          } else if (password == "") {
              alertify.error('Fill up the Password field!');
          } else {
              // Send form data to loginProcess.php using AJAX
              $.ajax({
                  type: "POST",
                  url: "./backend/loginProcess.php",
                  data: {
                      customerLoginName: username,
                      customerLoginPassword: password
                  },
                  dataType: "json",
                  success: function(response) {
                      // Handle success response
                      if (response.status === 'success') {

                          // if login goods 
                          //alertify.success(response.message + ' <i class="fa fa-spinner fa-spin"></i>');
                          Swal.fire({
                            icon: 'success',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 2000 
                          });
                          

                          var customerID = response.customerID;
                          sessionStorage.setItem('customerID', customerID);
      
                          var customerNameInput = document.getElementById("customerName").value;
                          var customerName = customerNameInput;
                          sessionStorage.setItem('customerName', customerName); //tangina  40mins para dito
      
                          setTimeout(function() {

                              // condition for the type if admin or user

                              if (response.userType === 'admin') {
                                  window.location.href = 'admin'; 
                              } else {
                                  window.location.href = 'home'; 
                              }

                          }, 2000);
      
                      } else {
                        //  alertify.error(response.message);// Display error message 
                          Swal.fire({
                            icon: 'error',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 1500 
                          });
                          
                      }
                  },
                  error: function(xhr, status, error) {
                      console.error(xhr.responseText);
                      alertify.error('Failed to log in!');
                  }
              });
          }
      }
    

      function Signup() {
        // Get form data
        var customerSignUpEmail = $("#customerSignUpEmail").val();
        var customerSignUpName = $("#customerSignUpName").val();
        var customerSignUpPassword = $("#customerSignUpPassword").val();
        var customerPhoneNumber = $("#customerPhoneNumber").val(); 
        var customerAddress = $("#customerAddress").val(); 
        var checkSignUpPassword = $("#checkSignUpPassword").val();

        //check the password if matched
        if (customerSignUpPassword !== checkSignUpPassword) {
            alertify.error('Passwords do not match!');
            return; 
        }
  
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
                        //alertify.success(response.message);
                        Swal.fire({
                          icon: 'success',
                          title: response.message,
                          showConfirmButton: false,
                          timer: 2000 
                        });
                        $('#exampleModal').modal('hide');
                    } else {
                        alertify.error(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    // Handle error response
                    console.error(xhr.responseText);
                    alertify.error('Failed to sign up!');
                }
            });
        }
      }

       //FOR NOW LOAD PRODUCTS USING indexFetchProduct.PHP  (updated php file to load prodducts here on index page, diko na pinalitan function name)
      function adminLoadProducts(productType, targetElementId) {
        $.ajax({
            url: './backend/indexFetchProduct.php',
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