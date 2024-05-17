<?php
    /*session_start();

    if(!isset($_SESSION['Admin']) & empty($_SESSION['Admin']))
    {
		header('location: index.php');
    }*/
    require_once '../../Config/connect.php';
?>

<?php include './inc/head.php'; ?>

<?php include './inc/nav.php'; ?>

<?php include './inc/header.php'; ?>


        <div class="content">
                <div class="item">
                        <p>My Progress</p>
                </div>
                <div class="item-elements">
                <?php 
                        $sql1 = "SELECT COUNT(id) ordertype FROM orders WHERE ordertype='Delivery'";
                        $del = mysqli_query($connection, $sql1); 
                        $d = mysqli_fetch_assoc($del);
                ?>
                    <div class="card-content">
                    <!-- Card widget -->
                        <!-- card -->
                        <div class="card">

                                <div class="icon1"><?php echo $d['ordertype'];?></div>
                                <p class="title">Orders</p>
                                <p class="text">Total number of orders delivered</p>

                        </div>
                        <!-- end card -->

                        <?php 
                                $sql2 = "SELECT COUNT(id) orderstatus FROM orders WHERE orderstatus='Delivered'";
                                $dev = mysqli_query($connection, $sql2); 
                                $v = mysqli_fetch_assoc($dev);
                        ?>
                        <!-- card -->
                        <div class="card">

                                <div class="icon1"><?php echo $v['orderstatus'];?></div>
                                <p class="title">Deliverd</p>
                                <p class="text">Total number of orders cancelled</p>

                        </div>
                        <!-- end card -->

                        <?php 
                                $sql3 = "SELECT COUNT(id) orderstatus FROM orders WHERE orderstatus='Cancelled'";
                                $can = mysqli_query($connection, $sql3); 
                                $c = mysqli_fetch_assoc($can);
                        ?>
                        <!-- card -->
                        <div class="card">

                                <div class="icon1"><?php echo $c['orderstatus'];?></div>
                                <p class="title">Cancelled</p>
                                <p class="text">Total number of orders cancelled</p>

                        </div>
                        <!-- end card -->

                        <?php 
                                $sql4 = "SELECT CAST(COUNT(id) AS FLOAT) * 10.50 ordertype FROM orders WHERE ordertype='Delivery'";
                                $com = mysqli_query($connection, $sql4); 
                                $m = mysqli_fetch_assoc($com);
                        ?>
                        <!-- card -->
                        <div class="card">

                                <div class="icon1"><?php echo $m['ordertype'];?></div>
                                <p class="title">Commission</p>
                                <p class="text">Number of revenue generated on the system.</p>

                        </div>
                        <!-- end card -->
                    <!-- Card widget Ends -->
                    </div>

                </div>
        </div>

<?php include './inc/footer.php'; ?>
