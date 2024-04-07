<?php
session_start();
include "myConnection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extract form data
    $customerID = $_POST['customerID'];
    $name = $_POST['editName'];
    $email = $_POST['editEmail'];
    $type = $_POST['editType'];
    $phoneNumber = isset($_POST['editPhoneNumber']) ? $_POST['editPhoneNumber'] : null;
    $address = isset($_POST['editAddress']) ? $_POST['editAddress'] : null;

    $updateQuery = "UPDATE customer_table SET customerName = '$name', customerEmail = '$email', type = '$type'";
    
    if ($phoneNumber !== null) {
        $updateQuery .= ", phoneNumber = '$phoneNumber'";
    }

    if ($address !== null) {
        $updateQuery .= ", address = '$address'";
    }

    $updateQuery .= " WHERE customerID = '$customerID'";

    if (mysqli_query($con, $updateQuery)) {
        echo json_encode(['status' => 'success', 'message' => 'User information updated successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error: ' . mysqli_error($con)]);
    }
}
?>
