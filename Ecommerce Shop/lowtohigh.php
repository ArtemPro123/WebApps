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
                echo '<script>window.location="gallery.php"</script>';  
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
           <link rel="stylesheet" type="text/css" href="Lcartcss.css" />
      </head>  
      <body>  

      <ul>
          <li><a style="font-family:verdana;" href="front-page.html">Home Page</a></li>
          <li><a style="font-family:verdana;" class = "active" href="gallery.php">Gallery</a></li>
           <li><a style="font-family:verdana;" href="basket.php">Basket</a></li>
          <li><a style="font-family:verdana;" href="checkout.php">Checkout</a></li>
      </ul>
      <br>
      <h1>Gallery</h1>
      <br>
      <br>
      <br>
      <br>
      <br>
      
      
                <?php  
                $query = "SELECT * FROM items ORDER BY price ASC";  
                $result = mysqli_query($connect, $query);  
                if(mysqli_num_rows($result) > 0)  
                {  
                     while($row = mysqli_fetch_array($result))  
                     {  
                ?>  
                <center>
                <div class="gallery">
                     <form method="post" action="gallery.php?action=add&id=<?php echo $row["id"]; ?>">  
                               <img src="<?php echo $row["image"]; ?>" style = "width:240px;height:160px;"/><br /> 
                               <h4 class="text-info"><?php echo $row["name"]; ?></h4>  
                               <h4>£ <?php echo $row["price"]; ?></h4>  
                               <input type="text" name="quantity" class="form-control" value="1" /> 
                               <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />  
                               <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />  
                               
                               <input type="submit" name="add_to_cart" value="Add to Basket" />   
                     </form>  
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  
                  </div>
                </center>
                <?php  
                     }  
                }  
                ?>                
                <br />  
                <center>   
                <h3 style = "color: #333">Order Summary</h3> 

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
                               <td><a href="gallery.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Remove</span></a></td>  
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



            <form class = "sort" action = "sorting.php" method = "post"/>
            <center>
            <p>Sort By</p>
            </center>
            <input type="radio" name="sortBy" value="alpha" /><label>Alphabetically</label>
            <br>
            <input type="radio" name="sortBy" value="lowHigh" checked="checked" /><label>Price Low - High</label>
            <br>
            <input type="radio" name="sortBy" value="highlow" /><label>Price High - Low</label>
            <br>
            <input id = "form2" type="submit" name="sort" value="Sort">
            </form>

            <div class = "buttonAcer">
            <a class = "link_acer" href = "Acer Aspire F15.php">View Item</a>
            </div>

            <div class = "OMEN">
            <a class = "link_omen" href = "OMEN.php">View Item</a>
            </div>

            <div class = "Erazer">
            <a class = "link_erazer" href = "Erazer.php">View Item</a>
            </div>

            <div class = "Alien">
            <a class = "link_alien" href = "alienware17.php">View Item</a>
            </div>

            <div class = "ASUS">
            <a class = "link_asus" href = "asus.php">View Item</a>
            </div>

            <div class = "MSI">
            <a class = "link_msi" href = "msi.php">View Item</a>
            </div>

            <div class = "check">
            <a class = "link_check" href = "basket.php">Go To Basket</a>
            </div>

            <img class = "logo" src="logo2.png" style = "width:220px;height:55px;">

            <div class = "logout">
            <a class = "link_out" href = "front-page.html">Log Out</a>
            </div>
          
            
            <footer>&copy; 2017 Laptop World</footer>




      </body>  
 </html>