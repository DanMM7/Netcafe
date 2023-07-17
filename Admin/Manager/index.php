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

                        <p>Dashboard</p>

                    </div>

            <div class="item-elements">



                <!-- Card widget -->

                <div class="content1">

                    <?php 

                        $sql1 = "SELECT COUNT(id) email FROM users WHERE roleId='5'";

                        $cus = mysqli_query($connection, $sql1); 

                        $c = mysqli_fetch_assoc($cus);

                    ?>

                   <!-- card -->

                   <div class="card">



                         <div class="icon1"><i class="fas fa-users"></i></div>

                         <p class="title"><?php echo $c['email'];?></p>

                         <p class="text">Total number of clients on the system</p>



                   </div>

                   <!-- end card -->

                   <?php 

                        $sql2 = "SELECT COUNT(id) name FROM products";

                        $pro = mysqli_query($connection, $sql2); 

                        $p = mysqli_fetch_assoc($pro);

                    ?>

                   <!-- card -->

                   <div class="card">



                         <div class="icon1"><i class="fas fa-star"></i></div>

                         <p class="title"><?php echo $p['name'];?></p>

                         <p class="text">Here we have the current top rated product</p>



                   </div>

                   <!-- end card -->

                   <?php 

                        $sql3 = "SELECT COUNT(id) ordertype FROM orders WHERE orderstatus='Delivered'";

                        $sal = mysqli_query($connection, $sql3); 

                        $s = mysqli_fetch_assoc($sal);

                    ?>

                   <!-- card -->

                   <div class="card">



                         <div class="icon1"><i class="fas fa-chart-line"></i></div>

                         <p class="title"><?php echo $s['ordertype'];?></p>

                         <p class="text">Number of revenue generated on the system.</p>



                   </div>

                   <!-- end card -->

                   <?php 

                        $sql4 = "SELECT COUNT(id) ordertype FROM orders";

                        $ord = mysqli_query($connection, $sql4); 

                        $o = mysqli_fetch_assoc($ord);

                    ?>

                    <!-- card -->

                    <div class="card">



                            <div class="icon1"><i class="fas fa-sort-amount-up"></i></div>

                            <p class="title"><?php echo $o['ordertype'];?></p>

                            <p class="text">Total number of order made of the system.</p>



                    </div>

                    <!-- end card -->

                    </div>

                   <!-- Card widget Ends -->

                    </div>



                   <!-- bar chart -->

                   <div class="item-elements">

                       Chart 1

                       <canvas id="myBar" width="200px" height="100px"></canvas>

                   </div>

                   <!-- bar chart Ends-->



                   <!-- pie chart -->

                   <div class="item-elements">

                       Chart 2

                       <canvas id="myPie" width="200" height="100"></canvas>

                   </div>

                   <!-- pie chart Ends-->



                   <!-- line chart -->

                   <div class="item-elements">

                     Chart 3

                     <canvas id="myLine" width="400" height="200"></canvas>

                   </div>

                   <!-- line chart Ends-->



                   <!-- tree chart -->

                   <div class="item-elements">

                       Chart 4

                       <canvas id="myBar1" width="400" height="200"></canvas>

                   </div>

                   <!-- bar chart Ends-->



                   <!-- table data 

                   <div class="item-elements">

                    <h3>Customer Analysis</h3>

                        <table class="content-table">

                            <thead>

                                <tr>

                                    <th> Customer #</th>

                                    <th> Customer name</th>

                                    <th> Date registered</th>

                                    <th> Customer status</th>

                                    <th> Orders #</th>

                                    <th> Products #</th>

                                </tr>

                            </thead>

                            <tbody>

                                <tr>

                                    <td>1</td>

                                    <td>James Brown</td>

                                    <td>2020-03-10</td>

                                    <td>Active</td>

                                    <td>22</td>

                                    <td>14</td>

                                </tr>

                                <tr>

                                    <td>2</td>

                                    <td>Yogi Yamamoto</td>

                                    <td>2020-05-04</td>

                                    <td>Inactive</td>

                                    <td>11</td>

                                    <td>8</td>

                                </tr>

                                <tr>

                                    <td>3</td>

                                    <td>Koffi Olomide</td>

                                    <td>2020-05-19</td>

                                    <td>Active</td>

                                    <td>6</td>

                                    <td>5</td>

                                </tr>

                            </tbody>

                        </table>

                   </div>

                    table data Ends -->



            </div>

        </div>

<?php include './inc/footer.php'; ?>

