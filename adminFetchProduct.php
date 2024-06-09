<?php
session_start();
include 'myConnection.php';

function fetchProducts($con) {
    $sql = "SELECT * FROM product_table";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        $productHtml = '';
        $productCount = 0;

        $productHtml .= '<div class="row justify-content-center m-2">';
        
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
                                    <button type="button" class="btn btn-primary mt-3" onclick="updateProduct('. $productID .')">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Modal -->
            ';

            $productCount++;

            if ($productCount % 3 == 0) {
                $productHtml .= '</div><div class="row justify-content-center m-2">';
            }
        }

        if ($productCount % 3 != 0) {
            $productHtml .= '</div>';
        }

        echo $productHtml;
    } else {
        echo "No products found.";
    }
}

fetchProducts($con);
?>