<?php
	/*session_start();

    if(!isset($_SESSION['Admin']) & empty($_SESSION['Admin']))
    {
		header('location: index.php');
    }*/
    require_once '../../Config/connect.php';



    if(isset($_GET) & !empty($_GET))

    {

		$id = $_GET['id'];

    }

    else

    {

		header('location: manageProd.php');

	}



    if(isset($_POST) & !empty($_POST))

    {

		$prodname = mysqli_real_escape_string($connection, $_POST['productname']);

		$description = mysqli_real_escape_string($connection, $_POST['productdescription']);

		$category = mysqli_real_escape_string($connection, $_POST['productcategory']);

		$price = mysqli_real_escape_string($connection, $_POST['productprice']);



        if(isset($_FILES) & !empty($_FILES))

        {

          $name = $_FILES['productimage']['name'];

          $size = $_FILES['productimage']['size'];

          $type = $_FILES['productimage']['type'];

          $tmp_name = $_FILES['productimage']['tmp_name'];



          $max_size = 10000000;

          $extension = substr($name, strpos($name, '.') + 1);



                if(isset($name) && !empty($name))

                {

                    if(($extension == "jpg" || $extension == "jpeg") && $type == "image/jpeg" && $size<=$max_size)

                    {

              $location = "uploads/";

              $filepath = $location.$name;

                        

                        if(move_uploaded_file($tmp_name, $filepath))

                        {

                $smsg = "Uploaded Successfully";

                        }

                        else

                        {

                $fmsg = "Failed to Upload File";

              }

                    }

                    else

                    {

              $fmsg = "Only JPG files are allowed and should be less that 1MB";

            }

                }

                else

                {

            $fmsg = "Please Select a File";

          }

            }

            else

            {

          $filepath = $_POST['filepath'];

		}	



		$sql = "UPDATE products SET name='$prodname', description='$description', catid='$category', price='$price', thumb='$filepath' 

        WHERE id = $id";

		$res = mysqli_query($connection, $sql);

        

        if($res)

        {

			$smsg = "Product Updated";

        }

        else

        {

			$fmsg = "Failed to Update Product";

		}

	}

?>



<?php include 'inc/head.php'; ?>



<?php include 'inc/nav.php'; ?>



<?php include 'inc/header.php'; ?>



                <div class="content">

                    <div class="item">

                        <p>Products</p>

                    </div>

                   <div class="item-elements">

                    <h4>Edit Product</h4>

                        <br>

                        <form method="post" enctype="multipart/form-data">

                            <br>

                            <div class="form-group">

                              <h5>Product Name</h5>

                              <input type="text" class="form-control" name="productname" id="Productname" placeholder="  Product Name">

                            </div>



                            <br>

                            <div class="form-group">

                              <h5>Product Description</h5>

                              <textarea class="form-control" name="productdescription" rows="3"></textarea>

                            </div>

              

                            <br>

                            <div class="form-group">

                              <h5>Product Category</h5>

                              <select class="form-control" id="productcategory" name="productcategory">

                                <option value="">--Select Category--</option>

                                <?php 	

                                  $sql = "SELECT * FROM category";

                                  $res = mysqli_query($connection, $sql); 

                                  while ($r = mysqli_fetch_assoc($res)) {

                                 ?>

                                  <option value="<?php echo $r['id']; ?>"><?php echo $r['name']; ?></option>

                              <?php } ?>

                              </select>

                            </div>

                            

                            <br>

                            <div class="form-group">

                              <h5>Product Price</h5>

                              <input type="text" class="form-control" name="productprice" id="productprice" placeholder="Product Price">

                            </div>



                            <br>

                            <div class="form-group">

                              <h5>Product Image</h5>

                              <?php if(isset($r['thumb']) & !empty($r['thumb'])){ ?>

                              <br>

                                <img src="<?php echo $r['thumb'] ?>" widht="100px" height="100px">

                                <a href="delprodimg.php?id=<?php echo $r['id']; ?>">Delete Image</a>

                              <?php } else {?>

                                    <input type="file" name="productimage" id="productimage">

                                    <p class="help-block">Only jpg/png are allowed.</p>

                                <?php } ?>

                            </div>

                            

                            <br>

                            <button id="button"><a href="#">Update</a></button>

                            <button id="button"><a href="manageProd.php">Back</a></button>

                          </form>

                   </div>

            </div>

        </div>



<?php include 'inc/footer.php'; ?>

