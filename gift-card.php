<?php 

    // session_start();

    

    require_once './Config/connect.php';

    

	include 'inc/header.php'; 

?>



<?php include 'inc/nav.php'; ?>

	

    <!-- GIFT CARD CONTENT -->

	<section id="content">

		<div class="content-blog">

			<div class="container">

				<div class="row">

                    <div class="page_header text-center">

						<h2>Gift Cards</h2>

						<p>You can place your order now</p>

					</div>

					<div class="col-md-12">

						<div class="row">

							<div id="shop-mason" class="shop-mason-4col">

                                <div class="sm-item isotope-item">

                                    <div class="product">

                                        <div class="route" id="buy"></div>

                                            <section class="giftcard">

                                                <section class="giftcard-cover">

                                                    <i class="fas fa-birthday-cake"></i>

                                                </section>

                                                <div class="giftcard-content">

                                                    <h2>Your order will be shipped to:</h2>

                                                    <address>

                                                    <h3>David Sonki</h3>    

                                                    <a href="#" target="_blank">www.facebook.com/davidSonki</a>    

                                                    <a href="#" target="_blank">www.WhatsApp.com/davidSonki</a>    

                                                    </address>

                                                    <div class="subtext">Available to ship: 1 business day</div>    

                                                </div>

                                                <footer class="giftcard-footer">

                                                    <div class="giftcard-text">

                                                    <h1>Gift Card</h1>

                                                    <h2>R50.00</h2>

                                                    </div>

                                                    <div class="ribbon">

                                                    <div class="giftwrap">

                                                        <a href="#buy" class="button-1">Buy</a>

                                                    </div>

                                                    <div class="bow">

                                                        <i class="fa fa-bookmark"></i>

                                                        <i class="fa fa-bookmark"></i>

                                                    </div>

                                                    </div>

                                                    <div class="giftcard-info">

                                                    <div>

                                                        <input type="text" name="" id="" placeholder="Enter a gift message" />

                                                    </div>

                                                    <div>

                                                        <a href="checkout.php" class="button-1 secondary">Checkout</a>

                                                    </div>

                                                    </div>

                                                </footer>

                                            </section>

                                    </div>

                                </div>     

                            </div>

                        </div>

                    </div>    

                </div>

            </div>

        </div>

    </section>



<?php include 'inc/footer.php' ?>