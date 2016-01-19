<?php

class Route
{
    public function init() {

        $controller = 'Login'; // Контроллер по умолчанию
        $method = 'index'; // Метод по умолчанию

        $uri = parse_url($_SERVER['REQUEST_URI']);

        $uri_segment = explode('/', $uri['path']);

        // определение выбранного языка
        if (end($uri_segment) == 'ru' || end($uri_segment) == 'en') {
            session_start();
            $_SESSION['lang'] = end($uri_segment);
            array_pop($uri_segment);
            $redirect = $_SERVER['HTTP_HOST'];
            header('Location: http://' . $redirect . '/'. end($uri_segment));
        }

        // определение контроллера
        if (!empty($uri_segment[1]))
        {
            $controller = $uri_segment[1];
        }
        // определение метода
        if (!empty($uri_segment[2]))
        {
            $method = $uri_segment[2];
        }

        // подключение контрллера
        $controller_file = $_SERVER['DOCUMENT_ROOT'] . '/app/controllers/' . ucfirst($controller) . '.php';

        if (file_exists($controller_file)) {
            require_once $controller_file;

        }

        // создание контроллера
        $controller = new $controller;

        // подключение метода
        if (method_exists($controller, $method)) {
            $controller->$method();
        }
    }
}