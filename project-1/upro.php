<?php
// Establish connection to the database
$con = mysqli_connect("localhost", "root", "", "jewellery");

// Check if the connection was successful
if (!$con) {
    die('Could not connect: ' . mysqli_connect_error());
}

// Check if the form is submitted
if(isset($_POST['update_product'])) {
    // Extract product details from the form
    $id = $_POST["id"];
    $name = $_POST["name"];
    $price = $_POST["price"];
    $category = $_POST["category"];

    // Update the product in the database
    $update_query = "UPDATE product SET name='$name', price='$price', category='$category' WHERE id=$id";
    if(mysqli_query($con, $update_query)) {
        // Redirect to admin.php after successful update
        header("Location: admin.php?update=success");
        exit; // Ensure script execution stops after redirection
    } else {
        echo "Error updating product: " . mysqli_error($con);
    }
}

// Check if the product ID is provided in the URL
if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // Retrieve the product details from the database
    $query = "SELECT * FROM product WHERE id=$id";
    $result = mysqli_query($con, $query);

    if(mysqli_num_rows($result) == 1) {
        $product = mysqli_fetch_assoc($result);
    } else {
        echo "Product not found!";
        exit;
    }
} else {
    echo "Product ID not provided!";
    exit;
}

// Close the database connection
mysqli_close($con);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
			 background-color: #f4f4f4;
            padding: 0;
        }
		 header {
            background-color: rgb(228, 148, 94);
           
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
            margin-right: auto;
            font-size: 24px;
        }
        nav {
            padding: 10px;
        }
        a {
            color: white;
            padding: 15px;
            text-decoration: none;
        }
        a.active {
            text-decoration: underline;
        }

        h2 {
            text-align: center;
            margin-top: 20px;
        }

        form {
            background-color: #fff;
			 font-size:20px;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            margin: 40px auto; /* Center the form */
        }
        form h2 {
            color: #333;
            font-size: 1.5em;
            margin-bottom: 15px;
            text-align: center; /* Center the heading */
        }
        form label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        form input[type="text"],
        form input[type="file"],
        form select {
            width: 100%;
			font-size:15px;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 10px; /* Add margin between inputs */
        }
        

        input[type="submit"] {
            background-color: #4CAF50;
			width:100%;
			font-size:18px;
			color: white;
			border: none;
			padding: 10px 20px;
			border-radius: 5px;
			cursor: pointer;
			transition: background-color 0.3s ease-in-out;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .error {
            color: red;
            font-size: 14px;
            margin-top: 10px;
        }

    </style>
</head>
<body>
  <header>
        <h2>Jewel Store</h2>
        <nav>
            <a href="admin.php">Home</a>
			<a href="newpro.php">New Product</a>
            <a href="Udetail.php">User Detail</a>
            <a href="login.html">LogOut</a>
        </nav>
    </header>
<h2>Update Product</h2>
<form action="" method="post"> <!-- Changed action to empty string -->
    <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
    <label for="name">Product Name:</label><br>
    <input type="text" id="name" name="name" value="<?php echo $product['name']; ?>"><br>
    <label for="price">Price:</label><br>
    <input type="text" id="price" name="price" value="<?php echo $product['price']; ?>"><br>
    <label for="category">Category:</label><br>
    <input type="text" id="category" name="category" value="<?php echo $product['category']; ?>"><br><br>
    <input type="submit" name="update_product" value="Update Product">
</form>
</body>
</html>
