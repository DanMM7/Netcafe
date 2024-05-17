<?php
	/*session_start();

    if(!isset($_SESSION['Admin']) & empty($_SESSION['Admin']))
    {
		header('location: index.php');
    }*/
    require_once '../../Config/connect.php';
?>



<?php include 'inc/head.php'; ?>
<?php include 'inc/nav.php'; ?>
<?php include 'inc/header.php'; ?>

<?php

    if(isset($_POST) & !empty($_POST))

    {

        $status = filter_var($_POST['status'], FILTER_SANITIZE_STRING);

        $message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);

        $id = filter_var($_POST['orderid'], FILTER_SANITIZE_NUMBER_INT);



        echo $ordprcsql = "INSERT INTO ordertracking (orderid, status, message) VALUES ('$id', '$status', '$message')";

        $ordprcres = mysqli_query($connection, $ordprcsql) or die(mysqli_error($connection));

                

        if($ordprcres)

        {

            $ordupd = "UPDATE orders SET orderstatus='$status' WHERE id=$id";

                    

            if(mysqli_query($connection, $ordupd))

            {

                header('location: manageOrder.php');

            }        

        }



        echo $id;

    }

?>

                <div class="content">

                    <div class="item">

                        <p>Orders</p>

                    </div>

                   <div class="item-elements">

                    <h3>Order Processing</h3>

                        <br>

                        <br>

                            <button id="button"><a href="manageOrder.php">Back</a></button>

                        <br>

                        <form method="post">

                            <table class="content-table">

                                <thead>

                                    <tr>

                                        <th>Order</th>

                                        <th>Date</th>

                                        <th>Status</th>

                                        <th>Payment Mode</th>

                                        <th>Total</th>

                                    </tr>

                                </thead>

                                <tbody>

                                    <?php

                                        if(isset($_GET['id']) & !empty($_GET['id']))

                                        {

                                            $oid = $_GET['id'];

                                        }

                                        else

                                        {

                                            header('location: manageOrder.php');

                                        }



                                        $ordsql = "SELECT * FROM orders WHERE id='$oid'";

                                        $ordres = mysqli_query($connection, $ordsql);



                                        while($ordr = mysqli_fetch_assoc($ordres)){

                                    ?>

                                    <tr>

                                        <td>

                                            <?php echo $ordr['id']; ?>

                                        </td>

                                        <td>

                                            <?php echo $ordr['timestamp']; ?>

                                        </td>

                                        <td>

                                            <?php echo $ordr['orderstatus']; ?>			

                                        </td>

                                        <td>

                                            <?php echo $ordr['paymentmode']; ?>

                                        </td>

                                        <td>

                                            R <?php echo $ordr['totalprice']; ?>

                                        </td>

                                    </tr>

                                    <?php } ?>

                                </tbody>

                            </table>



                                <label class="">Order Status </label>

                                <select name="status" class="form-control">

                                    <option value="">Select Status</option>

                                    <option value="Preparing">Preparing</option>

                                    <option value="Ready">Ready</option>

                                    <option value="Delivered">Delivered</option>

                                    <option value="Cancelled">Cancelled</option>

                                </select>

                                <br>

                                <br>

                                <label>Message :</label>

                                <textarea class="form-control" name="message" cols="10"> </textarea>

                                <br>

                                <input type="hidden" name="orderid" value="<?php echo $_GET['id']; ?>">

                                <br>

                                <button id="button" type="submit"><a href="#">Update</a></button>

                        </form>

                   </div>

            </div>

        </div>

<?php include './inc/footer.php'; ?>