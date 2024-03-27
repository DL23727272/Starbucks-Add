<?php
include "myConnection.php";

if (isset($_POST['customerSignUpName']) && isset($_POST['customerSignUpPassword']) && isset($_POST['customerSignUpEmail'])) {
    $username = $_POST["customerSignUpName"];
    $password = $_POST["customerSignUpPassword"];
    $email = $_POST["customerSignUpEmail"];

    // Perform additional validation if needed

    if ($username == "" || $password == "" || $email == "") {
        $response = [
            'status' => 'error',
            'message' => 'Empty fields! Please fill all the fields.'
        ];
    } else {
        // Hash the password (consider using stronger hashing algorithms like bcrypt)
        $passwordEncrypt = md5($password);

        // Insert user data into the database
        $query = "INSERT INTO customer_table (customerName, customerPassword, customerEmail)
                  VALUES ('$username', '$passwordEncrypt', '$email')";

        if (mysqli_query($con, $query)) {
            $response = [
                'status' => 'success',
                'message' => 'Sign up successful! Welcome.'
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Failed to add record: ' . mysqli_error($con)
            ];
        }
    }
    mysqli_close($con);
} else {
    $response = [
        'status' => 'error',
        'message' => 'All fields are mandatory'
    ];
}

header('Content-Type: application/json');
echo json_encode($response);
?>
