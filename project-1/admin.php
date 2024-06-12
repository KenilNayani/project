<?php
// Establish connection to the database
$con = mysqli_connect("localhost", "root", "", "jewellery");

// Check if the connection was successful
if (!$con) {
    die('Could not connect: ' . mysqli_connect_error());
}

// Check if the delete action is requested
if(isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];
    // Delete the product from the 'product' table
    $delete_query = "DELETE FROM product WHERE id=$id";
    if(mysqli_query($con, $delete_query)) {
        echo "Product deleted successfully!";
    } else {
        echo "Error deleting product: " . mysqli_error($con);
    }
}

// Query to select all products from the 'product' table
$query = "SELECT * FROM product";

// Execute the query
$result = mysqli_query($con, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin PAGE</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-size: cover;
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            padding: 0;
        }

        ::-webkit-scrollbar {
            display: none;
        }

        section {
            position: relative;
        }

        header {
            background-color: rgb(228, 148, 94);
            padding: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
            margin-right: auto;
            font-size: 24px;
        }

        header a:hover {
            text-decoration: underline;
        }
		nav{
			padding:10px;
		}
        a {
            color: white;
			padding:15px;
            text-decoration: none;
        }

        a.active {
            text-decoration: underline;
        }

        .container {
            margin: 20px;
            padding: 20px;
            border-radius: 10px;
            background-color: #f2f2f2;
        }

        .container h2 {
            margin-bottom: 20px;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: rgb(228, 148, 94);
            color: white;
        }

        td img {
            width: 60px;
            height: auto;
            margin-left: 10px;
            margin-right: 10px;
        }

       

        ul {
            list-style-type: none;
            font-size: 16px;
        }

        ul p {
            font-weight: bold;
            margin-bottom: 10px;
        }

        ul a {
            display: block;
            margin: 5px 0;
            color: white;
            text-decoration: none;
        }

        ul a:hover {
            text-decoration: underline;
        }

        .foot-panel4 {
            font-size: 14px;
        }

        .copyright {
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
    <a href="login.php">LogOut</a>
	</nav>
</header>
<section>
    <div class="container">
        <h2>Welcome to the Admin Panel</h2>
        <h2>Existing Products</h2>
        <table>
            <thead>
            <tr>
                <th>Product ID</th>
                <th>Image</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
<?php
// Check if there are any products
if (mysqli_num_rows($result) > 0) {
    // Loop through each row of the result set
    while ($product = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>{$product['id']}</td>";
        echo "<td>";
        // Debug output for image path
       
        // Check if 'image' is not empty and file exists
        if (!empty($product['image']) && file_exists($product['image'])) {
            echo "<img src='{$product['image']}' alt='Product Image'>";
        } else {
            echo "No Image";
        }
        echo "</td>";
        echo "<td>{$product['name']}</td>";
        echo "<td>{$product['price']}</td>";
        echo "<td>            
				<a href='upro.php?id={$product['id']}' style='color: black;background-color:green;' class='update-link'>Update</a>		
                <a href='?action=delete&id={$product['id']}' style='color: black;background-color:red;' onclick='return confirm(\"Are you sure you want to delete this product?\")'>Delete</a>
             </td>";
        echo "</tr>";
    }
} else {
    // No products found
    echo "<tr><td colspan='5'>No products found.</td></tr>";
}
?>


            </tbody>
        </table>
    </div>
</section>

</body>
</html>
