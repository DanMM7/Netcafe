			<div class="menu-wrap">
				<div id="mobnav-btn">Our Store<i class="fa fa-bars"></i></div>
				<ul class="sf-menu">
					<li>
						<a href="index.php">Home</a>
					</li>
					<li>
						<a href="#">Explore</a>
						<div class="mobnav-subarrow"><i class="fa fa-plus"></i></div>
						<ul>
							<li><a href="about.php"> About Us</a></li>
							<li><a href="faq.php"> FAQ</a></li>
							<li><a href="TsandCs.php"> Terms & Conditions</a></li>
						</ul>
					</li>
					<li>
						<a href="#">Menu</a>
						<div class="mobnav-subarrow"><i class="fa fa-plus"></i></div>
						<ul>
						<!--<li><a href="menu.php"> All</a></li>-->
						<?php
							$catsql = "SELECT * FROM category";
							$catres = mysqli_query($connection, $catsql);
							while($catr = mysqli_fetch_assoc($catres)){
						 ?>
							<li><a href="index.php?id=<?php echo $catr['id']; ?>"><?php echo $catr['name']; ?></a></li>
						<?php } ?>
						</ul>
					</li>
					<li>
						<a href="contact.php"> Contact Us</a>
					</li>
				</ul>
				<div class="header-xtra">
					<?php $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : '';?>
					<div class="s-cart">
						<div class="sc-ico">
							<a href="wishlist.php"><i class="fas fa-heart"></i></a></i>
					    </div>
					</div>
					<div class="s-cart">
						<div class="sc-ico"><i class="fa fa-shopping-cart"></i><em>
							<?php
								$itemNumber= isset($_SESSION['cart']) ? $_SESSION['cart'] : '';
								if ($itemNumber) {
									echo count($itemNumber);
								}
								
								?></em>
							</div>

						<div class="cart-info">
							<small>You have <em class="highlight">
								<?php

								if ($itemNumber) {
									echo count($itemNumber);
								}
							?> item(s)</em> in your shopping bag</small>
							<br>
							<br>
							<?php
								//print_r($cart);
								$total = 0;
								$values = isset($_SESSION['cart']) ? $_SESSION['cart'] : '';

								if (is_array($values) || is_object($values))
								{
								    foreach ($cart as $key => $value)
								    {
											//echo $key . " : " . $value['quantity'] ."<br>";
											$navcartsql = "SELECT * FROM products WHERE id=$key";
											$navcartres = mysqli_query($connection, $navcartsql);
											$navcartr = mysqli_fetch_assoc($navcartres);


								/*
								foreach ($cart as $key => $value)
								{
									//echo $key . " : " . $value['quantity'] ."<br>";
									$navcartsql = "SELECT * FROM products WHERE id=$key";
									$navcartres = mysqli_query($connection, $navcartsql);
									$navcartr = mysqli_fetch_assoc($navcartres);
									*/

							 ?>
							<div class="ci-item">
								<img src="./Admin/Manager/<?php echo $navcartr['thumb']; ?>" width="70" alt=""/>
								<div class="ci-item-info">
									<h5><a href="single.php?id=<?php echo $navcartr['id']; ?>"><?php echo substr($navcartr['name'], 0 , 20); ?></a></h5>
									<p><?php echo $value['quantity']; ?> x R <?php echo $navcartr['price']; ?>.00</p>
									<div class="ci-edit">
										<!-- <a href="#" class="edit fa fa-edit"></a> -->
										<a href="delcart.php?id=<?php echo $key; ?>" class="edit fa fa-trash"></a>
									</div>
								</div>
							</div>
							<?php
							$total = $total + ($navcartr['price']*$value['quantity']);
						} }?>
							<div class="ci-total">Subtotal: R <?php echo $total; ?>.00</div>
							<div class="cart-btn">
								<a href="cart.php">View Bag</a>
								<a href="option.php">Checkout</a>
							</div>
						</div>
					</div>
					<div class="s-cart">
						<?php if(isset($_SESSION['customer'])): ?>

						<div class="sc-ico"><i class="fas fa-user"></i>
							&nbsp; <?=  $_SESSION['customer'] ?>
					    </div>
					    <?php else:?>
					    	<div class="sc-ico"><i class="fas fa-sign-out-alt"></i>
								<a href="login.php">Login</a>	
					    </div>
					    <?php endif;?>
						<div class="cart-info">
						<ul>
							<?php
						   if(isset($_SESSION['customer']))
						   {
								?>
								
									<li><a href="my-account.php"><i class="fas fa-user-edit"></i>   Account</a></li>
									<li><a href="orders.php"><i class="fas fa-clipboard-list"></i>   Orders</a></li>
									<li><a href="edit-address.php"><i class="fas fa-address-card"></i>   Delivery Address</a></li>
									<li><a href="logout.php"><i class="fas fa-sign-out-alt"></i>   Logout</a></li>
								<?php
						   }
						  
                           ?>
						</ul>
						</div>
					</div>
					<div class="s-search">
							<div class="ss-ico"><i class="fa fa-search"></i></div>
							<div class="search-block">
								<div class="ssc-inner">
									<form>
										<input type="text" placeholder="Type Search text here...">
										<button type="submit"><i class="fa fa-search"></i></button>
									</form>
								</div>
							</div>
					</div>
				</div>
			</div>
		</div>
	</header>
