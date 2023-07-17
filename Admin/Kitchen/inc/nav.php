<div class="sidebar">
                <div class="bg_shadow"></div>
                <div class="sidebar_inner">
                    <div class="close">
                        <i class="fas fa-times"></i>
                    </div>

                    <div class="profile_info">
                        <div class="profile_img">
                            <img src="./media/profile_1.png" alt="profile_img">
                        </div>
                        <div class="profile_data">
                            <p class="name">emoore@test.com</p>
                            <span> Kitchen </span>
                        </div>
                    </div>

                    <ul class="sidebar_menu">
                        <li class="active">
                            <a href="index.php">
                                <div class="icon"><i class="fas fa-tasks"></i></div>
                                <div class="title">Orders</div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div class="icon"><i class="fas fa-cogs"></i></div>
                                <div class="title">Settings</div>
                                <div class="arrow"><i class="fas fa-chevron-down"></i></div>
                            </a>
                            <ul class="accordion">
                                <li><a href="profile.php">Edit profile</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="logout.php">
                                <div class="icon"><i class="fas fa-sign-out-alt"></i></div>
                                <div class="title">Logout</div>
                            </a>
                        </li>
                    </ul>

                        <div class="footer_menu">
                        <?php $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : '';?>
                            <ul>
                                <li><a href="#"><i class="fas fa-magic"></i></a></li>
                                <li>
                                    <a href="manageOrder.php"><i class="far fa-bell"></i></i></a>
                                    <em>
                                        <?php
                                            //echo count($cart);
                                            echo is_countable($cart);
                                        ?>
						            </em>
                                </li>
                                <li><a href="profile.php"><i class="far fa-user"></i></a></i>
                            </ul>
                        </div>
                </div>
            </div>