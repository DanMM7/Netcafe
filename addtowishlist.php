<?php
	ob_start();

	// session_start();

	require_once './Config/connect.php';

	$uid = $_SESSION['customerid'];

	if(!isset($_SESSION['customer']) & empty($_SESSION['customer']))
	{
		//Redirect to login page
		header('location: login.php');
	}

	if(isset($_GET['id']) & !empty($_GET['id']))
	{
		//Add items into user wishlist
		$pid = $_GET['id'];
		
		echo $sql = "INSERT INTO wishlist (pid, uid) VALUES ($pid, $uid)";
		
		$res = mysqli_query($connection, $sql);
		
		if($res)
		{
			//Redirect to wishlist page
			header('location: wishlist.php');
		}
	}
	else
	{
		//Redirect to wishlist page
		header('location: wishlist.php');
	}

?>