<?php
// Establish connection to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jewellery";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['remove_from_cart'])) {
    $id = $_POST['id'];

    // Delete the product from the cart
    $sql = "DELETE FROM cart WHERE id = '$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Product removed from cart successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
