<?php
session_start();
include "myConnection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extract form data
    $customerID = $_POST['customerID'];
    $name = $_POST['editName'];
    $email = $_POST['editEmail'];
    $type = $_POST['editType'];

    $updateQuery = "UPDATE customer_table SET customerName = '$name', customerEmail = '$email', type = '$type' WHERE customerID = '$customerID'";
    if (mysqli_query($con, $updateQuery)) {
        echo "User information updated successfully.";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>
