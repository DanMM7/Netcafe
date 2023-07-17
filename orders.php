<?php 

	ob_start();



	// session_start();



	require_once './Config/connect.php';



	if(!isset($_SESSION['customer']) & empty($_SESSION['customer']))

	{

		//Redirect to login page

		header('location: login.php');

	}



	include 'inc/header.php'; 

	include 'inc/nav.php'; 



	$uid = $_SESSION['customerid'];



	if (isset($_SESSION['cart'])) 

	{

		$cart = $_SESSION['cart'];

	}

	

?>

	

	<!-- SHOP CONTENT -->

	<section id="content">

		<div class="content-blog content-account">

			<div class="container">

				<div class="row">

					<div class="page_header text-center">

						<h2>Manage Orders</h2>

					</div>

					<div class="col-md-12">

                    <h3>Recent Orders</h3>

                    <br>

                    <table class="cart-table account-table table table-bordered">

                        <thead>

                            <tr>

                                <th>Order</th>

                                <th>Date</th>

                                <th>Status</th>

                                <th>Payment Mode</th>

                                <th>Total</th>

                                <th></th>

                            </tr>

                        </thead>

                        <tbody>



                        <?php

                            $ordsql = "SELECT * FROM orders WHERE uid='$uid'";

                            $ordres = mysqli_query($connection, $ordsql);



                            while($ordr = mysqli_fetch_assoc($ordres))

                            {

                        ?>

                            <tr>

                                <td>

                                    <?php echo $ordr['id']; ?>

                                </td>

                                <td>

                                    <?php echo $ordr['timestamp']; ?>

                                </td>

                                <td>

                                    <?php echo $ordr['orderstatus']; ?>			

                                </td>

                                <td>

                                    <?php echo $ordr['paymentmode']; ?>

                                </td>

                                <td>

                                    R <?php echo $ordr['totalprice']; ?>

                                </td>

                                <td>

                                    <a href="view-order.php?id=<?php echo $ordr['id']; ?>">View</a>

                                    <?php if($ordr['orderstatus'] != 'Cancelled'){?>

                                    | <a href="cancel-order.php?id=<?php echo $ordr['id']; ?>">Cancel</a>

                                    <?php } ?>

                                </td>

                            </tr>

                        <?php } ?>

                        </tbody>

                    </table>		



			<br>

			<br>

			<br>



					</div>

				</div>

			</div>

		</div>

	</section>

	

<?php include 'inc/footer.php' ?>

