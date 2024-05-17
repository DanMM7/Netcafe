<?php
	 session_start();
    //$connection = new mysqli ('sql301.epizy.com', 'epiz_30446867', 'dUQfW7ql4j', 'epiz_30446867_netcafe');
    $connection = new mysqli ('localhost', 'root', '', 'epiz_30446867_netcafe');



    if(!$connection)
     {

         echo "Error: Unable to connect to MySQL." . PHP_EOL;

         echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;

         echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;

         exit;

     }

?>
