<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration Form</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .register-container {
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      width: 300px;
    }

    #registration-form {
     
      margin-top: 20px;
    }

    #registration-form h2 {
      color: #333;
      font-size: 1.5em;
      margin-bottom: 15px;
    }

    #registration-form .form-group {
      margin-bottom: 15px;
    }

    #registration-form label {
      display: block;
      margin-bottom: 8px;
      font-weight: bold;
    }

    #registration-form input {
      width: 100%;
      padding: 8px;
      box-sizing: border-box;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    #registration-form .register-btn {
      background-color: #3498db;
      color: #fff;
      padding: 10px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      width: 100%;
    }

    #registration-form .register-btn:hover {
      background-color: #2980b9;
    }

    .login-link {
      margin-top: 15px;
      text-align: center;
    }

    .login-link a {
      color: #3498db;
      text-decoration: none;
    }
	    h1 {
      text-align: center;
      color: #333;
	 margin-bottom: 500px;
    margin-right: -212px;
    }
  </style>
</head>
<body>
<h1>Jewel Store</h1>
  <div class="register-container">
    <h2>Register</h2>
    <form id="registration-form" method="POST">
	<div class="form-group">
       <label>Full Name :</label>
        <input type="text" placeholder="Enter Full Name" name="name" required>
      </div>
      <div class="form-group">
       <label>User Name :</label>
        <input type="text" placeholder="Enter User Name" name="uname" required>
      </div>

      <div class="form-group">
        <label>Email : </label>
          <input type="email" placeholder="Enter Email-Id" name="email" required>
      </div>
		<div class="form-group">
        <label>Mobile No: </label>
          <input type="text" placeholder="Enter mobile no." name="mobile" required>
      </div>
      <div class="form-group">
        <label>Password : </label>
          <input type="password" placeholder="Enter Password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
      </div>

      <button type="submit"  value="Submit" name="insert" class="register-btn" >Register</button>
    <div class="login-link">
		<p>Already Register?</p>
            <p><a href="login.php" >Login</a></p>
        </div>
	 
  <?php
error_reporting(E_ALL);

$con = mysqli_connect('localhost', 'root', '', 'jewellery');

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if(isset($_POST['insert'])) {
    $fullname = $_POST['name'];
    $name = $_POST['uname'];
    $mobile = $_POST['mobile'];

    $query = "SELECT `user_name` FROM `registration` WHERE user_name='$name'";
    $data = mysqli_query($con, $query);

    if(mysqli_num_rows($data) > 0) {
        echo '<script type="text/javascript">alert("You Have Already Registered")</script>';
    } else {
        $password = $_POST['password'];
        $email = $_POST['email'];

        $query = "INSERT INTO `registration`(`name`, `user_name`, `password`, `email`, `mobile no.`) VALUES ('$fullname','$name','$password','$email','$mobile')";
        $query_run = mysqli_query($con, $query);

        if($query_run) {
            echo '<script type="text/javascript">alert("Registration Successfully ")</script>';
            header("Location: login.php");
            exit();
        } else {
            echo '<script type="text/javascript">alert("Error: ' . mysqli_error($con) . '")</script>';
        }
    }
}
?>

	</form>

   
  </div>

  <script>
    function performRegistration() {
     
      alert('Registration logic goes here!');
    }
  </script>
</body>
</html>
