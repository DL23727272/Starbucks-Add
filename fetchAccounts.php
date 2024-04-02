<?php
session_start();
include "myConnection.php";

function fetchAccounts($con) {
    // Query to fetch accounts data from the customer_table
    $accountsQuery = "SELECT * FROM customer_table";
    $result = mysqli_query($con, $accountsQuery);

    // Check if there are any accounts
    if (mysqli_num_rows($result) > 0) {
        // Start constructing the HTML string for accounts
        $accountHtml = '';
        while ($row = mysqli_fetch_assoc($result)) {
            // Get the customer ID
            $customerID = $row['customerID'];
            
            // Construct HTML for each account including a modal
            $accountHtml .= '
                <div class="card my-2">
                    <div class="card-body">
                        <h5 class="card-title">Customer name: ' . $row['customerName'] . '</h5>
                        <p class="card-text">Email: ' . $row['customerEmail'] . '</p>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop' . $customerID . '">
                              Edit user
                            </button>
                            
                            <!-- Modal -->
                            <div class="modal fade" id="staticBackdrop' . $customerID . '" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel' . $customerID . '" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel' . $customerID . '">Modal title</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                  <h5 class="card-title">Customer name: </h5>
                                  <input value="' . $row['customerName'] . '"></input>
                                  <p class="card-text">Email: </p>
                                  <input value="' . $row['customerEmail'] . '"></input>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Understood</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                        <!-- Add more account details here as needed -->
                    </div>
                </div>
            ';
        }

        // Output the constructed HTML for accounts
        echo $accountHtml;
    } else {
        // Output message if no accounts found
        echo "No accounts found.";
    }
}

// Call the function to fetch accounts data
fetchAccounts($con);
?>
