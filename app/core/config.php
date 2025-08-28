<?php

    define('WEBSITE_NAME', 'Netcafe');

    // database configuration
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('DB_NAME', 'netcafe_db');

    define('THEME', 'Netcafe');

    // App Root
    define('APPROOT', dirname(dirname(__FILE__)));
    
    // URL Root - update this to match your setup
    define('URLROOT', '/Netcafe');

    // Debug mode
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

