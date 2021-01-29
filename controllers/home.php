<?php

    class Home extends Controller
    {
        public $checkLogin='';

        function __Construct()
        { 
            Model::sessionInit();
            $this->checkLogin=Model::sessionGet('userId');
            if( $this->checkLogin==false){
                header('location:'.URL.'index');
            }
        }

        public function index()
        {
            $form=$_POST;
            $this->model->checkUser($form);
            Model::sessionInit();
            $check=Model::sessionGet('userId');
            if($check==false){
                $this->view('index/index');
            }else{
                $this->view('home/index','','no','no');
            }
        }

        public function resume()
        {
            
            Model::sessionInit();
            $check=Model::sessionGet('userId');
            if($check==false){
                $this->view('index/index');
            }else{
                $this->view('home/resume','','no','no');
            }
        }

        public function project()
        {
            Model::sessionInit();
            $check=Model::sessionGet('userId');
            if($check==false){
                $this->view('index/index');
            }else{
                $this->view('home/project','','no','no');
            }
        }

        public function bewerbung()
        {
            Model::sessionInit();
            $check=Model::sessionGet('userId');
            if($check==false){
                $this->view('index/index');
            }else{
                $this->view('home/bewerbung','','no','no');
            }
        }
    }
