<?php

session_start();
session_destroy();

require_once './Config/connect.php';

include 'inc/header.php';

include 'inc/nav.php'; 

//include 'server.php';

?>





	<!-- SHOP CONTENT -->

	<section id="content">

		<div class="content-blog">

			<div class="container">

				<div class="row">

					<div class="page_header text-center">

						<h2>Shop - Account</h2>

						<p>Join Now And Get Your Favourate Foods</p>

					</div>

					<div class="col-md-12">

				<div class="row shop-login">

<div class="col-md-2"></div>

				<div class="col-md-6">

					<div class="box-content">

						<h3 class="heading text-center">Register An Account</h3>

						<div class="clearfix space40"></div>

						<?php if(isset($_GET['message'])){

								if($_GET['message'] == 2){

							?><div class="alert alert-danger" role="alert"> <?php echo "Failed to Register"; ?> </div>

							<?php } } ?>

						<form class="logregform" method="post" action="registerprocess.php">

							<div class="row">

								<div class="form-group">

									<div class="col-md-12">

										<label>E-mail Address</label>

										<input type="email" name="email" value="" class="form-control">

									</div>

								</div>

							</div>

							<div class="clearfix space20"></div>

							<div class="row">

								<div class="form-group">

									<div class="col-md-6">

										<label>Password</label>

										<input type="password" name="password" value="" class="form-control">

									</div>

									<div class="col-md-6">

										<label>Confirm Password</label>

										<input type="password" name="passwordagain" value="" class="form-control">

									</div>

								</div>

							</div>

								<div class="col-md-6">

									<span class="remember-box checkbox">

										<label for="rememberme">

											<a href="login.php">Already have an Account?</a>

										</label>

									</span>

								</div>

							<div class="row">

								<div class="col-md-12">

									<div class="space20"></div>

									<button type="submit" name="register" class="button btn-md pull-right">Register</button>

								</div>

							</div>

						</form>

					</div>

				</div>
<div class="col-md-2"></div>


			</div>







					</div>

				</div>

			</div>

		</div>

	</section>



<?php include 'inc/footer.php' ?>

