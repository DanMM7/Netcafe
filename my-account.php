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
						<h2>My Account</h2>
					</div>
					<div class="col-md-12">
						<div class="ma-address">
							<h3>My Profile</h3>
							<p>You can view and update your profile</p>
							<div class="row">
								<div class="col-md-6">
									<h4>My Address <a href="profile.php">Edit</a></h4>
									<?php
										$csql = "SELECT u1.firstname, u1.lastname, u1.address1, u1.address2, u1.city, u1.state, u1.country, u1.company, u.email, u1.mobile, u1.zip FROM users u JOIN customers u1 WHERE u.id=u1.uid AND u.id=$uid";
										$cres = mysqli_query($connection, $csql);
										if(mysqli_num_rows($cres) == 1){
											$cr = mysqli_fetch_assoc($cres);
											echo "<p>".$cr['firstname'] ." ". $cr['lastname'] ."</p>";
											echo "<p>".$cr['address1'] ."</p>";
											echo "<p>".$cr['address2'] ."</p>";
											echo "<p>".$cr['city'] ."</p>";
											echo "<p>".$cr['state'] ."</p>";
											echo "<p>".$cr['country'] ."</p>";
											echo "<p>".$cr['company'] ."</p>";
											echo "<p>".$cr['zip'] ."</p>";
											echo "<p>".$cr['mobile'] ."</p>";
											echo "<p>".$cr['email'] ."</p>";
										}
									?>
								</div>

							</div>
						</div>

						<br>
			<br>
			<br>
			<br>

						<div class="ma-address">
							<h3>My Orders</h3>
							<p>View orders status and cancel orders</p>
							<div class="row">
								<div class="col-md-6">
									<h4>My orders <a href="orders.php">View</a></h4>
								</div>
							</div>
						</div>

			<br>
			<br>
			<br>

						<div class="ma-address">
							<h3>My Addresses</h3>
							<p>The following addresses will be used on the checkout page by default.</p>
							<div class="row">
								<div class="col-md-6">
												<h4>My Address <a href="edit-address.php">Edit</a></h4>
									<?php
										$csql = "SELECT u1.firstname, u1.lastname, u1.address1, u1.address2, u1.city, u1.state, u1.country, u1.company, u.email, u1.mobile, u1.zip FROM users u JOIN customers u1 WHERE u.id=u1.uid AND u.id=$uid";
										$cres = mysqli_query($connection, $csql);
										if(mysqli_num_rows($cres) == 1){
											$cr = mysqli_fetch_assoc($cres);
											echo "<p>".$cr['firstname'] ." ". $cr['lastname'] ."</p>";
											echo "<p>".$cr['address1'] ."</p>";
											echo "<p>".$cr['address2'] ."</p>";
											echo "<p>".$cr['city'] ."</p>";
											echo "<p>".$cr['state'] ."</p>";
											echo "<p>".$cr['country'] ."</p>";
											echo "<p>".$cr['company'] ."</p>";
											echo "<p>".$cr['zip'] ."</p>";
											echo "<p>".$cr['mobile'] ."</p>";
											echo "<p>".$cr['email'] ."</p>";
										}
									?>
								</div>

							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</section>
	
<?php include 'inc/footer.php' ?>
