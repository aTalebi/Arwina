<?php

class model_login extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    //with security *User input controller*
    function checkUser($form){
        $loginErrors=[];
        
        if($_SERVER['HTTP_HOST']== HOST){
            if(isset($_SERVER['HTTP_REFERER'])){
                if($_SERVER['HTTP_REFERER']== URL || $_SERVER['HTTP_REFERER']== URL.'login/index' || $_SERVER['HTTP_REFERER']== URL.'login/checkUser'){
                    if(isset($form)){
                        $email=$this->validate($form['email']);
                        $password=$this->validate($form['pswd']);
                        $formToken=$this->validate($form['token']);
    
                        if($this->validateEmail($email)){                                   //if Email is Valid
                            if(Model::tokenGet($formToken)){                                //if token is Set 
                                if(!empty($email) and !empty($password)){
                                    if(strlen($password)>4 && strlen($password)<20){
                                        $sql="SELECT * FROM user_tbl WHERE email=? AND password=?";
                                        $password=md5($password);
                                        $values=[$email,$password];
                                        $userInfo=$this->doSelect($sql,$values);
                                        if(sizeof($userInfo)>0){
                                            Model::sessionInit();
                                            Model::sessionSet('userId',$userInfo[0]['id']);               //session set for user and admin
                                            Model::sessionSet('name',$userInfo[0]['username']);           //session set for user and admin
                                            
                                                                                                          //if checkbox checked than cookie set
                                            if(!empty($form['remember'])){
                                                Model::cookieSet("remember_email",$email,31556926);
                                                Model::cookieSet("remember_password",$form['pswd'],31556926);
                                            }else{                                                        //if checkbox unchecked than cookie unset
                                                if(isset($_COOKIE["remember_email"])){
                                                    setcookie("remember_email", "", time() - 3600);
                                                }
                                                if(isset($_COOKIE["remember_password"])){
                                                    setcookie("remember_password", "", time() - 3600);
                                                }
                                            }
        
                                        }else{
                                            $loginErrors['ErrPassword']="Email oder Passwort is nicht gültig";
                                        }
                                    }else{
                                        $loginErrors['ErrPassword']="Email oder Passwort ist nicht gültig";
                                    }
        
                                }if(empty($email)){
                                    $loginErrors['emptyEmail']="Geben Sie Ihre E-Mail-Adresse ein";
                                }if(empty($password)){
                                    $loginErrors['emptyPassword']="Geben Sie Ihr Passwort ein";
                                }

                            }
                        }
                    }
                }
            }
        }
        return $loginErrors;
    }
   
}

?>