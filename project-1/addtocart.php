<html>
<head>
  <style>
   table {
  width: 100%;
  border-collapse: collapse;
}

table th, table td {
  padding: 8px;
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
  padding: 6px 12px;
  background-color: #4CAF50;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

button:hover {
  background-color: #45a049;
}

  </style>
</head>
<body>
 <h1>Shopping Cart</h1>
  
  <table>
    <thead>
      <tr>
        <th>Product</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Total</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
	  
      // Sample product data (you need to replace this with actual data)
      $products = array(
        array("id" => 1, "name" => "Diamond Ring", "price" => 1500, "quantity" => 1),
        array("id" => 2, "name" => "Gold Necklace", "price" => 1800, "quantity" => 2),
        // Add more products as needed
      );
      
      $totalPrice = 0;
      foreach ($products as $product) {
        $total = $product["price"] * $product["quantity"];
        $totalPrice += $total;
        echo "<tr>";
        echo "<td>{$product['name']}</td>";
        echo "<td>{$product['price']}</td>";
        echo "<td>{$product['quantity']}</td>";
        echo "<td>{$total}</td>";
        echo "<td><form action='removefromcart.php' method='post'><input type='hidden' name='id' value='{$product['id']}'><button type='submit'>Remove</button></form></td>";
        echo "</tr>";
      }
      ?>
    </tbody>
    <tfoot>
      <tr>
        <td colspan="3">Total</td>
        <td colspan="2"><?php echo $totalPrice; ?></td>
      </tr>
      <tr>
        <td colspan="5"><a href="checkout.php">Buy Now</a></td> <!-- Replace "checkout.php" with your actual checkout page -->
      </tr>
    </tfoot>
  </table>
  </body>
  </html>
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

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Insert data into the database
    $name = $_POST["name"];
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];

    $sql = "INSERT INTO products (name, price, quantity) VALUES ('$name', $price, $quantity)";

    if ($conn->query($sql) === TRUE) {
        echo "Product added to cart successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
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

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the ID of the product to be removed
    $id = $_POST["id"];

    // Delete the product from the database
    $sql = "DELETE FROM products WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Product removed from cart successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
