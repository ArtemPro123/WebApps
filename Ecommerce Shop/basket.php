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
           <title>Shopping Cart</title>  
           <link rel="stylesheet" type="text/css" href="basketcss.css" />
      </head>  
      <body>  

      <ul>
          <li><a style="font-family:verdana;" href="front-page.html">Home Page</a></li>
          <li><a style="font-family:verdana;" href="gallery.php">Gallery</a></li>
           <li><a style="font-family:verdana;" class = "active" href="basket.php">Basket</a></li>
          <li><a style="font-family:verdana;" href="checkout.php">Checkout</a></li>
      </ul>
      <br>
      <br>
      <br>
      <center>   
        <h1>Basket</h1> 

             <table class="table table-bordered">  
                  <tr>  
                       <th width="40%">Item Name</th>  
                       <th width="10%">Quantity</th>  
                       <th width="20%">Price</th>  
                       <th width="15%">Total</th>  
                       <th width="5%">Action</th>  
                  </tr>  
                  <?php   
                  if(!empty($_SESSION["shopping_cart"]))  
                  {  
                       $total = 0;  
                       foreach($_SESSION["shopping_cart"] as $keys => $values)  
                       {  
                  ?>  
                  <tr>  
                       <td><?php echo $values["item_name"]; ?></td>  
                       <td><?php echo $values["item_quantity"]; ?></td>  
                       <td>£ <?php echo $values["item_price"]; ?></td>  
                       <td>£ <?php echo number_format($values["item_quantity"] * $values["item_price"], 2); ?></td>  
                       <td><a href="basket.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Remove</span></a></td>  
                  </tr>  
                  <?php  
                            $total = $total + ($values["item_quantity"] * $values["item_price"]);  
                       }  
                  ?>  
                  <tr>  
                       <td colspan="3" align="right">Total</td>  
                       <td align="right">£ <?php echo number_format($total, 2); ?></td>  
                       <td></td>  
                  </tr>  
                  <?php  
                  }  
                  ?>  
             </table> 
        </center>   


<img class="basket" src="shopping_basket.png" style = "width:70px;height:70px;">

<div class = "check">
<a class = "link_check" href = "checkout.php">Proceed to Checkout</a>
</div>


<footer>&copy; 2017 Laptop World</footer>

<img class = "logo" src="logo2.png" style = "width:220px;height:55px;">

<div class = "logout">
<a class = "link_out" href = "front-page.html">Log Out</a>
</div>


      </body>  
 </html>