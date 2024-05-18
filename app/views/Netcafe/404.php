<?php
	$this->view('header',$data);				
?>
    <!-- 404 Error Section -->
    <section class="ftco-section ftco-section-2 bg-light" style="background-image: url(<?= ASSETS ?>Netcafe/images/bg_3.jpg);" data-stellar-background-ratio="0.5">
    	<div class="container">
    		<div class="row d-flex justify-content-center">
    			<div class="col-md-6 text-center heading-section ftco-animate">
    				<h2 class="mb-4">404 Error</h2>
    				<p class="mb-4">Oops ! This Page is Not Found</p> 
                </div>
            </div>
        </div>
    </section>
    <!-- End 404 Error Section -->

<?php
	$this->view('footer');
?>