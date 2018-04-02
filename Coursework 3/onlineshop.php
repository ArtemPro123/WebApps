<!DOCTYPE html>
<html>
<head>
	<title>Online Shopping</title>
	<link rel="stylesheet" type="text/css" href="ValidationCSS.css" />
</head>
<body>
<center>
<h1>Laptop World</h1>
<hr />
<h2>Affordable Gaming Laptops</h2>
</center>

<img class = "left" src="laptops.png">
<img class = "right" src="laptops.png">

<?php
$con = mysqli_connect("csmysql.cs.cf.ac.uk", "c1618004","aronafwig3", "c1618004");
if (!$con) {
die("Failed to connect: " . mysqli_connect_error());
}

$command = "select * from items";

$result = mysqli_query($con, $command);

if (!$result){
	die("Failed to execute command: " . mysqli_connect_error());
}


echo "<br \>";
echo "<center>";
echo"<table cellspacing='0' cellpadding='0'>
<tr>
<th>Image</th>
<th>Product</th>
<th>Price</th>
<th>Discription</th>
</tr>";

if (mysqli_num_rows($result) > 0){
	while($row = mysqli_fetch_assoc($result)) {
		$ID = $row["Id"];
		$product = $row["name"];
		$desc = $row["description"];
		$money = $row["price"];
		$image = $row["image"];
		echo "<tr>";
		echo "<td>" . "<img src=" . $image . " style = 'width:170px;height:120px;'>" . "</td>";
		echo "<td>" . $product . "</td>";
		echo "<td>" . "£" . $money . "</td>";
		echo "<td>" . $desc . "</td>"; 
		echo "</tr>";
	}
} else { echo "No Results"; }

echo "</table>";
echo "</center>";

// Close the connection
mysqli_close($con);
?>

<footer>&copy; 2017 Laptop World</footer>
</body>
</html>
