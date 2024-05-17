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

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<body class= "mybody">
    
<table class="content-table">



<tbody>
      <?php 	
        $sql = "SELECT * FROM products ORDER BY id ASC";
                                    $res = mysqli_query($connection, $sql); 
                                    while ($r = mysqli_fetch_assoc($res)) {
                                ?>
      <tr>

            <div class="grid" >
             <div class="grid__card">
                    
             <center> <h3>   &nbsp;    Product Name:   
                        <Br> <?php echo $r['name']; ?>   </h3> </center>
                        
                        <br> <div class="grid__card-details" >
                             <p class="gird__card-info">

                              
                              <img src="<?php echo $r['thumb']; ?>" class="img-responsive" width="200px" alt="">
                            </p>
                            <br>
                            
                            
                             <p class="gird__card-info">
                           <center> <h3>  Price: R <?php echo $r['price']; ?> </center>
                             </p>
                             <h3>
                                <br>
                                <center>
                                
                                  <a href= "addtocart.php?id=<?php echo $r['id']; ?>"  button class="grid__card-button" >
                                    Add to Cart
                                    </button>
                                    </a>
                                    </center>
                            
                            
    </div>
  </div>



    </tr>
                                <?php } ?>
                            </tbody>
                                    
</table>
</div>


</body>






<?php include './inc/footer.php'; ?>