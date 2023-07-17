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

		header('location: manageUser.php');

	}



    if(isset($_POST) & !empty($_POST))

    {

        $email = filter_var($_POST['Email'], FILTER_SANITIZE_EMAIL);

        $password = password_hash($_POST['Password'], PASSWORD_DEFAULT);

        $roleid = filter_var($_POST['Role'], FILTER_SANITIZE_NUMBER_INT);

        $id = mysqli_real_escape_string($connection, $_POST['id']);

        

		$sql = "UPDATE users SET roleId = '$roleid', email = '$email', password = '$password' WHERE id=$id";

        $res = mysqli_query($connection, $sql);

        

        if($res)

        {

			$smsg = "User Updated";

        }

        else

        {

			$fmsg = "Failed Update User";

		}

	}

?>

?>



<?php include './inc/head.php'; ?>



<?php include './inc/nav.php'; ?>



<?php include './inc/header.php'; ?>



                <div class="content">

                    <div class="item">

                        <p>Users</p>

                    </div>

                   <div class="item-elements">

                   <?php 	

                                    $sql = "SELECT * FROM users u JOIN employee u1 WHERE u.id=u1.userId";

                                    $res = mysqli_query($connection, $sql); 

                                    $r = mysqli_fetch_assoc($res);

                    ?>

                        <form class="login" method="post">

                            <h3 class="title">Edit User</h3>

                            Admin can change the User's information can be updated and change the user's password

                            <br>

                            <br>

                            <label for="">ID</label>

                            <br>

                            <input type="" readonly value="<?php echo  $_GET['id']; ?>" autofocus/>

                            <br>

                            <br>

                            <label for="">Role ID</label>

                            <br>

                            <input type="text" name="Role"  value="<?php echo $r['roleId']; ?>" autofocus/>

                            <br>

                            <br>

                            <label for="">Email</label>

                            <br>

                            <input type="text" name="Email" value="<?php echo $r['email']; ?>" autofocus/>

                            <br>

                            <br>

                            <label for="">Password</label>

                            <br>

                            <input type="password" name="Password" value="Password" />

                            <br>

                            <br>

                            <button id="button"><a href="#">Update</a></button>

                            <button id="button"><a href="manageUser.php">Back</a></button>

                            <br>

                        </form>

                   </div>

            </div>

        </div>



<?php include './inc/footer.php'; ?>