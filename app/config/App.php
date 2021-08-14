<?php

/********************
 * Filename     : App.php
 * Programmer   : Aldi Saepurahman
 * Date         : 2021-04-09
 * Email        : aldisaepurahman@gmail.com
 * Description  : mainloop and url parsing
*********************/

class App
{
    protected $controller = ''; //controller name
    protected $method = ''; //controller method
    protected $params = []; //controller parameter from method

    public function __construct() {
        $url = $this->parseURL(); //url parsing

        /* if the controller file from url is exists, set new controller */
        if (file_exists('app/controllers/'.ucfirst($url[0]).'.php')) {
            $this->controller = ucfirst($url[0]);
            unset($url[0]); //unset from array of url
        }
        else{
            $this->controller = 'Perkuliahan';
        }
        //call the controller and instantiate it
        require_once 'app/controllers/'.$this->controller.'.php';
        $this->controller = new $this->controller;
        /* if the url's method is exists from controller, set the method */
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]); //unset from array of url
            }
            else{
                $this->controller->view('errors/404');
            }
        }
        else{
            $this->method = 'index';
        }
        /* if the url contains parameters, set parameters */
        if (!empty($url)) {
            $this->params = array_values($url);
        }
        if ($this->controller && $this->method) {
            //call method with parameters
            call_user_func_array([$this->controller, $this->method], $this->params);
        }
    }
    /* url parsing method */
    public function parseURL()
    {
        //if the url is set
        if (isset($_GET['url'])) {
            //cut the slash in the end of url, then explode it
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            //return array of url
            return $url;
        }
    }
}


?>