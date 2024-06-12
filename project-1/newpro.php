<?php
// Establish connection to the database
$servername = "localhost";
$username = "root";
$password = "";
$database = "jewellery";

// Create connection
$con = new mysqli($servername, $username, $password, $database);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Check if the form is submitted
if(isset($_POST['add_product'])) {
    // Extract product details from the form
    $name = $_POST["name"];
    $price = $_POST["price"];
    $category = $_POST["category"];

    // File upload handling
    $target_dir = "uploads/"; // Directory where you want to store the uploaded images

    // Ensure the "uploads" directory exists and has proper permissions
    if (!file_exists($target_dir)) {
        // Attempt to create the directory
        if (!mkdir($target_dir, 0755, true)) {
            die("Failed to create directory: " . $target_dir);
        }
    }

    // File path for the uploaded image
    $target_file = $target_dir . basename($_FILES["image"]["name"]);

    // Check if a file has been uploaded
    if(isset($_FILES["image"]["tmp_name"]) && !empty($_FILES["image"]["tmp_name"])) {
        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Rest of your file upload handling code...
    } else {
        echo "No file uploaded.";
    }

    // Check file size
    if ($_FILES["image"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["image"]["name"])). " has been uploaded.";
            // Insert product into the 'product' table
            $sql = "INSERT INTO product (name, price, image, category) VALUES ('$name', '$price', '$target_file', '$category')";
            if(mysqli_query($con, $sql)) {
                echo "Product added successfully!";
                // Redirect the user back to the admin page
                header("Location: admin.php");
                exit;
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($con);
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

// Close the database connection
mysqli_close($con);
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
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
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 10px; /* Add margin between inputs */
        }
        form button[type="submit"] {
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
        form button[type="submit"]:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <header>
        <h2>Jewel Store</h2>
        <nav>
            <a href="admin.php">Home</a>
            <a href="Udetail.php">User Detail</a>
            <a href="login.html">LogOut</a>
        </nav>
    </header>
    <main>
        <form action="" method="POST" enctype="multipart/form-data">
            <h2>Add New Product</h2><br>
            <label for="category">Select Category:</label>
            <select name="category" id="category">
                <option value="ring">Ring</option>
                <option value="necklace">Necklace</option>
                <option value="earring">Earring</option>
            </select><br><br>
            <label for="name">Product Name:</label>
            <input type="text" placeholder="Enter Product Name"id="name" name="name" required><br><br>
            <label for="price">Price:</label>
            <input type="text" placeholder="Enter Price" id="price" name="price" required><br><br>
            <label for="image">Product Image:</label>
            <input type="file" id="image" name="image" required><br><br>
            <!-- Corrected: Added name attribute for the submit button -->
            <button type="submit" name="add_product">Add Product</button>
        </form>
    </main>
</body>
</html>
