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

                        <p>Reports</p>

                    </div>

                   <div class="item-elements">

                    <h3>Netcafe Business Analysis</h3>

                    <br>

                        <br>

                        <iframe width="100%" height="500" src="https://app.powerbi.com/view?r=eyJrIjoiMWE0MGE0YmEtYmM1NS00M2RlLThiYjAtMzMwMWQ1YWY2NzcyIiwidCI6ImU1MjU3M2E0LWMwZjEtNDJiMy04NThmLWFmZTE4OWI1NTU5NSJ9&pageName=ReportSection" frameborder="0" allowFullScreen="true"></iframe>

                        <br>

                        <br>

                            <button id="button"><a href="dashboard.html"><i class="fas fa-tachometer-alt"></i> Home</a></button>

                        <br>

                   </div>

            </div>

        </div>


<?php include './inc/footer.php'; ?>







