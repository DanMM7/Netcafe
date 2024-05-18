<?php

    Class Controller {
        
        public function view($view, $data = []) {
            if(file_exists('../app/views/' . $view . '.php')) {
                require_once '../app/views/' . $view . '.php';
            } else {
                require_once '../app/views/404.php';
            }
        }

    }