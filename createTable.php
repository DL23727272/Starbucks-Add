<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "starbarista";

$connect = mysqli_connect($hostname, $username, $password, $database);

$query = "CREATE TABLE product_table ( 
    productID  INT(3) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
    productName VARCHAR(250) NOT NULL,
    productDesc VARCHAR(255)NOT NULL,
    productPrice  int(155)NOT NULL,
    productImage VARCHAR(100)NOT NULL
)";




if(mysqli_query($connect, $query)){
    echo "messages table created successfully";
}
else{
    echo "lecturer table failed to create <br>". mysqli_error($connect);
}
mysqli_close($connect);
?>
