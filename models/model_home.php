<?php

class model_home extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function checkUser($form)
    {
        //     $errors="";
        //     if(empty($_POST['email'])){
        //         array_push($errors,"Bitte geben sie ihre Email ein");
        //     }else if(empty($_POST['pwd'])){
        //         array_push($errors,"Bitte geben sie ihre Password ein");
        //     }else if(count($errors)!==0){
        //         $email=$this->validate($_POST['email']);
        //         $password=$this->validate($_POST['pwd']);
        //         $values=[$email,$password];
        //         $sql="SELECT * FROM user_tbl WHERE email=? AND password=?";
        //         $userInfo=$this->doSelect($sql,$values);
        //         if(count($userInfo)==1){
        //             return $userInfo;
        //         }
        //         else{
        //             header("location:index");
        //             exit();
        //         }
        //     }

        // }else{
        //     header("location:index");
        //     exit();
        
    }
}


?>