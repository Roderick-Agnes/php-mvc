<?php
class Controller
{
    public function model($model)
    {
        require_once "./mvc/models/" . $model . ".php";
        return new $model;
    }

    public function view($view, $data = [])
    {
        require_once "./mvc/views/" . $view . ".php";
    }
    public function getBaseUrl()
    {
        return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://") . $_SERVER['SERVER_NAME'] . "/" . "php-mvc/";
    }
    public function getAssetsUrl()
    {
        return "public/assets/";
    }
}
