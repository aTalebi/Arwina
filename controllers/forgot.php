<?php
class Forgot extends Controller
{
    function __Construct()
    {

    }

    function index()
    {
        $this->view('forgot/index','','no','no');
    }

    function checkEmail(){
        $form=$_POST;
        $emailErrors=$this->model->checkEmail($form);

        if(sizeof($emailErrors)>0){
            $this->view('forgot/index',$emailErrors,'no','no');
        }
        else{
            $this->view('forgot/send_email','','no','no');
        }

    }

    function reset($selector,$token){
        if(!empty($selector) && !empty($token)){
            $values['selector']=$selector;
            $values['token']=$token;
            $this->view('forgot/reset',$values,'no','no');
        } 
    }

    function store(){
        $form=$_POST;
        $errorInfos=$this->model->checkLinkValid($form);
        if(sizeof($errorInfos)>0){
            $this->view('forgot/reset',$errorInfos,'no','no');
        }else{
            $this->model->passUpdate($form);
            $this->view('forgot/changeDown',$errorInfos,'no','no');
        }

    }

}

?>