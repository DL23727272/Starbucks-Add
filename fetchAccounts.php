<?php
session_start();
include "myConnection.php";

  function fetchAccounts($con) {
      $accountsQuery = "SELECT * FROM customer_table";
      $result = mysqli_query($con, $accountsQuery);

      if (mysqli_num_rows($result) > 0) {
          $accountHtml = '';
          while ($row = mysqli_fetch_assoc($result)) {
              // Get the customer ID
              $customerID = $row['customerID'];
             
              
              $accountHtml .= '
                  <div class="card my-2">
                      <div class="card-body">
                          <h5 class="card-title">Customer name: ' . $row['customerName'] . '</h5>
                          <p class="card-text">Email: ' . $row['customerEmail'] . '</p>
                          <p class="card-text">Address: ' . $row['address'] . '</p>
                          <p class="card-text">Phone: ' . $row['phoneNumber'] . '</p>
                              <!-- Button trigger modal -->
                              <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop' . $customerID . '">
                                Edit user
                              </button>
                              
                              <!-- Modal -->
                              <div class="modal fade" id="staticBackdrop' . $customerID . '" data-bs-backdrop="static" data-bs-keyboard="false" 
                                   tabindex="-1" aria-labelledby="staticBackdropLabel' . $customerID . '" aria-hidden="true">
                                   
                                  <div class="modal-dialog">
                                      <div class="modal-content" style="background: rgba(255, 255, 255, 0.449);  backdrop-filter: blur(10px); ">
                                          <div class="modal-header">
                                              <img src="img/hero.png" alt="" style="width: 200px; ">
                                              <h1 class="modal-title fs-5" id="staticBackdropLabel' . $customerID . '"></h1>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          <div class="modal-body">
                                              <form id="editForm' . $customerID . '" action="updateUser.php" method="post">
                                                <div class="mb-3">
                                                    <label for="editName' . $customerID . '" class="form-label">Name:</label>
                                                    <input type="text" class="form-control" id="editName' . $customerID . '" name="editName" value="' . $row['customerName'] . '">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="editEmail' . $customerID . '" class="form-label">Email:</label>
                                                    <input type="email" class="form-control" id="editEmail' . $customerID . '" name="editEmail" value="' . $row['customerEmail'] . '">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="editPhoneNumber<?php echo $customerID; ?>" class="form-label">Phone Number:</label>
                                                    <input type="text" class="form-control" id="editPhoneNumber' . $customerID . '" name="editPhoneNumber" value="'. $row['phoneNumber'].'">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="editAddress<?php echo $customerID; ?>" class="form-label">Address:</label>
                                                    <textarea class="form-control" id="editAddress' . $customerID . '" name="editAddress">'. $row['address'].'</textarea>
                                                </div>
                                                
                                                <div class="mb-3">
                                                    <label for="editType' . $customerID . '" class="form-label">User Type:</label>
                                                    <select class="form-select" id="editType' . $customerID . '" name="editType">
                                                        <option value="user"' . ($row['type'] === 'user' ? ' selected' : '') . '>User</option>
                                                        <option value="admin"' . ($row['type'] === 'admin' ? ' selected' : '') . '>Admin</option>
                                                    </select>
                                                </div>


                                                  <input type="hidden" name="customerID" value="' . $customerID . '">
                                              </form>
                                          </div>
                                          <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                          <button type="button" class="btn btn-primary" onclick="updateUser(\'' . $customerID . '\')">Update</button>
                                      </div>
                                      </div>
                                  </div>
                              </div>
                            <!--End modal  -->

                      </div>
                  </div>
              ';
          }

          // Output the na gawaang HTML for accounts
          echo $accountHtml;
      } else {
          // Output message if no accounts found
          echo "No accounts found.";
      }
  }

// Call the function to fetch accounts data
fetchAccounts($con);
?>
