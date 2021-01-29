<?php

class Model
{
    public static $conn='';
    public $totalMenu=[];

    function __construct()
    {
        $serverName='localhost';
        $userName='root';
        $password='';
        $dbname='phpmvc';

        $attr=[PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES utf8'];
        self::$conn=new PDO('mysql:host='.SERVERNAME.';dbname='.DBNAME,USERNAME,PASSWORD,$attr);
        self::$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }

    function doSelect($sql,$values=[],$fetch='',$fetchStyle=PDO::FETCH_ASSOC)      //Select from table
    {
        $stmt=self::$conn->prepare($sql);
        foreach($values as $key=>$value)
        {
            $stmt->bindValue($key+1,$value);
        }
        $stmt->execute();
        if($fetch=='')
        {
            $result=$stmt->fetchAll($fetchStyle);
        }
        else
        {
            $result=$stmt->fetch($fetchStyle);
        }
        return $result;
    }

    function doQuery($sql,$values=[]){                                              //Insert into Table
        $stmt=self::$conn->prepare($sql);
        foreach($values as $key =>$values){
            $stmt->bindValue($key+1,$values);
        }
        $pdoExec=$stmt->execute();
    }

    function doDelete($sql,$values=[],$fetch='',$fetchStyle=PDO::FETCH_ASSOC)       //Delete from Table
    {
        $stmt=self::$conn->prepare($sql);
        foreach($values as $key=>$value)
        {
            $stmt->bindValue($key+1,$value);
        }
        $pdoExec=$stmt->execute();
        if($pdoExec){
            return true;
        }else{
            return false;
        }
    }

    function doUpdate($sql,$values=[],$fetchStyle=PDO::FETCH_ASSOC){                 //Update Table
        $stmt=self::$conn->prepare($sql);
        foreach($values as $key=>$value)
        {
            $stmt->bindValue($key+1,$value);
        }
        $pdoExec=$stmt->execute();
        if($pdoExec){
            return true;
        }else{
            return false;
        }
    }

    function DoExists($sql,$values=[],$fetch='',$fetchStyle=PDO::FETCH_ASSOC){
        $stmt=self::$conn->prepare($sql);
        foreach($values as $key=>$value)
        {
            $stmt->bindValue($key+1,$value);
        }
        $stmt->execute();
        if($fetch=='')
        {
            $result=$stmt->fetchAll($fetchStyle);
        }else
        {
            $result=$stmt->fetch($fetchStyle);
        }

        if(sizeof($result)>0){
            return true;
        }else{
            return false;
        }
    }

    function validate($data)                                   //text input remove from invalid charackter
    {
        $data=trim($data);
        $data=stripslashes($data);
        $data=htmlspecialchars($data);
        return $data; 
    }

    function validateEmail($email)                                   //text input remove from invalid charackter
    {
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            return false;
        }else{
            return true;
        }
    }

    public static function sessionInit(){
        @session_start();
    }

    public static function sessionSet($name,$value){
        session_regenerate_id();                                //a new Sassion 
        $_SESSION[$name]=$value;
    }

    public static function sessionGet($name){
        if(isset($_SESSION[$name])){
            return true;
        }else{
            return false  ;
        }
    }
                                                                //SetCookie 
    public static function cookieSet($name,$value,$expire){
        setcookie($name,$value,(time()+$expire),'/');
    }
                                                                //SetToken
    public static function tokenSet(){
        $token=base64_encode(md5(microtime()));
        Model::sessionInit();
        Model::sessionSet("token",$token);
        return $token;
    }

    public static function tokenGet($formToken){
        Model::sessionInit();
        if(isset($_SESSION['token'])){
            $sessionToken=$_SESSION['token'];
            unset($_SESSION['token']);
            if($formToken==$sessionToken){
                return true;
            }else{
                return false;
            }
        }
    }

    public static function checkAdmin($adminId){
        $sql="SELECT * FROM user_tbl WHERE id=?";
        $values=[$adminId];
        $userInfo=$this->doSelect($sql,$values);
        if(sizeof($userInfo)>0){
            if($userInfo['level']==1){
                return true;
            }
            else{
                return false;
            }
        }
    }
}