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

                        <p>Products</p>

                    </div>

                   <div class="item-elements">

                    <h3>Product List</h3>

                    <br>

                        <br>

                            <button id="button"><a href="manageProd.php">Manage</a></button>

                            <button id="button"><a href="addProd.php"><i class="fas fa-plus-circle"></i> Add</a></button>

                        <br>

                        <table class="content-table">

                            <thead>

                                <tr>

                                    <th>#</th>

                                    <th>Product Name</th>

                                    <th>Category Name</th>

                                    <th>Thumbnail</th>

                                    <th>Date Added</th>

                                </tr>

                            </thead>

                            <tbody>

                                <?php 	

                                    $sql = "SELECT * FROM products";

                                    $res = mysqli_query($connection, $sql); 

                                    while ($r = mysqli_fetch_assoc($res)) {

                                ?>

                                    <tr>

                                        <th scope="row"><?php echo $r['id']; ?></th>

                                        <td><?php echo $r['name']; ?></td>

                                        <td><?php echo $r['catid']; ?></td>

                                        <td><?php if($r['thumb']){ echo "Yes";}else{echo "No";} ?></td>

                                        <td>13-08-2020</td>

                                    </tr>

				                <?php } ?>

                            </tbody>

                        </table>

                   </div>

            </div>

        </div>



<?php include 'inc/footer.php'; ?>