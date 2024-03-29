<?php
session_start();
include "myConnection.php"; 

// Function to fetch latest orders
function fetchLatestOrders($con) {
  // Query to fetch the latest orders
  $latestOrdersQuery = "SELECT * FROM order_table ORDER BY orderDate DESC LIMIT 5"; 
  $result = mysqli_query($con, $latestOrdersQuery);

  // Check if there are any orders
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      // Output HTML for each order
      echo "<div>";
      echo "Order ID: " . $row['orderID'] . " | Customer ID: " . $row['customerID'] . " | Order Date: " . $row['orderDate'] . " | Total Price: " . $row['totalPrice'] . " | Status: " . $row['status'];
      echo "</div>";
    }
  } else {
    // If no orders found
    echo "No orders found.";
  }
}

// Call the function to fetch latest orders
fetchLatestOrders($con);
?>
