<!DOCTYPE html>
<html>
<head>
    <title>Acer Aspire F15</title>
    <link rel="stylesheet" type="text/css" href="gallery.css" />
</head>
<body>

<ul>
  <li><a style="font-family:verdana;" href="front-page.html">Home Page</a></li>
  <li><a style="font-family:verdana;" href="gallery.php">Gallery</a></li>
  <li><a style="font-family:verdana;" href="basket.php">Basket</a></li>
  <li><a style="font-family:verdana;" href="checkout.php">Checkout</a></li>
</ul>

<br>
<br>
<br>
<br>
<br>
<br>

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
echo"<table cellspacing='0' cellpadding='0'>";

if (mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)) {
        if($row["id"] == "I003"){
            $ID = $row["Id"];
            $product = $row["name"];
            $desc = $row["description"];
            $money = $row["price"];
            $image = $row["image"];
            echo "<tr>";
            echo "<td>" . "<img src=" . $image . " style = 'width:700px;height:420px;''>" . "</td>";
            echo "<td width = '15%'>" . $product . "</td>";
            echo "<td width = '10%'>" . "£" . $money . "</td>";
            echo "<td>" . $desc . "</td>"; 
            echo "</tr>";
        }
    }
} else { echo "No Results"; }

echo "</table>";
echo "</center>";

// Close the connection
mysqli_close($con);
?>

<img class = "secondimage" src="intel.png" style = 'width:60px; height:60px;''>
<img class = "thirdimage" src="Nvidia.png" style = 'width:110px; height:20px;''>
<img class = "forthimage" src="windows 10.png" style = 'width:50px; height:50px;''>


<p>Watch Online Review</p>
<iframe width="560" height="315" src="https://www.youtube.com/embed/LwP9HMJFHNs" frameborder="0" allowfullscreen></iframe>




<div class="Rev">
<a class = "link_review" href = "review.html">Review</a>
</div>

<div class = "Return">
<a class = "link_return" href = "gallery.php">Back</a>
</div>

<img class = "logo" src="logo2.png" style = "width:220px;height:55px;">

<div class = "logout">
<a class = "link_out" href = "front-page.html">Log Out</a>
</div>


<footer>&copy; 2017 Laptop World</footer>

</body>
</html>