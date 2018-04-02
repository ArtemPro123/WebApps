 <?php   
 session_start();  
 $connect = mysqli_connect("csmysql.cs.cf.ac.uk", "c1618004","aronafwig3", "c1618004");  
 if(isset($_POST["add_to_cart"]))  
 {  
      if(isset($_SESSION["shopping_cart"]))  
      {  
           $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");  
           if(!in_array($_GET["id"], $item_array_id))  
           {  
                $count = count($_SESSION["shopping_cart"]);  
                $item_array = array(  
                     'item_id'=>$_GET["id"],  
                     'item_name'=>$_POST["hidden_name"],  
                     'item_price'=>$_POST["hidden_price"],  
                     'item_quantity'=>$_POST["quantity"]  
                );  
                $_SESSION["shopping_cart"][$count] = $item_array;  
           }  
           else  
           {  
                echo '<script>alert("Item Already In The Basket")</script>';  
                echo '<script>window.location="basket.php"</script>';  
           }  
      }  
      else  
      {  
           $item_array = array(  
                'item_id'=>$_GET["id"],  
                'item_name'=>$_POST["hidden_name"],  
                'item_price'=>$_POST["hidden_price"],  
                'item_quantity'=>$_POST["quantity"]  
           );  
           $_SESSION["shopping_cart"][0] = $item_array;  
      }  
 }  
 if(isset($_GET["action"]))  
 {  
      if($_GET["action"] == "delete")  
      {  
           foreach($_SESSION["shopping_cart"] as $keys => $values)  
           {  
                if($values["item_id"] == $_GET["id"])  
                {  
                     unset($_SESSION["shopping_cart"][$keys]);  
                }  
           }  
      }  
 }  
 ?> 

<!DOCTYPE html>
<html>
<head>
	<title>Online Checkout</title>
	<link rel="stylesheet" type="text/css" href="checkout.css" />
</head>
<body>

<ul>
  <li><a style="font-family:verdana;" href="front-page.html">Home Page</a></li>
  <li><a style="font-family:verdana;" href="gallery.php">Gallery</a></li>
  <li><a style="font-family:verdana;" href="basket.php">Basket</a></li>
  <li><a style="font-family:verdana;" class = "active" href="checkout.php">Checkout</a></li>
</ul>


 
<table class="table">   
<?php   
if(!empty($_SESSION["shopping_cart"]))  
{  
$total = 0;  
foreach($_SESSION["shopping_cart"] as $keys => $values)  
{  
?>    
<?php  
$total = $total + ($values["item_quantity"] * $values["item_price"]);  
}  
?>  
<tr>  
<td colspan="1" align="right">Grand Total:</td>  
<td align="right">£ <?php echo number_format($total, 2); ?></td>  
<td></td>  
</tr>  
<?php  
}  
?>  
</table> 


<h1>Online Checkout</h1>
<br>
<br>
<br>
<br>
<br>
<br>
<div class="main">
<form name= "forms" method="POST" onSubmit="return checkURL()">
<h4>Name on Card</h4>
<input type="text" id="name" name="cardname" size="40" placeholder="Enter Your Name here.." onfocus="focus1()" onblur="focus1blur()">
<h4>Card Number</h4>
<input type="text" name="homeURL" size="40" placeholder='e.g. 1234 1234 1234 1234' onfocus="focus2()" onblur="focus2blur()">
<h4>Security Code</h4>
<input type="text" name="security" placeholder='e.g. 123'  onfocus="focus3()" onblur="focus3blur()">
<h4>Expiration Date</h4>
<input type="text" name="exp1" placeholder='Enter month e.g. 4 (not 04)'onfocus="focus4()" onblur="focus4blur()">
<input type="text" name="exp2" placeholder='Enter year e.g. 17 (will be 2017)'onfocus="focus5()" onblur="focus5blur()">
<input type="submit" value="Proceed">
</form>
</div>

<h3 id="hint1"></h3>
<h5 id="hint2"></h5>
<h6 id="hint3"></h6>
<h7 id="hint4"></h7>
<h8 id="hint5"></h8>


<footer id="help1"></footer>
<footer id="help2"></footer>
<footer id="help3"></footer>
<footer id="help4"></footer>
<footer id="help5"></footer>

