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

                        <p>Categories</p>

                    </div>

                    <div class="item-elements">

                    <h3>Manage Categories</h3>

                        <br>

                        <br>

                            <button id="button"><a href="category.php">View Categories</a></button>

                            <button id="button"><a href="addCat.php">+ Add</a></button>

                        <br>

                        <table class="content-table">

                            <thead>

                                <tr>

                                    <th>#</th>

                                    <th>Category Name</th>

                                    <th>Operations</th>

                                </tr>

                            </thead>

                            <tbody>

                                <?php 	

                                    $sql = "SELECT * FROM category";

                                    $res = mysqli_query($connection, $sql); 



                                    while ($r = mysqli_fetch_assoc($res)) {

                                ?>

                                <tr>

                                    <th scope="row"><?php echo $r['id']; ?></th>

                                    <td><?php echo $r['name']; ?></td>

                                    <td><a href="editCat.php?id=<?php echo $r['id']; ?>"><i class="fas fa-edit"></i></a> | 

                                    <a href="deleteCat.php?id=<?php echo $r['id']; ?>"><i class="fas fa-trash-alt"></i></a></td>

                                </tr>

                                <?php } ?>

				            </tbody>

                        </table>

                   </div>

            </div>

        </div>



<?php include 'inc/footer.php'; ?>





