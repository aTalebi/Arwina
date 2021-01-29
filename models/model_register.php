<?php

class model_register extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    function checkInput($form){
    
        $errors=[];
        $formToken=$form['token'];

        if(Model::tokenGet($formToken)){                                       //csrf token controll
            if(empty($form["username"])){
                $errors['usernameEmpty']="Geben Sie Ihren Namen ein";
            }else{
                $username=$this->validate($form["username"]);
                if(!preg_match('/^[A-Za-z0-9_]+$/',$username)){
                    $errors['userNameInvalid']="Geben Sie gültige Zeichen ein";
                }
            }
    
            if(empty($form["email"])){
                $errors['emailEmpty']="Geben Sie Ihre E-Mail-Adresse ein";
            }else{
                $email=$this->validate($form["email"]);
                if(!$this->validateEmail($email)){
                    $errors['emailInvalid']="Geben Sie gültige Email ein";
                }
            }
    
            if(empty($form["password-1"])){
                $errors['password1Empty']="Geben Sie Ihr Passwort ein";
            }else{
                $password1=$this->validate($form["password-1"]);
                if(!preg_match('/^[A-Za-z0-9_]+$/', $password1)){
                    $errors['password1Invalid']="Geben Sie gültige Zeichen ein";
                }
            }
    
            if(empty($form["password-2"])){
                $errors['password2Empty']="Geben Sie Ihr Passwort ein";
            }else{
                $password2=$this->validate($form["password-2"]);
                if(!preg_match('/^[A-Za-z0-9_]+$/',$password2)){
                    $errors['password2Invalid']="Geben Sie gültige Zeichen ein";
                }
                if($password1!==$password2 ){
                    $errors['password']="Die Passwörter stimmen nicht überein";
                }
            }
    
            if(empty($form["code"])){
                $errors['codeEmpty']="Geben Sie Ihren code ein";
            }else{
                $code=$this->validate($form["code"]);
                if($code!=="Maryam13373725!"){
                    $errors['codeInvalid']="Geben Sie gültige Code ein";
                }
            }

            $sql="SELECT * FROM user_tbl WHERE email=?"; 
            $email=$form["email"];                          //check if email not exists
            $values=[$email];
            if($this->doExists($sql,$values)){
                $errors['emailExists']="E-Mail-Adresse wird bereits verwendet";
                return $errors;
            }
        }

        return $errors;
    }

    function putUser($form){
        $username=$form["username"];
        $email=$form["email"];
        $password=md5($form["password-1"]);
        //$password=password_hash($form["password-1"],PASSWORD_DEFAULT);                                                                               
        $form=[$username,$email,$password];
            $sql="INSERT INTO user_tbl (username,email,password) VALUES (?,?,?)";
            $this->doQuery($sql,$form);
            return true;
    }

}


?>