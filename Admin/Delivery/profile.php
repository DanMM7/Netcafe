<?php
    /*session_start();

    if(!isset($_SESSION['Admin']) & empty($_SESSION['Admin']))
    {
		header('location: index.php');
    }*/
    require_once '../../Config/connect.php';

    $uid = "emoore@test.com";
    $message = "";

	if(isset($_POST) & !empty($_POST))
	{
			$name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
			$surname = filter_var($_POST['surname'], FILTER_SANITIZE_STRING);
			$phone = filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT);
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            //$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

			$usql = "UPDATE employee SET 
			 firstname='$name', lastname='$surname', phone='$phone', password='$password' WHERE email=$uid";
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

    $sql = "SELECT * FROM employee WHERE email = '$uid'";
    $res = mysqli_query($connection, $sql);
    $r = mysqli_fetch_assoc($res);

?>

<?php include './inc/head.php'; ?>

<?php include './inc/nav.php'; ?>

<?php include './inc/header.php'; ?>

                <div class="content">
                   <div class="item-elements">

                    <div class="container">
                    <h2>You profile information</h2>
                        <form class="login" method="post">
                            <h3 class="title">Edit Profile</h3>
                            <p><?php echo $message; ?></p>
                            <br>
                            <input type="text" required  value="Username"autofocus/>
                            <br>
                            <br>
                            <input type="text" required name="name" value="<?php echo $r['firstname']; ?>" autofocus/>
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
                            <button type="button" class="btn btn-primary">
                                Update
                            </button>
                        </form>
                    <!-- Button to Open the Modal -->
                    <br>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
                        Password
                    </button>

                    <!-- Password Form -->
                        <div class="modal fade modal-query" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <div class="">
                                            <h4 class="Send_us_your_query">Update password</h4>
                                        </div>
                                        <br>
                                        <div >
                                            <form class="row" method="post" action="password-update.php">
                                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                    <div>
                                                        <input type="passsword" name="name" id="name" placeholder="New Password" required>
                                                    </div>
                                                </div>
                                                <br>
                                                <br>
                                                <br>
                                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                    <div>
                                                        <input type="passsword" name="email" id="email" placeholder="Confirm Password" required>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-12 col-sm-12 col-xs-12 text-right">
                                                    <button type="button" class="btn-submit">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                   </div>
                </div>
            
<?php include './inc/footer.php'; ?>