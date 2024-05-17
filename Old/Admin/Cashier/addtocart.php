<?php
	//session_start();
	
	if(isset($_GET) & !empty($_GET))
	{
		//Add items into cart
		$id = $_GET['id'];
		if(isset($_GET['quant']) & !empty($_GET['quant']))
		{ 
			$quant = $_GET['quant']; }else{ $quant = 1;
		}

		$_SESSION['cart'][$id] = array("quantity" => $quant); 

		//Redirect to user cart
		header('location: cart.php');
	}
	else
	{
		//Redirect to user cart
		header('location: cart.php'); 
	}

	//Display cart items
	echo "<pre>";
	print_r($_SESSION['cart']);
	echo "</pre>";
?>