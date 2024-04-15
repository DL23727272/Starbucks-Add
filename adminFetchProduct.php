<?php

    include 'myConnection.php';

    $sql = "SELECT * FROM product_table";
    $result = mysqli_query($con, $sql);

    $productCount = 0;

    echo '<div class="row justify-content-center m-2">';

    while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="card mt-4 m-3 p-3 col-12 col-md-6 col-lg-3">';
        echo '<div class="d-flex justify-content-center">';
        echo '<img src="products/'. $row['productImage'] .'" alt="Frontrow" style="max-width: 100%; height: 200px; object-fit: cover; filter: drop-shadow(5px 5px 15px #006341)"/>';
        echo '</div>';
        echo '<hr class="border-success border-2"/>';
        echo '<div>';
        echo '<h4 class="card-title" id="name'. $row['productID'] .'">'. $row['productName'] .'</h4>';
        echo '<p class="card-text text-secondary" id="productDesc">'. $row['productDesc'] .'</p>';
        echo '<p class="card-text text-secondary" id="productPrice"><i class="fa-solid fa-peso-sign"></i> '. $row['productPrice'] .'</p>';
        echo '</div>';
        echo '</div>';

        // Increment product count
        $productCount++;

        // Check if 3 products have been printed (to start a new row)
        if ($productCount % 3 == 0) {
            echo '</div>'; // Close the current row
            echo '<div class="row justify-content-center m-2">'; // Start a new row
        }
    }

    // Close the row if there are remaining products
    if ($productCount % 3 != 0) {
        echo '</div>';
    }


   