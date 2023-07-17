<?php 

	// session_start();

	

	require_once './Config/connect.php'; 



	if(isset($_POST) & !empty($_POST))

	{

        $_SESSION["customerId"] = "9";



        

        if (count($_POST) > 0) {

            $result = mysqli_query($connection, "SELECT *from users WHERE userId='" . $_SESSION["userId"] . "'");

            $row = mysqli_fetch_array($result);

            if ($_POST["currentPassword"] == $row["password"]) {

                mysqli_query($conn, "UPDATE users set password='" . $_POST["newPassword"] . "' WHERE userId='" . $_SESSION["userId"] . "'");

                $message = "Password Changed";

            } else

                $message = "Current Password is not correct";

        }

        

	}

?>





