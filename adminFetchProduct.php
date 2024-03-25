<?php

    include 'myConnection.php';

    $sql = "SELECT * FROM product_table";
    $result = mysqli_query($con, $sql);

    $productCount = 0;

    echo '<div class="row">';

    while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="card m-4 p-3 col-12 col-md-6 col-lg-3">';
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

        // Check if 4 products have been printed (to start a new row)
        if ($productCount % 3 == 0) {
            echo '</div>'; // Close the current row
            echo '<div class="row">'; // Start a new row
        }
    }

    // Close the row if there are remaining products
    if ($productCount % 3 != 0) {
        echo '</div>';
    }


    // <button class="btn text-white addtocart" style="background-color: #006341" data-bs-toggle="modal" data-bs-target="#modalProduct"
    // data-product-id="'. $row['productID'] .'" data-product-name="'. $row['productName'] .'"
    // data-product-image="'. $row['productImage'] .'" data-product-price="'. $row['productPrice'] .'" data-product-detail="'. $row['productDesc'] .'">Select</button>
            // <div class="col-sm-3 mt-3">
			// 		<div class="card h-100">
			// 			<div class="h-50 d-flex">
			// 				<img id="image1" class="img-fluid card-img" src="products/'. $row['image'] .'" alt="Frontrow" style="margin:auto;">
			// 			</div>
			// 			<div class="card-body">
			// 				<h4 class="card-title" id="name'. $row['id'] .'">'. $row['productName'] .'</h4>
			// 				<p class="card-text">
			// 					<label>Php.</label>
			// 					<label id="price'. $row['id'] .'">'. $row['productPrice'] .'</label>
			// 					<label id="unit'. $row['id'] .'" name="'. $row['productUnit'] .'">/'. $row['productUnit'] .'</label>
			// 				</p>
			// 				<button type="button" class="btn btn-primary addtocart" id="'. $row['id'] .'">Add to Cart</button>
			// 			</div>
			// 		</div>
			// 	</div>
           
    
         
          