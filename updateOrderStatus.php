<?php
session_start();
include "myConnection.php"; 

    // Function to update order status
    function updateOrderStatus($con, $orderID, $newStatus) {
        // Query to update the status of the order
        $updateQuery = "UPDATE order_table SET status = '$newStatus' WHERE orderID = $orderID";
        $result = mysqli_query($con, $updateQuery);

        if ($result) {
            echo "success"; // Output a simple success message
        } else {
            echo "error"; // Output an error message if the update fails
        }
    }

    // Check if orderID and newStatus are set in the POST request
    if (isset($_POST['orderID'], $_POST['newStatus'])) {
        $orderID = $_POST['orderID'];
        $newStatus = $_POST['newStatus'];

        // Call the function to update the order status
        updateOrderStatus($con, $orderID, $newStatus);
    }
?>
