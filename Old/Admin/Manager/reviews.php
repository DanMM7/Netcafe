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

                        <p>Users</p>

                    </div>

                   <div class="item-elements">

                    <h3>Customer Reviews</h3>

                        <br>

                        <br>

                            <button id="button"><a href="users.php">View Users</a></button>

                        <br>

                        <table class="content-table">

                            <thead>

                                <tr>

                                    <th>#</th>

                                    <th>Product Name</th>

                                    <th>Review</th>

                                    <th>Posted On</th>

                                </tr>

                            </thead>

                            <tbody>

                                <?php 	

                                    $sql = "SELECT r.id, p.name, r.review, r.`timestamp` FROM reviews r JOIN products p 

                                    WHERE r.pid=p.id";

                                    $res = mysqli_query($connection, $sql); 

                                    while ($r = mysqli_fetch_assoc($res)) {

                                ?>

                                    <tr>

                                        <th scope="row"><?php echo $r['id']; ?></th>

                                        <td><?php echo substr($r['name'], 0, 20); ?></td>

                                        <td><?php echo $r['review']; ?></td>

                                        <td><?php echo $r['timestamp']; ?></td>

                                    </tr>

                                <?php } ?>

                            </tbody>

                        </table>

                   </div>

            </div>

        </div>



<?php include 'inc/footer.php'; ?>