<!DOCTYPE html>
<html lang="en">
<head>
    <title>JewelStore - Cart</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin: 0;
            color: white;
            background-color: rgb(228, 148, 94); 
            padding: 20px 0;
            border-radius: 10px 10px 0 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th, table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #f2f2f2;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table tr:hover {
            background-color: #ddd;
        }

        table td:last-child {
            text-align: center;
        }

        button {
            padding: 8px 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .home-btn {
            text-align: center;
            margin-bottom: 20px;
        }

        .home-btn a {
            text-decoration: none;
            color: #333;
            padding: 10px 20px;
            background-color: #f2f2f2;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .home-btn a:hover {
            background-color: #ddd;
        }

        .buy-btn {
            margin-left: 20px;
        }

        .message {
            text-align: center;
            margin-top: 20px;
            padding: 10px;
            background-color: #dff0d8;
            color: #3c763d;
            border: 1px solid #d6e9c6;
            border-radius: 4px;
            display: none;
        }
		  input[type="submit"] {
            background-color: #4CAF50;
			width:70%;
			font-size:18px;
			color: white;
			border: none;
			padding: 10px 20px;
			border-radius: 5px;
			cursor: pointer;
			transition: background-color 0.3s ease-in-out;
        }
    </style>
</head>
<body>
<h1>Shopping Cart</h1>
<div class="container">
    <table>
        <!-- Table header -->
        <thead>
        <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
            <th>Action</th>
        </tr>
        </thead>
        <!-- Table body -->
        <tbody>
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

        // Check if the form is submitted to add a product to the cart
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_to_cart"])) {
            // Retrieve product details from the form
            $id = $_POST["id"];
            $name = $_POST["name"];
            $price = $_POST["price"];

            // Check if the product already exists in the cart
            $existing_product = $conn->query("SELECT * FROM products WHERE id=$id");
            if ($existing_product->num_rows > 0) {
                // If the product exists, increase the quantity by 1
                $conn->query("UPDATE products SET quantity = quantity + 1 WHERE id=$id");
            } else {
                // If the product does not exist, insert a new record into the cart
                $sql = "INSERT INTO products (id, name, price, quantity) VALUES ('$id', '$name', '$price', 1)";
                if ($conn->query($sql) === TRUE) {
                    echo "Product added to cart successfully";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        } elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["remove_from_cart"])) {
            // Remove product from the cart
            $id = $_POST["id"];
            $conn->query("DELETE FROM products WHERE id=$id");
        } elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["decrease_quantity"])) {
            // Decrease product quantity by 1
            $id = $_POST["id"];
            $conn->query("UPDATE products SET quantity = GREATEST(quantity - 1, 0) WHERE id=$id");
        } elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_quantity"])) {
            // Increase product quantity by 1
            $id = $_POST["id"];
            $conn->query("UPDATE products SET quantity = quantity + 1 WHERE id=$id");
        }

        // Retrieve cart items from the database
        $sql = "SELECT * FROM products";
        $result = $conn->query($sql);

        if ($result === false) {
            echo "Error retrieving data from the database: " . $conn->error;
        } elseif ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$row['name']}</td>";
                echo "<td>{$row['price']}</td>";
                echo "<td>{$row['quantity']}</td>";
                $total = (int)$row['price'] * (int)$row['quantity'];
                echo "<td>{$total}</td>";
                echo "<td>
                            <form action='cart.php' method='post'>
                                <input type='hidden' name='id' value='{$row['id']}'>
                                <button type='submit' name='remove_from_cart'>Remove</button>
                                <button type='submit' name='decrease_quantity'>-</button>
                                <button type='submit' name='add_quantity'>+</button>
                            </form>
                        </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Cart is empty</td></tr>";
        }
        ?>
        </tbody>
        <!-- Table footer -->
        <tfoot>
        <tr>
            <td colspan="3">Total</td>
            <td colspan="2">
                <?php
                // Calculate total price
                $totalPrice = 0;
                $result = $conn->query("SELECT SUM(price * quantity) AS total FROM products");
                if ($result === false) {
                    echo "Error retrieving total price: " . $conn->error;
                } elseif ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $totalPrice = $row["total"];
                }
                echo $totalPrice;
                ?>
            </td>
        </tr>
        <tr>
            <td colspan="4" class="home-btn"><a href="index.php #prod">Back to Home</a></td>
			<form method="post" action="bill.php">
    <td><input type="submit" name="checkout" value="Buy Now"></td>
</form>
		</tr>
        </tfoot>
    </table>
</div>
<?php
// Close the database connection
$conn->close();
?>
</body>
</html>
