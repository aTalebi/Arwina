<?php

    class Admin extends Controller
    {

        function __Construct()
        { 
            Model::sessionInit();
            $this->checkLogin=Model::sessionGet('userId');
            $this->checkAdminLogin=Model::sessionGet('userLevel');
            echo $this->checkAdminLogin;
            if($this->checkLogin==false  || $_SESSION['userId']!=1){
                header('location:'.URL.'login/index');
            }
        }

        public function index()
        {
            $this->view('admin/index','','no','no');
        }

        public function checkfile()
        {
           if(isset($_POST['submit'])){
               $file=$_FILES["file"];
               $uploadErrors=$this->model->fileInfos($file);
               $this->view('admin/index',$uploadErrors,'no','no');
            }
        }
    }