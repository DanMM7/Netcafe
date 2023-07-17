<?php

  // session_start();



  require_once '../Config/connect.php';



  $role = 0;

  $message = "";



  if(isset($_POST) & !empty($_POST)){

    $email = $_POST['email'];

    $password = $_POST['password'];



    $result = $connection->query("SELECT * FROM users WHERE email=  '$email'");
     $row = $result->fetch_assoc();
     $count = $result->num_rows;

 if($count < 1)
   {
      
      echo '<script type="text/javascript">
              alert("User does not exist");
              location.href="index.php";
             </script>'; 
   }else{

      if(password_verify($password, $row['passwords'])){

         
           $_SESSION['Admin'] = $row["email"];

             switch ($row["roleId"]) {
               case 1:
                  echo '<script type="text/javascript">
                  alert("Welcome ");
                  location.href="./Manager";
                </script>';

                 break;
               case 2:
                
                  echo '<script type="text/javascript">
                  alert("Welcome ");
                  location.href="./Kitchen";
                  </script>';
                 break;
               case 3:
                  echo '<script type="text/javascript">
                  alert("Welcome ");
                  location.href="./Cashier";
                  </script>';
                 break;
               case 4:
                 echo '<script type="text/javascript">
                  alert("Welcome ");
                  location.href="./Delivery";
                  </script>';
                 break; 
              }
         
        }else{
            echo '<script type="text/javascript">
              alert("Incorrect username or password");
              location.href="index.php";
             </script>'; 
           }
   }

}

  //   if($count > 0)

  //   {

  //     while ($row = mysqli_fetch_assoc($result))

  //     {

  //       #If role = 1 then login as Admin, if it = 2 then login as Staff.

  //       if ($row["roleId"] == 1)

  //       {

  //         $_SESSION['Admin'] = $row["email"];

  //         header("location: ./Manager");

  //       }

  //       else if ($row["roleId"] == 2)

  //       {

  //         $_SESSION['Admin'] = $row["email"];

  //         header("location: ./Kitchen");

  //       }

  //       else if ($row["roleId"] == 3)

  //       {

  //         $_SESSION['Admin'] = $row["email"];

  //         header("location: ./Cashier");

  //       }

  //       else if ($row["roleId"] == 4)

  //       {

  //         $_SESSION['Admin'] = $row["email"];

  //         header("location: ./Delivery");

  //       }

  //       else

  //       {

  //         $_SESSION['Admin'] = $row["email"];



  //         $message = "Invalid Login Credentials";

  //         header("location: index.php");

  //       }

  //     }

  //     /*echo "User exits, create session";

  //     $_SESSION['email'] = $email;

  //     header("location: dashboard.php");

  //     */

  //   }

  //   else

  //   {

  //     $message = "Invalid Login Credentials";

  //   }



  // }



?>



<!DOCTYPE html>

