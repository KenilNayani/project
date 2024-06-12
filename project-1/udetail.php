<?php
// Establish a database connection
$con = mysqli_connect("localhost", "root", "", "jewellery");

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// Check if delete button is clicked
if(isset($_GET['action']) && $_GET['action'] == 'delete') {
    $username = $_GET['username'];
    
    // Delete user from the database
    $delete_query = "DELETE FROM registration WHERE user_name = '$username'";
    mysqli_query($con, $delete_query);
}

// Query to fetch user information
$que = "SELECT * FROM registration";

// Execute the query
$result = mysqli_query($con, $que);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Information</title>
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
        
        a:hover {
            text-decoration: underline;
        }
        
        section {
            position: relative;
            margin-top: 20px;
        }
        
        .tblhead {
            width: calc(100% - 300px);
        }

        .tblhead h1 {
            padding: 15px 0px 30px;
            margin-left: 715px;
            font-family: oswald;
        }

        table {
            width: 98%;
            height: auto;
            margin-left: 0px;
            background-color: white;
            font-weight: 800;
            border-radius: 30px;
            margin-left: 12px;
            border-collapse: collapse;
        }

        table th, table td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }

        table th {
            font-weight: 850;
            width: 7%;
            background-color: rgb(228, 148, 94);
            color: white;
            cursor: pointer;
            border-radius: 5px;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table tr:hover {
            background-color: #ddd;
        }

        table tr th td {
            color: white;
            text-align: center;
            align-items: center;
        }
        
        input[type="submit"] {
            background-color: #f44336;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        
        input[type="submit"]:hover {
            background-color: #d32f2f;
        }
		table td a{
			background-color:red;
			padding:9px;
		}
    </style>
</head>
<body>
   <header>
       <h2>Jewel Store</h2>
       <nav>	
            <a href="admin.php">Home</a>
            <a href="newpro.php">New Product</a>
            <a href="login.html">LogOut</a>
        </nav>
	</header>
    <section>
        <div class="tblhead">
            <h1>User Information</h1>
        </div>
        <table>
            <tr>
                <th>User Full Name</th>
                <th>Email</th>
                <th>Username</th>
                <th>Mobile No.</th>
                <th>Password</th>
                <th>Action</th> <!-- New column for delete button -->
            </tr>
            <?php
            // Fetch and display user information
            while ($row = mysqli_fetch_assoc($result)) {  
            ?>
                <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['user_name']; ?></td>
                    <td><?php echo $row['mobile no.']; ?></td>
                    <td><?php echo $row['password']; ?></td>
                    <td><a href="?action=delete&username=<?php echo $row['user_name']; ?>" style="color: black; " onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
					</td>
                </tr>
            <?php
            }
            ?>
        </table>
    </section>
</body>
</html>

<?php
// Close the database connection
mysqli_close($con);
?>
