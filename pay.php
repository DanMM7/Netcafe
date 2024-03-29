<?php 

	// session_start();

	require_once './Config/connect.php';

	include 'inc/header.php'; 

?>



<?php include 'inc/nav.php'; ?>

	

    <!-- PAYMENT CONTENT -->

	<section id="content">

		<div class="content-blog">

			<div class="container">

				<div class="row">

                    <div class="wrapper">

                        <div class="payment">

                            <div class="payment-logo">

                            <i class="fas fa-mug-hot"></i>

                            </div>

                            

                            

                            <h2>Payment</h2>

                            <div class="form">

                            <div class="card space icon-relative">

                                <label class="label">Card holder:</label>

                                <input type="text" class="input" placeholder="Coding Market">

                                <i class="fas fa-user"></i>

                            </div>

                            <div class="card space icon-relative">

                                <label class="label">Card number:</label>

                                <input type="text" class="input" data-mask="0000 0000 0000 0000" placeholder="Card Number">

                                <i class="far fa-credit-card"></i>

                            </div>

                            <div class="card-grp space">

                                <div class="card-item icon-relative">

                                <label class="label">Expiry date:</label>

                                <input type="text" name="expiry-data" class="input"  placeholder="00 / 00">

                                <i class="far fa-calendar-alt"></i>

                                </div>

                                <div class="card-item icon-relative">

                                <label class="label">CVC:</label>

                                <input type="text" class="input" data-mask="000" placeholder="000">

                                <i class="fas fa-lock"></i>

                                </div>

                            </div>

                                

                            <div class="btn">

                                Pay

                            </div> 

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>    

    </section>



<?php include 'inc/footer.php' ?>