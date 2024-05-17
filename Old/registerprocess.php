<?php
	require_once './Config/connect.php';

	if (isset($_POST['register'])) {
		

	 $email    = $_POST['email'];
	 $password = $_POST['password'];
	 $passwordagain = $_POST['passwordagain'];
	 $statusReg = true;
			//$username= mysqli_real_escape_string($connection,$_POST['username']);
	    
	    $regex_email = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[_a-z0-9-]+)*(\.[a-z]{2,3})$/";

		  if(empty($email) || empty($password) || empty($passwordagain)){
		  	 $statusReg = false;
	        echo '<script type="text/javascript">
					alert("All fields are required");
					location.href="login.php";
				 </script>';
	    	}
	    
	 if(!preg_match($regex_email, $email)){
	 		 $statusReg = false;
	        echo '<script type="text/javascript">
				alert("Incorrect email. Redirecting you back to registration page...");
				location.href="login.php";
			</script>';
	    	}
	   
	    if(strlen($password) < 6) {
	         $statusReg = false;
	        echo '<script type="text/javascript">
				alert("Password should have atleast 6 characters. Redirecting you back to registration page...");
						
				location.href="login.php";
			</script>';
	    }
        
        if($password !== $passwordagain)
        {
        	 $statusReg = false;
	        echo '<script type="text/javascript">
				alert("Password confirm does not match password. Redirecting you back to registration page...");
						
				location.href="login.php";
			</script>';
        }

	    $duplicate_user_query= $connection->query("SELECT id from users where email ='$email'");
	
	    $rows_fetched = $duplicate_user_query->num_rows;

	    if($rows_fetched > 0){
	        $statusReg = false;
	        echo '<script type="text/javascript">
				alert("Email already exists in our database!");
						
				location.href="login.php";
			</script>';
	    }


				if ($statusReg) {
					$hashPwd= password_hash($password, PASSWORD_DEFAULT);
	              //Generate vkey
	            $vkey = md5(time(). $email);
	            $customerRoleId = 5;

	            $user_registration_query = $connection->query("INSERT INTO users(email, passwords, roleId, vkey)
	        										 VALUES ('$email','$hashPwd', '$customerRoleId', '$vkey')");
	     

				if ($user_registration_query) {
					 echo '<script type="text/javascript">
							alert("User successfully registered");
									
							location.href="login.php";
							</script>';
							
							
							
				 $to=$email;
	            $msg= "Thanks for new Registration.";
	            $subject="Thank you for signing up with Netcafe Centurion";
	            $headers .= "MIME-Version: 1.0"."\r\n";
	            $headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
	            $headers .= 'From: Netcafe  | Centurion <info@netcafecenturion.co.za>'."\r\n";

	            $ms.="<html></body><div><div>Dear $email,</div></br></br>";

	            $ms.="<div style='padding-top:8px;'> Thank you for signing up with Netcafe Centurion </div>

	            <div style='padding-top:10px;'>This email is to confirm Your Registration, You may proceed to login.</a></div>

	            <div style='padding-top:14px;'>Powered by <a href='netcafecenturion.co.za'>netcafecenturion.co.za</a></div></div>

	            </body></html>";

	               if( mail($to,$subject,$ms,$headers)){
	                echo "<script>alert('Registration successful, Please check your email for a verification link');</script>";
	                    echo "<script>window.location = 'login.php';</script>";
	               }
	           

						 else
	           {
	               // echo "<script>alert('Data not inserted');</script>";
	               
				 }
							
							
							
				}else{

					echo '<script type="text/javascript">
							alert("User registration failed");
									
							location.href="login.php";
							</script>';
				}
				}
	     


	       
	         //send email
	       




						 


	        //echo "User successfully registered";
	        	   


	     // function loginFunction($email,$password, $customerRoleId, $vkey){ 

	     //    $user_registration_query = $connection->query("INSERT INTO users(email, passwords, roleId, vkey)
	     //    										 VALUES ('$email','$password', '$customerRoleId', $vkey')");
	     //    if ($user_registration_query) 
	     //       return true;
	     //    else
	     //       return false;

	     //    }

}
// else{
// 	echo '<script type="text/javascript">
// 				alert("User successfully registered");
// 				location.href="login.php";
// 			</script>';
// }
?>
