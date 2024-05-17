<!DOCTYPE html>
<html lang="en-UK">
    <head>
        <!-- Title -->
        <title>NetCafe Cafe Panel</title>

        <!-- Logo -->
        <link rel="shortcut icon" href="media/netcafe.png">

		<!-- Layout -->
        <meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="format-detection" content="telephone=no">
        <meta name="description" content="Admin Dashboard" />
        <meta name="keywords" content="admin,dashboard" />
        <meta name="author" content="Dan Malengela" />

		<!-- Style Links -->
             <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
             <link rel="stylesheet" type="text/css" href="path/to/chartjs/dist/Chart.min.css">

		<!-- Style Files -->
            <link rel="stylesheet" href="./css/Main.css">
            <link rel="stylesheet" href="./css/forms.css">

		<!-- Script Links -->
            <script src="https://kit.fontawesome.com/ec46da3f73.js" crossorigin="anonymous"></script>
            <script src="https://code.jquery.com/jquery-3.5.0.js" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
            <script src="./js/App.js" charset="utf-8"></script>
            <script>
                $(document).ready(function(){
                    $(".sidebar_menu li").click(function(){
                        $(".sidebar_menu li").removeClass("active");
                        $(this).addClass("active");
                    })

                        $(".hamburger").click(function(){
                            $(".wrapper").addClass("active");
                        })

                        $(".close, .bg_shadow").click(function(){
                            $(".wrapper").removeClass("active");
                        })
                });
            </script>
    </head>
	<body id="admin">
        <div class="wrapper">
