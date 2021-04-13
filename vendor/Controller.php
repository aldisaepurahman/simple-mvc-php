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
    //redirect method to another page
    public function redirectTo($page)
    {
        //remove slash from the left side of page string
        $page = ltrim($page, '/');
        //if string contains index clause, remove it
        if (strpos($page, 'index')) {
            $page = str_replace('index', '', $page);
        }
        //if page is not null, join with base url and redirect it
        if ($page != NULL) {
            header('Location: '.base_url.$page);
        }
        //if page is null, redirect to base url
        else {
            header('Location: '.base_url);
        }
    }
}
?>
