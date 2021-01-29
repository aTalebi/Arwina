<?php

class model_forgot extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    function checkEmail($form){
        $errors=[];
        if(isset($form)){
            $email=$form['email'];
            $token=$form['token'];
            if((Model::tokenGet($token)) && (Model::validateEmail($email))){                                                     //here check token is set
                if(!empty($email)){
                    if($this->validateEmail($email)){
                        $sql="SELECT username,email FROM user_tbl WHERE email=?";
                        $values=[$email];
                        $checkEmail=$this->doSelect($sql,$values);
                        if(sizeof($checkEmail)>0){
                        
                            $email=$checkEmail[0]["email"];
                            $sql="DELETE FROM pwdreset_tbl WHERE email=?";
                            $deleteRec=$this->doDelete($sql,$values);
                            if($deleteRec){                                                      //when delete the last request 
                                $selectorToTable=bin2hex(random_bytes(8));
                                $tokenToTable=bin2hex(random_bytes(32));
                                $expires=date("U")+1800;
                                $values=[$email,$selectorToTable,$tokenToTable,$expires];
    
                                $sql="INSERT INTO pwdReset_tbl (email,selector,token,expires) values (?,?,?,?);";
                                $this->doQuery($sql,$values);
    
                                //Email send info
                            
                            
                                $hashSelectorToLink=md5($selectorToTable);                     // $hashSelectorToLink=password_hash($selectorToTable,PASSWORD_DEFAULT);
                                $hashTokenToLink=md5($tokenToTable);                           // $hashTokenToLink=password_hash($tokenToTable,PASSWORD_DEFAULT);
                                
                                $createdate = date('H:i:s',$expires);
                                $url=URL."forgot/reset/$hashSelectorToLink/$hashTokenToLink";
        
                                $to=$email;
                                $subject='Setzen Sie Ihr Passwort für ARWINA zurück';
    
                                $message="Hallo ".$checkEmail[0]["username"].",</br>wir haben eine Anfrage zur Erstellung eines neuen Passworts für Ihren Zugang zu ARWINA erhalten.</br>"; 
                                $message.='<a class="btn btn-dark" href=" '.$url.' ">NEUES PASSWORT ERSTELLEN</a></p>';
                                $message.="Der Link ist bis zum ".date("Y/m/d").".2021 um ".$createdate." Uhr gültig.</br></br><hr>";
                                $message.="<h5>Sie haben diese E-Mail nicht angefordert? </h5></br>Es besteht kein Grund zur Sorge für Sie. Ihre Daten waren jederzeit gegen den Zugriff von </br> Dritten geschützt. Wahrscheinlich hat ein anderer IONOS Kunde eine falsche</br> Kundennummer eingegeben und damit den Versand dieser E-Mail ausgelöst.</br><hr>";
        
                                $headers="From:ARWINA<admin@arwina.de>\r\n";
                                $headers.="replay-To:admin@arwina.de\r\n";
                                $headers.="content-type:text/html\r\n";
    
                                //mail($to,$subject,$message,$headers);
                                print_r($message);
                        }else{
                            $errors['errorEmail']="Leider konnten wir Sie anhand der eingegebenen Daten nicht eindeutig identifizieren.";
                        }
                    }else{
                        $errors['invalidEmail']="Leider konnten wir Sie anhand der eingegebenen Daten nicht eindeutig identifizieren.";
                    }
                    }
                }else{
                    $errors['emptyEmail']="Geben Sie Ihre E-Mail-Adresse ein";
                }
            }
            
            return $errors;
        }
    }

    function checkLinkValid($form){
        $errors=[];
        //************************************************ */
        $token=Model::validate($form['token']);                              //hiden
        $getSelectorFromLink=Model::validate($form['emailSelector']);        //hiden
        $getTokenFromLink=Model::validate($form['emailToken']);              //hiden
        //************************************************ *
        $email=Model::validate($form['email']);
        $password1=Model::validate($form['password-1']);
        $password2=Model::validate($form['password-2']);
        if((Model::tokenGet($token)) && (Model::validateEmail($email))){
            if(isset($getSelectorFromLink) && isset($getTokenFromLink)){
                $currentDate=date("U");
                $values=[$email,$currentDate];
    
                $sql="SELECT * FROM pwdReset_tbl WHERE email=? AND expires>?";
                $result=$this->doSelect($sql,$values);
                if(sizeof($result)>0){
                    $tableSelector=md5($result[0]['selector']);
                    $tableToken=md5($result[0]['token']);
    
                    if(($getSelectorFromLink!=$tableSelector) || ($getTokenFromLink!=$tableToken)){
                        $errors['linkInvalid']="Ihr Freischaltcode ist ungültig";
                    }
                    
                    if(empty($password1)){
                        $errors['password1Empty']="Geben Sie Ihr Passwort ein";
                    }else{
                        $password1=$this->validate($password1);
                        if(!preg_match('/^[A-Za-z0-9_]+$/', $password1)){
                            $errors['password1Invalid']="Geben Sie gültige Zeichen ein";
                        }
                    }
    
                    if(empty($password2)){
                        $errors['password2Empty']="Geben Sie Ihr Passwort ein";
                    }else{
                        $password2=$this->validate($password2);
                        if(!preg_match('/^[A-Za-z0-9_]+$/', $password2)){
                            $errors['password2Invalid']="Geben Sie gültige Zeichen ein";
                        }
                        if($password1!==$password2 ){
                            $errors['password']="Die Passwörter stimmen nicht überein";
                        }
                    }
                    
                }else{
                    $errors['freischalt']="Ihr Freischaltcode ist ungültig, oder Die E-Mail-Adresse ist nicht korrekt";
                }
                return $errors;
            }
        }
    }

    function passUpdate($form){
        $email=$form['email'];
        $pwd=md5($form['password-1']);
        $sql="UPDATE user_tbl SET password = ? WHERE email = ?";
        $values=[$pwd,$email];
        $check=$this->doUpdate($sql,$values);
    }
   
}

?>