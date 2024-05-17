<?php

	// session_start();

	

    require_once '../../Config/connect.php'; 

    

    $msg = "";

	

	if(isset($_POST['addUser']))

	{

        //$email = mysqli_real_escape_string($connection, $_POST['email']);

		$email = filter_var($_POST['Email'], FILTER_SANITIZE_EMAIL);

        $password = password_hash('netcafe123', PASSWORD_DEFAULT);

        $phone = filter_var($_POST['Phone'], FILTER_SANITIZE_NUMBER_INT);

        $roleid =$_POST['Role'];

		

		//$sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";

		echo $sql = "INSERT INTO users (email, passwords, roleId) VALUES ('$email', '$password', '$roleid')";

		$res = mysqli_query($connection, $sql);

		

		if($res)

		{

            //echo "User exits, create session";

            $msg = "User as been added";

			header("location: manageUser.php");

		}

		else

		{

            $msg = "User could not be added";

			header("location: manageUser.php");

        }



        $apiURL = 'https://api.chat-api.com/instanceYYYYY/';

        $token = 'abcdefgh12345678';

        

        $message = "Hey bro";

        

        $data = json_encode(

            array(

                'chatId'=>$phone.'@c.us',

                'body'=>$message

            )

        );

        

        $url = $apiURL.'message?token='.$token;

        $options = stream_context_create(

            array('http' =>

                array(

                    'method'  => 'POST',

                    'header'  => 'Content-type: application/json',

                    'content' => $data

                )

            )

        );



        $response = file_get_contents($url,false,$options);

        echo $response; exit;

    }



?>



<?php include './inc/head.php'; ?>



<?php include './inc/nav.php'; ?>



<?php include './inc/header.php'; ?>



                <div class="content">

                    <div class="item">

                        <p>Users</p>

                    </div>

                   <div class="item-elements">



                        <form method="post" action="addUser.php"> 

                            <h3 class="title">New User</h3>

                            <br>

                            <br>
                            <select name="Role" autofocus required>
                            <option value="">Choose role...</option>
                            <option value=1>Admin</option>
                            <option value=3>Cashier</option>
                            <option value=4>Delivery</option>
                            <option value=2>Kitchen</option>
                            </select>
                            <!-- <input type="text" name="Role" required placeholder="Role ID" autofocus/> -->

                            <br>

                            <br>

                            <input type="email"  name="Email" required placeholder="Email" autofocus/>

                            <br>

                           <!--  <br>

                            <input type="cellphone"  name="Phone" required placeholder="Cellphone" autofocus/> -->

                            <br>

                            <br>

                            <input type="text"  name="Password" value="netcafe123" disabled/>

                            <br>

                            <br>

                            <!-- <button id="button"><a href="#">Add</a></button> -->
                            <button type="submit" id="button" name="addUser">Add</button>

                            <button id="button"><a href="manageUser.php">Back</a></button>

                            <br>

                        </form>

 

                   </div>

            </div>

        </div>



<?php include './inc/footer.php'; ?>