<?php
    
    $hostname = "localhost";
    $username = "root";
    $password = "";

    // Create connection
    $conn = new mysqli($hostname, $username, $password);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Create the milktea database
    $sqlCreateDatabase = "CREATE DATABASE IF NOT EXISTS starbarista";
    if ($conn->query($sqlCreateDatabase) === TRUE) {
        echo "Database created successfully<br>";
    } else {
        echo "Error creating database: " . $conn->error . "<br>";
    }

   

    // Close connection
    $conn->close();

    ?>