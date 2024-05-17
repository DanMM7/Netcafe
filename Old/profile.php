<?php

	//ob_start();

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



	if(isset($_POST) & !empty($_POST))

	{

			$country = filter_var($_POST['country'], FILTER_SANITIZE_STRING);

			$fname = filter_var($_POST['fname'], FILTER_SANITIZE_STRING);

			$lname = filter_var($_POST['lname'], FILTER_SANITIZE_STRING);

			$company = filter_var($_POST['company'], FILTER_SANITIZE_STRING);

			$phone = filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT);





			$usql = "UPDATE customers SET 

			country='$country', firstname='$fname', lastname='$lname', company='$company', mobile='$phone' WHERE uid=$uid";

			$ures = mysqli_query($connection, $usql) or die(mysqli_error($connection));

			

			if($ures)

			{



			}

	}



	//$sql = "SELECT * FROM customers WHERE uid=$uid";

	//$res = mysqli_query($connection, $sql);

	//$r = mysqli_fetch_assoc($res);



	$usersql = "SELECT u.email, u.username, u1.firstname, u1.lastname, u1.company, u1.mobile FROM users u JOIN customers u1 WHERE u.id=u1.uid AND u.id=$uid";

	$userres = mysqli_query($connection, $usersql);

	$userr = mysqli_fetch_assoc($userres);



?>



	

	<!-- SHOP CONTENT -->

	<section id="content">

		<div class="content-blog">

					<div class="page_header text-center">

						<h2>Profile Information</h2>

						<p>Please make sure the details below are correct</p>

					</div>

					<form method="post">

					<div class="container">

								<div class="row">

									<div class="col-md-6 col-md-offset-3">

										<div class="billing-details">

											<h3 class="uppercase">Update My Address</h3>



											<div class="space30"></div>

												<label class="">Username </label>

                                                <input  class="form-control" readonly value="<?php if(!empty($userr['email'])){ echo $userr['email']; } elseif(isset($fname)){ echo $fname; } ?>" type="text">

                                            <div class="clearfix space20"></div>



                                            <div class="space30"></div>

												<label class="">Email </label>

                                                <input  class="form-control" readonly value="<?php if(!empty($userr['username'])){ echo $userr['username']; } elseif(isset($fname)){ echo $fname; } ?>" type="text">

                                            <div class="clearfix space20"></div>

                                                

												<div class="row">

													<div class="col-md-6">

														<label>First Name </label>

														<input name="fname" class="form-control" placeholder="" value="<?php if(!empty($userr['firstname'])){ echo $userr['firstname']; } elseif(isset($fname)){ echo $fname; } ?>" type="text">

													</div>

													<div class="col-md-6">

														<label>Last Name </label>

														<input name="lname" class="form-control" placeholder="" value="<?php if(!empty($userr['lastname'])){ echo $userr['lastname']; }elseif(isset($lname)){ echo $lname; } ?>" type="text">

													</div>

                                                </div>

                                                

												<div class="clearfix space20"></div>

												    <label>Department</label>

												    <input name="company" class="form-control" placeholder="" value="<?php if(!empty($userr['company'])){ echo $userr['company']; }elseif(isset($company)){ echo $company; } ?>" type="text">

                                                

												<div class="clearfix space20"></div>

												    <label>Phone </label>

												    <input name="phone" class="form-control" id="billing_phone" placeholder="" value="<?php if(!empty($userr['mobile'])){ echo $userr['mobile']; }elseif(isset($phone)){ echo $phone; } ?>" type="text">

                                                <div class="space30">



                                                </div>

                                                

                                                <input type="submit" class="button btn-lg" value="Update Address">

                                                <div class="clearfix space20"></div>



												<button type="button" class="button btn-lg" data-toggle="modal" data-target="#staticBackdrop">

													Password

												</button>

										</div>

									</div>

									

								</div>

							

							</div>		

					</form>	

						

                    <!-- Password Form -->

					<div class="modal fade modal-query" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">

                        <div class="modal-dialog modal-dialog-centered">

                                <div class="modal-content">

                                    <!-- Modal body -->

                                    <div class="modal-body">

                                        <button type="button" class="close" data-dismiss="modal">&times;</button>

                                        <div class="">

                                            <h4 class="Send_us_your_query">Update password</h4>

                                        </div>

                                        <br>

                                        <div >

                                            <form class="row" method="post" action="password-update.php">

                                                <div class="form-group col-md-6 col-sm-6 col-xs-12">

                                                    <div>

                                                        <input type="passsword" name="name" id="name" placeholder="New Password" required>

                                                    </div>

                                                </div>

                                                <br>

                                                <br>

                                                <br>

                                                <div class="form-group col-md-6 col-sm-6 col-xs-12">

                                                    <div>

                                                        <input type="passsword" name="email" id="email" placeholder="Confirm Password" required>

                                                    </div>

                                                </div>

                                                <div class="form-group col-md-12 col-sm-12 col-xs-12 text-right">

                                                    <button type="button" class="btn-submit">Update</button>

                                                </div>

                                            </form>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>



			</div>

	</section>

	

<?php include 'inc/footer.php' ?>

