<?php

	// session_start();

    

    require_once '../../Config/connect.php';

    

    if(!isset($_SESSION['email']) & empty($_SESSION['email']))

    {

		header('location: category.php');

	}



    if(isset($_POST) & !empty($_POST))

    {

		$name = mysqli_real_escape_string($connection, $_POST['categoryname']);

		$sql = "INSERT INTO category (name) VALUES ('$name')";

        $res = mysqli_query($connection, $sql);

        

        if($res)

        {

			$smsg = "Category Added";

        }

        else

        {

			$fmsg = "Failed Add Category";

		}

	}

?>



<?php include 'inc/head.php'; ?>



<?php include 'inc/nav.php'; ?>



<?php include 'inc/header.php'; ?>



                <div class="content">

                    <div class="item">

                        <p>Categories</p>

                    </div>

                   <div class="item-elements">

                    <h4>New Category</h4>

                        <br>

                       <form method="post">

                        <br>

                                <input type="text" name="categoryname" placeholder="  Category Name">

                                <br>

                            <br>

                                <button id="button"><a href="#">Add</a></button>

                                <button id="button"><a href="manageCat.php">Back</a></button>

                            <br>

                       </form>

                   </div>

            </div>

        </div>



<?php include 'inc/footer.php'; ?>