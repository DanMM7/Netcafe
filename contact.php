<?php
	// session_start();

	require_once './Config/connect.php';

	require_once 'inc/header.php';
	require_once 'inc/nav.php';
?>


<!-- MAIN CONTENT -->
  <section id="content">
    <div class="content-blog">
      <div class="container">
        <div class="row">
          <div class="page_header text-center">
            <h2>Talk to Us</h2>
            <p>Join Now And Get Your Favourate Foods</p>
          </div>
          <div class="col-md-12">
            <div class="row shop-login">
              <div class="col-md-2"></div>
              <div class="col-md-6">
                <div class="box-content">
                  <h3 class="heading text-center">I'm a Returning Customer</h3>
                  <div class="clearfix space40"></div>
                  <?php
                    if(isset($_GET['message'])){
                      if($_GET['message'] == 1){
                   ?>
                   <div class="alert alert-danger" role="alert"> <?php echo "Invalid Login Credentials"; ?> </div>

                  <?php } }?>
                  <form class="logregform" method="post" action="server.php">
                    <div class="row">
                      <div class="form-group">
                        <div class="col-md-12">
                          <label>E-mail Address</label>
                          <input type="email" name="email" class="form-control">
                        </div>
                      </div>
                    </div>
                    <div class="clearfix space20"></div>
                    <div class="row">
                      <div class="form-group">
                        <div class="col-md-12">
                          <a class="pull-right" href="password.php">Forgot Password</a>
                          <label>Password</label>
                          <input type="password" name="password" class="form-control">
                        </div>
                      </div>
                    </div>
                    <div class="clearfix space20"></div>
                    <div class="row">
                      <div class="col-md-6">
                        <span class="remember-box checkbox">
                          <label for="rememberme">
                            <a href="signup.php">Don't have an Account?</a>
                          </label>
                        </span>
                      </div>
                      <div class="col-md-6">
                        <button type="submit" name="Login" class="button btn-md pull-right">Login</button>
                      </div>
                    </div>`
                  </form>
                </div>
              </div>
              <div class="col-md-2"></div>
            </div>
            </div>
          </div>
        </div>
      </div>
  </section>

<?php include 'inc/footer.php' ?>
