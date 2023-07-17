<?php
	/*session_start();

    if(!isset($_SESSION['Admin']) & empty($_SESSION['Admin']))
    {
		header('location: index.php');
    }*/
    require_once '../../Config/connect.php';


    if(isset($_GET) & !empty($_GET))

    {

		$id = $_GET['id'];

    }

    else

    {

		header('location: manageCat.php');

	}



    if(isset($_POST) & !empty($_POST))

    {

		$id = mysqli_real_escape_string($connection, $_POST['id']);

		$name = mysqli_real_escape_string($connection, $_POST['categoryname']);

		$sql = "UPDATE users SET firstname = '$name' WHERE id=$id"; 

        $res = mysqli_query($connection, $sql);

        

        if($res)

        {

			$smsg = "Category Updated";

        }

        else

        {

			$smsg = "Failed Update Category";

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

                    <h4>Edit Category</h4>

                    <p><?php //echo $smsg;?></p>

                    <br>

                        <br>

                            <form method="post">

                                <?php 	

                                    $sql = "SELECT * FROM category WHERE id=$id";

                                    $res = mysqli_query($connection, $sql); 

                                    $r = mysqli_fetch_assoc($res); 

                                ?>

                                <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">

                                <input type="text" name="categoryname"  value="  <?php echo $r['name'];  ?>">

                                <br>

                                <br>

                                <button id="button"><a href="#">Update</a></button>

                                <button id="button"><a href="manageCat.php">Back</a></button>

                            </form>

                        <br>

                   </div>

            </div>

        </div>



<?php include 'inc/footer.php'; ?>