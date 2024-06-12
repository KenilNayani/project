<?php
// Include database connection
include 'db_connection.php';

// Initialize variables
$productName = $price = $availability = '';
$update_id = 0; // To store the ID of the product being updated

// Function to fetch all products
function getProducts() {
    global $con;
    $query = "SELECT * FROM products";
    $result = mysqli_query($con, $query);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

// Function to add a new product
function addProduct($productName, $price, $availability) {
    global $con;
    $query = "INSERT INTO products (productName, price, availability) VALUES ('$productName', '$price', '$availability')";
    mysqli_query($con, $query);
}

// Function to update a product
function updateProduct($productName, $price, $availability, $id) {
    global $con;
    $query = "UPDATE products SET productName='$productName', price='$price', availability='$availability' WHERE id='$id'";
    mysqli_query($con, $query);
}

// Function to delete a product
function deleteProduct($id) {
    global $con;
    $query = "DELETE FROM products WHERE id='$id'";
    mysqli_query($con, $query);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add_product'])) {
        // Add product
        $productName = $_POST['productName'];
        $price = $_POST['price'];
        $availability = $_POST['availability'];
        addProduct($productName, $price, $availability);
    } elseif (isset($_POST['update_product'])) {
        // Update product
        $productName = $_POST['productName'];
        $price = $_POST['price'];
        $availability = $_POST['availability'];
        $update_id = $_POST['update_id'];
        updateProduct($productName, $price, $availability, $update_id);
    } elseif (isset($_POST['delete_product'])) {
        // Delete product
        $delete_id = $_POST['delete_id'];
        deleteProduct($delete_id);
    }

    // Redirect back to respective product page after performing action
    header("Location: ring.php"); // Change to the respective product page (e.g., ring.php, earring.php, necklace.php)
    exit();
}

// Fetch all products
$products = getProducts();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products</title>
  <style>
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
}

h2 {
    margin-bottom: 10px;
}

form {
    margin-bottom: 20px;
}

label {
    display: inline-block;
    width: 150px;
    font-weight: bold;
}

input[type="text"],
select {
    width: 200px;
    padding: 5px;
    margin-bottom: 10px;
}

button[type="submit"] {
    background-color: #4CAF50;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
}

button[type="submit"]:hover {
    background-color: #45a049;
}

.product {
    margin-bottom: 20px;
    border: 1px solid #ddd;
    padding: 10px;
}

.product p {
    margin-bottom: 5px;
}

.product form {
    margin-top: 10px;
}

.product form button {
    background-color: #f44336;
    color: white;
    border: none;
    padding: 5px 10px;
    border-radius: 3px;
    cursor: pointer;
}

.product form button:hover {
    background-color: #d32f2f;
}

  </style>
</head>
<body>
    <!-- Add product form -->
    <h2>Add New Product</h2>
    <form method="post">
        <label for="productName">Product Name:</label>
        <input type="text" id="productName" name="productName" required><br><br>
        <label for="price">Price:</label>
        <input type="text" id="price" name="price" required><br><br>
        <label for="availability">Availability:</label>
        <select id="availability" name="availability" required>
            <option value="yes">Yes</option>
            <option value="no">No</option>
        </select><br><br>
        <button type="submit" name="add_product">Add Product</button>
    </form>

    <!-- Display existing products -->
    <h2>Existing Products</h2>
    <?php foreach ($products as $product): ?>
        <div>
            <p>Product Name: <?php echo $product['productName']; ?></p>
            <p>Price: <?php echo $product['price']; ?></p>
            <p>Availability: <?php echo $product['availability']; ?></p>
            <!-- Update product form -->
            <form method="post">
                <input type="hidden" name="update_id" value="<?php echo $product['id']; ?>">
                <label for="productName">Product Name:</label>
                <input type="text" id="productName" name="productName" value="<?php echo $product['productName']; ?>" required><br><br>
                <label for="price">Price:</label>
                <input type="text" id="price" name="price" value="<?php echo $product['price']; ?>" required><br><br>
                <label for="availability">Availability:</label>
                <select id="availability" name="availability" required>
                    <option value="yes" <?php echo ($product['availability'] == 'yes') ? 'selected' : ''; ?>>Yes</option>
                    <option value="no" <?php echo ($product['availability'] == 'no') ? 'selected' : ''; ?>>No</option>
                </select><br><br>
                <button type="submit" name="update_product">Update Product</button>
            </form>
            <!-- Delete product form -->
            <form method="post">
                <input type="hidden" name="delete_id" value="<?php echo $product['id']; ?>">
                <button type="submit" name="delete_product">Delete Product</button>
            </form>
        </div>
    <?php endforeach; ?>
</body>
</html>