<script type="text/javascript">

function focus1(){
	document.getElementById("help1").innerHTML = "Please Enter Your Name As It Is On Your Card";	
}
function focus1blur(){
	document.getElementById("help1").innerHTML = "";	
}

function focus2(){
	document.getElementById("help2").innerHTML = "Enter Your Card Number";	
}
function focus2blur(){
	document.getElementById("help2").innerHTML = "";	
}

function focus3(){
	document.getElementById("help3").innerHTML = "Enter Your Security Code";	
}
function focus3blur(){
	document.getElementById("help3").innerHTML = "";	
}

function focus4(){
	document.getElementById("help4").innerHTML = "Enter The Expiration Month Of Your Card";	
}
function focus4blur(){
	document.getElementById("help4").innerHTML = "";	
}
function focus5(){
	document.getElementById("help4").innerHTML = "Enter The Expiration Year Of Your Card";	
}
function focus5blur(){
	document.getElementById("help4").innerHTML = "";	
}

function checkURL() {
	var url = document.forms.homeURL.value;
	var sec = document.forms.security.value;
	var exp1 = document.forms.exp1.value;
	var exp2 = document.forms.exp2.value;
	var name = document.forms.cardname.value;

	var hint = "<h2> *Don't forget to Enter your Name e.g. KIRILL SIDOROV </h2>";
	var hint2 = "<h2> *Your bank number should be 16 digits, leave a space every 4 digits</h2>";
	var hint3 = "<h2> *Your security is the last 3 digits on the back of your card</h2>";
	var hint4 = "<h2> *You must have a valid Card and be in Range of 1 - 12 (don't put a 0 first)</h2>";
	var hint5 = "<h2> *Year has to be in Range of 17 - 89</h2>";

	var sec_pattern = new RegExp(/^[0-9]{3}$/);
	var exp1_pattern = new RegExp(/^(1[0-2]|[1-9])$/);
	var exp1_pattern2 = new RegExp(/^(1[0-2]|[3-9])$/);
	var exp2_pattern = new RegExp(/^(1[7-9]|2[0-9]|3[0-9]|4[0-9]|5[0-9]|6[0-9]|7[0-9]|8[0-9])$/);
	var url_pattern = new RegExp(/^([0-9 \-]){4} ([0-9 \-]){4} ([0-9 \-]){4} ([0-9 \-]){4}$/);
	var name_pattern = new RegExp(/^[a-zA-Z]{1,} [a-zA-Z]{1,}$/);


	if(!name.match(name_pattern)){
		alert("Your Card Name Is Invalid");
		document.getElementById("hint1").innerHTML = hint;
		return false;
		
	}else{
		document.getElementById("hint1").innerHTML = "";
	}
	if(!url.match(url_pattern)){
		alert("Your Bank Number Is Invalid"); 
		document.getElementById("hint2").innerHTML = hint2;
		return false; 
	}else{
		document.getElementById("hint2").innerHTML = "";
	}
	if (!sec.match(sec_pattern)){
		alert("Your Security Code Is Invalid");
		document.getElementById("hint3").innerHTML = hint3;
		return false;
	}else{
		document.getElementById("hint3").innerHTML = "";
	}
	if(exp2 == 17 && !exp1.match(exp1_pattern2)){
		alert("Your Card Must be in Date");
		document.getElementById("hint4").innerHTML = hint4;
		return false;
	}else{
		document.getElementById("hint4").innerHTML = "";
	}
	if (!exp1.match(exp1_pattern)){
		alert("Your Expiry Month Is Invalid");
		document.getElementById("hint4").innerHTML = hint4;
		return false;
	}else{
		document.getElementById("hint4").innerHTML = "";
	}
	if (!exp2.match(exp2_pattern)){
		alert("Your Expiry Year Is Invalid");
		document.getElementById("hint5").innerHTML = hint5;
		return false;
	}else{
		document.getElementById("hint5").innerHTML = "";
	}
}
</script>

<img class = "logo" src="logo2.png" style = "width:220px;height:55px;">

<div class = "logout">
<a class = "link_out" href = "front-page.html">Log Out</a>
</div>

</body>
</html>