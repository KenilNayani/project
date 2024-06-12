<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME PAGE</title>
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
    justify-content: space-between;
    align-items: center;
    color: white;
    margin-right: auto;
    font-size: 24px;
}

header a:hover {
    text-decoration: underline;
}

a {
    color: white;
	padding: 15px;
    text-decoration: none;
}

a.active {
    text-decoration: underline;
}

.footer {
    margin-top: 22.5%;
}

.foot-panel2 {
    background-color: rgb(228, 148, 94);
    color: white;
    height: 300px;
    display: flex;
    justify-content: space-evenly;
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
    margin: 15px;
    font-size: 1.0rem;
    font-weight: 600;
    color: #dddddd;
}

.foot-panel4 {
    background-color: white;
    color: black;
    height: 80px;
    font-size: 0.9rem;
    text-align: center;
}

.pages {
    color: black;
    padding-top: 25px;
}

.copyright {
    padding-top: 5px;
}

.slider {
    height: 60vh;
}

.mainbox {
    position: relative;
    width: 100%;
    height: 300px;
    cursor: pointer;
}

img {
    width: 60px;
    height: auto;
    margin-left: 10px;
    margin-right: 550px;
}

.card-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}

.card {
    width: 30%;
    margin-bottom: 20px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    transition: transform 0.3s ease-in-out;
}

.card:hover {
    transform: translateY(-5px);
}

.card img {
    width: 60%;
    height: 222px;
    margin: 20px 110px 0;
    object-fit: cover;
}

.card-content {
    padding: 15px;
    text-align: center;
}

.card-content h2 {
    margin-top: 0;
    margin-bottom: 10px;
}

.card-content p {
    margin-bottom: 10px;
}

.card-content a {
    background-color: #4CAF50;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease-in-out;
}

.card-content button:hover {
    background-color: #3e8e41;
}
nav{
			padding:10px;
		}

    </style>
</head>
<body>
    <section>
        <header>
            <h2>Jewel Store</h2>
            <nav>
			<a href="sample.php">Home</a>
            <a href="#prod">Products</a>
			 <a href="cart.php">Cart</a>
            <a href="#cont">Contact Us</a>
            <a href="login.php">Log Out</a>
			</nav>
        </header>
   
        <div class="mainbox">
            <img id="sliding1" class="img1" style="height: 255px; width: 100%; margin: 0;" src="s1.png">
        </div>
    </section>
	<h2 align="center" id="prod">All Products</h2><br>
    <div class="card-container">
        <div class="card">
            <img src="r1.jpg" >
            <div class="card-content">
                <h2>Ring</h2>
                <p><a href="ring.php">View More</a></p>
            </div>
        </div>
      <div class="card">
    <img src="ear1.jpg" alt="Gold Earring">
    <div class="card-content">
        <h2> Earring</h2>
      <p><a href="earring.php">View More</a></p>
    </div>
</div>

<div class="card">
    <img src="n5.jpg" alt="Silver Necklace">
    <div class="card-content">
        <h2>Necklace</h2>
       <p><a href="necklace.php">View More</a></p>
    </div>
</div>

    </div>

 <footer>
    <div class="foot-panel2" id="cont">
        <ul>
            <p>Contact Us</p>
            <a>Phone:  9016015889</a>
            <a>Address:  Eva Mall Near Patidar Chokdi,Manjalpur,</a>
            <a>Vadodara,Gujarat 390011</a>
            <a>Email:  kenilnayani@gmail.com</a>
        </ul>
        <ul>
            <p>About Us</p>
            <a> Thanks For visting jewelstore , The Best Jewellery in india</a>
            <a> You can order with confidence.</a>
        </ul>
        <ul>
            <p>Connect with Us</p>
            <a>Facebook</a>
            <a>Twitter</a>
            <a>Instagram</a>
        </ul>
    </div>
    <div class="foot-panel4">
        <div class="copyright">
            <h3>© 1996-2023, Jewelstore, Inc. </h3>
        </div>
    </div>
</footer>
</body>
</html>