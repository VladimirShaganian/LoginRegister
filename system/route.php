<?php

class Route
{
    public function init() {

        $controller = 'Login'; // Контроллер по умолчанию
        $method = 'index'; // Метод по умолчанию

        $uri = parse_url($_SERVER['REQUEST_URI']);

        $uri_segment = explode('/', $uri['path']);

        if (!empty($uri_segment[1]))
        {
            $controller = $uri_segment[1];
        }

        if (!empty($uri_segment[2]))
        {
            $method = $uri_segment[2];
        }

        $controller_file = $_SERVER['DOCUMENT_ROOT'] . '/app/controllers/' . ucfirst($controller) . '.php';

        if (file_exists($controller_file)) {
            require_once $controller_file;
        } else {
            $this->ErrorPage404();
        }

        $controller = new $controller;

        if (method_exists($controller, $method)) {
            $controller->$method();
        }
    }

    function ErrorPage404()
    {
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:'.$host.'404');
    }
}