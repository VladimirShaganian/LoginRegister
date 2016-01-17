<?php


class Controller {

    public function view($view, $data = [])
    {
        $view_file = $view . '.php';
        require_once '/../app/views/' . $view_file;
    }

    public function model($model)
    {
        $model_file = $model . ".php";
        require_once "/../app/models/". $model_file;
        return new $model();
    }



}

