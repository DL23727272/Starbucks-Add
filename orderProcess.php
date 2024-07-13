<?php
include "myConnection.php";

// Function to sanitize input data
function sanitize($data) {
    global $con;
    return mysqli_real_escape_string($con, htmlspecialchars(strip_tags($data)));
}

// Check if POST request is received with required parameters
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['customerID']) && isset($_POST['items']) && isset($_POST['paymentMethod'])) {
    $customerID = sanitize($_POST['customerID']);
    $items = json_decode($_POST['items'], true);
    $paymentMethod = $_POST['paymentMethod']; 
    $paymentStatus = isset($_POST['paymentStatus']) ? sanitize($_POST['paymentStatus']) : 'Pending - MOP: Cash'; 

    // Check if customerID is valid
    $customerCheckQuery = "SELECT * FROM customer_table WHERE customerID = ?";
    $stmt_check_customer = mysqli_prepare($con, $customerCheckQuery);
    mysqli_stmt_bind_param($stmt_check_customer, "s", $customerID);
    mysqli_stmt_execute($stmt_check_customer);
    $customerResult = mysqli_stmt_get_result($stmt_check_customer);

    if (mysqli_num_rows($customerResult) == 1) {
        // CustomerID is valid, proceed with order processing

        $totalPrice = 0;

        // Calculate total price
        foreach ($items as $item) {
            $totalPrice += $item['total'];
        }

        // Insert order into order_table using prepared statement
        $insertOrderQuery = "INSERT INTO order_table (customerID, totalPrice, paymentMethod, paymentStatus, status) 
                            VALUES (?, ?, ?, ?, 'Pending')";
        $stmt = mysqli_prepare($con, $insertOrderQuery);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "idis", $customerID, $totalPrice, $paymentMethod, $paymentStatus);
            if (mysqli_stmt_execute($stmt)) {
                // Get the ID of the inserted order
                $orderID = mysqli_insert_id($con);

                // Insert order items into order_items_table
                $insertOrderItemQuery = "INSERT INTO order_items_table (orderID, productID, quantity, pricePerItem, subtotal) 
                                        VALUES (?, ?, ?, ?, ?)";
                $stmt_items = mysqli_prepare($con, $insertOrderItemQuery);
                if ($stmt_items) {
                    foreach ($items as $item) {
                        $productID = $item['productId'];
                        $productPrice = $item['productPrice'];
                        $quantity = $item['quantity'];
                        $subtotal = $item['total'];

                        mysqli_stmt_bind_param($stmt_items, "iiidd", $orderID, $productID, $quantity, $productPrice, $subtotal);
                        mysqli_stmt_execute($stmt_items);
                    }
                    mysqli_stmt_close($stmt_items);

                    // Order successfully inserted
                    $response = [
                        'status' => 'success',
                        'message' => 'Order placed successfully!',
                        'orderID' => $orderID
                    ];
                } else {
                    // Failed to prepare order items statement
                    $response = [
                        'status' => 'error',
                        'message' => 'Failed to place order. Please try again later.'
                    ];
                }
            } else {
                // Failed to execute insert order statement
                $response = [
                    'status' => 'error',
                    'message' => 'Failed to place order. Please try again later.'
                ];
            }
            mysqli_stmt_close($stmt);
        } else {
            // Failed to prepare insert order statement
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
        'message' => 'Invalid request. Please provide customerID, items, and paymentMethod.'
    ];
}

header('Content-Type: application/json');
echo json_encode($response);
?>
