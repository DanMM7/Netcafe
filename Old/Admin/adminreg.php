<?php
	require_once '../Config/connect.php';

	if (isset($_POST['register'])) {
		

	 $email    = $_POST['email'];
	 $password = $_POST['password'];
	 $passwordagain = $_POST['passwordagain'];
			//$username= mysqli_real_escape_string($connection,$_POST['username']);
	    
	    $regex_email = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[_a-z0-9-]+)*(\.[a-z]{2,3})$/";

		  if(empty($email) || empty($password) || empty($passwordagain)){

	        echo '<script type="text/javascript">
					alert("All fields are required");
					location.href="adminreg.php";
				 </script>';
	    	}
	    
	 if(!preg_match($regex_email, $email)){

	        echo '<script type="text/javascript">
				alert("Incorrect email. Redirecting you back to registration page...");
				location.href="adminreg.php";
			</script>';
	    	}
	   
	    if(strlen($password) < 6) {
	        
	        echo '<script type="text/javascript">
				alert("Password should have atleast 6 characters. Redirecting you back to registration page...");
						
				location.href="adminreg.php";
			</script>';
	    }
        
        if($password !== $passwordagain)
        {
	        echo '<script type="text/javascript">
				alert("Password confirm does not match password. Redirecting you back to registration page...");
						
				location.href="adminreg.php";
			</script>';
        }

	    $duplicate_user_query= $connection->query("SELECT id from users where email ='$email'");
	
	    $rows_fetched = $duplicate_user_query->num_rows;

	    if($rows_fetched > 0){
	       
	        echo '<script type="text/javascript">
				alert("Email already exists in our database!");
						
				location.href="adminreg.php";
			</script>';
	    }else{
				$hashPwd= password_hash($password, PASSWORD_DEFAULT);
	              //Generate vkey
	            $vkey = md5(time(). $email);
	            $customerRoleId = 1;

	            $user_registration_query = $connection->query("INSERT INTO users(email, passwords, roleId, vkey)
	        										 VALUES ('$email','$hashPwd', '$customerRoleId', '$vkey')");
	     

				if ($user_registration_query) {
					 echo '<script type="text/javascript">
							alert("User successfully registered");
									
							location.href="adminadminregreg.php";
							</script>';
				}else{

					echo '<script type="text/javascript">
							alert("User registration failed");
									
							location.href="adminreg.php";
							</script>';
				}	        	   

	    }

}
?>


<div class="col-md-6">

					<div class="box-content">

						<h3 class="heading text-center">Register An Account</h3>

						<div class="clearfix space40"></div>

						<?php if(isset($_GET['message'])){

								if($_GET['message'] == 2){

							?><div class="alert alert-danger" role="alert"> <?php echo "Failed to Register"; ?> </div>

							<?php } } ?>

						<form class="logregform" method="post" action="adminreg.php">

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

							<div class="row">

								<div class="col-md-12">

									<div class="space20"></div>

									<button type="submit" name="register" class="button btn-md pull-right">Register</button>

								</div>

							</div>

						</form>

					</div>

				</div>