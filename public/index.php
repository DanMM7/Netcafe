<?php

    session_start();



    $path = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['PHP_SELF'];
    $path = str_replace('index.php', '', $path);
    
    define('ROOT', $path);
    // define('APP', __DIR__ . '/../app/');
    // define('CONTROLLERS', APP . 'controllers/');
    // define('MODELS', APP . 'models/');
    // define('VIEWS', APP . 'views/');
    // define('CORE', APP . 'core/');
    // define('CONFIG', APP . 'config/');
    // define('HELPERS', APP . 'helpers/');
    //define('PUBLIC', __DIR__ . '/');
    define('ASSETS', $path . 'assets/');
   
    include '../app/init.php';
    //show(ASSETS);
    
    $app = new App;