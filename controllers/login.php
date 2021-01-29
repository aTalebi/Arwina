<?php
class Login extends Controller
{
    function __Construct()
    {

    }

    function index()
    {
        $this->view('login/index','','no','no');
    }

    function checkUser(){
        $form=$_POST;
        $loginErrors=$this->model->checkUser($form);

        Model::sessionInit();
        $check=Model::sessionGet('userId');
        if($check==false){
            $this->view('login/index',$loginErrors,'no','no');  
            
        }else{
            header('location:'.URL.'home/index');
        }
    }

}

?>