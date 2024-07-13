<?php
include 'myConnection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productID = $_POST['productID'];
    $productName = $_POST['productName'];
    $productDesc = $_POST['productDesc'];
    $productPrice = $_POST['productPrice'];
    $productType = $_POST['productType']; // Added productType
    $productImage = $_FILES['productImage']['name'];

    if ($productImage) {
        $target = "products/" . basename($productImage);
        move_uploaded_file($_FILES['productImage']['tmp_name'], $target);
        $sql = "UPDATE product_table SET productName = '$productName', productDesc = '$productDesc', productPrice = '$productPrice', productImage = '$productImage', productType = '$productType' WHERE productID = $productID";
    } else {
        $sql = "UPDATE product_table SET productName = '$productName', productDesc = '$productDesc', productPrice = '$productPrice', productType = '$productType' WHERE productID = $productID";
    }

    if (mysqli_query($con, $sql)) {
        echo 'Success';
    } else {
        echo 'Error: ' . mysqli_error($con);
    }
}
?>
