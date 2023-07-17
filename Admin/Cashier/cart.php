
<?php
    /*session_start();

    if(!isset($_SESSION['Admin']) & empty($_SESSION['Admin']))
    {
		header('location: index.php');
    }*/
    require_once '../../Config/connect.php';

?>


<?php include './inc/head.php'; ?>

<?php include './inc/nav.php'; ?>

<?php include './inc/header.php'; ?>

<?php $cart = $_SESSION['cart']; ?>


<div class="content">
                    <div class="item">
                        <p> Shopping Cart</p>
                    </div>
                   <div class="item-elements">
                    <h3>Cart Items</h3>
                    <br>
                        <br>
                        <br>

                        <table class="content-table">
                            <thead>
                                <tr>
                                    <th> Delete </th>
                                    <th>Product ID</th>
                                    <th>Product Name</th>
                                    <th> Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Order Placed On</th>
                                    
                                    
					            </tr>
                            </thead>
                            <tbody>
                                <?php 	
                               
                                //print_r($cart);
                                $total = 0;
                                
                                foreach ($cart as $key => $value) 
                                {
                                    //echo $key . " : " . $value['quantity'] ."<br>";
                                    $cartsql = "SELECT * FROM products WHERE id=$key";
                                    $cartres = mysqli_query($connection, $cartsql);
                                    $cartr = mysqli_fetch_assoc($cartres);					
                             ?>
                                
                                
					<tr>
						<td>
							<a class="remove" href="delcart.php?id=<?php echo $key; ?>"><i class="fa fa-trash" style="color:red;"></i> Remove </a>
						</td>

						<td>
                            <?php echo $cartr['id']; ?>
                            				
                        </td>
                        <td>
                        <?php echo substr($cartr['name'], 0 , 30); ?>	
                        </td>
						<td>
							<span class="amount">R <?php echo $cartr['price']; ?></span>					
						</td>
						<td>
							<div class="quantity"><?php echo $value['quantity']; ?></div>
						</td>
						<td>
							<span class="amount">R <?php echo ($cartr['price']*$value['quantity']); ?></span>					
						</td>
					</tr>
				<?php 
					$total = $total + ($cartr['price']*$value['quantity']);
				 ?>
                                <?php } ?>

                            </tbody>

                            
                            <a href= "placeorders.php"  button class="grid__card-button"  >
                                    Continue Shopping
                                    </button>
                                    </a>

                        </table>
                        <a href= "checkout.php"  button class="grid__card-button" >
                                    Checkout
                                    </button>
                                    </a>
                                    <br>
                                   
                   </div>
            </div>
        </div>

<?php include './inc/footer.php'; ?>