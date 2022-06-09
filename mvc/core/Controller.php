<?php
class Controller
{

    public function model($model)
    {
        require_once "./mvc/models/" . $model . ".php";
        return new $model;
    }

    public function view($view, $data = [], $component = ['Header' => 'header', 'Navbar' => 'navbar', 'Footer' => 'footer'])
    {
        require_once "./mvc/views/" . $view . ".php";
    }
}
