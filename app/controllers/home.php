<?php

    Class Home extends Controller{
        
        public function index() {
            $data = [
                'page_title' => 'Netcafe'
            ];
            $this->view('Netcafe/index', $data);
        }


    }

