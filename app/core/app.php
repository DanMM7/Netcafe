<?php

    Class App {
        protected $controller = 'home';
        protected $method = 'index';
        protected $params = [];

        public function __construct() {
            
            $url = $this->parseUrl();

            // Handle direct method calls without controller name
            if(isset($url[0]) && !file_exists('../app/controllers/' . strtolower($url[0]) . '.php')) {
                // Check if this is a method in the default home controller
                $this->controller = 'home';
                require_once '../app/controllers/' . $this->controller . '.php';
                $this->controller = new $this->controller;

                if(method_exists($this->controller, $url[0])) {
                    $this->method = $url[0];
                    unset($url[0]);
                    $this->params = $url ? array_values($url) : [];
                    call_user_func_array([$this->controller, $this->method], $this->params);
                    return;
                }
            }

            // Regular routing
            if(isset($url[0]) && file_exists('../app/controllers/' . strtolower($url[0]) . '.php')) {
                $this->controller = strtolower($url[0]);
                unset($url[0]);
            }

            require_once '../app/controllers/' . $this->controller . '.php';
            $this->controller = new $this->controller;

            if(isset($url[1]) && method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }

            $this->params = $url ? array_values($url) : [];

            // Call the method
            call_user_func_array([$this->controller, $this->method], $this->params);

        }

        private function parseUrl() {
            if(isset($_GET['url'])) {
                return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
            }
            return ['home']; // Return default controller if no URL is set
        }
    }