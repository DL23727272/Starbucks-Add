<?php
session_start();

include "myConnection.php"; // Include your database connection file

function countOrders($con) {
    // Check if customerID is set in the GET parameters
    if(isset($_GET['customerID'])) {
        $customerID = $_GET['customerID'];

        // Query to fetch orders for the current customer
        $countQuery = "SELECT COUNT(*) AS totalOrders FROM order_table WHERE customerID = $customerID";
        $result = mysqli_query($con, $countQuery);

        // Check if the query was successful
        if($result) {
            // Fetch the total number of orders
            $row = mysqli_fetch_assoc($result);
            $totalOrders = $row['totalOrders'];

            // Return the total number of orders
            return $totalOrders;
        } else {
            // Return an error message if the query fails
            return "Error: Unable to fetch orders.";
        }
    } else {
        // Return an error message if customerID is not provided
        return "Error: Customer ID not provided.";
    }
}
echo countOrders($con); //echo lang ang kulang grabe sayang 10mins
?>
