<?php

	// session_start();

    

    require_once '../../Config/connect.php';

    

    if(!isset($_SESSION['Admin']) & empty($_SESSION['Admin']))

    {

		  header('location: index.php');

	  }



    if(isset($_GET['id']) & !empty($_GET['id']))

    {

		$id = $_GET['id'];

		$sql = "SELECT thumb FROM products WHERE id=$id";

		$res = mysqli_query($connection, $sql);

		$r = mysqli_fetch_assoc($res);

        

        if(!empty($r['thumb']))

        {

            

            if(unlink($r['thumb']))

            {

				$delsql = "DELETE FROM products WHERE id=$id";

                

                if(mysqli_query($connection, $delsql))

                {

					header("location: manageProd.php");

				}

			}

        }

        else

        {

			$delsql = "DELETE FROM products WHERE id=$id";

                if(mysqli_query($connection, $delsql))

                {

					header("location: manageProd.php");

				}

		}



    }

    else

    {

		header('location: manageProd.php');

	}