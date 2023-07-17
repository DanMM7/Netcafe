<?php
	// session_start();

	require_once './Config/connect.php';

	require_once 'inc/header.php';
	require_once 'inc/nav.php';
?>

	<!-- SHOP CONTENT -->
	<section id="content">
		<div class="content-blog">
			<div class="container">
				<div class="row">
					<div class="page_header text-center">
						<h2>Welcome</h2>
						<p>You can place your order now</p>
					</div>

					<!-- Products Section -->
					<div class="col-md-12">
						<div class="row">
							<div id="shop-mason" class="shop-mason-4col">
							<?php
								$sql = "SELECT * FROM products";
								if(isset($_GET['id']) & !empty($_GET['id'])){
									$id = $_GET['id'];
									$sql .= " WHERE catid=$id";
								}


								$res = mysqli_query($connection, $sql);
								while($r = mysqli_fetch_assoc($res)){
							?>
								<div class="sm-item isotope-item">
									<div class="product">
										<div class="product-thumb">
											<img src="./Admin/Manager/<?php echo $r['thumb']; ?>" class="img-responsive" width="250px" alt="">
											<div class="product-overlay">
												<span>
												<a href="single.php?id=<?php echo $r['id']; ?>" class="far fa-eye"></a>
												<a href="addtowishlist.php?id=<?php echo $r['id']; ?>" class="fas fa-heart"></a>
												<a href="addtocart.php?id=<?php echo $r['id']; ?>" class="fa fa-shopping-cart"></a>
												</span>
											</div>
										</div>

										<h2 class="product-title"><a href="single.php?id=<?php echo $r['id']; ?>"><?php echo $r['name']; ?></a></h2>
										<div class="product-price">R <?php echo $r['price']; ?><span></span></div>
									</div>
								</div>
							<?php } ?>


							</div>
						</div>
						<div class="clearfix"></div>
						<!-- Pagination -->

						<!-- End Pagination -->
					</div>

				</div>
			</div>
		</div>
	</section>

<?php include 'inc/footer.php' ?>
