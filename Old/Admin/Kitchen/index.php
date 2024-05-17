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

            <div class="content">
                    <div class="item">
                        <p>Orders</p>
                    </div>
                   <div class="item-elements">
                    <h3>Order list</h3>

                        <table class="content-table">
                            <thead>
                                <tr>
                                    <th>Order Number</th>
									<th>Order Detail</th>
									<th>Order Status</th>
									<th>Place On</th>
									<th>Total Price</th>
									<th>Update</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
								    $sql = "SELECT DISTINCT  id, ordertype, orderstatus, timestamp , totalprice
								    FROM orders WHERE orderstatus='Preparing' ORDER BY id DESC";
									$res = mysqli_query($connection, $sql);
									while ($r = mysqli_fetch_assoc($res)) {
                                ?>
                                <tr>
									<input type="hidden" name="orderid" value="<?php echo $_GET['id']; ?>">
                                    <th scope="row"><?php echo $r['id']; ?></th>
	                                <td><?php echo $r['ordertype']?></td>
	                                <td><?php echo $r['orderstatus']; ?></td>
	                                <td><?php echo $r['timestamp']; ?></td>
	                                <td><?php echo $r['totalprice']; ?></td>
                                    <td><button id="button"><a href="processOrder.php">Update</a></button></td>
                                </tr>
                                <?php } ?>
				            </tbody>
                        </table>
                   </div>
            </div>
        </div>

<?php include 'inc/footer.php'; ?>
