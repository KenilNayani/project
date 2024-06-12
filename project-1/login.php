
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        
        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        
        .form-container h2 {
            text-align: center;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
        }
        
        .form-group input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        
        #insert {
            background-color: #4caf50;
            margin: 0px 2px;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        
        .register-link {
            text-align: center;
            margin-top: 20px;
        }
        
        .register-link a {
            color: #007bff;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="form-container" id="loginForm">
        <h2>Login</h2>
        <form action="#" method="post">
            <div class="form-group">
                <label for="name">Username:</label>
                <input type="text" id="name" placeholder="Enter User Name" name="name" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" placeholder="Enter Password" name="password" required>
            </div>
            <div class="form-group">
                <input type="submit" id="insert" name="insert">
            </div>
        </form>
        <div class="register-link">
            <a href="register.php" onclick="showRegisterForm()">Register</a>
        </div>
    </div>

  <?php
    error_reporting(0);
    if(isset($_POST['insert'])) {
        $uid = $_POST['name'];
        $pwd = $_POST['password'];
        
        $con = mysqli_connect('localhost', 'root', '', 'jewellery');
        
        if(!$con) {
            die('could not connected'.mysqli_connect_error());
        } else if($uid == "admin" && $pwd == "admin123") {
            header('Location: admin.php');
            exit;
        } else {
            $q = "SELECT * FROM `registration` WHERE user_name='$uid' AND password='$pwd'";
            $res = mysqli_query($con, $q);
            $row = mysqli_fetch_assoc($res);

            if($row) {
                header('Location: index.php');
                exit;
            } else {
                echo "<script>alert('Invalid username or password');</script>";
            }
        }

        mysqli_close($con);
    }
?>

</body>
</html>
