<?php
	session_start();
	session_destroy();

	echo '<script type="text/javascript">
					alert("You are successfully logged out!");
					location.href="index.php";
				 </script>';

?>
