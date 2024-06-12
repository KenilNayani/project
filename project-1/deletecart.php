<?php

	$con = mysqli_connect('localhost','root','','jewellery');
	error_reporting(0);
	$query = "DELETE FROM `products`";
	$data = mysqli_query($con,$query);

	if($data)
	{
		echo "<script>alert('Your All Products Are Purchased.')</script>";
		?>
		<META HTTP-EQUIV="Refresh" CONTENT ="0;
		URL=index.php">
		<?php
	}
	else
	{
		echo "<font color='red'>Failed From Database";
	}
?>