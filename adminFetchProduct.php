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
                        <img src="products/'. $row['productImage'] .'" alt="Product Image" style="max-width: 100%; height: 200px; object-fit: cover; filter: drop-shadow(5px 5px 15px #006341)"/>
                    </div>
                    <hr class="border-success border-2"/>
                    <div>
                        <h4 class="card-title">'. $row['productName'] .'</h4>
                        <p class="card-text text-secondary">'. $row['productDesc'] .'</p>
                        <p class="card-text text-secondary"><i class="fa-solid fa-peso-sign"></i> '. $row['productPrice'] .'</p>
                    </div>
                    <div class="d-flex justify-content-between mt-3">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal'. $productID .'">Edit</button>
                        <button type="button" class="btn btn-danger" onclick="confirmDelete('. $productID .')">Delete</button>
                    </div>
                </div>
            ';

            // Add the modal for each product
            $productHtml .= '
                <!-- Edit Modal -->
                <div class="modal fade" id="editModal'. $productID .'" tabindex="-1" aria-labelledby="editModalLabel'. $productID .'" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel'. $productID .'">Edit Product</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="editForm'. $productID .'" method="POST">
                                    <input type="hidden" name="productID" value="'. $productID .'">
                                    <div class="mb-3">
                                        <label for="productName'. $productID .'" class="form-label">Product Name:</label>
                                        <input type="text" class="form-control" id="productName'. $productID .'" name="productName" value="'. $row['productName'] .'" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="productDesc'. $productID .'" class="form-label">Product Description:</label>
                                        <textarea class="form-control" id="productDesc'. $productID .'" name="productDesc" required>'. $row['productDesc'] .'</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="productPrice'. $productID .'" class="form-label">Product Price:</label>
                                        <input type="number" class="form-control" id="productPrice'. $productID .'" name="productPrice" value="'. $row['productPrice'] .'" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="productImage'. $productID .'" class="form-label">Product Image:</label>
                                        <input type="file" class="form-control" id="productImage'. $productID .'" name="productImage">
                                    </div>
                                    <div class="input-group mb-3">
                                        <label class="input-group-text" for="productType'. $productID .'">Product Type:</label>
                                        <select class="form-select" id="productType'. $productID .'" name="productType" required>
                                            <option value="food" '. ($row['productType'] == "food" ? "selected" : "") .'>Food</option>
                                            <option value="drink" '. ($row['productType'] == "drink" ? "selected" : "") .'>Drink</option>
                                            <option value="dessert" '. ($row['productType'] == "dessert" ? "selected" : "") .'>Dessert</option>
                                        </select>
                                    </div>

                                    <button type="button" class="btn btn-primary mt-3" onclick="updateProduct('. $productID .')">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Modal -->
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
