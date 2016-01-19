<?php


class Controller
{
    public function __construct()
    {
        session_start();
    }

    /**
     * @param $view
     * @param array $data
     */
    public function view($view, $data = [])
    {
        $view_file = $view . '.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/app/views/' . $view_file;
    }

    /**
     * @param $model
     * @return mixed
     */
    public function model($model)
    {
        $model_file = $model . ".php";
        require_once $_SERVER['DOCUMENT_ROOT'] . "/app/models/". $model_file;
        return new $model();
    }

    /**
     * Подкючения файла i18n
     * @return mixed
     */
    public function i18n()
    {
        if (isset($_SESSION['lang']) && !empty($_SESSION['lang'])) {
            $lang = $_SESSION['lang'];
            return require_once $_SERVER['DOCUMENT_ROOT'] . "/system/i18n/" . $lang . ".php";
        } else {
            // язык по умолчанию
            return require_once $_SERVER['DOCUMENT_ROOT'] . "/system/i18n/en.php";
        }
    }


}

