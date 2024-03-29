<?php
session_start();

include "myConnection.php"; // Include your database connection file

function displayOrders($con) {

    $customerID = $_GET['customerID'];

    // Query to fetch orders for the current customer
    $ordersQuery = "SELECT * FROM order_table WHERE customerID = $customerID";
    $result = mysqli_query($con, $ordersQuery);
    

    // Check if there are any orders
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $orderID = $row['orderID'];
            $totalPrice = $row['totalPrice'];

            // Accordion setup
            echo "<div class='accordion mt-4' id='accordion$orderID' style='width: 100%;'>";
            echo "<div class='accordion-item'>";
            echo "<h2 class='accordion-header'>";
            echo "<button class='accordion-button' type='button' data-bs-toggle='collapse' data-bs-target='#collapse$orderID' aria-expanded='true' aria-controls='collapse$orderID'>";
            echo "<b>Order No: $orderID</b>";
            echo "</button>";
            echo "</h2>";
            echo "<div id='collapse$orderID' class='accordion-collapse collapse' data-bs-parent='#accordion$orderID'>";
            echo "<div class='accordion-body'>";

            // Table setup for order details
            echo "<table class='table'>";
            echo "<thead class='text-center'>";
            echo "<tr>";
            echo "<th colspan='3' class='bg-info text-dark'>Total Amount: Php $totalPrice</th>";
            echo "</tr>";
            echo "<tr>";
            echo "<th class='bg-primary text-white'>Product Name</th>";
            echo "<th class='bg-success text-white'>Quantity</th>";
            echo "<th class='bg-warning text-white'>Total</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";

            // Query to fetch order items for the current orderID
            $orderItemsQuery = "SELECT oi.quantity, oi.subtotal, p.productName 
                                FROM order_items_table oi
                                INNER JOIN product_table p ON oi.productID = p.productID
                                WHERE oi.orderID = $orderID";

            $itemsResult = mysqli_query($con, $orderItemsQuery);

            // Display order items in the table
            echo "<tbody>";
            while ($item = mysqli_fetch_assoc($itemsResult)) {
                $productName = $item['productName'];
                $quantity = $item['quantity'];
                $subtotal = $item['subtotal'];

                echo "<tr class='text-center'>";
                echo "<td>$productName</td>";
                echo "<td>$quantity</td>";
                echo "<td>$subtotal</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";

            echo "</div>"; // accordion-body
            echo "</div>"; // accordion-collapse
            echo "</div>"; // accordion-item
            echo "</div>"; // accordion

        }
    } else {
        echo "No orders found.";
    }
}

// Call the function to display orders
displayOrders($con);
?>
