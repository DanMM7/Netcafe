<?php
	$this->view('Netcafe/layout/header',$data);				
?>

    <section class="home-slider owl-carousel">

      <div class="slider-item" style="background-image: url(images/bg_3.jpg);" data-stellar-background-ratio="0.5">
      	<div class="overlay"></div>
        <div class="container">
          <div class="row slider-text justify-content-center align-items-center">

            <div class="col-md-7 col-sm-12 text-center ftco-animate">
            	<h1 class="mb-3 mt-5 bread">Contact Us</h1>
	            <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Contact</span></p>
            </div>

          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section contact-section">
      <div class="container mt-5">
        <div class="row block-9">
					<div class="col-md-4 contact-info ftco-animate">
						<div class="row">
							<div class="col-md-12 mb-4">
	              <h2 class="h4">Contact Information</h2>
	            </div>
	            <div class="col-md-12 mb-3">
	              <p><span>Address:</span> 123 Tech Lane, Digital District, Your City, ST 12345</p>
	            </div>
	            <div class="col-md-12 mb-3">
	              <p><span>Phone:</span> <a href="tel://+1234567890">+1 234 567 8900</a></p>
	            </div>
	            <div class="col-md-12 mb-3">
	              <p><span>Email:</span> <a href="mailto:info@netcafe.com">info@netcafe.com</a></p>
	            </div>
	            <div class="col-md-12 mb-3">
	              <p><span>Website:</span> <a href="<?=URLROOT?>">netcafe.com</a></p>
	            </div>
						</div>
					</div>
					<div class="col-md-1"></div>
          <div class="col-md-6 ftco-animate">
            <?php if(!empty($data['success'])): ?>
                <div class="alert alert-success">
                    Thank you for your message! We will get back to you soon.
                </div>
            <?php endif; ?>

            <?php if(!empty($data['errors']['db'])): ?>
                <div class="alert alert-danger">
                    <?=$data['errors']['db']?>
                </div>
            <?php endif; ?>

            <form action="<?=URLROOT?>/contact" method="POST" class="contact-form">
            	<div class="row">
            		<div class="col-md-6">
	                <div class="form-group">
	                  <input type="text" name="name" class="form-control <?=!empty($data['errors']['name']) ? 'is-invalid' : ''?>" 
                        placeholder="Your Name" value="<?=isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''?>">
                        <?php if(!empty($data['errors']['name'])): ?>
                            <div class="invalid-feedback"><?=$data['errors']['name']?></div>
                        <?php endif; ?>
	                </div>
                </div>
                <div class="col-md-6">
	                <div class="form-group">
	                  <input type="email" name="email" class="form-control <?=!empty($data['errors']['email']) ? 'is-invalid' : ''?>" 
                        placeholder="Your Email" value="<?=isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''?>">
                        <?php if(!empty($data['errors']['email'])): ?>
                            <div class="invalid-feedback"><?=$data['errors']['email']?></div>
                        <?php endif; ?>
	                </div>
	                </div>
              </div>
              <div class="form-group">
                <input type="text" name="subject" class="form-control <?=!empty($data['errors']['subject']) ? 'is-invalid' : ''?>" 
                    placeholder="Subject" value="<?=isset($_POST['subject']) ? htmlspecialchars($_POST['subject']) : ''?>">
                    <?php if(!empty($data['errors']['subject'])): ?>
                        <div class="invalid-feedback"><?=$data['errors']['subject']?></div>
                    <?php endif; ?>
              </div>
              <div class="form-group">
                <textarea name="message" cols="30" rows="7" class="form-control <?=!empty($data['errors']['message']) ? 'is-invalid' : ''?>" 
                    placeholder="Message"><?=isset($_POST['message']) ? htmlspecialchars($_POST['message']) : ''?></textarea>
                    <?php if(!empty($data['errors']['message'])): ?>
                        <div class="invalid-feedback"><?=$data['errors']['message']?></div>
                    <?php endif; ?>
              </div>
              <div class="form-group">
                <input type="submit" value="Send Message" class="btn btn-primary py-3 px-5">
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>

    <div id="map"></div>

<?php
	$this->view('Netcafe/layout/footer');
?>