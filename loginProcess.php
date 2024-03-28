<?php
include "myConnection.php";

if (isset($_POST['customerLoginName']) && isset($_POST['customerLoginPassword'])) {
    $username = $_POST["customerLoginName"];
    $password = $_POST["customerLoginPassword"];

    // Perform additional validation if needed

    if ($username == "" || $password == "") {
        $response = [
            'status' => 'error',
            'message' => 'Empty fields! Please fill all the fields.'
        ];
    } else {
        // Hash the input password to match with the hashed password stored in the database
        $hashedPassword = md5($password);

        // Check if the user exists in the database
        $query = "SELECT * FROM customer_table WHERE customerName = '$username'";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            // Verify hashed password
            if ($hashedPassword === $row['customerPassword']) {
                $customerID = $row['customerID'];
                // Passwords match, login successful
                $response = [
                    'status' => 'success',
                    'message' => 'Welcome!',
                    'customerID' => $customerID
                ];
            } else {
                // Passwords don't match, login failed
                $response = [
                    'status' => 'error',
                    'message' => 'Invalid username or password.'
                ];
            }
        } else {
            // User doesn't exist
            $response = [
                'status' => 'error',
                'message' => 'Invalid username or password.'
            ];
        }
    }
} else {
    $response = [
        'status' => 'error',
        'message' => 'All fields are mandatory'
    ];
}

header('Content-Type: application/json');
echo json_encode($response);
?>
