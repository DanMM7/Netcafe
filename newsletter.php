<?php

    require_once './Config/connect.php';

    if (isset($_POST['submit'])) 
    {
        #Connect to db
        $email = mysqli_real_escape_string($connection, $_POST['EMAIL']);

        #SQL query
        $sql = "INSERT INTO newsletter (email) VALUES ('$email')";
        $result = mysqli_query($connection, $sql);

        if (!$result) 
        {
            # code...
            die('Could not post data'.mysqli_error());
        }
        else
        {
            header('Location: index.php!Thank you for subscribing');
            exit();
        }
    }

?>