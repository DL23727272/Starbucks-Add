<?php
/*include 'myConnection.php';

if(isset($_POST['id'])) {
    $productID = $_POST['id'];
    
    $sql = "DELETE FROM product_table WHERE productID = $productID";

    if (mysqli_query($con, $sql)) {
        echo 'Success';
    } else {
        echo 'Error: ' . mysqli_error($con);
    }
} else {
    echo "Product ID not received"; 
}*/


//updated to delete product
include 'myConnection.php';

if(isset($_POST['id'])) {
    $productID = $_POST['id'];
    
    $sql = "DELETE FROM order_items_table WHERE productID = $productID";
    if (!mysqli_query($con, $sql)) {
        echo 'Error: ' . mysqli_error($con);
        exit;
    }
    
    $sql = "DELETE FROM product_table WHERE productID = $productID";
    if (mysqli_query($con, $sql)) {
        echo 'Success';
    } else {
        echo 'Error: ' . mysqli_error($con);
    }
} else {
    echo "Product ID not received"; 
}

?>
