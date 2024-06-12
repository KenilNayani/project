<!DOCTYPE html>
<html lang="en">
<head>
    <title>JewelStore - Bill</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin: 0;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
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

        .purchase-btn {
            text-align: center;
            margin-top: 20px;
        }

        .purchase-btn button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .purchase-btn button:hover {
            background-color: #45a049;
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
<h1>Purchase Details</h1>
<div class="container">
    <table>
        <thead>
        <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
        </tr>
        </thead>
        <tbody>
        <?php
        // Establish database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "jewellery";
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Retrieve cart items from the database
        $sql = "SELECT * FROM products";
        $result = $conn->query($sql);
        $totalPrice = 0;

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
                echo "</tr>";
                $totalPrice += $total;
            }
        } else {
            echo "<tr><td colspan='4'>Cart is empty</td></tr>";
        }
        ?>
        </tbody>
        <tfoot>
        <tr>
            <td colspan="3">Total</td>
            <td><?php echo $totalPrice; ?></td>
        </tr>
        </tfoot>
    </table>

    <div class="purchase-btn">
        <form method="post" action="index.php">
            <input type="submit" name="checkout" value="Back Home">
        </form>
    </div>

    <div class="message" id="message"></div>

</div>

<?php
// Insert record into bills table and delete records from products and bills tables
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["checkout"])) {
    // Delete all records from the cart table
    $conn->query("TRUNCATE TABLE products");

    // Delete all records from the bill table
    $conn->query("TRUNCATE TABLE bills");

    echo "<script>alert('Purchase completed successfully.');</script>";
}

// Close database connection
$conn->close();
?>
<h1>Thanks For Buying From Our Shop</h1>
</body>
</html>
