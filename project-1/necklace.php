<?php   
$con = mysqli_connect("localhost", "root", "", "jewellery");
if (!$con) {
    die('Could not connect: ' . mysqli_connect_error());
} else {
    $q = "SELECT * FROM product WHERE category='necklace'";
    $result = mysqli_query($con, $q);
    $rows = [];
    if ($result->num_rows > 0) {
        $rows = $result->fetch_all(MYSQLI_ASSOC);
    }
}
mysqli_close($con);
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>

  * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-size: cover;
            font-family: Arial, Helvetica, sans-serif;
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
            justify-content: space-around;
            align-items: center;
            color: white;
            margin-right: auto;
            font-size: 24px;
        }

        header a {
            padding: 0 10px;

        }

        nav {

            margin: 0 0 0 500px;
        }

        header a:hover {
            text-decoration: underline;
        }

        a {
            color: white;
            text-decoration: none;
        }

        a.active {
            text-decoration: underline;
        }

        ul {
            margin-top: 20px;
            font-size: 25px;
            align-items: left;
        }

        ul p {
            justify-content: center;
            align-items: center;
        }

        ul a {
            display: block;
            margin: 10px;
            font-size: 1.0rem;
            font-weight: 600;
            color: #dddddd;
        }
.container{
    height: 114vh;
    width: 100%;
    background-image: url(rental.jpg);
    background-position: center;
    background-size: cover;
    background-repeat: no-repeat;
    box-sizing: border-box;
}
h1
{
    font-size:35px;
}
.column {
    float: left;
    width: 30%;
    padding: 25px;
}
.row {
    margin: 0;
    margin-left: 5%;
}

.row:after {
    content: "";
    display: table;
    clear: both;
}
.card {
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    padding: 5px;
    text-align: center;
    background-color: #f1f1f1;
    width: 100%;
    height : 400px;
     
    margin:0;
}
.card a
{
    text-decoration:none;
    padding:10px;
    font-size: 17px;
  
}
.button-style
{
    width: 120px;
    height: 45px;
    border-radius: 30px;
    background-color:rgb(228, 148, 94);
    color:white;
    font-size:17px;
    align-items: center;
    border:none;
    transition: .2s;
    margin-top:18px;
}
.button-style:hover{
    background-color:black;
    color: white;
    transition: .2s;
    font-size: 23px;
}

h3,p{
    margin-top: 10px;
}
.button-edit{
    width: 120px;
    height: 45px;
    border-radius: 30px;
    background-color:rgb(228, 148, 94);
    color:white;
    font-size:17px;
    align-items: center;
    border:none;
    transition: .2s;
}
.button-edit:hover{
    background-color:rgb(57, 215, 14);
    color: white;
    transition: .2s;
    font-size: 23px;
}
.button-Delete{
    width: 120px;
    height: 45px;
    border-radius: 30px;
    background-color:rgb(228, 148, 94);
    color:white;
    font-size:17px;
    align-items: center;
    border:none;
    transition: .2s;
}
.button-Delete:hover
{
    background-color:rgb(236, 5, 5);
    color: white;
    transition: .2s;
    font-size: 23px;
}
/* Responsive columns */
@media screen and (max-width: 600px) {
    .column {
        width: 100%;
        display: block;
        margin-bottom: 20px;
    }
}
	</style>
</head>

<body>
<header>
  <h2>Jewel Store</h2>
    <nav>			
        <a href="index.php">Home</a>
        <a href="index.php #prod">Products</a>
        <a href="index.php #cont">Contact Us</a>
        <a href="login.php">Log Out</a>
    </nav>     
</header>
<h2 align="center"> Necklace</h2>
 <div class="card-container">
        <div class="row">
            <?php 
            if (!empty($rows)) {
                foreach ($rows as $row) { 
                    ?>
                    <div class="column">
                        <div class="card">
                            <?php 
                            $image_path = $row['image']; // Assuming the image path is stored in the 'image' column
                            if (file_exists($image_path)) {
                                echo "<img style='height:250px; width:100%; margin:0;' src='" . $image_path . "'>";
                            } else {
                                echo "Image not found for ID: " . $row['id'];
                            }
                            ?>
                            <h3><?php echo $row['name']; ?></h3>
                            <p><?php echo "Rs.".$row['price']; ?></p>
                            <!-- Modified form to include product details -->
                            <form action="cart.php" method="post">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <input type="hidden" name="name" value="<?php echo $row['name']; ?>">
                                <input type="hidden" name="price" value="<?php echo $row['price']; ?>">
                                <button class="button-style" type="submit" name="add_to_cart">Add to cart</button>
                            </form>
                        </div>
                    </div>
                    <?php 
                } 
            } else {
                echo "No products available.";
            }
            ?>
        </div>
    </div>
</body>

</html>


 
 
      