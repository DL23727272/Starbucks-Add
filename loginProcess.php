<?php
include "myConnection.php";

    if (isset($_POST['customerLoginName']) && isset($_POST['customerLoginPassword'])) {
        $username = $_POST["customerLoginName"];
        $password = $_POST["customerLoginPassword"];


        if ($username == "" || $password == "") {
            $response = [
                'status' => 'error',
                'message' => 'Empty fields! Please fill all the fields.'
            ];
        } else {

            $hashedPassword = md5($password);

            $query = "SELECT * FROM customer_table WHERE customerName = '$username'";
            $result = mysqli_query($con, $query);

            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);
                // Verify hashed password
                if ($hashedPassword === $row['customerPassword']) {
                    $customerID = $row['customerID'];
                    $customerName = $row['customerName'];
                    $userType = $row['type'];
                    // Passwords match, login successful
                    $response = [
                        'status' => 'success',
                        'message' => 'Welcome!',

                        //retrieve the information para sa cart, admin, ordering
                        'customerID' => $customerID,
                        'customerName' => $customerName,
                        'userType' => $userType

                    ];
                } else {
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
