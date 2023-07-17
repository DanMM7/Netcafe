<?php

	// session_start();

    

    require_once '../../Config/connect.php';

    

    if(!isset($_SESSION['Admin']) & empty($_SESSION['Admin']))

    {

		  header('location: index.php');

	  }



    if(isset($_GET) & !empty($_GET))

    {

		$id = $_GET['id'];

		$sql = "DELETE FROM users WHERE id='$id' "; 



        if(mysqli_query($connection, $sql))

        {

			header('location: manageUser.php');

		}

    }

    else

    {

		header('location: manageUser.php');

	}

?>