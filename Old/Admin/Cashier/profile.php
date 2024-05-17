<?php
    /*session_start();

    if(!isset($_SESSION['Admin']) & empty($_SESSION['Admin']))
    {
		header('location: index.php');
    }*/
    require_once '../../Config/connect.php';

    $uid = "lmabotse@test.com";
    $message = "";

	if(isset($_POST) & !empty($_POST))
	{
			$name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
			$surname = filter_var($_POST['surname'], FILTER_SANITIZE_STRING);
			$phone = filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT);
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

			$usql = "UPDATE admin SET 
			 firstname='$name', lastname='$surname', phone='$phone', password='$password' WHERE useIid=$uid";
			$ures = mysqli_query($connection, $usql) or die(mysqli_error($connection));
			
			if($ures)
			{
                $message = "Your profile as been updated";
            }
            else 
            {
                $message = "Your profile could not be updated";
            }
	}


    $sql = "SELECT * FROM admin WHERE userId=$uid";
	$res = mysqli_query($connection, $sql);
	$r = mysqli_fetch_assoc($res);
?>

<?php include './inc/head.php'; ?>

<?php include './inc/nav.php'; ?>

<?php include './inc/header.php'; ?>

                <div class="content">
                    <div class="item">
                        <p>Profile</p>
                    </div>
                   <div class="item-elements">

                        <form class="login">
                            <h3 class="title">Edit Profile</h3>
                            <p><?php echo $message; ?></p>
                            <br>
                            <input type="text" required name="name" value="<?php if(!empty($r['firstname'])){ echo $r['firstname']; } elseif(isset($name)){ echo $name; } ?>"autofocus/>
                            <br>
                            <br>
                            <input type="text" required name="surname" value="<?php if(!empty($r['lastname'])){ echo $r['lastname']; } elseif(isset($surname)){ echo $surname; } ?>"autofocus/>
                            <br>
                            <br>
                            <input type="cellphone" required name="phone" value="<?php if(!empty($r['phone'])){ echo $r['phone']; } elseif(isset($phone)){ echo $phone; } ?>"autofocus/>
                            <br>
                            <br>
                            <input type="password" required name="password" value="<?php if(!empty($r['password'])){ echo $r['password']; } elseif(isset($password)){ echo $password; } ?>"/>
                            <br>
                            <br>
                            <button id="button"><a href="#">Update</a></button>
                            <br>
                        </form>
 
                   </div>
            </div>
            
<?php include './inc/footer.php'; ?>