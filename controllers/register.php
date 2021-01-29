<?php
class Register extends Controller
{
    function __Construct()
    {
    }

    function index()
    {
        $this->view('register/index','','no','no');
    }

    function store(){
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            $form=$_POST;
            $errorInfos=$this->model->checkInput($form);
            if(sizeof($errorInfos)>0){
                $this->view('register/index',$errorInfos,'no','no');
            }else{
                $done=$this->model->putUser($form);
                if($done){
                    header('location:'.URL.'login/index');
                }
            }
        }
    }
}

?>