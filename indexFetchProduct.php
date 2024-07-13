<?php
session_start();
include 'myConnection.php';

// Function to fetch products by type
function fetchProductsByType($con, $productType) {
    $sql = "SELECT * FROM product_table WHERE productType = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "s", $productType);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $productHtml = '';

        while ($row = mysqli_fetch_assoc($result)) {
            $productID = $row['productID'];

            $productHtml .= '
                <div class="card mt-4 m-3 p-3 col-12 col-md-6 col-lg-3">
                    <div class="d-flex justify-content-center">
                        <img src="products/'. $row['productImage'] .'" alt="Product Image" style="max-width: 100%; height: 200px; object-fit: cover; filter: drop-shadow(5px 5px 15px #006341);"/>
                    </div>
                    <hr class="border-success border-2"/>
                    <div>
                        <h4 class="card-title" id="name'. $row['productID'] .'">'. $row['productName'] .'</h4>
                        <p class="card-text text-secondary" id="productDesc">'. $row['productDesc'] .'</p>
                        <p class="card-text text-secondary" id="productPrice"><i class="fa-solid fa-peso-sign"></i> '. $row['productPrice'] .'</p>
                        <p>
                            <a href="#" style="text-decoration: none; color: black;"
                               onmouseover="this.style.textDecoration=\'underline\'"
                               onmouseout="this.style.textDecoration=\'none\'">
                                Login
                            </a>
                            /
                            <a data-bs-toggle="modal" data-bs-target="#exampleModal" style="color: black; text-decoration: none; cursor: pointer;"
                               onmouseover="this.style.textDecoration=\'underline\'"
                               onmouseout="this.style.textDecoration=\'none\'">
                                Sign up
                            </a>
                            to order
                        </p>
                    </div>
                </div>
            ';
        }

        echo $productHtml;
    } else {
        echo "No products found."; // Echo this if no products are found
    }
}

// Handle AJAX request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['productType'])) {
        $productType = $_POST['productType'];
        fetchProductsByType($con, $productType);
    } else {
        echo "Product type parameter is missing."; // Echo this if productType parameter is missing
    }
} else {
    echo "Invalid request method."; // Echo this if request method is not POST
}
?>
