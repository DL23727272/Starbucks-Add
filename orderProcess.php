<?php
include "myConnection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['customerID']) && isset($_POST['items'])) {
    $customerID = $_POST['customerID'];
    $items = json_decode($_POST['items'], true); // Decode the JSON string into an array

    // Check if customerID is valid
    $customerCheckQuery = "SELECT * FROM customer_table WHERE customerID = '$customerID'";
    $customerResult = mysqli_query($con, $customerCheckQuery);

    if (mysqli_num_rows($customerResult) == 1) {
        // CustomerID is valid, proceed with order processing
        $totalPrice = 0;

        // Calculate total price
        foreach ($items as $item) {
            $totalPrice += $item['total'];
        }

        // Insert order into orders_table
        $insertOrderQuery = "INSERT INTO order_table (customerID, totalPrice, status) VALUES ('$customerID', '$totalPrice', 'Pending')";

        if (mysqli_query($con, $insertOrderQuery)) {
            // Get the ID of the inserted order
            $orderID = mysqli_insert_id($con);

            // Insert order items into order_items_table
            foreach ($items as $item) {
                $productID = $item['productId'];
                $productPrice = $item['productPrice'];
                $quantity = $item['quantity'];
                $subtotal = $item['total'];

                $insertOrderItemQuery = "INSERT INTO order_items_table (orderID, productID, quantity, pricePerItem, subtotal) 
                VALUES ('$orderID', '$productID', '$quantity', '$productPrice', '$subtotal')";
                mysqli_query($con, $insertOrderItemQuery);
            }

            // Order successfully inserted
            $response = [
                'status' => 'success',
                'message' => 'Order placed successfully! <i class="fa fa-spinner fa-spin"></i> ',
                'orderID' => $orderID
            ];
        } else {
            // Failed to insert order
            $response = [
                'status' => 'error',
                'message' => 'Failed to place order. Please try again later.'
            ];
        }
    } else {
        // Invalid customerID
        $response = [
            'status' => 'error',
            'message' => 'Invalid customerID.'
        ];
    }
} else {
    // Invalid request method or missing parameters
    $response = [
        'status' => 'error',
        'message' => 'Invalid request. Please provide customerID and items.'
    ];
}

header('Content-Type: application/json');
echo json_encode($response);
?>
