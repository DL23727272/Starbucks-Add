<?php
    session_start();
    include "myConnection.php"; // Include your database connection file

    function displayOrders($con) {
        // Assuming you have a database connection established ($con)

        // Query to fetch orders
        $ordersQuery = "SELECT * FROM order_table";
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
                echo "Order ID: $orderID (Total Amount: Php $totalPrice)";
                echo "</button>";
                echo "</h2>";
                echo "<div id='collapse$orderID' class='accordion-collapse collapse' data-bs-parent='#accordion$orderID'>";
                echo "<div class='accordion-body'>";
                
                // Table setup for order details
                echo "<table class='table'>";
                echo "<thead>";
                echo "<tr>";
                echo "<th>Product Name</th>";
                echo "<th>Quantity</th>";
                echo "<th>Total</th>";
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

                    echo "<tr>";
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
