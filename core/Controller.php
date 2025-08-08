<?php
class Controller
{
    /* load a model */
    public function model($model)
    {
        require_once 'app/models/' . $model . '.php';
        return new $model();
    }

    /* load a view and make $data keys available as variables */
    public function view($view, $data = [])
    {
        extract($data);                           // ⭐ makes $prod, $products, etc.
        require 'app/views/' . $view . '.php';
    }
}
