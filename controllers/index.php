<?php
class Index extends Controller
{
    function __Construct()
    {
            // Model::sessionInit();
            // $this->checkLogin=Model::sessionGet('userId');
            // if( $this->checkLogin==true){
            //     header('location:'.URL.'home');
            // }
    }

    function index()
    {
        $this->view('index/index');
    }

}

?>