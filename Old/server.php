<?php
	
	 require 'Config/connect.php';	 

if(isset($_POST['Login']))
{
	 $email=  $_POST['email'];
	 $password= $_POST['password'];

	if(empty($email) || empty($password)){

	        echo '<script type="text/javascript">
					alert("All fields are required");
					location.href="login.php";
				 </script>';
	  }

	 $result = $connection->query("SELECT * FROM users WHERE email ='$email'");
     $row = $result->fetch_assoc();
     $rowCount = $result->num_rows;

		// echo '<pre>';
		// var_dump($result);
		// die();

	 if($rowCount < 1)
	 {
	    
			echo '<script type="text/javascript">
							alert("User does not exist");
							location.href="login.php";
						 </script>'; 
	 }
	 else
	 {
		 if(password_verify($password, $row['passwords']))
		         {

    			 $_SESSION['customer']  = $email;
    			 $_SESSION['customerid']= $row['id'];  //user id

    			echo '<script type="text/javascript">
					alert("Welcome ");
					location.href="index.php";
				 	</script>';
	         }else{
	         	echo '<script type="text/javascript">
							alert("Incorrect username or password");
							location.href="login.php";
						 </script>'; 
	         }
	 }
	 
}	 
   

	 
	 
	 
?>
