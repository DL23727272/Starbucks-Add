<?php

include 'myConnection.php';

$query = "SELECT COUNT(*) AS product_count FROM product_table";
$result = mysqli_query($con, $query);

$totalProducts = 0; 

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $totalProducts = $row['product_count'];
    }

    echo  $totalProducts
?>