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

                    <h3>User List</h3>

                        <br>

                        <br>

                            <button id="button"><a href="manageUser.php">Manage</a></button>

                            <button id="button"><a href="addUser.php"><i class="fas fa-plus-circle"></i> Add</a></button>

                        <br>

                        <table class="content-table">

                            <thead>

                                <tr>

                                    <th>#</th>

                                    <th>User Name</th>

                                    <th>User Email</th>

                                    <th>User Role</th>

                                    <th>User From</th>

                                </tr>

                            </thead>

                            <tbody>

                                <?php 	

                                    $sql = "SELECT * FROM users";

                                    $res = mysqli_query($connection, $sql); 

                                    while ($r = mysqli_fetch_assoc($res)) {

                                ?>

                                    <tr>

                                        <th scope="row"><?php echo $r['id']; ?></th>

                                        <td><?php echo $r['username']; ?></td>

                                        <td><?php echo $r['email']; ?></td>

                                        <td><?php echo $r['roleId']; ?></td>

                                        <td><?php echo $r['timestamp']; ?></td>

                                    </tr>    

                                <?php } ?>

                            </tbody>

                        </table>

                   </div>

            </div>

        </div>



<?php include 'inc/footer.php'; ?>