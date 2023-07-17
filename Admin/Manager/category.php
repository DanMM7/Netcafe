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

                    <h3>Category List</h3>

                        <br>

                        <br>

                            <button id="button"><a href="manageCat.php">Manage</a></button>

                            <button id="button" class="open-form"><a href="#"><i class="fas fa-plus-circle"></i> Add</a></button>

                        <br>

                        <table class="content-table">

                            <thead>

                                <tr>

                                    <th>#</th>

                                    <th>Category Name</th>

                                    <th>Date</th>

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

									<td><?php echo $r['createdDate']; ?></td>

                                </tr>

                                <?php } ?>

				            			</tbody>

                        </table>

												<div class="form-popup">

													<div class="container form-wrapper">

														<button class="btn close-form">Close</button>

														<form id="my-form" novalidate="novalidate" method="post" action="addCat.php">

															<div class="row">

																<div class="col-md-12 text-center">

																	<h1 class="form-title">Add Category</h1>

																</div>

															</div>

															<div class="row">

																<div class="form-group col-md-6">

																	<label for="name">Category Name</label>

																	<input type="text" class="form-control" id="name" name="categoryname" placeholder="  Category Name" required="">

																</div>

																<br>

															</div>

															<br>

															<button type="submit" class="btn send-form">Add</button>

														</form>

													</div>

												</div>

										  <div class="success-message">

										    <h1>Category has been added!</h1>

										  </div>

                   </div>

            </div>

        </div>

<?php include 'inc/footer.php'; ?>