<html>

  <head>

      <!-- Title -->

        <title>Cafe Admin </title>



        <!-- Logo -->

        <link rel="shortcut icon" href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAAolBMVEX/////1U2Tqb06bIuRqLz/0juXrL//1Ef/1EaKo7XD0Nn/00H/0jo3aoqpusoxZ4jR2uK9ytbr7/P/9dn//fjx9Pauvsv/2F//9+Ges8H/3nr/+uv/11dFdJH4+vtZgZvc4uluj6b/8cz/7bn/3G//6az/7Lb/45D/5qD/5Jj/33//+ef/89H/11T/6q7/78P/4YkfXoJ6l6z/335PepZih5/ZMbzWAAANbElEQVR4nO1ca3eiOhRV3gqoUMXaVkqtba1tp7Z35v//tZuAkJOAkqQYnVnZaz5MkRB2zjMnIb2ehoaGhoaGhoaGhoaGhoaGhoaGhoaGhobGv4bp1eNmdzPPsb55eVrdCjXdrvdNt6+/BJqqwnT1Og9s33PdvlvA8/2gv/uctre92qzrTf3t89vpX5sbq61ve26/DvSu2/ejTW+fPpqbur49/8UxPirw/GE3vWL5pvbd48Gm17vAP9LUD3YXIMjH/pF33L9o/7mx6e028Fraevb2zCb5Nrdb3jGHf7eqt90cEz3h6P9ST4vgOeB5yT7W1RvGpq4+2mRfwl6fzxx3XALcy8KjXM6Gd2zw8LjXZyK45pVCgYBY43Qu2LRByVUQbHMTtfcsRXHd5xdgAfscFJsI4mBtY/h+Q5DzN0XL90YNPdq0H1wpJ/hS0zPfdtevz6v3q+urq9Xj5sa1mTHYM1wF9ZGxfdh0+2H7LEtPddR4ZJyMG8yfWH9wvelTAaGQw3uNoO/vVoy7vP28YcbHnStiVr4B85r2f81atFoTju4aX7lm/a/fb07OphuP4ljquCLcUErkzw9byftdqc4B1rNbRnPd4Olg0+mOGkdbZcxYUYKwj49uEfpcG8fD6QdtX/bNUfNawfFQqqcf8C2Dz5a7r28CO1jnOfQNJUI3aE5YCW5hXFEYMj6hCLmi8Vthaq+UA3Y/2mcOU0hRnRDnUM8O21ENtBv1uPLNN9DGPj7X7A5XoFP3hr/dlHZPnC1BXBLp7EfYgTcNBPL+LTRC/z/eZsBv22rC/hQYky+go1Qu4/GLA8ReRXNFGCpcARHeAdELef4dkzScHC9E2TyBPGMD/eiHyKQWpEEiRiEPEAwDfru4hRFG0J6I7/ZVhESYkgroGnQzrTkCg6dK/N6rWEsprIi2CfiZazAu/otglyAmqgj6GyIMm39auiZuxv0Q7pM09hQY4o1Md1fACiXmCNuqT1tBifhOxgyBCH0JUyKGqMDVgNTL2/E2glbYl+iU2L5/eImgKwCv73E7GpDn+YJ+NMdb1alIBJYE6Yx/PG9BsL+T6ZQkivx6I413wpB7MvMEAoyMCIFpuNwJuzRAOOQOFsAIZaywB/IoBZnpJ2DI6faB2EXmIhDEgZ8+5EOGnLFpB3IEyYA9v2yGIJ2R9RNz9zwM+bQU+ibZ1QeVWiruach8Ur7iSbTg9J4GZJicGRSI9pJ+pjclg7SVfAQ/QE7DVzWBM3TZQhLp1BOdeYljCmoYXDn0r0qt5ZWUmLKKWlRFkNMmyGxLWkl7zyTzlsqJxADnsjz3g2qn9OIRiagqFqBeQfzmCIigAiGVdOcg4dBXMMd/FEujSfyUdxLTLkaJH8A38qQoROTyJkRisHRSJAQw2eMwRGK28tVcMEptC46d4EbId5Cb5RWM5GyBkpVuMJ9tr2N0Eavh5gbZZ8h22B7DSZInb4akQqvGDKkpe2u8IJ5XPpKRhRIV8R5DZPEJjL+sowGlSNkJtCioBcSWe3c/n7oST6po+RABLCO11dsqxyu/agRmX0piBQZQ07bNA5XjtWVNCBYVlO3ee4frLMd7nbqFCDxpJZ1zj2aXAN60Tftu57bn+YH0Xm1YU1DkSTFA0G/3b++bl438/leQQfnSDxEHXJQ/7a5IMPlSsCgDsAU7R066LLtVvl1oD7jx65RChBni6ddkKMDNeyecdwMrVL2XHeY1p6vwAVVRvc+b3sMlXQdtA9AU9V9cwF20pwrF8IMA5SKkhXiaAZ565xQhu5v9FD3A9PcMIqRKw1KbZNpA7TJS/1FQj46Jp6hFgw8XVObcEHC7ocRmtRbAff1q0xkCasto13pKZU0q9lw2Ak4x+kG3nwpAN6amhtgIGDHkS01N2J45UpSgnE2XdaJnmE8oTrlpvFCfUHQ2yaA+4VNVQjwAyly6+iB5Ch9qn36/5VFc0Z8IdrODF+YS3ll1FIP+HE3oO4pD2MFHqtjY3YI55U87yB831Ld/qj5XOwL6k2CB75kO4PGUeYQcPimK/g8XwFanCkA/AW2K9o+Gnf4Is9Mk4iegj1ewf1C2oV3zGQ5SOIAp9eXzD6T4Ts2qzx0JId7oIyRkpUifJ3EZXqYEcxSEL7VH8pH2ymcP9TQeGYoSTvCJJniWyswx/KIpenei03L6wCL37lLcKAGViuCjj4Qc4ZQ+sMjtXx5BNJNiTi1pPRICgDl1yHUv71hBDJaizZ3ePDIHm10owTpF74OvxrhlFfxSCdZske/UjKs+c5pQJ1OwU+GJOXsIhY02ebwyTbwL9KIQnyzFY4cIIbyzxy7KRFK1eGcVte/fHYwbt1t2QOzTfzHyY9z22YPc3ODAWUmb2tmXxwV+KZjWTxt07Ze6cTWcCyq9NUw1WOeB/UfwSsuxgZ94pnc+rGpH5uHDVl+qWuP0V8O5rn+DCRLcNh1u6QU3ecn4+tWv/+oGFzTf5cKmrqnYHvubzzl7niKGP/97NLTE9V2DGPERlw0nW7qB2iMDuwLfQcEI9vwCjnyWwtua5xhez1a2ufkE+Gw/CztoCJV/FZ78Y4fxuvb6XKcgd4fpa5PvLA3wAhZeOsD0xW7SVdeen3GBvmNMNx7L0QvW/4b8KjxSgd73X/7WAHEEVzs7P8ja9YL541/uPw9i9bq++1hv/kHxaWhoaGhoaGhoaGho9CZRVL8YRfHxVnG91WwSjRYOwiiZtLRm2iWj0UiggSgG4bhO8Ws8PN5qMv6iL8Qjy3BKGNYi4+w+TXA7w+G8XQaD5XJZuxiabQzNMfV3ZGFeloOksTDwO1sJV+8zRM5Azei7kyRp6V8EiKFZe5ulIMPEcKzRZLb/K80SyzG4FA9LPEuZi5nlWCJ63oKB+W2a7EVBhviVJtTvMRIphxgmhrOoX40co8E3SGMQTh5MthtBhgvHypgbYiTF9s5HjcJCGt/elB+DcJiF5oy+KMYwRYZUuyOxODTNaeKSWbXx+hEGYdR7MJmOxBgiedW1KmuNOGhojIah6aUpa5g/A2aYjUNaiB0w5EEzw66BGfa+zQF18d9jGIchpVL/HkMcM+BFhmE6mzGmkYkynMUx+4wDDNM4y7K4Q1NEvhS/QBhm4OLvsGKYDge/TYTld1L0mj58f38/LJffGA84WWhjGA9HVg4nIp04lmHgPM/AqJxnOlxY+AfLWkyaHiWDQZhnNI75AC7eVwyTZWiaIQJmmd+Zfo3HY3O5RNfG4y9sv8cZznDGmvPAydyitIZFQZBmOMTX9rcaTtYpw9QcgweWDNM/iNd3MsniLLKWZpirMlKiLDHNyWSC1amNIcp3EK8I3TtBonSq5GcYISCGUY54zxrRG0XoydEID0c3FPcMewsoxJLhn2U4qOJIaoVhmfxwexqc24wqLxbjBDYjv9J2iFhZw9IAU5TMW0wiIoeSYboMiebvGUYhnZQvzNLl8vvSoUX9NjRAGkN7GiztmL61E09bMuwl4X11cc/wD2Wc+YX96wlECyazgakozTAxjIy9tQshVgx7S+JA9wxNk3nzobmfS8rHwwngQTN02Fw9M4wuHCphGIW/y4uHGMbhnpg8w+wIQzYNl80kaBCGKAqWDzzEcGaOC0/wlzIchmU94xDDLAyL/yhhOLN4ZtGtAAyREPf/fzjAsAopogzjyTBKkgiFxWN2yDCcsK5HDoOQTPAn4bJQwgMMY7PUYyGGcZJnYns4vAxnBk+ZoB2QYe9PWPTYzDD+vSwDigDDNMnrcM4oSYo6HCfD2GGLP5KgGE7GZi7EiiGwg2yActMylPEzTFGCaSVVPW025NLSWV6u46tItoFi2NsXpUqGS2eIESWLB5SBh/dVrOZniMvgMOgf9TRFkpqMHIO/5NoKmiFyljiNqBia43EYFlOL8T2gwc2wVi88yrCcggiVzdtAM+x9m1YPMPxeOAMMazSksi9uhg5bLzzKsFj4EF76OA6GYTzGyXWTHVLgZRjXCo0iEb8bMAyLesaheFiBl2E9tTw/Q5R6xl3IME1xXWZygQx7DhJiUbzpLQ/KEHkkUiuaNTEcWoM458MM0mGGo24CfA0DplSKsusw3jP8ZueH5CaqcmU0jD5yMWle8Gd+OhwPI4dJ0jqZ4WOGFnNlYX5bBcMhM8ePl9Wf97D8GBm1tbRo//IjZg0qRYGg0luaIS54QA86c7qpRdUZpuby994AH8zQIto4XC6/yj4ReaLdab4MCB6R4ZJLvH9tC1CM8Z3VMDH10sQA7HEk7WZpuM6wNzLLinBeaxsMszjOhovfISzloBzuHkWtQpPivAiYDHH1bTJMHIsUyoZIMosJ9jppPBlZOFsxkqyRIS5F4afkz8D3OZ3UhQdhjWFvSWreI1wnDfN/ZvgAlWiRF1K/9mXiYjm+yklIXRRTdPKF72L1O8J/7wt4tZp3ZIF6aXdZ26B2LTFBzTt5KPK2P2waFY8ezPFXOcxx5OznSJblJBl1X7mJoUjFhoZVMrQsxn5nUV4Lx89oX5zrELOi8tsEqEd4xQHpaVzzgflGlMUiKTO/uHzabFb3l7MM15o78qMaGhoaGhoaGhoaGhoaGhoaGhoaGhoaGhrq8D8cIN9obetoegAAAABJRU5ErkJggg==">



      <!-- Layout -->

      <meta charset="UTF-8">

      <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0" />

          <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

          <meta name="format-detection" content="telephone=no">

          <meta name="description" content="Admin Dashboard" />

          <meta name="keywords" content="admin,dashboard" />

          <meta name="author" content="Dan Malengela" />



      <!-- Style Links -->

          <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.css">

      <!-- Style Links Ends -->



      <!-- Style Files -->

          <link rel="stylesheet" href="./style.css">



      <!-- Script Links -->

              <script src="https://kit.fontawesome.com/ec46da3f73.js" crossorigin="anonymous"></script>

              <script src="https://code.jquery.com/jquery-3.5.0.js" crossorigin="anonymous"></script>



      <!-- Script Files -->

          <script src="./script.js"></script>

  </head>

  <body id="login">

    <div class="wrapper-login">

      <form class="login" action="index.php" method="post">

        <p class="title">Log in</p>

        <p style="color: red"><?php echo $message; ?></p>

        <input type="email" required placeholder="Email" name="email" autofocus/>

        <i class="fa fa-user"></i>

        <input type="password" required placeholder="Password" name="password" />

        <i class="fa fa-key"></i>

        <button>

          <i class="spinner"></i>

          <span class="state">Log in</span>

        </button>

      </form>

      <footer><a target="blank" href="../index.php">@ Netcafe</a></footer>

      </p>

    </div>

  </body>

</html>

