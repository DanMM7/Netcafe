<?php
    /*session_start();

    if(!isset($_SESSION['Admin']) & empty($_SESSION['Admin']))
    {
		header('location: index.php');
    }*/
    require_once '../../Config/connect.php';
?>

<?php include './inc/head.php'; ?>

<?php include './inc/nav_S.php'; ?>

<?php include './inc/header.php'; ?>

                <div class="content">
                    <div class="item">
                        <p>Orders</p>
                    </div>
                   <div class="item-elements">
                    <h3>Order List</h3>
                    <br>
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Natus tempore 
                    nostrum atque animi? Placeat neque tempore, similique rem voluptatem 
                    pariatur earum impedit magnam!
                        <br>
                        <br>
                        <button id="button"><a href="manageOrder.php">Manage Orders</a></button>
                            <button id="button" name="download"><a href="#">Download List</a></button>
                        <br>
                        <table class="content-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Customer Name</th>
                                    <th>Total Price</th>
                                    <th>Order Status</th>
                                    <th>Payment Mode</th>
                                    <th>Order Placed On</th>
                                    <th>Order Received On</th>
					            </tr>
                            </thead>
                            <tbody>
                                <?php 	
                                    $sql = "SELECT o.id, o.totalprice, o.orderstatus, o.paymentmode, o.`timestamp`, u.firstname, u.lastname 
                                            FROM orders o JOIN usersmeta u WHERE o.uid=u.uid ORDER BY o.id ASC";
                                    $res = mysqli_query($connection, $sql); 
                                    while ($r = mysqli_fetch_assoc($res)) {
                                ?>
                                <tr>
                                    <th scope="row"><?php echo $r['id']; ?></th>
                                    <td><?php echo $r['firstname']. " " . $r['lastname']; ?></td>
                                    <td>R <?php echo $r['totalprice']; ?></td>
                                    <td><?php echo $r['orderstatus']; ?></td>
                                    <td><?php echo $r['paymentmode']; ?></td>
                                    <td><?php echo $r['timestamp']; ?></td>
                                    <td><?php echo $r['timestamp']; ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                   </div>
            </div>
        </div>

<?php include './inc/footer.php'; ?>
