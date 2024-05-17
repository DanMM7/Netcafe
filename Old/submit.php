<?php
        require './Config/connect.php'; 
        require './Config/API.php';

        /*if(!isset($_SESSION['email'])){
            header('location:index.php');
        }else{
            $user_id=$_GET['id'];
            $confirm_query="UPDATE orders SET orderstatus='Order Placed' WHERE uid=$user_id";
            $confirm_query_result=mysqli_query($connection,$confirm_query) or die(mysqli_error($connection));

        }*/

        if (isset($_POST['stripeToken'])) 
        {
            \Stripe\Stripe::setVerifySslCerts(false);

            $token = $_POST['stripeToken'];

            $data = \Stripe\Charge::create( array(
            "amount" => 2000, 
            "currency" => "zar", 
            "name"=> 
            "Sweet Foods", 
            "source" => $token, 
            ));

            echo '<pre>';
            print_r($data);
        }

?>
