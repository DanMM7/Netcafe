<?php 

	// session_start();

	

	require_once './Config/connect.php';

	

	//Include sections

	include 'inc/header.php'; 

	include 'inc/nav.php'; 

	

	if(isset($_SESSION['cart']) && isset($_SESSION['customerid']))

	{

		$cart = $_SESSION['cart'];

	}else{

		 echo '<script type="text/javascript">
					alert("You need to login");
					location.href="login.php";
				 </script>';
	}

	

?>



	

	<!-- SHOP CONTENT -->

	<section id="content">

		<div class="content-blog">

			<div class="container">

				<div class="row">

					<div class="page_header text-center">

						<h2>Checkout option</h2>

						<p>Choose your checkout option</p>

					</div>

					<div class="col-md-12">



                    <!-- Checkout Pop-up -->

										

                                            <form class="row" method="post" action="#">

																		<!-- Products Section -->

																		<div class="col-md-12">

																			<div class="row">

																				



																					<div class="sm-item isotope-item">

																						<div class="product">

																							<div class="product-thumb">

                                                                                            <img src="./images/deliver.png" class="img-responsive" width="250px" alt="">

																							

																								<div class="product-overlay">

																									<span>

																									<a href="checkout.php">Hospital Customer</a>

																									<a href="checkout1.php">Public Customer</a>

																									</span>

																								</div>

																							</div>

                                                                                            <h1 class="product-title"> Delivery</h1>

																						</div>

																					</div>

																					<br>

																					<div class="sm-item isotope-item">

																						<div class="product">

																							<div class="product-thumb">

                                                                                            <img src="./images/pickup.png" class="img-responsive" width="250px" alt="">

																							

																								<div class="product-overlay">

																									<span>

																										<a href="pay.php">Pay Now</a>

																									</span>					

																								</div>

																							</div>

                                                                                            <h1 class="product-title"> Pickup</h1>

																						</div>

																					</div>





																				

																			</div>

																		</div>

                                                

                                            </form>



					</div>

				</div>

			</div>

		</div>

	</section>



<?php include 'inc/footer.php' ?>

