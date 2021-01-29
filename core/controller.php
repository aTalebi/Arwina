<?php
class Controller{
    function __Construct()
    {
    }
    
    function view($viewUrl,$data=[],$noIncludeHeader='',$noIncludeFooter='')
    {
        require('links.php');
        if($noIncludeHeader=='')
        {
            require('header.php');
        }
        require('views/'.$viewUrl.'.php');
        
        if($noIncludeFooter=='')
        {
            require('footer.php');
        }
    }
    function model($modelUrl)
    {
        require('models/model_'.$modelUrl.'.php');
        $className='model_'.$modelUrl;
        $this->model=new $className;
    }
}
?>