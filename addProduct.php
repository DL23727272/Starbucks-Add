<?php

include 'myConnection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productName = $_POST['productName'];
    $productDescription = $_POST['productDescription'];
    $productPrice = $_POST['productPrice'];
    $productType = $_POST['productType']; 
    
    $image = $_FILES['image']['name'];
    $extension = explode('.', $image);
    $rand = rand(10000, 99999);
    $newImageName = $extension[0] . $rand . '.' . $extension[1];
    $uploadPath = "products\\" . $newImageName;
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