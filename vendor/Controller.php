<?php

/********************
 * Filename     : Controller.php
 * Programmer   : Aldi Saepurahman
 * Date         : 2021-04-09
 * Email        : aldisaepurahman@gmail.com
 * Description  : create controller parent
*********************/

class Controller
{
    //view method to call current page
    public function view($page, $data = [])
    {
        //if the page in views folder is exists, call it
        if (file_exists("app/views/$page.php")) {
            extract($data); //generate array key become variable
            require_once "app/views/$page.php";
        }
        //if the page in views folder is not exists, call 404 page
        else{
            require_once "app/views/errors/404.php";
        }
    }
    //model method to call new model
    public function model($model)
    {
        require_once "app/models/".ucfirst($model).".php";
        //return model object
        return new $model;
    }
}
?>
