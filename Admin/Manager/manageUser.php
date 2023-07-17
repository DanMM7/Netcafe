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

                   <h3>Manage Users</h3>

                        <br>

                        <br>

                            <button id="button"><a href="users.php">View Users</a></button>

                            <button id="button"><a href="addUser.php"><i class="fas fa-plus-circle"></i> Add</a></button>

                        <br>

                        <table class="content-table">

                            <thead>

                                <tr>

                                    <th>#</th>

                                    <th>User Name</th>

                                    <th>Role ID</th>

                                    <th>User Email</th>

                                    <th>Date Registered</th>

                                    <th>Operations</th>

                                </tr>

                            </thead>

                            <tbody>

                                <?php 	

                                    $sql = "SELECT * FROM users";

                                    $res = mysqli_query($connection, $sql);

                                    while ($r = mysqli_fetch_assoc($res)) {

                                        //AND users u JOIN role a WHERE a.id=a.userId

                                ?>

                                    <tr>

                                        <th scope="row"><?php echo $r['id']; ?></th>

                                        <td><?php echo $r['username']; ?></td>

                                        <?php if(isset($r['roleId']) && $r['roleId'] == 1 ): ?>
                                            <td>Admin</td>
                                        <?php endif;?>

                                        <?php if(isset($r['roleId']) && $r['roleId'] == 2 ): ?>
                                            <td>Kitchen</td>
                                        <?php endif;?>

                                        <?php if(isset($r['roleId']) && $r['roleId'] == 3 ): ?>
                                            <td>Cashier</td>
                                        <?php endif;?>

                                        <?php if(isset($r['roleId']) && $r['roleId'] == 4 ): ?>
                                            <td>Delivery</td>
                                        <?php endif;?>

                                        <?php if(isset($r['roleId']) && $r['roleId'] == 5 ): ?>
                                            <td>Customer</td>
                                        <?php endif;?>

                                        <td><?php echo $r['email']; ?></td>

                                        <td><?php echo $r['timestamp']; ?></td>

                                        <td><a href="editUser.php?id=<?php echo $r['id']; ?>"><i class="fas fa-edit"></i></a> | 

                                            <a href="deleteUser.php?id=<?php echo $r['id']; ?>"><i class="fas fa-trash-alt"></i></a></td>

                                    </tr>    

                                <?php } ?>

                            </tbody>

                        </table>





                    </div>

                </div>

            </div>

        </div>



<?php include 'inc/footer.php'; ?>



