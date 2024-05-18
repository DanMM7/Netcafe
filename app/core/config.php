<?php

    define('WEBSITE_NAME', 'Netcafe');

    // database configuration
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('DB_NAME', 'netcafe_db');

    define('DEBUG', true);

    if(DEBUG) {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
    } else {
        ini_set('display_errors', 0);
        ini_set('display_startup_errors', 0);
        error_reporting(0);
    }

    // define('ROOT', 'http://localhost/netcafe/');
    // define('ASSETS', ROOT . 'assets/');
    // define('CSS', ASSETS . 'css/');
    // define('JS', ASSETS . 'js/');
    // define('IMG', ASSETS . 'img/');
    // define('FONTS', ASSETS . 'fonts/');
    // define('VIEWS', 'app/views/');
    // define('CONTROLLERS', 'app/controllers/');
    // define('MODELS', 'app/models/');
    // define('CORE', 'app/core/');
    // define('HELPERS', 'app/helpers/');
    // define('CONFIG', 'app/config/');
    // define('PUBLIC', 'public/');
    // define('UPLOADS', PUBLIC . 'uploads/');
    // define('LIBS', 'libs/');
    // define('VENDOR', 'vendor/');
    // define('BASE', 'base/');
    // define('BASE_URL', 'http://localhost/netcafe/public/');
    // define('BASE_PATH', __DIR__ . '/');
    // define('BASE_URL', 'http://localhost/netcafe/public/');
    // define('BASE_PATH', __DIR__ . '/');