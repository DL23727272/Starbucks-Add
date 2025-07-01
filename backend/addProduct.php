<?php

include "../backend/myConnection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productName = $_POST['productName'];
    $productDescription = $_POST['productDescription'];
    $productPrice = $_POST['productPrice'];
    $productType = $_POST['productType'];

    $image = basename($_FILES['image']['name']);
    $extension = pathinfo($image, PATHINFO_EXTENSION);
    $rand = rand(10000, 99999);
    $newImageName = pathinfo($image, PATHINFO_FILENAME) . $rand . '.' . $extension;

    $uploadPath = "../products/" . $newImageName;
    $isUploaded = move_uploaded_file($_FILES["image"]["tmp_name"], $uploadPath);

    if ($isUploaded) {
        $sql = "INSERT INTO product_table (productName, productDesc, productPrice, productImage, productType) 
                VALUES ('$productName', '$productDescription', '$productPrice', '$newImageName', '$productType')";

        $query = mysqli_query($con, $sql);

        if ($query === true) {
            echo "Product inserted successfully";
        } else {
            echo "Error inserting product: " . mysqli_error($con);
        }
    } else {
        echo "File upload failed";
    }
} else {
    echo "Invalid request method";
}
?>
